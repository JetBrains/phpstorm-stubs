<?php
/**
 * PHPStorm stub file for Tidy classes.
 *
 * @link http://php.net/manual/en/book.tidy.php
 */

/**
 * An HTML node in an HTML file, as detected by tidy.
 *
 * @link http://php.net/manual/en/class.tidy.php
 */
class tidy
{
    /**
     * @var string  The last warnings and errors from TidyLib
     */
    public $errorBuffer;

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Constructs a new <b>tidy</b> object
     *
     * @link http://php.net/manual/en/tidy.construct.php
     *
     * @param string $filename         [optional] <p>
     *                                 If the <i>filename</i> parameter is given, this function
     *                                 will also read that file and initialize the object with the file,
     *                                 acting like <b>tidy_parse_file</b>.
     *                                 </p>
     * @param mixed  $config           [optional] <p>
     *                                 The config <i>config</i> can be passed either as an
     *                                 array or as a string. If a string is passed, it is interpreted as the
     *                                 name of the configuration file, otherwise, it is interpreted as the
     *                                 options themselves.
     *                                 </p>
     *                                 <p>
     *                                 For an explanation about each option, visit
     *                                 http://tidy.sourceforge.net/docs/quickref.html.
     *                                 </p>
     * @param string $encoding         [optional] <p>
     *                                 The <i>encoding</i> parameter sets the encoding for
     *                                 input/output documents. The possible values for encoding are:
     *                                 ascii, latin0, latin1,
     *                                 raw, utf8, iso2022,
     *                                 mac, win1252, ibm858,
     *                                 utf16, utf16le, utf16be,
     *                                 big5, and shiftjis.
     *                                 </p>
     * @param bool   $use_include_path [optional] <p>
     *                                 Search for the file in the include_path.
     *                                 </p>
     */
    public function __construct($filename = null, $config = null, $encoding = null, $use_include_path = null) { }

