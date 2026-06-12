@echo off
setlocal enabledelayedexpansion

rem Resolve the directory this script lives in and work from there.
set "SCRIPT_DIR=%~dp0"
cd /d "%SCRIPT_DIR%"

rem Force a single CPU architecture for all Docker work so the generated reflection
rem caches are reproducible across hosts (see docker-compose.yml). On arm64 hosts this
rem means amd64 emulation. Mirrors the platform pin in docker-compose.yml.
set "DOCKER_DEFAULT_PLATFORM=linux/amd64"

set "COMPOSE_FILE=%SCRIPT_DIR%docker-compose.yml"

rem Reflection caches (tests/cache/Reflection<version>.json) are committed ground truth, refreshed
rem only by the update-reflection-cache.yml workflow. By default we validate against the committed
rem caches - exactly what CI does - so a normal run never rewrites them. Pass --refresh-reflection
rem to regenerate them locally (slow; requires the per-version Docker images).
set "REFRESH_REFLECTION=false"
for %%A in (%*) do (
  if "%%~A"=="--refresh-reflection" (
    set "REFRESH_REFLECTION=true"
  ) else (
    echo Unknown argument: %%~A
    echo Usage: %~nx0 [--refresh-reflection]
    endlocal
    exit /b 1
  )
)

echo Installing composer packages...
call :dc run --rm test_runner composer install --ignore-platform-reqs
if errorlevel 1 goto :fail

echo Generating stubs cache...
call :dc run --rm test_runner php tests/run-stubs-parser.php
if errorlevel 1 goto :fail

if "%REFRESH_REFLECTION%"=="true" (
  echo Regenerating reflection caches...
  call "%SCRIPT_DIR%tests\run-all-reflection-parsers.bat"
  if errorlevel 1 goto :fail
) else (
  echo Using committed reflection caches ^(pass --refresh-reflection to regenerate them^).
)

echo Running unit tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite Unit
if errorlevel 1 goto :fail

echo Running structure tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite Structure
if errorlevel 1 goto :fail

echo Running PHPDoc tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite PhpDoc
if errorlevel 1 goto :fail

echo Running validator tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite General
if errorlevel 1 goto :fail

endlocal
exit /b 0

:dc
docker compose -f "%COMPOSE_FILE%" %*
exit /b %errorlevel%

:fail
echo.
echo Aborting: a previous step failed.
endlocal
exit /b 1
