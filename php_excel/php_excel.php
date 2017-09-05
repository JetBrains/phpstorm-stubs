<?php

// Start of php_excel v.1.0.2

/*
  +---------------------------------------------------------------------------+
  | ExcelBook                                                                 |
  |                                                                           |
  | Reference file for NuSphere PHPEd (and possibly other IDE's) for use with |
  | php_excel interface to libxl by Ilia Alshanetsky <ilia@ilia.ws>           |
  |                                                                           |
  | php_excel "PECL" style module (http://github.com/iliaal/php_excel)        |
  | libxl library (http://www.libxl.com)                                      |
  |                                                                           |
  | Rob Gagnon <rgagnon24@gmail.com>                                          |
  +---------------------------------------------------------------------------+
*/
/**
 * @since 1.0.2
 * @link http://github.com/iliaal/php_excel
 *
 */
class ExcelBook {
	const PICTURETYPE_DIB = 3;
	const PICTURETYPE_EMF = 4;
	const PICTURETYPE_JPEG = 1;
	const PICTURETYPE_PICT = 5;
	const PICTURETYPE_PNG = 0;
	const PICTURETYPE_TIFF = 6;
	const PICTURETYPE_WMF = 2;

	const SCOPE_UNDEFINED = -2;
	const SCOPE_WORKBOOK = -1;

	const SHEETTYPE_CHART = 1;
	const SHEETTYPE_SHEET = 0;
	const SHEETTYPE_UNKNOWN = 2;

	/**
	* Create a new Excel workbook
	*
	* @param string $license_name (optional, default=null)
	* @param string $license_key (optional, default=null)
	* @param bool $excel_2007 (optional, default=false)
	* @return ExcelBook
	*/
	public function __construct($license_name = null, $license_key = null, $excel_2007 = false) {}

	/**
	* Get or set the active Excel worksheet number
	*
	* @see ExcelBook::getActiveSheet()
	* @see ExcelBook::setActiveSheet()
	* @param int $sheet_number (optional, default=null) If supplied, the 0-based worksheet number to set as active
	* @return int 0-based active worksheet number
	*/
	public function activeSheet($sheet_number = null) {}

	/**
	* Create a custom cell format
	*
	* @see ExcelBook::getCustomFormat()
	* @param string $format_string
	* @return int The ID assigned to the new format
	*/
	public function addCustomFormat($format_string) {}

	/**
	* Add or copy an ExcelFont object
	*
	* @param ExcelFont $font (optional, default=null) Font to copy
	* @return ExcelFont
	*/
	public function addFont($font = null) {}

	/**
	* Add or copy an ExcelFormat object
	*
	* @param ExcelFormat $format (optional, default=null) Format to copy
	* @return ExcelFormat
	*/
	public function addFormat(ExcelFormat $format = null) {}

	/**
	* Add a picture from file
	*
	* @see ExcelBook::addPictureFromString()
	* @see ExcelSheet::addPictureScaled()
	* @see ExcelSheet::addPictureDim()
	* @param string $filename
	* @return int A picture ID
	*/
	public function addPictureFromFile($filename) {}

	/**
	* Add a picture from string
	*
	* @see ExcelBook::addPictureFromFile()
	* @see ExcelSheet::addPictureScaled()
	* @see ExcelSheet::addPictureDim()
	* @param string $data
	* @return int A picture ID
	*/
	public function addPictureFromString($data) {}

	/**
	* Add a worksheet to a workbook
	*
	* @param string $name The name for the new worksheet
	* @return ExcelSheet The worksheet created
	*/
	public function addSheet($name) {}

	/**
	* Returns BIFF version of binary file. Used for xls format only.
	*
	* @return int BIFF version
	*/
	public function biffVersion() {}

	/**
	* Packs red, green, and blue components in color value.  Used for xlsx format only.
	*
	* @see ExcelBook::colorUnpack()
	* @param int $red
	* @param int $green
	* @param int $blue
	* @return int
	*/
	public function colorPack($red, $green, $blue) {}

	/**
	* Unpacks color value into red, green, and blue components.  Used for xlsx format only.
	*
	* @see ExcelBook::colorPack()
	* @param int $color One of ExcelFormat::COLOR_* constants
	* @return array with keys "red"(int), "green"(int), and "blue"(int)
	*/
	public function colorUnpack($color) {}

	/**
	* Create a copy of a worksheet in a workbook
	*
	* @param string $name The name for the new worksheet
	* @param int $sheet_number The 0-based number of the source worksheet to copy
	* @return ExcelSheet The worksheet created
	*/
	public function copySheet($name, $sheet_number) {}

	/**
	* Delete an Excel worksheet
	*
	* @param int $sheet_number 0-based worksheet number to delete
	* @return bool True if sheet deleted, false if $sheet_number invalid
	*/
	public function deleteSheet($sheet_number) {}

	/**
	* Get the active worksheet inside a workbook
	*
	* @see ExcelBook::activeSheet()
	* @see ExcelBook::setActiveSheet()
	* @return int 0-based active worksheet number
	*/
	public function getActiveSheet() {}

	/**
	* Get an array of all ExcelFormat objects used inside a workbook
	*
	* @return array of ExcelFormat objects
	*/
	public function getAllFormats() {}

	/**
	* Get a custom cell format
	*
	* @see ExcelBook::addCustomFormat()
	* @param int $id
	* @return string
	*/
	public function getCustomFormat($id) {}

	/**
	* Get the default font
	*
	* @see ExcelBook::setDefaultFont()
	* @return array with keys "font"(string) and "font_size"(int)
	*/
	public function getDefaultFont() {}

	/**
	* Get Excel error string
	*
	* @return string Description of last error that occurred, or false if no error
	*/
	public function getError() {}

	/**
	* Returns a number of pictures in this workbook.
	*
	* @return int Number of pictures in Workbook
	*/
	public function getNumPictures() {}

	/**
	* Returns a picture at position index.
	*
	* @param int $index
	* @return array with keys "data"(string) and "type"(int)
	*/
	public function getPicture($index) {}

	/**
	* Returns whether the R1C1 reference mode is active.
	*
	* @return bool
	*/
	public function getRefR1C1() {}

	/**
	* Get an Excel worksheet
	*
	* @param int $sheet_number (optional, default=0) 0-based worksheet number
	* @return ExcelSheet or false if $sheet_number invalid
	*/
	public function getSheet($sheet_number = 0) {}

	/**
	* Get an excel sheet by name.
	*
	* @param string $name
	* @param bool $case_insensitive (optional, default=false)
	* @return ExcelSheet
	*/
	public function getSheetByName($name, $case_insensitive = false) {}

	/**
	* Inserts a new sheet to this book at position index, returns the sheet handle. Set initSheet
	* to 0 if you wish to add a new empty sheet or use existing sheet's handle for copying.
	*
	* @param int $index
	* @param string $name
	* @param ExcelSheet $sheet (optional)
	* @return ExcelSheet
	*/
	public function insertSheet($index, $name, $sheet = null) {}

