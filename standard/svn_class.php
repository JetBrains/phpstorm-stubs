<?php
/**
 * PHPStorm stub file for SVN classes.
 *
 * @link http://php.net/manual/en/book.svn.php
 */

/**
 * Class Svn
 */
class Svn
{
    const ALL = 16;
    const BASE = -2;
    const COMMITTED = -3;
    const DISCOVER_CHANGED_PATHS = 2;
    const HEAD = -1;
    const IGNORE_EXTERNALS = 128;
    const INITIAL = 1;
    const NON_RECURSIVE = 1;
    const NO_IGNORE = 64;
    const OMIT_MESSAGES = 4;
    const PREV = -4;
    const SHOW_UPDATES = 32;
    const STOP_ON_COPY = 8;
    const UNSPECIFIED = -5;

    /**
     * TODO: write actual short description for add().
     */
    public static function add() { }

    /**
     * TODO: write actual short description for auth_get_parameter().
     */
    public static function auth_get_parameter() { }

    /**
     * TODO: write actual short description for auth_set_parameter().
     */
    public static function auth_set_parameter() { }

    /**
     * TODO: write actual short description for blame().
     */
    public static function blame() { }

    /**
     * TODO: write actual short description for cat().
     */
    public static function cat() { }

    /**
     * TODO: write actual short description for checkout().
     */
    public static function checkout() { }

    /**
     * TODO: write actual short description for cleanup().
     */
    public static function cleanup() { }

    /**
     * TODO: write actual short description for client_version().
     */
    public static function client_version() { }

    /**
     * TODO: write actual short description for commit().
     */
    public static function commit() { }

    /**
     * TODO: write actual short description for config_ensure().
     */
    public static function config_ensure() { }

    /**
     * TODO: write actual short description for copy().
     */
    public static function copy() { }

    /**
     * TODO: write actual short description for delete().
     */
    public static function delete() { }

    /**
     * TODO: write actual short description for diff().
     */
    public static function diff() { }

    /**
     * TODO: write actual short description for export().
     */
    public static function export() { }

    /**
     * TODO: write actual short description for import().
     */
    public static function import() { }

    /**
     * TODO: write actual short description for info().
     */
    public static function info() { }

    /**
     * TODO: write actual short description for lock().
     */
    public static function lock() { }

    /**
     * TODO: write actual short description for log().
     */
    public static function log() { }

    /**
     * TODO: write actual short description for ls().
     */
    public static function ls() { }

    /**
     * TODO: write actual short description for mkdir().
     */
    public static function mkdir() { }

    /**
     * TODO: write actual short description for move().
     */
    public static function move() { }

    /**
     * TODO: write actual short description for prop_delete().
     */
    public static function prop_delete() { }

    /**
     * TODO: write actual short description for propget().
     */
    public static function propget() { }

    /**
     * TODO: write actual short description for proplist().
     */
    public static function proplist() { }

    /**
     * TODO: write actual short description for propset().
     */
    public static function propset() { }

    /**
     * TODO: write actual short description for repos_create().
     */
    public static function repos_create() { }

    /**
     * TODO: write actual short description for repos_fs().
     */
    public static function repos_fs() { }

    /**
     * TODO: write actual short description for repos_fs_begin_txn_for_commit().
     */
    public static function repos_fs_begin_txn_for_commit() { }

    /**
     * TODO: write actual short description for repos_fs_commit_txn().
     */
    public static function repos_fs_commit_txn() { }

    /**
     * TODO: write actual short description for repos_hotcopy().
     */
    public static function repos_hotcopy() { }

    /**
     * TODO: write actual short description for repos_open().
     */
    public static function repos_open() { }

    /**
     * TODO: write actual short description for repos_recover().
     */
    public static function repos_recover() { }

    /**
     * TODO: write actual short description for resolved().
     */
    public static function resolved() { }

    /**
     * TODO: write actual short description for revert().
     */
    public static function revert() { }

    /**
     * TODO: write actual short description for revprop_delete().
     */
    public static function revprop_delete() { }

    /**
     * TODO: write actual short description for revprop_get().
     */
    public static function revprop_get() { }

    /**
     * TODO: write actual short description for revprop_set().
     */
    public static function revprop_set() { }

    /**
     * TODO: write actual short description for status().
     */
    public static function status() { }

    /**
     * TODO: write actual short description for switch().
     */
    public static function switch () { }

    /**
     * TODO: write actual short description for unlock().
     */
    public static function unlock() { }

    /**
     * TODO: write actual short description for update().
     */
    public static function update() { }

    /**
     * TODO: write actual short description for update2().
     */
    public static function update2() { }
}

class SvnNode
{
    const DIR = 2;
    const FILE = 1;
    const NONE = 0;
    const UNKNOWN = 3;
}

/**
 * Class SvnWc
 */
class SvnWc
{
    const ADDED = 4;
    const CONFLICTED = 10;
    const DELETED = 6;
    const EXTERNAL = 13;
    const IGNORED = 11;
    const INCOMPLETE = 14;
    const MERGED = 9;
    const MISSING = 5;
    const MODIFIED = 8;
    const NONE = 1;
    const NORMAL = 3;
    const OBSTRUCTED = 12;
    const REPLACED = 7;
    const UNVERSIONED = 2;
}

/**
 * Class SvnWcSchedule
 */
class SvnWcSchedule
{
    const ADD = 1;
    const DELETE = 2;
    const NORMAL = 0;
    const REPLACE = 3;
}
