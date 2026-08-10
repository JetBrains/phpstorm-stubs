#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" &> /dev/null && pwd)"
cd "$SCRIPT_DIR"

# Force a single CPU architecture for all Docker work so the generated reflection
# caches are reproducible across hosts (see docker-compose.yml). On arm64 hosts this
# means amd64 emulation. Mirrors the platform pin in docker-compose.yml.
export DOCKER_DEFAULT_PLATFORM=linux/amd64

dc() {
  docker compose -f "$SCRIPT_DIR/docker-compose.yml" "$@"
}

usage() {
  echo "Usage: $(basename "$0") [--refresh-reflection] [--php-version <version>]"
  echo "  --refresh-reflection      Regenerate the reflection caches instead of using the committed ones."
  echo "  --php-version <version>   Validate stubs against a single PHP version (e.g. 5.6) instead of all of them."
}

# Reflection caches (tests/cache/Reflection<version>.json) are committed ground truth, refreshed
# only by the update-reflection-cache.yml workflow. By default we validate against the committed
# caches — exactly what CI does — so a normal run never rewrites them. Pass --refresh-reflection to
# regenerate them locally (slow; requires the per-version Docker images).
REFRESH_REFLECTION=false
# Empty means "every version from the PhpVersions enum", which is what CI runs.
PHP_VERSION_UNDER_TEST=""
while [ $# -gt 0 ]; do
  case "$1" in
    --refresh-reflection) REFRESH_REFLECTION=true ;;
    --php-version=*)
      PHP_VERSION_UNDER_TEST="${1#*=}"
      if [ -z "$PHP_VERSION_UNDER_TEST" ]; then
        echo "Missing value for --php-version"
        usage
        exit 1
      fi
      ;;
    --php-version)
      if [ $# -lt 2 ]; then
        echo "Missing value for --php-version"
        usage
        exit 1
      fi
      PHP_VERSION_UNDER_TEST="$2"
      shift
      ;;
    *)
      echo "Unknown argument: $1"
      usage
      exit 1
      ;;
  esac
  shift
done

# The version the validators run against is not a runner setting — it comes from the data providers,
# which iterate PhpVersions::cases() and bake the version into every data set name (see
# ValidatorTestBase::buildTestName(), e.g. checkClassExists_ArrayObject_5.6). Selecting a version
# therefore means filtering test names on that suffix. PHPUnit renders a named data set as
# testEntity"<name>", so one closing quote follows the version; the trailing "." in the regex matches
# it (a literal quote would need per-shell escaping, and runTests.bat has to build the same filter).
# Checks that do not apply to the selected version drop out on their own: the providers skip any
# descriptor whose PhpVersionRange excludes it, so no data set is generated in the first place.
VERSION_FILTER_ARGS=()
if [ -n "$PHP_VERSION_UNDER_TEST" ]; then
  # Keep the accepted versions in sync with the canonical enum, like run-all-reflection-parsers.sh does.
  PHP_ENUM_FILE="$SCRIPT_DIR/tests/Framework/Runner/PhpVersions.php"
  if [ ! -f "$PHP_ENUM_FILE" ]; then
    echo "Cannot find PhpVersions.php: $PHP_ENUM_FILE"
    exit 1
  fi
  KNOWN_VERSIONS=($(sed -n "s/.*case PHP_[A-Z0-9_]* = '\([0-9.]*\)'.*/\1/p" "$PHP_ENUM_FILE"))
  VERSION_IS_KNOWN=false
  for known in "${KNOWN_VERSIONS[@]}"; do
    if [ "$known" = "$PHP_VERSION_UNDER_TEST" ]; then
      VERSION_IS_KNOWN=true
      break
    fi
  done
  if [ "$VERSION_IS_KNOWN" = false ]; then
    echo "Unknown PHP version: $PHP_VERSION_UNDER_TEST"
    echo "Valid versions: ${KNOWN_VERSIONS[*]}"
    exit 1
  fi

  # --do-not-fail-on-empty-test-suite: a suite can legitimately have nothing to run for the selected
  # version (the PhpDoc checks, for instance, are declared LATEST-only), and PHPUnit exits 1 on an
  # empty suite by default, which would abort the script.
  VERSION_FILTER_ARGS=(--filter "_${PHP_VERSION_UNDER_TEST//./\\.}.\$" --do-not-fail-on-empty-test-suite)
fi

echo "Installing composer packages..."
dc run --rm test_runner composer install --ignore-platform-reqs

echo "Generating stubs cache..."
dc run --rm test_runner php tests/run-stubs-parser.php

if [ "$REFRESH_REFLECTION" = true ]; then
  echo "Regenerating reflection caches..."
  # With a single version selected, only that version's cache needs rebuilding.
  bash "$SCRIPT_DIR/tests/run-all-reflection-parsers.sh" ${PHP_VERSION_UNDER_TEST:+"$PHP_VERSION_UNDER_TEST"}
else
  echo "Using committed reflection caches (pass --refresh-reflection to regenerate them)."
fi

if [ -n "$PHP_VERSION_UNDER_TEST" ]; then
  echo "Validating stubs against PHP $PHP_VERSION_UNDER_TEST only."
fi

# The Unit and Structure suites are not parameterised by PHP version (they test the framework itself
# and the layout of the stubs tree), so they always run in full.
echo "Running unit tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite Unit

echo "Running structure tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite Structure

echo "Running PHPDoc tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite PhpDoc ${VERSION_FILTER_ARGS[@]+"${VERSION_FILTER_ARGS[@]}"}

echo "Running validator tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite General ${VERSION_FILTER_ARGS[@]+"${VERSION_FILTER_ARGS[@]}"}
