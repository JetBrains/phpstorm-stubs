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

# Reflection caches (tests/cache/Reflection<version>.json) are committed ground truth, refreshed
# only by the update-reflection-cache.yml workflow. By default we validate against the committed
# caches — exactly what CI does — so a normal run never rewrites them. Pass --refresh-reflection to
# regenerate them locally (slow; requires the per-version Docker images).
REFRESH_REFLECTION=false
for arg in "$@"; do
  case "$arg" in
    --refresh-reflection) REFRESH_REFLECTION=true ;;
    *)
      echo "Unknown argument: $arg"
      echo "Usage: $(basename "$0") [--refresh-reflection]"
      exit 1
      ;;
  esac
done

echo "Installing composer packages..."
dc run --rm test_runner composer install --ignore-platform-reqs

echo "Generating stubs cache..."
dc run --rm test_runner php tests/run-stubs-parser.php

if [ "$REFRESH_REFLECTION" = true ]; then
  echo "Regenerating reflection caches..."
  bash "$SCRIPT_DIR/tests/run-all-reflection-parsers.sh"
else
  echo "Using committed reflection caches (pass --refresh-reflection to regenerate them)."
fi

echo "Running unit tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite Unit

echo "Running structure tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite Structure

echo "Running PHPDoc tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite PhpDoc

echo "Running validator tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite General