	/**
	* Returns whether the 1904 date system is active:
	* true - 1904 date system,
	* false - 1900 date system
	*
	* @return bool
	*/
	public function isDate1904() {}

	/**
	* Returns whether the workbook is a template.
	*
	* @return bool
	*/
	public function isTemplate() {}

	/**
	* Load Excel data string
	*
	* @param string $data
	* @return bool
	*/
	public function load($data) {}

	/**
	* Load Excel from file
	*
	* @param string $filename
	* @return bool
	*/
	public function loadFile($filename) {}

	/**
	* Pack a unix timestamp into an Excel double
	*
	* @see ExcelBook::unpackDate()
	* @param int $timestamp
	* @return float
	*/
	public function packDate($timestamp) {}

	/**
	* Pack a date from single values into an Excel double
	*
	* with year=0, month=0 and day=0 you can generate a time-only value
	* - if you click on a cell with time-format, in the "formula bar" will appear a time only (without date)
	*
	* @param int $year
	* @param int $month
	* @param int $day
	* @param int $hour
	* @param int $minute
	* @param int $second
	* @return float
	*/
	public function packDateValues($year, $month, $day, $hour, $minute, $second) {}

	/**
	* Returns whether RGB mode is active
	*
	* @see ExcelBook::setRGBMode()
	* @return bool
	*/
	public function rgbMode() {}

	/**
	* Save Excel file
	*
	* @param string $filename (optional, default=null)
	* @return mixed If $filename is null, returns string, otherwise returns bool true if OK, false if not
	*/
	public function save($filename = null) {}

	/**
	* Set the active worksheet
	*
	* @see ExcelBook::getActiveSheet()
	* @see ExcelBook::activeSheet()
	* @param int $sheet_number 0-based worksheet to make active
	* @return bool
	*/
	public function setActiveSheet($sheet_number) {}

	/**
	* Sets the date system mode:
	* true - 1904 date system,
	* false - 1900 date system (default)
	*
	* @param bool $date_type
	* @return bool
	*/
	public function setDate1904($date_type) {}

	/**
	* Set the default font and size
	*
	* @see ExcelBook::getDefaultFont()
	* @param string $font_name
	* @param string $font_size
	* @return void
	*/
	public function setDefaultFont($font_name, $font_size) {}

	/**
	* Set the locale<br>
	* possible values: '.1252' (Windows-1252 or Cp1252), '.OCP' (OEM CodePage), default: '.ACP' (ANSI CodePage) if empty
	*
	* @param string $locale
	* @return void
	*/
	public function setLocale($locale) {}

	/**
	* Sets the R1C1 reference mode.
	*
	* @param bool $active
	* @return void
	*/
	public function setRefR1C1($active) {}

	/**
	* Sets RGB mode on or off
	*
	* @see ExcelBook::rgbMode()
	* @param bool $mode
	* @return void
	*/
	public function setRGBMode($mode) {}

	/**
	* Sets the template flag, if the workbook is template.
	*
	* @param bool $mode
	* @return void
	*/
	public function setTemplate($mode) {}

	/**
	* Get the number of worksheets inside a workbook
	*
	* @return int
	*/
	public function sheetCount() {}

	/**
	* Returns type of sheet with specified index:
	* 0 - sheet
	* 1 - chart
	* 2 - unknown
	*
	* @param int $sheet
	* @return int
	*/
	public function sheetType($sheet) {}

	/**
	* Unpack an Excel double into a unix timestamp
	*
	* @see ExcelBook::packDate()
	* @param float $date
	* @return int
	*/
	public function unpackDate($date) {}
}

class ExcelFont {
    const NORMAL = 0;
    const SUPERSCRIPT = 1;
    const SUBSCRIPT = 2;

    const UNDERLINE_NONE = 0;
    const UNDERLINE_SINGLE = 1;
    const UNDERLINE_DOUBLE = 2;
    const UNDERLINE_SINGLEACC = 33;
    const UNDERLINE_DOUBLEACC = 34;

    /**
     * Create a font within an Excel workbook
     *
     * @see ExcelBook::addFont()
     * @param ExcelBook $book
     * @return ExcelFont
     */
    public function __construct($book) {}

    /**
     * Get, or set if bold is on or off
     *
     * @param bool $bold (optional, default=null)
     * @return bool
     */
    public function bold($bold = null) {}

    /**
     * Get, or set the font color
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function color($color = null) {}

    /**
     * Get, or set if italics are on or off
     *
     * @param bool $italics (optional, default=null)
     * @return bool
     */
    public function italics($italics = null) {}

    /**
     * Get, or set the font script mode
     *
     * @param int $mode (optional, default=null) One of ExcelFont::NORMAL, ::SUBSCRIPT, or ::SUPERSCRIPT
     * @return int
     */
    public function mode($mode = null) {}

    /**
     * Get, or set the font name
     *
     * @param string $font_name (optional, default=null)
     * @return string
     */
    public function name($font_name = null) {}

    /**
     * Get, or set the font size
     *
     * @param int $size (optional, default=null)
     * @return int The current font size
     */
    public function size($size = null) {}

    /**
     * Get, or set if strike-through is on or off
     *
     * @param bool $strike (optional, default=null)
     * @return bool
     */
    public function strike($strike = null) {}

    /**
     * Get, or set the underline style
     *
     * @param int $underline (optional, default=null) One of ExcelFont::UNDERLINE_* constants
     * @return int
     */
    public function underline($underline = null) {}
}

class ExcelFormat {
    const COLOR_BLACK = 8;
    const COLOR_WHITE = 9;
    const COLOR_RED = 10;
    const COLOR_BRIGHTGREEN = 11;
    const COLOR_BLUE = 12;
    const COLOR_YELLOW = 13;
    const COLOR_PINK = 14;
    const COLOR_TURQUOISE = 15;
    const COLOR_DARKRED = 16;
    const COLOR_GREEN = 17;
    const COLOR_DARKBLUE = 18;
    const COLOR_DARKYELLOW = 19;
    const COLOR_VIOLET = 20;
    const COLOR_TEAL = 21;
    const COLOR_GRAY25 = 22;
    const COLOR_GRAY50 = 23;
    const COLOR_PERIWINKLE_CF = 24;
    const COLOR_PLUM_CF = 25;
    const COLOR_IVORY_CF = 26;
    const COLOR_LIGHTTURQUOISE_CF = 27;
    const COLOR_DARKPURPLE_CF = 28;
    const COLOR_CORAL_CF = 29;
    const COLOR_OCEANBLUE_CF = 30;
    const COLOR_ICEBLUE_CF = 31;
    const COLOR_DARKBLUE_CL = 32;
    const COLOR_PINK_CL = 33;
    const COLOR_YELLOW_CL = 34;
    const COLOR_TURQUOISE_CL = 35;
    const COLOR_VIOLET_CL = 36;
    const COLOR_DARKRED_CL = 37;
    const COLOR_TEAL_CL = 38;
    const COLOR_BLUE_CL = 39;
    const COLOR_SKYBLUE = 40;
    const COLOR_LIGHTTURQUOISE = 41;
    const COLOR_LIGHTGREEN = 42;
    const COLOR_LIGHTYELLOW = 43;
    const COLOR_PALEBLUE = 44;
    const COLOR_ROSE = 45;
    const COLOR_LAVENDER = 46;
    const COLOR_TAN = 47;
    const COLOR_LIGHTBLUE = 48;
    const COLOR_AQUA = 49;
    const COLOR_LIME = 50;
    const COLOR_GOLD = 51;
    const COLOR_LIGHTORANGE = 52;
    const COLOR_ORANGE = 53;
    const COLOR_BLUEGRAY = 54;
    const COLOR_GRAY40 = 55;
    const COLOR_DARKTEAL = 56;
    const COLOR_SEAGREEN = 57;
    const COLOR_DARKGREEN = 58;
    const COLOR_OLIVEGREEN = 59;
    const COLOR_BROWN = 60;
    const COLOR_PLUM = 61;
    const COLOR_INDIGO = 62;
    const COLOR_GRAY80 = 63;
    const COLOR_DEFAULT_FOREGROUND = 64;
    const COLOR_DEFAULT_BACKGROUND = 65;

