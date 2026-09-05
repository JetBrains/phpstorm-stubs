<?php

use JetBrains\PhpStorm\Deprecated;

class PDFlib
{
    /**
     * Activates a previously created structure element or other content item.
     * @param int $id
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-activate-item
     */
    public function activate_item($id) {}

    /**
     * Adds a link to a web resource.
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     * @param string $filename
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-launchlink
     * @see PDF_create_action()
     */
    #[Deprecated(" This function is deprecated since PDFlib version 6, use PDF_create_action() with type=Launch and PDF_create_annotation() with type=Link instead.")]
    public function add_launchlink($llx, $lly, $urx, $ury, $filename) {}

    /**
     * Add a link annotation to a target within the current PDF file.
     *
     * @param float $lowerleftx
     * @param float $lowerlefty
     * @param float $upperrightx
     * @param float $upperrighty
     * @param int $page
     * @param string $dest
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-locallink
     * @see PDF_create_action()
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoTo and PDF_create_annotation() with type=Link instead.')]
    public function add_locallink($lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $page, $dest) {}

    /**
     * Creates a named destination on an arbitrary page in the current document.
     *
     * @param string $name
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-nameddest
     */
    public function add_nameddest($name, $optlist) {}

    /**
     * Sets an annotation for the current page.
     *
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     * @param string $contents
     * @param string $title
     * @param string $icon
     * @param int $open
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-note
     * @see PDF_create_annotation()
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=Text instead.')]
    public function add_note($llx, $lly, $urx, $ury, $contents, $title, $icon, $open) {}

    /**
     * Add a file link annotation to a PDF target.
     *
     * @param float $bottom_left_x
     * @param float $bottom_left_y
     * @param float $up_right_x
     * @param float $up_right_y
     * @param string $filename
     * @param int $page
     * @param string $dest
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-pdflink
     * @see PDF_create_action
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoToR and PDF_create_annotation() with type=Link instead.')]
    public function add_pdflink($bottom_left_x, $bottom_left_y, $up_right_x, $up_right_y, $filename, $page, $dest) {}

    /**
     * Adds a cell to a new or existing table.
     *
     * @param int $table
     * @param int $column
     * @param int $row
     * @param string $text
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-table-cell
     */
    public function add_table_cell($table, $column, $row, $text, $optlist) {}

    /**
     * Creates a Textflow object, or adds text and explicit options to an existing Textflow.
     *
     * @param int $textflow
     * @param string $text
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-textflow
     */
    public function add_textflow($textflow, $text, $optlist) {}

    /**
     * Adds an existing image as thumbnail for the current page.
     *
     * @param int $image
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-thumbnail
     */
    public function add_thumbnail($image) {}

    /**
     * Adds a weblink annotation to a target url on the Web.
     *
     * @param float $lowerleftx
     * @param float $lowerlefty
     * @param float $upperrightx
     * @param float $upperrighty
     * @param string $url
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-weblink
     * @see PDF_create_action()
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=URI and PDF_create_annotation() with type=Link instead.')]
    public function add_weblink($lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $url) {}

    /**
     * Adds a counterclockwise circular arc
     *
     * @param float $x
     * @param float $y
     * @param float $r
     * @param float $alpha
     * @param float $beta
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-arc
     */
    public function arc($x, $y, $r, $alpha, $beta) {}

    /**
     * Except for the drawing direction, this function behaves exactly like PDF_arc().
     *
     * @param float $x
     * @param float $y
     * @param float $r
     * @param float $alpha
     * @param float $beta
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-arcn
     */
    public function arcn($x, $y, $r, $alpha, $beta) {}

    /**
     * Adds a file attachment annotation.
     *
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     * @param string $filename
     * @param string $description
     * @param string $author
     * @param string $mimetype
     * @param string $icon
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-attach-file
     * @see PDF_create_annotation()
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=FileAttachment instead.')]
    public function attach_file($llx, $lly, $urx, $ury, $filename, $description, $author, $mimetype, $icon) {}

    /**
     * Creates a new PDF file subject to various options.
     *
     * @param string $filename
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-document
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.1.2-API-reference.pdf
     */
    public function begin_document($filename, $optlist) {}

    /**
     * Starts a Type 3 font definition.
     *
     * @param string $filename
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @param float $e
     * @param float $f
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-font
     */
    public function begin_font($filename, $a, $b, $c, $d, $e, $f, $optlist) {}

    /**
     * Starts a glyph definition for a Type 3 font.
     *
     * @param string $glyphname
     * @param float $wx
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-glyph
     */
    public function begin_glyph($glyphname, $wx, $llx, $lly, $urx, $ury) {}

    /**
     * Opens a structure element or other content item with attributes supplied as options.
     *
     * @param string $tag
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-item
     */
    public function begin_item($tag, $optlist) {}

    /**
     * Starts a layer for subsequent output on the page.
     *
     * @param int $layer
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-layer
     */
    public function begin_layer($layer) {}

    /**
     * Adds a new page to the document, and specifies various options. The parameters width and height are the dimensions of the new page in points.
     *
     * @param float $width
     * @param float $height
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-page-ext
     */
    public function begin_page_ext($width, $height, $optlist) {}

    /**
     * Adds a new page to the document.
     *
     * @param float $width
     * @param float $height
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-page
     *
     * @see PDF_begin_page_ext()
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_begin_page_ext() instead.')]
    public function begin_page($width, $height) {}

    /**
     * Starts a new pattern definition.
     *
     * @param float $width
     * @param float $height
     * @param float $xstep
     * @param float $ystep
     * @param int $painttype
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-pattern
     */
    public function begin_pattern($width, $height, $xstep, $ystep, $painttype) {}

    /**
     * Starts a new template definition.
     *
     * @param float $width
     * @param float $height
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-template-ext
     */
    public function begin_template_ext($width, $height, $optlist) {}

    /**
     * Start template definition [deprecated]
     *
     * Starts a new template definition. This function is deprecated since PDFlib version 7, use
     * PDF_begin_template_ext() instead.
     *
     * @param float $width
     * @param float $height
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-template
     *
     * @see PDF_begin_template_ext
     */
    #[Deprecated('This function is deprecated since PDFlib version 7, use PDF_begin_template_ext() instead.')]
    public function begin_template($width, $height) {}

    /**
     * Draw a circle
     *
     * Adds a circle. Returns TRUE on success or FALSE on failure.
     *
     * @param float $x
     * @param float $y
     * @param float $r
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-circle
     */
    public function circle($x, $y, $r) {}

    /**
     * Clip to current path
     *
     * Uses the current path as clipping path, and terminate the path. Returns TRUE on success or
     * FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-clip
     */
    public function clip() {}

    /**
     * Close image
     *
     * Closes an image retrieved with the PDF_open_image() function.
     *
     * @param int $image
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close-image
     */
    public function close_image($image) {}

    /**
     * Closes the page handle, and frees all page-related resources
     *
     * @param int $page
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close-pdi-page
     */
    public function close_pdi_page($page) {}

    /**
     * Close the input PDF document [deprecated]
     *
     * Closes all open page handles, and closes the input PDF document. Returns TRUE on success or
     * FALSE on failure. This function is deprecated since PDFlib version 7, use
     * PDF_close_pdi_document() instead.
     *
     * @param int $doc
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close-pdi
     *
     * @see PDF_close_pdi_document()
     */
    #[Deprecated('This function is deprecated since PDFlib version 7, use PDF_close_pdi_document() instead.')]
    public function close_pdi($doc) {}

    /**
     * @param int $doc
     *
     * @return bool
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function close_pdi_document($doc) {}

    /**
     * Close pdf resource [deprecated]
     *
     * Closes the generated PDF file, and frees all document-related resources. Returns TRUE on
     * success or FALSE on failure. This function is deprecated since PDFlib version 6, use
     * PDF_end_document() instead.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close
     *
     * @see PDF_end_document
     */
    #[Deprecated('This function is deprecated since PDFlib version 6, use PDF_end_document() instead.')]
    public function close() {}

    /**
     * Close, fill and stroke current path
     *
     * Closes the path, fills, and strokes it. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-closepath-fill-stroke
     */
    public function closepath_fill_stroke() {}

    /**
     * Close and stroke path
     *
     * Closes the path, and strokes it. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-closepath-stroke
     */
    public function closepath_stroke() {}

    /**
     * Close current path
     *
     * Closes the current path. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-closepath
     */
    public function closepath() {}

    /**
     * Concatenate a matrix to the CTM
     *
     * Concatenates a matrix to the current transformation matrix (CTM). Returns TRUE on success or
     * FALSE on failure.
     *
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @param float $e
     * @param float $f
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-concat
     */
    public function concat($a, $b, $c, $d, $e, $f) {}

    /**
     * Output text in next line
     *
     * Prints text at the next line. Returns TRUE on success or FALSE on failure.
     *
     * @param string $text
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-continue-text
     */
    public function continue_text($text) {}

    /**
     * Create 3D view
     *
     * Creates a 3D view. This function requires PDF 1.6.
     *
     * @param string $username
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-3dview
     */
    public function create_3dview($username, $optlist) {}

    /**
     * Create action for objects or events
     *
     * Creates an action which can be applied to various objects and events.
     *
     * @param string $type
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-action
     */
    public function create_action($type, $optlist) {}

    /**
     * Create rectangular annotation
     *
     * Creates a rectangular annotation on the current page.
     *
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     * @param string $type
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-annotation
     */
    public function create_annotation($llx, $lly, $urx, $ury, $type, $optlist) {}

    /**
     * Create bookmark
     *
     * Creates a bookmark subject to various options.
     *
     * @param string $text
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-bookmark
     */
    public function create_bookmark($text, $optlist) {}

    /**
     * Create form field
     *
     * Creates a form field on the current page subject to various options.
     *
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     * @param string $name
     * @param string $type
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-field
     */
    public function create_field($llx, $lly, $urx, $ury, $name, $type, $optlist) {}

    /**
     * Create form field group
     *
     * Creates a form field group subject to various options.
     *
     * @param string $name
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-fieldgroup
     */
    public function create_fieldgroup($name, $optlist) {}

    /**
     * Create graphics state object
     *
     * Creates a graphics state object subject to various options.
     *
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-gstate
     */
    public function create_gstate($optlist) {}

    /**
     * Create PDFlib virtual file
     *
     * Creates a named virtual read-only file from data provided in memory.
     *
     * @param string $filename
     * @param string $data
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-pvf
     */
    public function create_pvf($filename, $data, $optlist) {}

