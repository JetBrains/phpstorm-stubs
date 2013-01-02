<?php

// Start of exif v.1.4 $Id: exif.c 293036 2010-01-03 09:23:27Z sebastian $

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5)<br/>
 * Reads the <acronym>EXIF</acronym> headers from <acronym>JPEG</acronym> or <acronym>TIFF</acronym>
 * @link http://php.net/manual/en/function.exif-read-data.php
 * @param string $filename <p>
 * The name of the image file being read. This cannot be an
 * URL.
 * </p>
 * @param string $sections [optional] <p>
 * Is a comma separated list of sections that need to be present in file 
 * to produce a result array. If none of the requested 
 * sections could be found the return value is false.
 * <tr valign="top">
 * <td>FILE</td>
 * <td>FileName, FileSize, FileDateTime, SectionsFound</td>
 * </tr>
 * <tr valign="top">
 * <td>COMPUTED</td>
 * <td>
 * html, Width, Height, IsColor, and more if available. Height and 
 * Width are computed the same way getimagesize
 * does so their values must not be part of any header returned. 
 * Also, html is a height/width text string to be used inside normal 
 * HTML.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>ANY_TAG</td>
 * <td>Any information that has a Tag e.g. IFD0, EXIF, ...</td>
 * </tr>
 * <tr valign="top">
 * <td>IFD0</td>
 * <td>
 * All tagged data of IFD0. In normal imagefiles this contains
 * image size and so forth.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>THUMBNAIL</td>
 * <td>
 * A file is supposed to contain a thumbnail if it has a second IFD.
 * All tagged information about the embedded thumbnail is stored in 
 * this section.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>COMMENT</td>
 * <td>Comment headers of JPEG images.</td>
 * </tr>
 * <tr valign="top">
 * <td>EXIF</td>
 * <td>
 * The EXIF section is a sub section of IFD0. It contains
 * more detailed information about an image. Most of these entries
 * are digital camera related.
 * </td>
 * </tr>
 * </p>
 * @param bool $arrays [optional] <p>
 * Specifies whether or not each section becomes an array. The 
 * sections COMPUTED,
 * THUMBNAIL, and COMMENT 
 * always become arrays as they may contain values whose names conflict
 * with other sections.
 * </p>
 * @param bool $thumbnail [optional] <p>
 * When set to true the thumbnail itself is read. Otherwise, only the
 * tagged data is read.
 * </p>
 * @return array It returns an associative array where the array indexes are 
 * the header names and the array values are the values associated with 
 * those headers. If no data can be returned, 
 * exif_read_data will return false.
 */
function exif_read_data ($filename, $sections = null, $arrays = null, $thumbnail = null) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * &Alias; <function>exif_read_data</function>
 * @link http://php.net/manual/en/function.read-exif-data.php
 * @param $filename
 * @param $sections_needed [optional]
 * @param $sub_arrays [optional]
 * @param $read_thumbnail [optional]
 */
function read_exif_data ($filename, $sections_needed, $sub_arrays, $read_thumbnail) {}

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5)<br/>
 * Get the header name for an index
 * @link http://php.net/manual/en/function.exif-tagname.php
 * @param int $index <p>
 * The image index
 * </p>
 * @return string the header name, or false if index is
 * undefined.
 */
function exif_tagname ($index) {}

/**
 * (PHP 4 &gt;= 4.2.0, PHP 5)<br/>
 * Retrieve the embedded thumbnail of a TIFF or JPEG image
 * @link http://php.net/manual/en/function.exif-thumbnail.php
 * @param string $filename <p>
 * The name of the image file being read. This image contains an
 * embedded thumbnail.
 * </p>
 * @param int $width [optional] <p>
 * The return width of the returned thumbnail.
 * </p>
 * @param int $height [optional] <p>
 * The returned height of the returned thumbnail.
 * </p>
 * @param int $imagetype [optional] <p>
 * The returned image type of the returned thumbnail. This is either
 * TIFF or JPEG.
 * </p>
 * @return string the embedded thumbnail, or false if the image contains no 
 * thumbnail.
 */
function exif_thumbnail ($filename, &$width = null, &$height = null, &$imagetype = null) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Determine the type of an image
 * @link http://php.net/manual/en/function.exif-imagetype.php
 * @param string $filename The image being checked.
 * @return int When a correct signature is found, the appropriate constant value will be
 * returned otherwise the return value is false. The return value is the
 * same value that getimagesize returns in index 2 but
 * exif_imagetype is much faster.
 */
function exif_imagetype ($filename) {}

define ('EXIF_USE_MBSTRING', 1);

// End of exif v.1.4 $Id: exif.c 293036 2010-01-03 09:23:27Z sebastian $
?>