    const AS_DATE = 1;
    const AS_FORMULA = 2;
    const AS_NUMERIC_STRING = 3;

    const NUMFORMAT_GENERAL = 0;
    const NUMFORMAT_NUMBER = 1;
    const NUMFORMAT_NUMBER_D2 = 2;
    const NUMFORMAT_NUMBER_SEP = 3;
    const NUMFORMAT_NUMBER_SEP_D2 = 4;
    const NUMFORMAT_CURRENCY_NEGBRA = 5;
    const NUMFORMAT_CURRENCY_NEGBRARED = 6;
    const NUMFORMAT_CURRENCY_D2_NEGBRA = 7;
    const NUMFORMAT_CURRENCY_D2_NEGBRARED = 8;
    const NUMFORMAT_PERCENT = 9;
    const NUMFORMAT_PERCENT_D2 = 10;
    const NUMFORMAT_SCIENTIFIC_D2 = 11;
    const NUMFORMAT_FRACTION_ONEDIG = 12;
    const NUMFORMAT_FRACTION_TWODIG = 13;
    const NUMFORMAT_DATE = 14;
    const NUMFORMAT_CUSTOM_D_MON_YY = 15;
    const NUMFORMAT_CUSTOM_D_MON = 16;
    const NUMFORMAT_CUSTOM_MON_YY = 17;
    const NUMFORMAT_CUSTOM_HMM_AM = 18;
    const NUMFORMAT_CUSTOM_HMMSS_AM = 19;
    const NUMFORMAT_CUSTOM_HMM = 20;
    const NUMFORMAT_CUSTOM_HMMSS = 21;
    const NUMFORMAT_CUSTOM_MDYYYY_HMM = 22;
    const NUMFORMAT_NUMBER_SEP_NEGBRA = 37;
    const NUMFORMAT_NUMBER_SEP_NEGBRARED = 38;
    const NUMFORMAT_NUMBER_D2_SEP_NEGBRA = 39;
    const NUMFORMAT_NUMBER_D2_SEP_NEGBRARED = 40;
    const NUMFORMAT_ACCOUNT = 41;
    const NUMFORMAT_ACCOUNTCUR = 42;
    const NUMFORMAT_ACCOUNT_D2 = 43;
    const NUMFORMAT_ACCOUNT_D2_CUR = 44;
    const NUMFORMAT_CUSTOM_MMSS = 45;
    const NUMFORMAT_CUSTOM_H0MMSS = 46;
    const NUMFORMAT_CUSTOM_MMSS0 = 47;
    const NUMFORMAT_CUSTOM_000P0E_PLUS0 = 48;
    const NUMFORMAT_TEXT = 49;

    const ALIGNH_GENERAL = 0;
    const ALIGNH_LEFT = 1;
    const ALIGNH_CENTER = 2;
    const ALIGNH_RIGHT = 3;
    const ALIGNH_FILL = 4;
    const ALIGNH_JUSTIFY = 5;
    const ALIGNH_MERGE = 6;
    const ALIGNH_DISTRIBUTED = 7;

    const ALIGNV_TOP = 0;
    const ALIGNV_CENTER = 1;
    const ALIGNV_BOTTOM = 2;
    const ALIGNV_JUSTIFY = 3;
    const ALIGNV_DISTRIBUTED = 4;

    const BORDERSTYLE_NONE = 0;
    const BORDERSTYLE_THIN = 1;
    const BORDERSTYLE_MEDIUM = 2;
    const BORDERSTYLE_DASHED = 3;
    const BORDERSTYLE_DOTTED = 4;
    const BORDERSTYLE_THICK = 5;
    const BORDERSTYLE_DOUBLE = 6;
    const BORDERSTYLE_HAIR = 7;
    const BORDERSTYLE_MEDIUMDASHED = 8;
    const BORDERSTYLE_DASHDOT = 9;
    const BORDERSTYLE_MEDIUMDASHDOT = 10;
    const BORDERSTYLE_DASHDOTDOT = 11;
    const BORDERSTYLE_MEDIUMDASHDOTDOT = 12;
    const BORDERSTYLE_SLANTDASHDOT = 13;

    const BORDERDIAGONAL_NONE = 0;
    const BORDERDIAGONAL_DOWN = 1;
    const BORDERDIAGONAL_UP = 2;
    const BORDERDIAGONAL_BOTH = 3;

    const FILLPATTERN_NONE = 0;
    const FILLPATTERN_SOLID = 1;
    const FILLPATTERN_GRAY50 = 2;
    const FILLPATTERN_GRAY75 = 3;
    const FILLPATTERN_GRAY25 = 4;
    const FILLPATTERN_HORSTRIPE = 5;
    const FILLPATTERN_VERSTRIPE = 6;
    const FILLPATTERN_REVDIAGSTRIPE = 7;
    const FILLPATTERN_DIAGSTRIPE = 8;
    const FILLPATTERN_DIAGCROSSHATCH = 9;
    const FILLPATTERN_THICKDIAGCROSSHATCH = 10;
    const FILLPATTERN_THINHORSTRIPE = 11;
    const FILLPATTERN_THINVERSTRIPE = 12;
    const FILLPATTERN_THINREVDIAGSTRIPE = 13;
    const FILLPATTERN_THINDIAGSTRIPE = 14;
    const FILLPATTERN_THINHORCROSSHATCH = 15;
    const FILLPATTERN_THINDIAGCROSSHATCH = 16;
    const FILLPATTERN_GRAY12P5 = 17;
    const FILLPATTERN_GRAY6P25 = 18;
    /**
     * Create a format within an Excel workbook
     *
     * @see ExcelBook::addFormat()
     * @param ExcelBook $book
     * @return ExcelFormat
     */
    public function __construct(ExcelBook $book) {}