    /**
     * Create textflow object
     *
     * Preprocesses text for later formatting and creates a textflow object.
     *
     * @param string $text
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-textflow
     */
    public function create_textflow($text, $optlist) {}

    /**
     * Draw Bezier curve
     *
     * Draws a Bezier curve from the current point, using 3 more control points. Returns TRUE on
     * success or FALSE on failure.
     *
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     * @param float $x3
     * @param float $y3
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-curveto
     */
    public function curveto($x1, $y1, $x2, $y2, $x3, $y3) {}

    /**
     * Create layer definition
     *
     * Creates a new layer definition. This function requires PDF 1.5.
     *
     * @param string $name
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-define-layer
     */
    public function define_layer($name, $optlist) {}

    /**
     * Delete PDFlib virtual file
     *
     * Deletes a named virtual file and frees its data structures (but not the contents).
     *
     * @param string $filename
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete-pvf
     */
    public function delete_pvf($filename) {}

    /**
     * Delete table object
     *
     * Deletes a table and all associated data structures.
     *
     * @param int $table
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete-table
     */
    public function delete_table($table, $optlist) {}

    /**
     * Delete textflow object
     *
     * Deletes a textflow and the associated data structures.
     *
     * @param int $textflow
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete-textflow
     */
    public function delete_textflow($textflow) {}

    /**
     * Delete PDFlib object
     *
     * Deletes a PDFlib object, and frees all internal resources. Returns TRUE on success or FALSE
     * on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete
     */
    public function delete() {}

    /**
     * Add glyph name and/or Unicode value
     *
     * Adds a glyph name and/or Unicode value to a custom encoding.
     *
     * @param string $encoding
     * @param int $slot
     * @param string $glyphname
     * @param int $uv
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-encoding-set-char
     */
    public function encoding_set_char($encoding, $slot, $glyphname, $uv) {}

    /**
     * Close PDF file
     *
     * Closes the generated PDF file and applies various options.
     *
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-document
     */
    public function end_document($optlist) {}

    /**
     * Terminate Type 3 font definition
     *
     * Terminates a Type 3 font definition.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-font
     */
    public function end_font() {}

    /**
     * Terminate glyph definition for Type 3 font
     *
     * Terminates a glyph definition for a Type 3 font.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-glyph
     */
    public function end_glyph() {}

    /**
     * Close structure element or other content item
     *
     * Closes a structure element or other content item.
     *
     * @param int $id
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-item
     */
    public function end_item($id) {}

    /**
     * Deactivate all active layers
     *
     * Deactivates all active layers. Returns TRUE on success or FALSE on failure. This function
     * requires PDF 1.5.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-layer
     */
    public function end_layer() {}

    /**
     * Finish page
     *
     * Finishes a page, and applies various options. Returns TRUE on success or FALSE on failure.
     *
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-page-ext
     */
    public function end_page_ext($optlist) {}

    /**
     * Finish page
     *
     * Finishes the page. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-page
     */
    public function end_page() {}

    /**
     * Finish pattern
     *
     * Finishes the pattern definition. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-pattern
     */
    public function end_pattern() {}

    /**
     * Finish template
     *
     * Finishes a template definition. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-template
     */
    public function end_template() {}

    /**
     * End current path
     *
     * Ends the current path without filling or stroking it.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-endpath
     */
    public function endpath() {}

    /**
     * Fill image block with variable data
     *
     * Fills an image block with variable data according to its properties. This function is only
     * available in the PDFlib Personalization Server (PPS).
     *
     * @param int $page
     * @param string $blockname
     * @param int $image
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-imageblock
     */
    public function fill_imageblock($page, $blockname, $image, $optlist) {}

    /**
     * Fill PDF block with variable data
     *
     * Fills a PDF block with variable data according to its properties. This function is only
     * available in the PDFlib Personalization Server (PPS).
     *
     * @param int $page
     * @param string $blockname
     * @param int $contents
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-pdfblock
     */
    public function fill_pdfblock($page, $blockname, $contents, $optlist) {}

    /**
     * Fill and stroke path
     *
     * Fills and strokes the current path with the current fill and stroke color. Returns TRUE on
     * success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-stroke
     */
    public function fill_stroke() {}

    /**
     * Fill text block with variable data
     *
     * Fills a text block with variable data according to its properties. This function is only
     * available in the PDFlib Personalization Server (PPS).
     *
     * @param int $page
     * @param string $blockname
     * @param string $text
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-textblock
     */
    public function fill_textblock($page, $blockname, $text, $optlist) {}

    /**
     * Fill current path
     *
     * Fills the interior of the current path with the current fill color. Returns TRUE on success
     * or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill
     */
    public function fill() {}

    /**
     * Prepare font for later use [deprecated]
     *
     * Search for a font and prepare it for later use with PDF_setfont(). The metrics will be
     * loaded, and if embed is nonzero, the font file will be checked, but not yet used. encoding is
     * one of builtin, macroman, winansi, host, a user-defined encoding name or the name of a CMap.
     * Parameter embed is optional before PHP 4.3.5 or with PDFlib less than 5. This function is
     * deprecated since PDFlib version 5, use PDF_load_font() instead.
     *
     * @param string $fontname
     * @param string $encoding
     * @param int $embed
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-findfont (Deprecated)
     */
    public function findfont($fontname, $encoding, $embed) {}

    /**
     * Place image or template
     *
     * Places an image or template on the page, subject to various options. Returns TRUE on success
     * or FALSE on failure.
     *
     * @param int $image
     * @param float $x
     * @param float $y
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-image
     */
    public function fit_image($image, $x, $y, $optlist) {}

    /**
     * Place imported PDF page
     *
     * Places an imported PDF page on the page, subject to various options. Returns TRUE on success
     * or FALSE on failure.
     *
     * @param int $page
     * @param float $x
     * @param float $y
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-pdi-page
     */
    public function fit_pdi_page($page, $x, $y, $optlist) {}

    /**
     * @param int $table A valid table handle retrieved with a call to PDF_add_table_cell()
     * @param float $llx X Coordinate of the lower left corner of the target rectangle for the table instance (the fitbox) in user coordinates.
     * @param float $lly Y Coordinate of the lower left corner of the target rectangle for the table instance (the fitbox) in user coordinates.
     * @param float $urx X Coordinate of the upper right corner of the target rectangle for the table instance (the fitbox) in user coordinates.
     * @param float $ury Y Coordinate of the upper right corner of the target rectangle for the table instance (the fitbox) in user coordinates.
     * @param string $optlist An option list specifying filling details according to Table 5.18.
     *
     * @return string A string which specifies the reason for returning from the function
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function fit_table($table, $llx, $lly, $urx, $ury, $optlist) {}

    /**
     * Format textflow in rectangular area
     *
     * Formats the next portion of a textflow into a rectangular area.
     *
     * @param int $textflow
     * @param float $llx
     * @param float $lly
     * @param float $urx
     * @param float $ury
     * @param string $optlist
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-textflow
     */
    public function fit_textflow($textflow, $llx, $lly, $urx, $ury, $optlist) {}

    /**
     * Place single line of text
     *
     * Places a single line of text on the page, subject to various options. Returns TRUE on success
     * or FALSE on failure.
     *
     * @param string $text
     * @param float $x
     * @param float $y
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-textline
     */
    public function fit_textline($text, $x, $y, $optlist) {}

    /**
     * Get name of unsuccessfull API function
     *
     * Gets the name of the API function which threw the last exception or failed.
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-apiname
     */
    public function get_apiname() {}

    /**
     * Get PDF output buffer
     *
     * Fetches the buffer containing the generated PDF data.
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-buffer
     */
    public function get_buffer() {}

    /**
     * Get error text
     *
     * Gets the text of the last thrown exception or the reason for a failed function call.
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-errmsg
     */
    public function get_errmsg() {}

    /**
     * Get error number
     *
     * Gets the number of the last thrown exception or the reason for a failed function call.
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-errnum
     */
    public function get_errnum() {}

    /**
     * Get major version number [deprecated]
     *
     * This function is deprecated since PDFlib version 5, use PDF_get_value() with the parameter
     * major instead.
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-majorversion (deprecated)
     */
    public function get_majorversion() {}

    /**
     * Get minor version number [deprecated]
     *
     * Returns the minor version number of the PDFlib version. This function is deprecated since
     * PDFlib version 5, use PDF_get_value() with the parameter minor instead.
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-minorversion (deprecated)
     */
    public function get_minorversion() {}

    /**
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function get_option($keyword, $optlist) {}

    /**
     * Get string parameter
     *
     * Gets the contents of some PDFlib parameter with string type.
     *
     * @param string $key
     * @param float $modifier
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-parameter
     */
    public function get_parameter($key, $modifier) {}

    /**
     * Get PDI string parameter [deprecated]
     *
     * Gets the contents of a PDI document parameter with string type. This function is deprecated
     * since PDFlib version 7, use PDF_pcos_get_string() instead.
     *
     * @param string $key
     * @param int $doc
     * @param int $page
     * @param int $reserved
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-pdi-parameter
     */
    public function get_pdi_parameter($key, $doc, $page, $reserved) {}

    /**
     * Get PDI numerical parameter [deprecated]
     *
     * Gets the contents of a PDI document parameter with numerical type. This function is
     * deprecated since PDFlib version 7, use PDF_pcos_get_number() instead.
     *
     * @param string $key
     * @param int $doc
     * @param int $page
     * @param int $reserved
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-pdi-value
     */
    public function get_pdi_value($key, $doc, $page, $reserved) {}

    /**
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function get_string($keyword, $optlist) {}

    /**
     * Get numerical parameter
     *
     * Gets the value of some PDFlib parameter with numerical type.
     *
     * @param string $key
     * @param float $modifier
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-value
     */
    public function get_value($key, $modifier) {}

    /**
     * Query detailed information about a loaded font
     *
     * Queries detailed information about a loaded font.
     *
     * @param int $font
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-font
     */
    public function info_font($font, $keyword, $optlist) {}

    /**
     * @param int $image
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function info_image($image, $keyword, $optlist) {}

    /**
     * Query matchbox information
     *
     * Queries information about a matchbox on the current page.
     *
     * @param string $boxname
     * @param int $num
     * @param string $keyword
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-matchbox
     */
    public function info_matchbox($boxname, $num, $keyword) {}

