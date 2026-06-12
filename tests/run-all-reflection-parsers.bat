@echo off
setlocal enabledelayedexpansion

rem ###########################################################################
rem Run reflection parser across all PHP Docker versions
rem
rem This script:
rem 1. Builds Docker images for each PHP version (5.6 - 8.5)
rem 2. Runs legacy reflection adapter in each container (Stage 1)
rem 3. Processes adapted data with modern PHP (Stage 2)
rem 4. Outputs JSON files to tests/cache/Reflection{version}.json
rem
rem Usage:
rem   tests\run-all-reflection-parsers.bat
rem   tests\run-all-reflection-parsers.bat --skip-build          Skip Docker build
rem   tests\run-all-reflection-parsers.bat 8.4 8.5               Only those versions
rem ###########################################################################

rem Force a single CPU architecture for all Docker work so reflection caches are
rem reproducible across hosts. Reflection reads real runtime values that depend on the
rem CPU ABI (e.g. CHAR_MAX is 255 on arm64 vs 127 on amd64). amd64 matches CI and the
rem committed Reflection*.json baseline; on arm64 hosts this runs under emulation.
rem Mirrors the platform pin in docker-compose.yml.
set "DOCKER_DEFAULT_PLATFORM=linux/amd64"

set "SCRIPT_DIR=%~dp0"
rem Strip the trailing backslash for cleaner path composition.
set "SCRIPT_DIR=%SCRIPT_DIR:~0,-1%"
for %%I in ("%SCRIPT_DIR%\..") do set "PROJECT_ROOT=%%~fI"
set "COMPOSE_FILE=%PROJECT_ROOT%\docker-compose.yml"

rem Derive PHP version list from the canonical PhpVersions.php enum so this script
rem stays in sync with the test framework when new PHP versions are added.
set "PHP_ENUM_FILE=%SCRIPT_DIR%\Framework\Runner\PhpVersions.php"
if not exist "%PHP_ENUM_FILE%" (
    echo [X] Cannot find PhpVersions.php: %PHP_ENUM_FILE%
    exit /b 1
)

rem Parse arguments: optional --skip-build flag and an optional explicit list of
rem versions. When one or more versions are passed, only those are processed.
set "SKIP_BUILD=false"
set "REQUESTED_VERSIONS="
for %%A in (%*) do (
    if /i "%%~A"=="--skip-build" (
        set "SKIP_BUILD=true"
    ) else (
        echo %%~A| findstr /r "^[0-9][0-9]*\.[0-9][0-9]*$" >nul
        if errorlevel 1 (
            echo [X] Unrecognized argument: %%~A
            echo Usage: run-all-reflection-parsers.bat [--skip-build] [^<version^> ...]
            exit /b 1
        )
        set "REQUESTED_VERSIONS=!REQUESTED_VERSIONS! %%~A"
    )
)

set "PHP_VERSIONS="
if not "%REQUESTED_VERSIONS%"=="" (
    set "PHP_VERSIONS=%REQUESTED_VERSIONS%"
) else (
    rem Extract version literals like  case PHP_8_4 = '8.4';
    for /f "tokens=2 delims='" %%V in ('findstr /r "case PHP_[0-9A-Z_]* = '[0-9.]*'" "%PHP_ENUM_FILE%"') do (
        set "PHP_VERSIONS=!PHP_VERSIONS! %%V"
    )
)

rem Trim a possible leading space.
if not "%PHP_VERSIONS%"=="" set "PHP_VERSIONS=%PHP_VERSIONS:~1%"

if "%PHP_VERSIONS%"=="" (
    echo [X] No PHP versions found in %PHP_ENUM_FILE%
    exit /b 1
)

echo ========================================
echo PHP Reflection Parser - Multi-Version
echo ========================================
echo Project Root: %PROJECT_ROOT%
echo PHP Versions: %PHP_VERSIONS%
echo Skip Build: %SKIP_BUILD%
echo ========================================
echo.

set /a TOTAL_VERSIONS=0
set /a SUCCESS_COUNT=0
set /a FAILED_COUNT=0
set /a SKIPPED_COUNT=0
set "SUCCESS_VERSIONS="
set "FAILED_VERSIONS="
for %%V in (%PHP_VERSIONS%) do set /a TOTAL_VERSIONS+=1

rem Create cache directory if it doesn't exist.
if not exist "%SCRIPT_DIR%\cache" mkdir "%SCRIPT_DIR%\cache"

rem Build test_runner image once (used for Stage 2 processing with modern PHP).
if "%SKIP_BUILD%"=="false" (
    echo Building test_runner image ^(modern PHP for processing^)...
    docker compose -f "%COMPOSE_FILE%" build test_runner
    if errorlevel 1 (
        echo [X] Failed to build test_runner image
        echo Cannot continue without test_runner. Exiting.
        exit /b 1
    )
    echo [OK] test_runner image built successfully
    echo.
)

rem Process each PHP version.
for %%V in (%PHP_VERSIONS%) do (
    call :process_version "%%V"
)

rem Summary
echo.
echo ========================================
echo Summary
echo ========================================
echo Total Versions: %TOTAL_VERSIONS%
echo Success: %SUCCESS_COUNT%
echo Failed: %FAILED_COUNT%
echo Skipped: %SKIPPED_COUNT%
echo ========================================

if %SUCCESS_COUNT% gtr 0 (
    echo.
    echo Successful versions:
    for %%V in (%SUCCESS_VERSIONS%) do echo   [OK] PHP %%V
)

if %FAILED_COUNT% gtr 0 (
    echo.
    echo Failed versions:
    for %%V in (%FAILED_VERSIONS%) do echo   [X] PHP %%V
)