    /**
     * Get, or set the color of the bottom border of a cell
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function borderBottomColor($color = null) {}

    /**
     * Get, or set the border style for the bottom of a cell
     *
     * @param int $style (optional, default=null) One of ExcelFormat::BORDERSTYLE_* constants
     * @return int
     */
    public function borderBottomStyle($style = null) {}

    /**
     * Set the border color on all sides of a cell
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int The color, or true if no value supplied for $color
     */
    public function borderColor($color = null) {}

    /**
     * Get, or set the color of the diagonal of a cell
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function borderDiagonalColor($color = null) {}

    /**
     * Get, or set the border for the diagonal of a cell
     *
     * @param int $style (optional, default=null) One of ExcelFormat::BORDERDIAGONAL_* constants
     * @return int
     */
    public function borderDiagonalStyle($style = null) {}

    /**
     * Get, or set the color of the left side border of a cell
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function borderLeftColor($color = null) {}

    /**
     * Get, or set the border style for the left side of a cell
     *
     * @param int $style (optional, default=null) One of ExcelFormat::BORDERSTYLE_* constants
     * @return int
     */
    public function borderLeftStyle($style = null) {}

    /**
     * Get, or set the color of the right side border of a cell
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function borderRightColor($color = null) {}

    /**
     * Get, or set the border style for the right side of a cell
     *
     * @param int $style (optional, default=null) One of ExcelFormat::BORDERSTYLE_* constants
     * @return int
     */
    public function borderRightStyle($style = null) {}

    /**
     * Set the cell border style on all sides of a cell
     *
     * @param int $style (optional, default=null) One of ExcelFormat::BORDERSTYLE_* constants
     * @return int The border style, or true if no value supplied for $style
     */
    public function borderStyle($style = null) {}

    /**
     * Get, or set the color of the top border of a cell
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function borderTopColor($color = null) {}

    /**
     * Get, or set the border style for the top of a cell
     *
     * @param int $style (optional, default=null) One of ExcelFormat::BORDERSTYLE_* constants
     * @return int
     */
    public function borderTopStyle($style = null) {}

    /**
     * Get, or set the cell fill pattern
     *
     * @param int $pattern (optional, default=null) One of ExcelFormat::FILLPATTERN_* constants
     * @return int
     */
    public function fillPattern($pattern = null) {}

    /**
     * Get the font for this format
     *
     * @see ExcelFormat::setFont()
     * @return ExcelFont
     */
    public function getFont() {}

    /**
     * Get, or set whether the cell is hidden
     *
     * @param bool $hidden (optional, default=null)
     * @return bool
     */
    public function hidden($hidden = null) {}

    /**
     * Get, or set the cell horizontal alignment
     *
     * @see ExcelFormat::verticalAlign()
     * @param int $halign_mode (optional, default=null) One of ExcelFormat::ALIGNH_* constants
     * @return int
     */
    public function horizontalAlign($halign_mode = null) {}

    /**
     * Get, or set the cell text indentation level
     *
     * @param int $indent (optional, default=null) A number from 0-15
     * @return int
     */
    public function indent($indent = null) {}

    /**
     * Get, or set whether a cell is locked
     *
     * @param bool $locked (optional, default=null)
     * @return bool
     */
    public function locked($locked) {}

    /**
     * Get, or set the cell number format
     *
     * @param int $number_format Number format identifier.  One of ExcelFormat::NUMFORMAT_* constants
     * @return int
     */
    public function numberFormat($number_format = null) {}

    /**
     * Get, or set the pattern background color
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function patternBackgroundColor($color = null) {}

    /**
     * Get, or set the pattern foreground color
     *
     * @param int $color (optional, default=null) One of ExcelFormat::COLOR_* constants
     * @return int
     */
    public function patternForegroundColor($color = null) {}

    /**
     * Get, or set the cell data rotation
     *
     * @param int $angle (optional, default=null) 0 to 90 (rotate left 0-90 degrees), 91 to 180 (rotate right 1-90 degrees), or 255 for vertical text
     * @return int The angle of rotation, or false if setting an invalid value
     */
    public function rotate($angle = null) {}

    /**
     * Set the font for this format
     *
     * @see ExcelFormat::getFont()
     * @param ExcelFont $font
     * @return bool
     */
    public function setFont($font) {}

    /**
     * Get, or set whether the cell is shrink-to-fit
     *
     * @param bool $shrink (optional, default=null)
     * @return bool
     */
    public function shrinkToFit($shrink = null) {}

    /**
     * Get, or set the cell vertical alignment
     *
     * @see ExcelFormat::horizontalAlign()
     * @param int $valign_mode (optional, default=null) One of ExcelFormat::ALIGNV_* constants
     * @return int
     */
    public function verticalAlign($valign_mode = null) {}

    /**
     * Get, or set the cell text wrapping
     *
     * @param bool $wrap (optional, default=null)
     * @return bool
     */
    public function wrap($wrap = null) {}
}

class ExcelSheet {
    const PAPER_DEFAULT = 0;
    const PAPER_LETTER = 1;
    const PAPER_LETTERSMALL = 2;
    const PAPER_TABLOID = 3;
    const PAPER_LEDGER = 4;
    const PAPER_LEGAL = 5;
    const PAPER_STATEMENT = 6;
    const PAPER_EXECUTIVE = 7;
    const PAPER_A3 = 8;
    const PAPER_A4 = 9;
    const PAPER_A4SMALL = 10;
    const PAPER_A5 = 11;
    const PAPER_B4 = 12;
    const PAPER_B5 = 13;
    const PAPER_FOLIO = 14;
    const PAPER_QUATRO = 15;
    const PAPER_10x14 = 16;
    const PAPER_10x17 = 17;
    const PAPER_NOTE = 18;
    const PAPER_ENVELOPE_9 = 19;
    const PAPER_ENVELOPE_10 = 20;
    const PAPER_ENVELOPE_11 = 21;
    const PAPER_ENVELOPE_12 = 22;
    const PAPER_ENVELOPE_14 = 23;
    const PAPER_C_SIZE = 24;
    const PAPER_D_SIZE = 25;
    const PAPER_E_SIZE = 26;
    const PAPER_ENVELOPE_DL = 27;
    const PAPER_ENVELOPE_C5 = 28;
    const PAPER_ENVELOPE_C3 = 29;
    const PAPER_ENVELOPE_C4 = 30;
    const PAPER_ENVELOPE_C6 = 31;
    const PAPER_ENVELOPE_C65 = 32;
    const PAPER_ENVELOPE_B4 = 33;
    const PAPER_ENVELOPE_B5 = 34;
    const PAPER_ENVELOPE_B6 = 35;
    const PAPER_ENVELOPE = 36;
    const PAPER_ENVELOPE_MONARCH = 37;
    const PAPER_US_ENVELOPE = 38;
    const PAPER_FANFOLD = 39;
    const PAPER_GERMAN_STD_FANFOLD = 40;
    const PAPER_GERMAN_LEGAL_FANFOLD = 41;

