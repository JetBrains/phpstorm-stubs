<?php

// Start of ncurses v.

/**
 * Add character at current position and advance cursor
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-addch
 * @param int $ch <p>
 * </p>
 * @return int
 */
function ncurses_addch($ch) {}

/**
 * Set fore- and background color
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-color-set
 * @param int $pair <p>
 * </p>
 * @return int
 */
function ncurses_color_set($pair) {}

/**
 * Delete a ncurses window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-delwin
 * @param resource $window <p>
 * </p>
 * @return bool
 */
function ncurses_delwin($window) {}

/**
 * Stop using ncurses, clean up the screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-end
 * @return int
 */
function ncurses_end() {}

/**
 * Read a character from keyboard
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-getch
 * @return int
 */
function ncurses_getch() {}

/**
 * Check if terminal has colors
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-has-colors
 * @return bool Return true if the terminal has color capacities, false otherwise.
 */
function ncurses_has_colors() {}

/**
 * Initialize ncurses
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-init
 * @return void
 */
function ncurses_init() {}

/**
 * Allocate a color pair
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-init-pair
 * @param int $pair <p>
 * </p>
 * @param int $fg <p>
 * </p>
 * @param int $bg <p>
 * </p>
 * @return int
 */
function ncurses_init_pair($pair, $fg, $bg) {}

/**
 * Gets the RGB value for color
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-color-content
 * @param int $color <p>
 * </p>
 * @param int &$r <p>
 * </p>
 * @param int &$g <p>
 * </p>
 * @param int &$b <p>
 * </p>
 * @return int
 */
function ncurses_color_content($color, &$r, &$g, &$b) {}

/**
 * Gets the RGB value for color
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-pair-content
 * @param int $pair <p>
 * </p>
 * @param int &$f <p>
 * </p>
 * @param int &$b <p>
 * </p>
 * @return int
 */
function ncurses_pair_content($pair, &$f, &$b) {}

/**
 * Move output position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-move
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @return int
 */
function ncurses_move($y, $x) {}

/**
 * Create a new window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-newwin
 * @param int $rows <p>
 * Number of rows
 * </p>
 * @param int $cols <p>
 * Number of columns
 * </p>
 * @param int $y <p>
 * y-ccordinate of the origin
 * </p>
 * @param int $x <p>
 * x-ccordinate of the origin
 * </p>
 * @return resource a resource ID for the new window.
 */
function ncurses_newwin($rows, $cols, $y, $x) {}

/**
 * Refresh screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-refresh
 * @param int $ch <p>
 * </p>
 * @return int
 */
function ncurses_refresh($ch) {}

/**
 * Start using colors
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-start-color
 * @return int
 */
function ncurses_start_color() {}

/**
 * Start using 'standout' attribute
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-standout
 * @return int
 */
function ncurses_standout() {}

/**
 * Stop using 'standout' attribute
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-standend
 * @return int
 */
function ncurses_standend() {}

/**
 * Returns baudrate of terminal
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-baudrate
 * @return int
 */
function ncurses_baudrate() {}

/**
 * Let the terminal beep
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-beep
 * @return int
 */
function ncurses_beep() {}

/**
 * Check if we can change terminals colors
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-can-change-color
 * @return bool Return true if the terminal has color capabilities and you can change
 * the colors, false otherwise.
 */
function ncurses_can_change_color() {}

/**
 * Switch of input buffering
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-cbreak
 * @return bool true or NCURSES_ERR if any error occurred.
 */
function ncurses_cbreak() {}

/**
 * Clear screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-clear
 * @return bool
 */
function ncurses_clear() {}

/**
 * Clear screen from current position to bottom
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-clrtobot
 * @return bool
 */
function ncurses_clrtobot() {}

/**
 * Clear screen from current position to end of line
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-clrtoeol
 * @return bool
 */
function ncurses_clrtoeol() {}

/**
 * Saves terminals (program) mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-def-prog-mode
 * @return bool false on success, otherwise true.
 */
function ncurses_def_prog_mode() {}

/**
 * Resets the prog mode saved by def_prog_mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-reset-prog-mode
 * @return int
 */
function ncurses_reset_prog_mode() {}

/**
 * Saves terminals (shell) mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-def-shell-mode
 * @return bool false on success, true otherwise.
 */
function ncurses_def_shell_mode() {}

/**
 * Resets the shell mode saved by def_shell_mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-reset-shell-mode
 * @return int
 */
function ncurses_reset_shell_mode() {}

/**
 * Delete character at current position, move rest of line left
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-delch
 * @return bool false on success, true otherwise.
 */
function ncurses_delch() {}

/**
 * Delete line at current position, move rest of screen up
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-deleteln
 * @return bool false on success, otherwise true.
 */
function ncurses_deleteln() {}

/**
 * Write all prepared refreshes to terminal
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-doupdate
 * @return bool
 */