    /**
     * @param int $graphics
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function info_graphics($graphics, $keyword, $optlist) {}

    /**
     * @param int $path
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function info_path($path, $keyword, $optlist) {}

    /**
     * @param int $path
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function info_pdi_page($page, $keyword, $optlist) {}

    /**
     * @param string $filename
     * @param string $keyword
     *
     * @return float
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function info_pvf($filename, $keyword) {}

    /**
     * Retrieve table information
     *
     * Retrieves table information related to the most recently placed table instance.
     *
     * @param int $table
     * @param string $keyword
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-table
     */
    public function info_table($table, $keyword) {}

    /**
     * Query textflow state
     *
     * Queries the current state of a textflow.
     *
     * @param int $textflow
     * @param string $keyword
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-textflow
     */
    public function info_textflow($textflow, $keyword) {}

    /**
     * Perform textline formatting and query metrics
     *
     * Performs textline formatting and queries the resulting metrics.
     *
     * @param string $text
     * @param string $keyword
     * @param string $optlist
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-textline
     */
    public function info_textline($text, $keyword, $optlist) {}

    /**
     * Reset graphic state
     *
     * Reset all color and graphics state parameters to their defaults. Returns TRUE on success or
     * FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-initgraphics
     */
    public function initgraphics() {}

    /**
     * Draw a line
     *
     * Draws a line from the current point to another point. Returns TRUE on success or FALSE on
     * failure.
     *
     * @param float $x
     * @param float $y
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-lineto
     */
    public function lineto($x, $y) {}

    /**
     * Load 3D model
     *
     * Loads a 3D model from a disk-based or virtual file. This function requires PDF 1.6.
     *
     * @param string $filename
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-3ddata
     */
    public function load_3ddata($filename, $optlist) {}

    /**
     * Search and prepare font
     *
     * Searches for a font and prepares it for later use.
     *
     * @param string $fontname
     * @param string $encoding
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-font
     */
    public function load_font($fontname, $encoding, $optlist) {}

    /**
     * Search and prepare ICC profile
     *
     * Searches for an ICC profile, and prepares it for later use.
     *
     * @param string $profilename
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-iccprofile
     */
    public function load_iccprofile($profilename, $optlist) {}

    /**
     * Open image file
     *
     * Opens a disk-based or virtual image file subject to various options.
     *
     * @param string $imagetype
     * @param string $filename
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-image
     */
    public function load_image($imagetype, $filename, $optlist) {}

    /**
     * Make spot color
     *
     * Finds a built-in spot color name, or makes a named spot color from the current fill color.
     * Returns TRUE on success or FALSE on failure.
     *
     * @param string $spotname
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-makespotcolor
     */
    public function makespotcolor($spotname) {}

    /**
     * Set current point
     *
     * Sets the current point for graphics output. Returns TRUE on success or FALSE on failure.
     *
     * @param float $x
     * @param float $y
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-moveto
     */
    public function moveto($x, $y) {}

    /**
     * Open raw CCITT image [deprecated]
     *
     * Opens a raw CCITT image. This function is deprecated since PDFlib version 5, use
     * PDF_load_image() instead.
     *
     * @param string $filename
     * @param int $width
     * @param int $height
     * @param int $BitReverse
     * @param int $k
     * @param int $Blackls1
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-ccitt (deprecated)
     */
    public function open_ccitt($filename, $width, $height, $BitReverse, $k, $Blackls1) {}

    /**
     * Create PDF file [deprecated]
     *
     * Creates a new PDF file using the supplied file name. Returns TRUE on success or FALSE on
     * failure. This function is deprecated since PDFlib version 6, use PDF_begin_document()
     * instead.
     *
     * @param string $filename
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-file (deprecated)
     */
    public function open_file($filename) {}

    /**
     * Read image from file [deprecated]
     *
     * Opens an image file. This function is deprecated since PDFlib version 5, use PDF_load_image()
     * with the colorize, ignoremask, invert, mask, masked, and page options instead.
     *
     * @param string $imagetype
     * @param string $filename
     * @param string $stringparam
     * @param int $intparam
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-image-file (deprecated)
     */
    public function open_image_file($imagetype, $filename, $stringparam, $intparam) {}

    /**
     * Use image data [deprecated]
     *
     * Uses image data from a variety of data sources. This function is deprecated since PDFlib
     * version 5, use virtual files and PDF_load_image() instead.
     *
     * @param string $imagetype
     * @param string $source
     * @param string $data
     * @param int $length
     * @param int $width
     * @param int $height
     * @param int $components
     * @param int $bpc
     * @param string $params
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-image (deprecated)
     */
    public function open_image($imagetype, $source, $data, $length, $width, $height, $components, $bpc, $params) {}

    /**
     * Open image created with PHP's image functions [not supported]
     *
     * This function is not supported by PDFlib GmbH.
     *
     * @param resource $image
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-memory-image (not supported)
     */
    public function open_memory_image($image) {}

    /**
     * Prepare a pdi document
     *
     * Open a disk-based or virtual PDF document and prepare it for later use.
     *
     * @param string $filename
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-pdi-document
     */
    public function open_pdi_document($filename, $optlist) {}

    /**
     * Prepare a page
     *
     * Prepares a page for later use with PDF_fit_pdi_page().
     *
     * @param int $doc
     * @param int $pagenumber
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-pdi-page
     */
    public function open_pdi_page($doc, $pagenumber, $optlist) {}

    /**
     * Open PDF file [deprecated]
     *
     * Opens a disk-based or virtual PDF document and prepares it for later use. This function is
     * deprecated since PDFlib version 7, use PDF_open_pdi_document() instead.
     *
     * @param string $filename
     * @param string $optlist
     * @param int $len
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-pdi
     */
    public function open_pdi($filename, $optlist, $len) {}

    /**
     * Get value of pCOS path with type number or boolean
     *
     * Gets the value of a pCOS path with type number or boolean.
     *
     * @param int $doc
     * @param string $path
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-pcos-get-number
     */
    public function pcos_get_number($doc, $path) {}

    /**
     * Get contents of pCOS path with type stream, fstream, or string
     *
     * Gets the contents of a pCOS path with type stream, fstream, or string.
     *
     * @param int $doc
     * @param string $optlist
     * @param string $path
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-pcos-get-stream
     */
    public function pcos_get_stream($doc, $optlist, $path) {}

    /**
     * Get value of pCOS path with type name, string, or boolean
     *
     * Gets the value of a pCOS path with type name, string, or boolean.
     *
     * @param int $doc
     * @param string $path
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-pcos-get-string
     */
    public function pcos_get_string($doc, $path) {}

    /**
     * Place image on the page [deprecated]
     *
     * Places an image and scales it. Returns TRUE on success or FALSE on failure. This function is
     * deprecated since PDFlib version 5, use PDF_fit_image() instead.
     *
     * @param int $image
     * @param float $x
     * @param float $y
     * @param float $scale
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-place-image (dep)
     */
    public function place_image($image, $x, $y, $scale) {}

    /**
     * Place PDF page [deprecated]
     *
     * Places a PDF page and scales it. Returns TRUE on success or FALSE on failure. This function
     * is deprecated since PDFlib version 5, use PDF_fit_pdi_page() instead.
     *
     * @param int $page
     * @param float $x
     * @param float $y
     * @param float $sx
     * @param float $sy
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-place-pdi-page (dep)
     */
    public function place_pdi_page($page, $x, $y, $sx, $sy) {}

    /**
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
     */
    public function set_option($optlist) {}

    /**
     * Process imported PDF document
     *
     * Processes certain elements of an imported PDF document.
     *
     * @param int $doc
     * @param int $page
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-process-pdi
     */
    public function process_pdi($doc, $page, $optlist) {}

    /**
     * Draw rectangle
     *
     * Draws a rectangle. Returns TRUE on success or FALSE on failure.
     *
     * @param float $x
     * @param float $y
     * @param float $width
     * @param float $height
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-rect
     */
    public function rect($x, $y, $width, $height) {}

    /**
     * Restore graphics state
     *
     * Restores the most recently saved graphics state. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-restore
     */
    public function restore() {}

    /**
     * Resume page
     *
     * Resumes a page to add more content to it.
     *
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-resume-page
     */
    public function resume_page($optlist) {}

    /**
     * Rotate coordinate system
     *
     * Rotates the coordinate system. Returns TRUE on success or FALSE on failure.
     *
     * @param float $phi
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-rotate
     */
    public function rotate($phi) {}

    /**
     * Save graphics state
     *
     * Saves the current graphics state. Returns TRUE on success or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-save
     */
    public function save() {}

    /**
     * Scale coordinate system
     *
     * Scales the coordinate system. Returns TRUE on success or FALSE on failure.
     *
     * @param float $sx
     * @param float $sy
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-scale
     */
    public function scale($sx, $sy) {}

    /**
     * Set border color of annotations [deprecated]
     *
     * Sets the border color for all kinds of annotations. Returns TRUE on success or FALSE on
     * failure. This function is deprecated since PDFlib version 6, use the option annotcolor in
     * PDF_create_annotation() instead.
     *
     * @param float $red
     * @param float $green
     * @param float $blue
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-border-color (dep)
     */
    public function set_border_color($red, $green, $blue) {}

    /**
     * Set border dash style of annotations [deprecated]
     *
     * Sets the border dash style for all kinds of annotations. Returns TRUE on success or FALSE on
     * failure. This function is deprecated since PDFlib version 6, use the option dasharray in
     * PDF_create_annotation() instead.
     *
     * @param float $black
     * @param float $white
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-border-dash (dep)
     */
    public function set_border_dash($black, $white) {}

    /**
     * Set border style of annotations [deprecated]
     *
     * Sets the border style for all kinds of annotations. Returns TRUE on success or FALSE on
     * failure. This function is deprecated since PDFlib version 6, use the options borderstyle and
     * linewidth in PDF_create_annotation() instead.
     *
     * @param string $style
     * @param float $width
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-border-style (dep)
     */
    public function set_border_style($style, $width) {}

    /**
     * Activate graphics state object
     *
     * Activates a graphics state object.
     *
     * @param int $gstate
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-gstate
     */
    public function set_gstate($gstate) {}

    /**
     * Fill document info field
     *
     * Fill document information field key with value. Returns TRUE on success or FALSE on failure.
     *
     * @param string $key
     * @param string $value
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-info
     */
    public function set_info($key, $value) {}

