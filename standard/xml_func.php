<?php
/**
 * PHPStorm stub file for XML Parser functions.
 *
 * @link http://php.net/manual/en/book.xml.php
 */

/**
 * Converts a string with ISO-8859-1 characters encoded with UTF-8
 *
 * @since 4.0
 * @since 5.0
 * to single-byte ISO-8859-1
 * @link  http://php.net/manual/en/function.utf8-decode.php
 *
 * @param string $data <p>
 *                     An UTF-8 encoded string.
 *                     </p>
 *
 * @return string the ISO-8859-1 translation of <i>data</i>.
 */
function utf8_decode($data) { }

/**
 * Encodes an ISO-8859-1 string to UTF-8
 *
 * @link  http://php.net/manual/en/function.utf8-encode.php
 *
 * @param string $data <p>
 *                     An ISO-8859-1 string.
 *                     </p>
 *
 * @return string the UTF-8 translation of <i>data</i>.
 * @since 4.0
 * @since 5.0
 */
function utf8_encode($data) { }

/**
 * Get XML parser error string
 *
 * @link  http://php.net/manual/en/function.xml-error-string.php
 *
 * @param int $code <p>
 *                  An error code from <b>xml_get_error_code</b>.
 *                  </p>
 *
 * @return string a string with a textual description of the error
 * <i>code</i>, or <b>FALSE</b> if no description was found.
 * @since 4.0
 * @since 5.0
 */
function xml_error_string($code) { }

/**
 * Get current byte index for an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-get-current-byte-index.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser to get byte index from.
 *                         </p>
 *
 * @return int This function returns <b>FALSE</b> if <i>parser</i> does
 * not refer to a valid parser, or else it returns which byte index
 * the parser is currently at in its data buffer (starting at 0).
 * @since 4.0
 * @since 5.0
 */
function xml_get_current_byte_index($parser) { }

/**
 * Get current column number for an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-get-current-column-number.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser to get column number from.
 *                         </p>
 *
 * @return int This function returns <b>FALSE</b> if <i>parser</i> does
 * not refer to a valid parser, or else it returns which column on
 * the current line (as given by
 * <b>xml_get_current_line_number</b>) the parser is
 * currently at.
 * @since 4.0
 * @since 5.0
 */
function xml_get_current_column_number($parser) { }

/**
 * Get current line number for an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-get-current-line-number.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser to get line number from.
 *                         </p>
 *
 * @return int This function returns <b>FALSE</b> if <i>parser</i> does
 * not refer to a valid parser, or else it returns which line the
 * parser is currently at in its data buffer.
 * @since 4.0
 * @since 5.0
 */
function xml_get_current_line_number($parser) { }

/**
 * Get XML parser error code
 *
 * @link  http://php.net/manual/en/function.xml-get-error-code.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser to get error code from.
 *                         </p>
 *
 * @return int This function returns <b>FALSE</b> if <i>parser</i> does
 * not refer to a valid parser, or else it returns one of the error
 * codes listed in the error codes
 * section.
 * @since 4.0
 * @since 5.0
 */
function xml_get_error_code($parser) { }

/**
 * Start parsing an XML document
 *
 * @link  http://php.net/manual/en/function.xml-parse.php
 *
 * @param resource $parser   <p>
 *                           A reference to the XML parser to use.
 *                           </p>
 * @param string   $data     <p>
 *                           Chunk of data to parse. A document may be parsed piece-wise by
 *                           calling <b>xml_parse</b> several times with new data,
 *                           as long as the <i>is_final</i> parameter is set and
 *                           <b>TRUE</b> when the last data is parsed.
 *                           </p>
 * @param bool     $is_final [optional] <p>
 *                           If set and <b>TRUE</b>, <i>data</i> is the last piece of
 *                           data sent in this parse.
 *                           </p>
 *
 * @return int 1 on success or 0 on failure.
 * </p>
 * <p>
 * For unsuccessful parses, error information can be retrieved with
 * <b>xml_get_error_code</b>,
 * <b>xml_error_string</b>,
 * <b>xml_get_current_line_number</b>,
 * <b>xml_get_current_column_number</b> and
 * <b>xml_get_current_byte_index</b>.
 * </p>
 * <p>
 * Entity errors are reported at the end of the data thus only if
 * <i>is_final</i> is set and <b>TRUE</b>.
 * @since 4.0
 * @since 5.0
 */