function ncurses_doupdate() {}

/**
 * Activate keyboard input echo
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-echo
 * @return bool false on success, true if any error occurred.
 */
function ncurses_echo() {}

/**
 * Erase terminal screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-erase
 * @return bool
 */
function ncurses_erase() {}

/**
 * Erase window contents
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-werase
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_werase($window) {}

/**
 * Returns current erase character
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-erasechar
 * @return string The current erase char, as a string.
 */
function ncurses_erasechar() {}

/**
 * Flash terminal screen (visual bell)
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-flash
 * @return bool false on success, otherwise true.
 */
function ncurses_flash() {}

/**
 * Flush keyboard input buffer
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-flushinp
 * @return bool false on success, otherwise true.
 */
function ncurses_flushinp() {}

/**
 * Check for insert- and delete-capabilities
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-has-ic
 * @return bool true if the terminal has insert/delete-capabilities, false
 * otherwise.
 */
function ncurses_has_ic() {}

/**
 * Check for line insert- and delete-capabilities
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-has-il
 * @return bool true if the terminal has insert/delete-line capabilities,
 * false otherwise.
 */
function ncurses_has_il() {}

/**
 * Get character and attribute at current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-inch
 * @return string the character, as a string.
 */
function ncurses_inch() {}

/**
 * Insert a line, move rest of screen down
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-insertln
 * @return int
 */
function ncurses_insertln() {}

/**
 * Ncurses is in endwin mode, normal screen output may be performed
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-isendwin
 * @return bool true, if ncurses_endwin has been called
 * without any subsequent calls to ncurses_wrefresh,
 * false otherwise.
 */
function ncurses_isendwin() {}

/**
 * Returns current line kill character
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-killchar
 * @return string the kill character, as a string.
 */
function ncurses_killchar() {}

/**
 * Translate newline and carriage return / line feed
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-nl
 * @return bool
 */
function ncurses_nl() {}

/**
 * Switch terminal to cooked mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-nocbreak
 * @return bool true if any error occurred, otherwise false.
 */
function ncurses_nocbreak() {}

/**
 * Switch off keyboard input echo
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-noecho
 * @return bool true if any error occurred, false otherwise.
 */
function ncurses_noecho() {}

/**
 * Do not translate newline and carriage return / line feed
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-nonl
 * @return bool
 */
function ncurses_nonl() {}

/**
 * Switch terminal out of raw mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-noraw
 * @return bool true if any error occurred, otherwise false.
 */
function ncurses_noraw() {}

/**
 * Switch terminal into raw mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-raw
 * @return bool true if any error occurred, otherwise false.
 */
function ncurses_raw() {}

/**
 * Enables/Disable 8-bit meta key information
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-meta
 * @param resource $window <p>
 * </p>
 * @param $bit8 bool <p>
 * </p>
 * @return int
 */
function ncurses_meta($window, $bit8) {}

/**
 * Restores saved terminal state
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-resetty
 * @return bool Always returns false.
 */
function ncurses_resetty() {}

/**
 * Saves terminal state
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-savetty
 * @return bool Always returns false.
 */
function ncurses_savetty() {}

/**
 * Returns a logical OR of all attribute flags supported by terminal
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-termattrs
 * @return bool
 */
function ncurses_termattrs() {}

/**
 * Assign terminal default colors to color id -1
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-use-default-colors
 * @return bool
 */
function ncurses_use_default_colors() {}

/**
 * Returns current soft label key attribute
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-attr
 * @return int The attribute, as an integer.
 */
function ncurses_slk_attr() {}

/**
 * Clears soft labels from screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-clear
 * @return bool true on errors, false otherwise.
 */
function ncurses_slk_clear() {}

/**
 * Copies soft label keys to virtual screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-noutrefresh
 * @return bool
 */
function ncurses_slk_noutrefresh() {}

/**
 * Copies soft label keys to screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-refresh
 * @return int
 */
function ncurses_slk_refresh() {}

/**
 * Restores soft label keys
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-restore
 * @return int
 */
function ncurses_slk_restore() {}

/**
 * Forces output when ncurses_slk_noutrefresh is performed
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-touch
 * @return int
 */
function ncurses_slk_touch() {}

/**
 * Turn off the given attributes
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-attroff
 * @param int $attributes <p>
 * </p>
 * @return int
 */
function ncurses_attroff($attributes) {}

/**
 * Turn on the given attributes
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-attron
 * @param int $attributes <p>
 * </p>
 * @return int
 */
function ncurses_attron($attributes) {}

/**
 * Set given attributes
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-attrset
 * @param int $attributes <p>
 * </p>
 * @return int
 */
function ncurses_attrset($attributes) {}

/**
 * Set background property for terminal screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-bkgd
 * @param int $attrchar <p>
 * </p>
 * @return int
 */
function ncurses_bkgd($attrchar) {}

