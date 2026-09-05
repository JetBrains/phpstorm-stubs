<?php

// Start of ps v.1.4.4

/**
 * Appearance of line ends, for ps_setlinecap().
 * @link https://php.net/manual/en/ps.constants.php
 */
define('PS_LINECAP_BUTT', 0);
define('PS_LINECAP_ROUND', 1);
define('PS_LINECAP_SQUARED', 2);

/**
 * How connected lines are joined, for ps_setlinejoin().
 * @link https://php.net/manual/en/ps.constants.php
 */
define('PS_LINEJOIN_MITER', 0);
define('PS_LINEJOIN_ROUND', 1);
define('PS_LINEJOIN_BEVEL', 2);

/**
 * Creates a new PostScript document object
 *
 * @link https://php.net/manual/en/function.ps-new.php
 *
 * @return resource|false
 */
function ps_new() {}

/**
 * Deletes all resources of a PostScript document
 *
 * @link https://php.net/manual/en/function.ps-delete.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_delete($psdoc) {}

/**
 * Opens a file for output
 *
 * @link https://php.net/manual/en/function.ps-open-file.php
 *
 * @param resource $psdoc
 * @param string   $filename
 *
 * @return bool
 */
function ps_open_file($psdoc, $filename = null) {}

/**
 * Fetches the full buffer containing the generated PS data
 *
 * @link https://php.net/manual/en/function.ps-get-buffer.php
 *
 * @param resource $psdoc
 *
 * @return string
 */
function ps_get_buffer($psdoc) {}

/**
 * Closes a PostScript document
 *
 * @link https://php.net/manual/en/function.ps-close.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_close($psdoc) {}

/**
 * Start a new page
 *
 * @link https://php.net/manual/en/function.ps-begin-page.php
 *
 * @param resource $psdoc
 * @param float    $width
 * @param float    $height
 *
 * @return bool
 */
function ps_begin_page($psdoc, $width, $height) {}

/**
 * End a page
 *
 * @link https://php.net/manual/en/function.ps-end-page.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_end_page($psdoc) {}

/**
 * Gets certain values
 *
 * @link https://php.net/manual/en/function.ps-get-value.php
 *
 * @param resource $psdoc
 * @param string   $key
 * @param int      $modifier
 *
 * @return float
 */
function ps_get_value($psdoc, $key, $modifier = null) {}

/**
 * Sets certain values
 *
 * @link https://php.net/manual/en/function.ps-set-value.php
 *
 * @param resource $psdoc
 * @param string   $key
 * @param float    $value
 *
 * @return bool
 */
function ps_set_value($psdoc, $key, $value) {}

/**
 * Gets certain parameters
 *
 * @link https://php.net/manual/en/function.ps-get-parameter.php
 *
 * @param resource $psdoc
 * @param string   $key
 * @param float    $modifier
 *
 * @return string
 */
function ps_get_parameter($psdoc, $key, $modifier = null) {}

/**
 * Sets certain parameters
 *
 * @link https://php.net/manual/en/function.ps-set-parameter.php
 *
 * @param resource $psdoc
 * @param string   $key
 * @param string   $value
 *
 * @return bool
 */
function ps_set_parameter($psdoc, $key, $value) {}

/**
 * Loads a font
 *
 * @link https://php.net/manual/en/function.ps-findfont.php
 *
 * @param resource $psdoc
 * @param string   $fontname
 * @param string   $encoding
 * @param bool     $embed
 *
 * @return int|false
 */
function ps_findfont($psdoc, $fontname, $encoding, $embed = null) {}

/**
 * Sets font to use for following output
 *
 * @link https://php.net/manual/en/function.ps-setfont.php
 *
 * @param resource $psdoc
 * @param int      $font
 * @param float    $fontsize
 *
 * @return bool
 */
function ps_setfont($psdoc, $font, $fontsize) {}

/**
 * Output text
 *
 * @link https://php.net/manual/en/function.ps-show.php
 *
 * @param resource $psdoc
 * @param string   $text
 *
 * @return bool
 */
function ps_show($psdoc, $text) {}

