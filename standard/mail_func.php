<?php
/**
 * PHPStorm stub file for Mail functions.
 *
 * @link http://php.net/manual/en/book.mail.php
 */

/**
 * Calculate the hash value needed by EZMLM
 *
 * @link  http://php.net/manual/en/function.ezmlm-hash.php
 *
 * @param string $addr <p>
 *                     The email address that's being hashed.
 *                     </p>
 *
 * @return int The hash value of addr.
 * @since 5.0
 */
function ezmlm_hash($addr) { }

/**
 * Send mail
 *
 * @link  http://php.net/manual/en/function.mail.php
 *
 * @param string $to                    <p>
 *                                      Receiver, or receivers of the mail.
 *                                      </p>
 *                                      <p>
 *                                      The formatting of this string must comply with
 *                                      RFC 2822. Some examples are:
 *                                      user@example.com
 *                                      user@example.com, anotheruser@example.com
 *                                      User &lt;user@example.com&gt;
 *                                      User &lt;user@example.com&gt;, Another User &lt;anotheruser@example.com&gt;
 *                                      </p>
 * @param string $subject               <p>
 *                                      Subject of the email to be sent.
 *                                      </p>
 *                                      <p>
 *                                      Subject must satisfy RFC 2047.
 *                                      </p>
 * @param string $message               <p>
 *                                      Message to be sent.
 *                                      </p>
 *                                      <p>
 *                                      Each line should be separated with a LF (\n). Lines should not be larger
 *                                      than 70 characters.
 *                                      </p>
 *                                      <p>
 *                                      (Windows only) When PHP is talking to a SMTP server directly, if a full
 *                                      stop is found on the start of a line, it is removed. To counter-act this,
 *                                      replace these occurrences with a double dot.
 *                                      ]]>
 *                                      </p>
 * @param string $additional_headers    [optional] <p>
 *                                      String to be inserted at the end of the email header.
 *                                      </p>
 *                                      <p>
 *                                      This is typically used to add extra headers (From, Cc, and Bcc).
 *                                      Multiple extra headers should be separated with a CRLF (\r\n).
 *                                      </p>
 *                                      <p>
 *                                      When sending mail, the mail must contain
 *                                      a From header. This can be set with the
 *                                      additional_headers parameter, or a default
 *                                      can be set in &php.ini;.
 *                                      </p>
 *                                      <p>
 *                                      Failing to do this will result in an error
 *                                      message similar to Warning: mail(): "sendmail_from" not
 *                                      set in php.ini or custom "From:" header missing.
 *                                      The From header sets also
 *                                      Return-Path under Windows.
 *                                      </p>
 *                                      <p>
 *                                      If messages are not received, try using a LF (\n) only.
 *                                      Some poor quality Unix mail transfer agents replace LF by CRLF
 *                                      automatically (which leads to doubling CR if CRLF is used).
 *                                      This should be a last resort, as it does not comply with
 *                                      RFC 2822.
 *                                      </p>
 * @param string $additional_parameters [optional] <p>
 *                                      The additional_parameters parameter
 *                                      can be used to pass additional flags as command line options to the
 *                                      program configured to be used when sending mail, as defined by the
 *                                      sendmail_path configuration setting. For example,
 *                                      this can be used to set the envelope sender address when using
 *                                      sendmail with the -f sendmail option.
 *                                      </p>
 *                                      <p>
 *                                      The user that the webserver runs as should be added as a trusted user to the
 *                                      sendmail configuration to prevent a 'X-Warning' header from being added
 *                                      to the message when the envelope sender (-f) is set using this method.
 *                                      For sendmail users, this file is /etc/mail/trusted-users.
 *                                      </p>
 *
 * @return bool true if the mail was successfully accepted for delivery, false otherwise.
 * </p>
 * <p>
 * It is important to note that just because the mail was accepted for delivery,
 * it does NOT mean the mail will actually reach the intended destination.
 * @since 5.0
 */
function mail($to, $subject, $message, $additional_headers = null, $additional_parameters = null) { }