/**
 * Set cursor state
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-curs-set
 * @param int $visibility <p>
 * </p>
 * @return int
 */
function ncurses_curs_set($visibility) {}

/**
 * Delay output on terminal using padding characters
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-delay-output
 * @param int $milliseconds <p>
 * </p>
 * @return int
 */
function ncurses_delay_output($milliseconds) {}

/**
 * Single character output including refresh
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-echochar
 * @param int $character <p>
 * </p>
 * @return int
 */
function ncurses_echochar($character) {}

/**
 * Put terminal into halfdelay mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-halfdelay
 * @param int $tenth <p>
 * </p>
 * @return int
 */
function ncurses_halfdelay($tenth) {}

/**
 * Check for presence of a function key on terminal keyboard
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-has-key
 * @param int $keycode <p>
 * </p>
 * @return int
 */
function ncurses_has_key($keycode) {}

/**
 * Insert character moving rest of line including character at current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-insch
 * @param int $character <p>
 * </p>
 * @return int
 */
function ncurses_insch($character) {}

/**
 * Insert lines before current line scrolling down (negative numbers delete and scroll up)
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-insdelln
 * @param int $count <p>
 * </p>
 * @return int
 */
function ncurses_insdelln($count) {}

/**
 * Set timeout for mouse button clicks
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mouseinterval
 * @param int $milliseconds <p>
 * </p>
 * @return int
 */
function ncurses_mouseinterval($milliseconds) {}

/**
 * Sleep
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-napms
 * @param int $milliseconds <p>
 * </p>
 * @return int
 */
function ncurses_napms($milliseconds) {}

/**
 * Scroll window content up or down without changing current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-scrl
 * @param int $count <p>
 * </p>
 * @return int
 */
function ncurses_scrl($count) {}

/**
 * Turn off the given attributes for soft function-key labels
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-attroff
 * @param int $intarg <p>
 * </p>
 * @return int
 */
function ncurses_slk_attroff($intarg) {}

/**
 * Turn on the given attributes for soft function-key labels
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-attron
 * @param int $intarg <p>
 * </p>
 * @return int
 */
function ncurses_slk_attron($intarg) {}

/**
 * Set given attributes for soft function-key labels
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-attrset
 * @param int $intarg <p>
 * </p>
 * @return int
 */
function ncurses_slk_attrset($intarg) {}

/**
 * Sets color for soft label keys
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-color
 * @param int $intarg <p>
 * </p>
 * @return int
 */
function ncurses_slk_color($intarg) {}

/**
 * Initializes soft label key functions
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-init
 * @param int $format <p>
 * If ncurses_initscr eventually uses a line from
 * stdscr to emulate the soft labels, then this parameter determines how
 * the labels are arranged of the screen.
 * </p>
 * <p>
 * 0 indicates a 3-2-3 arrangement of the labels, 1 indicates a 4-4
 * arrangement and 2 indicates the PC like 4-4-4 mode, but in addition an
 * index line will be created.
 * </p>
 * @return bool
 */
function ncurses_slk_init($format) {}

/**
 * Sets function key labels
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-slk-set
 * @param int $labelnr <p>
 * </p>
 * @param string $label <p>
 * </p>
 * @param int $format <p>
 * </p>
 * @return bool
 */
function ncurses_slk_set($labelnr, $label, $format) {}

/**
 * Specify different filedescriptor for typeahead checking
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-typeahead
 * @param int $fd <p>
 * </p>
 * @return int
 */
function ncurses_typeahead($fd) {}

/**
 * Put a character back into the input stream
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-ungetch
 * @param int $keycode <p>
 * </p>
 * @return int
 */
function ncurses_ungetch($keycode) {}

/**
 * Display the string on the terminal in the video attribute mode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-vidattr
 * @param int $intarg <p>
 * </p>
 * @return int
 */
function ncurses_vidattr($intarg) {}

/**
 * Refresh window on terminal screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wrefresh
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_wrefresh($window) {}

/**
 * Control use of extended names in terminfo descriptions
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-use-extended-names
 * @param bool $flag <p>
 * </p>
 * @return int
 */
function ncurses_use_extended_names($flag) {}

/**
 * Control screen background
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-bkgdset
 * @param int $attrchar <p>
 * </p>
 * @return void
 */
function ncurses_bkgdset($attrchar) {}

/**
 * Set LINES for iniscr() and newterm() to 1
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-filter
 * @return void
 */
function ncurses_filter() {}

/**
 * Do not flush on signal characters
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-noqiflush
 * @return void
 */
function ncurses_noqiflush() {}

/**
 * Flush on signal characters
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-qiflush
 * @return void
 */
function ncurses_qiflush() {}

/**
 * Set timeout for special key sequences
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-timeout
 * @param int $millisec <p>
 * </p>
 * @return void
 */
function ncurses_timeout($millisec) {}

