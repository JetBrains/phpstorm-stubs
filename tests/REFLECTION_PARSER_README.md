# Reflection Parser Scripts

Scripts for generating the per-version PHP reflection cache files (`tests/cache/Reflection{version}.json`).
These JSON files are the ground-truth used by validator tests.

## Reproducibility: builds are pinned to `php-versions.json`

The per-version Docker images build from an exact PHP patch (`FROM php:${PHP_PATCH}-alpine`), where
`PHP_PATCH` is resolved from `tests/cache/php-versions.json` (e.g. `8.3` → `8.3.31`) by
`run-all-reflection-parsers.sh` and forwarded as a build arg via `docker-compose.yml`. This makes
`php-versions.json` the single source of truth for the PHP patch each cache was generated from, so a
local rebuild reproduces the committed `Reflection{version}.json` byte-for-byte (the platform pin in
`docker-compose.yml` covers CPU-ABI reproducibility). The pin only advances together with regenerated
caches, in the same PR opened by `.github/workflows/update-reflection-cache.yml` — never edit it by
hand or commit a locally-regenerated reflection cache on its own.

## Overview

Generating reflection data is a two-stage pipeline:

1. **Stage 1 — legacy adapter** (`tests/adapt-legacy-reflection.php`)
   Runs inside a per-version Docker container (PHP 5.6 – 8.4).
   Uses the old-style reflection API compatible with that PHP version.
   Outputs a raw serialized data file to `tests/cache/.tmp-reflection-{version}.dat`.

2. **Stage 2 — modern processor** (`tests/run-reflection-processor.php`)
   Runs in the `test_runner` container (latest stable PHP).
   Reads the Stage 1 data file and converts it to the canonical JSON format.
   Outputs `tests/cache/Reflection{version}.json`.

## Available Scripts

### `tests/run-all-reflection-parsers.sh`

Runs the two-stage pipeline for **all** PHP versions (5.6 – 8.4) using Docker.

```bash
# Build Docker images and run all versions
./tests/run-all-reflection-parsers.sh

# Skip Docker build (use existing images)
./tests/run-all-reflection-parsers.sh --skip-build
```

Outputs: `tests/cache/Reflection{version}.json` for each successfully processed version.

### `tests/run-stubs-parser.php`

Parses all PHP stub files in the project and produces a stubs cache file.

```bash
php tests/run-stubs-parser.php [version]
```

Output: `tests/cache/Stubs{version}.json`

## Docker Setup

Docker images are defined in `tests/DockerImages/`:

```
tests/DockerImages/
├── 5.6/Dockerfile
├── 7.0/Dockerfile
├── ...
└── 8.4/Dockerfile
```

The `docker-compose.yml` in the project root defines two services:
- `php_under_test` — per-version image used for Stage 1
- `test_runner` — latest PHP image used for Stage 2 and running PHPUnit

```bash
# Manually build a specific PHP version image
PHP_VERSION=8.3 docker compose build php_under_test

# Manually run Stage 1 for PHP 8.3
PHP_VERSION=8.3 docker compose run --rm php_under_test \
  php tests/adapt-legacy-reflection.php 8.3 \
  "/opt/project/phpstorm-stubs/tests/cache/.tmp-reflection-8.3.dat"

# Manually run Stage 2
docker compose run --rm test_runner \
  php tests/run-reflection-processor.php \
  "/opt/project/phpstorm-stubs/tests/cache/.tmp-reflection-8.3.dat" \
  "/opt/project/phpstorm-stubs/tests/cache/Reflection8.3.json"
```

## Output Format

Each `Reflection{version}.json` is a flat JSON array of entity objects.
Each object has a `_type` discriminator field:

```json
[
  { "_type": "PHPClass",    "name": "Exception", "id": "\\Exception", ... },
  { "_type": "PHPFunction", "name": "strlen",    "id": "\\strlen",    ... },
  { "_type": "PHPInterface","name": "Countable", "id": "\\Countable", ... },
  { "_type": "PHPEnum",     "name": "Suit",      "id": "\\Suit",      ... },
  { "_type": "PHPConstant", "name": "PHP_EOL",   "id": "\\PHP_EOL",   ... }
]
```

## Integration with Tests

The generated files are loaded by:
- `Runner::getReflection($version)` — returns a `ParsedDataStorageManager` hydrated from cache
- `ValidatorTestBase::entityProvider()` — iterates over all versions and entities
- All `*ValidatorTest.php` integration tests in `tests/`

## Troubleshooting

### "Dockerfile not found"
Run from the project root. Docker image dirs live at `tests/DockerImages/{version}/Dockerfile`.

### "Docker image build failed"
1. Check Docker is running: `docker ps`
2. Try building manually: `PHP_VERSION=8.3 docker compose build php_under_test`

### "Output file not found"
1. Ensure `tests/cache/` exists: `mkdir -p tests/cache`
2. Check for errors in Stage 1 or Stage 2 output

### Missing extensions in reflection data
Edit `tests/DockerImages/{version}/Dockerfile`, add `docker-php-ext-install {extension}`, rebuild.
