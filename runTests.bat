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

echo Installing composer packages...
call :dc run --rm test_runner composer install --ignore-platform-reqs
if errorlevel 1 goto :fail

echo Generating stubs cache...
call :dc run --rm test_runner php tests/run-stubs-parser.php
if errorlevel 1 goto :fail

echo Generating reflection caches...
call "%SCRIPT_DIR%tests\run-all-reflection-parsers.bat"
if errorlevel 1 goto :fail

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