/**
 * Control use of environment information about terminal size
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-use-env
 * @param bool $flag <p>
 * </p>
 * @return void
 */
function ncurses_use_env($flag) {}

/**
 * Output text at current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-addstr
 * @param string $text <p>
 * </p>
 * @return int
 */
function ncurses_addstr($text) {}

/**
 * Apply padding information to the string and output it
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-putp
 * @param string $text <p>
 * </p>
 * @return int
 */
function ncurses_putp($text) {}

/**
 * Dump screen content to file
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-scr-dump
 * @param string $filename <p>
 * </p>
 * @return int
 */
function ncurses_scr_dump($filename) {}

/**
 * Initialize screen from file dump
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-scr-init
 * @param string $filename <p>
 * </p>
 * @return int
 */
function ncurses_scr_init($filename) {}

/**
 * Restore screen from file dump
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-scr-restore
 * @param string $filename <p>
 * </p>
 * @return int
 */
function ncurses_scr_restore($filename) {}

/**
 * Inherit screen from file dump
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-scr-set
 * @param string $filename <p>
 * </p>
 * @return int
 */
function ncurses_scr_set($filename) {}

/**
 * Move current position and add character
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvaddch
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param int $c <p>
 * </p>
 * @return int
 */
function ncurses_mvaddch($y, $x, $c) {}

/**
 * Move position and add attributed string with specified length
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvaddchnstr
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param string $s <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_mvaddchnstr($y, $x, $s, $n) {}

/**
 * Add attributed string with specified length at current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-addchnstr
 * @param string $s <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_addchnstr($s, $n) {}

/**
 * Move position and add attributed string
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvaddchstr
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param string $s <p>
 * </p>
 * @return int
 */
function ncurses_mvaddchstr($y, $x, $s) {}

/**
 * Add attributed string at current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-addchstr
 * @param string $s <p>
 * </p>
 * @return int
 */
function ncurses_addchstr($s) {}

/**
 * Move position and add string with specified length
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvaddnstr
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param string $s <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_mvaddnstr($y, $x, $s, $n) {}

/**
 * Add string with specified length at current position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-addnstr
 * @param string $s <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_addnstr($s, $n) {}

/**
 * Move position and add string
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvaddstr
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param string $s <p>
 * </p>
 * @return int
 */
function ncurses_mvaddstr($y, $x, $s) {}

/**
 * Move position and delete character, shift rest of line left
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvdelch
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @return int
 */
function ncurses_mvdelch($y, $x) {}

/**
 * Move position and get character at new position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvgetch
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @return int
 */
function ncurses_mvgetch($y, $x) {}

/**
 * Move position and get attributed character at new position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvinch
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @return int
 */
function ncurses_mvinch($y, $x) {}

/**
 * Add string at new position in window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvwaddstr
 * @param resource $window <p>
 * </p>
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param string $text <p>
 * </p>
 * @return int
 */
function ncurses_mvwaddstr($window, $y, $x, $text) {}

/**
 * Insert string at current position, moving rest of line right
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-insstr
 * @param string $text <p>
 * </p>
 * @return int
 */
function ncurses_insstr($text) {}

/**
 * Reads string from terminal screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-instr
 * @param string &$buffer <p>
 * The characters. Attributes will be stripped.
 * </p>
 * @return int the number of characters.
 */
function ncurses_instr(&$buffer) {}

/**
 * Set new position and draw a horizontal line using an attributed character and max. n characters long
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvhline
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @param int $attrchar <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_mvhline($y, $x, $attrchar, $n) {}

/**
 * Move cursor immediately
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mvcur
 * @param int $old_y <p>
 * </p>
 * @param int $old_x <p>
 * </p>
 * @param int $new_y <p>
 * </p>
 * @param int $new_x <p>
 * </p>
 * @return int
 */
function ncurses_mvcur($old_y, $old_x, $new_y, $new_x) {}

/**
 * Set new RGB value for color
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-init-color
 * @param int $color <p>
 * </p>
 * @param int $r <p>
 * </p>
 * @param int $g <p>
 * </p>
 * @param int $b <p>
 * </p>
 * @return int
 */
function ncurses_init_color($color, $r, $g, $b) {}

/**
 * Draw a border around the screen using attributed characters
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-border
 * @param int $left <p>
 * </p>
 * @param int $right <p>
 * </p>
 * @param int $top <p>
 * </p>
 * @param int $bottom <p>
 * </p>
 * @param int $tl_corner <p>
 * Top left corner
 * </p>
 * @param int $tr_corner <p>
 * Top right corner
 * </p>
 * @param int $bl_corner <p>
 * Bottom left corner
 * </p>
 * @param int $br_corner <p>
 * Bottom right corner
 * </p>
 * @return int
 */
function ncurses_border($left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner) {}

/**
 * Define default colors for color 0
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-assume-default-colors
 * @param int $fg <p>
 * </p>
 * @param int $bg <p>
 * </p>
 * @return int
 */