    const CELLTYPE_EMPTY = 0;
    const CELLTYPE_NUMBER = 1;
    const CELLTYPE_STRING = 2;
    const CELLTYPE_BOOLEAN = 3;
    const CELLTYPE_BLANK = 4;
    const CELLTYPE_ERROR = 5;

    const ERRORTYPE_NULL = 0;
    const ERRORTYPE_DIV_0 = 7;
    const ERRORTYPE_VALUE = 15;
    const ERRORTYPE_REF = 23;
    const ERRORTYPE_NAME = 29;
    const ERRORTYPE_NUM = 36;
    const ERRORTYPE_NA = 42;

    const LEFT_TO_RIGHT = 0;
    const RIGHT_TO_LEFT = 1;

    /**
     * Create an ExcelSheet in given Workbook
     *
     * @param ExcelBook $book
     * @param string $name The name for the new worksheet
     * @return ExcelSheet The worksheet created
     */
    public function __construct(ExcelBook $book, $name) {}

    /**
     * Adds the new hyperlink.
     *
     * @param string $hyperlink
     * @param int $row_first 0-based
     * @param int $row_last 0-based
     * @param int $col_first 0-based
     * @param int $col_last 0-based
     * @return void
     */
    public function addHyperlink($hyperlink, $row_first, $row_last, $col_first, $col_last) {}

    /**
     * Insert a picture into a cell with given dimensions
     *
     * @see ExcelBook::addPictureFromString()
     * @see ExcelBook::addPictureFromFile()
     * @see ExcelSheet::addPictureScaled()
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @param int $picture_id Value returned by ExcelBook::addPictureFrom*() methods
     * @param int $width
     * @param int $height
     * @param int $x_offset (optional, default=0)
     * @param int $y_offset (optional, default=0)
     * @return void
     */
    public function addPictureDim($row, $column, $picture_id, $width, $height, $x_offset = 0, $y_offset = 0) {}

    /**
     * Insert a picture into a cell with a set scale
     *
     * @see ExcelBook::addPictureFromString()
     * @see ExcelBook::addPictureFromFile()
     * @see ExcelSheet::addPictureDim()
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @param int $picture_id Value returned by ExcelBook::addPictureFrom*() methods
     * @param float $scale
     * @param int $x_offset (optional, default = 0)
     * @param int $y_offset (optional, default = 0)
     * @return void
     */
    public function addPictureScaled($row, $column, $picture_id, $scale, $x_offset = 0, $y_offset = 0) {}

    /**
     * Converts a cell reference to row and column.
     *
     * @param string $cell_reference
     * @return array with keys "row"(int), "column"(int), "col_relative"(bool), "row_relative"(bool)
     */
    public function addrToRowCol($cell_reference) {}

    /**
     * Get the cell format
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return ExcelFormat
     */
    public function cellFormat($row, $column) {}

    /**
     * Get the cell type
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return int One of ExcelSheet:CELLTYPE_* constants
     */
    public function cellType($row, $column) {}

    /**
     * Clear cells in the specified area
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return void
     */
    public function clear($row_start, $row_end, $column_start, $column_end) {}

    /**
     * Sets the print area.
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return bool
     */
    public function setPrintArea($row_start, $row_end, $column_start, $column_end) {}

    /**
     * Gets the print area. Returns false if print area isn't found.
     *
     * @return bool|array with keys "row_start"(int), "row_end"(int), "col_start"(int) and "col_end"(int)
     */
    public function printArea(){}

    /**
     * Clears the print area
     *
     * @return bool
     */
    public function clearPrintArea(){}

    /**
     * Clears repeated rows and columns on each page
     *
     * @see ExcelSheet::setPrintRepeatRows()
     * @see ExcelSheet::setPrintRepeatCols()
     * @return bool
     */
    public function clearPrintRepeats(){}

    /**
     * Returns whether column is hidden.
     *
     * @param int $column 0-based column number
     * @return bool
     */
    public function colHidden($column) {}

    /**
     * Returns the cell width
     *
     * @see ExcelSheet::rowHeight()
     * @see ExcelSheet::setColWidth()
     * @see ExcelSheet::setRowHeight()
     * @param int $column 0-based column number
     * @return float
     */
    public function colWidth($column) {}

    /**
     * Copy a cell from one location to another
     *
     * @param int $row_from 0-based row number
     * @param int $column_from 0-based column number
     * @param int $row_to 0-based row number
     * @param int $column_to 0-based column number
     * @return void
     */
    public function copy($row_from, $column_from, $row_to, $column_to) {}

    /**
     * Removes hyperlink by index.
     *
     * @param int $index
     * @return bool
     */
    public function delHyperlink($index) {}

    /**
     * Delete a named range
     *
     * @see ExcelSheet::setNamedRange()
     * @param string $name
     * @param int $scope_id
     * @return bool
     */
    public function delNamedRange($name, $scope_id = null) {}

    /**
     * Delete cell merge
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return bool
     */
    public function deleteMerge($row, $column) {}

    /**
     * Removes merged cells by index.
     *
     * @param int $index
     * @return bool
     */
    public function delMergeByIndex($index) {}

    /**
     * Returns whether the gridlines are displayed
     *
     * @see ExcelSheet::setDisplayGridlines()
     * @return bool
     */
    public function displayGridlines(){}

    /**
     * Returns the 0-based first column in a sheet that contains a used cell
     *
     * @see ExcelSheet::firstRow()
     * @see ExcelSheet::lastRow()
     * @see ExcelSheet::lastCol()
     * @return int
     */
    public function firstCol(){}

    /**
     * Returns the 0-based first row in a sheet that contains a used cell
     *
     * @see ExcelSheet::lastRow()
     * @see ExcelSheet::firstCol()
     * @see ExcelSheet::lastCol()
     * @return int
     */
    public function firstRow(){}

    /**
     * Returns the footer text of the sheet when printed
     *
     * @see ExcelSheet::header()
     * @see ExcelSheet::setFooter()
     * @see ExcelSheet::setHeader()
     * @return string
     */
    public function footer(){}

    /**
     * Returns the footer margin (in inches)
     *
     * @see ExcelSheet::setFooter()
     * @see ExcelSheet::headerMargin()
     * @return float
     */
    public function footerMargin(){}

    /**
     * Returns whether grouping rows summary is below, or above
     *
     * @see ExcelSheet::setGroupSummaryBelow()
     * @see ExcelSheet::getGroupSummaryRight()
     * @see ExcelSheet::setGroupSummaryRight()
     * @return bool true=below, false=above
     */
    public function getGroupSummaryBelow(){}

    /**
     * Returns whether grouping columns summary is right, or left
     *
     * @see ExcelSheet::getGroupSummaryBelow()
     * @see ExcelSheet::setGroupSummaryBelow()
     * @see ExcelSheet::setGroupSummaryRight()
     * @return bool true=right, false=left
     */
    public function getGroupSummaryRight(){}

    /**
     * Returns column with horizontal page break at position index.
     *
     * @param int $index
     * @return int
     */
    public function getHorPageBreak($index) {}

