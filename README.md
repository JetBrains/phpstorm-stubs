# phpstorm-stubs

STUBS are normal, syntactically correct PHP files that contain function & class signatures, constant definitions, etc. for all built in PHP stuff and most standard extensions. Stubs need to include complete [PHPDOC], especially proper @return annotations

IDE needs them for completion, code inspection, type inference, doc popups, etc. Quality of most of this services depend on quality of the stubs (basically their PHPDOC @annotations).

[Relevant open issues]

### Contribution process
[Contribution process](CONTRIBUTING.md)

### Updating the IDE
TBD: Have a full copy of .git repo within IDE and add it as an external library "PHP Runtime" to the project. It should then be easilly updatable both way via normal git methods.

### License
[Apache 2]

[PHPDOC]:https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md
[Apache 2]:https://www.apache.org/licenses/LICENSE-2.0
[Relevant open issues]:https://youtrack.jetbrains.com/issues/WI?q=%23Unresolved+Subsystem%3A+%7BPHP+lib+stubs%7D+order+by%3A+votes+