/**
 * Output text at given position
 *
 * @link https://php.net/manual/en/function.ps-show-xy.php
 *
 * @param resource $psdoc
 * @param string   $text
 * @param float    $x_coor
 * @param float    $y_coor
 *
 * @return bool
 */
function ps_show_xy($psdoc, $text, $x_coor, $y_coor) {}

/**
 * Output a text at current position
 *
 * @link https://php.net/manual/en/function.ps-show2.php
 *
 * @param resource $psdoc
 * @param string   $text
 * @param int      $length
 *
 * @return bool
 */
function ps_show2($psdoc, $text, $length) {}

/**
 * Output text at position
 *
 * @link https://php.net/manual/en/function.ps-show-xy2.php
 *
 * @param resource $psdoc
 * @param string   $text
 * @param int      $length
 * @param float    $x_coor
 * @param float    $y_coor
 *
 * @return bool
 */
function ps_show_xy2($psdoc, $text, $length, $x_coor, $y_coor) {}

/**
 * Continue text in next line
 *
 * @link https://php.net/manual/en/function.ps-continue-text.php
 *
 * @param resource $psdoc
 * @param string   $text
 *
 * @return bool
 */
function ps_continue_text($psdoc, $text) {}

/**
 * Output text in a box
 *
 * @link https://php.net/manual/en/function.ps-show-boxed.php
 *
 * @param resource $psdoc
 * @param string   $text
 * @param float    $x_coor
 * @param float    $y_coor
 * @param float    $width
 * @param float    $height
 * @param string   $mode
 * @param string   $feature
 *
 * @return int
 */
function ps_show_boxed($psdoc, $text, $x_coor, $y_coor, $width, $height, $mode, $feature = null) {}

/**
 * Gets width of a string
 *
 * @link https://php.net/manual/en/function.ps-stringwidth.php
 *
 * @param resource $psdoc
 * @param string   $text
 * @param int      $font
 * @param float    $size
 *
 * @return float
 */
function ps_stringwidth($psdoc, $text, $font = null, $size = null) {}

/**
 * Gets geometry of a string
 *
 * @link https://php.net/manual/en/function.ps-string-geometry.php
 *
 * @param resource $psdoc
 * @param string   $text
 * @param int      $font
 * @param float    $size
 *
 * @return array
 */
function ps_string_geometry($psdoc, $text, $font = null, $size = null) {}

/**
 * Sets position for text output
 *
 * @link https://php.net/manual/en/function.ps-set-text-pos.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 *
 * @return bool
 */
function ps_set_text_pos($psdoc, $x_coor, $y_coor) {}

/**
 * Sets appearance of a dashed line
 *
 * @link https://php.net/manual/en/function.ps-setdash.php
 *
 * @param resource $psdoc
 * @param float    $black
 * @param float    $white
 *
 * @return bool
 */
function ps_setdash($psdoc, $black, $white) {}

/**
 * Sets appearance of a dashed line
 *
 * @link https://php.net/manual/en/function.ps-setpolydash.php
 *
 * @param resource $psdoc
 * @param array    $darray
 *
 * @return bool
 */
function ps_setpolydash($psdoc, $darray) {}

/**
 * Sets flatness
 *
 * @link https://php.net/manual/en/function.ps-setflat.php
 *
 * @param resource $psdoc
 * @param float    $value
 *
 * @return bool
 */
function ps_setflat($psdoc, $value) {}

/**
 * Sets how connected lines are joined
 *
 * @link https://php.net/manual/en/function.ps-setlinejoin.php
 *
 * @param resource $psdoc
 * @param int      $value
 *
 * @return bool
 */
function ps_setlinejoin($psdoc, $value) {}

/**
 * Sets appearance of line ends
 *
 * @link https://php.net/manual/en/function.ps-setlinecap.php
 *
 * @param resource $psdoc
 * @param int      $value
 *
 * @return bool
 */
function ps_setlinecap($psdoc, $value) {}

/**
 * Sets the miter limit
 *
 * @link https://php.net/manual/en/function.ps-setmiterlimit.php
 *
 * @param resource $psdoc
 * @param float    $value
 *
 * @return bool
 */
function ps_setmiterlimit($psdoc, $value) {}

