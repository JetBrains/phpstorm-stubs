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
rem Empty means "every version from the PhpVersions enum", which is what CI runs.
set "PHP_VERSION_UNDER_TEST="

:parse_args
if "%~1"=="" goto :args_done
if /i "%~1"=="--refresh-reflection" (
    set "REFRESH_REFLECTION=true"
    shift
    goto :parse_args
)
if /i "%~1"=="--php-version" (
    if "%~2"=="" (
        echo Missing value for --php-version
        goto :usage
    )
    set "PHP_VERSION_UNDER_TEST=%~2"
    shift
    shift
    goto :parse_args
)
set "CURRENT_ARG=%~1"
if /i "!CURRENT_ARG:~0,14!"=="--php-version=" (
    for /f "tokens=1* delims==" %%a in ("!CURRENT_ARG!") do set "PHP_VERSION_UNDER_TEST=%%b"
    if "!PHP_VERSION_UNDER_TEST!"=="" (
        echo Missing value for --php-version
        goto :usage
    )
    shift
    goto :parse_args
)
echo Unknown argument: %~1
goto :usage

:args_done

rem The version the validators run against is not a runner setting - it comes from the data providers,
rem which iterate PhpVersions::cases() and bake the version into every data set name (see
rem ValidatorTestBase::buildTestName(), e.g. checkClassExists_ArrayObject_5.6). Selecting a version
rem therefore means filtering test names on that suffix. PHPUnit renders a named data set as
rem testEntity"<name>", so one closing quote follows the version; the trailing "." in the regex matches
rem it, which keeps the filter free of quotes that cmd would have to escape.
rem Checks that do not apply to the selected version drop out on their own: the providers skip any
rem descriptor whose PhpVersionRange excludes it, so no data set is generated in the first place.
set "VERSION_FILTER_ARGS="
if not "%PHP_VERSION_UNDER_TEST%"=="" (
    rem Keep the accepted versions in sync with the canonical enum, like run-all-reflection-parsers.bat does.
    set "PHP_ENUM_FILE=%SCRIPT_DIR%tests\Framework\Runner\PhpVersions.php"
    if not exist "!PHP_ENUM_FILE!" (
        echo Cannot find PhpVersions.php: !PHP_ENUM_FILE!
        endlocal
        exit /b 1
    )
    findstr /c:"= '%PHP_VERSION_UNDER_TEST%';" "!PHP_ENUM_FILE!" >nul
    if errorlevel 1 (
        echo Unknown PHP version: %PHP_VERSION_UNDER_TEST%
        rem usebackq (command in backticks) so the single quotes inside the findstr pattern do not
        rem terminate the command for cmd's parser.
        for /f "usebackq tokens=2 delims='" %%V in (`findstr /r /c:"case PHP_[0-9_]* = '[0-9.]*';" "!PHP_ENUM_FILE!"`) do set "KNOWN_VERSIONS=!KNOWN_VERSIONS! %%V"
        echo Valid versions:!KNOWN_VERSIONS!
        endlocal
        exit /b 1
    )
    rem Escape the dot for the regex: 5.6 -> 5\.6
    set "VERSION_PATTERN=%PHP_VERSION_UNDER_TEST:.=\.%"
    rem --do-not-fail-on-empty-test-suite: a suite can legitimately have nothing to run for the selected
    rem version (the PhpDoc checks, for instance, are declared LATEST-only), and PHPUnit exits 1 on an
    rem empty suite by default, which would abort the script.
    set "VERSION_FILTER_ARGS=--filter _!VERSION_PATTERN!.$ --do-not-fail-on-empty-test-suite"
)

echo Installing composer packages...
call :dc run --rm test_runner composer install --ignore-platform-reqs
if errorlevel 1 goto :fail

echo Generating stubs cache...
call :dc run --rm test_runner php tests/run-stubs-parser.php
if errorlevel 1 goto :fail

if "%REFRESH_REFLECTION%"=="true" (
  echo Regenerating reflection caches...
  rem With a single version selected, only that version's cache needs rebuilding.
  call "%SCRIPT_DIR%tests\run-all-reflection-parsers.bat" %PHP_VERSION_UNDER_TEST%
  if errorlevel 1 goto :fail
) else (
  echo Using committed reflection caches ^(pass --refresh-reflection to regenerate them^).
)

if not "%PHP_VERSION_UNDER_TEST%"=="" (
  echo Validating stubs against PHP %PHP_VERSION_UNDER_TEST% only.
)

rem The Unit and Structure suites are not parameterised by PHP version (they test the framework itself
rem and the layout of the stubs tree), so they always run in full.
echo Running unit tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite Unit
if errorlevel 1 goto :fail

echo Running structure tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite Structure
if errorlevel 1 goto :fail

echo Running PHPDoc tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite PhpDoc !VERSION_FILTER_ARGS!
if errorlevel 1 goto :fail

echo Running validator tests...
call :dc run --rm test_runner vendor/bin/phpunit --testsuite General !VERSION_FILTER_ARGS!
if errorlevel 1 goto :fail

endlocal
exit /b 0

:dc
docker compose -f "%COMPOSE_FILE%" %*
exit /b %errorlevel%

:usage
echo Usage: %~nx0 [--refresh-reflection] [--php-version ^<version^>]
echo   --refresh-reflection      Regenerate the reflection caches instead of using the committed ones.
echo   --php-version ^<version^>   Validate stubs against a single PHP version (e.g. 5.6) instead of all of them.
endlocal
exit /b 1

:fail
echo.
echo Aborting: a previous step failed.
endlocal
exit /b 1