function ncurses_assume_default_colors($fg, $bg) {}

/**
 * Define a keycode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-define-key
 * @param string $definition <p>
 * </p>
 * @param int $keycode <p>
 * </p>
 * @return int
 */
function ncurses_define_key($definition, $keycode) {}

/**
 * Draw a horizontal line at current position using an attributed character and max. n characters long
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-hline
 * @param int $charattr <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_hline($charattr, $n) {}

/**
 * Draw a vertical line at current position using an attributed character and max. n characters long
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-vline
 * @param int $charattr <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_vline($charattr, $n) {}

/**
 * Enable or disable a keycode
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-keyok
 * @param int $keycode <p>
 * </p>
 * @param bool $enable <p>
 * </p>
 * @return int
 */
function ncurses_keyok($keycode, $enable) {}

/**
 * Returns terminals (short)-name
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-termname
 * @return string|null the shortname of the terminal, truncated to 14 characters.
 * On errors, returns null.
 */
function ncurses_termname() {}

/**
 * Returns terminals description
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-longname
 * @return string|null the description, as a string truncated to 128 characters.
 * On errors, returns null.
 */
function ncurses_longname() {}

/**
 * Sets mouse options
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mousemask
 * @param int $newmask <p>
 * Mouse mask options can be set with the following predefined constants:
 * <p>NCURSES_BUTTON1_PRESSED</p>
 * @param int &$oldmask <p>
 * This will be set to the previous value of the mouse event mask.
 * </p>
 * @return int a mask to indicated which of the in parameter
 * newmask specified mouse events can be reported. On
 * complete failure, it returns 0.
 * </p>
 */
function ncurses_mousemask($newmask, &$oldmask) {}

/**
 * Reads mouse event
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-getmouse
 * @param array &$mevent <p>
 * Event options will be delivered in this parameter which has to be an
 * array, passed by reference (see example below).
 * </p>
 * <p>
 * On success an associative array with following keys will be delivered:
 * <p>
 * "id" : Id to distinguish multiple devices
 * </p>
 * @return bool false if a mouse event is actually visible in the given window,
 * otherwise returns true.
 * </p>
 */
function ncurses_getmouse(array &$mevent) {}

/**
 * Pushes mouse event to queue
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-ungetmouse
 * @param array $mevent <p>
 * An associative array specifying the event options:
 * <b>"id"</b> : Id to distinguish multiple devices
 * </p>
 * @return bool false on success, true otherwise.
 */
function ncurses_ungetmouse(array $mevent) {}

/**
 * Transforms coordinates
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-mouse-trafo
 * @param int &$y <p>
 * </p>
 * @param int &$x <p>
 * </p>
 * @param bool $toscreen <p>
 * </p>
 * @return bool
 */
function ncurses_mouse_trafo(&$y, &$x, $toscreen) {}

/**
 * Transforms window/stdscr coordinates
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wmouse-trafo
 * @param resource $window <p>
 * </p>
 * @param int &$y <p>
 * </p>
 * @param int &$x <p>
 * </p>
 * @param bool $toscreen <p>
 * </p>
 * @return bool
 */
function ncurses_wmouse_trafo($window, &$y, &$x, $toscreen) {}

/**
 * Outputs text at current position in window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-waddstr
 * @param resource $window <p>
 * </p>
 * @param string $str <p>
 * </p>
 * @param int $n [optional] <p>
 * </p>
 * @return int
 */
function ncurses_waddstr($window, $str, $n = null) {}

/**
 * Copies window to virtual screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wnoutrefresh
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_wnoutrefresh($window) {}

/**
 * Clears window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wclear
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_wclear($window) {}

/**
 * Sets windows color pairings
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wcolor-set
 * @param resource $window <p>
 * </p>
 * @param int $color_pair <p>
 * </p>
 * @return int
 */
function ncurses_wcolor_set($window, $color_pair) {}

/**
 * Reads a character from keyboard (window)
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wgetch
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_wgetch($window) {}

/**
 * Turns keypad on or off
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-keypad
 * @param resource $window <p>
 * </p>
 * @param bool $bf <p>
 * </p>
 * @return int
 */
function ncurses_keypad($window, $bf) {}

/**
 * Moves windows output position
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wmove
 * @param resource $window <p>
 * </p>
 * @param int $y <p>
 * </p>
 * @param int $x <p>
 * </p>
 * @return int
 */
function ncurses_wmove($window, $y, $x) {}

/**
 * Creates a new pad (window)
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-newpad
 * @param int $rows <p>
 * </p>
 * @param int $cols <p>
 * </p>
 * @return resource
 */
function ncurses_newpad($rows, $cols) {}