function xml_parse($parser, $data, $is_final = false) { }

/**
 * Parse XML data into an array structure
 *
 * @link  http://php.net/manual/en/function.xml-parse-into-struct.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser.
 *                         </p>
 * @param string   $data   <p>
 *                         A string containing the XML data.
 *                         </p>
 * @param array    $values <p>
 *                         An array containing the values of the XML data
 *                         </p>
 * @param array    $index  [optional] <p>
 *                         An array containing pointers to the location of the appropriate values in the $values.
 *                         </p>
 *
 * @return int <b>xml_parse_into_struct</b> returns 0 for failure and 1 for
 * success. This is not the same as <b>FALSE</b> and <b>TRUE</b>, be careful with
 * operators such as ===.
 * @since 4.0
 * @since 5.0
 */
function xml_parse_into_struct($parser, $data, array &$values, array &$index = null) { }

/**
 * Create an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-parser-create.php
 *
 * @param string $encoding [optional] <p>
 *                         The optional <i>encoding</i> specifies the character
 *                         encoding for the input/output in PHP 4. Starting from PHP 5, the input
 *                         encoding is automatically detected, so that the
 *                         <i>encoding</i> parameter specifies only the output
 *                         encoding. In PHP 4, the default output encoding is the same as the
 *                         input charset. If empty string is passed, the parser attempts to identify
 *                         which encoding the document is encoded in by looking at the heading 3 or
 *                         4 bytes. In PHP 5.0.0 and 5.0.1, the default output charset is
 *                         ISO-8859-1, while in PHP 5.0.2 and upper is UTF-8. The supported
 *                         encodings are ISO-8859-1, UTF-8 and
 *                         US-ASCII.
 *                         </p>
 *
 * @return resource a resource handle for the new XML parser.
 * @since 4.0
 * @since 5.0
 */
function xml_parser_create($encoding = null) { }

/**
 * Create an XML parser with namespace support
 *
 * @link  http://php.net/manual/en/function.xml-parser-create-ns.php
 *
 * @param string $encoding  [optional] <p>
 *                          The optional <i>encoding</i> specifies the character
 *                          encoding for the input/output in PHP 4. Starting from PHP 5, the input
 *                          encoding is automatically detected, so that the
 *                          <i>encoding</i> parameter specifies only the output
 *                          encoding. In PHP 4, the default output encoding is the same as the
 *                          input charset. In PHP 5.0.0 and 5.0.1, the default output charset is
 *                          ISO-8859-1, while in PHP 5.0.2 and upper is UTF-8. The supported
 *                          encodings are ISO-8859-1, UTF-8 and
 *                          US-ASCII.
 *                          </p>
 * @param string $separator [optional] <p>
 *                          With a namespace aware parser tag parameters passed to the various
 *                          handler functions will consist of namespace and tag name separated by
 *                          the string specified in <i>separator</i>.
 *                          </p>
 *
 * @return resource a resource handle for the new XML parser.
 * @since 4.0.5
 * @since 5.0
 */
function xml_parser_create_ns($encoding = null, $separator = ':') { }

/**
 * Free an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-parser-free.php
 *
 * @param resource $parser A reference to the XML parser to free.
 *
 * @return bool This function returns <b>FALSE</b> if <i>parser</i> does not
 * refer to a valid parser, or else it frees the parser and returns <b>TRUE</b>.
 * @since 4.0
 * @since 5.0
 */
function xml_parser_free($parser) { }

/**
 * Get options from an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-parser-get-option.php
 *
 * @param resource $parser A reference to the XML parser to get an option from.
 * @param int      $option Which option to fetch. <b>XML_OPTION_CASE_FOLDING</b>
 *                         and <b>XML_OPTION_TARGET_ENCODING</b> are available.
 *                         See <b>xml_parser_set_option</b> for their description.
 *
 * @return mixed This function returns <b>FALSE</b> if <i>parser</i> does
 * not refer to a valid parser or if <i>option</i> isn't
 * valid (generates also a <b>E_WARNING</b>).
 * Else the option's value is returned.
 * @since 4.0
 * @since 5.0
 */
