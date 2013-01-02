<?php

// Start of imagick v.3.0.1

class ImagickException extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param $message [optional]
	 * @param $code [optional]
	 * @param $previous [optional]
	 */
	public function __construct ($message, $code, $previous) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return mixed the exception code as integer in
	 * <b>Exception</b> but possibly as other type in
	 * <b>Exception</b> descendants (for example as
	 * string in <b>PDOException</b>).
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was created.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was created.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous <b>Exception</b> if available
	 * or null otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

class ImagickDrawException extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param $message [optional]
	 * @param $code [optional]
	 * @param $previous [optional]
	 */
	public function __construct ($message, $code, $previous) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return mixed the exception code as integer in
	 * <b>Exception</b> but possibly as other type in
	 * <b>Exception</b> descendants (for example as
	 * string in <b>PDOException</b>).
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was created.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was created.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous <b>Exception</b> if available
	 * or null otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

class ImagickPixelIteratorException extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param $message [optional]
	 * @param $code [optional]
	 * @param $previous [optional]
	 */
	public function __construct ($message, $code, $previous) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return mixed the exception code as integer in
	 * <b>Exception</b> but possibly as other type in
	 * <b>Exception</b> descendants (for example as
	 * string in <b>PDOException</b>).
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was created.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was created.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous <b>Exception</b> if available
	 * or null otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

