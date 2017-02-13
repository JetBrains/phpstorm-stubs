<?php
/**
 * PHPStorm stub file for IMAP, POP3 and NNTP constants.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */

/**
 * silently expunge the mailbox before closing when
 * calling <b>imap_close</b>
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const CL_EXPUNGE = 32768;
/**
 * Delete the messages from the current mailbox after copying
 * with <b>imap_mail_copy</b>
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const CP_MOVE = 2;
/**
 * the sequence numbers contain UIDS
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const CP_UID = 1;
const ENC7BIT = 0;
const ENC8BIT = 1;
const ENCBASE64 = 3;
const ENCBINARY = 2;
const ENCOTHER = 5;
const ENCQUOTEDPRINTABLE = 4;
/**
 * The return string is in internal format, will not canonicalize to CRLF.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const FT_INTERNAL = 8;
const FT_NOT = 4;
/**
 * Do not set the \Seen flag if not already set
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const FT_PEEK = 2;
const FT_PREFETCHTEXT = 32;
/**
 * The parameter is a UID
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const FT_UID = 1;
const IMAP_CLOSETIMEOUT = 4;
/**
 * Garbage collector, clear message cache elements.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const IMAP_GC_ELT = 1;
/**
 * Garbage collector, clear envelopes and bodies.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const IMAP_GC_ENV = 2;
/**
 * Garbage collector, clear texts.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const IMAP_GC_TEXTS = 4;
const IMAP_OPENTIMEOUT = 1;
const IMAP_READTIMEOUT = 2;
const IMAP_WRITETIMEOUT = 3;
const LATT_HASCHILDREN = 32;
const LATT_HASNOCHILDREN = 64;
/**
 * This mailbox is marked. Only used by UW-IMAPD.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const LATT_MARKED = 4;
/**
 * This mailbox has no "children" (there are no
 * mailboxes below this one).
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const LATT_NOINFERIORS = 1;
/**
 * This is only a container, not a mailbox - you
 * cannot open it.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const LATT_NOSELECT = 2;
const LATT_REFERRAL = 16;
/**
 * This mailbox is not marked. Only used by
 * UW-IMAPD.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const LATT_UNMARKED = 8;
const NIL = 0;
/**
 * Don't use or update a .newsrc for news
 * (NNTP only)
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const OP_ANONYMOUS = 4;
const OP_DEBUG = 1;
const OP_EXPUNGE = 128;
/**
 * For IMAP and NNTP
 * names, open a connection but don't open a mailbox.
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const OP_HALFOPEN = 64;
const OP_PROTOTYPE = 32;
/**
 * Open mailbox read-only
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const OP_READONLY = 2;
const OP_SECURE = 256;
const OP_SHORTCACHE = 8;
const OP_SILENT = 16;
const SA_ALL = 31;
const SA_MESSAGES = 1;
const SA_RECENT = 2;
const SA_UIDNEXT = 8;
const SA_UIDVALIDITY = 16;
const SA_UNSEEN = 4;
const SE_FREE = 2;
/**
 * Don't prefetch searched messages
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SE_NOPREFETCH = 4;
/**
 * Return UIDs instead of sequence numbers
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SE_UID = 1;
/**
 * Sort criteria for <b>imap_sort</b>:
 * arrival date
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTARRIVAL = 1;
/**
 * Sort criteria for <b>imap_sort</b>:
 * mailbox in first cc address
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTCC = 5;
/**
 * Sort criteria for <b>imap_sort</b>:
 * message Date
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTDATE = 0;
/**
 * Sort criteria for <b>imap_sort</b>:
 * mailbox in first From address
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTFROM = 2;
/**
 * Sort criteria for <b>imap_sort</b>:
 * size of message in octets
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTSIZE = 6;
/**
 * Sort criteria for <b>imap_sort</b>:
 * message subject
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTSUBJECT = 3;
/**
 * Sort criteria for <b>imap_sort</b>:
 * mailbox in first To address
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const SORTTO = 4;
const SO_FREE = 8;
const SO_NOSERVER = 16;
const ST_SET = 4;
const ST_SILENT = 2;
/**
 * The sequence argument contains UIDs instead of sequence numbers
 *
 * @link http://php.net/manual/en/imap.constants.php
 */
const ST_UID = 1;
const TYPEAPPLICATION = 3;
const TYPEAUDIO = 4;
const TYPEIMAGE = 5;
const TYPEMESSAGE = 2;
const TYPEMODEL = 7;
const TYPEMULTIPART = 1;
const TYPEOTHER = 8;
const TYPETEXT = 0;
const TYPEVIDEO = 6;