    /**
     * Returns a number of horizontal page breaks in the sheet.
     *
     * @return int
     */
    public function getHorPageBreakSize(){}

    /**
     * Gets the named range coordinates by index.
     *
     * @param int $index
     * @param int $scope_id (optional, default = null) index of sheet or -1 for Workbook
     * @return array with keys "row_first"(int), "row_last"(int), "col_first"(int), "col_last"(int), "hidden"(bool), "scope"(int)
     */
    public function getIndexRange($index, $scope_id = null) {}

    /**
     * Get cell merge range
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return array Four integers as keys "row_first", "row_last", "col_first", and "col_last"
     */
    public function getMerge($row, $column) {}

    /**
     * Gets the named range coordinates by name, returns false if range is not found.
     *
     * @param string $name
     * @param int $scope_id (optional, default=null)
     * @return array with keys "row_first"(int), "row_last"(int), "col_first"(int), "col_last"(int), "hidden"(bool)
     */
    public function getNamedRange($name, $scope_id = null) {}

    /**
     * Returns a number of pictures in this worksheet.
     *
     * @return int
     */
    public function getNumPictures(){}

    /**
     * Returns a information about a workbook picture at position index in worksheet.
     *
     * @param int $index
     * @return array with keys "picture_index"(int), "row_top"(int), "col_left"(int), "row_bottom"(int), "col_right"(int), "width"(int), "height"(int), "offset_x"(int), "offset_y"(int)
     */
    public function getPictureInfo($index) {}

    /**
     * Returns whether fit to page option is enabled, and if so to what width & height
     *
     * @return array with keys "width"(int), "height"(int)
     */
    public function getPrintFit(){}

    /**
     * Returns whether the text is displayed in right-to-left mode: 1 - yes, 0 - no.
     *
     * @return int
     */
    public function getRightToLeft(){}

    /**
     * Extracts the first visible row and the leftmost visible column of the sheet.
     *
     * @return array with keys "row"(int), "column"(int)
     */
    public function getTopLeftView(){}

    /**
     * Returns column with vertical page break at position index.
     *
     * @param int $index
     * @return int
     */
    public function getVerPageBreak($index) {}

    /**
     * Returns a number of vertical page breaks in the sheet.
     *
     * @return int
     */
    public function getVerPageBreakSize(){}

    /**
     * Group columns from $column_start to $column_end
     *
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @param bool $collapse (optional, default = false)
     * @return bool
     */
    public function groupCols($column_start, $column_end, $collapse = false) {}

    /**
     * Group rows from $row_start to $row_end
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @param bool $collapse (optional, default = false)
     * @return bool
     */
    public function groupRows($row_start, $row_end, $collapse = false) {}

    /**
     * Returns whether the sheet is centered horizontally when printed
     *
     * @see ExcelSheet::vcenter()
     * @see ExcelSheet::setHCenter()
     * @see ExcelSheet::setVCenter()
     * @return bool
     */
    public function hcenter(){}

    /**
     * Returns the header text of the sheet when printed
     *
     * @see ExcelSheet::setHeader()
     * @see ExcelSheet::footer()
     * @see ExcelSheet::setFooter()
     * @return string
     */
    public function header(){}

    /**
     * Hides/unhides the sheet
     *
     * @deprecated
     * @param bool $hide
     * @return bool
     */
    public function hidden($hide) {}

    /**
     * Gets the hyperlink and its coordinates by index.
     *
     * @param int $index
     * @return array
     */
    public function hyperlink($index) {}

    /**
     * Returns the number of hyperlinks in the sheet.
     *
     * @return int
     */
    public function hyperlinkSize(){}

    /**
     * Returns whether sheet is hidden
     *
     * @see ExcelSheet::hidden()
     * @return bool
     */
    public function isHidden(){}

    /**
     * Returns whether LibXL runs in trial or licensed mode
     *
     * @return bool
     */
    public function isLicensed(){}

    /**
     * Returns the header margin (in inches)
     *
     * @see ExcelSheet::footerMargin()
     * @see ExcelSheet::setHeader()
     * @return float
     */
    public function headerMargin(){}

    /**
     * Set/Remove horizontal page break
     *
     * @param int $row 0-based row number
     * @param bool $break
     * @return bool
     */
    public function horPageBreak($row, $break) {}

    /**
     * Insert columns from column_start to column_end
     *
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return bool
     */
    public function insertCol($column_start, $column_end) {}

    /**
     * Insert rows from row_start to row_end
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @return bool
     */
    public function insertRow($row_start, $row_end) {}

    /**
     * Determine if a cell contains a date
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return bool
     */
    public function isDate($row, $column) {}

    /**
     * Determine if a cell contains a formula
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return bool
     */
    public function isFormula($row, $column) {}

    /**
     * Returns the page orientation mode
     *
     * @see ExcelSheet::setLandscape()
     * @return bool true for landscape, false for portrait
     */
    public function landscape() {}

    /**
     * Returns the 0-based last column in a sheet that contains a used cell
     *
     * @see ExcelSheet::firstRow()
     * @see ExcelSheet::lastRow()
     * @see ExcelSheet::firstCol()
     * @return int
     */
    public function lastCol() {}

    /**
     * Returns the 0-based last row in a sheet that contains a used cell
     *
     * @see ExcelSheet::firstRow()
     * @see ExcelSheet::firstCol()
     * @see ExcelSheet::lastCol()
     * @return int
     */
    public function lastRow() {}

    /**
     * Returns the bottom margin of the sheet (in inches)
     *
     * @see ExcelSheet::marginTop()
     * @see ExcelSheet::marginRight()
     * @see ExcelSheet::marginLeft()
     * @see ExcelSheet::setMarginBottom()
     * @return float
     */
    public function marginBottom() {}

    /**
     * Returns the left margin of the sheet (in inches)
     *
     * @see ExcelSheet::marginTop()
     * @see ExcelSheet::marginRight()
     * @see ExcelSheet::marginBottom()
     * @see ExcelSheet::setMarginLeft()
     * @return float
     */
    public function marginLeft() {}

    /**
     * Returns the right margin of the sheet (in inches)
     *
     * @see ExcelSheet::marginTop()
     * @see ExcelSheet::marginLeft()
     * @see ExcelSheet::marginBottom()
     * @see ExcelSheet::setMarginRight()
     * @return float
     */
    public function marginRight() {}

    /**
     * Returns the top margin of the sheet (in inches)
     *
     * @see ExcelSheet::marginRight()
     * @see ExcelSheet::marginLeft()
     * @see ExcelSheet::marginBottom()
     * @see ExcelSheet::setMarginTop()
     * @return float
     */
    public function marginTop() {}

    /**
     * Gets the merged cells by index.
     *
     * @param int $index
     * @return array
     */
    public function merge($index) {}

    /**
     * Returns a number of merged cells in this worksheet.
     *
     * @return int
     */
    public function mergeSize() {}

    /**
     * Returns the name of the worksheet
     *
     * @see ExcelSheet::setName()
     * @return string
     */
    public function name() {}

