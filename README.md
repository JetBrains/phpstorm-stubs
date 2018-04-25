# phpstorm-stubs 

[![official JetBrains project](http://jb.gg/badges/official.svg)](https://confluence.jetbrains.com/display/ALL/JetBrains+on+GitHub) 
[![Build Status](https://travis-ci.org/JetBrains/phpstorm-stubs.svg?branch=master)](https://travis-ci.org/JetBrains/phpstorm-stubs)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](http://www.apache.org/licenses/LICENSE-2.0.html)
[![Total Downloads](https://poser.pugx.org/jetbrains/phpstorm-stubs/downloads)](https://packagist.org/packages/jetbrains/phpstorm-stubs)

STUBS are normal, syntactically correct PHP files that contain function & class signatures, constant definitions, etc. for all built in PHP stuff and most standard extensions. Stubs need to include complete [PHPDOC], especially proper @return annotations

IDE needs them for completion, code inspection, type inference, doc popups, etc. Quality of most of this services depend on quality of the stubs (basically their PHPDOC @annotations).

[Relevant open issues]

### Contribution process
[Contribution process](CONTRIBUTING.md)

### Updating the IDE
TBD: Have a full copy of .git repo within IDE and add it as an external library "PHP Runtime" to the project. It should then be easilly updatable both way via normal git methods.

### How to run tests
1. Execute `composer install`
2. Execute `docker-compose -f tests/docker-compose.yml run php > tests/stub.json`
3. Run the test `phpunit tests/TestStubs.php`

### License
[Apache 2]

[PHPDOC]:https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md
[Apache 2]:https://www.apache.org/licenses/LICENSE-2.0
[Relevant open issues]:https://youtrack.jetbrains.com/issues/WI?q=%23Unresolved+Subsystem%3A+%7BPHP+lib+stubs%7D+order+by%3A+votes+