    /**
     * Define relationships among layers
     *
     * Defines hierarchical and group relationships among layers. Returns TRUE on success or FALSE
     * on failure. This function requires PDF 1.5.
     *
     * @param string $type
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-layer-dependency
     */
    public function set_layer_dependency($type, $optlist) {}

    /**
     * Set string parameter
     *
     * Sets some PDFlib parameter with string type. Returns TRUE on success or FALSE on failure.
     *
     * @param string $key
     * @param string $value
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-parameter
     */
    public function set_parameter($key, $value) {}

    /**
     * Set text position
     *
     * Sets the position for text output on the page. Returns TRUE on success or FALSE on failure.
     *
     * @param float $x
     * @param float $y
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-text-pos
     */
    public function set_text_pos($x, $y) {}

    /**
     * Set numerical parameter
     *
     * Sets the value of some PDFlib parameter with numerical type. Returns TRUE on success or FALSE
     * on failure.
     *
     * @param string $key
     * @param float $value
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-value
     */
    public function set_value($key, $value) {}

    /**
     * Set fill and stroke color
     *
     * Sets the current color space and color. Returns TRUE on success or FALSE on failure.
     *
     * @param string $fstype
     * @param string $colorspace
     * @param float $c1
     * @param float $c2
     * @param float $c3
     * @param float $c4
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setcolor
     */
    public function setcolor($fstype, $colorspace, $c1, $c2, $c3, $c4) {}

    /**
     * Set simple dash pattern
     *
     * Sets the current dash pattern to b black and w white units. Returns TRUE on success or FALSE
     * on failure.
     *
     * @param float $b
     * @param float $w
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setdash
     */
    public function setdash($b, $w) {}

    /**
     * Set dash pattern
     *
     * Sets a dash pattern defined by an option list. Returns TRUE on success or FALSE on failure.
     *
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setdashpattern
     */
    public function setdashpattern($optlist) {}

    /**
     * Set flatness
     *
     * Sets the flatness parameter. Returns TRUE on success or FALSE on failure.
     *
     * @param float $flatness
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setflat
     */
    public function setflat($flatness) {}

    /**
     * Set font
     *
     * Sets the current font in the specified fontsize, using a font handle returned by
     * PDF_load_font(). Returns TRUE on success or FALSE on failure.
     *
     * @param int $font
     * @param float $fontsize
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setfont
     */
    public function setfont($font, $fontsize) {}

    /**
     * Set fill color to gray [deprecated]
     *
     * Sets the current fill color to a gray value between 0 and 1 inclusive. Returns TRUE on
     * success or FALSE on failure. This function is deprecated since PDFlib version 4, use
     * PDF_setcolor() instead.
     *
     * @param float $g
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setgray-fill (dep)
     */
    public function setgray_fill($g) {}

    /**
     * Set stroke color to gray [deprecated]
     *
     * Sets the current stroke color to a gray value between 0 and 1 inclusive. Returns TRUE on
     * success or FALSE on failure. This function is deprecated since PDFlib version 4, use
     * PDF_setcolor() instead.
     *
     * @param float $g
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setgray-stroke (dep)
     */
    public function setgray_stroke($g) {}

    /**
     * Set color to gray [deprecated]
     *
     * Sets the current fill and stroke color to a gray value between 0 and 1 inclusive. Returns
     * TRUE on success or FALSE on failure. This function is deprecated since PDFlib version 4, use
     * PDF_setcolor() instead.
     *
     * @param float $g
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setgray (dep)
     */
    public function setgray($g) {}

    /**
     * Set linecap parameter
     *
     * Sets the linecap parameter to control the shape at the end of a path with respect to
     * stroking.
     *
     * @param int $linecap
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setlinecap
     */
    public function setlinecap($linecap) {}

    /**
     * Set linejoin parameter
     *
     * Sets the linejoin parameter to specify the shape at the corners of paths that are stroked.
     * Returns TRUE on success or FALSE on failure.
     *
     * @param int $value
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setlinejoin
     */
    public function setlinejoin($value) {}

    /**
     * Set line width
     *
     * Sets the current line width. Returns TRUE on success or FALSE on failure.
     *
     * @param float $width
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setlinewidth
     */
    public function setlinewidth($width) {}

    /**
     * Set current transformation matrix
     *
     * Explicitly sets the current transformation matrix. Returns TRUE on success or FALSE on
     * failure.
     *
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @param float $e
     * @param float $f
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setmatrix
     */
    public function setmatrix($a, $b, $c, $d, $e, $f) {}

    /**
     * Set miter limit
     *
     * Sets the miter limit.Returns TRUE on success or FALSE on failure.
     *
     * @param float $miter
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setmiterlimit
     */
    public function setmiterlimit($miter) {}

    /**
     * Set fill rgb color values [deprecated]
     *
     * Sets the current fill color to the supplied RGB values. Returns TRUE on success or FALSE on
     * failure. This function is deprecated since PDFlib version 4, use PDF_setcolor() instead.
     *
     * @param float $red
     * @param float $green
     * @param float $blue
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setrgbcolor-fill (dep)
     */
    public function setrgbcolor_fill($red, $green, $blue) {}

    /**
     * Set stroke rgb color values [deprecated]
     *
     * Sets the current stroke color to the supplied RGB values. Returns TRUE on success or FALSE on
     * failure. This function is deprecated since PDFlib version 4, use PDF_setcolor() instead.
     *
     * @param float $red
     * @param float $green
     * @param float $blue
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setrgbcolor-stroke (dep)
     */
    public function setrgbcolor_stroke($red, $green, $blue) {}

    /**
     * Set fill and stroke rgb color values [deprecated]
     *
     * Sets the current fill and stroke color to the supplied RGB values. Returns TRUE on success or
     * FALSE on failure. This function is deprecated since PDFlib version 4, use PDF_setcolor()
     * instead.
     *
     * @param float $red
     * @param float $green
     * @param float $blue
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setrgbcolor (dep)
     */
    public function setrgbcolor($red, $green, $blue) {}

    /**
     * Define shading pattern
     *
     * Defines a shading pattern using a shading object. This function requires PDF 1.4 or above.
     *
     * @param int $shading
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-shading-pattern
     */
    public function shading_pattern($shading, $optlist) {}

    /**
     * Define blend
     *
     * Defines a blend from the current fill color to another color. This function requires PDF 1.4
     * or above.
     *
     * @param string $shtype
     * @param float $x0
     * @param float $y0
     * @param float $x1
     * @param float $y1
     * @param float $c1
     * @param float $c2
     * @param float $c3
     * @param float $c4
     * @param string $optlist
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-shading
     */
    public function shading($shtype, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist) {}

    /**
     * Fill area with shading
     *
     * Fills an area with a shading, based on a shading object. This function requires PDF 1.4 or
     * above.
     *
     * @param int $shading
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-shfill
     */
    public function shfill($shading) {}

    /**
     * Output text in a box [deprecated]
     *
     * This function is deprecated since PDFlib version 6, use PDF_fit_textline() for single lines,
     * or the PDF_*_textflow() functions for multi-line formatting instead.
     *
     * @param string $text
     * @param float $left
     * @param float $top
     * @param float $width
     * @param float $height
     * @param string $mode
     * @param string $feature
     *
     * @return int
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-show-boxed (dep)
     */
    public function show_boxed($text, $left, $top, $width, $height, $mode, $feature) {}

    /**
     * Output text at given position
     *
     * Prints text in the current font. Returns TRUE on success or FALSE on failure.
     *
     * @param string $text
     * @param float $x
     * @param float $y
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-show-xy
     */
    public function show_xy($text, $x, $y) {}

    /**
     * Output text at current position
     *
     * Prints text in the current font and size at the current position. Returns TRUE on success or
     * FALSE on failure.
     *
     * @param string $text
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-show
     */
    public function show($text) {}

    /**
     * Skew the coordinate system
     *
     * Skews the coordinate system in x and y direction by alpha and beta degrees, respectively.
     * Returns TRUE on success or FALSE on failure.
     *
     * @param float $alpha
     * @param float $beta
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-skew
     */
    public function skew($alpha, $beta) {}

    /**
     * Return width of text
     *
     * Returns the width of text in an arbitrary font.
     *
     * @param string $text
     * @param int $font
     * @param float $fontsize
     *
     * @return float
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-stringwidth
     */
    public function stringwidth($text, $font, $fontsize) {}

    /**
     * Stroke path
     *
     * Strokes the path with the current color and line width, and clear it. Returns TRUE on success
     * or FALSE on failure.
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-stroke
     */
    public function stroke() {}

    /**
     * Suspend page
     *
     * Suspends the current page so that it can later be resumed with PDF_resume_page().
     *
     * @param string $optlist
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-suspend-page
     */
    public function suspend_page($optlist) {}

    /**
     * Set origin of coordinate system
     *
     * Translates the origin of the coordinate system.
     *
     * @param float $tx
     * @param float $ty
     *
     * @return bool
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-translate
     */
    public function translate($tx, $ty) {}

    /**
     * Convert string from UTF-16 to UTF-8
     *
     * Converts a string from UTF-16 format to UTF-8.
     *
     * @param string $utf16string
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-utf16-to-utf8
     */
    public function utf16_to_utf8($utf16string) {}

    /**
     * Convert string from UTF-32 to UTF-16
     *
     * Converts a string from UTF-32 format to UTF-16.
     *
     * @param string $utf32string
     * @param string $ordering
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-utf32-to-utf16
     */
    public function utf32_to_utf16($utf32string, $ordering) {}

    /**
     * Convert string from UTF-8 to UTF-16
     *
     * Converts a string from UTF-8 format to UTF-16.
     *
     * @param string $utf8string
     * @param string $ordering
     *
     * @return string
     *
     * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-utf8-to-utf16
     */
    public function utf8_to_utf16($utf8string, $ordering) {}
}

class PDFlibException extends Exception {}

/**
 * Activates a previously created structure element or other content item.
 * @param resource $pdf The pDF doc
 * @param int $id
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-activate-item
 */
function PDF_activate_item($pdf, $id) {}