function xml_parser_get_option($parser, $option) { }

/**
 * Set options in an XML parser
 *
 * @link  http://php.net/manual/en/function.xml-parser-set-option.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser to set an option in.
 *                         </p>
 * @param int      $option <p>
 *                         Which option to set. See below.
 *                         </p>
 *                         <p>
 *                         The following options are available:
 *                         <table>
 *                         XML parser options
 *                         <tr valign="top">
 *                         <td>Option constant</td>
 *                         <td>Data type</td>
 *                         <td>Description</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td><b>XML_OPTION_CASE_FOLDING</b></td>
 *                         <td>integer</td>
 *                         <td>
 *                         Controls whether case-folding is enabled for this
 *                         XML parser. Enabled by default.
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td><b>XML_OPTION_SKIP_TAGSTART</b></td>
 *                         <td>integer</td>
 *                         <td>
 *                         Specify how many characters should be skipped in the beginning of a
 *                         tag name.
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td><b>XML_OPTION_SKIP_WHITE</b></td>
 *                         <td>integer</td>
 *                         <td>
 *                         Whether to skip values consisting of whitespace characters.
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td><b>XML_OPTION_TARGET_ENCODING</b></td>
 *                         <td>string</td>
 *                         <td>
 *                         Sets which target encoding to
 *                         use in this XML parser.By default, it is set to the same as the
 *                         source encoding used by <b>xml_parser_create</b>.
 *                         Supported target encodings are ISO-8859-1,
 *                         US-ASCII and UTF-8.
 *                         </td>
 *                         </tr>
 *                         </table>
 *                         </p>
 * @param mixed    $value  <p>
 *                         The option's new value.
 *                         </p>
 *
 * @return bool This function returns <b>FALSE</b> if <i>parser</i> does not
 * refer to a valid parser, or if the option could not be set. Else the
 * option is set and <b>TRUE</b> is returned.
 * @since 4.0
 * @since 5.0
 */
function xml_parser_set_option($parser, $option, $value) { }

/**
 * Set up character data handler
 *
 * @link  http://php.net/manual/en/function.xml-set-character-data-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser to set up character data handler function.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          two parameters:
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>data</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_character_data_handler($parser, callable $handler) { }

/**
 * Set up default handler
 *
 * @link  http://php.net/manual/en/function.xml-set-default-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser to set up default handler function.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          two parameters:
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>data</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_default_handler($parser, callable $handler) { }

/**
 * Set up start and end element handlers
 *
 * @link  http://php.net/manual/en/function.xml-set-element-handler.php
 *
 * @param resource $parser                <p>
 *                                        A reference to the XML parser to set up start and end element handler
 *                                        functions.
 *                                        </p>
 * @param callable $start_element_handler <p>
 *                                        The function named by <i>start_element_handler</i>
 *                                        must accept three parameters:
 *                                        <b>start_element_handler</b>
 *                                        <b>resource<i>parser</i></b>
 *                                        <b>string<i>name</i></b>
 *                                        <b>array<i>attribs</i></b>
 *                                        <i>parser</i>
 *                                        The first parameter, parser, is a
 *                                        reference to the XML parser calling the handler.
 * @param callable $end_element_handler   <p>
 *                                        The function named by <i>end_element_handler</i>
 *                                        must accept two parameters:
 *                                        <b>end_element_handler</b>
 *                                        <b>resource<i>parser</i></b>
 *                                        <b>string<i>name</i></b>
 *                                        <i>parser</i>
 *                                        The first parameter, parser, is a
 *                                        reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_element_handler($parser, callable $start_element_handler, callable $end_element_handler) { }

/**
 * Set up end namespace declaration handler
 *
 * @link  http://php.net/manual/en/function.xml-set-end-namespace-decl-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          two parameters, and should return an integer value. If the
 *                          value returned from the handler is <b>FALSE</b> (which it will be if no
 *                          value is returned), the XML parser will stop parsing and
 *                          <b>xml_get_error_code</b> will return
 *                          <b>XML_ERROR_EXTERNAL_ENTITY_HANDLING</b>.
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>prefix</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.5
 * @since 5.0
 */
