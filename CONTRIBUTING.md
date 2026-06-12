# Contribution process
Thank you, your help is most appreciated, and improves experience for everyone!
Please follow the guidelines to keep it simpler for both sides. Contact us if unsure or in case if you *have* to massively violate these guidelines

# Notes on content
Please check our [issue tracker] for issues corresponding to the problem you're fixing with your pull requests. Create issue on [issue tracker] describing the problem if there doesn't exist. Please link pull request/commit messages to the issue.

## Code Style
* Please avoid any unnecessary changes e.g., spacing, line endings, HTML formatting. Remember, these files are NOT for human consumption. We want to preserve meaningful history.
* Please try to match existing style for any particular file - formatting, spacing, naming conventions.
* Please add corresponding @since tags
* Please run `docker compose -f docker-compose.yml run --rm test_runner composer cs` to check the code style and `docker compose -f docker-compose.yml run --rm test_runner composer cs-fix` to fix it

## Typehints In Signature
* Please ensure that typehints in signature match types returned by reflection. If reflection doesn't return any type please add such typehints via PhpDoc
* If typehint (or type generally) of entity should be different for different PHP versions please use `LanguageLevelTypeAware` attribute in next format:</br>
`#[LanguageLevelTypeAware(['<PHP_VERSION>' => '[type]', '<PHP_VERSION>' => '[type]'], default: '[type]')]`.
</br> Short example
```php
<?php
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
class Error implements Throwable
{
    #[LanguageLevelTypeAware(['8.1' => 'string'], default: '')]
    protected $file; //since 8.1 propery has typehint `string` according to reflection but didn't have any typehints before
}
//or for the function
#[LanguageLevelTypeAware(['8.0' => 'CurlHandle|false'], default: 'resource|false')]
function curl_copy_handle(#[LanguageLevelTypeAware(['8.0' => 'CurlHandle'], default: 'resource')] $handle) {}
```

## Tests
 * Please make sure that tests pass for your Pull Request.
 * The easiest way to run the full test suite locally is the bundled script (requires Docker — it installs dependencies, regenerates the stubs and reflection caches, and runs every test suite):
   * macOS / Linux: `./runTests.sh`
   * Windows: `runTests.bat`
 * To run suites manually instead, see [How to run tests](README.md#how-to-run-tests) in the README.
 * If a stub legitimately cannot match reflection (for example a runtime-dependent constant value, or an entity available only on certain PHP versions), register it in `tests/Framework/Validator/KnownProblems/DefaultKnownProblemsProvider.php`.

## Cache files
The test framework keeps two kinds of cache under `tests/cache/`:
 * **Stubs caches** (`Stubs*.json`) are regenerated from the stub files on every test run (and by CI). If your stub edits change them, that is expected — they are derived from your changes.
 * **Reflection caches** (`Reflection<version>.json`) are the per-PHP-version ground truth the validators check stubs against. **Do not commit changes to them.** They are pinned to the exact PHP patch recorded in `tests/cache/php-versions.json` and are refreshed only by the automated `update-reflection-cache.yml` workflow when a new PHP patch is released. `runTests.sh` validates against the committed copies by default and only regenerates them when you pass `--refresh-reflection` (a local convenience that should be reverted, not committed).
 
## Types of contribution
As of 2017.1 Preview we gladly accept all "non-standard" extensions and IDE get a UI for per-project configuration.
As of 2016.3 there is an [easy way to package your custom stubs/metadata] as a plugin.


[issue tracker]:https://youtrack.jetbrains.com/issues/WI?q=%23Unresolved+%23%7BPHP+lib+stubs%7D+
[easy way to package your custom stubs/metadata]:https://github.com/artspb/phpstorm-library-plugin