/**
 * Add launch annotation for current page [deprecated].
 * @param resource $pdf
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $filename
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-launchlink
 * @see PDF_create_action
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=Launch and PDF_create_annotation() with type=Link instead.')]
function PDF_add_launchlink($pdf, $llx, $lly, $urx, $ury, $filename) {}

/**
 * Add a link annotation to a target within the current PDF file.
 *
 * @param resource $pdf
 * @param float $lowerleftx
 * @param float $lowerlefty
 * @param float $upperrightx
 * @param float $upperrighty
 * @param int $page
 * @param string $dest
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-locallink
 * @see PDF_create_action
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoTo and PDF_create_annotation() with type=Link instead.')]
function PDF_add_locallink($pdf, $lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $page, $dest) {}

/**
 * Creates a named destination on an arbitrary page in the current document.
 *
 * @param resource $pdf
 * @param string $name
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-nameddest
 */
function PDF_add_nameddest($pdf, $name, $optlist) {}

/**
 * Sets an annotation for the current page.
 *
 * @param resource $pdf
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $contents
 * @param string $title
 * @param string $icon
 * @param int $open
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-note
 * @see PDF_create_annotation
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=Text instead.')]
function PDF_add_note($pdf, $llx, $lly, $urx, $ury, $contents, $title, $icon, $open) {}

/**
 * Add a file link annotation to a PDF target.
 *
 * @param resource $pdf
 * @param float $bottom_left_x
 * @param float $bottom_left_y
 * @param float $up_right_x
 * @param float $up_right_y
 * @param string $filename
 * @param int $page
 * @param string $dest
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-pdflink
 * @see PDF_create_action
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoToR and PDF_create_annotation() with type=Link instead.')]
function PDF_add_pdflink($pdf, $bottom_left_x, $bottom_left_y, $up_right_x, $up_right_y, $filename, $page, $dest) {}

/**
 * Adds a cell to a new or existing table.
 *
 * @param resource $pdf
 * @param int $table
 * @param int $column
 * @param int $row
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-table-cell
 */
function PDF_add_table_cell($pdf, $table, $column, $row, $text, $optlist) {}

/**
 * Creates a Textflow object, or adds text and explicit options to an existing Textflow.
 *
 * @param resource $pdf
 * @param int $textflow
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-textflow
 */
function PDF_add_textflow($pdf, $textflow, $text, $optlist) {}

/**
 * Adds an existing image as thumbnail for the current page.
 *
 * @param resource $pdf
 * @param int $image
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-thumbnail
 */
function PDF_add_thumbnail($pdf, $image) {}

/**
 * Adds a weblink annotation to a target url on the Web.
 *
 * @param resource $pdf
 * @param float $lowerleftx
 * @param float $lowerlefty
 * @param float $upperrightx
 * @param float $upperrighty
 * @param string $url
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-add-weblink
 * @see PDF_create_action
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_action() with type=URI and PDF_create_annotation() with type=Link instead.')]
function PDF_add_weblink($pdf, $lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $url) {}

/**
 * Adds a counterclockwise circular arc
 *
 * @param resource $pdf
 * @param float $x
 * @param float $y
 * @param float $r
 * @param float $alpha
 * @param float $beta
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-arc
 */
function PDF_arc($pdf, $x, $y, $r, $alpha, $beta) {}

/**
 * Except for the drawing direction, this function behaves exactly like PDF_arc().
 *
 * @param resource $pdf
 * @param float $x
 * @param float $y
 * @param float $r
 * @param float $alpha
 * @param float $beta
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-arcn
 */
function PDF_arcn($pdf, $x, $y, $r, $alpha, $beta) {}

/**
 * Adds a file attachment annotation.
 *
 * @param resource $pdf
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $filename
 * @param string $description
 * @param string $author
 * @param string $mimetype
 * @param string $icon
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-attach-file
 * @see PDF_create_annotation
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=FileAttachment instead.')]
function PDF_attach_file($pdf, $llx, $lly, $urx, $ury, $filename, $description, $author, $mimetype, $icon) {}

/**
 * Creates a new PDF file subject to various options.
 *
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-document
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.1.2-API-reference.pdf
 */
function PDF_begin_document($pdf, $filename, $optlist) {}

/**
 * Starts a Type 3 font definition.
 *
 * @param resource $pdf
 * @param string $filename
 * @param float $a
 * @param float $b
 * @param float $c
 * @param float $d
 * @param float $e
 * @param float $f
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-font
 */
function PDF_begin_font($pdf, $filename, $a, $b, $c, $d, $e, $f, $optlist) {}

/**
 * Starts a glyph definition for a Type 3 font.
 *
 * @param resource $pdf
 * @param string $glyphname
 * @param float $wx
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-glyph
 */
function PDF_begin_glyph($pdf, $glyphname, $wx, $llx, $lly, $urx, $ury) {}

/**
 * Opens a structure element or other content item with attributes supplied as options.
 *
 * @param resource $pdf
 * @param string $tag
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-item
 */
function PDF_begin_item($pdf, $tag, $optlist) {}

/**
 * Starts a layer for subsequent output on the page.
 *
 * @param resource $pdf
 * @param int $layer
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-layer
 */
function PDF_begin_layer($pdf, $layer) {}

/**
 * Adds a new page to the document, and specifies various options. The parameters width and height are the dimensions of the new page in points.
 *
 * @param resource $pdf
 * @param float $width
 * @param float $height
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-page-ext
 */
function PDF_begin_page_ext($pdf, $width, $height, $optlist) {}

/**
 * Adds a new page to the document.
 *
 * @param resource $pdf
 * @param float $width
 * @param float $height
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-page
 * @see PDF_begin_page_ext
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_begin_page_ext() instead.')]
function PDF_begin_page($pdf, $width, $height) {}

/**
 * Starts a new pattern definition.
 *
 * @param resource $pdf
 * @param float $width
 * @param float $height
 * @param float $xstep
 * @param float $ystep
 * @param int $painttype
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-pattern
 */
function PDF_begin_pattern($pdf, $width, $height, $xstep, $ystep, $painttype) {}

/**
 * Starts a new template definition.
 *
 * @param resource $pdf
 * @param float $width
 * @param float $height
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-template-ext
 */
function PDF_begin_template_ext($pdf, $width, $height, $optlist) {}

/**
 * Start template definition [deprecated]
 * @param resource $pdf
 * @param float $width
 * @param float $height
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-begin-template
 * @see PDF_begin_template_ext
 */
#[Deprecated('This function is deprecated since PDFlib version 7, use PDF_begin_template_ext() instead.')]
function PDF_begin_template($pdf, $width, $height) {}

/**
 * Draw a circle
 * @param resource $pdf
 * @param float $x
 * @param float $y
 * @param float $r
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-circle
 */
function PDF_circle($pdf, $x, $y, $r) {}

/**
 * Clip to current path
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-clip
 */
function PDF_clip($pdf) {}

/**
 * Close image
 * @param resource $pdf
 * @param int $image
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close-image
 */
function PDF_close_image($pdf, $image) {}

/**
 * Closes the page handle, and frees all page-related resources
 *
 * @param resource $pdf
 * @param int $page
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close-pdi-page
 */
function PDF_close_pdi_page($pdf, $page) {}

/**
 * Close the input pdf document [deprecated]
 * @param resource $pdf
 * @param int $doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close-pdi
 * @see PDF_close_pdi_document
 */
#[Deprecated('This function is deprecated since PDFlib version 7, use PDF_close_pdi_document() instead.')]
function PDF_close_pdi($pdf, $doc) {}

/**
 * Close pdf resource [deprecated]
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-close
 *
 * @see PDF_end_document
 */
#[Deprecated('This function is deprecated since PDFlib version 6, use PDF_end_document() instead.')]
function PDF_close($pdf) {}

/**
 * @param resource $pdf
 * @param int $doc
 *
 * @return bool
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_close_pdi_document($pdf, $doc) {}

/**
 * Close, fill and stroke current path
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-closepath-fill-stroke
 */
function PDF_closepath_fill_stroke($pdf) {}

/**
 * Close and stroke path
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-closepath-stroke
 */
function PDF_closepath_stroke($pdf) {}

/**
 * Close current path
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-closepath
 */
function PDF_closepath($pdf) {}

/**
 * Concatenate a matrix to the ctm
 * @param resource $pdf
 * @param float $a
 * @param float $b
 * @param float $c
 * @param float $d
 * @param float $e
 * @param float $f
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-concat
 */
function PDF_concat($pdf, $a, $b, $c, $d, $e, $f) {}

/**
 * Output text in next line
 * @param resource $pdf
 * @param string $text
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-continue-text
 */
function PDF_continue_text($pdf, $text) {}

/**
 * Create 3d view
 * @param resource $pdf
 * @param string $username
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-3dview
 */
function PDF_create_3dview($pdf, $username, $optlist) {}

/**
 * Create action for objects or events
 * @param resource $pdf
 * @param string $type
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-action
 */
function PDF_create_action($pdf, $type, $optlist) {}

/**
 * Create rectangular annotation
 * @param resource $pdf
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $type
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-annotation
 */
function PDF_create_annotation($pdf, $llx, $lly, $urx, $ury, $type, $optlist) {}

/**
 * Create bookmar
 * @param resource $pdf
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-bookmark
 */
function PDF_create_bookmark($pdf, $text, $optlist) {}

/**
 * Create form field
 * @param resource $pdf
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $name
 * @param string $type
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-field
 */
function PDF_create_field($pdf, $llx, $lly, $urx, $ury, $name, $type, $optlist) {}

/**
 * Create form field group
 * @param resource $pdf
 * @param string $name
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-fieldgroup
 */
function PDF_create_fieldgroup($pdf, $name, $optlist) {}

/**
 * Create graphics state object
 * @param resource $pdf
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-gstate
 */
function PDF_create_gstate($pdf, $optlist) {}

/**
 * Create pdflib virtual file
 * @param resource $pdf
 * @param string $filename
 * @param string $data
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-pvf
 */
function PDF_create_pvf($pdf, $filename, $data, $optlist) {}

/**
 * Create textflow object
 * @param resource $pdf
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-create-textflow
 */
function PDF_create_textflow($pdf, $text, $optlist) {}

/**
 * Draw bezier curve
 * @param resource $pdf
 * @param float $x1
 * @param float $y1
 * @param float $x2
 * @param float $y2
 * @param float $x3
 * @param float $y3
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-curveto
 */
function PDF_curveto($pdf, $x1, $y1, $x2, $y2, $x3, $y3) {}

/**
 * Create layer definition
 * @param resource $pdf
 * @param string $name
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-define-layer
 */
function PDF_define_layer($pdf, $name, $optlist) {}

/**
 * Delete pdflib virtual file
 * @param resource $pdf
 * @param string $filename
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete-pvf
 */