function xml_set_end_namespace_decl_handler($parser, callable $handler) { }

/**
 * Set up external entity reference handler
 *
 * @link  http://php.net/manual/en/function.xml-set-external-entity-ref-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser to set up external entity reference handler function.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          five parameters, and should return an integer value.If the
 *                          value returned from the handler is <b>FALSE</b> (which it will be if no
 *                          value is returned), the XML parser will stop parsing and
 *                          <b>xml_get_error_code</b> will return
 *                          <b>XML_ERROR_EXTERNAL_ENTITY_HANDLING</b>.
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>open_entity_names</i></b>
 *                          <b>string<i>base</i></b>
 *                          <b>string<i>system_id</i></b>
 *                          <b>string<i>public_id</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_external_entity_ref_handler($parser, callable $handler) { }

/**
 * Set up notation declaration handler
 *
 * @link  http://php.net/manual/en/function.xml-set-notation-decl-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser to set up notation declaration handler function.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          five parameters:
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>notation_name</i></b>
 *                          <b>string<i>base</i></b>
 *                          <b>string<i>system_id</i></b>
 *                          <b>string<i>public_id</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_notation_decl_handler($parser, callable $handler) { }

/**
 * Use XML Parser within an object
 *
 * @link  http://php.net/manual/en/function.xml-set-object.php
 *
 * @param resource $parser <p>
 *                         A reference to the XML parser to use inside the object.
 *                         </p>
 * @param object   $object <p>
 *                         The object where to use the XML parser.
 *                         </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_object($parser, &$object) { }

/**
 * Set up processing instruction (PI) handler
 *
 * @link  http://php.net/manual/en/function.xml-set-processing-instruction-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser to set up processing instruction (PI) handler function.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          three parameters:
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>target</i></b>
 *                          <b>string<i>data</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_processing_instruction_handler($parser, callable $handler) { }

/**
 * Set up start namespace declaration handler
 *
 * @link  http://php.net/manual/en/function.xml-set-start-namespace-decl-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept
 *                          three parameters, and should return an integer value. If the
 *                          value returned from the handler is <b>FALSE</b> (which it will be if no
 *                          value is returned), the XML parser will stop parsing and
 *                          <b>xml_get_error_code</b> will return
 *                          <b>XML_ERROR_EXTERNAL_ENTITY_HANDLING</b>.
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>prefix</i></b>
 *                          <b>string<i>uri</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0.5
 * @since 5.0
 */
function xml_set_start_namespace_decl_handler($parser, callable $handler) { }

/**
 * Set up unparsed entity declaration handler
 *
 * @link  http://php.net/manual/en/function.xml-set-unparsed-entity-decl-handler.php
 *
 * @param resource $parser  <p>
 *                          A reference to the XML parser to set up unparsed entity declaration handler function.
 *                          </p>
 * @param callable $handler <p>
 *                          <i>handler</i> is a string containing the name of a
 *                          function that must exist when <b>xml_parse</b> is called
 *                          for <i>parser</i>.
 *                          </p>
 *                          <p>
 *                          The function named by <i>handler</i> must accept six
 *                          parameters:
 *                          <b>handler</b>
 *                          <b>resource<i>parser</i></b>
 *                          <b>string<i>entity_name</i></b>
 *                          <b>string<i>base</i></b>
 *                          <b>string<i>system_id</i></b>
 *                          <b>string<i>public_id</i></b>
 *                          <b>string<i>notation_name</i></b>
 *                          <i>parser</i>
 *                          The first parameter, parser, is a
 *                          reference to the XML parser calling the
 *                          handler.
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * @since 4.0
 * @since 5.0
 */
function xml_set_unparsed_entity_decl_handler($parser, callable $handler) { }