/**
 * Sets width of a line
 *
 * @link https://php.net/manual/en/function.ps-setlinewidth.php
 *
 * @param resource $psdoc
 * @param float    $width
 *
 * @return bool
 */
function ps_setlinewidth($psdoc, $width) {}

/**
 * Sets overprint mode
 *
 * @link https://php.net/manual/en/function.ps-setoverprintmode.php
 *
 * @param resource $psdoc
 * @param int      $mode
 *
 * @return bool
 */
function ps_setoverprintmode($psdoc, $mode) {}

/**
 * Save current context
 *
 * @link https://php.net/manual/en/function.ps-save.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_save($psdoc) {}

/**
 * Restore previously save context
 *
 * @link https://php.net/manual/en/function.ps-restore.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_restore($psdoc) {}

/**
 * Sets translation
 *
 * @link https://php.net/manual/en/function.ps-translate.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 *
 * @return bool
 */
function ps_translate($psdoc, $x_coor, $y_coor) {}

/**
 * Sets scaling factor
 *
 * @link https://php.net/manual/en/function.ps-scale.php
 *
 * @param resource $psdoc
 * @param float    $x_scale
 * @param float    $y_scale
 *
 * @return bool
 */
function ps_scale($psdoc, $x_scale, $y_scale) {}

/**
 * Sets rotation factor
 *
 * @link https://php.net/manual/en/function.ps-rotate.php
 *
 * @param resource $psdoc
 * @param float    $angle
 *
 * @return bool
 */
function ps_rotate($psdoc, $angle) {}

/**
 * Sets current point
 *
 * @link https://php.net/manual/en/function.ps-moveto.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 *
 * @return bool
 */
function ps_moveto($psdoc, $x_coor, $y_coor) {}

/**
 * Draws a line
 *
 * @link https://php.net/manual/en/function.ps-lineto.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 *
 * @return bool
 */
function ps_lineto($psdoc, $x_coor, $y_coor) {}

/**
 * Draws a curve
 *
 * @link https://php.net/manual/en/function.ps-curveto.php
 *
 * @param resource $psdoc
 * @param float    $x1
 * @param float    $y1
 * @param float    $x2
 * @param float    $y2
 * @param float    $x3
 * @param float    $y3
 *
 * @return bool
 */
function ps_curveto($psdoc, $x1, $y1, $x2, $y2, $x3, $y3) {}

/**
 * Draws a circle
 *
 * @link https://php.net/manual/en/function.ps-circle.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 * @param float    $radius
 *
 * @return bool
 */
function ps_circle($psdoc, $x_coor, $y_coor, $radius) {}

/**
 * Draws an arc counterclockwise
 *
 * @link https://php.net/manual/en/function.ps-arc.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 * @param float    $radius
 * @param float    $start
 * @param float    $end
 *
 * @return bool
 */
function ps_arc($psdoc, $x_coor, $y_coor, $radius, $start, $end) {}

/**
 * Draws an arc clockwise
 *
 * @link https://php.net/manual/en/function.ps-arcn.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 * @param float    $radius
 * @param float    $alpha
 * @param float    $beta
 *
 * @return bool
 */
function ps_arcn($psdoc, $x_coor, $y_coor, $radius, $alpha, $beta) {}

/**
 * Draws a rectangle
 *
 * @link https://php.net/manual/en/function.ps-rect.php
 *
 * @param resource $psdoc
 * @param float    $x_coor
 * @param float    $y_coor
 * @param float    $width
 * @param float    $height
 *
 * @return bool
 */
function ps_rect($psdoc, $x_coor, $y_coor, $width, $height) {}

/**
 * Closes path
 *
 * @link https://php.net/manual/en/function.ps-closepath.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_closepath($psdoc) {}

/**
 * Draws the current path
 *
 * @link https://php.net/manual/en/function.ps-stroke.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_stroke($psdoc) {}

/**
 * Closes and strokes path
 *
 * @link https://php.net/manual/en/function.ps-closepath-stroke.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_closepath_stroke($psdoc) {}

/**
 * Fills the current path
 *
 * @link https://php.net/manual/en/function.ps-fill.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_fill($psdoc) {}

/**
 * Fills and strokes the current path
 *
 * @link https://php.net/manual/en/function.ps-fill-stroke.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_fill_stroke($psdoc) {}

/**
 * Clips drawing to current path
 *
 * @link https://php.net/manual/en/function.ps-clip.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_clip($psdoc) {}

/**
 * Opens image from file
 *
 * @link https://php.net/manual/en/function.ps-open-image-file.php
 *
 * @param resource $psdoc
 * @param string   $type
 * @param string   $filename
 * @param string   $stringparam
 * @param int      $intparam
 *
 * @return int|false
 */