function PDF_delete_pvf($pdf, $filename) {}

/**
 * Delete table object
 *
 * Deletes a table and all associated data structures.
 *
 * @param resource $pdf
 * @param int $table
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete-table
 */
function PDF_delete_table($pdf, $table, $optlist) {}

/**
 * Delete textflow object
 *
 * Deletes a textflow and the associated data structures.
 *
 * @param resource $pdf
 * @param int $textflow
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete-textflow
 */
function PDF_delete_textflow($pdf, $textflow) {}

/**
 * Delete PDFlib object
 *
 * Deletes a PDFlib object, and frees all internal resources. Returns TRUE on success or FALSE on
 * failure.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-delete
 */
function PDF_delete($pdf) {}

/**
 * Add glyph name and/or Unicode value
 *
 * Adds a glyph name and/or Unicode value to a custom encoding.
 *
 * @param resource $pdf
 * @param string $encoding
 * @param int $slot
 * @param string $glyphname
 * @param int $uv
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-encoding-set-char
 */
function PDF_encoding_set_char($pdf, $encoding, $slot, $glyphname, $uv) {}

/**
 * Close PDF file
 *
 * Closes the generated PDF file and applies various options.
 *
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-document
 */
function PDF_end_document($pdf, $optlist) {}

/**
 * Terminate Type 3 font definition
 *
 * Terminates a Type 3 font definition.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-font
 */
function PDF_end_font($pdf) {}

/**
 * Terminate glyph definition for Type 3 font
 *
 * Terminates a glyph definition for a Type 3 font.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-glyph
 */
function PDF_end_glyph($pdf) {}

/**
 * Close structure element or other content item
 *
 * Closes a structure element or other content item.
 *
 * @param resource $pdf
 * @param int $id
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-item
 */
function PDF_end_item($pdf, $id) {}

/**
 * Deactivate all active layers
 *
 * Deactivates all active layers. Returns TRUE on success or FALSE on failure. This function
 * requires PDF 1.5.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-layer
 */
function PDF_end_layer($pdf) {}

/**
 * Finish page
 *
 * Finishes a page, and applies various options. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-page-ext
 */
function PDF_end_page_ext($pdf, $optlist) {}

/**
 * Finish page
 *
 * Finishes the page. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-page
 */
function PDF_end_page($pdf) {}

/**
 * Finish pattern
 *
 * Finishes the pattern definition. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-pattern
 */
function PDF_end_pattern($pdf) {}

/**
 * Finish template
 *
 * Finishes a template definition. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-end-template
 */
function PDF_end_template($pdf) {}

/**
 * End current path
 *
 * Ends the current path without filling or stroking it.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-endpath
 */
function PDF_endpath($pdf) {}

/**
 * Fill image block with variable data
 *
 * Fills an image block with variable data according to its properties. This function is only
 * available in the PDFlib Personalization Server (PPS).
 *
 * @param resource $pdf
 * @param int $page
 * @param string $blockname
 * @param int $image
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-imageblock
 */
function PDF_fill_imageblock($pdf, $page, $blockname, $image, $optlist) {}

/**
 * Fill PDF block with variable data
 *
 * Fills a PDF block with variable data according to its properties. This function is only available
 * in the PDFlib Personalization Server (PPS).
 *
 * @param resource $pdf
 * @param int $page
 * @param string $blockname
 * @param int $contents
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-pdfblock
 */
function PDF_fill_pdfblock($pdf, $page, $blockname, $contents, $optlist) {}

/**
 * Fill and stroke path
 *
 * Fills and strokes the current path with the current fill and stroke color. Returns TRUE on
 * success or FALSE on failure.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-stroke
 */
function PDF_fill_stroke($pdf) {}

/**
 * Fill text block with variable data
 *
 * Fills a text block with variable data according to its properties. This function is only
 * available in the PDFlib Personalization Server (PPS).
 *
 * @param resource $pdf
 * @param int $page
 * @param string $blockname
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill-textblock
 */
function PDF_fill_textblock($pdf, $page, $blockname, $text, $optlist) {}

/**
 * Fill current path
 *
 * Fills the interior of the current path with the current fill color. Returns TRUE on success or
 * FALSE on failure.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fill
 */
function PDF_fill($pdf) {}

/**
 * Prepare font for later use [deprecated]
 *
 * Search for a font and prepare it for later use with PDF_setfont(). The metrics will be loaded,
 * and if embed is nonzero, the font file will be checked, but not yet used. encoding is one of
 * builtin, macroman, winansi, host, a user-defined encoding name or the name of a CMap. Parameter
 * embed is optional before PHP 4.3.5 or with PDFlib less than 5. This function is deprecated since
 * PDFlib version 5, use PDF_load_font() instead.
 *
 * @param resource $pdf
 * @param string $fontname
 * @param string $encoding
 * @param int $embed
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-findfont (Deprecated)
 */
function PDF_findfont($pdf, $fontname, $encoding, $embed) {}

/**
 * Place image or template
 *
 * Places an image or template on the page, subject to various options. Returns TRUE on success or
 * FALSE on failure.
 *
 * @param resource $pdf
 * @param int $image
 * @param float $x
 * @param float $y
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-image
 */
function PDF_fit_image($pdf, $image, $x, $y, $optlist) {}

/**
 * Place imported PDF page
 *
 * Places an imported PDF page on the page, subject to various options. Returns TRUE on success or
 * FALSE on failure.
 *
 * @param resource $pdf
 * @param int $page
 * @param float $x
 * @param float $y
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-pdi-page
 */
function PDF_fit_pdi_page($pdf, $page, $x, $y, $optlist) {}

/**
 * Place table on page
 *
 * Places a table on the page fully or partially.
 *
 * @param resource $pdf
 * @param int $table
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $optlist
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-table
 */
function PDF_fit_table($pdf, $table, $llx, $lly, $urx, $ury, $optlist) {}

/**
 * Format textflow in rectangular area
 *
 * Formats the next portion of a textflow into a rectangular area.
 *
 * @param resource $pdf
 * @param int $textflow
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $optlist
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-textflow
 */
function PDF_fit_textflow($pdf, $textflow, $llx, $lly, $urx, $ury, $optlist) {}

/**
 * Place single line of text
 *
 * Places a single line of text on the page, subject to various options. Returns TRUE on success or
 * FALSE on failure.
 *
 * @param resource $pdf
 * @param string $text
 * @param float $x
 * @param float $y
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-fit-textline
 */
function PDF_fit_textline($pdf, $text, $x, $y, $optlist) {}

/**
 * Get name of unsuccessfull API function
 *
 * Gets the name of the API function which threw the last exception or failed.
 *
 * @param resource $pdf
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-apiname
 */
function PDF_get_apiname($pdf) {}

/**
 * Get PDF output buffer
 *
 * Fetches the buffer containing the generated PDF data.
 *
 * @param resource $pdf
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-buffer
 */
function PDF_get_buffer($pdf) {}

/**
 * Get error text
 *
 * Gets the text of the last thrown exception or the reason for a failed function call.
 *
 * @param resource $pdf
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-errmsg
 */
function PDF_get_errmsg($pdf) {}

/**
 * Get error number
 *
 * Gets the number of the last thrown exception or the reason for a failed function call.
 *
 * @param resource $pdf
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-errnum
 */
function PDF_get_errnum($pdf) {}

/**
 * Get major version number [deprecated]
 *
 * This function is deprecated since PDFlib version 5, use PDF_get_value() with the parameter major
 * instead.
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-majorversion (deprecated)
 */
function PDF_get_majorversion() {}

/**
 * Get minor version number [deprecated]
 *
 * Returns the minor version number of the PDFlib version. This function is deprecated since PDFlib
 * version 5, use PDF_get_value() with the parameter minor instead.
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-minorversion (deprecated)
 */
function PDF_get_minorversion() {}

/**
 * @param resource $pdf
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_get_option($pdf, $keyword, $optlist) {}

/**
 * Get string parameter
 *
 * Gets the contents of some PDFlib parameter with string type.
 *
 * @param resource $pdf
 * @param string $key
 * @param float $modifier
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-parameter
 */
function PDF_get_parameter($pdf, $key, $modifier) {}

/**
 * Get PDI string parameter [deprecated]
 *
 * Gets the contents of a PDI document parameter with string type. This function is deprecated since
 * PDFlib version 7, use PDF_pcos_get_string() instead.
 *
 * @param resource $pdf
 * @param string $key
 * @param int $doc
 * @param int $page
 * @param int $reserved
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-pdi-parameter
 */
function PDF_get_pdi_parameter($pdf, $key, $doc, $page, $reserved) {}

/**
 * Get PDI numerical parameter [deprecated]
 *
 * Gets the contents of a PDI document parameter with numerical type. This function is deprecated
 * since PDFlib version 7, use PDF_pcos_get_number() instead.
 *
 * @param resource $pdf
 * @param string $key
 * @param int $doc
 * @param int $page
 * @param int $reserved
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-pdi-value
 */
function PDF_get_pdi_value($pdf, $key, $doc, $page, $reserved) {}

/**
 * @param resource $pdf
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_get_string($keyword, $optlist) {}

/**
 * Get numerical parameter
 *
 * Gets the value of some PDFlib parameter with numerical type.
 *
 * @param resource $pdf
 * @param string $key
 * @param float $modifier
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-get-value
 */
function PDF_get_value($pdf, $key, $modifier) {}

/**
 * Query detailed information about a loaded font
 *
 * Queries detailed information about a loaded font.
 *
 * @param resource $pdf
 * @param int $font
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-font
 */
function PDF_info_font($pdf, $font, $keyword, $optlist) {}

/**
 * @param resource $pdf
 * @param int $image
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_info_image($pdf, $image, $keyword, $optlist) {}

/**
 * @param resource $pdf
 * @param int $graphics
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_info_graphics($pdf, $graphics, $keyword, $optlist) {}

/**
 * @param resource $pdf
 * @param int $path
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_info_path($pdf, $path, $keyword, $optlist) {}

/**
 * @param resource $pdf
 * @param int $path
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_info_pdi_page($pdf, $page, $keyword, $optlist) {}

/**
 * @param resource $pdf
 * @param string $filename
 * @param string $keyword
 *
 * @return float
 */
function PDF_info_pvf($pdf, $filename, $keyword) {}

/**
 * Query matchbox information
 *
 * Queries information about a matchbox on the current page.
 *
 * @param resource $pdf
 * @param string $boxname
 * @param int $num
 * @param string $keyword
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-matchbox
 */
