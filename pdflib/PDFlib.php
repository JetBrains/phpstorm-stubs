<?php
class PDFlib
{
	/**
	 * Activates a previously created structure element or other content item.
	 * @param $id
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-activate-item.php
	 */
	function activate_item($id){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-add-launchlink.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=Launch and PDF_create_annotation() with type=Link instead.
	 */
	function add_launchlink($llx, $lly, $urx, $ury, $filename){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-add-locallink.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoTo and PDF_create_annotation() with type=Link instead.
	 */
	function add_locallink($lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $page, $dest){}

	/**
	 * Creates a named destination on an arbitrary page in the current document.
	 *
	 * @param string $name
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-add-nameddest.php
	 */
	function add_nameddest($name, $optlist){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-add-note.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=Text instead.
	 */
	function add_note($llx, $lly, $urx, $ury, $contents, $title, $icon, $open){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-add-pdflink.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoToR and PDF_create_annotation() with type=Link instead.
	 */
	function add_pdflink($bottom_left_x, $bottom_left_y, $up_right_x, $up_right_y, $filename, $page, $dest){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-add-table-cell.php
	 */
	function add_table_cell($table, $column, $row, $text, $optlist){}

	/**
	 * Creates a Textflow object, or adds text and explicit options to an existing Textflow.
	 *
	 * @param int $textflow
	 * @param string $text
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-add-textflow.php
	 */
	function add_textflow($textflow, $text, $optlist){}

	/**
	 * Adds an existing image as thumbnail for the current page.
	 *
	 * @param int $image
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-add-thumbnail.php
	 */
	function add_thumbnail($image){}

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
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=URI and PDF_create_annotation() with type=Link instead.
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-add-weblink.php
	 */
	function add_weblink($lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $url){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-arc.php
	 */
	function arc($x, $y, $r, $alpha, $beta){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-arcn.php
	 */
	function arcn($x, $y, $r, $alpha, $beta){}

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
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=FileAttachment instead.
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-attach-file.php
	 */
	function attach_file($llx, $lly, $urx, $ury, $filename, $description, $author, $mimetype, $icon){}

	/**
	 * Creates a new PDF file subject to various options.
	 *
	 * @param string $filename
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-document.php
	 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.1.2-API-reference.pdf
	 */
	function begin_document($filename, $optlist){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-begin-font.php
	 */
	function begin_font($filename, $a, $b, $c, $d, $e, $f, $optlist){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-begin-glyph.php
	 */
	function begin_glyph($glyphname, $wx, $llx, $lly, $urx, $ury){}

	/**
	 * Opens a structure element or other content item with attributes supplied as options.
	 *
	 * @param string $tag
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-item.php
	 */
	function begin_item($tag, $optlist){}

	/**
	 * Starts a layer for subsequent output on the page.
	 *
	 * @param int $layer
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-layer.php
	 */
	function begin_layer($layer){}

	/**
	 * Adds a new page to the document, and specifies various options. The parameters width and height are the dimensions of the new page in points.
	 *
	 * @param float $width
	 * @param float $height
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-page-ext.php
	 */
	function begin_page_ext($width, $height, $optlist){}


	/**
	 * Adds a new page to the document.
	 *
	 * @param float $width
	 * @param float $height
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-page.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_begin_page_ext() instead.
	 */
	function begin_page($width, $height){}

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
	 * @link https://secure.php.net/manual/en/function.pdf-begin-pattern.php
	 */
	function begin_pattern($width, $height, $xstep, $ystep, $painttype){}

	/**
	 * Starts a new template definition.
	 *
	 * @param float $width
	 * @param float $height
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-template-ext.php
	 */
	function begin_template_ext($width, $height, $optlist){}

	/**
	 * @param float $width
	 * @param float $height
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-begin-template.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 7, use PDF_begin_template_ext() instead.
	 */
	function begin_template($width, $height){}

	/**
	 * @param float $x
	 * @param float $y
	 * @param float $r
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-circle.php
	 */
	function circle($x, $y, $r){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-clip.php
	 */
	function clip(){}

	/**
	 * @param int $image
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-close-image.php
	 */
	function close_image($image){}

	/**
	 * Closes the page handle, and frees all page-related resources
	 *
	 * @param int $page
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-close-pdi-page.php
	 */
	function close_pdi_page($page){}

	/**
	 * @param int $doc
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-close-pdi.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 7, use PDF_close_pdi_document() instead.
	 */
	function close_pdi($doc){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-close.php
	 *
	 * @deprecated This function is deprecated since PDFlib version 6, use PDF_end_document() instead.
	 */
	function close(){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-closepath-fill-stroke.php
	 */
	function closepath_fill_stroke(){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-closepath-stroke.php
	 */
	function closepath_stroke(){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-closepath.php
	 */
	function closepath(){}

	/**
	 * @param float $a
	 * @param float $b
	 * @param float $c
	 * @param float $d
	 * @param float $e
	 * @param float $f
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-concat.php
	 */
	function concat($a, $b, $c, $d, $e, $f){}

	/**
	 * @param string $text
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-continue-text.php
	 */
	function continue_text($text){}

	/**
	 * @param string $username
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-3dview.php
	 */
	function create_3dview($username, $optlist){}

	/**
	 * @param string $type
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-action.php
	 */
	function create_action($type, $optlist){}

	/**
	 * @param float $llx
	 * @param float $lly
	 * @param float $urx
	 * @param float $ury
	 * @param string $type
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-annotation.php
	 */
	function create_annotation($llx, $lly, $urx, $ury, $type, $optlist){}

	/**
	 * @param string $text
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-bookmark.php
	 */
	function create_bookmark($text, $optlist){}

	/**
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
	 * @link https://secure.php.net/manual/en/function.pdf-create-field.php
	 */
	function create_field($llx, $lly, $urx, $ury, $name, $type, $optlist){}

	/**
	 * @param string $name
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-fieldgroup.php
	 */
	function create_fieldgroup($name, $optlist){}

	/**
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-gstate.php
	 */
	function create_gstate($optlist){}

	/**
	 * @param string $filename
	 * @param string $data
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-pvf.php
	 */
	function create_pvf($filename, $data, $optlist){}

	/**
	 * @param string $text
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-create-textflow.php
	 */
	function create_textflow($text, $optlist){}

	/**
	 * @param float $x1
	 * @param float $y1
	 * @param float $x2
	 * @param float $y2
	 * @param float $x3
	 * @param float $y3
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-curveto.php
	 */
	function curveto($x1, $y1, $x2, $y2, $x3, $y3){}

	/**
	 * @param string $name
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-define-layer.php
	 */
	function define_layer($name, $optlist){}

	/**
	 * @param string $filename
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-delete-pvf.php
	 */
	function delete_pvf($filename){}

	/**
	 * @param int $table
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-delete-table.php
	 */
	function delete_table($table, $optlist){}

	/**
	 * @param int $textflow
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-delete-textflow.php
	 */
	function delete_textflow($textflow){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-delete.php
	 */
	function delete(){}

	/**
	 * @param string $encoding
	 * @param int $slot
	 * @param string $glyphname
	 * @param int $uv
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-encoding-set-char.php
	 */
	function encoding_set_char($encoding, $slot, $glyphname, $uv){}

	/**
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-document.php
	 */
	function end_document($optlist){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-font.php
	 */
	function end_font(){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-glyph.php
	 */
	function end_glyph(){}

	/**
	 * @param int $id
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-item.php
	 */
	function end_item($id){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-layer.php
	 */
	function end_layer(){}

	/**
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-page-ext.php
	 */
	function end_page_ext($optlist){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-page.php
	 */
	function end_page($p){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-pattern.php
	 */
	function end_pattern($p){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-end-template.php
	 */
	function end_template($p){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-endpath.php
	 */
	function endpath($p){}

	/**
	 * @param int $page
	 * @param string $blockname
	 * @param int $image
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fill-imageblock.php
	 */
	function fill_imageblock($page, $blockname, $image, $optlist){}

	/**
	 * @param int $page
	 * @param string $blockname
	 * @param int $contents
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fill-pdfblock.php
	 */
	function fill_pdfblock($page, $blockname, $contents, $optlist){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fill-stroke.php
	 */
	function fill_stroke(){}

	/**
	 * @param int $page
	 * @param string $blockname
	 * @param string $text
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fill-textblock.php

	 */
	function fill_textblock($page, $blockname, $text, $optlist){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fill.php

	 */
	function fill(){}
	/**
	 * @param string $fontname
	 * @param string $encoding
	 * @param int $embed
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-findfont.php(Dep)

	 */
	function findfont($fontname , $encoding , $embed){}
	/**
	 * @param int $image
	 * @param float $x
	 * @param float $y
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fit-image.php

	 */
	function fit_image($image , $x , $y , $optlist){}
	/**
	 * @param int $page
	 * @param float $x
	 * @param float $y
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fit-pdi-page.php

	 */
	function fit_pdi_page($page , $x , $y , $optlist){}
	/**
	 * @param int $table
	 * @param float $llx
	 * @param float $lly
	 * @param float $urx
	 * @param float $ury
	 * @param string $optlist
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fit-table.php

	 */
	function fit_table($table , $llx , $lly , $urx , $ury , $optlist){}
	/**
	 * @param int $textflow
	 * @param float $llx
	 * @param float $lly
	 * @param float $urx
	 * @param float $ury
	 * @param string $optlist
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fit-textflow.php

	 */
	function fit_textflow($textflow , $llx , $lly , $urx , $ury , $optlist){}
	/**
	 * @param string $text
	 * @param float $x
	 * @param float $y
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-fit-textline.php

	 */
	function fit_textline($text , $x , $y , $optlist){}
	/**
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-apiname.php

	 */
	function get_apiname(){}
	/**
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-buffer.php

	 */
	function get_buffer(){}
	/**
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-errmsg.php

	 */
	function get_errmsg(){}
	/**
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-errnum.php

	 */
	function get_errnum(){}
	/**
	 * @param void $
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-majorversion.php(dep)

	 */
	function get_majorversion(){}
	/**
	 * @param void $
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-minorversion.php(dep)

	 */
	function get_minorversion(){}
	/**
	 * @param string $key
	 * @param float $modifier
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-parameter.php

	 */
	function get_parameter($key , $modifier){}
	/**
	 * @param string $key
	 * @param int $doc
	 * @param int $page
	 * @param int $reserved
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-pdi-parameter.php

	 */
	function get_pdi_parameter($key , $doc , $page , $reserved){}
	/**
	 * @param string $key
	 * @param int $doc
	 * @param int $page
	 * @param int $reserved
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-pdi-value.php

	 */
	function get_pdi_value($key , $doc , $page , $reserved){}
	/**
	 * @param string $key
	 * @param float $modifier
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-get-value.php

	 */
	function get_value($key , $modifier){}
	/**
	 * @param int $font
	 * @param string $keyword
	 * @param string $optlist
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-info-font.php

	 */
	function info_font($font , $keyword , $optlist){}
	/**
	 * @param string $boxname
	 * @param int $num
	 * @param string $keyword
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-info-matchbox.php

	 */
	function info_matchbox($boxname , $num , $keyword){}
	/**
	 * @param int $table
	 * @param string $keyword
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-info-table.php

	 */
	function info_table($table , $keyword){}
	/**
	 * @param int $textflow
	 * @param string $keyword
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-info-textflow.php

	 */
	function info_textflow($textflow , $keyword){}

	/**
	 * @param string $text
	 * @param string $keyword
	 * @param string $optlist
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-info-textline.php
	 */
	function info_textline($text , $keyword , $optlist){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-initgraphics.php
	 */
	function initgraphics(){}

	/**
	 * @param float $x
	 * @param float $y
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-lineto.php
	 */
	function lineto($x , $y){}

	/**
	 * @param string $filename
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-load-3ddata.php
	 */
	function load_3ddata($filename , $optlist){}

	/**
	 * @param string $fontname
	 * @param string $encoding
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-load-font.php
	 */
	function load_font($fontname , $encoding , $optlist){}

	/**
	 * @param string $profilename
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-load-iccprofile.php
	 */
	function load_iccprofile($profilename , $optlist){}

	/**
	 * @param string $imagetype
	 * @param string $filename
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-load-image.php
	 */
	function load_image($imagetype , $filename , $optlist){}

	/**
	 * @param string $spotname
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-makespotcolor.php
	 */
	function makespotcolor($spotname){}

	/**
	 * @param float $x
	 * @param float $y
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-moveto.php
	 */
	function moveto($x , $y){}

	/**
	 * @param string $filename
	 * @param int $width
	 * @param int $height
	 * @param int $BitReverse
	 * @param int $k
	 * @param int $Blackls1
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-ccitt.php(dep)
	 */
	function open_ccitt($filename , $width , $height , $BitReverse , $k , $Blackls1){}

	/**
	 * @param string $filename
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-file.php(dep)
	 */
	function open_file($filename){}

	/**
	 * @param string $imagetype
	 * @param string $filename
	 * @param string $stringparam
	 * @param int $intparam
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-image-file.php(dep)
	 */
	function open_image_file($imagetype , $filename , $stringparam , $intparam){}

	/**
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
	 * @link https://secure.php.net/manual/en/function.pdf-open-image.php(dep)
	 */
	function open_image($imagetype , $source , $data , $length , $width , $height , $components , $bpc , $params){}

	/**
	 * @param resource $image
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-memory-image.php(not supported)
	 */
	function open_memory_image($image){}

	/**
	 * @param string $filename
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-pdi-document.php
	 */
	function open_pdi_document($filename , $optlist){}

	/**
	 * @param int $doc
	 * @param int $pagenumber
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-pdi-page.php
	 */
	function open_pdi_page($doc , $pagenumber , $optlist){}

	/**
	 * @param string $filename
	 * @param string $optlist
	 * @param int $len
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-open-pdi.php
	 */
	function open_pdi($filename , $optlist , $len){}

	/**
	 * @param int $doc
	 * @param string $path
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-pcos-get-number.php
	 */
	function pcos_get_number($doc , $path){}

	/**
	 * @param int $doc
	 * @param string $optlist
	 * @param string $path
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-pcos-get-stream.php
	 */
	function pcos_get_stream($doc, $optlist, $path){}

	/**
	 * @param int $doc
	 * @param string $path
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-pcos-get-string.php
	 */
	function pcos_get_string($doc, $path){}

	/**
	 * @param int $image
	 * @param float $x
	 * @param float $y
	 * @param float $scale
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-place-image.php (dep)
	 */
	function place_image($image, $x, $y, $scale){}

	/**
	 * @param int $page
	 * @param float $x
	 * @param float $y
	 * @param float $sx
	 * @param float $sy
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-place-pdi-page.php (dep)
	 */
	function place_pdi_page($page, $x, $y, $sx, $sy){}

	/**
	 * @param int $doc
	 * @param int $page
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-process-pdi.php
	 */
	function process_pdi($doc, $page, $optlist){}

	/**
	 * @param float $x
	 * @param float $y
	 * @param float $width
	 * @param float $height
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-rect.php
	 */
	function rect($x, $y, $width, $height){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-restore.php
	 */
	function restore($p){}

	/**
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-resume-page.php
	 */
	function resume_page($optlist){}

	/**
	 * @param float $phi
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-rotate.php
	 */
	function rotate($phi){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-save.php
	 */
	function save($p){}

	/**
	 * @param float $sx
	 * @param float $sy
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-scale.php
	 */
	function scale($sx, $sy){}

	/**
	 * @param float $red
	 * @param float $green
	 * @param float $blue
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-border-color.php (dep)
	 */
	function set_border_color($red, $green, $blue){}

	/**
	 * @param float $black
	 * @param float $white
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-border-dash.php (dep)
	 */
	function set_border_dash($black, $white){}

	/**
	 * @param string $style
	 * @param float $width
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-border-style.php (dep)
	 */
	function set_border_style($style, $width){}

	/**
	 * @param int $gstate
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-gstate.php
	 */
	function set_gstate($gstate){}

	/**
	 * @param string $key
	 * @param string $value
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-info.php
	 */
	function set_info($key, $value){}

	/**
	 * @param string $type
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-layer-dependency.php
	 */
	function set_layer_dependency($type, $optlist){}

	/**
	 * @param string $key
	 * @param string $value
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-parameter.php
	 */
	function set_parameter($key, $value){}

	/**
	 * @param float $x
	 * @param float $y
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-text-pos.php
	 */
	function set_text_pos($x, $y){}

	/**
	 * @param string $key
	 * @param float $value
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-set-value.php
	 */
	function set_value($key, $value){}

	/**
	 * @param string $fstype
	 * @param string $colorspace
	 * @param float $c1
	 * @param float $c2
	 * @param float $c3
	 * @param float $c4
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setcolor.php
	 */
	function setcolor($fstype, $colorspace, $c1, $c2, $c3, $c4){}

	/**
	 * @param float $b
	 * @param float $w
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setdash.php
	 */
	function setdash($b, $w){}

	/**
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setdashpattern.php
	 */
	function setdashpattern($optlist){}

	/**
	 * @param float $flatness
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setflat.php
	 */
	function setflat($flatness){}

	/**
	 * @param int $font
	 * @param float $fontsize
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setfont.php
	 */
	function setfont($font, $fontsize){}

	/**
	 * @param float $g
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setgray-fill.php (dep)
	 */
	function setgray_fill($g){}

	/**
	 * @param float $g
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setgray-stroke.php (dep)
	 */
	function setgray_stroke($g){}

	/**
	 * @param float $g
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setgray.php (dep)
	 */
	function setgray($g){}

	/**
	 * @param int $linecap
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setlinecap.php
	 */
	function setlinecap($linecap){}

	/**
	 * @param int $value
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setlinejoin.php
	 */
	function setlinejoin($value){}

	/**
	 * @param float $width
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setlinewidth.php
	 */
	function setlinewidth($width){}

	/**
	 * @param float $a
	 * @param float $b
	 * @param float $c
	 * @param float $d
	 * @param float $e
	 * @param float $f
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setmatrix.php
	 */
	function setmatrix($a, $b, $c, $d, $e, $f){}

	/**
	 * @param float $miter
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setmiterlimit.php
	 */
	function setmiterlimit($miter){}

	/**
	 * @param float $red
	 * @param float $green
	 * @param float $blue
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setrgbcolor-fill.php (dep)
	 */
	function setrgbcolor_fill($red, $green, $blue){}

	/**
	 * @param float $red
	 * @param float $green
	 * @param float $blue
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setrgbcolor-stroke.php (dep)
	 */
	function setrgbcolor_stroke($red, $green, $blue){}

	/**
	 * @param float $red
	 * @param float $green
	 * @param float $blue
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-setrgbcolor.php (dep)
	 */
	function setrgbcolor($red, $green, $blue){}

	/**
	 * @param int $shading
	 * @param string $optlist
	 *
	 * @return int
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-shading-pattern.php
	 */
	function shading_pattern($shading, $optlist){}

	/**
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
	 * @link https://secure.php.net/manual/en/function.pdf-shading.php
	 */
	function shading($shtype, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist){}

	/**
	 * @param int $shading
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-shfill.php
	 */
	function shfill($shading){}

	/**
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
	 * @link https://secure.php.net/manual/en/function.pdf-show-boxed.php (dep)
	 */
	function show_boxed($text, $left, $top, $width, $height, $mode, $feature){}

	/**
	 * @param string $text
	 * @param float $x
	 * @param float $y
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-show-xy.php
	 */
	function show_xy($text, $x, $y){}

	/**
	 * @param string $text
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-show.php
	 */
	function show($text){}

	/**
	 * @param float $alpha
	 * @param float $beta
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-skew.php
	 */
	function skew($alpha, $beta){}

	/**
	 * @param string $text
	 * @param int $font
	 * @param float $fontsize
	 *
	 * @return float
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-stringwidth.php
	 */
	function stringwidth($text, $font, $fontsize){}

	/**
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-stroke.php
	 */
	function stroke($p){}

	/**
	 * @param string $optlist
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-suspend-page.php
	 */
	function suspend_page($optlist){}

	/**
	 * @param float $tx
	 * @param float $ty
	 *
	 * @return bool
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-translate.php
	 */
	function translate($tx, $ty){}

	/**
	 * @param string $utf16string
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-utf16-to-utf8.php
	 */
	function utf16_to_utf8($utf16string){}

	/**
	 * @param string $utf32string
	 * @param string $ordering
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-utf32-to-utf16.php
	 */
	function utf32_to_utf16($utf32string, $ordering){}

	/**
	 * @param string $utf8string
	 * @param string $ordering
	 *
	 * @return string
	 *
	 * @link https://secure.php.net/manual/en/function.pdf-utf8-to-utf16.php
	 */
	function utf8_to_utf16($utf8string, $ordering){}

}

/**
 * Activates a previously created structure element or other content item.
 * @param $pdf
 * @param $id
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-activate-item.php
 */
function PDF_activate_item($pdf, $id){}

/**
 * Adds a link to a web resource.
 * @param resource $pdf
 * @param float $llx
 * @param float $lly
 * @param float $urx
 * @param float $ury
 * @param string $filename
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-add-launchlink.php
 *
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=Launch and PDF_create_annotation() with type=Link instead.
 */
function PDF_add_launchlink($pdf, $llx, $lly, $urx, $ury, $filename){}

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
 * @link https://secure.php.net/manual/en/function.pdf-add-locallink.php
 *
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoTo and PDF_create_annotation() with type=Link instead.
 */
function PDF_add_locallink($pdf, $lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $page, $dest){}

/**
 * Creates a named destination on an arbitrary page in the current document.
 *
 * @param resource $pdf
 * @param string $name
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-add-nameddest.php
 */
function PDF_add_nameddest($pdf, $name, $optlist){}

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
 * @link https://secure.php.net/manual/en/function.pdf-add-note.php
 *
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=Text instead.
 */
function PDF_add_note($pdf, $llx, $lly, $urx, $ury, $contents, $title, $icon, $open){}

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
 * @link https://secure.php.net/manual/en/function.pdf-add-pdflink.php
 *
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=GoToR and PDF_create_annotation() with type=Link instead.
 */
function PDF_add_pdflink($pdf, $bottom_left_x, $bottom_left_y, $up_right_x, $up_right_y, $filename, $page, $dest){}

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
 * @link https://secure.php.net/manual/en/function.pdf-add-table-cell.php
 */
function PDF_add_table_cell($pdf, $table, $column, $row, $text, $optlist){}

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
 * @link https://secure.php.net/manual/en/function.pdf-add-textflow.php
 */
function PDF_add_textflow($pdf , $textflow , $text , $optlist){}

/**
 * Adds an existing image as thumbnail for the current page.
 *
 * @param resource $pdf
 * @param int $image
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-add-thumbnail.php
 */
function PDF_add_thumbnail($pdf, $image){}

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
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_action() with type=URI and PDF_create_annotation() with type=Link instead.
 *
 * @link https://secure.php.net/manual/en/function.pdf-add-weblink.php
 */
function PDF_add_weblink($pdf, $lowerleftx, $lowerlefty, $upperrightx, $upperrighty, $url){}

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
 * @link https://secure.php.net/manual/en/function.pdf-arc.php
 */
function PDF_arc($pdf, $x, $y, $r, $alpha, $beta){}

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
 * @link https://secure.php.net/manual/en/function.pdf-arcn.php
 */
function PDF_arcn($pdf, $x, $y, $r, $alpha, $beta){}

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
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_create_annotation() with type=FileAttachment instead.
 *
 * @link https://secure.php.net/manual/en/function.pdf-attach-file.php
 */
function PDF_attach_file($pdf, $llx, $lly, $urx, $ury, $filename, $description, $author, $mimetype, $icon){}

/**
 * Creates a new PDF file subject to various options.
 *
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-begin-document.php
 * @link https://www.pdflib.com/fileadmin/pdflib/pdf/manuals/PDFlib-9.1.2-API-reference.pdf
 */
function PDF_begin_document($pdf, $filename, $optlist){}

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
 * @link https://secure.php.net/manual/en/function.pdf-begin-font.php
 */
function PDF_begin_font($pdf, $filename, $a, $b, $c, $d, $e, $f, $optlist){}

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
 * @link https://secure.php.net/manual/en/function.pdf-begin-glyph.php
 */
function PDF_begin_glyph($pdf, $glyphname, $wx, $llx, $lly, $urx, $ury){}

/**
 * Opens a structure element or other content item with attributes supplied as options.
 *
 * @param resource $pdf
 * @param string $tag
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-begin-item.php
 */
function PDF_begin_item($pdf, $tag, $optlist){}

/**
 * Starts a layer for subsequent output on the page.
 *
 * @param resource $pdf
 * @param int $layer
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-begin-layer.php
 */
function PDF_begin_layer($pdf, $layer){}

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
 * @link https://secure.php.net/manual/en/function.pdf-begin-page-ext.php
 */
function PDF_begin_page_ext($pdf, $width, $height, $optlist){}


/**
 * Adds a new page to the document.
 *
 * @param resource $pdf
 * @param float $width
 * @param float $height
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-begin-page.php
 *
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_begin_page_ext() instead.
 */
function PDF_begin_page($pdf, $width, $height){}

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
 * @link https://secure.php.net/manual/en/function.pdf-begin-pattern.php
 */
function PDF_begin_pattern($pdf, $width, $height, $xstep, $ystep, $painttype){}

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
 * @link https://secure.php.net/manual/en/function.pdf-begin-template-ext.php
 */
function PDF_begin_template_ext($pdf, $width, $height, $optlist){}

/**
 * @param resource $pdf
 * @param float $width
 * @param float $height
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-begin-template.php
 *
 * @deprecated This function is deprecated since PDFlib version 7, use PDF_begin_template_ext() instead.
 */
function PDF_begin_template($pdf, $width, $height){}

/**
 * @param resource $pdf
 * @param float $x
 * @param float $y
 * @param float $r
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-circle.php
 */
function PDF_circle($pdf, $x, $y, $r){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-clip.php
 */
function PDF_clip($pdf){}

/**
 * @param resource $pdf
 * @param int $image
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-close-image.php
 */
function PDF_close_image($pdf, $image){}

/**
 * Closes the page handle, and frees all page-related resources
 *
 * @param resource $pdf
 * @param int $page
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-close-pdi-page.php
 */
function PDF_close_pdi_page($pdf, $page){}

/**
 * @param resource $pdf
 * @param int $doc
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-close-pdi.php
 *
 * @deprecated This function is deprecated since PDFlib version 7, use PDF_close_pdi_document() instead.
 */
function PDF_close_pdi($pdf, $doc){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-close.php
 *
 * @deprecated This function is deprecated since PDFlib version 6, use PDF_end_document() instead.
 */
function PDF_close($pdf){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-closepath-fill-stroke.php
 */
function PDF_closepath_fill_stroke($pdf){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-closepath-stroke.php
 */
function PDF_closepath_stroke($pdf){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-closepath.php
 */
function PDF_closepath($pdf){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-concat.php
 */
function PDF_concat($pdf, $a, $b, $c, $d, $e, $f){}

/**
 * @param resource $pdf
 * @param string $text
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-continue-text.php
 */
function PDF_continue_text($pdf, $text){}

/**
 * @param resource $pdf
 * @param string $username
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-3dview.php
 */
function PDF_create_3dview($pdf, $username, $optlist){}

/**
 * @param resource $pdf
 * @param string $type
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-action.php
 */
function PDF_create_action($pdf, $type, $optlist){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-create-annotation.php
 */
function PDF_create_annotation($pdf, $llx, $lly, $urx, $ury, $type, $optlist){}

/**
 * @param resource $pdf
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-bookmark.php
 */
function PDF_create_bookmark($pdf, $text, $optlist){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-create-field.php
 */
function PDF_create_field($pdf, $llx, $lly, $urx, $ury, $name, $type, $optlist){}

/**
 * @param resource $pdf
 * @param string $name
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-fieldgroup.php
 */
function PDF_create_fieldgroup($pdf, $name, $optlist){}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-gstate.php
 */
function PDF_create_gstate($pdf, $optlist){}

/**
 * @param resource $pdf
 * @param string $filename
 * @param string $data
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-pvf.php
 */
function PDF_create_pvf($pdf, $filename, $data, $optlist){}

/**
 * @param resource $pdf
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-create-textflow.php
 */
function PDF_create_textflow($pdf, $text, $optlist){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-curveto.php
 */
function PDF_curveto($pdf, $x1, $y1, $x2, $y2, $x3, $y3){}

/**
 * @param resource $pdf
 * @param string $name
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-define-layer.php
 */
function PDF_define_layer($pdf, $name, $optlist){}

/**
 * @param resource $pdf
 * @param string $filename
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-delete-pvf.php
 */
function PDF_delete_pvf($pdf, $filename){}

/**
 * @param resource $pdf
 * @param int $table
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-delete-table.php
 */
function PDF_delete_table($pdf, $table, $optlist){}

/**
 * @param resource $pdf
 * @param int $textflow
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-delete-textflow.php
 */
function PDF_delete_textflow($pdf, $textflow){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-delete.php
 */
function PDF_delete($pdf){}

/**
 * @param resource $pdf
 * @param string $encoding
 * @param int $slot
 * @param string $glyphname
 * @param int $uv
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-encoding-set-char.php
 */
function PDF_encoding_set_char($pdf, $encoding, $slot, $glyphname, $uv){}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-document.php
 */
function PDF_end_document($pdf, $optlist){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-font.php
 */
function PDF_end_font($pdf){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-glyph.php
 */
function PDF_end_glyph($pdf){}

/**
 * @param resource $pdf
 * @param int $id
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-item.php
 */
function PDF_end_item($pdf, $id){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-layer.php
 */
function PDF_end_layer($pdf){}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-page-ext.php
 */
function PDF_end_page_ext($pdf, $optlist){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-page.php
 */
function PDF_end_page($p){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-pattern.php
 */
function PDF_end_pattern($p){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-end-template.php
 */
function PDF_end_template($p){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-endpath.php
 */
function PDF_endpath($p){}

/**
 * @param resource $pdf
 * @param int $page
 * @param string $blockname
 * @param int $image
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-fill-imageblock.php
 */
function PDF_fill_imageblock($pdf, $page, $blockname, $image, $optlist){}

/**
 * @param resource $pdf
 * @param int $page
 * @param string $blockname
 * @param int $contents
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-fill-pdfblock.php
 */
function PDF_fill_pdfblock($pdf, $page, $blockname, $contents, $optlist){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-fill-stroke.php
 */
function PDF_fill_stroke($pdf){}

/**
 * @param resource $pdf
 * @param int $page
 * @param string $blockname
 * @param string $text
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-fill-textblock.php

 */
function PDF_fill_textblock($pdf, $page, $blockname, $text, $optlist){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-fill.php

 */
function PDF_fill($pdf){}
/**
 * @param resource $pdf
 * @param string $fontname
 * @param string $encoding
 * @param int $embed
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-findfont.php(Dep)

 */
function PDF_findfont($pdf, $fontname , $encoding , $embed){}
/**
 * @param resource $pdf
 * @param int $image
 * @param float $x
 * @param float $y
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-fit-image.php

 */
function PDF_fit_image($pdf, $image , $x , $y , $optlist){}
/**
 * @param resource $pdf
 * @param int $page
 * @param float $x
 * @param float $y
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-fit-pdi-page.php

 */
function PDF_fit_pdi_page($pdf, $page , $x , $y , $optlist){}
/**
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
 * @link https://secure.php.net/manual/en/function.pdf-fit-table.php

 */
function PDF_fit_table($pdf, $table , $llx , $lly , $urx , $ury , $optlist){}
/**
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
 * @link https://secure.php.net/manual/en/function.pdf-fit-textflow.php

 */
function PDF_fit_textflow($pdf, $textflow , $llx , $lly , $urx , $ury , $optlist){}
/**
 * @param resource $pdf
 * @param string $text
 * @param float $x
 * @param float $y
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-fit-textline.php

 */
function PDF_fit_textline($pdf, $text , $x , $y , $optlist){}
/**
 * @param resource $pdf
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-apiname.php

 */
function PDF_get_apiname($pdf){}
/**
 * @param resource $pdf
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-buffer.php

 */
function PDF_get_buffer($pdf){}
/**
 * @param resource $pdf
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-errmsg.php

 */
function PDF_get_errmsg($pdf){}
/**
 * @param resource $pdf
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-errnum.php

 */
function PDF_get_errnum($pdf){}
/**
 * @param void $
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-majorversion.php(dep)

 */
function PDF_get_majorversion(){}
/**
 * @param void $
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-minorversion.php(dep)

 */
function PDF_get_minorversion(){}
/**
 * @param resource $pdf
 * @param string $key
 * @param float $modifier
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-parameter.php

 */
function PDF_get_parameter($pdf, $key , $modifier){}
/**
 * @param resource $pdf
 * @param string $key
 * @param int $doc
 * @param int $page
 * @param int $reserved
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-pdi-parameter.php

 */
function PDF_get_pdi_parameter($pdf, $key , $doc , $page , $reserved){}
/**
 * @param resource $pdf
 * @param string $key
 * @param int $doc
 * @param int $page
 * @param int $reserved
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-pdi-value.php

 */
function PDF_get_pdi_value($pdf, $key , $doc , $page , $reserved){}
/**
 * @param resource $pdf
 * @param string $key
 * @param float $modifier
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-get-value.php

 */
function PDF_get_value($pdf, $key , $modifier){}
/**
 * @param resource $pdf
 * @param int $font
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-info-font.php

 */
function PDF_info_font($pdf, $font , $keyword , $optlist){}
/**
 * @param resource $pdf
 * @param string $boxname
 * @param int $num
 * @param string $keyword
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-info-matchbox.php

 */
function PDF_info_matchbox($pdf, $boxname , $num , $keyword){}
/**
 * @param resource $pdf
 * @param int $table
 * @param string $keyword
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-info-table.php

 */
function PDF_info_table($pdf, $table , $keyword){}
/**
 * @param resource $pdf
 * @param int $textflow
 * @param string $keyword
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-info-textflow.php

 */
function PDF_info_textflow($pdf, $textflow , $keyword){}

/**
 * @param resource $pdf
 * @param string $text
 * @param string $keyword
 * @param string $optlist
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-info-textline.php
 */
function PDF_info_textline($pdf, $text , $keyword , $optlist){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-initgraphics.php
 */
function PDF_initgraphics($pdf){}

/**
 * @param resource $pdf
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-lineto.php
 */
function PDF_lineto($pdf, $x , $y){}

/**
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-load-3ddata.php
 */
function PDF_load_3ddata($pdf, $filename , $optlist){}

/**
 * @param resource $pdf
 * @param string $fontname
 * @param string $encoding
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-load-font.php
 */
function PDF_load_font($pdf, $fontname , $encoding , $optlist){}

/**
 * @param resource $pdf
 * @param string $profilename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-load-iccprofile.php
 */
function PDF_load_iccprofile($pdf, $profilename , $optlist){}

/**
 * @param resource $pdf
 * @param string $imagetype
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-load-image.php
 */
function PDF_load_image($pdf, $imagetype , $filename , $optlist){}

/**
 * @param resource $pdf
 * @param string $spotname
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-makespotcolor.php
 */
function PDF_makespotcolor($pdf, $spotname){}

/**
 * @param resource $pdf
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-moveto.php
 */
function PDF_moveto($pdf, $x , $y){}

/**
 * @return resource
 *
 * @link https://secure.php.net/manual/en/function.pdf-new.php
 */
function PDF_new(){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-open-ccitt.php(dep)
 */
function PDF_open_ccitt($pdf, $filename , $width , $height , $BitReverse , $k , $Blackls1){}

/**
 * @param resource $pdf
 * @param string $filename
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-open-file.php(dep)
 */
function PDF_open_file($pdf, $filename){}

/**
 * @param resource $pdf
 * @param string $imagetype
 * @param string $filename
 * @param string $stringparam
 * @param int $intparam
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-open-image-file.php(dep)
 */
function PDF_open_image_file($pdf, $imagetype , $filename , $stringparam , $intparam){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-open-image.php(dep)
 */
function PDF_open_image($pdf, $imagetype , $source , $data , $length , $width , $height , $components , $bpc , $params){}

/**
 * @param resource $pdf
 * @param resource $image
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-open-memory-image.php(not supported)
 */
function PDF_open_memory_image($pdf, $image){}

/**
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-open-pdi-document.php
 */
function PDF_open_pdi_document($pdf, $filename , $optlist){}

/**
 * @param resource $pdf
 * @param int $doc
 * @param int $pagenumber
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-open-pdi-page.php
 */
function PDF_open_pdi_page($pdf, $doc , $pagenumber , $optlist){}

/**
 * @param resource $pdf
 * @param string $filename
 * @param string $optlist
 * @param int $len
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-open-pdi.php
 */
function PDF_open_pdi($pdf, $filename , $optlist , $len){}

/**
 * @param resource $pdf
 * @param int $doc
 * @param string $path
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-pcos-get-number.php
 */
function PDF_pcos_get_number($pdf, $doc , $path){}

/**
 * @param resource $pdf
 * @param int $doc
 * @param string $optlist
 * @param string $path
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-pcos-get-stream.php
 */
function PDF_pcos_get_stream($pdf, $doc, $optlist, $path){}

/**
 * @param resource $pdf
 * @param int $doc
 * @param string $path
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-pcos-get-string.php
 */
function PDF_pcos_get_string($pdf, $doc, $path){}

/**
 * @param resource $pdf
 * @param int $image
 * @param float $x
 * @param float $y
 * @param float $scale
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-place-image.php (dep)
 */
function PDF_place_image($pdf, $image, $x, $y, $scale){}

/**
 * @param resource $pdf
 * @param int $page
 * @param float $x
 * @param float $y
 * @param float $sx
 * @param float $sy
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-place-pdi-page.php (dep)
 */
function PDF_place_pdi_page($pdf, $page, $x, $y, $sx, $sy){}

/**
 * @param resource $pdf
 * @param int $doc
 * @param int $page
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-process-pdi.php
 */
function PDF_process_pdi($pdf, $doc, $page, $optlist){}

/**
 * @param resource $pdf
 * @param float $x
 * @param float $y
 * @param float $width
 * @param float $height
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-rect.php
 */
function PDF_rect($pdf, $x, $y, $width, $height){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-restore.php
 */
function PDF_restore($p){}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-resume-page.php
 */
function PDF_resume_page($pdf, $optlist){}

/**
 * @param resource $pdf
 * @param float $phi
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-rotate.php
 */
function PDF_rotate($pdf, $phi){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-save.php
 */
function PDF_save($p){}

/**
 * @param resource $pdf
 * @param float $sx
 * @param float $sy
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-scale.php
 */
function PDF_scale($pdf, $sx, $sy){}

/**
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-border-color.php (dep)
 */
function PDF_set_border_color($pdf, $red, $green, $blue){}

/**
 * @param resource $pdf
 * @param float $black
 * @param float $white
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-border-dash.php (dep)
 */
function PDF_set_border_dash($pdf, $black, $white){}

/**
 * @param resource $pdf
 * @param string $style
 * @param float $width
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-border-style.php (dep)
 */
function PDF_set_border_style($pdf, $style, $width){}

/**
 * @param resource $pdf
 * @param int $gstate
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-gstate.php
 */
function PDF_set_gstate($pdf, $gstate){}

/**
 * @param resource $pdf
 * @param string $key
 * @param string $value
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-info.php
 */
function PDF_set_info($pdf, $key, $value){}

/**
 * @param resource $pdf
 * @param string $type
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-layer-dependency.php
 */
function PDF_set_layer_dependency($pdf, $type, $optlist){}

/**
 * @param resource $pdf
 * @param string $key
 * @param string $value
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-parameter.php
 */
function PDF_set_parameter($pdf, $key, $value){}

/**
 * @param resource $pdf
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-text-pos.php
 */
function PDF_set_text_pos($pdf, $x, $y){}

/**
 * @param resource $pdf
 * @param string $key
 * @param float $value
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-set-value.php
 */
function PDF_set_value($pdf, $key, $value){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-setcolor.php
 */
function PDF_setcolor($pdf, $fstype, $colorspace, $c1, $c2, $c3, $c4){}

/**
 * @param resource $pdf
 * @param float $b
 * @param float $w
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setdash.php
 */
function PDF_setdash($pdf, $b, $w){}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setdashpattern.php
 */
function PDF_setdashpattern($pdf, $optlist){}

/**
 * @param resource $pdf
 * @param float $flatness
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setflat.php
 */
function PDF_setflat($pdf, $flatness){}

/**
 * @param resource $pdf
 * @param int $font
 * @param float $fontsize
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setfont.php
 */
function PDF_setfont($pdf, $font, $fontsize){}

/**
 * @param resource $pdf
 * @param float $g
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setgray-fill.php (dep)
 */
function PDF_setgray_fill($pdf, $g){}

/**
 * @param resource $pdf
 * @param float $g
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setgray-stroke.php (dep)
 */
function PDF_setgray_stroke($pdf, $g){}

/**
 * @param resource $pdf
 * @param float $g
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setgray.php (dep)
 */
function PDF_setgray($pdf, $g){}

/**
 * @param resource $pdf
 * @param int $linecap
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setlinecap.php
 */
function PDF_setlinecap($pdf, $linecap){}

/**
 * @param resource $pdf
 * @param int $value
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setlinejoin.php
 */
function PDF_setlinejoin($pdf, $value){}

/**
 * @param resource $pdf
 * @param float $width
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setlinewidth.php
 */
function PDF_setlinewidth($pdf, $width){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-setmatrix.php
 */
function PDF_setmatrix($pdf, $a, $b, $c, $d, $e, $f){}

/**
 * @param resource $pdf
 * @param float $miter
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setmiterlimit.php
 */
function PDF_setmiterlimit($pdf, $miter){}

/**
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setrgbcolor-fill.php (dep)
 */
function PDF_setrgbcolor_fill($pdf, $red, $green, $blue){}

/**
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setrgbcolor-stroke.php (dep)
 */
function PDF_setrgbcolor_stroke($pdf, $red, $green, $blue){}

/**
 * @param resource $pdf
 * @param float $red
 * @param float $green
 * @param float $blue
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-setrgbcolor.php (dep)
 */
function PDF_setrgbcolor($pdf, $red, $green, $blue){}

/**
 * @param resource $pdf
 * @param int $shading
 * @param string $optlist
 *
 * @return int
 *
 * @link https://secure.php.net/manual/en/function.pdf-shading-pattern.php
 */
function PDF_shading_pattern($pdf, $shading, $optlist){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-shading.php
 */
function PDF_shading($pdf, $shtype, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist){}

/**
 * @param resource $pdf
 * @param int $shading
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-shfill.php
 */
function PDF_shfill($pdf, $shading){}

/**
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
 * @link https://secure.php.net/manual/en/function.pdf-show-boxed.php (dep)
 */
function PDF_show_boxed($pdf, $text, $left, $top, $width, $height, $mode, $feature){}

/**
 * @param resource $pdf
 * @param string $text
 * @param float $x
 * @param float $y
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-show-xy.php
 */
function PDF_show_xy($pdf, $text, $x, $y){}

/**
 * @param resource $pdf
 * @param string $text
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-show.php
 */
function PDF_show($pdf, $text){}

/**
 * @param resource $pdf
 * @param float $alpha
 * @param float $beta
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-skew.php
 */
function PDF_skew($pdf, $alpha, $beta){}

/**
 * @param resource $pdf
 * @param string $text
 * @param int $font
 * @param float $fontsize
 *
 * @return float
 *
 * @link https://secure.php.net/manual/en/function.pdf-stringwidth.php
 */
function PDF_stringwidth($pdf, $text, $font, $fontsize){}

/**
 * @param resource $pdf
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-stroke.php
 */
function PDF_stroke($p){}

/**
 * @param resource $pdf
 * @param string $optlist
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-suspend-page.php
 */
function PDF_suspend_page($pdf, $optlist){}

/**
 * @param resource $pdf
 * @param float $tx
 * @param float $ty
 *
 * @return bool
 *
 * @link https://secure.php.net/manual/en/function.pdf-translate.php
 */
function PDF_translate($pdf, $tx, $ty){}

/**
 * @param resource $pdf
 * @param string $utf16string
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-utf16-to-utf8.php
 */
function PDF_utf16_to_utf8($pdf, $utf16string){}

/**
 * @param resource $pdf
 * @param string $utf32string
 * @param string $ordering
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-utf32-to-utf16.php
 */
function PDF_utf32_to_utf16($pdf, $utf32string, $ordering){}

/**
 * @param resource $pdf
 * @param string $utf8string
 * @param string $ordering
 *
 * @return string
 *
 * @link https://secure.php.net/manual/en/function.pdf-utf8-to-utf16.php
 */
function PDF_utf8_to_utf16($pdf, $utf8string, $ordering){}