function ps_open_image_file($psdoc, $type, $filename, $stringparam = null, $intparam = null) {}

/**
 * Reads an image for later placement
 *
 * @link https://php.net/manual/en/function.ps-open-image.php
 *
 * @param resource $psdoc
 * @param string   $type
 * @param string   $source
 * @param string   $data
 * @param int      $length
 * @param int      $width
 * @param int      $height
 * @param int      $components
 * @param int      $bpc
 * @param string   $params
 *
 * @return int
 */
function ps_open_image($psdoc, $type, $source, $data, $length, $width, $height, $components, $bpc, $params) {}

/**
 * Closes image and frees memory
 *
 * @link https://php.net/manual/en/function.ps-close-image.php
 *
 * @param resource $psdoc
 * @param int      $image
 *
 * @return void
 */
function ps_close_image($psdoc, $image) {}

/**
 * Places image on the page
 *
 * @link https://php.net/manual/en/function.ps-place-image.php
 *
 * @param resource $psdoc
 * @param int      $image
 * @param float    $x_coor
 * @param float    $y_coor
 * @param float    $scale
 *
 * @return bool
 */
function ps_place_image($psdoc, $image, $x_coor, $y_coor, $scale) {}

/**
 * Add bookmark to current page
 *
 * @link https://php.net/manual/en/function.ps-add-bookmark.php
 *
 * @param resource $psdoc
 * @param string   $string
 * @param int      $parent
 * @param int      $open
 *
 * @return int
 */
function ps_add_bookmark($psdoc, $string, $parent = null, $open = null) {}

/**
 * Sets information fields of document
 *
 * @link https://php.net/manual/en/function.ps-set-info.php
 *
 * @param resource $psdoc
 * @param string   $fieldname
 * @param string   $value
 *
 * @return bool
 */
function ps_set_info($psdoc, $fieldname, $value) {}

/**
 * Reads an external file with raw PostScript code
 *
 * @link https://php.net/manual/en/function.ps-include-file.php
 *
 * @param resource $psdoc
 * @param string   $filename
 *
 * @return bool
 */
function ps_include_file($psdoc, $filename) {}

/**
 * Adds note to current page
 *
 * @link https://php.net/manual/en/function.ps-add-note.php
 *
 * @param resource $psdoc
 * @param float    $llx
 * @param float    $lly
 * @param float    $urx
 * @param float    $ury
 * @param string   $contents
 * @param string   $title
 * @param string   $icon
 * @param int      $open
 *
 * @return bool
 */
function ps_add_note($psdoc, $llx, $lly, $urx, $ury, $contents, $title, $icon, $open) {}

/**
 * Adds link to a page in a second pdf document
 *
 * @link https://php.net/manual/en/function.ps-add-pdflink.php
 *
 * @param resource $psdoc
 * @param float    $llx
 * @param float    $lly
 * @param float    $urx
 * @param float    $ury
 * @param string   $filename
 * @param int      $page
 * @param string   $dest
 *
 * @return bool
 */
function ps_add_pdflink($psdoc, $llx, $lly, $urx, $ury, $filename, $page, $dest) {}

/**
 * Adds link to a page in the same document
 *
 * @link https://php.net/manual/en/function.ps-add-locallink.php
 *
 * @param resource $psdoc
 * @param float    $llx
 * @param float    $lly
 * @param float    $urx
 * @param float    $ury
 * @param int      $page
 * @param string   $dest
 *
 * @return bool
 */
function ps_add_locallink($psdoc, $llx, $lly, $urx, $ury, $page, $dest) {}