/**
 * Copies a region from a pad into the virtual screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-prefresh
 * @param resource $pad <p>
 * </p>
 * @param int $pminrow <p>
 * </p>
 * @param int $pmincol <p>
 * </p>
 * @param int $sminrow <p>
 * </p>
 * @param int $smincol <p>
 * </p>
 * @param int $smaxrow <p>
 * </p>
 * @param int $smaxcol <p>
 * </p>
 * @return int
 */
function ncurses_prefresh($pad, $pminrow, $pmincol, $sminrow, $smincol, $smaxrow, $smaxcol) {}

/**
 * Copies a region from a pad into the virtual screen
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-pnoutrefresh
 * @param resource $pad <p>
 * </p>
 * @param int $pminrow <p>
 * </p>
 * @param int $pmincol <p>
 * </p>
 * @param int $sminrow <p>
 * </p>
 * @param int $smincol <p>
 * </p>
 * @param int $smaxrow <p>
 * </p>
 * @param int $smaxcol <p>
 * </p>
 * @return int
 */
function ncurses_pnoutrefresh($pad, $pminrow, $pmincol, $sminrow, $smincol, $smaxrow, $smaxcol) {}

/**
 * Enter standout mode for a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wstandout
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_wstandout($window) {}

/**
 * End standout mode for a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wstandend
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_wstandend($window) {}

/**
 * Set the attributes for a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wattrset
 * @param resource $window <p>
 * </p>
 * @param int $attrs <p>
 * </p>
 * @return int
 */
function ncurses_wattrset($window, $attrs) {}

/**
 * Turns on attributes for a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wattron
 * @param resource $window <p>
 * </p>
 * @param int $attrs <p>
 * </p>
 * @return int
 */
function ncurses_wattron($window, $attrs) {}

/**
 * Turns off attributes for a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wattroff
 * @param resource $window <p>
 * </p>
 * @param int $attrs <p>
 * </p>
 * @return int
 */
function ncurses_wattroff($window, $attrs) {}

/**
 * Adds character at current position in a window and advance cursor
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-waddch
 * @param resource $window <p>
 * </p>
 * @param int $ch <p>
 * </p>
 * @return int
 */
function ncurses_waddch($window, $ch) {}

/**
 * Draws a border around the window using attributed characters
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wborder
 * @param resource $window <p>
 * The window on which we operate
 * </p>
 * @param int $left <p>
 * </p>
 * @param int $right <p>
 * </p>
 * @param int $top <p>
 * </p>
 * @param int $bottom <p>
 * </p>
 * @param int $tl_corner <p>
 * Top left corner
 * </p>
 * @param int $tr_corner <p>
 * Top right corner
 * </p>
 * @param int $bl_corner <p>
 * Bottom left corner
 * </p>
 * @param int $br_corner <p>
 * Bottom right corner
 * </p>
 * @return int
 */
function ncurses_wborder($window, $left, $right, $top, $bottom, $tl_corner, $tr_corner, $bl_corner, $br_corner) {}

/**
 * Draws a horizontal line in a window at current position using an attributed character and max. n characters long
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-whline
 * @param resource $window <p>
 * </p>
 * @param int $charattr <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_whline($window, $charattr, $n) {}

/**
 * Draws a vertical line in a window at current position using an attributed character and max. n characters long
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-wvline
 * @param resource $window <p>
 * </p>
 * @param int $charattr <p>
 * </p>
 * @param int $n <p>
 * </p>
 * @return int
 */
function ncurses_wvline($window, $charattr, $n) {}

/**
 * Returns the current cursor position for a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-getyx
 * @param resource $window <p>
 * </p>
 * @param int &$y <p>
 * </p>
 * @param int &$x <p>
 * </p>
 * @return void
 */
function ncurses_getyx($window, &$y, &$x) {}

/**
 * Returns the size of a window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-getmaxyx
 * @param resource $window <p>
 * The measured window
 * </p>
 * @param int &$y <p>
 * This will be set to the window height
 * </p>
 * @param int &$x <p>
 * This will be set to the window width
 * </p>
 * @return void
 */
function ncurses_getmaxyx($window, &$y, &$x) {}

/**
 * Refreshes the virtual screen to reflect the relations between panels in the stack
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-update-panels
 * @return void
 */
function ncurses_update_panels() {}

/**
 * Returns the window associated with panel
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-panel-window
 * @param resource $panel <p>
 * </p>
 * @return resource
 */
function ncurses_panel_window($panel) {}

/**
 * Returns the panel below panel
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-panel-below
 * @param resource $panel <p>
 * </p>
 * @return resource
 */
function ncurses_panel_below($panel) {}

/**
 * Returns the panel above panel
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-panel-above
 * @param resource $panel <p>
 * </p>
 * @return resource If panel is null, returns the bottom panel in the stack.
 */
function ncurses_panel_above($panel) {}

/**
 * Replaces the window associated with panel
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-replace-panel
 * @param resource $panel <p>
 * </p>
 * @param resource $window <p>
 * </p>
 * @return int
 */
function ncurses_replace_panel($panel, $window) {}

