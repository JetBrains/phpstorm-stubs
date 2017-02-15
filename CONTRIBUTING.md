# Contributing
Thank you, your help is most appreciated, and improves the experience for everyone!
Please follow the guidelines to keep it simpler for both sides of the contribution process.

## Contributing Process
The best way to contribute code and DocBlock changes is by creating a fork on GitHub and make the changes in your copy 
then sending a pull request. This allows for easier reviewing and merging of every bodies contributions even in the 
case where there might be some overlap. Please also make sure if you are fixing an existing issue on [YouTrack] that
you insure the pull request/commit messages and the issue are both linked together to making managing the issues easier.

## Types Of Contributions
We don't really want to include all possible extensions/libs ASAP (they do slow the IDE down a bit) and we are trying
to prioritise bug fixes and making improvements to the existing stubs first but additions are welcome as well.

### Fixing The Existing Stubs
This is an incomplete list of things that need fixed or improved in the existing stubs in no particular order:
  * Insure everything has a DocBlock containing at minimum a good short description, a @link tag to the full docs,
  @since tags, and if needed @deprecated tags. The first two are there to help all the humans involved and the last 
  two are used by the IDE. Without the last two tags much of the value of the stubs is lost.
  * Making sure all function and method @param tags exist and are complete. There are many places where parameters 
  have no type information or only some of the allowed types are listed. There are also cases where the type hint 
  is mixed or object where actually only a couple of types are allowed. For example it might have
  `* @param mixed $parameter` but it only accepts `array|string`.
  * Insure optional parameters that allow skipping by using `null` or `false` and their normal type are fully
  documented.  There is a common practice especially in extensions to allow skipping some optional parameters but 
  still be able to set the latter ones. You can usually skip a parameter so it uses it's default value by using 
  `null` for it. Often the `|null` is missing in the type hint which causes the IDE to complain if you try using this
   feature.
  * Return type hinting is complete for only non-error results. Many functions and methods either return `null` or 
  `false` when there is an error but often the type hint only has the primary type listed. When properly type hinting
  the IDE can warning users when they are _not_ handling possible error conditions which can often lead to some hard to 
  detect bugs.
  * DocBlocks contain html start tags with no closing tag or end tags without start tags. The mark up needs to be 
  valid. Since Markdown syntax is understood by both the IDE and humans equally well replacing the html tags where
  possible is preferred in most cases.
  * Insure function and method 'prototypes' match the main docs and are complete. PHP version 5.0 type hinting for 
  arrays, classes, and interfaces should be used. Do to the large amount of code that is still being run on PHP 5.* 
  the newer PHP 7.* hinting for scalar types and return type hinting should _not_ be used at this time. Remember also 
  that the new type hinting only has any effect based on the caller using strict type and _not_ the callee. From the
  point of view of the IDE the stubs are being used as the callee. Using the newer hinting will probably change in the
  near future with the 5.x series now having passed end of life but many of the extensions have yet to fully change over
  to understanding the new hinting as well so some delay is warrantied for now.

As stated this is a incomplete list but insuring that all the existing stubs have had the above problems fix will go a
long way towards improving things.

## Stub Author Intro
In the past code styling was very loose with only suggestions to make a best effort to follow what had been done 
before on a per file basis. This as can be expected leads to the files all ending up with very different styling which 
makes them harder to maintain in the long run. To try to keep this from continuing to happen this intro has been written
and an effort to bring all of the existing stubs into line to it has been done. Many things still need to be done but
with a more formal set of guidelines for everybody to work from things should start improving with time instead of
getting worse. A more complete author guide maybe added in the future.
 
### Code Style
The code styling used is loosely based on PSR-1,2 with some tweaks for things that are unique to how stubs are used. 
Remember the stubs are used mostly to help the IDE guide it's users and to provide auto-completion, etc and _not_ as a 
replacement for the existing documentation like is found at http://php.net or where ever the extensions are 
documented. That being said there is no reason not to re-use some of the per extension structuring these sites have 
with adjustments for the differing propose of stubs. Since most of the contributors, maintainers, and reviewers will 
be using http://php.net as a reference there are benefits to use the same or similar naming and basic structural 
ideas etc. in the stubs as well. 

The project now includes an `.idea/codeStyleSettings.xml` file which should be used by anyone making changes to the 
stub DocBlocks or code. Using the first three 'before commit' settings from the right hand side of the commit popup 
window would also be a good idea to help keep things neat as well.

### Extension Components
All extensions contain up to four main code groupings or components. They are:
  * Classes
  * Constants
  * Interfaces
  * Functions
  
Not every extension has all of these of course but most have at least a couple of them. In the past these where in 
most cases just all lumped into a single file with every extension seeming to use a different order. These is much 
like putting all of the css, html, and JS together in one file, you can do so but leads to a lot of duplication and 
extra work for both the web server and the browser which slows them both down as well. Instead now each extension uses
files with the follow suffixes:
  * Classes - `_class.php`
  * Constants - `_const.php`
  * Interfaces - `_inter.php` Should only be used when there are many interfaces otherwise folding into classes make 
  sense.
  * Functions - `_func.php`
  
In large extensions that also have some additional internal structure like SPL with it's data structures, exceptions,
iterators etc they should be used along with the above suffixes to farther clarify where things go and what they 
contain. Additionally within each file things should be alphabetically sorted so they are easier to find. This doesn't
matter to the IDE but does make it easier for all the humans involved. The above `.idea/codeStyleSettings.xml` file 
include sorting settings as well but the functions and constants have to been done manually. Some additional guidelines
to make things easier to maintain are:

  * Constants should use the newer `const MY_CONST = 'value';` syntax with few exceptions. This should make it easier
  when working with extensions that have both global constants and class constants to do the same thing depending 
  which way you choose to work with it.
  * Class and interface methods should always include visibly modifiers (public, protected) and the same for class 
  properties. This is considered a good practice by most programmers and all coding standards.
  * A single blank line between all classes, interfaces, functions and methods but none need between the constants or
  properties.
  * The first part of each extensions file name should match the abbreviation used by the http://php.net/manual/en/ 
  pages. For example the MySQLi extension is http://php.net/manual/en/book.mysqli.php so the stub file should start 
  with 'mysqli'. In the rare case the extension does not exist on the php.net site a similar style abbreviation 
  should still be used just make sure it doesn't conflict with any that do exist.

So as not to make this short intro any longer please refer to the existing stub files for examples of how things 
should be done. You will find some non-extension related files that are used for PHP built-in classes, constants and 
functions which can be used as references. They are simply named `_class.php` , `_const.php`, and `_func.php` etc. 

[YouTrack]:https://youtrack.jetbrains.com/issues/WI?q=%23Unresolved+%23%7BPHP+lib+stubs%7D+
