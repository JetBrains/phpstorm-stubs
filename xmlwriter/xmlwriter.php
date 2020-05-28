<?php

// Start of xmlwriter v.0.1

class XMLWriter  {

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create new xmlwriter using source uri for output
	 * @link https://php.net/manual/en/function.xmlwriter-open-uri.php
	 * @param string $uri <p>
	 * The URI of the resource for the output.
	 * </p>
	 * @return bool Object oriented style: Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * </p>
	 * <p>
	 * Procedural style: Returns a new xmlwriter resource for later use with the
	 * xmlwriter functions on success, <b>FALSE</b> on error.
	 */
	public function openUri ($uri) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create new xmlwriter using memory for string output
	 * @link https://php.net/manual/en/function.xmlwriter-open-memory.php
	 * @return bool Object oriented style: Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * </p>
	 * <p>
	 * Procedural style: Returns a new xmlwriter resource for later use with the
	 * xmlwriter functions on success, <b>FALSE</b> on error.
	 */
	public function openMemory () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Toggle indentation on/off
	 * @link https://php.net/manual/en/function.xmlwriter-set-indent.php
	 * @param bool $indent <p>
	 * Whether indentation is enabled.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setIndent ($indent) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Set string used for indenting
	 * @link https://php.net/manual/en/function.xmlwriter-set-indent-string.php
	 * @param string $indentString <p>
	 * The indentation string.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function setIndentString ($indentString) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 1.0.0)<br/>
	 * Create start comment
	 * @link https://php.net/manual/en/function.xmlwriter-start-comment.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startComment () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 1.0.0)<br/>
	 * Create end comment
	 * @link https://php.net/manual/en/function.xmlwriter-end-comment.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endComment () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start attribute
	 * @link https://php.net/manual/en/function.xmlwriter-start-attribute.php
	 * @param string $name <p>
	 * The attribute name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startAttribute ($name) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End attribute
	 * @link https://php.net/manual/en/function.xmlwriter-end-attribute.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endAttribute () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full attribute
	 * @link https://php.net/manual/en/function.xmlwriter-write-attribute.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @param string $value <p>
	 * The value of the attribute.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeAttribute ($name, $value) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start namespaced attribute
	 * @link https://php.net/manual/en/function.xmlwriter-start-attribute-ns.php
	 * @param string $prefix <p>
	 * The namespace prefix.
	 * </p>
	 * @param string $name <p>
	 * The attribute name.
	 * </p>
	 * @param string $uri <p>
	 * The namespace URI.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startAttributeNs ($prefix, $name, $uri) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full namespaced attribute
	 * @link https://php.net/manual/en/function.xmlwriter-write-attribute-ns.php
	 * @param string $prefix <p>
	 * The namespace prefix.
	 * </p>
	 * @param string $name <p>
	 * The attribute name.
	 * </p>
	 * @param string $uri <p>
	 * The namespace URI.
	 * </p>
	 * @param string $content <p>
	 * The attribute value.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeAttributeNs ($prefix, $name, $uri, $content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start element tag
	 * @link https://php.net/manual/en/function.xmlwriter-start-element.php
	 * @param string $name <p>
	 * The element name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startElement ($name) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current element
	 * @link https://php.net/manual/en/function.xmlwriter-end-element.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endElement () {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL xmlwriter &gt;= 2.0.4)<br/>
	 * End current element
	 * @link https://php.net/manual/en/function.xmlwriter-full-end-element.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function fullEndElement () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start namespaced element tag
	 * @link https://php.net/manual/en/function.xmlwriter-start-element-ns.php
	 * @param string $prefix <p>
	 * The namespace prefix.
	 * </p>
	 * @param string $name <p>
	 * The element name.
	 * </p>
	 * @param string $uri <p>
	 * The namespace URI.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startElementNs ($prefix, $name, $uri) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full element tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-element.php
	 * @param string $name <p>
	 * The element name.
	 * </p>
	 * @param string $content [optional] <p>
	 * The element contents.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeElement ($name, $content = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full namespaced element tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-element-ns.php
	 * @param string $prefix <p>
	 * The namespace prefix.
	 * </p>
	 * @param string $name <p>
	 * The element name.
	 * </p>
	 * @param string $uri <p>
	 * The namespace URI.
	 * </p>
	 * @param string $content [optional] <p>
	 * The element contents.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeElementNs ($prefix, $name, $uri, $content = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start PI tag
	 * @link https://php.net/manual/en/function.xmlwriter-start-pi.php
	 * @param string $target <p>
	 * The target of the processing instruction.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startPi ($target) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current PI
	 * @link https://php.net/manual/en/function.xmlwriter-end-pi.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endPi () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Writes a PI
	 * @link https://php.net/manual/en/function.xmlwriter-write-pi.php
	 * @param string $target <p>
	 * The target of the processing instruction.
	 * </p>
	 * @param string $content <p>
	 * The content of the processing instruction.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writePi ($target, $content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start CDATA tag
	 * @link https://php.net/manual/en/function.xmlwriter-start-cdata.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startCdata () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current CDATA
	 * @link https://php.net/manual/en/function.xmlwriter-end-cdata.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endCdata () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full CDATA tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-cdata.php
	 * @param string $content <p>
	 * The contents of the CDATA.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeCdata ($content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write text
	 * @link https://php.net/manual/en/function.xmlwriter-text.php
	 * @param string $content <p>
	 * The contents of the text.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function text ($content) {}

	/**
	 * (PHP 5 &gt;= 5.2.0, PECL xmlwriter &gt;= 2.0.4)<br/>
	 * Write a raw XML text
	 * @link https://php.net/manual/en/function.xmlwriter-write-raw.php
	 * @param string $content <p>
	 * The text string to write.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeRaw ($content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create document tag
	 * @link https://php.net/manual/en/function.xmlwriter-start-document.php
	 * @param string $version [optional] <p>
	 * The version number of the document as part of the XML declaration.
	 * </p>
	 * @param string $encoding [optional] <p>
	 * The encoding of the document as part of the XML declaration.
	 * </p>
	 * @param string $standalone [optional] <p>
	 * yes or no.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startDocument ($version = '1.0', $encoding = null, $standalone = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current document
	 * @link https://php.net/manual/en/function.xmlwriter-end-document.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endDocument () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full comment tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-comment.php
	 * @param string $content <p>
	 * The contents of the comment.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeComment ($content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start DTD tag
	 * @link https://php.net/manual/en/function.xmlwriter-start-dtd.php
	 * @param string $qualifiedName <p>
	 * The qualified name of the document type to create.
	 * </p>
	 * @param string $publicId [optional] <p>
	 * The external subset public identifier.
	 * </p>
	 * @param string $systemId [optional] <p>
	 * The external subset system identifier.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startDtd ($qualifiedName, $publicId = null, $systemId = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current DTD
	 * @link https://php.net/manual/en/function.xmlwriter-end-dtd.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endDtd () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full DTD tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-dtd.php
	 * @param string $name <p>
	 * The DTD name.
	 * </p>
	 * @param string $publicId [optional] <p>
	 * The external subset public identifier.
	 * </p>
	 * @param string $systemId [optional] <p>
	 * The external subset system identifier.
	 * </p>
	 * @param string $subset [optional] <p>
	 * The content of the DTD.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeDtd ($name, $publicId = null, $systemId = null, $subset = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start DTD element
	 * @link https://php.net/manual/en/function.xmlwriter-start-dtd-element.php
	 * @param string $qualifiedName <p>
	 * The qualified name of the document type to create.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startDtdElement ($qualifiedName) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current DTD element
	 * @link https://php.net/manual/en/function.xmlwriter-end-dtd-element.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endDtdElement () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full DTD element tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-dtd-element.php
	 * @param string $name <p>
	 * The name of the DTD element.
	 * </p>
	 * @param string $content <p>
	 * The content of the element.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeDtdElement ($name, $content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start DTD AttList
	 * @link https://php.net/manual/en/function.xmlwriter-start-dtd-attlist.php
	 * @param string $name <p>
	 * The attribute list name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startDtdAttlist ($name) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current DTD AttList
	 * @link https://php.net/manual/en/function.xmlwriter-end-dtd-attlist.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endDtdAttlist () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full DTD AttList tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-dtd-attlist.php
	 * @param string $name <p>
	 * The name of the DTD attribute list.
	 * </p>
	 * @param string $content <p>
	 * The content of the DTD attribute list.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeDtdAttlist ($name, $content) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Create start DTD Entity
	 * @link https://php.net/manual/en/function.xmlwriter-start-dtd-entity.php
	 * @param string $name <p>
	 * The name of the entity.
	 * </p>
	 * @param bool $isparam
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function startDtdEntity ($name, $isparam) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * End current DTD Entity
	 * @link https://php.net/manual/en/function.xmlwriter-end-dtd-entity.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function endDtdEntity () {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Write full DTD Entity tag
	 * @link https://php.net/manual/en/function.xmlwriter-write-dtd-entity.php
	 * @param string $name <p>
	 * The name of the entity.
	 * </p>
	 * @param string $content <p>
	 * The content of the entity.
	 * </p>
	 * @param bool $pe
	 * @param string $pubid
	 * @param string $sysid
	 * @param string $ndataid
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function writeDtdEntity ($name, $content, $pe, $pubid, $sysid, $ndataid) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
	 * Returns current buffer
	 * @link https://php.net/manual/en/function.xmlwriter-output-memory.php
	 * @param bool $flush [optional] <p>
	 * Whether to flush the output buffer or not. Default is <b>TRUE</b>.
	 * </p>
	 * @return string the current buffer as a string.
	 */
	public function outputMemory ($flush = true) {}

	/**
	 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 1.0.0)<br/>
	 * Flush current buffer
	 * @link https://php.net/manual/en/function.xmlwriter-flush.php
	 * @param bool $empty [optional] <p>
	 * Whether to empty the buffer or not. Default is <b>TRUE</b>.
	 * </p>
	 * @return mixed If you opened the writer in memory, this function returns the generated XML buffer,
	 * Else, if using URI, this function will write the buffer and return the number of
	 * written bytes.
	 */
	public function flush ($empty = true) {}

}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create new xmlwriter using source uri for output
 * @link https://php.net/manual/en/function.xmlwriter-open-uri.php
 * @param string $uri <p>
 * The URI of the resource for the output.
 * </p>
 * @return bool Object oriented style: Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Procedural style: Returns a new xmlwriter resource for later use with the
 * xmlwriter functions on success, <b>FALSE</b> on error.
 */
function xmlwriter_open_uri ($uri) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create new xmlwriter using memory for string output
 * @link https://php.net/manual/en/function.xmlwriter-open-memory.php
 * @return bool Object oriented style: Returns <b>TRUE</b> on success or <b>FALSE</b> on failure.
 * </p>
 * <p>
 * Procedural style: Returns a new xmlwriter resource for later use with the
 * xmlwriter functions on success, <b>FALSE</b> on error.
 */
function xmlwriter_open_memory () {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Toggle indentation on/off
 * @link https://php.net/manual/en/function.xmlwriter-set-indent.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param bool $indent <p>
 * Whether indentation is enabled.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_set_indent ($xmlwriter, $indent) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Set string used for indenting
 * @link https://php.net/manual/en/function.xmlwriter-set-indent-string.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $indentString <p>
 * The indentation string.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_set_indent_string ($xmlwriter, $indentString) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 1.0.0)<br/>
 * Create start comment
 * @link https://php.net/manual/en/function.xmlwriter-start-comment.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_comment ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 1.0.0)<br/>
 * Create end comment
 * @link https://php.net/manual/en/function.xmlwriter-end-comment.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_comment ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start attribute
 * @link https://php.net/manual/en/function.xmlwriter-start-attribute.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The attribute name.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_attribute ($xmlwriter, $name) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End attribute
 * @link https://php.net/manual/en/function.xmlwriter-end-attribute.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_attribute ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full attribute
 * @link https://php.net/manual/en/function.xmlwriter-write-attribute.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The name of the attribute.
 * </p>
 * @param string $value <p>
 * The value of the attribute.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_attribute ($xmlwriter, $name, $value) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start namespaced attribute
 * @link https://php.net/manual/en/function.xmlwriter-start-attribute-ns.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $prefix <p>
 * The namespace prefix.
 * </p>
 * @param string $name <p>
 * The attribute name.
 * </p>
 * @param string $uri <p>
 * The namespace URI.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_attribute_ns ($xmlwriter, $prefix, $name, $uri) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full namespaced attribute
 * @link https://php.net/manual/en/function.xmlwriter-write-attribute-ns.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $prefix <p>
 * The namespace prefix.
 * </p>
 * @param string $name <p>
 * The attribute name.
 * </p>
 * @param string $uri <p>
 * The namespace URI.
 * </p>
 * @param string $content <p>
 * The attribute value.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_attribute_ns ($xmlwriter, $prefix, $name, $uri, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start element tag
 * @link https://php.net/manual/en/function.xmlwriter-start-element.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The element name.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_element ($xmlwriter, $name) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current element
 * @link https://php.net/manual/en/function.xmlwriter-end-element.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_element ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.2.0, PECL xmlwriter &gt;= 2.0.4)<br/>
 * End current element
 * @link https://php.net/manual/en/function.xmlwriter-full-end-element.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_full_end_element ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start namespaced element tag
 * @link https://php.net/manual/en/function.xmlwriter-start-element-ns.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $prefix <p>
 * The namespace prefix.
 * </p>
 * @param string $name <p>
 * The element name.
 * </p>
 * @param string $uri <p>
 * The namespace URI.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_element_ns ($xmlwriter, $prefix, $name, $uri) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full element tag
 * @link https://php.net/manual/en/function.xmlwriter-write-element.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The element name.
 * </p>
 * @param string $content [optional] <p>
 * The element contents.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_element ($xmlwriter, $name, $content = null) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full namespaced element tag
 * @link https://php.net/manual/en/function.xmlwriter-write-element-ns.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $prefix <p>
 * The namespace prefix.
 * </p>
 * @param string $name <p>
 * The element name.
 * </p>
 * @param string $uri <p>
 * The namespace URI.
 * </p>
 * @param string $content [optional] <p>
 * The element contents.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_element_ns ($xmlwriter, $prefix, $name, $uri, $content = null) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start PI tag
 * @link https://php.net/manual/en/function.xmlwriter-start-pi.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $target <p>
 * The target of the processing instruction.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_pi ($xmlwriter, $target) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current PI
 * @link https://php.net/manual/en/function.xmlwriter-end-pi.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_pi ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Writes a PI
 * @link https://php.net/manual/en/function.xmlwriter-write-pi.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $target <p>
 * The target of the processing instruction.
 * </p>
 * @param string $content <p>
 * The content of the processing instruction.
 * </p>
 *
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_pi ($xmlwriter, $target, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start CDATA tag
 * @link https://php.net/manual/en/function.xmlwriter-start-cdata.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_cdata ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current CDATA
 * @link https://php.net/manual/en/function.xmlwriter-end-cdata.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_cdata ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full CDATA tag
 * @link https://php.net/manual/en/function.xmlwriter-write-cdata.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $content <p>
 * The contents of the CDATA.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_cdata ($xmlwriter, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write text
 * @link https://php.net/manual/en/function.xmlwriter-text.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $content <p>
 * The contents of the text.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_text ($xmlwriter, $content) {}

/**
 * (PHP 5 &gt;= 5.2.0, PECL xmlwriter &gt;= 2.0.4)<br/>
 * Write a raw XML text
 * @link https://php.net/manual/en/function.xmlwriter-write-raw.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $content <p>
 * The text string to write.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_raw ($xmlwriter, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create document tag
 * @link https://php.net/manual/en/function.xmlwriter-start-document.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $version [optional] <p>
 * The version number of the document as part of the XML declaration.
 * </p>
 * @param string $encoding [optional] <p>
 * The encoding of the document as part of the XML declaration.
 * </p>
 * @param string $standalone [optional] <p>
 * yes or no.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_document ($xmlwriter, $version = '1.0', $encoding = null, $standalone = null) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current document
 * @link https://php.net/manual/en/function.xmlwriter-end-document.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_document ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full comment tag
 * @link https://php.net/manual/en/function.xmlwriter-write-comment.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $content <p>
 * The contents of the comment.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_comment ($xmlwriter, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start DTD tag
 * @link https://php.net/manual/en/function.xmlwriter-start-dtd.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $qualifiedName <p>
 * The qualified name of the document type to create.
 * </p>
 * @param string $publicId [optional] <p>
 * The external subset public identifier.
 * </p>
 * @param string $systemId [optional] <p>
 * The external subset system identifier.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_dtd ($xmlwriter, $qualifiedName, $publicId = null, $systemId = null) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current DTD
 * @link https://php.net/manual/en/function.xmlwriter-end-dtd.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_dtd ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full DTD tag
 * @link https://php.net/manual/en/function.xmlwriter-write-dtd.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The DTD name.
 * </p>
 * @param string $publicId [optional] <p>
 * The external subset public identifier.
 * </p>
 * @param string $systemId [optional] <p>
 * The external subset system identifier.
 * </p>
 * @param string $subset [optional] <p>
 * The content of the DTD.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_dtd ($xmlwriter, $name, $publicId = null, $systemId = null, $subset = null) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start DTD element
 * @link https://php.net/manual/en/function.xmlwriter-start-dtd-element.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $qualifiedName <p>
 * The qualified name of the document type to create.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_dtd_element ($xmlwriter, $qualifiedName) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current DTD element
 * @link https://php.net/manual/en/function.xmlwriter-end-dtd-element.php
 * @param $xmlwriter
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_dtd_element ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full DTD element tag
 * @link https://php.net/manual/en/function.xmlwriter-write-dtd-element.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The name of the DTD element.
 * </p>
 * @param string $content <p>
 * The content of the element.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_dtd_element ($xmlwriter, $name, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start DTD AttList
 * @link https://php.net/manual/en/function.xmlwriter-start-dtd-attlist.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The attribute list name.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_dtd_attlist ($xmlwriter, $name) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current DTD AttList
 * @link https://php.net/manual/en/function.xmlwriter-end-dtd-attlist.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_dtd_attlist ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full DTD AttList tag
 * @link https://php.net/manual/en/function.xmlwriter-write-dtd-attlist.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The name of the DTD attribute list.
 * </p>
 * @param string $content <p>
 * The content of the DTD attribute list.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_dtd_attlist ($xmlwriter, $name, $content) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Create start DTD Entity
 * @link https://php.net/manual/en/function.xmlwriter-start-dtd-entity.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The name of the entity.
 * </p>
 * @param bool $isparam
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_start_dtd_entity ($xmlwriter, $name, $isparam) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * End current DTD Entity
 * @link https://php.net/manual/en/function.xmlwriter-end-dtd-entity.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p> * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_end_dtd_entity ($xmlwriter) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Write full DTD Entity tag
 * @link https://php.net/manual/en/function.xmlwriter-write-dtd-entity.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param string $name <p>
 * The name of the entity.
 * </p>
 * @param string $content <p>
 * The content of the entity.
 * </p>
 * @param bool $pe
 * @param string $pubid
 * @param string $sysid
 * @param string $ndataid
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function xmlwriter_write_dtd_entity ($xmlwriter, $name, $content, $pe, $pubid, $sysid, $ndataid) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 0.1.0)<br/>
 * Returns current buffer
 * @link https://php.net/manual/en/function.xmlwriter-output-memory.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param bool $flush [optional] <p>
 * Whether to flush the output buffer or not. Default is <b>TRUE</b>.
 * </p>
 * @return string the current buffer as a string.
 */
function xmlwriter_output_memory ($xmlwriter, $flush = true) {}

/**
 * (PHP 5 &gt;= 5.1.2, PECL xmlwriter &gt;= 1.0.0)<br/>
 * Flush current buffer
 * @link https://php.net/manual/en/function.xmlwriter-flush.php
 * @param resource $xmlwriter
 * <p>Only for procedural calls.
 * The XMLWriter {@link https://php.net/manual/en/language.types.resource.php" resource} that is being modified.
 * This resource comes from a call to {@link https://php.net/manual/en/function.xmlwriter-open-uri.php" xmlwriter_open_uri()}
 * or {@link https://php.net/manual/en/function.xmlwriter-open-memory.php" xmlwriter_open_memory()}.</p>
 * @param bool $empty [optional] <p>
 * Whether to empty the buffer or not. Default is <b>TRUE</b>.
 * </p>
 * @return mixed If you opened the writer in memory, this function returns the generated XML buffer,
 * Else, if using URI, this function will write the buffer and return the number of
 * written bytes.
 */
function xmlwriter_flush ($xmlwriter, $empty = true) {}