/**
 * Moves a panel so that its upper-left corner is at [startx, starty]
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-move-panel
 * @param resource $panel <p>
 * </p>
 * @param int $startx <p>
 * </p>
 * @param int $starty <p>
 * </p>
 * @return int
 */
function ncurses_move_panel($panel, $startx, $starty) {}

/**
 * Moves a visible panel to the bottom of the stack
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-bottom-panel
 * @param resource $panel <p>
 * </p>
 * @return int
 */
function ncurses_bottom_panel($panel) {}

/**
 * Moves a visible panel to the top of the stack
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-top-panel
 * @param resource $panel <p>
 * </p>
 * @return int
 */
function ncurses_top_panel($panel) {}

/**
 * Places an invisible panel on top of the stack, making it visible
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-show-panel
 * @param resource $panel <p>
 * </p>
 * @return int
 */
function ncurses_show_panel($panel) {}

/**
 * Remove panel from the stack, making it invisible
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-hide-panel
 * @param resource $panel <p>
 * </p>
 * @return int
 */
function ncurses_hide_panel($panel) {}

/**
 * Remove panel from the stack and delete it (but not the associated window)
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-del-panel
 * @param resource $panel <p>
 * </p>
 * @return bool
 */
function ncurses_del_panel($panel) {}

/**
 * Create a new panel and associate it with window
 * @link https://php-legacy-docs.zend.com/manual/php5/en/function.ncurses-new-panel
 * @param resource $window <p>
 * </p>
 * @return resource
 */
function ncurses_new_panel($window) {}