/**
 * Adds link which launches file
 *
 * @link https://php.net/manual/en/function.ps-add-launchlink.php
 *
 * @param resource $psdoc
 * @param float    $llx
 * @param float    $lly
 * @param float    $urx
 * @param float    $ury
 * @param string   $filename
 *
 * @return bool
 */
function ps_add_launchlink($psdoc, $llx, $lly, $urx, $ury, $filename) {}

/**
 * Adds link to a web location
 *
 * @link https://php.net/manual/en/function.ps-add-weblink.php
 *
 * @param resource $psdoc
 * @param float    $llx
 * @param float    $lly
 * @param float    $urx
 * @param float    $ury
 * @param string   $url
 *
 * @return bool
 */
function ps_add_weblink($psdoc, $llx, $lly, $urx, $ury, $url) {}

/**
 * Sets border style of annotations
 *
 * @link https://php.net/manual/en/function.ps-set-border-style.php
 *
 * @param resource $psdoc
 * @param string   $style
 * @param float    $width
 *
 * @return bool
 */
function ps_set_border_style($psdoc, $style, $width) {}

/**
 * Sets color of border for annotations
 *
 * @link https://php.net/manual/en/function.ps-set-border-color.php
 *
 * @param resource $psdoc
 * @param float    $red
 * @param float    $green
 * @param float    $blue
 *
 * @return bool
 */
function ps_set_border_color($psdoc, $red, $green, $blue) {}

/**
 * Sets length of dashes for border of annotations
 *
 * @link https://php.net/manual/en/function.ps-set-border-dash.php
 *
 * @param resource $psdoc
 * @param float    $black
 * @param float    $white
 *
 * @return bool
 */
function ps_set_border_dash($psdoc, $black, $white) {}

/**
 * Sets current color
 *
 * @link https://php.net/manual/en/function.ps-setcolor.php
 *
 * @param resource $psdoc
 * @param string   $type
 * @param string   $colorspace
 * @param float    $c1
 * @param float    $c2
 * @param float    $c3
 * @param float    $c4
 *
 * @return bool
 */
function ps_setcolor($psdoc, $type, $colorspace, $c1, $c2, $c3, $c4) {}

/**
 * Create spot color
 *
 * @link https://php.net/manual/en/function.ps-makespotcolor.php
 *
 * @param resource $psdoc
 * @param string   $spotcolor
 *
 * @return int
 */
function ps_makespotcolor($psdoc, $spotcolor) {}

/**
 * Start a new pattern
 *
 * @link https://php.net/manual/en/function.ps-begin-pattern.php
 *
 * @param resource $psdoc
 * @param float    $width
 * @param float    $height
 * @param float    $xstep
 * @param float    $ystep
 * @param int      $painttype
 *
 * @return int
 */
function ps_begin_pattern($psdoc, $width, $height, $xstep, $ystep, $painttype) {}

/**
 * End a pattern
 *
 * @link https://php.net/manual/en/function.ps-end-pattern.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_end_pattern($psdoc) {}

/**
 * Start a new template
 *
 * @link https://php.net/manual/en/function.ps-begin-template.php
 *
 * @param resource $psdoc
 * @param float    $width
 * @param float    $height
 *
 * @return int
 */
function ps_begin_template($psdoc, $width, $height) {}

/**
 * End a template
 *
 * @link https://php.net/manual/en/function.ps-end-template.php
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_end_template($psdoc) {}

/**
 * Fills an area with a shading
 *
 * @link https://php.net/manual/en/function.ps-shfill.php
 *
 * @param resource $psdoc
 * @param int      $psshading
 *
 * @return bool
 */
function ps_shfill($psdoc, $psshading) {}

/**
 * Creates a shading for later use
 *
 * @link https://php.net/manual/en/function.ps-shading.php
 *
 * @param resource $psdoc
 * @param string   $type
 * @param float    $x0
 * @param float    $y0
 * @param float    $x1
 * @param float    $y1
 * @param float    $c1
 * @param float    $c2
 * @param float    $c3
 * @param float    $c4
 * @param string   $optlist
 *
 * @return int
 */
function ps_shading($psdoc, $type, $x0, $y0, $x1, $y1, $c1, $c2, $c3, $c4, $optlist) {}