function PDF_info_matchbox($pdf, $boxname, $num, $keyword) {}

/**
 * Retrieve table information
 *
 * Retrieves table information related to the most recently placed table instance.
 *
 * @param resource $pdf
 * @param int $table
 * @param string $keyword
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-table
 */
function PDF_info_table($pdf, $table, $keyword) {}

/**
 * Query textflow state
 *
 * Queries the current state of a textflow.
 *
 * @param resource $pdf
 * @param int $textflow
 * @param string $keyword
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-textflow
 */
function PDF_info_textflow($pdf, $textflow, $keyword) {}

/**
 * Perform textline formatting and query metrics
 *
 * Performs textline formatting and queries the resulting metrics.
 *
 * @param resource $pdf
 * @param string $text
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-info-textline
 */
function PDF_info_textline($pdf, $text, $keyword, $optlist) {}

/**
 * Reset graphic state
 *
 * Reset all color and graphics state parameters to their defaults. Returns TRUE on success or FALSE
 * on failure.
 *
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-initgraphics
 */
function PDF_initgraphics($pdf) {}

/**
 * Draw a line
 *
 * Draws a line from the current point to another point. Returns TRUE on success or FALSE on
 * failure.
 *
 * @param resource $pdf
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-lineto
 */
function PDF_lineto($pdf, $x, $y) {}

/**
 * Load 3D model
 *
 * Loads a 3D model from a disk-based or virtual file. This function requires PDF 1.6.
 *
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-3ddata
 */
function PDF_load_3ddata($pdf, $filename, $optlist) {}

/**
 * Search and prepare font
 *
 * Searches for a font and prepares it for later use.
 *
 * @param resource $pdf
 * @param string $fontname
 * @param string $encoding
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-font
 */
function PDF_load_font($pdf, $fontname, $encoding, $optlist) {}

/**
 * Search and prepare ICC profile
 *
 * Searches for an ICC profile, and prepares it for later use.
 *
 * @param resource $pdf
 * @param string $profilename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-iccprofile
 */
function PDF_load_iccprofile($pdf, $profilename, $optlist) {}

/**
 * Open image file
 *
 * Opens a disk-based or virtual image file subject to various options.
 *
 * @param resource $pdf
 * @param string $imagetype
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-load-image
 */
function PDF_load_image($pdf, $imagetype, $filename, $optlist) {}

/**
 * Make spot color
 *
 * Finds a built-in spot color name, or makes a named spot color from the current fill color.
 * Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $spotname
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-makespotcolor
 */
function PDF_makespotcolor($pdf, $spotname) {}

/**
 * Set current point
 *
 * Sets the current point for graphics output. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-moveto
 */
function PDF_moveto($pdf, $x, $y) {}

/**
 * Create PDFlib object
 *
 * Creates a new PDFlib object with default settings.
 *
 * @return resource
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-new
 */
function PDF_new() {}

/**
 * Open raw CCITT image [deprecated]
 *
 * Opens a raw CCITT image. This function is deprecated since PDFlib version 5, use PDF_load_image()
 * instead.
 *
 * @param resource $pdf
 * @param string $filename
 * @param int $width
 * @param int $height
 * @param int $BitReverse
 * @param int $k
 * @param int $Blackls1
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-ccitt (deprecated)
 */
function PDF_open_ccitt($pdf, $filename, $width, $height, $BitReverse, $k, $Blackls1) {}

/**
 * Create PDF file [deprecated]
 *
 * Creates a new PDF file using the supplied file name. Returns TRUE on success or FALSE on failure.
 * This function is deprecated since PDFlib version 6, use PDF_begin_document() instead.
 *
 * @param resource $pdf
 * @param string $filename
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-file (deprecated)
 */
function PDF_open_file($pdf, $filename) {}

/**
 * Read image from file [deprecated]
 *
 * Opens an image file. This function is deprecated since PDFlib version 5, use PDF_load_image()
 * with the colorize, ignoremask, invert, mask, masked, and page options instead.
 *
 * @param resource $pdf
 * @param string $imagetype
 * @param string $filename
 * @param string $stringparam
 * @param int $intparam
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-image-file (deprecated)
 */
function PDF_open_image_file($pdf, $imagetype, $filename, $stringparam, $intparam) {}

/**
 * Use image data [deprecated]
 *
 * Uses image data from a variety of data sources. This function is deprecated since PDFlib version
 * 5, use virtual files and PDF_load_image() instead.
 *
 * @param resource $pdf
 * @param string $imagetype
 * @param string $source
 * @param string $data
 * @param int $length
 * @param int $width
 * @param int $height
 * @param int $components
 * @param int $bpc
 * @param string $params
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-image (deprecated)
 */
function PDF_open_image($pdf, $imagetype, $source, $data, $length, $width, $height, $components, $bpc, $params) {}

/**
 * Open image created with PHP's image functions [not supported]
 *
 * This function is not supported by PDFlib GmbH.
 *
 * @param resource $pdf
 * @param resource $image
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-memory-image (not supported)
 */
function PDF_open_memory_image($pdf, $image) {}

/**
 * Prepare a pdi document
 *
 * Open a disk-based or virtual PDF document and prepare it for later use.
 *
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-pdi-document
 */
function PDF_open_pdi_document($pdf, $filename, $optlist) {}

/**
 * Prepare a page
 *
 * Prepares a page for later use with PDF_fit_pdi_page().
 *
 * @param resource $pdf
 * @param int $doc
 * @param int $pagenumber
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-pdi-page
 */
function PDF_open_pdi_page($pdf, $doc, $pagenumber, $optlist) {}

/**
 * Open PDF file [deprecated]
 *
 * Opens a disk-based or virtual PDF document and prepares it for later use. This function is
 * deprecated since PDFlib version 7, use PDF_open_pdi_document() instead.
 *
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 * @param int $len
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-open-pdi
 */
function PDF_open_pdi($pdf, $filename, $optlist, $len) {}

/**
 * Get value of pCOS path with type number or boolean
 *
 * Gets the value of a pCOS path with type number or boolean.
 *
 * @param resource $pdf
 * @param int $doc
 * @param string $path
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-pcos-get-number
 */
function PDF_pcos_get_number($pdf, $doc, $path) {}

/**
 * Get contents of pCOS path with type stream, fstream, or string
 *
 * Gets the contents of a pCOS path with type stream, fstream, or string.
 *
 * @param resource $pdf
 * @param int $doc
 * @param string $optlist
 * @param string $path
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-pcos-get-stream
 */
function PDF_pcos_get_stream($pdf, $doc, $optlist, $path) {}

/**
 * Get value of pCOS path with type name, string, or boolean
 *
 * Gets the value of a pCOS path with type name, string, or boolean.
 *
 * @param resource $pdf
 * @param int $doc
 * @param string $path
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-pcos-get-string
 */
function PDF_pcos_get_string($pdf, $doc, $path) {}

/**
 * Place image on the page [deprecated]
 *
 * Places an image and scales it. Returns TRUE on success or FALSE on failure. This function is
 * deprecated since PDFlib version 5, use PDF_fit_image() instead.
 *
 * @param resource $pdf
 * @param int $image
 * @param float $x
 * @param float $y
 * @param float $scale
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-place-image (dep)
 */
function PDF_place_image($pdf, $image, $x, $y, $scale) {}

/**
 * Place PDF page [deprecated]
 *
 * Places a PDF page and scales it. Returns TRUE on success or FALSE on failure. This function is
 * deprecated since PDFlib version 5, use PDF_fit_pdi_page() instead.
 *
 * @param resource $pdf
 * @param int $page
 * @param float $x
 * @param float $y
 * @param float $sx
 * @param float $sy
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-place-pdi-page (dep)
 */
function PDF_place_pdi_page($pdf, $page, $x, $y, $sx, $sy) {}

/**
 * Process imported PDF document
 *
 * Processes certain elements of an imported PDF document.
 *
 * @param resource $pdf
 * @param int $doc
 * @param int $page
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-process-pdi
 */
function PDF_process_pdi($pdf, $doc, $page, $optlist) {}

/**
 * Draw rectangle
 *
 * Draws a rectangle. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $x
 * @param float $y
 * @param float $width
 * @param float $height
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-rect
 */
function PDF_rect($pdf, $x, $y, $width, $height) {}

/**
 * Restore graphics state
 *
 * Restores the most recently saved graphics state. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-restore
 */
function PDF_restore($pdf) {}

/**
 * Resume page
 *
 * Resumes a page to add more content to it.
 *
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-resume-page
 */
function PDF_resume_page($pdf, $optlist) {}

/**
 * Rotate coordinate system
 *
 * Rotates the coordinate system. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $phi
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-rotate
 */
function PDF_rotate($pdf, $phi) {}

/**
 * Save graphics state
 *
 * Saves the current graphics state. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-save
 */
function PDF_save($pdf) {}

/**
 * Scale coordinate system
 *
 * Scales the coordinate system. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $sx
 * @param float $sy
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-scale
 */
function PDF_scale($pdf, $sx, $sy) {}

/**
 * Set border color of annotations [deprecated]
 *
 * Sets the border color for all kinds of annotations. Returns TRUE on success or FALSE on failure.
 * This function is deprecated since PDFlib version 6, use the option annotcolor in
 * PDF_create_annotation() instead.
 *
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-border-color (dep)
 */
function PDF_set_border_color($pdf, $red, $green, $blue) {}

/**
 * Set border dash style of annotations [deprecated]
 *
 * Sets the border dash style for all kinds of annotations. Returns TRUE on success or FALSE on
 * failure. This function is deprecated since PDFlib version 6, use the option dasharray in
 * PDF_create_annotation() instead.
 *
 * @param resource $pdf
 * @param float $black
 * @param float $white
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-border-dash (dep)
 */
function PDF_set_border_dash($pdf, $black, $white) {}

/**
 * Set border style of annotations [deprecated]
 *
 * Sets the border style for all kinds of annotations. Returns TRUE on success or FALSE on failure.
 * This function is deprecated since PDFlib version 6, use the options borderstyle and linewidth in
 * PDF_create_annotation() instead.
 *
 * @param resource $pdf
 * @param string $style
 * @param float $width
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-border-style (dep)
 */
function PDF_set_border_style($pdf, $style, $width) {}

/**
 * Activate graphics state object
 *
 * Activates a graphics state object.
 *
 * @param resource $pdf
 * @param int $gstate
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-gstate
 */