define('NCURSES_COLOR_BLACK', 0);
define('NCURSES_COLOR_RED', 1);
define('NCURSES_COLOR_GREEN', 2);
define('NCURSES_COLOR_YELLOW', 3);
define('NCURSES_COLOR_BLUE', 4);
define('NCURSES_COLOR_MAGENTA', 5);
define('NCURSES_COLOR_CYAN', 6);
define('NCURSES_COLOR_WHITE', 7);
define('NCURSES_KEY_DOWN', 258);
define('NCURSES_KEY_UP', 259);
define('NCURSES_KEY_LEFT', 260);
define('NCURSES_KEY_RIGHT', 261);
define('NCURSES_KEY_HOME', 262);
define('NCURSES_KEY_END', 360);
define('NCURSES_KEY_BACKSPACE', 263);
define('NCURSES_KEY_MOUSE', 409);
define('NCURSES_KEY_F0', 264);
define('NCURSES_KEY_F1', 265);
define('NCURSES_KEY_F2', 266);
define('NCURSES_KEY_F3', 267);
define('NCURSES_KEY_F4', 268);
define('NCURSES_KEY_F5', 269);
define('NCURSES_KEY_F6', 270);
define('NCURSES_KEY_F7', 271);
define('NCURSES_KEY_F8', 272);
define('NCURSES_KEY_F9', 273);
define('NCURSES_KEY_F10', 274);
define('NCURSES_KEY_F11', 275);
define('NCURSES_KEY_F12', 276);
define('NCURSES_KEY_DL', 328);
define('NCURSES_KEY_IL', 329);
define('NCURSES_KEY_DC', 330);
define('NCURSES_KEY_IC', 331);
define('NCURSES_KEY_EIC', 332);
define('NCURSES_KEY_CLEAR', 333);
define('NCURSES_KEY_EOS', 334);
define('NCURSES_KEY_EOL', 335);
define('NCURSES_KEY_SF', 336);
define('NCURSES_KEY_SR', 337);
define('NCURSES_KEY_NPAGE', 338);
define('NCURSES_KEY_PPAGE', 339);
define('NCURSES_KEY_STAB', 340);
define('NCURSES_KEY_CTAB', 341);
define('NCURSES_KEY_CATAB', 342);
define('NCURSES_KEY_ENTER', 343);
define('NCURSES_KEY_SRESET', 344);
define('NCURSES_KEY_RESET', 345);
define('NCURSES_KEY_PRINT', 346);
define('NCURSES_KEY_LL', 347);
define('NCURSES_KEY_A1', 348);
define('NCURSES_KEY_A3', 349);
define('NCURSES_KEY_B2', 350);
define('NCURSES_KEY_C1', 351);
define('NCURSES_KEY_C3', 352);
define('NCURSES_KEY_BTAB', 353);
define('NCURSES_KEY_BEG', 354);
define('NCURSES_KEY_CANCEL', 355);
define('NCURSES_KEY_CLOSE', 356);
define('NCURSES_KEY_COMMAND', 357);
define('NCURSES_KEY_COPY', 358);
define('NCURSES_KEY_CREATE', 359);
define('NCURSES_KEY_EXIT', 361);
define('NCURSES_KEY_FIND', 362);
define('NCURSES_KEY_HELP', 363);
define('NCURSES_KEY_MARK', 364);
define('NCURSES_KEY_MESSAGE', 365);
define('NCURSES_KEY_MOVE', 366);
define('NCURSES_KEY_NEXT', 367);
define('NCURSES_KEY_OPEN', 368);
define('NCURSES_KEY_OPTIONS', 369);
define('NCURSES_KEY_PREVIOUS', 370);
define('NCURSES_KEY_REDO', 371);
define('NCURSES_KEY_REFERENCE', 372);
define('NCURSES_KEY_REFRESH', 373);
define('NCURSES_KEY_REPLACE', 374);
define('NCURSES_KEY_RESTART', 375);
define('NCURSES_KEY_RESUME', 376);
define('NCURSES_KEY_SAVE', 377);
define('NCURSES_KEY_SBEG', 378);
define('NCURSES_KEY_SCANCEL', 379);
define('NCURSES_KEY_SCOMMAND', 380);
define('NCURSES_KEY_SCOPY', 381);
define('NCURSES_KEY_SCREATE', 382);
define('NCURSES_KEY_SDC', 383);
define('NCURSES_KEY_SDL', 384);
define('NCURSES_KEY_SELECT', 385);
define('NCURSES_KEY_SEND', 386);
define('NCURSES_KEY_SEOL', 387);
define('NCURSES_KEY_SEXIT', 388);
define('NCURSES_KEY_SFIND', 389);
define('NCURSES_KEY_SHELP', 390);
define('NCURSES_KEY_SHOME', 391);
define('NCURSES_KEY_SIC', 392);
define('NCURSES_KEY_SLEFT', 393);
define('NCURSES_KEY_SMESSAGE', 394);
define('NCURSES_KEY_SMOVE', 395);
define('NCURSES_KEY_SNEXT', 396);
define('NCURSES_KEY_SOPTIONS', 397);
define('NCURSES_KEY_SPREVIOUS', 398);
define('NCURSES_KEY_SPRINT', 399);
define('NCURSES_KEY_SREDO', 400);
define('NCURSES_KEY_SREPLACE', 401);
define('NCURSES_KEY_SRIGHT', 402);
define('NCURSES_KEY_SRSUME', 403);
define('NCURSES_KEY_SSAVE', 404);
define('NCURSES_KEY_SSUSPEND', 405);
define('NCURSES_KEY_SUNDO', 406);
define('NCURSES_KEY_SUSPEND', 407);
define('NCURSES_KEY_UNDO', 408);
define('NCURSES_KEY_RESIZE', 410);
define('NCURSES_A_NORMAL', 0);
define('NCURSES_A_STANDOUT', 65536);
define('NCURSES_A_UNDERLINE', 131072);
define('NCURSES_A_REVERSE', 262144);
define('NCURSES_A_BLINK', 524288);
define('NCURSES_A_DIM', 1048576);
define('NCURSES_A_BOLD', 2097152);
define('NCURSES_A_PROTECT', 16777216);
define('NCURSES_A_INVIS', 8388608);
define('NCURSES_A_ALTCHARSET', 4194304);
define('NCURSES_A_CHARTEXT', 255);
define('NCURSES_BUTTON1_PRESSED', 2);
define('NCURSES_BUTTON1_RELEASED', 1);
define('NCURSES_BUTTON1_CLICKED', 4);
define('NCURSES_BUTTON1_DOUBLE_CLICKED', 8);
define('NCURSES_BUTTON1_TRIPLE_CLICKED', 16);
define('NCURSES_BUTTON2_PRESSED', 128);
define('NCURSES_BUTTON2_RELEASED', 64);
define('NCURSES_BUTTON2_CLICKED', 256);
define('NCURSES_BUTTON2_DOUBLE_CLICKED', 512);
define('NCURSES_BUTTON2_TRIPLE_CLICKED', 1024);
define('NCURSES_BUTTON3_PRESSED', 8192);
define('NCURSES_BUTTON3_RELEASED', 4096);
define('NCURSES_BUTTON3_CLICKED', 16384);
define('NCURSES_BUTTON3_DOUBLE_CLICKED', 32768);
define('NCURSES_BUTTON3_TRIPLE_CLICKED', 65536);
define('NCURSES_BUTTON4_PRESSED', 524288);
define('NCURSES_BUTTON4_RELEASED', 262144);
define('NCURSES_BUTTON4_CLICKED', 1048576);
define('NCURSES_BUTTON4_DOUBLE_CLICKED', 2097152);
define('NCURSES_BUTTON4_TRIPLE_CLICKED', 4194304);
define('NCURSES_BUTTON_SHIFT', 33554432);
define('NCURSES_BUTTON_CTRL', 16777216);
define('NCURSES_BUTTON_ALT', 67108864);
define('NCURSES_ALL_MOUSE_EVENTS', 134217727);
define('NCURSES_REPORT_MOUSE_POSITION', 134217728);

// End of ncurses v.