/**
 * Creates a pattern based on a shading
 *
 * @link https://php.net/manual/en/function.ps-shading-pattern.php
 *
 * @param resource $psdoc
 * @param int      $psshading
 * @param string   $optlist
 *
 * @return int
 */
function ps_shading_pattern($psdoc, $psshading, $optlist) {}

/**
 * Starts a new Type 3 font
 *
 * @param resource $psdoc
 * @param string   $fontname
 * @param float    $a
 * @param float    $b
 * @param float    $c
 * @param float    $d
 * @param float    $e
 * @param float    $f
 * @param string   $optlist
 *
 * @return int
 */
function ps_begin_font($psdoc, $fontname, $a, $b, $c, $d, $e, $f, $optlist = null) {}

/**
 * Ends the current Type 3 font
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_end_font($psdoc) {}

/**
 * Starts a new glyph in the current Type 3 font
 *
 * @param resource $psdoc
 * @param string   $name
 * @param float    $wx
 * @param float    $llx
 * @param float    $lly
 * @param float    $urx
 * @param float    $ury
 *
 * @return bool
 */
function ps_begin_glyph($psdoc, $name, $wx, $llx, $lly, $urx, $ury) {}

/**
 * Ends the current glyph
 *
 * @param resource $psdoc
 *
 * @return bool
 */
function ps_end_glyph($psdoc) {}

/**
 * Takes a GD image and returns an image for placement in a PS document
 *
 * @link https://php.net/manual/en/function.ps-open-memory-image.php
 *
 * @param resource $psdoc
 * @param GdImage  $psimage
 *
 * @return int|false
 */
function ps_open_memory_image($psdoc, $psimage) {}

/**
 * Hyphenates a word
 *
 * @link https://php.net/manual/en/function.ps-hyphenate.php
 *
 * @param resource $psdoc
 * @param string   $word
 *
 * @return array|false
 */
function ps_hyphenate($psdoc, $word) {}

/**
 * Output a glyph
 *
 * @link https://php.net/manual/en/function.ps-symbol.php
 *
 * @param resource $psdoc
 * @param int      $ord
 *
 * @return bool
 */
function ps_symbol($psdoc, $ord) {}

/**
 * Gets name of a glyph
 *
 * @link https://php.net/manual/en/function.ps-symbol-name.php
 *
 * @param resource $psdoc
 * @param int      $ord
 * @param int      $font
 *
 * @return string
 */
function ps_symbol_name($psdoc, $ord, $font = null) {}

/**
 * Gets width of a glyph
 *
 * @link https://php.net/manual/en/function.ps-symbol-width.php
 *
 * @param resource $psdoc
 * @param int      $ord
 * @param int      $font
 * @param float    $width
 *
 * @return float
 */
function ps_symbol_width($psdoc, $ord, $font = null, $width = null) {}

/**
 * Outputs a glyph by its name
 *
 * @param resource $psdoc
 * @param string   $name
 *
 * @return void
 */
function ps_glyph_show($psdoc, $name) {}

/**
 * Gets width of a glyph by its name
 *
 * @param resource $psdoc
 * @param string   $name
 * @param int      $font
 * @param float    $size
 *
 * @return float
 */
function ps_glyph_width($psdoc, $name, $font = null, $size = null) {}

/**
 * Gets the array of glyph names of a font
 *
 * @param resource $psdoc
 * @param int      $font
 *
 * @return array|false
 */
function ps_glyph_list($psdoc, $font = null) {}

/**
 * Adds a new kerning pair to a font
 *
 * @param resource $psdoc
 * @param string   $glyphname1
 * @param string   $glyphname2
 * @param int      $kern
 * @param int      $font
 *
 * @return bool
 */
function ps_add_kerning($psdoc, $glyphname1, $glyphname2, $kern, $font = null) {}

/**
 * Adds a new ligature to a font
 *
 * @param resource $psdoc
 * @param string   $glyphname1
 * @param string   $glyphname2
 * @param string   $glyphname3
 * @param int      $font
 *
 * @return bool
 */
function ps_add_ligature($psdoc, $glyphname1, $glyphname2, $glyphname3, $font = null) {}

// End of ps v.1.4.4