    /**
     * (PHP 5, PECL tidy 0.5.2-1.0)<br/>
     * Returns a <b>tidyNode</b> object starting from the &lt;body&gt; tag of the tidy parse tree
     *
     * @link http://php.net/manual/en/tidy.body.php
     * @return tidyNode a <b>tidyNode</b> object starting from the
     * &lt;body&gt; tag of the tidy parse tree.
     */
    public function body() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Execute configured cleanup and repair operations on parsed markup
     *
     * @link http://php.net/manual/en/tidy.cleanrepair.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function cleanRepair() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Run configured diagnostics on parsed and repaired markup
     *
     * @link http://php.net/manual/en/tidy.diagnose.php
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function diagnose() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.7.0)<br/>
     * Get current Tidy configuration
     *
     * @link http://php.net/manual/en/tidy.getconfig.php
     * @return array an array of configuration options.
     * </p>
     * <p>
     * For an explanation about each option, visit http://tidy.sourceforge.net/docs/quickref.html.
     */
    public function getConfig() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Get the Detected HTML version for the specified document
     *
     * @link http://php.net/manual/en/tidy.gethtmlver.php
     * @return int the detected HTML version.
     * </p>
     * <p>
     * This function is not yet implemented in the Tidylib itself, so it always
     * return 0.
     */
    public function getHtmlVer() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Returns the value of the specified configuration option for the tidy document
     *
     * @link http://php.net/manual/en/tidy.getopt.php
     *
     * @param string $option <p>
     *                       You will find a list with each configuration option and their types
     *                       at: http://tidy.sourceforge.net/docs/quickref.html.
     *                       </p>
     *
     * @return mixed the value of the specified <i>option</i>.
     * The return type depends on the type of the specified one.
     */
    public function getOpt($option) { }

    /**
     * Returns the documentation for the given option name
     *
     * @link  http://php.net/manual/en/tidy.getoptdoc.php
     *
     * @param string $optname <p>
     *                        The option name
     *                        </p>
     *
     * @return string a string if the option exists and has documentation available, or
     * <b>FALSE</b> otherwise.
     * @since 5.1.0
     */
    public function getOptDoc($optname) { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Get release date (version) for Tidy library
     *
     * @link http://php.net/manual/en/tidy.getrelease.php
     * @return string a string with the release date of the Tidy library.
     */
    public function getRelease() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Get status of specified document
     *
     * @link http://php.net/manual/en/tidy.getstatus.php
     * @return int 0 if no error/warning was raised, 1 for warnings or accessibility
     * errors, or 2 for errors.
     */
    public function getStatus() { }

    /**
     * (PHP 5, PECL tidy 0.5.2-1.0.0)<br/>
     * Returns a <b>tidyNode</b> object starting from the &lt;head&gt; tag of the tidy parse tree
     *
     * @link http://php.net/manual/en/tidy.head.php
     * @return tidyNode the <b>tidyNode</b> object.
     */
    public function head() { }

    /**
     * (PHP 5, PECL tidy 0.5.2-1.0.0)<br/>
     * Returns a <b>tidyNode</b> object starting from the &lt;html&gt; tag of the tidy parse tree
     *
     * @link http://php.net/manual/en/tidy.html.php
     * @return tidyNode the <b>tidyNode</b> object.
     */
    public function html() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Indicates if the document is a XHTML document
     *
     * @link http://php.net/manual/en/tidy.isxhtml.php
     * @return bool This function returns <b>TRUE</b> if the specified tidy
     * <i>object</i> is a XHTML document, or <b>FALSE</b> otherwise.
     * </p>
     * <p>
     * This function is not yet implemented in the Tidylib itself, so it always
     * return <b>FALSE</b>.
     */
    public function isXhtml() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Indicates if the document is a generic (non HTML/XHTML) XML document
     *
     * @link http://php.net/manual/en/tidy.isxml.php
     * @return bool This function returns <b>TRUE</b> if the specified tidy
     * <i>object</i> is a generic XML document (non HTML/XHTML),
     * or <b>FALSE</b> otherwise.
     * </p>
     * <p>
     * This function is not yet implemented in the Tidylib itself, so it always
     * return <b>FALSE</b>.
     */
    public function isXml() { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Parse markup in file or URI
     *
     * @link http://php.net/manual/en/tidy.parsefile.php
     *
     * @param string $filename         <p>
     *                                 If the <i>filename</i> parameter is given, this function
     *                                 will also read that file and initialize the object with the file,
     *                                 acting like <b>tidy_parse_file</b>.
     *                                 </p>
     * @param mixed  $config           [optional] <p>
     *                                 The config <i>config</i> can be passed either as an
     *                                 array or as a string. If a string is passed, it is interpreted as the
     *                                 name of the configuration file, otherwise, it is interpreted as the
     *                                 options themselves.
     *                                 </p>
     *                                 <p>
     *                                 For an explanation about each option, see
     *                                 http://tidy.sourceforge.net/docs/quickref.html.
     *                                 </p>
     * @param string $encoding         [optional] <p>
     *                                 The <i>encoding</i> parameter sets the encoding for
     *                                 input/output documents. The possible values for encoding are:
     *                                 ascii, latin0, latin1,
     *                                 raw, utf8, iso2022,
     *                                 mac, win1252, ibm858,
     *                                 utf16, utf16le, utf16be,
     *                                 big5, and shiftjis.
     *                                 </p>
     * @param bool   $use_include_path [optional] <p>
     *                                 Search for the file in the include_path.
     *                                 </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function parseFile($filename, $config = null, $encoding = null, $use_include_path = false) { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.5.2)<br/>
     * Parse a document stored in a string
     *
     * @link http://php.net/manual/en/tidy.parsestring.php
     *
     * @param string $input    <p>
     *                         The data to be parsed.
     *                         </p>
     * @param mixed  $config   [optional] <p>
     *                         The config <i>config</i> can be passed either as an
     *                         array or as a string. If a string is passed, it is interpreted as the
     *                         name of the configuration file, otherwise, it is interpreted as the
     *                         options themselves.
     *                         </p>
     *                         <p>
     *                         For an explanation about each option, visit
     *                         http://tidy.sourceforge.net/docs/quickref.html.
     *                         </p>
     * @param string $encoding [optional] <p>
     *                         The <i>encoding</i> parameter sets the encoding for
     *                         input/output documents. The possible values for encoding are:
     *                         ascii, latin0, latin1,
     *                         raw, utf8, iso2022,
     *                         mac, win1252, ibm858,
     *                         utf16, utf16le, utf16be,
     *                         big5, and shiftjis.
     *                         </p>
     *
     * @return bool a new <b>tidy</b> instance.
     */
    public function parseString($input, $config = null, $encoding = null) { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.7.0)<br/>
     * Repair a file and return it as a string
     *
     * @link http://php.net/manual/en/tidy.repairfile.php
     *
     * @param string $filename         <p>
     *                                 The file to be repaired.
     *                                 </p>
     * @param mixed  $config           [optional] <p>
     *                                 The config <i>config</i> can be passed either as an
     *                                 array or as a string. If a string is passed, it is interpreted as the
     *                                 name of the configuration file, otherwise, it is interpreted as the
     *                                 options themselves.
     *                                 </p>
     *                                 <p>
     *                                 Check http://tidy.sourceforge.net/docs/quickref.html for an
     *                                 explanation about each option.
     *                                 </p>
     * @param string $encoding         [optional] <p>
     *                                 The <i>encoding</i> parameter sets the encoding for
     *                                 input/output documents. The possible values for encoding are:
     *                                 ascii, latin0, latin1,
     *                                 raw, utf8, iso2022,
     *                                 mac, win1252, ibm858,
     *                                 utf16, utf16le, utf16be,
     *                                 big5, and shiftjis.
     *                                 </p>
     * @param bool   $use_include_path [optional] <p>
     *                                 Search for the file in the include_path.
     *                                 </p>
     *
     * @return string the repaired contents as a string.
     */
    public function repairFile($filename, $config = null, $encoding = null, $use_include_path = false) { }

    /**
     * (PHP 5, PECL tidy &gt;= 0.7.0)<br/>
     * Repair a string using an optionally provided configuration file
     *
     * @link http://php.net/manual/en/tidy.repairstring.php
     *
     * @param string $data     <p>
     *                         The data to be repaired.
     *                         </p>
     * @param mixed  $config   [optional] <p>
     *                         The config <i>config</i> can be passed either as an
     *                         array or as a string. If a string is passed, it is interpreted as the
     *                         name of the configuration file, otherwise, it is interpreted as the
     *                         options themselves.
     *                         </p>
     *                         <p>
     *                         Check http://tidy.sourceforge.net/docs/quickref.html for
     *                         an explanation about each option.
     *                         </p>
     * @param string $encoding [optional] <p>
     *                         The <i>encoding</i> parameter sets the encoding for
     *                         input/output documents. The possible values for encoding are:
     *                         ascii, latin0, latin1,
     *                         raw, utf8, iso2022,
     *                         mac, win1252, ibm858,
     *                         utf16, utf16le, utf16be,
     *                         big5, and shiftjis.
     *                         </p>
     *
     * @return string the repaired string.
     */
    public function repairString($data, $config = null, $encoding = null) { }

    /**
     * (PHP 5, PECL tidy 0.5.2-1.0.0)<br/>
     * Returns a <b>tidyNode</b> object representing the root of the tidy parse tree
     *
     * @link http://php.net/manual/en/tidy.root.php
     * @return tidyNode the <b>tidyNode</b> object.
     */
    public function root() { }
}

/**
 * An HTML node in an HTML file, as detected by tidy.
 *
 * @link http://php.net/manual/en/class.tidynode.php
 */
final class tidyNode
{
    /**
     * <p style="margin-top:0;">
     * An array of string, representing
     * the attributes names (as keys) of the current node.
     * </p>
     *
     * @var array
     */
    public $attribute;
    /**
     * <p style="margin-top:0;">
     * An array of <b>tidyNode</b>, representing
     * the children of the current node.
     * </p>
     *
     * @var array
     */
    public $child;
    /**
     * <p style="margin-top:0;">The column number at which the tags is located in the file</p>
     *
     * @var int
     */
    public $column;
    /**
     * <p style="margin-top:0;">The ID of the tag (one of the constants above, e.g.
     * <b><code>TIDY_TAG_FRAME</code></b>)</p>
     *
     * @var int
     */
    public $id;
    /**
     * <p style="margin-top:0;">The line number at which the tags is located in the file</p>
     *
     * @var int
     */
    public $line;
    /**
     * <p style="margin-top:0;">The name of the HTML node</p>
     *
     * @var string
     */
    public $name;
    /**
     * <p style="margin-top:0;">Indicates if the node is a proprietary tag</p>
     *
     * @var bool
     */
    public $proprietary;
    /**
     * <p style="margin-top:0;">The type of the tag (one of the constants above, e.g.
     * <b><code>TIDY_NODETYPE_PHP</code></b>)</p>
     *
     * @var int
     */
    public $type;
    /**
     * <p style="margin-top:0;">The HTML representation of the node, including the surrounding tags.</p>
     *
     * @var string
     */
    public $value;

    private function __construct() { }

    /**
     * Returns the parent node of the current node
     *
     * @link  http://php.net/manual/en/tidynode.getparent.php
     * @return tidyNode a tidyNode if the node has a parent, or <b>NULL</b>
     * otherwise.
     * @since 5.2.2
     */
    public function getParent() { }

    /**
     * Checks if a node has children
     *
     * @link  http://php.net/manual/en/tidynode.haschildren.php
     * @return bool <b>TRUE</b> if the node has children, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function hasChildren() { }

    /**
     * Checks if a node has siblings
     *
     * @link  http://php.net/manual/en/tidynode.hassiblings.php
     * @return bool <b>TRUE</b> if the node has siblings, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function hasSiblings() { }

    /**
     * Checks if this node is ASP
     *
     * @link  http://php.net/manual/en/tidynode.isasp.php
     * @return bool <b>TRUE</b> if the node is ASP, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function isAsp() { }

    /**
     * Checks if a node represents a comment
     *
     * @link  http://php.net/manual/en/tidynode.iscomment.php
     * @return bool <b>TRUE</b> if the node is a comment, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function isComment() { }

    /**
     * Checks if a node is part of a HTML document
     *
     * @link  http://php.net/manual/en/tidynode.ishtml.php
     * @return bool <b>TRUE</b> if the node is part of a HTML document, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function isHtml() { }

    /**
     * Checks if this node is JSTE
     *
     * @link  http://php.net/manual/en/tidynode.isjste.php
     * @return bool <b>TRUE</b> if the node is JSTE, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function isJste() { }

    /**
     * Checks if a node is PHP
     *
     * @link  http://php.net/manual/en/tidynode.isphp.php
     * @return bool <b>TRUE</b> if the current node is PHP code, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function isPhp() { }

    /**
     * Checks if a node represents text (no markup)
     *
     * @link  http://php.net/manual/en/tidynode.istext.php
     * @return bool <b>TRUE</b> if the node represent a text, <b>FALSE</b> otherwise.
     * @since 5.0.1
     */
    public function isText() { }
}