echo.
echo Generated files:
dir /b "%SCRIPT_DIR%\cache\Reflection*.json" 2>nul || echo No files found

echo.
echo ========================================
if %FAILED_COUNT% equ 0 if %SUCCESS_COUNT% gtr 0 (
    echo [OK] All versions processed successfully!
    endlocal
    exit /b 0
)
if %SUCCESS_COUNT% gtr 0 (
    echo [!] Completed with %FAILED_COUNT% failures
    endlocal
    exit /b 1
)
echo [X] All versions failed!
endlocal
exit /b 1

rem ---------------------------------------------------------------------------
rem :process_version <version>
rem ---------------------------------------------------------------------------
:process_version
set "VERSION=%~1"
echo.
echo ========================================
echo Processing PHP %VERSION%
echo ========================================

set "DOCKERFILE_PATH=%SCRIPT_DIR%\DockerImages\%VERSION%\Dockerfile"
if not exist "%DOCKERFILE_PATH%" (
    echo [X] Dockerfile not found: %DOCKERFILE_PATH%
    set /a SKIPPED_COUNT+=1
    exit /b 0
)

rem Pin the base image to the patch recorded in the manifest (consumed by docker-compose.yml).
call :get_patch "%VERSION%"
echo Base image: php:%PHP_PATCH%-alpine

rem Build Docker image for this specific PHP version.
if "%SKIP_BUILD%"=="false" (
    echo [1/4] Building Docker image for PHP %VERSION%...
    set "PHP_VERSION=%VERSION%"
    docker compose -f "%COMPOSE_FILE%" build php_under_test
    if errorlevel 1 (
        echo [X] Failed to build Docker image for PHP %VERSION%
        set "FAILED_VERSIONS=!FAILED_VERSIONS! %VERSION%"
        set /a FAILED_COUNT+=1
        set "PHP_VERSION="
        exit /b 0
    )
    echo       [OK] Docker image built successfully
    set "PHP_VERSION="
) else (
    echo [1/4] Skipping Docker build ^(--skip-build flag^)
)

rem Stage 1 - Legacy PHP 5.6+ compatible reflection adapter.
echo [2/4] Running reflection adapter for PHP %VERSION% ^(Stage 1^)...
set "TEMP_DATA_FILE=%SCRIPT_DIR%\cache\.tmp-reflection-%VERSION%.dat"
set "PHP_VERSION=%VERSION%"
docker compose -f "%COMPOSE_FILE%" run --rm php_under_test php tests/adapt-legacy-reflection.php %VERSION% "/opt/project/phpstorm-stubs/tests/cache/.tmp-reflection-%VERSION%.dat"
if errorlevel 1 (
    echo [X] Failed to run reflection adapter for PHP %VERSION%
    set "FAILED_VERSIONS=!FAILED_VERSIONS! %VERSION%"
    set /a FAILED_COUNT+=1
    set "PHP_VERSION="
    exit /b 0
)
set "PHP_VERSION="
echo       [OK] Reflection adaptation completed

if not exist "%TEMP_DATA_FILE%" (
    echo [X] Temp data file not found: %TEMP_DATA_FILE%
    set "FAILED_VERSIONS=!FAILED_VERSIONS! %VERSION%"
    set /a FAILED_COUNT+=1
    exit /b 0
)

rem Stage 2 - Process extracted data with modern PHP.
echo [3/4] Processing reflection data for PHP %VERSION% ^(Stage 2^)...
docker compose -f "%COMPOSE_FILE%" run --rm test_runner php tests/run-reflection-processor.php "/opt/project/phpstorm-stubs/tests/cache/.tmp-reflection-%VERSION%.dat" "/opt/project/phpstorm-stubs/tests/cache/Reflection%VERSION%.json"
if errorlevel 1 (
    echo [X] Failed to process reflection data for PHP %VERSION%
    set "FAILED_VERSIONS=!FAILED_VERSIONS! %VERSION%"
    set /a FAILED_COUNT+=1
    exit /b 0
)
echo       [OK] Reflection processing completed
del /f /q "%TEMP_DATA_FILE%" 2>nul

rem Verify output file.
echo [4/4] Verifying output file...
set "OUTPUT_FILE=%SCRIPT_DIR%\cache\Reflection%VERSION%.json"
if exist "%OUTPUT_FILE%" (
    echo       [OK] Output file created: Reflection%VERSION%.json
    set "SUCCESS_VERSIONS=!SUCCESS_VERSIONS! %VERSION%"
    set /a SUCCESS_COUNT+=1
) else (
    echo [X] Output file not found: %OUTPUT_FILE%
    set "FAILED_VERSIONS=!FAILED_VERSIONS! %VERSION%"
    set /a FAILED_COUNT+=1
)
exit /b 0

rem ---------------------------------------------------------------------------
rem :get_patch <minor>
rem Resolve the exact patch a minor line should build from, recorded in
rem tests/cache/php-versions.json (e.g. "8.3" -> "8.3.31"), and expose it as
rem PHP_PATCH for docker-compose.yml. Falls back to the minor line when the
rem manifest has no entry, so the value is always a valid php:<tag>-alpine.
rem ---------------------------------------------------------------------------
:get_patch
set "PHP_PATCH=%~1"
set "PHP_VERSIONS_MANIFEST=%SCRIPT_DIR%\cache\php-versions.json"
if not exist "%PHP_VERSIONS_MANIFEST%" exit /b 0
for /f tokens^=4^ delims^=^" %%P in ('findstr /c:"\"%~1\":" "%PHP_VERSIONS_MANIFEST%"') do set "PHP_PATCH=%%P"
exit /b 0