function PDF_set_gstate($pdf, $gstate) {}

/**
 * Fill document info field
 *
 * Fill document information field key with value. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $key
 * @param string $value
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-info
 */
function PDF_set_info($pdf, $key, $value) {}

/**
 * Define relationships among layers
 *
 * Defines hierarchical and group relationships among layers. Returns TRUE on success or FALSE on
 * failure. This function requires PDF 1.5.
 *
 * @param resource $pdf
 * @param string $type
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-layer-dependency
 */
function PDF_set_layer_dependency($pdf, $type, $optlist) {}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_set_option($pdf, $optlist) {}

/**
 * Set string parameter
 *
 * Sets some PDFlib parameter with string type. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $key
 * @param string $value
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-parameter
 */
function PDF_set_parameter($pdf, $key, $value) {}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.3.0-API-reference.pdf
 */
function PDF_set_text_option($pdf, $optlist) {}

/**
 * Set text position
 *
 * Sets the position for text output on the page. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-text-pos
 */
function PDF_set_text_pos($pdf, $x, $y) {}

/**
 * Set numerical parameter
 *
 * Sets the value of some PDFlib parameter with numerical type. Returns TRUE on success or FALSE on
 * failure.
 *
 * @param resource $pdf
 * @param string $key
 * @param float $value
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-set-value
 */
function PDF_set_value($pdf, $key, $value) {}

/**
 * Set fill and stroke color
 *
 * Sets the current color space and color. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $fstype
 * @param string $colorspace
 * @param float $c1
 * @param float $c2
 * @param float $c3
 * @param float $c4
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setcolor
 */
function PDF_setcolor($pdf, $fstype, $colorspace, $c1, $c2, $c3, $c4) {}

/**
 * Set simple dash pattern
 *
 * Sets the current dash pattern to b black and w white units. Returns TRUE on success or FALSE on
 * failure.
 *
 * @param resource $pdf
 * @param float $b
 * @param float $w
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setdash
 */
function PDF_setdash($pdf, $b, $w) {}

/**
 * Set dash pattern
 *
 * Sets a dash pattern defined by an option list. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setdashpattern
 */
function PDF_setdashpattern($pdf, $optlist) {}

/**
 * Set flatness
 *
 * Sets the flatness parameter. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $flatness
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setflat
 */
function PDF_setflat($pdf, $flatness) {}

/**
 * Set font
 *
 * Sets the current font in the specified fontsize, using a font handle returned by PDF_load_font().
 * Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param int $font
 * @param float $fontsize
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setfont
 */
function PDF_setfont($pdf, $font, $fontsize) {}

/**
 * Set fill color to gray [deprecated]
 *
 * Sets the current fill color to a gray value between 0 and 1 inclusive. Returns TRUE on success or
 * FALSE on failure. This function is deprecated since PDFlib version 4, use PDF_setcolor() instead.
 *
 * @param resource $pdf
 * @param float $g
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setgray-fill (dep)
 */
function PDF_setgray_fill($pdf, $g) {}

/**
 * Set stroke color to gray [deprecated]
 *
 * Sets the current stroke color to a gray value between 0 and 1 inclusive. Returns TRUE on success
 * or FALSE on failure. This function is deprecated since PDFlib version 4, use PDF_setcolor()
 * instead.
 *
 * @param resource $pdf
 * @param float $g
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setgray-stroke (dep)
 */
function PDF_setgray_stroke($pdf, $g) {}

/**
 * Set color to gray [deprecated]
 *
 * Sets the current fill and stroke color to a gray value between 0 and 1 inclusive. Returns TRUE on
 * success or FALSE on failure. This function is deprecated since PDFlib version 4, use
 * PDF_setcolor() instead.
 *
 * @param resource $pdf
 * @param float $g
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setgray (dep)
 */
function PDF_setgray($pdf, $g) {}

/**
 * Set linecap parameter
 *
 * Sets the linecap parameter to control the shape at the end of a path with respect to stroking.
 *
 * @param resource $pdf
 * @param int $linecap
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setlinecap
 */
function PDF_setlinecap($pdf, $linecap) {}

/**
 * Set linejoin parameter
 *
 * Sets the linejoin parameter to specify the shape at the corners of paths that are stroked.
 * Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param int $value
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setlinejoin
 */
function PDF_setlinejoin($pdf, $value) {}

/**
 * Set line width
 *
 * Sets the current line width. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $width
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setlinewidth
 */
function PDF_setlinewidth($pdf, $width) {}

/**
 * Set current transformation matrix
 *
 * Explicitly sets the current transformation matrix. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $a
 * @param float $b
 * @param float $c
 * @param float $d
 * @param float $e
 * @param float $f
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setmatrix
 */
function PDF_setmatrix($pdf, $a, $b, $c, $d, $e, $f) {}

/**
 * Set miter limit
 *
 * Sets the miter limit.Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $miter
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setmiterlimit
 */
function PDF_setmiterlimit($pdf, $miter) {}

/**
 * Set fill rgb color values [deprecated]
 *
 * Sets the current fill color to the supplied RGB values. Returns TRUE on success or FALSE on
 * failure. This function is deprecated since PDFlib version 4, use PDF_setcolor() instead.
 *
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setrgbcolor-fill (dep)
 */
function PDF_setrgbcolor_fill($pdf, $red, $green, $blue) {}

/**
 * Set stroke rgb color values [deprecated]
 *
 * Sets the current stroke color to the supplied RGB values. Returns TRUE on success or FALSE on
 * failure. This function is deprecated since PDFlib version 4, use PDF_setcolor() instead.
 *
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setrgbcolor-stroke (dep)
 */
function PDF_setrgbcolor_stroke($pdf, $red, $green, $blue) {}

/**
 * Set fill and stroke rgb color values [deprecated]
 *
 * Sets the current fill and stroke color to the supplied RGB values. Returns TRUE on success or
 * FALSE on failure. This function is deprecated since PDFlib version 4, use PDF_setcolor() instead.
 *
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-setrgbcolor (dep)
 */
function PDF_setrgbcolor($pdf, $red, $green, $blue) {}

/**
 * Define shading pattern
 *
 * Defines a shading pattern using a shading object. This function requires PDF 1.4 or above.
 *
 * @param resource $pdf
 * @param int $shading
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-shading-pattern
 */
function PDF_shading_pattern($pdf, $shading, $optlist) {}

/**
 * Define blend
 *
 * Defines a blend from the current fill color to another color. This function requires PDF 1.4 or
 * above.
 *
 * @param resource $pdf
 * @param string $shtype
 * @param float $x0
 * @param float $y0
 * @param float $x1
 * @param float $y1
 * @param float $c1
 * @param float $c2
 * @param float $c3
 * @param float $c4
 * @param string $optlist
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-shading
 */
function PDF_shading($pdf, $shtype, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist) {}

/**
 * Fill area with shading
 *
 * Fills an area with a shading, based on a shading object. This function requires PDF 1.4 or above.
 *
 * @param resource $pdf
 * @param int $shading
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-shfill
 */
function PDF_shfill($pdf, $shading) {}

/**
 * Output text in a box [deprecated]
 *
 * This function is deprecated since PDFlib version 6, use PDF_fit_textline() for single lines, or
 * the PDF_*_textflow() functions for multi-line formatting instead.
 *
 * @param resource $pdf
 * @param string $text
 * @param float $left
 * @param float $top
 * @param float $width
 * @param float $height
 * @param string $mode
 * @param string $feature
 *
 * @return int
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-show-boxed (dep)
 */
function PDF_show_boxed($pdf, $text, $left, $top, $width, $height, $mode, $feature) {}

/**
 * Output text at given position
 *
 * Prints text in the current font. Returns TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param string $text
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-show-xy
 */
function PDF_show_xy($pdf, $text, $x, $y) {}

/**
 * Output text at current position
 *
 * Prints text in the current font and size at the current position. Returns TRUE on success or
 * FALSE on failure.
 *
 * @param resource $pdf
 * @param string $text
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-show
 */
function PDF_show($pdf, $text) {}

/**
 * Skew the coordinate system
 *
 * Skews the coordinate system in x and y direction by alpha and beta degrees, respectively. Returns
 * TRUE on success or FALSE on failure.
 *
 * @param resource $pdf
 * @param float $alpha
 * @param float $beta
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-skew
 */
function PDF_skew($pdf, $alpha, $beta) {}

/**
 * Return width of text
 *
 * Returns the width of text in an arbitrary font.
 *
 * @param resource $pdf
 * @param string $text
 * @param int $font
 * @param float $fontsize
 *
 * @return float
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-stringwidth
 */
function PDF_stringwidth($pdf, $text, $font, $fontsize) {}

/**
 * Stroke path
 *
 * Strokes the path with the current color and line width, and clear it. Returns TRUE on success or
 * FALSE on failure.
 *
 * @param resource $pdf The PDF doc
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-stroke
 */
function PDF_stroke($pdf) {}

/**
 * Suspend page
 *
 * Suspends the current page so that it can later be resumed with PDF_resume_page().
 *
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-suspend-page
 */
function PDF_suspend_page($pdf, $optlist) {}

/**
 * Set origin of coordinate system
 *
 * Translates the origin of the coordinate system.
 *
 * @param resource $pdf
 * @param float $tx
 * @param float $ty
 *
 * @return bool
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-translate
 */
function PDF_translate($pdf, $tx, $ty) {}

/**
 * Convert string from UTF-16 to UTF-8
 *
 * Converts a string from UTF-16 format to UTF-8.
 *
 * @param resource $pdf
 * @param string $utf16string
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-utf16-to-utf8
 */
function PDF_utf16_to_utf8($pdf, $utf16string) {}

/**
 * Convert string from UTF-32 to UTF-16
 *
 * Converts a string from UTF-32 format to UTF-16.
 *
 * @param resource $pdf
 * @param string $utf32string
 * @param string $ordering
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-utf32-to-utf16
 */
function PDF_utf32_to_utf16($pdf, $utf32string, $ordering) {}

/**
 * Convert string from UTF-8 to UTF-16
 *
 * Converts a string from UTF-8 format to UTF-16.
 *
 * @param resource $pdf
 * @param string $utf8string
 * @param string $ordering
 *
 * @return string
 *
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.pdf-utf8-to-utf16
 */
function PDF_utf8_to_utf16($pdf, $utf8string, $ordering) {}