    /**
     * Returns the number of named ranges in the sheet.
     *
     * @return int
     */
    public function namedRangeSize() {}

    /**
     * Returns the paper size
     *
     * @see ExcelSheet::setPaper()
     * @return int One of ExcelSheet::PAPER_* constants
     */
    public function paper() {}

    /**
     * Returns whether the gridlines are printed
     *
     * @see ExcelSheet::setPrintGridlines()
     * @return bool
     */
    public function printGridlines() {}

    /**
     * Returns whether the row and column headers are printed
     *
     * @see ExcelSheet::setPrintHeaders()
     * @return bool
     */
    public function printHeaders() {}

    /**
     * Returns whether the sheet is protected
     *
     * @see ExcelSheet::setProtect()
     * @return bool
     */
    public function protect() {}

    /**
     * Read data from a specific cell
     * An ExcelFormat object will be assigned to $format if passed
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @param &$format (optional, default=null)
     * @param bool $read_formula (optional, default=true)
     * @return mixed
     */
    public function read($row, $column, &$format = null, $read_formula = true) {}

    /**
     * Read comment from a cell
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return string
     */
    public function readComment($row, $column) {}

    /**
     * Read an entire column worth of data
     *
     * @param int $column 0-based column number
     * @param int $row_start (optional, default=0)
     * @param int $row_end (optional, default=null)
     * @param bool $read_formula (optional, default=true)
     * @return array or false if invalid row/column positions
     */
    public function readCol($column, $row_start = 0, $row_end = null, $read_formula = true) {}

    /**
     * Read an entire row worth of data
     *
     * @param int $row 0-based row number
     * @param int $column_start (optional, default=0)
     * @param int $column_end (optional, default=-1)
     * @param bool $read_formula (optional, default=true)
     * @return array or false if invalid row/column positions
     */
    public function readRow($row, $column_start = 0, $column_end = -1, $read_formula = true) {}

    /**
     * Remove columns from column_start to column_end
     *
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return bool
     */
    public function removeCol($column_start, $column_end) {}

    /**
     * Remove rows from row_start to row_end
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @return bool
     */
    public function removeRow($row_start, $row_end) {}

    /**
     * Converts row and column to a cell reference.
     *
     * @param int $row
     * @param int $column
     * @param bool $row_relative (optional, default=true)
     * @param bool $col_relative (optional, default=true)
     * @return string
     */
    public function rowColToAddr($row, $column, $row_relative = true, $col_relative = true) {}

    /**
     * Returns the row height
     *
     * @see ExcelSheet::colWidth()
     * @see ExcelSheet::setColWidth()
     * @see ExcelSheet::setRowHeight()
     * @param int $row 0-based row number
     * @return float
     */
    public function rowHeight($row) {}

    /**
     * Returns whether row is hidden.
     *
     * @param int $row 0-based row number
     * @return bool
     */
    public function rowHidden($row) {}

    /**
     * Set cell format
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @param ExcelFormat $format
     * @return void
     */
    public function setCellFormat($row, $column, $format) {}

    /**
     * Hides column.
     *
     * @param int $column 0-based column number
     * @param bool $hidden
     * @return bool
     */
    public function setColHidden($column, $hidden) {}

    /**
     * Set the width of cells in a column
     *
     * @see ExcelSheet::colWidth()
     * @see ExcelSheet::rowHeight()
     * @see ExcelSheet::setRowHeight()
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @param float $width (-1: autofit)
     * @param bool $hidden (optional, default=false)
     * @param ExcelFormat $format (optional, default=null)
     * @return bool
     */
    public function setColWidth($column_start, $column_end, $width, $hidden = false, $format = null) {}

    /**
     * Sets the borders for autofit column widths feature. The method Sheet::setCol()
     * with -1 width value will affect only to the specified limited area.
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return bool
     */
    public function setAutofitArea($row_start=0, $row_end=-1, $column_start=0, $column_end=-1) {}

    /**
     * Sets gridlines for displaying
     *
     * @see ExcelSheet::displayGridlines()
     * @param bool $value
     * @return void
     */
    public function setDisplayGridlines($value) {}

    /**
     * Sets the footer text of the sheet when printed
     *
     * @see ExcelSheet::footer()
     * @see ExcelSheet::header()
     * @see ExcelSheet::setHeader()
     * @param string $footer
     * @param float $margin
     * @return bool
     */
    public function setFooter($footer, $margin) {}

    /**
     * Sets a flag of grouping rows summary
     *
     * @see ExcelSheet::getGroupSummaryBelow()
     * @see ExcelSheet::getGroupSummaryRight()
     * @see ExcelSheet::setGroupSummaryRight()
     * @param bool $direction true=below, false=above
     * @return bool
     */
    public function setGroupSummaryBelow($direction) {}

    /**
     * Sets a flag of grouping columns summary
     *
     * @see ExcelSheet::getGroupSummaryBelow()
     * @see ExcelSheet::setGroupSummaryBelow()
     * @see ExcelSheet::getGroupSummaryRight()
     * @param bool $direction true=right, false=left
     * @return bool
     */
    public function setGroupSummaryRight($direction) {}

    /**
     * Sets a flag that the shhet is centered horizontally when printed
     *
     * @see ExcelSheet::setVCenter()
     * @param bool $value
     * @return void
     */
    public function setHCenter($value) {}

    /**
     * Hides/unhides the sheet.
     *
     * @param bool $value
     * @return bool
     */
    public function setHidden($value) {}

    /**
     * Set the header text of the sheet when printed
     *
     * @see ExcelSheet::setFooter()
     * @see ExcelSheet::header()
     * @see ExcelSheet::footer()
     * @param string $header
     * @param float $margin
     * @return bool
     */
    public function setHeader($header, $margin) {}

    /**
     * Sets landscape, or portrait mode for printing
     *
     * @see ExcelSheet::landscape()
     * @param bool $value true for landscape, false for portrait
     * @return void
     */
    public function setLandscape($value) {}

    /**
     * Set the bottom margin of the sheet (in inches)
     *
     * @see ExcelSheet::setMargingTop()
     * @see ExcelSheet::setMargingLeft()
     * @see ExcelSheet::setMargingRight()
     * @param float $margin
     * @return void
     */
    public function setMarginBottom($margin) {}

    /**
     * Set the left margin of the sheet (in inches)
     *
     * @see ExcelSheet::setMargingTop()
     * @see ExcelSheet::setMargingRight()
     * @see ExcelSheet::setMargingBottom()
     * @param float $margin
     * @return void
     */
    public function setMarginLeft($margin) {}

    /**
     * Set the right margin of the sheet (in inches)
     *
     * @see ExcelSheet::setMargingTop()
     * @see ExcelSheet::setMargingLeft()
     * @see ExcelSheet::setMargingBottom()
     * @param float $margin
     * @return void
     */
    public function setMarginRight($margin) {}

