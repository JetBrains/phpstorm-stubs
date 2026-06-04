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

echo "Installing composer packages..."
dc run --rm test_runner composer install --ignore-platform-reqs

echo "Generating stubs cache..."
dc run --rm test_runner php tests/run-stubs-parser.php

echo "Generating reflection caches..."
bash "$SCRIPT_DIR/tests/run-all-reflection-parsers.sh"

echo "Running unit tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite Unit

echo "Running structure tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite Structure

echo "Running PHPDoc tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite PhpDoc

echo "Running validator tests..."
dc run --rm test_runner vendor/bin/phpunit --testsuite General
