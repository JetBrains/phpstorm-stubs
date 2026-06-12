# phpstorm-stubs 

[![official JetBrains project](http://jb.gg/badges/official.svg)](https://confluence.jetbrains.com/display/ALL/JetBrains+on+GitHub)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://www.apache.org/licenses/LICENSE-2.0.html)
[![Total Downloads](https://poser.pugx.org/jetbrains/phpstorm-stubs/downloads)](https://packagist.org/packages/jetbrains/phpstorm-stubs)

[![PhpStorm Stubs Tests](https://github.com/JetBrains/phpstorm-stubs/actions/workflows/main.yml/badge.svg)](https://github.com/JetBrains/phpstorm-stubs/actions/workflows/main.yml)
[![PhpStorm Stubs Check Links](https://github.com/JetBrains/phpstorm-stubs/actions/workflows/testLinks.yml/badge.svg)](https://github.com/JetBrains/phpstorm-stubs/actions/workflows/testLinks.yml)

STUBS are normal, syntactically correct PHP files that contain function & class signatures, constant definitions, etc. for all built-in PHP stuff and most standard extensions. Stubs need to include complete [PHPDOC], especially proper @return annotations.

An IDE needs them for completion, code inspection, type inference, doc popups, etc. Quality of most of these services depend on the quality of the stubs (basically their PHPDOC @annotations).

Note that the stubs for “non-standard” extensions are provided as is. (Non-Standard extensions are the ones that are not part of PHP Core or are not Bundled/External - see the complete list [here](http://php.net/manual/en/extensions.membership.php).)

The support for such “non-standard” stubs is community-driven, and we only validate their PHPDoc. We do not check whether a stub matches the actual extension or whether the provided descriptions are correct.

Please note that currently there are no tests for the thrown exceptions so @throws tags should be checked manually according to official docs or PHP source code

[Relevant open issues]

### Contribution process
[Contribution process](CONTRIBUTING.md)

### Updating the IDE
Have a full copy of the .git repo within an IDE and provide its path in `Settings | Languages & Frameworks | PHP | PHP Runtime | Advanced settings | Default stubs path`. It should then be easily updatable both ways via normal git methods.

### Extensions enabled by default
The set of extensions enabled by default in PhpStorm can change anytime without prior notice. To learn how to view the enabled extensions, look [here](https://blog.jetbrains.com/phpstorm/2017/03/per-project-php-extension-settings-in-phpstorm-2017-1/).

### How to run tests
The validators run on a single PHP version (the `test_runner` image) and check every supported PHP
version using the committed per-version reflection caches in `tests/cache/Reflection<version>.json`.

#### The easy way

Run the bundled script — it installs dependencies, regenerates the stubs cache from your stub edits,
and runs every test suite (`Unit`, `Structure`, `PhpDoc`, `General`) in order:

* macOS / Linux: `./runTests.sh`
* Windows: `runTests.bat`

By default the script validates against the **committed** reflection caches
(`tests/cache/Reflection<version>.json`) — exactly what CI does — so a normal run never rewrites
them. Pass `--refresh-reflection` (e.g. `./runTests.sh --refresh-reflection`) to regenerate them
locally; this is slow and rarely needed, and the result should not be committed (see below).

Both scripts require Docker (they use the `test_runner` image defined in `docker-compose.yml`).

#### Running suites manually

If you prefer to run individual steps:

1. Install dependencies: `docker compose -f docker-compose.yml run --rm test_runner composer install --no-progress`
2. If you changed stub files, regenerate the stubs cache so the tests validate your changes: `docker compose -f docker-compose.yml run --rm test_runner php tests/run-stubs-parser.php`
3. Run a test suite — one of `General`, `PhpDoc`, `Structure` or `Unit`: `docker compose -f docker-compose.yml run --rm test_runner vendor/bin/phpunit --testsuite General`

The reflection caches are generated offline from the per-version Docker images; see
[tests/REFLECTION_PARSER_README.md](tests/REFLECTION_PARSER_README.md) for the regeneration pipeline.

### How to update stub map
Execute `docker compose -f docker-compose.yml run --rm test_runner php tests/Framework/Tools/generate-stubs-map.php` and commit the resulting `PhpStormStubsMap.php`

### License
[Apache 2]

contains material by the PHP Documentation Group, licensed with [CC-BY 3.0] 

[PHPDOC]:https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md
[Apache 2]:https://www.apache.org/licenses/LICENSE-2.0
[Relevant open issues]:https://youtrack.jetbrains.com/issues/WI?q=%23Unresolved+Subsystem%3A+%7BPHP+lib+stubs%7D+order+by%3A+votes+
[CC-BY 3.0]:https://www.php.net/manual/en/cc.license.php