    /**
     * Set the top margin of the sheet (in inches)
     *
     * @see ExcelSheet::setMargingLeft()
     * @see ExcelSheet::setMargingRight()
     * @see ExcelSheet::setMargingBottom()
     * @param float $margin
     * @return void
     */
    public function setMarginTop($margin) {}

    /**
     * Set cell merge range
     *
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return bool
     */
    public function setMerge($row_start, $row_end, $column_start, $column_end) {}

    /**
     * Sets the name of the worksheet
     *
     * @see ExcelSheet::name()
     * @param string $name
     * @return void
     */
    public function setName($name) {}

    /**
     * Create a named range
     *
     * @see ExcelSheet::delNamedRange()
     * @param string $name
     * @param int $row_from 0-based row number
     * @param int $column_from 0-based column number
     * @param int $row_to 0-based row number
     * @param int $column_to 0-based column number
     * @param int $scope_id
     * @return bool
     */
    public function setNamedRange($name, $row_from, $row_to, $column_from, $column_to, $scope_id = null) {}

    /**
     * Sets the paper size
     *
     * @see ExcelSheet::paper()
     * @param int $paper One of ExcelSheet::PAPER_* constants
     * @return void
     */
    public function setPaper($paper) {}

    /**
     * Fits sheet width and sheet height to wPages and hPages respectively.
     *
     * @param int $wPages
     * @param int $hPages
     * @return bool
     */
    public function setPrintFit($wPages, $hPages) {}

    /**
     * Sets gridlines for printing
     *
     * @see ExcelSheet::printGridlines()
     * @param bool $value
     * @return void
     */
    public function setPrintGridlines($value) {}

    /**
     * Sets a flag to indicate row and column headers should be printed
     *
     * @see ExcelSheet::printHeaders()
     * @param bool $value
     * @return void
     */
    public function setPrintHeaders($value) {}

    /**
     * Sets repeated columns on each page from column_start to column_end
     *
     * @see ExcelSheet::setPrintRepeatRows()
     * @see ExcelSheet::clearPrintRepeats()
     * @param int $column_start 0-based column number
     * @param int $column_end 0-based column number
     * @return bool
     */
    public function setPrintRepeatCols($column_start, $column_end) {}

    /**
     * Gets repeated columns on each page from colFirst to colLast. Returns false
     * if repeated columns aren't found.
     *
     * @return bool|array with keys "col_start"(int) and "col_end"(int)
     */
    public function printRepeatCols() {}

    /**
     * Sets repeated rows on each page from row_start to row_end
     *
     * @see ExcelSheet::setPrintRepeatCols()
     * @see ExcelSheet::clearPrintRepeats()
     * @param int $row_start 0-based row number
     * @param int $row_end 0-based row number
     * @return bool
     */
    public function setPrintRepeatRows($row_start, $row_end) {}

    /**
     * Gets repeated rows on each page from rowFirst to rowLast. Returns false
     * if repeated rows aren't found.
     *
     * @return bool|array with keys "row_start"(int) and "row_end"(int)
     */
    public function printRepeatRows() {}

    /**
     * Protects or unprotects the worksheet
     *
     * @see ExcelSheet::protect()
     * @param bool $value
     * @return void
     */
    public function setProtect($value) {}

    /**
     * Sets the right-to-left mode:
     * 1 - the text is displayed in right-to-left mode,
     * 0 - the text is displayed in left-to-right mode.
     *
     * @param int $mode
     * @return void
     */
    public function setRightToLeft($mode) {}

    /**
     * Set the height of cells in a row
     *
     * @see ExcelSheet::rowHeight()
     * @see ExcelSheet::colWidth()
     * @see ExcelSheet::setColWidth()
     * @param int $row 0-based row number
     * @param float $height
     * @param ExcelFormat $format (optional, default=null)
     * @param bool $hidden (optional, default=false)
     * @return bool
     */
    public function setRowHeight($row, $height, $format = null, $hidden = false) {}

    /**
     * Hides row.
     *
     * @param int $row 0-based row number
     * @param bool $hidden
     * @return bool
     */
    public function setRowHidden($row, $hidden) {}

    /**
     * Sets the first visible row and the leftmost visible column of the sheet.
     *
     * @param int $row
     * @param int $column
     * @return bool
     */
    public function setTopLeftView($row, $column) {}

    /**
     * Sets a flag that the sheet is centered vertically when printed
     *
     * @see ExcelSheet::setHCenter()
     * @param bool $value
     * @return void
     */
    public function setVCenter($value) {}

    /**
     * Sets the zoom level of the current view. 100 is the usual view
     *
     * @param int $value
     * @return void
     */
    public function setZoom($value) {}

    /**
     * Sets the scaling factor for printing (as a percentage)
     *
     * @param int $value
     * @return void
     */
    public function setZoomPrint($value) {}

    /**
     * Gets the split information (position of frozen pane) in the sheet:
     * row - vertical position of the split;
     * col - horizontal position of the split.
     *
     * @return array
     */
    public function splitInfo() {}

    /**
     * Split sheet at indicated position
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @return void
     */
    public function splitSheet($row, $column) {}

    /**
     * Returns whether the sheet is centered vertically when printed
     *
     * @see ExcelSheet::hcenter()
     * @see ExcelSheet::setVCenter()
     * @see ExcelSheet::setHCenter()
     * @return bool
     */
    public function vcenter() {}

    /**
     * Set/Remove vertical page break
     *
     * @param int $column 0-based column number
     * @param bool $break
     * @return bool
     */
    public function verPageBreak($column, $break) {}

    /**
     * Write data into a cell
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @param mixed $data
     * @param ExcelFormat $format (optional, default=null)
     * @param int $data_type (optional, default=-1) One of ExcelFormat::AS_* constants
     * @return bool
     */
    public function write($row, $column, $data, $format = null, $data_type = -1) {}

    /**
     * Write an array of values into a column
     *
     * @param int $column 0-based column number
     * @param array $data
     * @param int $row_start (optional, default=0)
     * @param ExcelFormat $format (optional, default=null)
     * @param int $data_type (optional, default=-1) One of ExcelFormat::AS_* constants
     * @return bool
     */
    public function writeCol($column, $data, $row_start = 0, $format = null, $data_type = -1) {}

    /**
     * Write comment to a cell
     *
     * @param int $row 0-based row number
     * @param int $column 0-based column number
     * @param string $comment
     * @param string $author
     * @param int $width
     * @param int $height
     * @return void
     */
    public function writeComment($row, $column, $comment, $author, $width, $height) {}

    /**
     * Write an array of values into a row
     *
     * @param int $row 0-based row number
     * @param array $data
     * @param int $column_start (optional, default=0)
     * @param ExcelFormat $format (optional, default=null)
     * @return bool
     */
    public function writeRow($row, $data, $column_start = 0, $format = null) {}

    /**
     * Returns the zoom level of the current view as a percentage
     *
     * @return int
     */
    public function zoom() {}

    /**
     * Returns the scaling factor for printing as a percentage
     *
     * @return int
     */
    public function zoomPrint() {}
}

// End of php_excel v.1.0.2
?>
