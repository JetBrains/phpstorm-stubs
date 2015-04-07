# phpstorm-stubs

STUBS are normal, syntactically correct PHP files that contain function & class signatures, constant definitions, etc. for all built in PHP stuff and most standard extensions. Stubs need to include complete [PHPDOC], especially proper @return annotations

IDE needs them for completion, code inspection, type inference, doc popups, etc. Quality of most of this services depend on quality of the stubs (basically their PHPDOC @annotations).

[Relevant open issues]

### Notes on content
Please avoid any unnecessary changes eg. spacing, line endings. Remember, these files are NOT for human consumption. We do want preserve meaningful history.

We don't really want to include all possible stubs ASAP (they do slow IDE down) and we are working on better system for managing them. Until we find good solution we'll go for bugfixes first.

Please also link pull request to YT issue and back if issue exists.

### Contribution process
You have to send a photo of signed [Contributor agreement] before we'll be able to include your contribution into the product and redistribute to other users. See link for explanation. 

### Updating the IDE
TBD: Have a full copy of .git repo within IDE and add it as an external library "PHP Runtime" to the project. It should then be easilly updatable both way via normal git methods.

### License
[Apache 2]

[PHPDOC]:https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md
[Apache 2]:https://www.apache.org/licenses/LICENSE-2.0
[Contributor agreement]:http://www.jetbrains.org/display/IJOS/Contributor+Agreement
[Relevant open issues]:https://youtrack.jetbrains.com/issues/WI?q=%23Unresolved+Subsystem%3A+%7BPHP+lib+stubs%7D+order+by%3A+votes+