class ImagickPixelException extends Exception  {
	protected $message;
	protected $code;
	protected $file;
	protected $line;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param $message [optional]
	 * @param $code [optional]
	 * @param $previous [optional]
	 */
	public function __construct ($message, $code, $previous) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return mixed the exception code as integer in
	 * <b>Exception</b> but possibly as other type in
	 * <b>Exception</b> descendants (for example as
	 * string in <b>PDOException</b>).
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was created.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was created.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous <b>Exception</b> if available
	 * or null otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

/**
 * @link http://php.net/manual/en/class.imagick.php
 */
class Imagick implements Iterator, Traversable {
	const COLOR_BLACK = 11;
	const COLOR_BLUE = 12;
	const COLOR_CYAN = 13;
	const COLOR_GREEN = 14;
	const COLOR_RED = 15;
	const COLOR_YELLOW = 16;
	const COLOR_MAGENTA = 17;
	const COLOR_OPACITY = 18;
	const COLOR_ALPHA = 19;
	const COLOR_FUZZ = 20;
	const IMAGICK_EXTNUM = 30001;
	const IMAGICK_EXTVER = "3.0.1";
	const COMPOSITE_DEFAULT = 40;
	const COMPOSITE_UNDEFINED = 0;
	const COMPOSITE_NO = 1;
	const COMPOSITE_ADD = 2;
	const COMPOSITE_ATOP = 3;
	const COMPOSITE_BLEND = 4;
	const COMPOSITE_BUMPMAP = 5;
	const COMPOSITE_CLEAR = 7;
	const COMPOSITE_COLORBURN = 8;
	const COMPOSITE_COLORDODGE = 9;
	const COMPOSITE_COLORIZE = 10;
	const COMPOSITE_COPYBLACK = 11;
	const COMPOSITE_COPYBLUE = 12;
	const COMPOSITE_COPY = 13;
	const COMPOSITE_COPYCYAN = 14;
	const COMPOSITE_COPYGREEN = 15;
	const COMPOSITE_COPYMAGENTA = 16;
	const COMPOSITE_COPYOPACITY = 17;
	const COMPOSITE_COPYRED = 18;
	const COMPOSITE_COPYYELLOW = 19;
	const COMPOSITE_DARKEN = 20;
	const COMPOSITE_DSTATOP = 21;
	const COMPOSITE_DST = 22;
	const COMPOSITE_DSTIN = 23;
	const COMPOSITE_DSTOUT = 24;
	const COMPOSITE_DSTOVER = 25;
	const COMPOSITE_DIFFERENCE = 26;
	const COMPOSITE_DISPLACE = 27;
	const COMPOSITE_DISSOLVE = 28;
	const COMPOSITE_EXCLUSION = 29;
	const COMPOSITE_HARDLIGHT = 30;
	const COMPOSITE_HUE = 31;
	const COMPOSITE_IN = 32;
	const COMPOSITE_LIGHTEN = 33;
	const COMPOSITE_LUMINIZE = 35;
	const COMPOSITE_MINUS = 36;
	const COMPOSITE_MODULATE = 37;
	const COMPOSITE_MULTIPLY = 38;
	const COMPOSITE_OUT = 39;
	const COMPOSITE_OVER = 40;
	const COMPOSITE_OVERLAY = 41;
	const COMPOSITE_PLUS = 42;
	const COMPOSITE_REPLACE = 43;
	const COMPOSITE_SATURATE = 44;
	const COMPOSITE_SCREEN = 45;
	const COMPOSITE_SOFTLIGHT = 46;
	const COMPOSITE_SRCATOP = 47;
	const COMPOSITE_SRC = 48;
	const COMPOSITE_SRCIN = 49;
	const COMPOSITE_SRCOUT = 50;
	const COMPOSITE_SRCOVER = 51;
	const COMPOSITE_SUBTRACT = 52;
	const COMPOSITE_THRESHOLD = 53;
	const COMPOSITE_XOR = 54;
	const MONTAGEMODE_FRAME = 1;
	const MONTAGEMODE_UNFRAME = 2;
	const MONTAGEMODE_CONCATENATE = 3;
	const STYLE_NORMAL = 1;
	const STYLE_ITALIC = 2;
	const STYLE_OBLIQUE = 3;
	const STYLE_ANY = 4;
	const FILTER_UNDEFINED = 0;
	const FILTER_POINT = 1;
	const FILTER_BOX = 2;
	const FILTER_TRIANGLE = 3;
	const FILTER_HERMITE = 4;
	const FILTER_HANNING = 5;
	const FILTER_HAMMING = 6;
	const FILTER_BLACKMAN = 7;
	const FILTER_GAUSSIAN = 8;
	const FILTER_QUADRATIC = 9;
	const FILTER_CUBIC = 10;
	const FILTER_CATROM = 11;
	const FILTER_MITCHELL = 12;
	const FILTER_LANCZOS = 13;
	const FILTER_BESSEL = 14;
	const FILTER_SINC = 15;
	const IMGTYPE_UNDEFINED = 0;
	const IMGTYPE_BILEVEL = 1;
	const IMGTYPE_GRAYSCALE = 2;
	const IMGTYPE_GRAYSCALEMATTE = 3;
	const IMGTYPE_PALETTE = 4;
	const IMGTYPE_PALETTEMATTE = 5;
	const IMGTYPE_TRUECOLOR = 6;
	const IMGTYPE_TRUECOLORMATTE = 7;
	const IMGTYPE_COLORSEPARATION = 8;
	const IMGTYPE_COLORSEPARATIONMATTE = 9;
	const IMGTYPE_OPTIMIZE = 10;
	const RESOLUTION_UNDEFINED = 0;
	const RESOLUTION_PIXELSPERINCH = 1;
	const RESOLUTION_PIXELSPERCENTIMETER = 2;
	const COMPRESSION_UNDEFINED = 0;
	const COMPRESSION_NO = 1;
	const COMPRESSION_BZIP = 2;
	const COMPRESSION_FAX = 6;
	const COMPRESSION_GROUP4 = 7;
	const COMPRESSION_JPEG = 8;
	const COMPRESSION_JPEG2000 = 9;
	const COMPRESSION_LOSSLESSJPEG = 10;
	const COMPRESSION_LZW = 11;
	const COMPRESSION_RLE = 12;
	const COMPRESSION_ZIP = 13;
	const COMPRESSION_DXT1 = 3;
	const COMPRESSION_DXT3 = 4;
	const COMPRESSION_DXT5 = 5;
	const PAINT_POINT = 1;
	const PAINT_REPLACE = 2;
	const PAINT_FLOODFILL = 3;
	const PAINT_FILLTOBORDER = 4;
	const PAINT_RESET = 5;
	const GRAVITY_NORTHWEST = 1;
	const GRAVITY_NORTH = 2;
	const GRAVITY_NORTHEAST = 3;
	const GRAVITY_WEST = 4;
	const GRAVITY_CENTER = 5;
	const GRAVITY_EAST = 6;
	const GRAVITY_SOUTHWEST = 7;
	const GRAVITY_SOUTH = 8;
	const GRAVITY_SOUTHEAST = 9;
	const STRETCH_NORMAL = 1;
	const STRETCH_ULTRACONDENSED = 2;
	const STRETCH_CONDENSED = 4;
	const STRETCH_SEMICONDENSED = 5;
	const STRETCH_SEMIEXPANDED = 6;
	const STRETCH_EXPANDED = 7;
	const STRETCH_EXTRAEXPANDED = 8;
	const STRETCH_ULTRAEXPANDED = 9;
	const STRETCH_ANY = 10;
	const ALIGN_UNDEFINED = 0;
	const ALIGN_LEFT = 1;
	const ALIGN_CENTER = 2;
	const ALIGN_RIGHT = 3;
	const DECORATION_NO = 1;
	const DECORATION_UNDERLINE = 2;
	const DECORATION_OVERLINE = 3;
	const DECORATION_LINETROUGH = 4;
	const NOISE_UNIFORM = 1;
	const NOISE_GAUSSIAN = 2;
	const NOISE_MULTIPLICATIVEGAUSSIAN = 3;
	const NOISE_IMPULSE = 4;
	const NOISE_LAPLACIAN = 5;
	const NOISE_POISSON = 6;
	const NOISE_RANDOM = 7;
	const CHANNEL_UNDEFINED = 0;
	const CHANNEL_RED = 1;
	const CHANNEL_GRAY = 1;
	const CHANNEL_CYAN = 1;
	const CHANNEL_GREEN = 2;
	const CHANNEL_MAGENTA = 2;
	const CHANNEL_BLUE = 4;
	const CHANNEL_YELLOW = 4;
	const CHANNEL_ALPHA = 8;
	const CHANNEL_OPACITY = 8;
	const CHANNEL_MATTE = 8;
	const CHANNEL_BLACK = 32;
	const CHANNEL_INDEX = 32;
	const CHANNEL_ALL = 47;
	const CHANNEL_DEFAULT = 39;
	const METRIC_UNDEFINED = 0;
	const METRIC_MEANABSOLUTEERROR = 2;
	const METRIC_MEANSQUAREERROR = 4;
	const METRIC_PEAKABSOLUTEERROR = 5;
	const METRIC_PEAKSIGNALTONOISERATIO = 6;
	const METRIC_ROOTMEANSQUAREDERROR = 7;
	const PIXEL_CHAR = 1;
	const PIXEL_DOUBLE = 2;
	const PIXEL_FLOAT = 3;
	const PIXEL_INTEGER = 4;
	const PIXEL_LONG = 5;
	const PIXEL_QUANTUM = 6;
	const PIXEL_SHORT = 7;
	const EVALUATE_UNDEFINED = 0;
	const EVALUATE_ADD = 1;
	const EVALUATE_AND = 2;
	const EVALUATE_DIVIDE = 3;
	const EVALUATE_LEFTSHIFT = 4;
	const EVALUATE_MAX = 5;
	const EVALUATE_MIN = 6;
	const EVALUATE_MULTIPLY = 7;
	const EVALUATE_OR = 8;
	const EVALUATE_RIGHTSHIFT = 9;
	const EVALUATE_SET = 10;
	const EVALUATE_SUBTRACT = 11;
	const EVALUATE_XOR = 12;
	const EVALUATE_POW = 13;
	const EVALUATE_LOG = 14;
	const EVALUATE_THRESHOLD = 15;
	const EVALUATE_THRESHOLDBLACK = 16;
	const EVALUATE_THRESHOLDWHITE = 17;
	const EVALUATE_GAUSSIANNOISE = 18;
	const EVALUATE_IMPULSENOISE = 19;
	const EVALUATE_LAPLACIANNOISE = 20;
	const EVALUATE_MULTIPLICATIVENOISE = 21;
	const EVALUATE_POISSONNOISE = 22;
	const EVALUATE_UNIFORMNOISE = 23;
	const EVALUATE_COSINE = 24;
	const EVALUATE_SINE = 25;
	const EVALUATE_ADDMODULUS = 26;
	const COLORSPACE_UNDEFINED = 0;
	const COLORSPACE_RGB = 1;
	const COLORSPACE_GRAY = 2;
	const COLORSPACE_TRANSPARENT = 3;
	const COLORSPACE_OHTA = 4;
	const COLORSPACE_LAB = 5;
	const COLORSPACE_XYZ = 6;
	const COLORSPACE_YCBCR = 7;
	const COLORSPACE_YCC = 8;
	const COLORSPACE_YIQ = 9;
	const COLORSPACE_YPBPR = 10;
	const COLORSPACE_YUV = 11;
	const COLORSPACE_CMYK = 12;
	const COLORSPACE_SRGB = 13;
	const COLORSPACE_HSB = 14;
	const COLORSPACE_HSL = 15;
	const COLORSPACE_HWB = 16;
	const COLORSPACE_REC601LUMA = 17;
	const COLORSPACE_REC709LUMA = 19;
	const COLORSPACE_LOG = 21;
	const COLORSPACE_CMY = 22;
	const VIRTUALPIXELMETHOD_UNDEFINED = 0;
	const VIRTUALPIXELMETHOD_BACKGROUND = 1;
	const VIRTUALPIXELMETHOD_CONSTANT = 2;
	const VIRTUALPIXELMETHOD_EDGE = 4;
	const VIRTUALPIXELMETHOD_MIRROR = 5;
	const VIRTUALPIXELMETHOD_TILE = 7;
	const VIRTUALPIXELMETHOD_TRANSPARENT = 8;
	const VIRTUALPIXELMETHOD_MASK = 9;
	const VIRTUALPIXELMETHOD_BLACK = 10;
	const VIRTUALPIXELMETHOD_GRAY = 11;
	const VIRTUALPIXELMETHOD_WHITE = 12;
	const VIRTUALPIXELMETHOD_HORIZONTALTILE = 13;
	const VIRTUALPIXELMETHOD_VERTICALTILE = 14;
	const PREVIEW_UNDEFINED = 0;
	const PREVIEW_ROTATE = 1;
	const PREVIEW_SHEAR = 2;
	const PREVIEW_ROLL = 3;
	const PREVIEW_HUE = 4;
	const PREVIEW_SATURATION = 5;
	const PREVIEW_BRIGHTNESS = 6;
	const PREVIEW_GAMMA = 7;
	const PREVIEW_SPIFF = 8;
	const PREVIEW_DULL = 9;
	const PREVIEW_GRAYSCALE = 10;
	const PREVIEW_QUANTIZE = 11;
	const PREVIEW_DESPECKLE = 12;
	const PREVIEW_REDUCENOISE = 13;
	const PREVIEW_ADDNOISE = 14;
	const PREVIEW_SHARPEN = 15;
	const PREVIEW_BLUR = 16;
	const PREVIEW_THRESHOLD = 17;
	const PREVIEW_EDGEDETECT = 18;
	const PREVIEW_SPREAD = 19;
	const PREVIEW_SOLARIZE = 20;
	const PREVIEW_SHADE = 21;
	const PREVIEW_RAISE = 22;
	const PREVIEW_SEGMENT = 23;
	const PREVIEW_SWIRL = 24;
	const PREVIEW_IMPLODE = 25;
	const PREVIEW_WAVE = 26;
	const PREVIEW_OILPAINT = 27;
	const PREVIEW_CHARCOALDRAWING = 28;
	const PREVIEW_JPEG = 29;
	const RENDERINGINTENT_UNDEFINED = 0;
	const RENDERINGINTENT_SATURATION = 1;
	const RENDERINGINTENT_PERCEPTUAL = 2;
	const RENDERINGINTENT_ABSOLUTE = 3;
	const RENDERINGINTENT_RELATIVE = 4;
	const INTERLACE_UNDEFINED = 0;
	const INTERLACE_NO = 1;
	const INTERLACE_LINE = 2;
	const INTERLACE_PLANE = 3;
	const INTERLACE_PARTITION = 4;
	const INTERLACE_GIF = 5;
	const INTERLACE_JPEG = 6;
	const INTERLACE_PNG = 7;
	const FILLRULE_UNDEFINED = 0;
	const FILLRULE_EVENODD = 1;
	const FILLRULE_NONZERO = 2;
	const PATHUNITS_UNDEFINED = 0;
	const PATHUNITS_USERSPACE = 1;
	const PATHUNITS_USERSPACEONUSE = 2;
	const PATHUNITS_OBJECTBOUNDINGBOX = 3;
	const LINECAP_UNDEFINED = 0;
	const LINECAP_BUTT = 1;
	const LINECAP_ROUND = 2;
	const LINECAP_SQUARE = 3;
	const LINEJOIN_UNDEFINED = 0;
	const LINEJOIN_MITER = 1;
	const LINEJOIN_ROUND = 2;
	const LINEJOIN_BEVEL = 3;
	const RESOURCETYPE_UNDEFINED = 0;
	const RESOURCETYPE_AREA = 1;
	const RESOURCETYPE_DISK = 2;
	const RESOURCETYPE_FILE = 3;
	const RESOURCETYPE_MAP = 4;
	const RESOURCETYPE_MEMORY = 5;
	const DISPOSE_UNRECOGNIZED = 0;
	const DISPOSE_UNDEFINED = 0;
	const DISPOSE_NONE = 1;
	const DISPOSE_BACKGROUND = 2;
	const DISPOSE_PREVIOUS = 3;
	const INTERPOLATE_UNDEFINED = 0;
	const INTERPOLATE_AVERAGE = 1;
	const INTERPOLATE_BICUBIC = 2;
	const INTERPOLATE_BILINEAR = 3;
	const INTERPOLATE_FILTER = 4;
	const INTERPOLATE_INTEGER = 5;
	const INTERPOLATE_MESH = 6;
	const INTERPOLATE_NEARESTNEIGHBOR = 7;
	const INTERPOLATE_SPLINE = 8;
	const LAYERMETHOD_UNDEFINED = 0;
	const LAYERMETHOD_COALESCE = 1;
	const LAYERMETHOD_COMPAREANY = 2;
	const LAYERMETHOD_COMPARECLEAR = 3;
	const LAYERMETHOD_COMPAREOVERLAY = 4;
	const LAYERMETHOD_DISPOSE = 5;
	const LAYERMETHOD_OPTIMIZE = 6;
	const LAYERMETHOD_OPTIMIZEPLUS = 8;
	const LAYERMETHOD_OPTIMIZETRANS = 9;
	const LAYERMETHOD_COMPOSITE = 12;
	const LAYERMETHOD_OPTIMIZEIMAGE = 7;
	const LAYERMETHOD_REMOVEDUPS = 10;
	const LAYERMETHOD_REMOVEZERO = 11;
	const ORIENTATION_UNDEFINED = 0;
	const ORIENTATION_TOPLEFT = 1;
	const ORIENTATION_TOPRIGHT = 2;
	const ORIENTATION_BOTTOMRIGHT = 3;
	const ORIENTATION_BOTTOMLEFT = 4;
	const ORIENTATION_LEFTTOP = 5;
	const ORIENTATION_RIGHTTOP = 6;
	const ORIENTATION_RIGHTBOTTOM = 7;
	const ORIENTATION_LEFTBOTTOM = 8;
	const DISTORTION_UNDEFINED = 0;
	const DISTORTION_AFFINE = 1;
	const DISTORTION_AFFINEPROJECTION = 2;
	const DISTORTION_ARC = 9;
	const DISTORTION_BILINEAR = 6;
	const DISTORTION_PERSPECTIVE = 4;
	const DISTORTION_PERSPECTIVEPROJECTION = 5;
	const DISTORTION_SCALEROTATETRANSLATE = 3;
	const DISTORTION_POLYNOMIAL = 8;
	const DISTORTION_POLAR = 10;
	const DISTORTION_DEPOLAR = 11;
	const DISTORTION_BARREL = 12;
	const DISTORTION_BARRELINVERSE = 13;
	const DISTORTION_SHEPARDS = 14;
	const DISTORTION_SENTINEL = 15;
	const LAYERMETHOD_MERGE = 13;
	const LAYERMETHOD_FLATTEN = 14;
	const LAYERMETHOD_MOSAIC = 15;
	const ALPHACHANNEL_ACTIVATE = 1;
	const ALPHACHANNEL_DEACTIVATE = 4;
	const ALPHACHANNEL_RESET = 7;
	const ALPHACHANNEL_SET = 8;
	const ALPHACHANNEL_UNDEFINED = 0;
	const ALPHACHANNEL_COPY = 3;
	const ALPHACHANNEL_EXTRACT = 5;
	const ALPHACHANNEL_OPAQUE = 6;
	const ALPHACHANNEL_SHAPE = 9;
	const ALPHACHANNEL_TRANSPARENT = 10;
	const SPARSECOLORMETHOD_UNDEFINED = 0;
	const SPARSECOLORMETHOD_BARYCENTRIC = 1;
	const SPARSECOLORMETHOD_BILINEAR = 7;
	const SPARSECOLORMETHOD_POLYNOMIAL = 8;
	const SPARSECOLORMETHOD_SPEPARDS = 14;
	const SPARSECOLORMETHOD_VORONOI = 15;
	const DITHERMETHOD_UNDEFINED = 0;
	const DITHERMETHOD_NO = 1;
	const DITHERMETHOD_RIEMERSMA = 2;
	const DITHERMETHOD_FLOYDSTEINBERG = 3;
	const FUNCTION_UNDEFINED = 0;
	const FUNCTION_POLYNOMIAL = 1;
	const FUNCTION_SINUSOID = 2;


	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Removes repeated portions of images to optimize
	 * @link http://php.net/manual/en/function.imagick-optimizeimagelayers.php
	 * @return bool &imagick.return.success;
	 */
	public function optimizeimagelayers () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the maximum bounding region between images
	 * @link http://php.net/manual/en/function.imagick-compareimagelayers.php
	 * @param int $method <p>
	 * One of the layer method constants.
	 * </p>
	 * @return Imagick &imagick.return.success;
	 */
	public function compareimagelayers ($method) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Quickly fetch attributes
	 * @link http://php.net/manual/en/function.imagick-pingimageblob.php
	 * @param string $image <p>
	 * A string containing the image.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function pingimageblob ($image) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Get basic image attributes in a lightweight manner
	 * @link http://php.net/manual/en/function.imagick-pingimagefile.php
	 * @param resource $filehandle <p>
	 * An open filehandle to the image.
	 * </p>
	 * @param string $fileName [optional] <p>
	 * Optional filename for this image.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function pingimagefile ($filehandle, $fileName = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a vertical mirror image
	 * @link http://php.net/manual/en/function.imagick-transposeimage.php
	 * @return bool &imagick.return.success;
	 */
	public function transposeimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a horizontal mirror image
	 * @link http://php.net/manual/en/function.imagick-transverseimage.php
	 * @return bool &imagick.return.success;
	 */
	public function transverseimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Remove edges from the image
	 * @link http://php.net/manual/en/function.imagick-trimimage.php
	 * @param float $fuzz <p>
	 * By default target must match a particular pixel color exactly.
	 * However, in many cases two colors may differ by a small amount.
	 * The fuzz member of image defines how much tolerance is acceptable
	 * to consider two colors as the same. This parameter represents the variation
	 * on the quantum range.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function trimimage ($fuzz) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies wave filter to the image
	 * @link http://php.net/manual/en/function.imagick-waveimage.php
	 * @param float $amplitude <p>
	 * The amplitude of the wave.
	 * </p>
	 * @param float $length <p>
	 * The length of the wave.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function waveimage ($amplitude, $length) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds vignette filter to the image
	 * @link http://php.net/manual/en/function.imagick-vignetteimage.php
	 * @param float $blackPoint <p>
	 * The black point.
	 * </p>
	 * @param float $whitePoint <p>
	 * The white point
	 * </p>
	 * @param int $x <p>
	 * X offset of the ellipse
	 * </p>
	 * @param int $y <p>
	 * Y offset of the ellipse
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function vignetteimage ($blackPoint, $whitePoint, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Discards all but one of any pixel color
	 * @link http://php.net/manual/en/function.imagick-uniqueimagecolors.php
	 * @return bool &imagick.return.success;
	 */
	public function uniqueimagecolors () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Return if the image has a matte channel
	 * @link http://php.net/manual/en/function.imagick-getimagematte.php
	 * @return bool true on success or false on failure.
	 */
	public function getimagematte () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image matte channel
	 * @link http://php.net/manual/en/function.imagick-setimagematte.php
	 * @param bool $matte <p>
	 * True activates the matte channel and false disables it.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimagematte ($matte) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adaptively resize image with data dependent triangulation
	 * @link http://php.net/manual/en/function.imagick-adaptiveresizeimage.php
	 * @param int $columns <p>
	 * The number of columns in the scaled image.
	 * </p>
	 * @param int $rows <p>
	 * The number of rows in the scaled image.
	 * </p>
	 * @param bool $bestfit [optional] <p>
	 * Whether to fit the image inside a bounding box.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function adaptiveresizeimage ($columns, $rows, $bestfit = false) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Simulates a pencil sketch
	 * @link http://php.net/manual/en/function.imagick-sketchimage.php
	 * @param float $radius <p>
	 * The radius of the Gaussian, in pixels, not counting the center pixel
	 * </p>
	 * @param float $sigma <p>
	 * The standard deviation of the Gaussian, in pixels.
	 * </p>
	 * @param float $angle <p>
	 * Apply the effect along this angle.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function sketchimage ($radius, $sigma, $angle) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a 3D effect
	 * @link http://php.net/manual/en/function.imagick-shadeimage.php
	 * @param bool $gray <p>
	 * A value other than zero shades the intensity of each pixel.
	 * </p>
	 * @param float $azimuth <p>
	 * Defines the light source direction.
	 * </p>
	 * @param float $elevation <p>
	 * Defines the light source direction.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function shadeimage ($gray, $azimuth, $elevation) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the size offset
	 * @link http://php.net/manual/en/function.imagick-getsizeoffset.php
	 * @return int the size offset associated with the Imagick object.
	 * &imagick.imagickexception.throw;
	 */
	public function getsizeoffset () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the size and offset of the Imagick object
	 * @link http://php.net/manual/en/function.imagick-setsizeoffset.php
	 * @param int $columns <p>
	 * The width in pixels.
	 * </p>
	 * @param int $rows <p>
	 * The height in pixels.
	 * </p>
	 * @param int $offset <p>
	 * The image offset.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setsizeoffset ($columns, $rows, $offset) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds adaptive blur filter to image
	 * @link http://php.net/manual/en/function.imagick-adaptiveblurimage.php
	 * @param float $radius <p>
	 * The radius of the Gaussian, in pixels, not counting the center pixel.
	 * Provide a value of 0 and the radius will be chosen automagically.
	 * </p>
	 * @param float $sigma <p>
	 * The standard deviation of the Gaussian, in pixels.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function adaptiveblurimage ($radius, $sigma, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Enhances the contrast of a color image
	 * @link http://php.net/manual/en/function.imagick-contraststretchimage.php
	 * @param float $black_point <p>
	 * The black point.
	 * </p>
	 * @param float $white_point <p>
	 * The white point.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. <b>Imagick::CHANNEL_ALL</b>. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function contraststretchimage ($black_point, $white_point, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adaptively sharpen the image
	 * @link http://php.net/manual/en/function.imagick-adaptivesharpenimage.php
	 * @param float $radius <p>
	 * The radius of the Gaussian, in pixels, not counting the center pixel. Use 0 for auto-select.
	 * </p>
	 * @param float $sigma <p>
	 * The standard deviation of the Gaussian, in pixels.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function adaptivesharpenimage ($radius, $sigma, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a high-contrast, two-color image
	 * @link http://php.net/manual/en/function.imagick-randomthresholdimage.php
	 * @param float $low <p>
	 * The low point
	 * </p>
	 * @param float $high <p>
	 * The high point
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function randomthresholdimage ($low, $high, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * @param $xRounding
	 * @param $yRounding
	 * @param $strokeWidth [optional]
	 * @param $displace [optional]
	 * @param $sizeCorrection [optional]
	 */
	public function roundcornersimage ($xRounding, $yRounding, $strokeWidth, $displace, $sizeCorrection) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Rounds image corners
	 * @link http://php.net/manual/en/function.imagick-roundcorners.php
	 * @param float $x_rounding <p>
	 * x rounding
	 * </p>
	 * @param float $y_rounding <p>
	 * y rounding
	 * </p>
	 * @param float $stroke_width [optional] <p>
	 * stroke width
	 * </p>
	 * @param float $displace [optional] <p>
	 * image displace
	 * </p>
	 * @param float $size_correction [optional] <p>
	 * size correction
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function roundcorners ($x_rounding, $y_rounding, $stroke_width = 10, $displace = 5, $size_correction = -6) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Set the iterator position
	 * @link http://php.net/manual/en/function.imagick-setiteratorindex.php
	 * @param int $index <p>
	 * The position to set the iterator to
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setiteratorindex ($index) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the index of the current active image
	 * @link http://php.net/manual/en/function.imagick-getiteratorindex.php
	 * @return int an integer containing the index of the image in the stack.
	 * &imagick.imagickexception.throw;
	 */
	public function getiteratorindex () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Convenience method for setting crop size and the image geometry
	 * @link http://php.net/manual/en/function.imagick-transformimage.php
	 * @param string $crop <p>
	 * A crop geometry string. This geometry defines a subregion of the image to crop.
	 * </p>
	 * @param string $geometry <p>
	 * An image geometry string. This geometry defines the final size of the image.
	 * </p>
	 * @return Imagick &imagick.return.success;
	 */
	public function transformimage ($crop, $geometry) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image opacity level
	 * @link http://php.net/manual/en/function.imagick-setimageopacity.php
	 * @param float $opacity <p>
	 * The level of transparency: 1.0 is fully opaque and 0.0 is fully
	 * transparent.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageopacity ($opacity) {}

	/**
	 * (PECL imagick 2.2.2)<br/>
	 * Performs an ordered dither
	 * @link http://php.net/manual/en/function.imagick-orderedposterizeimage.php
	 * @param string $threshold_map <p>
	 * A string containing the name of the threshold dither map to use
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function orderedposterizeimage ($threshold_map, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Simulates a Polaroid picture
	 * @link http://php.net/manual/en/function.imagick-polaroidimage.php
	 * @param ImagickDraw $properties <p>
	 * The polaroid properties
	 * </p>
	 * @param float $angle <p>
	 * The polaroid angle
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function polaroidimage (ImagickDraw $properties, $angle) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the named image property
	 * @link http://php.net/manual/en/function.imagick-getimageproperty.php
	 * @param string $name <p>
	 * name of the property (for example Exif:DateTime)
	 * </p>
	 * @return string a string containing the image property, false if a
	 * property with the given name does not exist.
	 */
	public function getimageproperty ($name) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets an image property
	 * @link http://php.net/manual/en/function.imagick-setimageproperty.php
	 * @param string $name
	 * @param string $value
	 * @return bool &imagick.return.success;
	 */
	public function setimageproperty ($name, $value) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image interpolate pixel method
	 * @link http://php.net/manual/en/function.imagick-setimageinterpolatemethod.php
	 * @param int $method <p>
	 * The method is one of the <b>Imagick::INTERPOLATE_*</b> constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageinterpolatemethod ($method) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the interpolation method
	 * @link http://php.net/manual/en/function.imagick-getimageinterpolatemethod.php
	 * @return int the interpolate method on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageinterpolatemethod () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Stretches with saturation the image intensity
	 * @link http://php.net/manual/en/function.imagick-linearstretchimage.php
	 * @param float $blackPoint <p>
	 * The image black point
	 * </p>
	 * @param float $whitePoint <p>
	 * The image white point
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function linearstretchimage ($blackPoint, $whitePoint) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image length in bytes
	 * @link http://php.net/manual/en/function.imagick-getimagelength.php
	 * @return int an int containing the current image size.
	 */
	public function getimagelength () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Set image size
	 * @link http://php.net/manual/en/function.imagick-extentimage.php
	 * @param int $width <p>
	 * The new width
	 * </p>
	 * @param int $height <p>
	 * The new height
	 * </p>
	 * @param int $x <p>
	 * X position for the new size
	 * </p>
	 * @param int $y <p>
	 * Y position for the new size
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function extentimage ($width, $height, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image orientation
	 * @link http://php.net/manual/en/function.imagick-getimageorientation.php
	 * @return int an int on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageorientation () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image orientation
	 * @link http://php.net/manual/en/function.imagick-setimageorientation.php
	 * @param int $orientation <p>
	 * One of the orientation constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageorientation ($orientation) {}

	/**
	 * (PECL imagick 2.1.0)<br/>
	 * Changes the color value of any pixel that matches target
	 * @link http://php.net/manual/en/function.imagick-paintfloodfillimage.php
	 * @param mixed $fill <p>
	 * ImagickPixel object or a string containing the fill color
	 * </p>
	 * @param float $fuzz <p>
	 * The amount of fuzz. For example, set fuzz to 10 and the color red at
	 * intensities of 100 and 102 respectively are now interpreted as the
	 * same color for the purposes of the floodfill.
	 * </p>
	 * @param mixed $bordercolor <p>
	 * ImagickPixel object or a string containing the border color
	 * </p>
	 * @param int $x <p>
	 * X start position of the floodfill
	 * </p>
	 * @param int $y <p>
	 * Y start position of the floodfill
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function paintfloodfillimage ($fill, $fuzz, $bordercolor, $x, $y, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Replaces colors in the image
	 * @link http://php.net/manual/en/function.imagick-clutimage.php
	 * @param Imagick $lookup_table <p>
	 * Imagick object containing the color lookup table
	 * </p>
	 * @param float $channel [optional] <p>
	 * The Channeltype
	 * constant. When not supplied, default channels are replaced.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function clutimage (Imagick $lookup_table, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image properties
	 * @link http://php.net/manual/en/function.imagick-getimageproperties.php
	 * @param string $pattern [optional] <p>
	 * The pattern for property names.
	 * </p>
	 * @param bool $only_names [optional] <p>
	 * Whether to return only property names. If false then also the values are returned
	 * </p>
	 * @return array an array containing the image properties or property names.
	 */
	public function getimageproperties ($pattern = "*", $only_names = true) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image profiles
	 * @link http://php.net/manual/en/function.imagick-getimageprofiles.php
	 * @param string $pattern [optional] <p>
	 * The pattern for profile names.
	 * </p>
	 * @param bool $only_names [optional] <p>
	 * Whether to return only profile names. If false then values are returned as well
	 * </p>
	 * @return array an array containing the image profiles or profile names.
	 */
	public function getimageprofiles ($pattern = "*", $only_names = true) {}

	/**
	 * (PECL imagick 2.0.1)<br/>
	 * Distorts an image using various distortion methods
	 * @link http://php.net/manual/en/function.imagick-distortimage.php
	 * @param int $method <p>
	 * The method of image distortion. See distortion constants
	 * </p>
	 * @param array $arguments <p>
	 * The arguments for this distortion method
	 * </p>
	 * @param bool $bestfit <p>
	 * Attempt to resize destination to fit distorted source
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function distortimage ($method, array $arguments, $bestfit) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Writes an image to a filehandle
	 * @link http://php.net/manual/en/function.imagick-writeimagefile.php
	 * @param resource $filehandle <p>
	 * Filehandle where to write the image
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function writeimagefile ($filehandle) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Writes frames to a filehandle
	 * @link http://php.net/manual/en/function.imagick-writeimagesfile.php
	 * @param resource $filehandle <p>
	 * Filehandle where to write the images
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function writeimagesfile ($filehandle) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Reset image page
	 * @link http://php.net/manual/en/function.imagick-resetimagepage.php
	 * @param string $page <p>
	 * The page definition. For example 7168x5147+0+0
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function resetimagepage ($page) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Sets image clip mask
	 * @link http://php.net/manual/en/function.imagick-setimageclipmask.php
	 * @param Imagick $clip_mask <p>
	 * The Imagick object containing the clip mask
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageclipmask (Imagick $clip_mask) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Gets image clip mask
	 * @link http://php.net/manual/en/function.imagick-getimageclipmask.php
	 * @return Imagick an Imagick object containing the clip mask.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageclipmask () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Animates an image or images
	 * @link http://php.net/manual/en/function.imagick-animateimages.php
	 * @param string $x_server <p>
	 * X server address
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function animateimages ($x_server) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Recolors image
	 * @link http://php.net/manual/en/function.imagick-recolorimage.php
	 * @param array $matrix <p>
	 * The matrix containing the color values
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function recolorimage (array $matrix) {}

	/**
	 * (PECL imagick 2.1.0)<br/>
	 * Sets font
	 * @link http://php.net/manual/en/function.imagick-setfont.php
	 * @param string $font <p>
	 * Font name or a filename
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setfont ($font) {}

	/**
	 * (PECL imagick 2.1.0)<br/>
	 * Gets font
	 * @link http://php.net/manual/en/function.imagick-getfont.php
	 * @return string the string containing the font name or false if not font is set.
	 */
	public function getfont () {}

	/**
	 * (PECL imagick 2.1.0)<br/>
	 * Sets point size
	 * @link http://php.net/manual/en/function.imagick-setpointsize.php
	 * @param float $point_size <p>
	 * Point size
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setpointsize ($point_size) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Gets point size
	 * @link http://php.net/manual/en/function.imagick-getpointsize.php
	 * @return float a &float; containing the point size.
	 */
	public function getpointsize () {}

	/**
	 * (PECL imagick 2.1.0)<br/>
	 * Merges image layers
	 * @link http://php.net/manual/en/function.imagick-mergeimagelayers.php
	 * @param int $layer_method <p>
	 * One of the <b>Imagick::LAYERMETHOD_*</b> constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function mergeimagelayers ($layer_method) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Sets image alpha channel
	 * @link http://php.net/manual/en/function.imagick-setimagealphachannel.php
	 * @param int $mode <p>
	 * One of the <b>Imagick::ALPHACHANNEL_*</b> constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimagealphachannel ($mode) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Changes the color value of any pixel that matches target
	 * @link http://php.net/manual/en/function.imagick-floodfillpaintimage.php
	 * @param mixed $fill <p>
	 * ImagickPixel object or a string containing the fill color
	 * </p>
	 * @param float $fuzz <p>
	 * &imagick.parameter.fuzz;
	 * </p>
	 * @param mixed $target <p>
	 * ImagickPixel object or a string containing the target color to paint
	 * </p>
	 * @param int $x <p>
	 * X start position of the floodfill
	 * </p>
	 * @param int $y <p>
	 * Y start position of the floodfill
	 * </p>
	 * @param bool $invert <p>
	 * If true paints any pixel that does not match the target color.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function floodfillpaintimage ($fill, $fuzz, $target, $x, $y, $invert, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Changes the color value of any pixel that matches target
	 * @link http://php.net/manual/en/function.imagick-opaquepaintimage.php
	 * @param mixed $target <p>
	 * ImagickPixel object or a string containing the color to change
	 * </p>
	 * @param mixed $fill <p>
	 * The replacement color
	 * </p>
	 * @param float $fuzz <p>
	 * &imagick.parameter.fuzz;
	 * </p>
	 * @param bool $invert <p>
	 * If true paints any pixel that does not match the target color.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function opaquepaintimage ($target, $fill, $fuzz, $invert, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Paints pixels transparent
	 * @link http://php.net/manual/en/function.imagick-transparentpaintimage.php
	 * @param mixed $target <p>
	 * The target color to paint
	 * </p>
	 * @param float $alpha <p>
	 * &imagick.parameter.alpha;
	 * </p>
	 * @param float $fuzz <p>
	 * &imagick.parameter.fuzz;
	 * </p>
	 * @param bool $invert <p>
	 * If true paints any pixel that does not match the target color.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function transparentpaintimage ($target, $alpha, $fuzz, $invert) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Animates an image or images
	 * @link http://php.net/manual/en/function.imagick-liquidrescaleimage.php
	 * @param int $width <p>
	 * The width of the target size
	 * </p>
	 * @param int $height <p>
	 * The height of the target size
	 * </p>
	 * @param float $delta_x <p>
	 * How much the seam can traverse on x-axis.
	 * Passing 0 causes the seams to be straight.
	 * </p>
	 * @param float $rigidity <p>
	 * Introduces a bias for non-straight seams. This parameter is
	 * typically 0.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function liquidrescaleimage ($width, $height, $delta_x, $rigidity) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Enciphers an image
	 * @link http://php.net/manual/en/function.imagick-encipherimage.php
	 * @param string $passphrase <p>
	 * The passphrase
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function encipherimage ($passphrase) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Deciphers an image
	 * @link http://php.net/manual/en/function.imagick-decipherimage.php
	 * @param string $passphrase <p>
	 * The passphrase
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function decipherimage ($passphrase) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Sets the gravity
	 * @link http://php.net/manual/en/function.imagick-setgravity.php
	 * @param int $gravity <p>
	 * The gravity property. Refer to the list of
	 * gravity constants.
	 * </p>
	 * @return bool
	 */
	public function setgravity ($gravity) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Gets the gravity
	 * @link http://php.net/manual/en/function.imagick-getgravity.php
	 * @return int the gravity property. Refer to the list of
	 * gravity constants.
	 */
	public function getgravity () {}

	/**
	 * (PECL imagick 2.2.1)<br/>
	 * Gets channel range
	 * @link http://php.net/manual/en/function.imagick-getimagechannelrange.php
	 * @param int $channel <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return array an array containing minima and maxima values of the channel(s).
	 */
	public function getimagechannelrange ($channel) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Gets the image alpha channel
	 * @link http://php.net/manual/en/function.imagick-getimagealphachannel.php
	 * @return int a constant defining the current alpha channel value. Refer to this
	 * list of alpha channel constants.
	 */
	public function getimagealphachannel () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Gets channel distortions
	 * @link http://php.net/manual/en/function.imagick-getimagechanneldistortions.php
	 * @param Imagick $reference <p>
	 * Imagick object containing the reference image
	 * </p>
	 * @param int $metric <p>
	 * Refer to this list of metric type constants.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return float a double describing the channel distortion.
	 */
	public function getimagechanneldistortions (Imagick $reference, $metric, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Sets the image gravity
	 * @link http://php.net/manual/en/function.imagick-setimagegravity.php
	 * @param int $gravity <p>
	 * The gravity property. Refer to the list of
	 * gravity constants.
	 * </p>
	 * @return bool
	 */
	public function setimagegravity ($gravity) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Gets the image gravity
	 * @link http://php.net/manual/en/function.imagick-getimagegravity.php
	 * @return int the images gravity property. Refer to the list of
	 * gravity constants.
	 */
	public function getimagegravity () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Imports image pixels
	 * @link http://php.net/manual/en/imagick.importimagepixels.php
	 * @param int $x <p>
	 * The image x position
	 * </p>
	 * @param int $y <p>
	 * The image y position
	 * </p>
	 * @param int $width <p>
	 * The image width
	 * </p>
	 * @param int $height <p>
	 * The image height
	 * </p>
	 * @param string $map <p>
	 * Map of pixel ordering as a string. This can be for example RGB.
	 * The value can be any combination or order of R = red, G = green, B = blue, A = alpha (0 is transparent),
	 * O = opacity (0 is opaque), C = cyan, Y = yellow, M = magenta, K = black, I = intensity (for grayscale), P = pad.
	 * </p>
	 * @param int $storage <p>
	 * The pixel storage method.
	 * Refer to this list of pixel constants.
	 * </p>
	 * @param array $pixels <p>
	 * The array of pixels
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function importimagepixels ($x, $y, $width, $height, $map, $storage, array $pixels) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Removes skew from the image
	 * @link http://php.net/manual/en/imagick.deskewimage.php
	 * @param float $threshold <p>
	 * Deskew threshold
	 * </p>
	 * @return bool
	 */
	public function deskewimage ($threshold) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Segments an image
	 * @link http://php.net/manual/en/imagick.segmentimage.php
	 * @param int $COLORSPACE <p>
	 * One of the COLORSPACE constants.
	 * </p>
	 * @param float $cluster_threshold <p>
	 * A percentage describing minimum number of pixels
	 * contained in hexedra before it is considered valid.
	 * </p>
	 * @param float $smooth_threshold <p>
	 * Eliminates noise from the histogram.
	 * </p>
	 * @param bool $verbose [optional] <p>
	 * Whether to output detailed information about recognised classes.
	 * </p>
	 * @return bool
	 */
	public function segmentimage ($COLORSPACE, $cluster_threshold, $smooth_threshold, $verbose = false) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Interpolates colors
	 * @link http://php.net/manual/en/imagick.sparsecolorimage.php
	 * @param int $SPARSE_METHOD <p>
	 * Refer to this list of sparse method constants
	 * </p>
	 * @param array $arguments <p>
	 * An array containing the coordinates.
	 * The array is in format array(1,1, 2,45)
	 * </p>
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function sparsecolorimage ($SPARSE_METHOD, array $arguments, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Remaps image colors
	 * @link http://php.net/manual/en/imagick.remapimage.php
	 * @param Imagick $replacement <p>
	 * An Imagick object containing the replacement colors
	 * </p>
	 * @param int $DITHER <p>
	 * Refer to this list of dither method constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function remapimage (Imagick $replacement, $DITHER) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Exports raw image pixels
	 * @link http://php.net/manual/en/imagick.exportimagepixels.php
	 * @param int $x <p>
	 * X-coordinate of the exported area
	 * </p>
	 * @param int $y <p>
	 * Y-coordinate of the exported area
	 * </p>
	 * @param int $width <p>
	 * Width of the exported aread
	 * </p>
	 * @param int $height <p>
	 * Height of the exported area
	 * </p>
	 * @param string $map <p>
	 * Ordering of the exported pixels. For example "RGB".
	 * Valid characters for the map are R, G, B, A, O, C, Y, M, K, I and P.
	 * </p>
	 * @param int $STORAGE <p>
	 * Refer to this list of pixel type constants
	 * </p>
	 * @return array an array containing the pixels values.
	 */
	public function exportimagepixels ($x, $y, $width, $height, $map, $STORAGE) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * The getImageChannelKurtosis purpose
	 * @link http://php.net/manual/en/imagick.getimagechannelkurtosis.php
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return array an array with kurtosis and skewness
	 * members.
	 */
	public function getimagechannelkurtosis ($channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Applies a function on the image
	 * @link http://php.net/manual/en/imagick.functionimage.php
	 * @param int $function <p>
	 * Refer to this list of function constants
	 * </p>
	 * @param array $arguments <p>
	 * Array of arguments to pass to this function.
	 * </p>
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function functionimage ($function, array $arguments, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * @param $COLORSPACE
	 */
	public function transformimagecolorspace ($COLORSPACE) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Replaces colors in the image
	 * @link http://php.net/manual/en/imagick.haldclutimage.php
	 * @param Imagick $clut <p>
	 * Imagick object containing the Hald lookup image.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function haldclutimage (Imagick $clut, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Get image artifact
	 * @link http://php.net/manual/en/function.imagick-getimageartifact.php
	 * @param string $artifact <p>
	 * The name of the artifact
	 * </p>
	 * @return string the artifact value on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageartifact ($artifact) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Set image artifact
	 * @link http://php.net/manual/en/function.imagick-setimageartifact.php
	 * @param string $artifact <p>
	 * The name of the artifact
	 * </p>
	 * @param string $value <p>
	 * The value of the artifact
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageartifact ($artifact, $value) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Delete image artifact
	 * @link http://php.net/manual/en/function.imagick-deleteimageartifact.php
	 * @param string $artifact <p>
	 * The name of the artifact
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function deleteimageartifact ($artifact) {}

	/**
	 * (PECL imagick 0.9.10-0.9.9)<br/>
	 * Gets the colorspace
	 * @link http://php.net/manual/en/function.imagick-getcolorspace.php
	 * @return int an integer which can be compared against COLORSPACE constants.
	 */
	public function getcolorspace () {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Set colorspace
	 * @link http://php.net/manual/en/function.imagick-setcolorspace.php
	 * @param int $COLORSPACE <p>
	 * One of the COLORSPACE constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setcolorspace ($COLORSPACE) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * The Imagick constructor
	 * @link http://php.net/manual/en/function.imagick-construct.php
	 * @param mixed $files [optional] <p>
	 * The path to an image to load or array of paths
	 * </p>
	 */
	public function __construct ($files = null) {}

	public function __tostring () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a MagickPixelIterator
	 * @link http://php.net/manual/en/function.imagick-getpixeliterator.php
	 * @return ImagickPixelIterator an ImagickPixelIterator on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getpixeliterator () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Get an ImagickPixelIterator for an image section
	 * @link http://php.net/manual/en/function.imagick-getpixelregioniterator.php
	 * @param int $x <p>
	 * The x-coordinate of the region.
	 * </p>
	 * @param int $y <p>
	 * The y-coordinate of the region.
	 * </p>
	 * @param int $columns <p>
	 * The width of the region.
	 * </p>
	 * @param int $rows <p>
	 * The height of the region.
	 * </p>
	 * @return ImagickPixelIterator an ImagickPixelIterator for an image section.
	 * &imagick.imagickexception.throw;
	 */
	public function getpixelregioniterator ($x, $y, $columns, $rows) {}

	/**
	 * (PECL imagick 0.9.0-0.9.9)<br/>
	 * Reads image from filename
	 * @link http://php.net/manual/en/function.imagick-readimage.php
	 * @param string $filename
	 * @return bool &imagick.return.success;
	 */
	public function readimage ($filename) {}

	/**
	 * @param $filenames
	 */
	public function readimages ($filenames) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Reads image from a binary string
	 * @link http://php.net/manual/en/function.imagick-readimageblob.php
	 * @param string $image
	 * @param string $filename [optional]
	 * @return bool &imagick.return.success;
	 */
	public function readimageblob ($image, $filename = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the format of a particular image
	 * @link http://php.net/manual/en/function.imagick-setimageformat.php
	 * @param string $format <p>
	 * String presentation of the image format. Format support
	 * depends on the ImageMagick installation.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageformat ($format) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Scales the size of an image
	 * @link http://php.net/manual/en/function.imagick-scaleimage.php
	 * @param int $cols
	 * @param int $rows
	 * @param bool $bestfit [optional]
	 * @return bool &imagick.return.success;
	 */
	public function scaleimage ($cols, $rows, $bestfit = false) {}

	/**
	 * (PECL imagick 0.9.0-0.9.9)<br/>
	 * Writes an image to the specified filename
	 * @link http://php.net/manual/en/function.imagick-writeimage.php
	 * @param string $filename [optional]
	 * @return bool &imagick.return.success;
	 */
	public function writeimage ($filename = null) {}

	/**
	 * (PECL imagick 0.9.0-0.9.9)<br/>
	 * Writes an image or image sequence
	 * @link http://php.net/manual/en/function.imagick-writeimages.php
	 * @param string $filename
	 * @param bool $adjoin
	 * @return bool &imagick.return.success;
	 */
	public function writeimages ($filename, $adjoin) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds blur filter to image
	 * @link http://php.net/manual/en/function.imagick-blurimage.php
	 * @param float $radius <p>
	 * Blur radius
	 * </p>
	 * @param float $sigma <p>
	 * Standard deviation
	 * </p>
	 * @param int $channel [optional] <p>
	 * The Channeltype
	 * constant. When not supplied, all channels are blurred.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function blurimage ($radius, $sigma, $channel = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Changes the size of an image
	 * @link http://php.net/manual/en/function.imagick-thumbnailimage.php
	 * @param int $columns <p>
	 * Image width
	 * </p>
	 * @param int $rows <p>
	 * Image height
	 * </p>
	 * @param bool $bestfit [optional] <p>
	 * Whether to force maximum values
	 * </p>
	 * @param bool $fill [optional]
	 * @return bool &imagick.return.success;
	 */
	public function thumbnailimage ($columns, $rows, $bestfit = false, $fill = false) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a crop thumbnail
	 * @link http://php.net/manual/en/function.imagick-cropthumbnailimage.php
	 * @param int $width <p>
	 * The width of the thumbnail
	 * </p>
	 * @param int $height <p>
	 * The Height of the thumbnail
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function cropthumbnailimage ($width, $height) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the filename of a particular image in a sequence
	 * @link http://php.net/manual/en/function.imagick-getimagefilename.php
	 * @return string a string with the filename of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagefilename () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the filename of a particular image
	 * @link http://php.net/manual/en/function.imagick-setimagefilename.php
	 * @param string $filename
	 * @return bool &imagick.return.success;
	 */
	public function setimagefilename ($filename) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the format of a particular image in a sequence
	 * @link http://php.net/manual/en/function.imagick-getimageformat.php
	 * @return string a string containing the image format on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageformat () {}

	public function getimagemimetype () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Removes an image from the image list
	 * @link http://php.net/manual/en/function.imagick-removeimage.php
	 * @return bool &imagick.return.success;
	 */
	public function removeimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Destroys the Imagick object
	 * @link http://php.net/manual/en/function.imagick-destroy.php
	 * @return bool &imagick.return.success;
	 */
	public function destroy () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clears all resources associated to Imagick object
	 * @link http://php.net/manual/en/function.imagick-clear.php
	 * @return bool &imagick.return.success;
	 */
	public function clear () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image length in bytes
	 * @link http://php.net/manual/en/function.imagick-getimagesize.php
	 * @return int an int containing the current image size.
	 */
	public function getimagesize () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image sequence as a blob
	 * @link http://php.net/manual/en/function.imagick-getimageblob.php
	 * @return string a string containing the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageblob () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns all image sequences as a blob
	 * @link http://php.net/manual/en/function.imagick-getimagesblob.php
	 * @return string a string containing the images. On failure, throws
	 * ImagickException.
	 */
	public function getimagesblob () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the Imagick iterator to the first image
	 * @link http://php.net/manual/en/function.imagick-setfirstiterator.php
	 * @return bool &imagick.return.success;
	 */
	public function setfirstiterator () {}

	/**
	 * (PECL imagick 2.0.1)<br/>
	 * Sets the Imagick iterator to the last image
	 * @link http://php.net/manual/en/function.imagick-setlastiterator.php
	 * @return bool &imagick.return.success;
	 */
	public function setlastiterator () {}

	public function resetiterator () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Move to the previous image in the object
	 * @link http://php.net/manual/en/function.imagick-previousimage.php
	 * @return bool &imagick.return.success;
	 */
	public function previousimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Moves to the next image
	 * @link http://php.net/manual/en/function.imagick-nextimage.php
	 * @return bool &imagick.return.success;
	 */
	public function nextimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Checks if the object has a previous image
	 * @link http://php.net/manual/en/function.imagick-haspreviousimage.php
	 * @return bool true if the object has more images when traversing the list in the
	 * reverse direction, returns false if there are none.
	 */
	public function haspreviousimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Checks if the object has more images
	 * @link http://php.net/manual/en/function.imagick-hasnextimage.php
	 * @return bool true if the object has more images when traversing the list in the
	 * forward direction, returns false if there are none.
	 */
	public function hasnextimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Set the iterator position
	 * @link http://php.net/manual/en/function.imagick-setimageindex.php
	 * @param int $index <p>
	 * The position to set the iterator to
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimageindex ($index) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the index of the current active image
	 * @link http://php.net/manual/en/function.imagick-getimageindex.php
	 * @return int an integer containing the index of the image in the stack.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageindex () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds a comment to your image
	 * @link http://php.net/manual/en/function.imagick-commentimage.php
	 * @param string $comment <p>
	 * The comment to add
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function commentimage ($comment) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Extracts a region of the image
	 * @link http://php.net/manual/en/function.imagick-cropimage.php
	 * @param int $width <p>
	 * The width of the crop
	 * </p>
	 * @param int $height <p>
	 * The height of the crop
	 * </p>
	 * @param int $x <p>
	 * The X coordinate of the cropped region's top left corner
	 * </p>
	 * @param int $y <p>
	 * The Y coordinate of the cropped region's top left corner
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function cropimage ($width, $height, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds a label to an image
	 * @link http://php.net/manual/en/function.imagick-labelimage.php
	 * @param string $label <p>
	 * The label to add
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function labelimage ($label) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the width and height as an associative array
	 * @link http://php.net/manual/en/function.imagick-getimagegeometry.php
	 * @return array an array with the width/height of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagegeometry () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Renders the ImagickDraw object on the current image
	 * @link http://php.net/manual/en/function.imagick-drawimage.php
	 * @param ImagickDraw $draw <p>
	 * The drawing operations to render on the image.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function drawimage (ImagickDraw $draw) {}

	/**
	 * (No version information available, might only be in SVN)<br/>
	 * Sets the image compression quality
	 * @link http://php.net/manual/en/function.imagick-setimagecompressionquality.php
	 * @param int $quality <p>
	 * The image compression quality as an integer
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimagecompressionquality ($quality) {}

	/**
	 * (PECL imagick 2.2.2)<br/>
	 * Gets the current image's compression quality
	 * @link http://php.net/manual/en/function.imagick-getimagecompressionquality.php
	 * @return int integer describing the images compression quality
	 */
	public function getimagecompressionquality () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Annotates an image with text
	 * @link http://php.net/manual/en/function.imagick-annotateimage.php
	 * @param ImagickDraw $draw_settings <p>
	 * The ImagickDraw object that contains settings for drawing the text
	 * </p>
	 * @param float $x <p>
	 * Horizontal offset in pixels to the left of text
	 * </p>
	 * @param float $y <p>
	 * Vertical offset in pixels to the baseline of text
	 * </p>
	 * @param float $angle <p>
	 * The angle at which to write the text
	 * </p>
	 * @param string $text <p>
	 * The string to draw
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function annotateimage (ImagickDraw $draw_settings, $x, $y, $angle, $text) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Composite one image onto another
	 * @link http://php.net/manual/en/function.imagick-compositeimage.php
	 * @param Imagick $composite_object <p>
	 * Imagick object which holds the composite image
	 * </p>
	 * @param int $composite
	 * @param int $x <p>
	 * The column offset of the composited image
	 * </p>
	 * @param int $y <p>
	 * The row offset of the composited image
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function compositeimage (Imagick $composite_object, $composite, $x, $y, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Control the brightness, saturation, and hue
	 * @link http://php.net/manual/en/function.imagick-modulateimage.php
	 * @param float $brightness
	 * @param float $saturation
	 * @param float $hue
	 * @return bool &imagick.return.success;
	 */
	public function modulateimage ($brightness, $saturation, $hue) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the number of unique colors in the image
	 * @link http://php.net/manual/en/function.imagick-getimagecolors.php
	 * @return int &imagick.return.success;
	 */
	public function getimagecolors () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a composite image
	 * @link http://php.net/manual/en/function.imagick-montageimage.php
	 * @param ImagickDraw $draw <p>
	 * The font name, size, and color are obtained from this object.
	 * </p>
	 * @param string $tile_geometry <p>
	 * The number of tiles per row and page (e.g. 6x4+0+0).
	 * </p>
	 * @param string $thumbnail_geometry <p>
	 * Preferred image size and border size of each thumbnail
	 * (e.g. 120x120+4+3>).
	 * </p>
	 * @param int $mode <p>
	 * Thumbnail framing mode, see Montage Mode constants.
	 * </p>
	 * @param string $frame <p>
	 * Surround the image with an ornamental border (e.g. 15x15+3+3). The
	 * frame color is that of the thumbnail's matte color.
	 * </p>
	 * @return Imagick &imagick.return.success;
	 */
	public function montageimage (ImagickDraw $draw, $tile_geometry, $thumbnail_geometry, $mode, $frame) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Identifies an image and fetches attributes
	 * @link http://php.net/manual/en/function.imagick-identifyimage.php
	 * @param bool $appendRawOutput [optional]
	 * @return array Identifies an image and returns the attributes. Attributes include
	 * the image width, height, size, and others.
	 * &imagick.imagickexception.throw;
	 */
	public function identifyimage ($appendRawOutput = false) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Changes the value of individual pixels based on a threshold
	 * @link http://php.net/manual/en/function.imagick-thresholdimage.php
	 * @param float $threshold
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function thresholdimage ($threshold, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Selects a threshold for each pixel based on a range of intensity
	 * @link http://php.net/manual/en/function.imagick-adaptivethresholdimage.php
	 * @param int $width <p>
	 * Width of the local neighborhood.
	 * </p>
	 * @param int $height <p>
	 * Height of the local neighborhood.
	 * </p>
	 * @param int $offset <p>
	 * The mean offset
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function adaptivethresholdimage ($width, $height, $offset) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Forces all pixels below the threshold into black
	 * @link http://php.net/manual/en/function.imagick-blackthresholdimage.php
	 * @param mixed $threshold <p>
	 * The threshold below which everything turns black
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function blackthresholdimage ($threshold) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Force all pixels above the threshold into white
	 * @link http://php.net/manual/en/function.imagick-whitethresholdimage.php
	 * @param mixed $threshold
	 * @return bool &imagick.return.success;
	 */
	public function whitethresholdimage ($threshold) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Append a set of images
	 * @link http://php.net/manual/en/function.imagick-appendimages.php
	 * @param bool $stack [optional] <p>
	 * Whether to stack the images vertically.
	 * By default (or if false is specified) images are stacked left-to-right.
	 * If <i>stack</i> is true, images are stacked top-to-bottom.
	 * </p>
	 * @return Imagick Imagick instance on success.
	 * &imagick.imagickexception.throw;
	 */
	public function appendimages ($stack = false) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Simulates a charcoal drawing
	 * @link http://php.net/manual/en/function.imagick-charcoalimage.php
	 * @param float $radius <p>
	 * The radius of the Gaussian, in pixels, not counting the center pixel
	 * </p>
	 * @param float $sigma <p>
	 * The standard deviation of the Gaussian, in pixels
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function charcoalimage ($radius, $sigma) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Enhances the contrast of a color image
	 * @link http://php.net/manual/en/function.imagick-normalizeimage.php
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function normalizeimage ($channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Simulates an oil painting
	 * @link http://php.net/manual/en/function.imagick-oilpaintimage.php
	 * @param float $radius <p>
	 * The radius of the circular neighborhood.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function oilpaintimage ($radius) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Reduces the image to a limited number of color level
	 * @link http://php.net/manual/en/function.imagick-posterizeimage.php
	 * @param int $levels
	 * @param bool $dither
	 * @return bool &imagick.return.success;
	 */
	public function posterizeimage ($levels, $dither) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Radial blurs an image
	 * @link http://php.net/manual/en/function.imagick-radialblurimage.php
	 * @param float $angle
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function radialblurimage ($angle, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a simulated 3d button-like effect
	 * @link http://php.net/manual/en/function.imagick-raiseimage.php
	 * @param int $width
	 * @param int $height
	 * @param int $x
	 * @param int $y
	 * @param bool $raise
	 * @return bool &imagick.return.success;
	 */
	public function raiseimage ($width, $height, $x, $y, $raise) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Resample image to desired resolution
	 * @link http://php.net/manual/en/function.imagick-resampleimage.php
	 * @param float $x_resolution
	 * @param float $y_resolution
	 * @param int $filter
	 * @param float $blur
	 * @return bool &imagick.return.success;
	 */
	public function resampleimage ($x_resolution, $y_resolution, $filter, $blur) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Scales an image
	 * @link http://php.net/manual/en/function.imagick-resizeimage.php
	 * @param int $columns <p>
	 * Width of the image
	 * </p>
	 * @param int $rows <p>
	 * Height of the image
	 * </p>
	 * @param int $filter <p>
	 * Refer to the list of filter constants.
	 * </p>
	 * @param float $blur <p>
	 * The blur factor where &gt; 1 is blurry, &lt; 1 is sharp.
	 * </p>
	 * @param bool $bestfit [optional] <p>
	 * Optional fit parameter.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function resizeimage ($columns, $rows, $filter, $blur, $bestfit = false) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Offsets an image
	 * @link http://php.net/manual/en/function.imagick-rollimage.php
	 * @param int $x <p>
	 * The X offset.
	 * </p>
	 * @param int $y <p>
	 * The Y offset.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function rollimage ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Rotates an image
	 * @link http://php.net/manual/en/function.imagick-rotateimage.php
	 * @param mixed $background <p>
	 * The background color
	 * </p>
	 * @param float $degrees <p>
	 * The number of degrees to rotate the image
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function rotateimage ($background, $degrees) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Scales an image with pixel sampling
	 * @link http://php.net/manual/en/function.imagick-sampleimage.php
	 * @param int $columns
	 * @param int $rows
	 * @return bool &imagick.return.success;
	 */
	public function sampleimage ($columns, $rows) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies a solarizing effect to the image
	 * @link http://php.net/manual/en/function.imagick-solarizeimage.php
	 * @param int $threshold
	 * @return bool &imagick.return.success;
	 */
	public function solarizeimage ($threshold) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Simulates an image shadow
	 * @link http://php.net/manual/en/function.imagick-shadowimage.php
	 * @param float $opacity
	 * @param float $sigma
	 * @param int $x
	 * @param int $y
	 * @return bool &imagick.return.success;
	 */
	public function shadowimage ($opacity, $sigma, $x, $y) {}

	/**
	 * @param $key
	 * @param $value
	 */
	public function setimageattribute ($key, $value) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image background color
	 * @link http://php.net/manual/en/function.imagick-setimagebackgroundcolor.php
	 * @param mixed $background
	 * @return bool &imagick.return.success;
	 */
	public function setimagebackgroundcolor ($background) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image composite operator
	 * @link http://php.net/manual/en/function.imagick-setimagecompose.php
	 * @param int $compose
	 * @return bool &imagick.return.success;
	 */
	public function setimagecompose ($compose) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image compression
	 * @link http://php.net/manual/en/function.imagick-setimagecompression.php
	 * @param int $compression <p>
	 * One of the <b>COMPRESSION</b> constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimagecompression ($compression) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image delay
	 * @link http://php.net/manual/en/function.imagick-setimagedelay.php
	 * @param int $delay
	 * @return bool &imagick.return.success;
	 */
	public function setimagedelay ($delay) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image depth
	 * @link http://php.net/manual/en/function.imagick-setimagedepth.php
	 * @param int $depth
	 * @return bool &imagick.return.success;
	 */
	public function setimagedepth ($depth) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image gamma
	 * @link http://php.net/manual/en/function.imagick-setimagegamma.php
	 * @param float $gamma
	 * @return bool &imagick.return.success;
	 */
	public function setimagegamma ($gamma) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image iterations
	 * @link http://php.net/manual/en/function.imagick-setimageiterations.php
	 * @param int $iterations
	 * @return bool &imagick.return.success;
	 */
	public function setimageiterations ($iterations) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image matte color
	 * @link http://php.net/manual/en/function.imagick-setimagemattecolor.php
	 * @param mixed $matte
	 * @return bool &imagick.return.success;
	 */
	public function setimagemattecolor ($matte) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the page geometry of the image
	 * @link http://php.net/manual/en/function.imagick-setimagepage.php
	 * @param int $width
	 * @param int $height
	 * @param int $x
	 * @param int $y
	 * @return bool &imagick.return.success;
	 */
	public function setimagepage ($width, $height, $x, $y) {}

	/**
	 * @param $filename
	 */
	public function setimageprogressmonitor ($filename) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image resolution
	 * @link http://php.net/manual/en/function.imagick-setimageresolution.php
	 * @param float $x_resolution
	 * @param float $y_resolution
	 * @return bool &imagick.return.success;
	 */
	public function setimageresolution ($x_resolution, $y_resolution) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image scene
	 * @link http://php.net/manual/en/function.imagick-setimagescene.php
	 * @param int $scene
	 * @return bool &imagick.return.success;
	 */
	public function setimagescene ($scene) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image ticks-per-second
	 * @link http://php.net/manual/en/function.imagick-setimagetickspersecond.php
	 * @param int $ticks_per_second
	 * @return bool &imagick.return.success;
	 */
	public function setimagetickspersecond ($ticks_per_second) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image type
	 * @link http://php.net/manual/en/function.imagick-setimagetype.php
	 * @param int $image_type
	 * @return bool &imagick.return.success;
	 */
	public function setimagetype ($image_type) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image units of resolution
	 * @link http://php.net/manual/en/function.imagick-setimageunits.php
	 * @param int $units
	 * @return bool &imagick.return.success;
	 */
	public function setimageunits ($units) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sharpens an image
	 * @link http://php.net/manual/en/function.imagick-sharpenimage.php
	 * @param float $radius
	 * @param float $sigma
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function sharpenimage ($radius, $sigma, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Shaves pixels from the image edges
	 * @link http://php.net/manual/en/function.imagick-shaveimage.php
	 * @param int $columns
	 * @param int $rows
	 * @return bool &imagick.return.success;
	 */
	public function shaveimage ($columns, $rows) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creating a parallelogram
	 * @link http://php.net/manual/en/function.imagick-shearimage.php
	 * @param mixed $background <p>
	 * The background color
	 * </p>
	 * @param float $x_shear <p>
	 * The number of degrees to shear on the x axis
	 * </p>
	 * @param float $y_shear <p>
	 * The number of degrees to shear on the y axis
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function shearimage ($background, $x_shear, $y_shear) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Splices a solid color into the image
	 * @link http://php.net/manual/en/function.imagick-spliceimage.php
	 * @param int $width
	 * @param int $height
	 * @param int $x
	 * @param int $y
	 * @return bool &imagick.return.success;
	 */
	public function spliceimage ($width, $height, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Fetch basic attributes about the image
	 * @link http://php.net/manual/en/function.imagick-pingimage.php
	 * @param string $filename <p>
	 * The filename to read the information from.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function pingimage ($filename) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Reads image from open filehandle
	 * @link http://php.net/manual/en/function.imagick-readimagefile.php
	 * @param resource $filehandle
	 * @param string $fileName [optional]
	 * @return bool &imagick.return.success;
	 */
	public function readimagefile ($filehandle, $fileName = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Displays an image
	 * @link http://php.net/manual/en/function.imagick-displayimage.php
	 * @param string $servername <p>
	 * The X server name
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function displayimage ($servername) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Displays an image or image sequence
	 * @link http://php.net/manual/en/function.imagick-displayimages.php
	 * @param string $servername <p>
	 * The X server name
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function displayimages ($servername) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Randomly displaces each pixel in a block
	 * @link http://php.net/manual/en/function.imagick-spreadimage.php
	 * @param float $radius
	 * @return bool &imagick.return.success;
	 */
	public function spreadimage ($radius) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Swirls the pixels about the center of the image
	 * @link http://php.net/manual/en/function.imagick-swirlimage.php
	 * @param float $degrees
	 * @return bool &imagick.return.success;
	 */
	public function swirlimage ($degrees) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Strips an image of all profiles and comments
	 * @link http://php.net/manual/en/function.imagick-stripimage.php
	 * @return bool &imagick.return.success;
	 */
	public function stripimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns formats supported by Imagick
	 * @link http://php.net/manual/en/function.imagick-queryformats.php
	 * @param string $pattern [optional]
	 * @return array an array containing the formats supported by Imagick.
	 * &imagick.imagickexception.throw;
	 */
	public function queryformats ($pattern = "*") {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the configured fonts
	 * @link http://php.net/manual/en/function.imagick-queryfonts.php
	 * @param string $pattern [optional] <p>
	 * The query pattern
	 * </p>
	 * @return array an array containing the configured fonts.
	 * &imagick.imagickexception.throw;
	 */
	public function queryfonts ($pattern = "*") {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns an array representing the font metrics
	 * @link http://php.net/manual/en/function.imagick-queryfontmetrics.php
	 * @param ImagickDraw $properties <p>
	 * ImagickDraw object containing font properties
	 * </p>
	 * @param string $text <p>
	 * The text
	 * </p>
	 * @param bool $multiline [optional] <p>
	 * Multiline parameter. If left empty it is autodetected
	 * </p>
	 * @return array a multi-dimensional array representing the font metrics.
	 * &imagick.imagickexception.throw;
	 */
	public function queryfontmetrics (ImagickDraw $properties, $text, $multiline = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Hides a digital watermark within the image
	 * @link http://php.net/manual/en/function.imagick-steganoimage.php
	 * @param Imagick $watermark_wand
	 * @param int $offset
	 * @return Imagick &imagick.return.success;
	 */
	public function steganoimage (Imagick $watermark_wand, $offset) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds random noise to the image
	 * @link http://php.net/manual/en/function.imagick-addnoiseimage.php
	 * @param int $noise_type <p>
	 * The type of the noise. Refer to this list of
	 * noise constants.
	 * </p>
	 * @param int $channel [optional] <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function addnoiseimage ($noise_type, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Simulates motion blur
	 * @link http://php.net/manual/en/function.imagick-motionblurimage.php
	 * @param float $radius <p>
	 * The radius of the Gaussian, in pixels, not counting the center pixel.
	 * </p>
	 * @param float $sigma <p>
	 * The standard deviation of the Gaussian, in pixels.
	 * </p>
	 * @param float $angle <p>
	 * Apply the effect along this angle.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * The channel argument affects only if Imagick is compiled against ImageMagick version
	 * 6.4.4 or greater.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function motionblurimage ($radius, $sigma, $angle, $channel = 'Imagick::CHANNEL_DEFAULT') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Forms a mosaic from images
	 * @link http://php.net/manual/en/function.imagick-mosaicimages.php
	 * @return Imagick &imagick.return.success;
	 */
	public function mosaicimages () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Method morphs a set of images
	 * @link http://php.net/manual/en/function.imagick-morphimages.php
	 * @param int $number_frames <p>
	 * The number of in-between images to generate.
	 * </p>
	 * @return Imagick This method returns a new Imagick object on success.
	 * &imagick.imagickexception.throw;
	 */
	public function morphimages ($number_frames) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Scales an image proportionally to half its size
	 * @link http://php.net/manual/en/function.imagick-minifyimage.php
	 * @return bool &imagick.return.success;
	 */
	public function minifyimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Transforms an image
	 * @link http://php.net/manual/en/function.imagick-affinetransformimage.php
	 * @param ImagickDraw $matrix <p>
	 * The affine matrix
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function affinetransformimage (ImagickDraw $matrix) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Average a set of images
	 * @link http://php.net/manual/en/function.imagick-averageimages.php
	 * @return Imagick a new Imagick object on success.
	 * &imagick.imagickexception.throw;
	 */
	public function averageimages () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Surrounds the image with a border
	 * @link http://php.net/manual/en/function.imagick-borderimage.php
	 * @param mixed $bordercolor <p>
	 * ImagickPixel object or a string containing the border color
	 * </p>
	 * @param int $width <p>
	 * Border width
	 * </p>
	 * @param int $height <p>
	 * Border height
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function borderimage ($bordercolor, $width, $height) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Removes a region of an image and trims
	 * @link http://php.net/manual/en/function.imagick-chopimage.php
	 * @param int $width <p>
	 * Width of the chopped area
	 * </p>
	 * @param int $height <p>
	 * Height of the chopped area
	 * </p>
	 * @param int $x <p>
	 * X origo of the chopped area
	 * </p>
	 * @param int $y <p>
	 * Y origo of the chopped area
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function chopimage ($width, $height, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clips along the first path from the 8BIM profile
	 * @link http://php.net/manual/en/function.imagick-clipimage.php
	 * @return bool &imagick.return.success;
	 */
	public function clipimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clips along the named paths from the 8BIM profile
	 * @link http://php.net/manual/en/function.imagick-clippathimage.php
	 * @param string $pathname <p>
	 * The name of the path
	 * </p>
	 * @param bool $inside <p>
	 * If true later operations take effect inside clipping path.
	 * Otherwise later operations take effect outside clipping path.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function clippathimage ($pathname, $inside) {}

	/**
	 * @param $pathname
	 * @param $inside
	 */
	public function clipimagepath ($pathname, $inside) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Composites a set of images
	 * @link http://php.net/manual/en/function.imagick-coalesceimages.php
	 * @return Imagick a new Imagick object on success.
	 * &imagick.imagickexception.throw;
	 */
	public function coalesceimages () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Changes the color value of any pixel that matches target
	 * @link http://php.net/manual/en/function.imagick-colorfloodfillimage.php
	 * @param mixed $fill <p>
	 * ImagickPixel object containing the fill color
	 * </p>
	 * @param float $fuzz <p>
	 * The amount of fuzz. For example, set fuzz to 10 and the color red at
	 * intensities of 100 and 102 respectively are now interpreted as the
	 * same color for the purposes of the floodfill.
	 * </p>
	 * @param mixed $bordercolor <p>
	 * ImagickPixel object containing the border color
	 * </p>
	 * @param int $x <p>
	 * X start position of the floodfill
	 * </p>
	 * @param int $y <p>
	 * Y start position of the floodfill
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function colorfloodfillimage ($fill, $fuzz, $bordercolor, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Blends the fill color with the image
	 * @link http://php.net/manual/en/function.imagick-colorizeimage.php
	 * @param mixed $colorize <p>
	 * ImagickPixel object or a string containing the colorize color
	 * </p>
	 * @param mixed $opacity <p>
	 * ImagickPixel object or an float containing the opacity value.
	 * 1.0 is fully opaque and 0.0 is fully transparent.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function colorizeimage ($colorize, $opacity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the difference in one or more images
	 * @link http://php.net/manual/en/function.imagick-compareimagechannels.php
	 * @param Imagick $image <p>
	 * Imagick object containing the image to compare.
	 * </p>
	 * @param int $channelType <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @param int $metricType <p>
	 * One of the metric type constants.
	 * </p>
	 * @return array Array consisting of new_wand and
	 * distortion.
	 */
	public function compareimagechannels (Imagick $image, $channelType, $metricType) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Compares an image to a reconstructed image
	 * @link http://php.net/manual/en/function.imagick-compareimages.php
	 * @param Imagick $compare <p>
	 * An image to compare to.
	 * </p>
	 * @param int $metric <p>
	 * Provide a valid metric type constant. Refer to this
	 * list of metric constants.
	 * </p>
	 * @return array &imagick.return.success;
	 */
	public function compareimages (Imagick $compare, $metric) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Change the contrast of the image
	 * @link http://php.net/manual/en/function.imagick-contrastimage.php
	 * @param bool $sharpen <p>
	 * The sharpen value
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function contrastimage ($sharpen) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Combines one or more images into a single image
	 * @link http://php.net/manual/en/function.imagick-combineimages.php
	 * @param int $channelType <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return Imagick &imagick.return.success;
	 */
	public function combineimages ($channelType) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies a custom convolution kernel to the image
	 * @link http://php.net/manual/en/function.imagick-convolveimage.php
	 * @param array $kernel <p>
	 * The convolution kernel
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function convolveimage (array $kernel, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Displaces an image's colormap
	 * @link http://php.net/manual/en/function.imagick-cyclecolormapimage.php
	 * @param int $displace <p>
	 * The amount to displace the colormap.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function cyclecolormapimage ($displace) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns certain pixel differences between images
	 * @link http://php.net/manual/en/function.imagick-deconstructimages.php
	 * @return Imagick a new Imagick object on success.
	 * &imagick.imagickexception.throw;
	 */
	public function deconstructimages () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Reduces the speckle noise in an image
	 * @link http://php.net/manual/en/function.imagick-despeckleimage.php
	 * @return bool &imagick.return.success;
	 */
	public function despeckleimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Enhance edges within the image
	 * @link http://php.net/manual/en/function.imagick-edgeimage.php
	 * @param float $radius <p>
	 * The radius of the operation.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function edgeimage ($radius) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a grayscale image with a three-dimensional effect
	 * @link http://php.net/manual/en/function.imagick-embossimage.php
	 * @param float $radius <p>
	 * The radius of the effect
	 * </p>
	 * @param float $sigma <p>
	 * The sigma of the effect
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function embossimage ($radius, $sigma) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Improves the quality of a noisy image
	 * @link http://php.net/manual/en/function.imagick-enhanceimage.php
	 * @return bool &imagick.return.success;
	 */
	public function enhanceimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Equalizes the image histogram
	 * @link http://php.net/manual/en/function.imagick-equalizeimage.php
	 * @return bool &imagick.return.success;
	 */
	public function equalizeimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies an expression to an image
	 * @link http://php.net/manual/en/function.imagick-evaluateimage.php
	 * @param int $op <p>
	 * The evaluation operator
	 * </p>
	 * @param float $constant <p>
	 * The value of the operator
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function evaluateimage ($op, $constant, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Merges a sequence of images
	 * @link http://php.net/manual/en/function.imagick-flattenimages.php
	 * @return Imagick &imagick.return.success;
	 */
	public function flattenimages () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a vertical mirror image
	 * @link http://php.net/manual/en/function.imagick-flipimage.php
	 * @return bool &imagick.return.success;
	 */
	public function flipimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a horizontal mirror image
	 * @link http://php.net/manual/en/function.imagick-flopimage.php
	 * @return bool &imagick.return.success;
	 */
	public function flopimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds a simulated three-dimensional border
	 * @link http://php.net/manual/en/function.imagick-frameimage.php
	 * @param mixed $matte_color <p>
	 * ImagickPixel object or a string representing the matte color
	 * </p>
	 * @param int $width <p>
	 * The width of the border
	 * </p>
	 * @param int $height <p>
	 * The height of the border
	 * </p>
	 * @param int $inner_bevel <p>
	 * The inner bevel width
	 * </p>
	 * @param int $outer_bevel <p>
	 * The outer bevel width
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function frameimage ($matte_color, $width, $height, $inner_bevel, $outer_bevel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Evaluate expression for each pixel in the image
	 * @link http://php.net/manual/en/function.imagick-fximage.php
	 * @param string $expression <p>
	 * The expression.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return Imagick &imagick.return.success;
	 */
	public function fximage ($expression, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gamma-corrects an image
	 * @link http://php.net/manual/en/function.imagick-gammaimage.php
	 * @param float $gamma <p>
	 * The amount of gamma-correction.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function gammaimage ($gamma, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Blurs an image
	 * @link http://php.net/manual/en/function.imagick-gaussianblurimage.php
	 * @param float $radius <p>
	 * The radius of the Gaussian, in pixels, not counting the center pixel.
	 * </p>
	 * @param float $sigma <p>
	 * The standard deviation of the Gaussian, in pixels.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function gaussianblurimage ($radius, $sigma, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * @param $key
	 */
	public function getimageattribute ($key) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image background color
	 * @link http://php.net/manual/en/function.imagick-getimagebackgroundcolor.php
	 * @return ImagickPixel an ImagickPixel set to the background color of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagebackgroundcolor () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the chromaticy blue primary point
	 * @link http://php.net/manual/en/function.imagick-getimageblueprimary.php
	 * @return array Array consisting of "x" and "y" coordinates of point.
	 */
	public function getimageblueprimary () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image border color
	 * @link http://php.net/manual/en/function.imagick-getimagebordercolor.php
	 * @return ImagickPixel &imagick.return.success;
	 */
	public function getimagebordercolor () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the depth for a particular image channel
	 * @link http://php.net/manual/en/function.imagick-getimagechanneldepth.php
	 * @param int $channel <p>
	 * &imagick.parameter.channel;
	 * </p>
	 * @return int &imagick.return.success;
	 */
	public function getimagechanneldepth ($channel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Compares image channels of an image to a reconstructed image
	 * @link http://php.net/manual/en/function.imagick-getimagechanneldistortion.php
	 * @param Imagick $reference <p>
	 * Imagick object to compare to.
	 * </p>
	 * @param int $channel <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @param int $metric <p>
	 * One of the metric type constants.
	 * </p>
	 * @return float &imagick.return.success;
	 */
	public function getimagechanneldistortion (Imagick $reference, $channel, $metric) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the extrema for one or more image channels
	 * @link http://php.net/manual/en/function.imagick-getimagechannelextrema.php
	 * @param int $channel <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return array &imagick.return.success;
	 */
	public function getimagechannelextrema ($channel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the mean and standard deviation
	 * @link http://php.net/manual/en/function.imagick-getimagechannelmean.php
	 * @param int $channel <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return array &imagick.return.success;
	 */
	public function getimagechannelmean ($channel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns statistics for each channel in the image
	 * @link http://php.net/manual/en/function.imagick-getimagechannelstatistics.php
	 * @return array &imagick.return.success;
	 */
	public function getimagechannelstatistics () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the color of the specified colormap index
	 * @link http://php.net/manual/en/function.imagick-getimagecolormapcolor.php
	 * @param int $index <p>
	 * The offset into the image colormap.
	 * </p>
	 * @return ImagickPixel &imagick.return.success;
	 */
	public function getimagecolormapcolor ($index) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image colorspace
	 * @link http://php.net/manual/en/function.imagick-getimagecolorspace.php
	 * @return int &imagick.return.success;
	 */
	public function getimagecolorspace () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the composite operator associated with the image
	 * @link http://php.net/manual/en/function.imagick-getimagecompose.php
	 * @return int &imagick.return.success;
	 */
	public function getimagecompose () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image delay
	 * @link http://php.net/manual/en/function.imagick-getimagedelay.php
	 * @return int the image delay.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagedelay () {}

	/**
	 * (PECL imagick 0.9.1-0.9.9)<br/>
	 * Gets the image depth
	 * @link http://php.net/manual/en/function.imagick-getimagedepth.php
	 * @return int The image depth.
	 */
	public function getimagedepth () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Compares an image to a reconstructed image
	 * @link http://php.net/manual/en/function.imagick-getimagedistortion.php
	 * @param MagickWand $reference <p>
	 * Imagick object to compare to.
	 * </p>
	 * @param int $metric <p>
	 * One of the metric type constants.
	 * </p>
	 * @return float the distortion metric used on the image (or the best guess
	 * thereof).
	 * &imagick.imagickexception.throw;
	 */
	public function getimagedistortion (MagickWand $reference, $metric) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the extrema for the image
	 * @link http://php.net/manual/en/function.imagick-getimageextrema.php
	 * @return array an associative array with the keys "min" and "max".
	 * &imagick.imagickexception.throw;
	 */
	public function getimageextrema () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image disposal method
	 * @link http://php.net/manual/en/function.imagick-getimagedispose.php
	 * @return int the dispose method on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagedispose () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image gamma
	 * @link http://php.net/manual/en/function.imagick-getimagegamma.php
	 * @return float the image gamma on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagegamma () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the chromaticy green primary point
	 * @link http://php.net/manual/en/function.imagick-getimagegreenprimary.php
	 * @return array an array with the keys "x" and "y" on success, throws an
	 * ImagickException on failure.
	 */
	public function getimagegreenprimary () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image height
	 * @link http://php.net/manual/en/function.imagick-getimageheight.php
	 * @return int the image height in pixels.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageheight () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image histogram
	 * @link http://php.net/manual/en/function.imagick-getimagehistogram.php
	 * @return array the image histogram as an array of ImagickPixel objects.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagehistogram () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image interlace scheme
	 * @link http://php.net/manual/en/function.imagick-getimageinterlacescheme.php
	 * @return int the interlace scheme as an integer on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageinterlacescheme () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image iterations
	 * @link http://php.net/manual/en/function.imagick-getimageiterations.php
	 * @return int the image iterations as an integer.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageiterations () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image matte color
	 * @link http://php.net/manual/en/function.imagick-getimagemattecolor.php
	 * @return ImagickPixel ImagickPixel object on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagemattecolor () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the page geometry
	 * @link http://php.net/manual/en/function.imagick-getimagepage.php
	 * @return array the page geometry associated with the image in an array with the
	 * keys "width", "height", "x", and "y".
	 */
	public function getimagepage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the color of the specified pixel
	 * @link http://php.net/manual/en/function.imagick-getimagepixelcolor.php
	 * @param int $x <p>
	 * The x-coordinate of the pixel
	 * </p>
	 * @param int $y <p>
	 * The y-coordinate of the pixel
	 * </p>
	 * @return ImagickPixel an ImagickPixel instance for the color at the coordinates given.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagepixelcolor ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the named image profile
	 * @link http://php.net/manual/en/function.imagick-getimageprofile.php
	 * @param string $name <p>
	 * The name of the profile to return.
	 * </p>
	 * @return string a string containing the image profile.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageprofile ($name) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the chromaticity red primary point
	 * @link http://php.net/manual/en/function.imagick-getimageredprimary.php
	 * @return array the chromaticity red primary point as an array with the keys "x"
	 * and "y".
	 * &imagick.imagickexception.throw;
	 */
	public function getimageredprimary () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image rendering intent
	 * @link http://php.net/manual/en/function.imagick-getimagerenderingintent.php
	 * @return int the image rendering intent.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagerenderingintent () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image X and Y resolution
	 * @link http://php.net/manual/en/function.imagick-getimageresolution.php
	 * @return array the resolution as an array.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageresolution () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image scene
	 * @link http://php.net/manual/en/function.imagick-getimagescene.php
	 * @return int the image scene.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagescene () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Generates an SHA-256 message digest
	 * @link http://php.net/manual/en/function.imagick-getimagesignature.php
	 * @return string a string containing the SHA-256 hash of the file.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagesignature () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image ticks-per-second
	 * @link http://php.net/manual/en/function.imagick-getimagetickspersecond.php
	 * @return int the image ticks-per-second.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagetickspersecond () {}

	/**
	 * (PECL imagick 0.9.10-0.9.9)<br/>
	 * Gets the potential image type
	 * @link http://php.net/manual/en/function.imagick-getimagetype.php
	 * @return int the potential image type.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagetype () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image units of resolution
	 * @link http://php.net/manual/en/function.imagick-getimageunits.php
	 * @return int the image units of resolution.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageunits () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the virtual pixel method
	 * @link http://php.net/manual/en/function.imagick-getimagevirtualpixelmethod.php
	 * @return int the virtual pixel method on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagevirtualpixelmethod () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the chromaticity white point
	 * @link http://php.net/manual/en/function.imagick-getimagewhitepoint.php
	 * @return array the chromaticity white point as an associative array with the keys
	 * "x" and "y".
	 * &imagick.imagickexception.throw;
	 */
	public function getimagewhitepoint () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the image width
	 * @link http://php.net/manual/en/function.imagick-getimagewidth.php
	 * @return int the image width.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagewidth () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the number of images in the object
	 * @link http://php.net/manual/en/function.imagick-getnumberimages.php
	 * @return int the number of images associated with Imagick object.
	 * &imagick.imagickexception.throw;
	 */
	public function getnumberimages () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the image total ink density
	 * @link http://php.net/manual/en/function.imagick-getimagetotalinkdensity.php
	 * @return float the image total ink density of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getimagetotalinkdensity () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Extracts a region of the image
	 * @link http://php.net/manual/en/function.imagick-getimageregion.php
	 * @param int $width <p>
	 * The width of the extracted region.
	 * </p>
	 * @param int $height <p>
	 * The height of the extracted region.
	 * </p>
	 * @param int $x <p>
	 * X-coordinate of the top-left corner of the extracted region.
	 * </p>
	 * @param int $y <p>
	 * Y-coordinate of the top-left corner of the extracted region.
	 * </p>
	 * @return Imagick Extracts a region of the image and returns it as a new wand.
	 * &imagick.imagickexception.throw;
	 */
	public function getimageregion ($width, $height, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a new image as a copy
	 * @link http://php.net/manual/en/function.imagick-implodeimage.php
	 * @param float $radius <p>
	 * The radius of the implode
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function implodeimage ($radius) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adjusts the levels of an image
	 * @link http://php.net/manual/en/function.imagick-levelimage.php
	 * @param float $blackPoint <p>
	 * The image black point
	 * </p>
	 * @param float $gamma <p>
	 * The gamma value
	 * </p>
	 * @param float $whitePoint <p>
	 * The image white point
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function levelimage ($blackPoint, $gamma, $whitePoint, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Scales an image proportionally 2x
	 * @link http://php.net/manual/en/function.imagick-magnifyimage.php
	 * @return bool &imagick.return.success;
	 */
	public function magnifyimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Replaces the colors of an image with the closest color from a reference image.
	 * @link http://php.net/manual/en/function.imagick-mapimage.php
	 * @param Imagick $map
	 * @param bool $dither
	 * @return bool &imagick.return.success;
	 */
	public function mapimage (Imagick $map, $dither) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Changes the transparency value of a color
	 * @link http://php.net/manual/en/function.imagick-mattefloodfillimage.php
	 * @param float $alpha <p>
	 * The level of transparency: 1.0 is fully opaque and 0.0 is fully
	 * transparent.
	 * </p>
	 * @param float $fuzz <p>
	 * The fuzz member of image defines how much tolerance is acceptable to
	 * consider two colors as the same.
	 * </p>
	 * @param mixed $bordercolor <p>
	 * An <b>ImagickPixel</b> object or string representing the border color.
	 * </p>
	 * @param int $x <p>
	 * The starting x coordinate of the operation.
	 * </p>
	 * @param int $y <p>
	 * The starting y coordinate of the operation.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function mattefloodfillimage ($alpha, $fuzz, $bordercolor, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies a digital filter
	 * @link http://php.net/manual/en/function.imagick-medianfilterimage.php
	 * @param float $radius <p>
	 * The radius of the pixel neighborhood.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function medianfilterimage ($radius) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Negates the colors in the reference image
	 * @link http://php.net/manual/en/function.imagick-negateimage.php
	 * @param bool $gray <p>
	 * Whether to only negate grayscale pixels within the image.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function negateimage ($gray, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Change any pixel that matches color
	 * @link http://php.net/manual/en/function.imagick-paintopaqueimage.php
	 * @param mixed $target <p>
	 * Change this target color to the fill color within the image. An
	 * ImagickPixel object or a string representing the target color.
	 * </p>
	 * @param mixed $fill <p>
	 * An ImagickPixel object or a string representing the fill color.
	 * </p>
	 * @param float $fuzz <p>
	 * The fuzz member of image defines how much tolerance is acceptable to
	 * consider two colors as the same.
	 * </p>
	 * @param int $channel [optional] <p>
	 * Provide any channel constant that is valid for your channel mode. To
	 * apply to more than one channel, combine channeltype constants using
	 * bitwise operators. Refer to this
	 * list of channel constants.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function paintopaqueimage ($target, $fill, $fuzz, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Changes any pixel that matches color with the color defined by fill
	 * @link http://php.net/manual/en/function.imagick-painttransparentimage.php
	 * @param mixed $target <p>
	 * Change this target color to specified opacity value within the image.
	 * </p>
	 * @param float $alpha <p>
	 * The level of transparency: 1.0 is fully opaque and 0.0 is fully
	 * transparent.
	 * </p>
	 * @param float $fuzz <p>
	 * The fuzz member of image defines how much tolerance is acceptable to
	 * consider two colors as the same.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function painttransparentimage ($target, $alpha, $fuzz) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Quickly pin-point appropriate parameters for image processing
	 * @link http://php.net/manual/en/function.imagick-previewimages.php
	 * @param int $preview <p>
	 * Preview type. See Preview type constants
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function previewimages ($preview) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds or removes a profile from an image
	 * @link http://php.net/manual/en/function.imagick-profileimage.php
	 * @param string $name
	 * @param string $profile
	 * @return bool &imagick.return.success;
	 */
	public function profileimage ($name, $profile) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Analyzes the colors within a reference image
	 * @link http://php.net/manual/en/function.imagick-quantizeimage.php
	 * @param int $numberColors
	 * @param int $colorspace
	 * @param int $treedepth
	 * @param bool $dither
	 * @param bool $measureError
	 * @return bool &imagick.return.success;
	 */
	public function quantizeimage ($numberColors, $colorspace, $treedepth, $dither, $measureError) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Analyzes the colors within a sequence of images
	 * @link http://php.net/manual/en/function.imagick-quantizeimages.php
	 * @param int $numberColors
	 * @param int $colorspace
	 * @param int $treedepth
	 * @param bool $dither
	 * @param bool $measureError
	 * @return bool &imagick.return.success;
	 */
	public function quantizeimages ($numberColors, $colorspace, $treedepth, $dither, $measureError) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Smooths the contours of an image
	 * @link http://php.net/manual/en/function.imagick-reducenoiseimage.php
	 * @param float $radius
	 * @return bool &imagick.return.success;
	 */
	public function reducenoiseimage ($radius) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Removes the named image profile and returns it
	 * @link http://php.net/manual/en/function.imagick-removeimageprofile.php
	 * @param string $name
	 * @return string a string containing the profile of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function removeimageprofile ($name) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Separates a channel from the image
	 * @link http://php.net/manual/en/function.imagick-separateimagechannel.php
	 * @param int $channel
	 * @return bool &imagick.return.success;
	 */
	public function separateimagechannel ($channel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sepia tones an image
	 * @link http://php.net/manual/en/function.imagick-sepiatoneimage.php
	 * @param float $threshold
	 * @return bool &imagick.return.success;
	 */
	public function sepiatoneimage ($threshold) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image bias for any method that convolves an image
	 * @link http://php.net/manual/en/function.imagick-setimagebias.php
	 * @param float $bias
	 * @return bool &imagick.return.success;
	 */
	public function setimagebias ($bias) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image chromaticity blue primary point
	 * @link http://php.net/manual/en/function.imagick-setimageblueprimary.php
	 * @param float $x
	 * @param float $y
	 * @return bool &imagick.return.success;
	 */
	public function setimageblueprimary ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image border color
	 * @link http://php.net/manual/en/function.imagick-setimagebordercolor.php
	 * @param mixed $border <p>
	 * The border color
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimagebordercolor ($border) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the depth of a particular image channel
	 * @link http://php.net/manual/en/function.imagick-setimagechanneldepth.php
	 * @param int $channel
	 * @param int $depth
	 * @return bool &imagick.return.success;
	 */
	public function setimagechanneldepth ($channel, $depth) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the color of the specified colormap index
	 * @link http://php.net/manual/en/function.imagick-setimagecolormapcolor.php
	 * @param int $index
	 * @param ImagickPixel $color
	 * @return bool &imagick.return.success;
	 */
	public function setimagecolormapcolor ($index, ImagickPixel $color) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image colorspace
	 * @link http://php.net/manual/en/function.imagick-setimagecolorspace.php
	 * @param int $colorspace
	 * @return bool &imagick.return.success;
	 */
	public function setimagecolorspace ($colorspace) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image disposal method
	 * @link http://php.net/manual/en/function.imagick-setimagedispose.php
	 * @param int $dispose
	 * @return bool &imagick.return.success;
	 */
	public function setimagedispose ($dispose) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image size
	 * @link http://php.net/manual/en/function.imagick-setimageextent.php
	 * @param int $columns
	 * @param int $rows
	 * @return bool &imagick.return.success;
	 */
	public function setimageextent ($columns, $rows) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image chromaticity green primary point
	 * @link http://php.net/manual/en/function.imagick-setimagegreenprimary.php
	 * @param float $x
	 * @param float $y
	 * @return bool &imagick.return.success;
	 */
	public function setimagegreenprimary ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image compression
	 * @link http://php.net/manual/en/function.imagick-setimageinterlacescheme.php
	 * @param int $interlace_scheme
	 * @return bool &imagick.return.success;
	 */
	public function setimageinterlacescheme ($interlace_scheme) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds a named profile to the Imagick object
	 * @link http://php.net/manual/en/function.imagick-setimageprofile.php
	 * @param string $name
	 * @param string $profile
	 * @return bool &imagick.return.success;
	 */
	public function setimageprofile ($name, $profile) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image chromaticity red primary point
	 * @link http://php.net/manual/en/function.imagick-setimageredprimary.php
	 * @param float $x
	 * @param float $y
	 * @return bool &imagick.return.success;
	 */
	public function setimageredprimary ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image rendering intent
	 * @link http://php.net/manual/en/function.imagick-setimagerenderingintent.php
	 * @param int $rendering_intent
	 * @return bool &imagick.return.success;
	 */
	public function setimagerenderingintent ($rendering_intent) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image virtual pixel method
	 * @link http://php.net/manual/en/function.imagick-setimagevirtualpixelmethod.php
	 * @param int $method
	 * @return bool &imagick.return.success;
	 */
	public function setimagevirtualpixelmethod ($method) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image chromaticity white point
	 * @link http://php.net/manual/en/function.imagick-setimagewhitepoint.php
	 * @param float $x
	 * @param float $y
	 * @return bool &imagick.return.success;
	 */
	public function setimagewhitepoint ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adjusts the contrast of an image
	 * @link http://php.net/manual/en/function.imagick-sigmoidalcontrastimage.php
	 * @param bool $sharpen
	 * @param float $alpha
	 * @param float $beta
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function sigmoidalcontrastimage ($sharpen, $alpha, $beta, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Composites two images
	 * @link http://php.net/manual/en/function.imagick-stereoimage.php
	 * @param Imagick $offset_wand
	 * @return bool &imagick.return.success;
	 */
	public function stereoimage (Imagick $offset_wand) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Repeatedly tiles the texture image
	 * @link http://php.net/manual/en/function.imagick-textureimage.php
	 * @param Imagick $texture_wand
	 * @return bool &imagick.return.success;
	 */
	public function textureimage (Imagick $texture_wand) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies a color vector to each pixel in the image
	 * @link http://php.net/manual/en/function.imagick-tintimage.php
	 * @param mixed $tint
	 * @param mixed $opacity
	 * @return bool &imagick.return.success;
	 */
	public function tintimage ($tint, $opacity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sharpens an image
	 * @link http://php.net/manual/en/function.imagick-unsharpmaskimage.php
	 * @param float $radius
	 * @param float $sigma
	 * @param float $amount
	 * @param float $threshold
	 * @param int $channel [optional]
	 * @return bool &imagick.return.success;
	 */
	public function unsharpmaskimage ($radius, $sigma, $amount, $threshold, $channel = 'Imagick::CHANNEL_ALL') {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a new Imagick object
	 * @link http://php.net/manual/en/function.imagick-getimage.php
	 * @return Imagick a new Imagick object with the current image sequence.
	 * &imagick.imagickexception.throw;
	 */
	public function getimage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds new image to Imagick object image list
	 * @link http://php.net/manual/en/function.imagick-addimage.php
	 * @param Imagick $source <p>
	 * The source Imagick object
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function addimage (Imagick $source) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Replaces image in the object
	 * @link http://php.net/manual/en/function.imagick-setimage.php
	 * @param Imagick $replace <p>
	 * The replace Imagick object
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setimage (Imagick $replace) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a new image
	 * @link http://php.net/manual/en/function.imagick-newimage.php
	 * @param int $cols <p>
	 * Columns in the new image
	 * </p>
	 * @param int $rows <p>
	 * Rows in the new image
	 * </p>
	 * @param mixed $background <p>
	 * The background color used for this image
	 * </p>
	 * @param string $format [optional] <p>
	 * Image format. This parameter was added in Imagick version 2.0.1.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function newimage ($cols, $rows, $background, $format = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Creates a new image
	 * @link http://php.net/manual/en/function.imagick-newpseudoimage.php
	 * @param int $columns <p>
	 * columns in the new image
	 * </p>
	 * @param int $rows <p>
	 * rows in the new image
	 * </p>
	 * @param string $pseudoString <p>
	 * string containing pseudo image definition.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function newpseudoimage ($columns, $rows, $pseudoString) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the object compression type
	 * @link http://php.net/manual/en/function.imagick-getcompression.php
	 * @return int the compression constant
	 */
	public function getcompression () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the object compression quality
	 * @link http://php.net/manual/en/function.imagick-getcompressionquality.php
	 * @return int integer describing the compression quality
	 */
	public function getcompressionquality () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the ImageMagick API copyright as a string
	 * @link http://php.net/manual/en/function.imagick-getcopyright.php
	 * @return string a string containing the copyright notice of Imagemagick and
	 * Magickwand C API.
	 */
	public function getcopyright () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * The filename associated with an image sequence
	 * @link http://php.net/manual/en/function.imagick-getfilename.php
	 * @return string a string on success.
	 * &imagick.imagickexception.throw;
	 */
	public function getfilename () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the format of the Imagick object
	 * @link http://php.net/manual/en/function.imagick-getformat.php
	 * @return string the format of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getformat () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the ImageMagick home URL
	 * @link http://php.net/manual/en/function.imagick-gethomeurl.php
	 * @return string a link to the imagemagick homepage.
	 */
	public function gethomeurl () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the object interlace scheme
	 * @link http://php.net/manual/en/function.imagick-getinterlacescheme.php
	 * @return int Gets the wand interlace
	 * scheme.
	 * &imagick.imagickexception.throw;
	 */
	public function getinterlacescheme () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a value associated with the specified key
	 * @link http://php.net/manual/en/function.imagick-getoption.php
	 * @param string $key <p>
	 * The name of the option
	 * </p>
	 * @return string a value associated with a wand and the specified key.
	 * &imagick.imagickexception.throw;
	 */
	public function getoption ($key) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the ImageMagick package name
	 * @link http://php.net/manual/en/function.imagick-getpackagename.php
	 * @return string the ImageMagick package name as a string.
	 * &imagick.imagickexception.throw;
	 */
	public function getpackagename () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the page geometry
	 * @link http://php.net/manual/en/function.imagick-getpage.php
	 * @return array the page geometry associated with the Imagick object in
	 * an associative array with the keys "width", "height", "x", and "y",
	 * throwing ImagickException on error.
	 */
	public function getpage () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the quantum depth
	 * @link http://php.net/manual/en/function.imagick-getquantumdepth.php
	 * @return array the Imagick quantum depth as a string.
	 * &imagick.imagickexception.throw;
	 */
	public function getquantumdepth () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the Imagick quantum range
	 * @link http://php.net/manual/en/function.imagick-getquantumrange.php
	 * @return array the Imagick quantum range as a string.
	 * &imagick.imagickexception.throw;
	 */
	public function getquantumrange () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the ImageMagick release date
	 * @link http://php.net/manual/en/function.imagick-getreleasedate.php
	 * @return string the ImageMagick release date as a string.
	 * &imagick.imagickexception.throw;
	 */
	public function getreleasedate () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the specified resource's memory usage
	 * @link http://php.net/manual/en/function.imagick-getresource.php
	 * @param int $type <p>
	 * Refer to the list of resourcetype constants.
	 * </p>
	 * @return int the specified resource's memory usage in megabytes.
	 * &imagick.imagickexception.throw;
	 */
	public function getresource ($type) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the specified resource limit
	 * @link http://php.net/manual/en/function.imagick-getresourcelimit.php
	 * @param int $type <p>
	 * Refer to the list of resourcetype constants.
	 * </p>
	 * @return int the specified resource limit in megabytes.
	 * &imagick.imagickexception.throw;
	 */
	public function getresourcelimit ($type) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the horizontal and vertical sampling factor
	 * @link http://php.net/manual/en/function.imagick-getsamplingfactors.php
	 * @return array an associative array with the horizontal and vertical sampling
	 * factors of the image.
	 * &imagick.imagickexception.throw;
	 */
	public function getsamplingfactors () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the size associated with the Imagick object
	 * @link http://php.net/manual/en/function.imagick-getsize.php
	 * @return array the size associated with the Imagick object as an array with the
	 * keys "columns" and "rows".
	 */
	public function getsize () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the ImageMagick API version
	 * @link http://php.net/manual/en/function.imagick-getversion.php
	 * @return array the ImageMagick API version as a string and as a number.
	 * &imagick.imagickexception.throw;
	 */
	public function getversion () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the object's default background color
	 * @link http://php.net/manual/en/function.imagick-setbackgroundcolor.php
	 * @param mixed $background
	 * @return bool &imagick.return.success;
	 */
	public function setbackgroundcolor ($background) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the object's default compression type
	 * @link http://php.net/manual/en/function.imagick-setcompression.php
	 * @param int $compression
	 * @return bool &imagick.return.success;
	 */
	public function setcompression ($compression) {}

	/**
	 * (PECL imagick 0.9.10-0.9.9)<br/>
	 * Sets the object's default compression quality
	 * @link http://php.net/manual/en/function.imagick-setcompressionquality.php
	 * @param int $quality
	 * @return bool &imagick.return.success;
	 */
	public function setcompressionquality ($quality) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the filename before you read or write the image
	 * @link http://php.net/manual/en/function.imagick-setfilename.php
	 * @param string $filename
	 * @return bool &imagick.return.success;
	 */
	public function setfilename ($filename) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the format of the Imagick object
	 * @link http://php.net/manual/en/function.imagick-setformat.php
	 * @param string $format
	 * @return bool &imagick.return.success;
	 */
	public function setformat ($format) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image compression
	 * @link http://php.net/manual/en/function.imagick-setinterlacescheme.php
	 * @param int $interlace_scheme
	 * @return bool &imagick.return.success;
	 */
	public function setinterlacescheme ($interlace_scheme) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Set an option
	 * @link http://php.net/manual/en/function.imagick-setoption.php
	 * @param string $key
	 * @param string $value
	 * @return bool &imagick.return.success;
	 */
	public function setoption ($key, $value) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the page geometry of the Imagick object
	 * @link http://php.net/manual/en/function.imagick-setpage.php
	 * @param int $width
	 * @param int $height
	 * @param int $x
	 * @param int $y
	 * @return bool &imagick.return.success;
	 */
	public function setpage ($width, $height, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the limit for a particular resource in megabytes
	 * @link http://php.net/manual/en/function.imagick-setresourcelimit.php
	 * @param int $type
	 * @param int $limit
	 * @return bool &imagick.return.success;
	 */
	public function setresourcelimit ($type, $limit) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image resolution
	 * @link http://php.net/manual/en/function.imagick-setresolution.php
	 * @param float $x_resolution
	 * @param float $y_resolution
	 * @return bool &imagick.return.success;
	 */
	public function setresolution ($x_resolution, $y_resolution) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image sampling factors
	 * @link http://php.net/manual/en/function.imagick-setsamplingfactors.php
	 * @param array $factors
	 * @return bool &imagick.return.success;
	 */
	public function setsamplingfactors (array $factors) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the size of the Imagick object
	 * @link http://php.net/manual/en/function.imagick-setsize.php
	 * @param int $columns
	 * @param int $rows
	 * @return bool &imagick.return.success;
	 */
	public function setsize ($columns, $rows) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the image type attribute
	 * @link http://php.net/manual/en/function.imagick-settype.php
	 * @param int $image_type
	 * @return bool &imagick.return.success;
	 */
	public function settype ($image_type) {}

	public function key () {}

	public function next () {}

	public function rewind () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Checks if the current item is valid
	 * @link http://php.net/manual/en/function.imagick-valid.php
	 * @return bool &imagick.return.success;
	 */
	public function valid () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a reference to the current Imagick object
	 * @link http://php.net/manual/en/function.imagick-current.php
	 * @return Imagick self on success.
	 * &imagick.imagickexception.throw;
	 */
	public function current () {}

}

/**
 * @link http://php.net/manual/en/class.imagickdraw.php
 */
class ImagickDraw  {

	public function resetvectorgraphics () {}

	public function gettextkerning () {}

	/**
	 * @param $kerning
	 */
	public function settextkerning ($kerning) {}

	public function gettextinterwordspacing () {}

	/**
	 * @param $spacing
	 */
	public function settextinterwordspacing ($spacing) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * The ImagickDraw constructor
	 * @link http://php.net/manual/en/function.imagickdraw-construct.php
	 */
	public function __construct () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the fill color to be used for drawing filled objects
	 * @link http://php.net/manual/en/function.imagickdraw-setfillcolor.php
	 * @param ImagickPixel $fill_pixel <p>
	 * ImagickPixel to use to set the color
	 * </p>
	 * @return bool
	 */
	public function setfillcolor (ImagickPixel $fill_pixel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the opacity to use when drawing using the fill color or fill texture
	 * @link http://php.net/manual/en/function.imagickdraw-setfillalpha.php
	 * @param float $opacity <p>
	 * fill alpha
	 * </p>
	 * @return bool
	 */
	public function setfillalpha ($opacity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the color used for stroking object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokecolor.php
	 * @param ImagickPixel $stroke_pixel <p>
	 * the stroke color
	 * </p>
	 * @return bool
	 */
	public function setstrokecolor (ImagickPixel $stroke_pixel) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the opacity of stroked object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokealpha.php
	 * @param float $opacity <p>
	 * opacity
	 * </p>
	 * @return bool
	 */
	public function setstrokealpha ($opacity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the width of the stroke used to draw object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokewidth.php
	 * @param float $stroke_width <p>
	 * stroke width
	 * </p>
	 * @return bool
	 */
	public function setstrokewidth ($stroke_width) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clears the ImagickDraw
	 * @link http://php.net/manual/en/function.imagickdraw-clear.php
	 * @return bool an ImagickDraw object.
	 */
	public function clear () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a circle
	 * @link http://php.net/manual/en/function.imagickdraw-circle.php
	 * @param float $ox <p>
	 * origin x coordinate
	 * </p>
	 * @param float $oy <p>
	 * origin y coordinate
	 * </p>
	 * @param float $px <p>
	 * perimeter x coordinate
	 * </p>
	 * @param float $py <p>
	 * perimeter y coordinate
	 * </p>
	 * @return bool
	 */
	public function circle ($ox, $oy, $px, $py) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws text on the image
	 * @link http://php.net/manual/en/function.imagickdraw-annotation.php
	 * @param float $x <p>
	 * The x coordinate where text is drawn
	 * </p>
	 * @param float $y <p>
	 * The y coordinate where text is drawn
	 * </p>
	 * @param string $text <p>
	 * The text to draw on the image
	 * </p>
	 * @return bool
	 */
	public function annotation ($x, $y, $text) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Controls whether text is antialiased
	 * @link http://php.net/manual/en/function.imagickdraw-settextantialias.php
	 * @param bool $antiAlias
	 * @return bool
	 */
	public function settextantialias ($antiAlias) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies specifies the text code set
	 * @link http://php.net/manual/en/function.imagickdraw-settextencoding.php
	 * @param string $encoding <p>
	 * the encoding name
	 * </p>
	 * @return bool
	 */
	public function settextencoding ($encoding) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the fully-specified font to use when annotating with text
	 * @link http://php.net/manual/en/function.imagickdraw-setfont.php
	 * @param string $font_name
	 * @return bool &imagick.return.success;
	 */
	public function setfont ($font_name) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the font family to use when annotating with text
	 * @link http://php.net/manual/en/function.imagickdraw-setfontfamily.php
	 * @param string $font_family <p>
	 * the font family
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setfontfamily ($font_family) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the font pointsize to use when annotating with text
	 * @link http://php.net/manual/en/function.imagickdraw-setfontsize.php
	 * @param float $pointsize <p>
	 * the point size
	 * </p>
	 * @return bool
	 */
	public function setfontsize ($pointsize) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the font style to use when annotating with text
	 * @link http://php.net/manual/en/function.imagickdraw-setfontstyle.php
	 * @param int $style <p>
	 * STYLETYPE_ constant
	 * </p>
	 * @return bool
	 */
	public function setfontstyle ($style) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the font weight
	 * @link http://php.net/manual/en/function.imagickdraw-setfontweight.php
	 * @param int $font_weight
	 * @return bool
	 */
	public function setfontweight ($font_weight) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the font
	 * @link http://php.net/manual/en/function.imagickdraw-getfont.php
	 * @return string a string on success and false if no font is set.
	 */
	public function getfont () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the font family
	 * @link http://php.net/manual/en/function.imagickdraw-getfontfamily.php
	 * @return string the font family currently selected or false if font family is not set.
	 */
	public function getfontfamily () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the font pointsize
	 * @link http://php.net/manual/en/function.imagickdraw-getfontsize.php
	 * @return float the font size associated with the current ImagickDraw object.
	 */
	public function getfontsize () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the font style
	 * @link http://php.net/manual/en/function.imagickdraw-getfontstyle.php
	 * @return int the font style constant (STYLE_) associated with the ImagickDraw object
	 * or 0 if no style is set.
	 */
	public function getfontstyle () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the font weight
	 * @link http://php.net/manual/en/function.imagickdraw-getfontweight.php
	 * @return int an int on success and 0 if no weight is set.
	 */
	public function getfontweight () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Frees all associated resources
	 * @link http://php.net/manual/en/function.imagickdraw-destroy.php
	 * @return bool
	 */
	public function destroy () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a rectangle
	 * @link http://php.net/manual/en/function.imagickdraw-rectangle.php
	 * @param float $x1 <p>
	 * x coordinate of the top left corner
	 * </p>
	 * @param float $y1 <p>
	 * y coordinate of the top left corner
	 * </p>
	 * @param float $x2 <p>
	 * x coordinate of the bottom right corner
	 * </p>
	 * @param float $y2 <p>
	 * y coordinate of the bottom right corner
	 * </p>
	 * @return bool
	 */
	public function rectangle ($x1, $y1, $x2, $y2) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a rounded rectangle
	 * @link http://php.net/manual/en/function.imagickdraw-roundrectangle.php
	 * @param float $x1 <p>
	 * x coordinate of the top left corner
	 * </p>
	 * @param float $y1 <p>
	 * y coordinate of the top left corner
	 * </p>
	 * @param float $x2 <p>
	 * x coordinate of the bottom right
	 * </p>
	 * @param float $y2 <p>
	 * y coordinate of the bottom right
	 * </p>
	 * @param float $rx <p>
	 * x rounding
	 * </p>
	 * @param float $ry <p>
	 * y rounding
	 * </p>
	 * @return bool
	 */
	public function roundrectangle ($x1, $y1, $x2, $y2, $rx, $ry) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws an ellipse on the image
	 * @link http://php.net/manual/en/function.imagickdraw-ellipse.php
	 * @param float $ox
	 * @param float $oy
	 * @param float $rx
	 * @param float $ry
	 * @param float $start
	 * @param float $end
	 * @return bool
	 */
	public function ellipse ($ox, $oy, $rx, $ry, $start, $end) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Skews the current coordinate system in the horizontal direction
	 * @link http://php.net/manual/en/function.imagickdraw-skewx.php
	 * @param float $degrees <p>
	 * degrees to skew
	 * </p>
	 * @return bool
	 */
	public function skewx ($degrees) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Skews the current coordinate system in the vertical direction
	 * @link http://php.net/manual/en/function.imagickdraw-skewy.php
	 * @param float $degrees <p>
	 * degrees to skew
	 * </p>
	 * @return bool
	 */
	public function skewy ($degrees) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies a translation to the current coordinate system
	 * @link http://php.net/manual/en/function.imagickdraw-translate.php
	 * @param float $x <p>
	 * horizontal translation
	 * </p>
	 * @param float $y <p>
	 * vertical translation
	 * </p>
	 * @return bool
	 */
	public function translate ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a line
	 * @link http://php.net/manual/en/function.imagickdraw-line.php
	 * @param float $sx <p>
	 * starting x coordinate
	 * </p>
	 * @param float $sy <p>
	 * starting y coordinate
	 * </p>
	 * @param float $ex <p>
	 * ending x coordinate
	 * </p>
	 * @param float $ey <p>
	 * ending y coordinate
	 * </p>
	 * @return bool
	 */
	public function line ($sx, $sy, $ex, $ey) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws an arc
	 * @link http://php.net/manual/en/function.imagickdraw-arc.php
	 * @param float $sx <p>
	 * Starting x ordinate of bounding rectangle
	 * </p>
	 * @param float $sy <p>
	 * starting y ordinate of bounding rectangle
	 * </p>
	 * @param float $ex <p>
	 * ending x ordinate of bounding rectangle
	 * </p>
	 * @param float $ey <p>
	 * ending y ordinate of bounding rectangle
	 * </p>
	 * @param float $sd <p>
	 * starting degrees of rotation
	 * </p>
	 * @param float $ed <p>
	 * ending degrees of rotation
	 * </p>
	 * @return bool
	 */
	public function arc ($sx, $sy, $ex, $ey, $sd, $ed) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Paints on the image's opacity channel
	 * @link http://php.net/manual/en/function.imagickdraw-matte.php
	 * @param float $x <p>
	 * x coordinate of the matte
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the matte
	 * </p>
	 * @param int $paintMethod <p>
	 * PAINT_ constant
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function matte ($x, $y, $paintMethod) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a polygon
	 * @link http://php.net/manual/en/function.imagickdraw-polygon.php
	 * @param array $coordinates <p>
	 * multidimensional array like array( array( 'x' => 3, 'y' => 4 ), array( 'x' => 2, 'y' => 6 ) );
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function polygon (array $coordinates) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a point
	 * @link http://php.net/manual/en/function.imagickdraw-point.php
	 * @param float $x <p>
	 * point's x coordinate
	 * </p>
	 * @param float $y <p>
	 * point's y coordinate
	 * </p>
	 * @return bool
	 */
	public function point ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the text decoration
	 * @link http://php.net/manual/en/function.imagickdraw-gettextdecoration.php
	 * @return int one of the DECORATION_ constants
	 * and 0 if no decoration is set.
	 */
	public function gettextdecoration () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the code set used for text annotations
	 * @link http://php.net/manual/en/function.imagickdraw-gettextencoding.php
	 * @return string a string specifying the code set
	 * or false if text encoding is not set.
	 */
	public function gettextencoding () {}

	public function getfontstretch () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the font stretch to use when annotating with text
	 * @link http://php.net/manual/en/function.imagickdraw-setfontstretch.php
	 * @param int $fontStretch <p>
	 * STRETCH_ constant
	 * </p>
	 * @return bool
	 */
	public function setfontstretch ($fontStretch) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Controls whether stroked outlines are antialiased
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokeantialias.php
	 * @param bool $stroke_antialias <p>
	 * the antialias setting
	 * </p>
	 * @return bool
	 */
	public function setstrokeantialias ($stroke_antialias) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies a text alignment
	 * @link http://php.net/manual/en/function.imagickdraw-settextalignment.php
	 * @param int $alignment <p>
	 * ALIGN_ constant
	 * </p>
	 * @return bool
	 */
	public function settextalignment ($alignment) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies a decoration
	 * @link http://php.net/manual/en/function.imagickdraw-settextdecoration.php
	 * @param int $decoration <p>
	 * DECORATION_ constant
	 * </p>
	 * @return bool
	 */
	public function settextdecoration ($decoration) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the color of a background rectangle
	 * @link http://php.net/manual/en/function.imagickdraw-settextundercolor.php
	 * @param ImagickPixel $under_color <p>
	 * the under color
	 * </p>
	 * @return bool
	 */
	public function settextundercolor (ImagickPixel $under_color) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the overall canvas size
	 * @link http://php.net/manual/en/function.imagickdraw-setviewbox.php
	 * @param int $x1 <p>
	 * left x coordinate
	 * </p>
	 * @param int $y1 <p>
	 * left y coordinate
	 * </p>
	 * @param int $x2 <p>
	 * right x coordinate
	 * </p>
	 * @param int $y2 <p>
	 * right y coordinate
	 * </p>
	 * @return bool
	 */
	public function setviewbox ($x1, $y1, $x2, $y2) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adjusts the current affine transformation matrix
	 * @link http://php.net/manual/en/function.imagickdraw-affine.php
	 * @param array $affine <p>
	 * Affine matrix parameters
	 * </p>
	 * @return bool
	 */
	public function affine (array $affine) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-bezier.php
	 * @param array $coordinates <p>
	 * Multidimensional array like array( array( 'x' => 1, 'y' => 2 ),
	 * array( 'x' => 3, 'y' => 4 ) )
	 * </p>
	 * @return bool
	 */
	public function bezier (array $coordinates) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Composites an image onto the current image
	 * @link http://php.net/manual/en/function.imagickdraw-composite.php
	 * @param int $compose <p>
	 * composition operator. One of COMPOSITE_ constants
	 * </p>
	 * @param float $x <p>
	 * x coordinate of the top left corner
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the top left corner
	 * </p>
	 * @param float $width <p>
	 * width of the composition image
	 * </p>
	 * @param float $height <p>
	 * height of the composition image
	 * </p>
	 * @param Imagick $compositeWand <p>
	 * the Imagick object where composition image is taken from
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function composite ($compose, $x, $y, $width, $height, Imagick $compositeWand) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws color on image
	 * @link http://php.net/manual/en/function.imagickdraw-color.php
	 * @param float $x <p>
	 * x coordinate of the paint
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the paint
	 * </p>
	 * @param int $paintMethod <p>
	 * one of the PAINT_ constants
	 * </p>
	 * @return bool
	 */
	public function color ($x, $y, $paintMethod) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds a comment
	 * @link http://php.net/manual/en/function.imagickdraw-comment.php
	 * @param string $comment <p>
	 * The comment string to add to vector output stream
	 * </p>
	 * @return bool
	 */
	public function comment ($comment) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Obtains the current clipping path ID
	 * @link http://php.net/manual/en/function.imagickdraw-getclippath.php
	 * @return string a string containing the clip path ID or false if no clip path exists.
	 */
	public function getclippath () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the current polygon fill rule
	 * @link http://php.net/manual/en/function.imagickdraw-getcliprule.php
	 * @return int one of the FILLRULE_ constants.
	 */
	public function getcliprule () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the interpretation of clip path units
	 * @link http://php.net/manual/en/function.imagickdraw-getclipunits.php
	 * @return int an int on success.
	 */
	public function getclipunits () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the fill color
	 * @link http://php.net/manual/en/function.imagickdraw-getfillcolor.php
	 * @return ImagickPixel an ImagickPixel object.
	 */
	public function getfillcolor () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the opacity used when drawing
	 * @link http://php.net/manual/en/function.imagickdraw-getfillopacity.php
	 * @return float The opacity.
	 */
	public function getfillopacity () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the fill rule
	 * @link http://php.net/manual/en/function.imagickdraw-getfillrule.php
	 * @return int a FILLRULE_ constant
	 */
	public function getfillrule () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the text placement gravity
	 * @link http://php.net/manual/en/function.imagickdraw-getgravity.php
	 * @return int a GRAVITY_ constant on success and 0 if no gravity is set.
	 */
	public function getgravity () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the current stroke antialias setting
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokeantialias.php
	 * @return bool true if antialiasing is on and false if it is off.
	 */
	public function getstrokeantialias () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the color used for stroking object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokecolor.php
	 * @return ImagickPixel an ImagickPixel object which describes the color.
	 */
	public function getstrokecolor () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns an array representing the pattern of dashes and gaps used to stroke paths
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokedasharray.php
	 * @return array an array on success and empty array if not set.
	 */
	public function getstrokedasharray () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the offset into the dash pattern to start the dash
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokedashoffset.php
	 * @return float a float representing the offset and 0 if it's not set.
	 */
	public function getstrokedashoffset () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the shape to be used at the end of open subpaths when they are stroked
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokelinecap.php
	 * @return int one of the LINECAP_ constants or 0 if stroke linecap is not set.
	 */
	public function getstrokelinecap () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the shape to be used at the corners of paths when they are stroked
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokelinejoin.php
	 * @return int one of the LINEJOIN_ constants or 0 if stroke line join is not set.
	 */
	public function getstrokelinejoin () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the stroke miter limit
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokemiterlimit.php
	 * @return int an int describing the miter limit
	 * and 0 if no miter limit is set.
	 */
	public function getstrokemiterlimit () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the opacity of stroked object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokeopacity.php
	 * @return float a double describing the opacity.
	 */
	public function getstrokeopacity () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the width of the stroke used to draw object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-getstrokewidth.php
	 * @return float a double describing the stroke width.
	 */
	public function getstrokewidth () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the text alignment
	 * @link http://php.net/manual/en/function.imagickdraw-gettextalignment.php
	 * @return int one of the ALIGN_ constants and 0 if no align is set.
	 */
	public function gettextalignment () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the current text antialias setting
	 * @link http://php.net/manual/en/function.imagickdraw-gettextantialias.php
	 * @return bool true if text is antialiased and false if not.
	 */
	public function gettextantialias () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a string containing vector graphics
	 * @link http://php.net/manual/en/function.imagickdraw-getvectorgraphics.php
	 * @return string a string containing the vector graphics.
	 */
	public function getvectorgraphics () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the text under color
	 * @link http://php.net/manual/en/function.imagickdraw-gettextundercolor.php
	 * @return ImagickPixel an ImagickPixel object describing the color.
	 */
	public function gettextundercolor () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adds a path element to the current path
	 * @link http://php.net/manual/en/function.imagickdraw-pathclose.php
	 * @return bool
	 */
	public function pathclose () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a cubic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetoabsolute.php
	 * @param float $x1 <p>
	 * x coordinate of the first control point
	 * </p>
	 * @param float $y1 <p>
	 * y coordinate of the first control point
	 * </p>
	 * @param float $x2 <p>
	 * x coordinate of the second control point
	 * </p>
	 * @param float $y2 <p>
	 * y coordinate of the first control point
	 * </p>
	 * @param float $x <p>
	 * x coordinate of the curve end
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the curve end
	 * </p>
	 * @return bool
	 */
	public function pathcurvetoabsolute ($x1, $y1, $x2, $y2, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a cubic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetorelative.php
	 * @param float $x1 <p>
	 * x coordinate of starting control point
	 * </p>
	 * @param float $y1 <p>
	 * y coordinate of starting control point
	 * </p>
	 * @param float $x2 <p>
	 * x coordinate of ending control point
	 * </p>
	 * @param float $y2 <p>
	 * y coordinate of ending control point
	 * </p>
	 * @param float $x <p>
	 * ending x coordinate
	 * </p>
	 * @param float $y <p>
	 * ending y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathcurvetorelative ($x1, $y1, $x2, $y2, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a quadratic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetoquadraticbezierabsolute.php
	 * @param float $x1 <p>
	 * x coordinate of the control point
	 * </p>
	 * @param float $y1 <p>
	 * y coordinate of the control point
	 * </p>
	 * @param float $x <p>
	 * x coordinate of the end point
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the end point
	 * </p>
	 * @return bool
	 */
	public function pathcurvetoquadraticbezierabsolute ($x1, $y1, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a quadratic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetoquadraticbezierrelative.php
	 * @param float $x1 <p>
	 * starting x coordinate
	 * </p>
	 * @param float $y1 <p>
	 * starting y coordinate
	 * </p>
	 * @param float $x <p>
	 * ending x coordinate
	 * </p>
	 * @param float $y <p>
	 * ending y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathcurvetoquadraticbezierrelative ($x1, $y1, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a quadratic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetoquadraticbeziersmoothabsolute.php
	 * @param float $x <p>
	 * ending x coordinate
	 * </p>
	 * @param float $y <p>
	 * ending y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathcurvetoquadraticbeziersmoothabsolute ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a quadratic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetoquadraticbeziersmoothrelative.php
	 * @param float $x <p>
	 * ending x coordinate
	 * </p>
	 * @param float $y <p>
	 * ending y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathcurvetoquadraticbeziersmoothrelative ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a cubic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetosmoothabsolute.php
	 * @param float $x2 <p>
	 * x coordinate of the second control point
	 * </p>
	 * @param float $y2 <p>
	 * y coordinate of the second control point
	 * </p>
	 * @param float $x <p>
	 * x coordinate of the ending point
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the ending point
	 * </p>
	 * @return bool
	 */
	public function pathcurvetosmoothabsolute ($x2, $y2, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a cubic Bezier curve
	 * @link http://php.net/manual/en/function.imagickdraw-pathcurvetosmoothrelative.php
	 * @param float $x2 <p>
	 * x coordinate of the second control point
	 * </p>
	 * @param float $y2 <p>
	 * y coordinate of the second control point
	 * </p>
	 * @param float $x <p>
	 * x coordinate of the ending point
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the ending point
	 * </p>
	 * @return bool
	 */
	public function pathcurvetosmoothrelative ($x2, $y2, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws an elliptical arc
	 * @link http://php.net/manual/en/function.imagickdraw-pathellipticarcabsolute.php
	 * @param float $rx <p>
	 * x radius
	 * </p>
	 * @param float $ry <p>
	 * y radius
	 * </p>
	 * @param float $x_axis_rotation <p>
	 * x axis rotation
	 * </p>
	 * @param bool $large_arc_flag <p>
	 * large arc flag
	 * </p>
	 * @param bool $sweep_flag <p>
	 * sweep flag
	 * </p>
	 * @param float $x <p>
	 * x coordinate
	 * </p>
	 * @param float $y <p>
	 * y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathellipticarcabsolute ($rx, $ry, $x_axis_rotation, $large_arc_flag, $sweep_flag, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws an elliptical arc
	 * @link http://php.net/manual/en/function.imagickdraw-pathellipticarcrelative.php
	 * @param float $rx <p>
	 * x radius
	 * </p>
	 * @param float $ry <p>
	 * y radius
	 * </p>
	 * @param float $x_axis_rotation <p>
	 * x axis rotation
	 * </p>
	 * @param bool $large_arc_flag <p>
	 * large arc flag
	 * </p>
	 * @param bool $sweep_flag <p>
	 * sweep flag
	 * </p>
	 * @param float $x <p>
	 * x coordinate
	 * </p>
	 * @param float $y <p>
	 * y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathellipticarcrelative ($rx, $ry, $x_axis_rotation, $large_arc_flag, $sweep_flag, $x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Terminates the current path
	 * @link http://php.net/manual/en/function.imagickdraw-pathfinish.php
	 * @return bool
	 */
	public function pathfinish () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a line path
	 * @link http://php.net/manual/en/function.imagickdraw-pathlinetoabsolute.php
	 * @param float $x <p>
	 * starting x coordinate
	 * </p>
	 * @param float $y <p>
	 * ending x coordinate
	 * </p>
	 * @return bool
	 */
	public function pathlinetoabsolute ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a line path
	 * @link http://php.net/manual/en/function.imagickdraw-pathlinetorelative.php
	 * @param float $x <p>
	 * starting x coordinate
	 * </p>
	 * @param float $y <p>
	 * starting y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathlinetorelative ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a horizontal line path
	 * @link http://php.net/manual/en/function.imagickdraw-pathlinetohorizontalabsolute.php
	 * @param float $x <p>
	 * x coordinate
	 * </p>
	 * @return bool
	 */
	public function pathlinetohorizontalabsolute ($x) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a horizontal line
	 * @link http://php.net/manual/en/function.imagickdraw-pathlinetohorizontalrelative.php
	 * @param float $x <p>
	 * x coordinate
	 * </p>
	 * @return bool
	 */
	public function pathlinetohorizontalrelative ($x) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a vertical line
	 * @link http://php.net/manual/en/function.imagickdraw-pathlinetoverticalabsolute.php
	 * @param float $y <p>
	 * y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathlinetoverticalabsolute ($y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a vertical line path
	 * @link http://php.net/manual/en/function.imagickdraw-pathlinetoverticalrelative.php
	 * @param float $y <p>
	 * y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathlinetoverticalrelative ($y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Starts a new sub-path
	 * @link http://php.net/manual/en/function.imagickdraw-pathmovetoabsolute.php
	 * @param float $x <p>
	 * x coordinate of the starting point
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the starting point
	 * </p>
	 * @return bool
	 */
	public function pathmovetoabsolute ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Starts a new sub-path
	 * @link http://php.net/manual/en/function.imagickdraw-pathmovetorelative.php
	 * @param float $x <p>
	 * target x coordinate
	 * </p>
	 * @param float $y <p>
	 * target y coordinate
	 * </p>
	 * @return bool
	 */
	public function pathmovetorelative ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Declares the start of a path drawing list
	 * @link http://php.net/manual/en/function.imagickdraw-pathstart.php
	 * @return bool
	 */
	public function pathstart () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Draws a polyline
	 * @link http://php.net/manual/en/function.imagickdraw-polyline.php
	 * @param array $coordinates <p>
	 * array of x and y coordinates: array( array( 'x' => 4, 'y' => 6 ), array( 'x' => 8, 'y' => 10 ) )
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function polyline (array $coordinates) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Terminates a clip path definition
	 * @link http://php.net/manual/en/function.imagickdraw-popclippath.php
	 * @return bool
	 */
	public function popclippath () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Terminates a definition list
	 * @link http://php.net/manual/en/function.imagickdraw-popdefs.php
	 * @return bool
	 */
	public function popdefs () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Terminates a pattern definition
	 * @link http://php.net/manual/en/function.imagickdraw-poppattern.php
	 * @return bool true on success or false on failure.
	 */
	public function poppattern () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Starts a clip path definition
	 * @link http://php.net/manual/en/function.imagickdraw-pushclippath.php
	 * @param string $clip_mask_id <p>
	 * Clip mask Id
	 * </p>
	 * @return bool
	 */
	public function pushclippath ($clip_mask_id) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Indicates that following commands create named elements for early processing
	 * @link http://php.net/manual/en/function.imagickdraw-pushdefs.php
	 * @return bool
	 */
	public function pushdefs () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Indicates that subsequent commands up to a ImagickDraw::opPattern() command comprise the definition of a named pattern
	 * @link http://php.net/manual/en/function.imagickdraw-pushpattern.php
	 * @param string $pattern_id <p>
	 * the pattern Id
	 * </p>
	 * @param float $x <p>
	 * x coordinate of the top-left corner
	 * </p>
	 * @param float $y <p>
	 * y coordinate of the top-left corner
	 * </p>
	 * @param float $width <p>
	 * width of the pattern
	 * </p>
	 * @param float $height <p>
	 * height of the pattern
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function pushpattern ($pattern_id, $x, $y, $width, $height) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Renders all preceding drawing commands onto the image
	 * @link http://php.net/manual/en/function.imagickdraw-render.php
	 * @return bool true on success or false on failure.
	 */
	public function render () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Applies the specified rotation to the current coordinate space
	 * @link http://php.net/manual/en/function.imagickdraw-rotate.php
	 * @param float $degrees <p>
	 * degrees to rotate
	 * </p>
	 * @return bool
	 */
	public function rotate ($degrees) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Adjusts the scaling factor
	 * @link http://php.net/manual/en/function.imagickdraw-scale.php
	 * @param float $x <p>
	 * horizontal factor
	 * </p>
	 * @param float $y <p>
	 * vertical factor
	 * </p>
	 * @return bool
	 */
	public function scale ($x, $y) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Associates a named clipping path with the image
	 * @link http://php.net/manual/en/function.imagickdraw-setclippath.php
	 * @param string $clip_mask <p>
	 * the clipping path name
	 * </p>
	 * @return bool
	 */
	public function setclippath ($clip_mask) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Set the polygon fill rule to be used by the clipping path
	 * @link http://php.net/manual/en/function.imagickdraw-setcliprule.php
	 * @param int $fill_rule <p>
	 * FILLRULE_ constant
	 * </p>
	 * @return bool
	 */
	public function setcliprule ($fill_rule) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the interpretation of clip path units
	 * @link http://php.net/manual/en/function.imagickdraw-setclipunits.php
	 * @param int $clip_units <p>
	 * the number of clip units
	 * </p>
	 * @return bool
	 */
	public function setclipunits ($clip_units) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the opacity to use when drawing using the fill color or fill texture
	 * @link http://php.net/manual/en/function.imagickdraw-setfillopacity.php
	 * @param float $fillOpacity <p>
	 * the fill opacity
	 * </p>
	 * @return bool
	 */
	public function setfillopacity ($fillOpacity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the URL to use as a fill pattern for filling objects
	 * @link http://php.net/manual/en/function.imagickdraw-setfillpatternurl.php
	 * @param string $fill_url <p>
	 * URL to use to obtain fill pattern.
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function setfillpatternurl ($fill_url) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the fill rule to use while drawing polygons
	 * @link http://php.net/manual/en/function.imagickdraw-setfillrule.php
	 * @param int $fill_rule <p>
	 * FILLRULE_ constant
	 * </p>
	 * @return bool
	 */
	public function setfillrule ($fill_rule) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the text placement gravity
	 * @link http://php.net/manual/en/function.imagickdraw-setgravity.php
	 * @param int $gravity <p>
	 * GRAVITY_ constant
	 * </p>
	 * @return bool
	 */
	public function setgravity ($gravity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the pattern used for stroking object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokepatternurl.php
	 * @param string $stroke_url <p>
	 * stroke URL
	 * </p>
	 * @return bool imagick.imagickdraw.return.success;
	 */
	public function setstrokepatternurl ($stroke_url) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the offset into the dash pattern to start the dash
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokedashoffset.php
	 * @param float $dash_offset <p>
	 * dash offset
	 * </p>
	 * @return bool
	 */
	public function setstrokedashoffset ($dash_offset) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the shape to be used at the end of open subpaths when they are stroked
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokelinecap.php
	 * @param int $linecap <p>
	 * LINECAP_ constant
	 * </p>
	 * @return bool
	 */
	public function setstrokelinecap ($linecap) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the shape to be used at the corners of paths when they are stroked
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokelinejoin.php
	 * @param int $linejoin <p>
	 * LINEJOIN_ constant
	 * </p>
	 * @return bool
	 */
	public function setstrokelinejoin ($linejoin) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the miter limit
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokemiterlimit.php
	 * @param int $miterlimit <p>
	 * the miter limit
	 * </p>
	 * @return bool
	 */
	public function setstrokemiterlimit ($miterlimit) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the opacity of stroked object outlines
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokeopacity.php
	 * @param float $stroke_opacity <p>
	 * stroke opacity. 1.0 is fully opaque
	 * </p>
	 * @return bool
	 */
	public function setstrokeopacity ($stroke_opacity) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the vector graphics
	 * @link http://php.net/manual/en/function.imagickdraw-setvectorgraphics.php
	 * @param string $xml <p>
	 * xml containing the vector graphics
	 * </p>
	 * @return bool true on success or false on failure.
	 */
	public function setvectorgraphics ($xml) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Destroys the current ImagickDraw in the stack, and returns to the previously pushed ImagickDraw
	 * @link http://php.net/manual/en/function.imagickdraw-pop.php
	 * @return bool true on success and false on failure.
	 */
	public function pop () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clones the current ImagickDraw and pushes it to the stack
	 * @link http://php.net/manual/en/function.imagickdraw-push.php
	 * @return bool true on success or false on failure.
	 */
	public function push () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Specifies the pattern of dashes and gaps used to stroke paths
	 * @link http://php.net/manual/en/function.imagickdraw-setstrokedasharray.php
	 * @param array $dashArray <p>
	 * array of floats
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setstrokedasharray (array $dashArray) {}

}

/**
 * @link http://php.net/manual/en/class.imagickpixeliterator.php
 */
class ImagickPixelIterator implements Iterator, Traversable {

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * The ImagickPixelIterator constructor
	 * @link http://php.net/manual/en/function.imagickpixeliterator-construct.php
	 * @param Imagick $wand
	 */
	public function __construct (Imagick $wand) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a new pixel iterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-newpixeliterator.php
	 * @param Imagick $wand
	 * @return bool &imagick.return.success; Throwing ImagickPixelIteratorException.
	 */
	public function newpixeliterator (Imagick $wand) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns a new pixel iterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-newpixelregioniterator.php
	 * @param Imagick $wand
	 * @param int $x
	 * @param int $y
	 * @param int $columns
	 * @param int $rows
	 * @return bool a new ImagickPixelIterator on success; on failure, throws
	 * ImagickPixelIteratorException.
	 */
	public function newpixelregioniterator (Imagick $wand, $x, $y, $columns, $rows) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the current pixel iterator row
	 * @link http://php.net/manual/en/function.imagickpixeliterator-getiteratorrow.php
	 * @return int the integer offset of the row, throwing
	 * ImagickPixelIteratorException on error.
	 */
	public function getiteratorrow () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Set the pixel iterator row
	 * @link http://php.net/manual/en/function.imagickpixeliterator-setiteratorrow.php
	 * @param int $row
	 * @return bool &imagick.return.success;
	 */
	public function setiteratorrow ($row) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the pixel iterator to the first pixel row
	 * @link http://php.net/manual/en/function.imagickpixeliterator-setiteratorfirstrow.php
	 * @return bool &imagick.return.success;
	 */
	public function setiteratorfirstrow () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the pixel iterator to the last pixel row
	 * @link http://php.net/manual/en/function.imagickpixeliterator-setiteratorlastrow.php
	 * @return bool &imagick.return.success;
	 */
	public function setiteratorlastrow () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the previous row
	 * @link http://php.net/manual/en/function.imagickpixeliterator-getpreviousiteratorrow.php
	 * @return array the previous row as an array of ImagickPixelWand objects from the
	 * ImagickPixelIterator, throwing ImagickPixelIteratorException on error.
	 */
	public function getpreviousiteratorrow () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the current row of ImagickPixel objects
	 * @link http://php.net/manual/en/function.imagickpixeliterator-getcurrentiteratorrow.php
	 * @return array a row as an array of ImagickPixel objects that can themselves be iterated.
	 */
	public function getcurrentiteratorrow () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the next row of the pixel iterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-getnextiteratorrow.php
	 * @return array the next row as an array of ImagickPixel objects, throwing
	 * ImagickPixelIteratorException on error.
	 */
	public function getnextiteratorrow () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Resets the pixel iterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-resetiterator.php
	 * @return bool &imagick.return.success;
	 */
	public function resetiterator () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Syncs the pixel iterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-synciterator.php
	 * @return bool &imagick.return.success;
	 */
	public function synciterator () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Deallocates resources associated with a PixelIterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-destroy.php
	 * @return bool &imagick.return.success;
	 */
	public function destroy () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clear resources associated with a PixelIterator
	 * @link http://php.net/manual/en/function.imagickpixeliterator-clear.php
	 * @return bool &imagick.return.success;
	 */
	public function clear () {}

	public function key () {}

	public function next () {}

	public function rewind () {}

	public function current () {}

	public function valid () {}

}

/**
 * @link http://php.net/manual/en/class.imagickpixel.php
 */
class ImagickPixel  {

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the normalized HSL color of the ImagickPixel object
	 * @link http://php.net/manual/en/function.imagickpixel-gethsl.php
	 * @return array the HSL value in an array with the keys "hue",
	 * "saturation", and "luminosity". Throws ImagickPixelException on failure.
	 */
	public function gethsl () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the normalized HSL color
	 * @link http://php.net/manual/en/function.imagickpixel-sethsl.php
	 * @param float $hue <p>
	 * The normalized value for hue, described as a fractional arc
	 * (between 0 and 1) of the hue circle, where the zero value is
	 * red.
	 * </p>
	 * @param float $saturation <p>
	 * The normalized value for saturation, with 1 as full saturation.
	 * </p>
	 * @param float $luminosity <p>
	 * The normalized value for luminosity, on a scale from black at
	 * 0 to white at 1, with the full HS value at 0.5 luminosity.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function sethsl ($hue, $saturation, $luminosity) {}

	public function getcolorvaluequantum () {}

	/**
	 * @param $color_value
	 */
	public function setcolorvaluequantum ($color_value) {}

	public function getindex () {}

	/**
	 * @param $index
	 */
	public function setindex ($index) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * The ImagickPixel constructor
	 * @link http://php.net/manual/en/function.imagickpixel-construct.php
	 * @param string $color [optional] <p>
	 * The optional color string to use as the initial value of this object.
	 * </p>
	 */
	public function __construct ($color = null) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the color
	 * @link http://php.net/manual/en/function.imagickpixel-setcolor.php
	 * @param string $color <p>
	 * The color definition to use in order to initialise the
	 * ImagickPixel object.
	 * </p>
	 * @return bool true if the specified color was set, false otherwise.
	 */
	public function setcolor ($color) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Sets the normalized value of one of the channels
	 * @link http://php.net/manual/en/function.imagickpixel-setcolorvalue.php
	 * @param int $color <p>
	 * One of the Imagick channel color constants.
	 * </p>
	 * @param float $value <p>
	 * The value to set this channel to, ranging from 0 to 1.
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function setcolorvalue ($color, $value) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Gets the normalized value of the provided color channel
	 * @link http://php.net/manual/en/function.imagickpixel-getcolorvalue.php
	 * @param int $color <p>
	 * The channel to check, specified as one of the Imagick channel constants.
	 * </p>
	 * @return float The value of the channel, as a normalized floating-point number, throwing
	 * ImagickPixelException on error.
	 */
	public function getcolorvalue ($color) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Clears resources associated with this object
	 * @link http://php.net/manual/en/function.imagickpixel-clear.php
	 * @return bool &imagick.return.success;
	 */
	public function clear () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Deallocates resources associated with this object
	 * @link http://php.net/manual/en/function.imagickpixel-destroy.php
	 * @return bool &imagick.return.success;
	 */
	public function destroy () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Check the distance between this color and another
	 * @link http://php.net/manual/en/function.imagickpixel-issimilar.php
	 * @param ImagickPixel $color <p>
	 * The ImagickPixel object to compare this object against.
	 * </p>
	 * @param float $fuzz <p>
	 * The maximum distance within which to consider these colors as similar.
	 * The theoretical maximum for this value is the square root of three
	 * (1.732).
	 * </p>
	 * @return bool &imagick.return.success;
	 */
	public function issimilar (ImagickPixel $color, $fuzz) {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the color
	 * @link http://php.net/manual/en/function.imagickpixel-getcolor.php
	 * @param bool $normalized [optional] <p>
	 * Normalize the color values
	 * </p>
	 * @return array An array of channel values, each normalized if true is given as param. Throws
	 * ImagickPixelException on error.
	 */
	public function getcolor ($normalized = false) {}

	/**
	 * (PECL imagick 2.1.0)<br/>
	 * Returns the color as a string
	 * @link http://php.net/manual/en/function.imagickpixel-getcolorasstring.php
	 * @return string the color of the ImagickPixel object as a string.
	 */
	public function getcolorasstring () {}

	/**
	 * (PECL imagick 2.0.0)<br/>
	 * Returns the color count associated with this color
	 * @link http://php.net/manual/en/function.imagickpixel-getcolorcount.php
	 * @return int the color count as an integer on success, throws
	 * ImagickPixelException on failure.
	 */
	public function getcolorcount () {}

	/**
	 * @param $colorCount
	 */
	public function setcolorcount ($colorCount) {}

}
// End of imagick v.3.0.1
?>
