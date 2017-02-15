<?php
/**
 * PHPStorm stub file for Network functions.
 *
 * @link http://php.net/manual/en/book.network.php
 */

/**
 * Check DNS records corresponding to a given Internet host name or IP address
 *
 * @link  http://php.net/manual/en/function.checkdnsrr.php
 *
 * @param string $host <p>
 *                     host may either be the IP address in
 *                     dotted-quad notation or the host name.
 *                     </p>
 * @param string $type [optional] <p>
 *                     type may be any one of: A, MX, NS, SOA,
 *                     PTR, CNAME, AAAA, A6, SRV, NAPTR, TXT or ANY.
 *                     </p>
 *
 * @return bool true if any records are found; returns false if no records
 * were found or if an error occurred.
 * @since 4.0
 * @since 5.0
 */
function checkdnsrr($host, $type = null) { }

/**
 * Close connection to system logger
 *
 * @link  http://php.net/manual/en/function.closelog.php
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function closelog() { }

/**
 * Initializes all syslog related variables
 *
 * @link       http://php.net/manual/en/function.define-syslog-variables.php
 * @deprecated 5.3
 * @return void
 * @since      4.0
 * @since      5.0
 */
function define_syslog_variables() { }

/**
 * &Alias; <function>checkdnsrr</function>
 *
 * @link  http://php.net/manual/en/function.dns-check-record.php
 *
 * @param $host <p>
 *              <b>host</b> may either be the IP address in
 *              dotted-quad notation or the host name.
 *              </p>
 * @param $type [optional] <p>
 *              <b>type</b> may be any one of: A, MX, NS, SOA,
 *              PTR, CNAME, AAAA, A6, SRV, NAPTR, TXT or ANY.
 *              </p>
 *
 * @return bool Returns <b>TRUE</b> if any records are found; returns <b>FALSE</b> if no records were found or if
 *              an error occurred.
 * @since 5.0
 */
function dns_check_record($host, $type) { }

/**
 * &Alias; <function>getmxrr</function>
 *
 * @link  http://php.net/manual/en/function.dns-get-mx.php
 *
 * @param $hostname
 * @param $mxhosts
 * @param $weight [optional]
 *
 * @since 5.0
 */
function dns_get_mx($hostname, &$mxhosts, &$weight) { }

/**
 * Fetch DNS Resource Records associated with a hostname
 *
 * @link  http://php.net/manual/en/function.dns-get-record.php
 *
 * @param string $hostname <p>
 *                         hostname should be a valid DNS hostname such
 *                         as "www.example.com". Reverse lookups can be generated
 *                         using in-addr.arpa notation, but
 *                         gethostbyaddr is more suitable for
 *                         the majority of reverse lookups.
 *                         </p>
 *                         <p>
 *                         Per DNS standards, email addresses are given in user.host format (for
 *                         example: hostmaster.example.com as opposed to hostmaster@example.com),
 *                         be sure to check this value and modify if necessary before using it
 *                         with a functions such as mail.
 *                         </p>
 * @param int    $type     [optional] <p>
 *                         By default, dns_get_record will search for any
 *                         resource records associated with hostname.
 *                         To limit the query, specify the optional type
 *                         parameter. May be any one of the following:
 *                         DNS_A, DNS_CNAME,
 *                         DNS_HINFO, DNS_MX,
 *                         DNS_NS, DNS_PTR,
 *                         DNS_SOA, DNS_TXT,
 *                         DNS_AAAA, DNS_SRV,
 *                         DNS_NAPTR, DNS_A6,
 *                         DNS_ALL or DNS_ANY.
 *                         </p>
 *                         <p>
 *                         Because of eccentricities in the performance of libresolv
 *                         between platforms, DNS_ANY will not
 *                         always return every record, the slower DNS_ALL
 *                         will collect all records more reliably.
 *                         </p>
 * @param array  $authns   [optional] <p>
 *                         Passed by reference and, if given, will be populated with Resource
 *                         Records for the Authoritative Name Servers.
 *                         </p>
 * @param array  $addtl    [optional] <p>
 *                         Passed by reference and, if given, will be populated with any
 *                         Additional Records.
 *                         </p>
 * @param bool   $raw      [optional] <p>
 *                         In case of raw mode, we query only the requested type
 *                         instead of looping type by type before going with the additional info stuff.
 *                         </p>
 *
 * @return array This function returns an array of associative arrays. Each associative array contains
 * at minimum the following keys:
 * <table>
 * Basic DNS attributes
 * <tr valign="top">
 * <td>Attribute</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td>host</td>
 * <td>
 * The record in the DNS namespace to which the rest of the associated data refers.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>class</td>
 * <td>
 * dns_get_record only returns Internet class records and as
 * such this parameter will always return IN.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>type</td>
 * <td>
 * String containing the record type. Additional attributes will also be contained
 * in the resulting array dependant on the value of type. See table below.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>ttl</td>
 * <td>
 * "Time To Live" remaining for this record. This will not equal
 * the record's original ttl, but will rather equal the original ttl minus whatever
 * length of time has passed since the authoritative name server was queried.
 * </td>
 * </tr>
 * </table>
 * </p>
 * <p>
 * <table>
 * Other keys in associative arrays dependant on 'type'
 * <tr valign="top">
 * <td>Type</td>
 * <td>Extra Columns</td>
 * </tr>
 * <tr valign="top">
 * <td>A</td>
 * <td>
 * ip: An IPv4 addresses in dotted decimal notation.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>MX</td>
 * <td>
 * pri: Priority of mail exchanger.
 * Lower numbers indicate greater priority.
 * target: FQDN of the mail exchanger.
 * See also dns_get_mx.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>CNAME</td>
 * <td>
 * target: FQDN of location in DNS namespace to which
 * the record is aliased.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>NS</td>
 * <td>
 * target: FQDN of the name server which is authoritative
 * for this hostname.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>PTR</td>
 * <td>
 * target: Location within the DNS namespace to which
 * this record points.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>TXT</td>
 * <td>
 * txt: Arbitrary string data associated with this record.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>HINFO</td>
 * <td>
 * cpu: IANA number designating the CPU of the machine
 * referenced by this record.
 * os: IANA number designating the Operating System on
 * the machine referenced by this record.
 * See IANA's Operating System
 * Names for the meaning of these values.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>SOA</td>
 * <td>
 * mname: FQDN of the machine from which the resource
 * records originated.
 * rname: Email address of the administrative contain
 * for this domain.
 * serial: Serial # of this revision of the requested
 * domain.
 * refresh: Refresh interval (seconds) secondary name
 * servers should use when updating remote copies of this domain.
 * retry: Length of time (seconds) to wait after a
 * failed refresh before making a second attempt.
 * expire: Maximum length of time (seconds) a secondary
 * DNS server should retain remote copies of the zone data without a
 * successful refresh before discarding.
 * minimum-ttl: Minimum length of time (seconds) a
 * client can continue to use a DNS resolution before it should request
 * a new resolution from the server. Can be overridden by individual
 * resource records.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>AAAA</td>
 * <td>
 * ipv6: IPv6 address
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>A6(PHP &gt;= 5.1.0)</td>
 * <td>
 * masklen: Length (in bits) to inherit from the target
 * specified by chain.
 * ipv6: Address for this specific record to merge with
 * chain.
 * chain: Parent record to merge with
 * ipv6 data.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>SRV</td>
 * <td>
 * pri: (Priority) lowest priorities should be used first.
 * weight: Ranking to weight which of commonly prioritized
 * targets should be chosen at random.
 * target and port: hostname and port
 * where the requested service can be found.
 * For additional information see: RFC 2782
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>NAPTR</td>
 * <td>
 * order and pref: Equivalent to
 * pri and weight above.
 * flags, services, regex,
 * and replacement: Parameters as defined by
 * RFC 2915.
 * </td>
 * </tr>
 * </table>
 * @since 5.0
 */
function dns_get_record($hostname, $type = null, array &$authns = null, array &$addtl = null, &$raw = false) { }

/**
 * Open Internet or Unix domain socket connection
 *
 * @link  http://php.net/manual/en/function.fsockopen.php
 *
 * @param string $hostname <p>
 *                         If you have compiled in OpenSSL support, you may prefix the
 *                         hostname with either ssl://
 *                         or tls:// to use an SSL or TLS client connection
 *                         over TCP/IP to connect to the remote host.
 *                         </p>
 * @param int    $port     [optional] <p>
 *                         The port number.
 *                         </p>
 * @param int    $errno    [optional] <p>
 *                         If provided, holds the system level error number that occurred in the
 *                         system-level connect() call.
 *                         </p>
 *                         <p>
 *                         If the value returned in errno is
 *                         0 and the function returned false, it is an
 *                         indication that the error occurred before the
 *                         connect() call. This is most likely due to a
 *                         problem initializing the socket.
 *                         </p>
 * @param string $errstr   [optional] <p>
 *                         The error message as a string.
 *                         </p>
 * @param float  $timeout  [optional] <p>
 *                         The connection timeout, in seconds.
 *                         </p>
 *                         <p>
 *                         If you need to set a timeout for reading/writing data over the
 *                         socket, use stream_set_timeout, as the
 *                         timeout parameter to
 *                         fsockopen only applies while connecting the
 *                         socket.
 *                         </p>
 *
 * @return resource fsockopen returns a file pointer which may be used
 * together with the other file functions (such as
 * fgets, fgetss,
 * fwrite, fclose, and
 * feof). If the call fails, it will return false
 * @since 4.0
 * @since 5.0
 */
function fsockopen($hostname, $port = null, &$errno = null, &$errstr = null, $timeout = null) { }

/**
 * Get the Internet host name corresponding to a given IP address
 *
 * @link  http://php.net/manual/en/function.gethostbyaddr.php
 *
 * @param string $ip_address <p>
 *                           The host IP address.
 *                           </p>
 *
 * @return string the host name or the unmodified ip_address
 * on failure.
 * @since 4.0
 * @since 5.0
 */
function gethostbyaddr($ip_address) { }

/**
 * Get the IPv4 address corresponding to a given Internet host name
 *
 * @link  http://php.net/manual/en/function.gethostbyname.php
 *
 * @param string $hostname <p>
 *                         The host name.
 *                         </p>
 *
 * @return string the IPv4 address or a string containing the unmodified
 * hostname on failure.
 * @since 4.0
 * @since 5.0
 */
function gethostbyname($hostname) { }

/**
 * Get a list of IPv4 addresses corresponding to a given Internet host
 *
 * @since 4.0
 * @since 5.0
 * name
 * @link  http://php.net/manual/en/function.gethostbynamel.php
 *
 * @param string $hostname <p>
 *                         The host name.
 *                         </p>
 *
 * @return array an array of IPv4 addresses or false if
 * hostname could not be resolved.
 */
function gethostbynamel($hostname) { }

/**
 * Gets the host name
 *
 * @link  http://php.net/manual/en/function.gethostname.php
 * @return string a string with the hostname on success, otherwise false is
 * returned.
 * @since 5.3.0
 */
function gethostname() { }

/**
 * Get MX records corresponding to a given Internet host name
 *
 * @link  http://php.net/manual/en/function.getmxrr.php
 *
 * @param string $hostname <p>
 *                         The Internet host name.
 *                         </p>
 * @param array  $mxhosts  <p>
 *                         A list of the MX records found is placed into the array
 *                         mxhosts.
 *                         </p>
 * @param array  $weight   [optional] <p>
 *                         If the weight array is given, it will be filled
 *                         with the weight information gathered.
 *                         </p>
 *
 * @return bool true if any records are found; returns false if no records
 * were found or if an error occurred.
 * @since 4.0
 * @since 5.0
 */
function getmxrr($hostname, array &$mxhosts, array &$weight = null) { }

/**
 * Get protocol number associated with protocol name
 *
 * @link  http://php.net/manual/en/function.getprotobyname.php
 *
 * @param string $name <p>
 *                     The protocol name.
 *                     </p>
 *
 * @return int the protocol number or -1 if the protocol is not found.
 * @since 4.0
 * @since 5.0
 */
function getprotobyname($name) { }

/**
 * Get protocol name associated with protocol number
 *
 * @link  http://php.net/manual/en/function.getprotobynumber.php
 *
 * @param int $number <p>
 *                    The protocol number.
 *                    </p>
 *
 * @return string the protocol name as a string.
 * @since 4.0
 * @since 5.0
 */
function getprotobynumber($number) { }

/**
 * Get port number associated with an Internet service and protocol
 *
 * @link  http://php.net/manual/en/function.getservbyname.php
 *
 * @param string $service  <p>
 *                         The Internet service name, as a string.
 *                         </p>
 * @param string $protocol <p>
 *                         protocol is either "tcp"
 *                         or "udp" (in lowercase).
 *                         </p>
 *
 * @return int the port number, or false if service or
 * protocol is not found.
 * @since 4.0
 * @since 5.0
 */
function getservbyname($service, $protocol) { }

/**
 * Get Internet service which corresponds to port and protocol
 *
 * @link  http://php.net/manual/en/function.getservbyport.php
 *
 * @param int    $port     <p>
 *                         The port number.
 *                         </p>
 * @param string $protocol <p>
 *                         protocol is either "tcp"
 *                         or "udp" (in lowercase).
 *                         </p>
 *
 * @return string the Internet service name as a string.
 * @since 4.0
 * @since 5.0
 */
function getservbyport($port, $protocol) { }

/**
 * Send a raw HTTP header
 *
 * @link  http://php.net/manual/en/function.header.php
 *
 * @param string $string             <p>
 *                                   The header string.
 *                                   </p>
 *                                   <p>
 *                                   There are two special-case header calls. The first is a header
 *                                   that starts with the string "HTTP/" (case is not
 *                                   significant), which will be used to figure out the HTTP status
 *                                   code to send. For example, if you have configured Apache to
 *                                   use a PHP script to handle requests for missing files (using
 *                                   the ErrorDocument directive), you may want to
 *                                   make sure that your script generates the proper status code.
 *                                   </p>
 *                                   <p>
 *                                   ]]>
 *                                   </p>
 *                                   <p>
 *                                   The second special case is the "Location:" header. Not only does
 *                                   it send this header back to the browser, but it also returns a
 *                                   REDIRECT (302) status code to the browser
 *                                   unless the 201 or
 *                                   a 3xx status code has already been set.
 *                                   </p>
 *                                   <p>
 *                                   ]]>
 *                                   </p>
 * @param bool   $replace            [optional] <p>
 *                                   The optional replace parameter indicates
 *                                   whether the header should replace a previous similar header, or
 *                                   add a second header of the same type. By default it will replace,
 *                                   but if you pass in false as the second argument you can force
 *                                   multiple headers of the same type. For example:
 *                                   </p>
 *                                   <p>
 *                                   ]]>
 *                                   </p>
 * @param int    $http_response_code [optional] <p>
 *                                   Forces the HTTP response code to the specified value.
 *                                   </p>
 *
 * @return void
 * @since 4.0
 * @since 5.0
 */
function header($string, $replace = true, $http_response_code = null) { }

/**
 * Registers a function that will be called when PHP starts sending output.
 * The callback is executed just after PHP prepares all headers to be sent,<br>
 * and before any other output is sent, creating a window to manipulate the outgoing headers before being sent.
 *
 * @link  http://www.php.net/manual/en/function.header-register-callback.php
 *
 * @param callable $callback Function called just before the headers are sent.
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function header_register_callback(callable $callback) { }

/**
 * Remove previously set headers
 *
 * @link  http://php.net/manual/en/function.header-remove.php
 *
 * @param string $name [optional] <p>
 *                     The header name to be removed.
 *                     </p>
 *                     This parameter is case-insensitive.
 *
 * @return void
 * @since 5.3.0
 */
function header_remove($name = null) { }

/**
 * Returns a list of response headers sent (or ready to send)
 *
 * @link  http://php.net/manual/en/function.headers-list.php
 * @return array a numerically indexed array of headers.
 * @since 5.0
 */
function headers_list() { }

/**
 * Checks if or where headers have been sent
 *
 * @link  http://php.net/manual/en/function.headers-sent.php
 *
 * @param string $file [optional] <p>
 *                     If the optional file and
 *                     line parameters are set,
 *                     headers_sent will put the PHP source file name
 *                     and line number where output started in the file
 *                     and line variables.
 *                     </p>
 * @param int    $line [optional] <p>
 *                     The line number where the output started.
 *                     </p>
 *
 * @return bool headers_sent will return false if no HTTP headers
 * have already been sent or true otherwise.
 * @since 4.0
 * @since 5.0
 */
function headers_sent(&$file = null, &$line = null) { }

/**
 * Get or Set the HTTP response code
 *
 * @param int $response_code [optional] The optional response_code will set the response code.
 *
 * @return int The current response code. By default the return value is int(200).
 */
function http_response_code($response_code) { }

/**
 * Converts a packed internet address to a human readable representation
 *
 * @link  http://php.net/manual/en/function.inet-ntop.php
 *
 * @param string $in_addr <p>
 *                        A 32bit IPv4, or 128bit IPv6 address.
 *                        </p>
 *
 * @return string|false a string representation of the address or false on failure.
 * @since 5.1.0
 */
function inet_ntop($in_addr) { }

/**
 * Converts a human readable IP address to its packed in_addr representation
 *
 * @link  http://php.net/manual/en/function.inet-pton.php
 *
 * @param string $address <p>
 *                        A human readable IPv4 or IPv6 address.
 *                        </p>
 *
 * @return string the in_addr representation of the given
 * address
 * @since 5.1.0
 */
function inet_pton($address) { }

/**
 * Converts a string containing an (IPv4) Internet Protocol dotted address into a proper address
 *
 * @link  http://php.net/manual/en/function.ip2long.php
 *
 * @param string $ip_address <p>
 *                           A standard format address.
 *                           </p>
 *
 * @return int the IPv4 address or false if ip_address
 * is invalid.
 * @since 4.0
 * @since 5.0
 */
function ip2long($ip_address) { }

/**
 * Converts an (IPv4) Internet network address into a string in Internet standard dotted format
 *
 * @link  http://php.net/manual/en/function.long2ip.php
 *
 * @param string|int $proper_address <p>
 *                                   A proper address representation.
 *                                   </p>
 *
 * @return string the Internet IP address as a string.
 * @since 4.0
 * @since 5.0
 */
function long2ip($proper_address) { }

/**
 * Open connection to system logger
 *
 * @link  http://php.net/manual/en/function.openlog.php
 *
 * @param string $ident    <p>
 *                         The string ident is added to each message.
 *                         </p>
 * @param int    $option   <p>
 *                         The option argument is used to indicate
 *                         what logging options will be used when generating a log message.
 *                         <table>
 *                         openlog Options
 *                         <tr valign="top">
 *                         <td>Constant</td>
 *                         <td>Description</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_CONS</td>
 *                         <td>
 *                         if there is an error while sending data to the system logger,
 *                         write directly to the system console
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_NDELAY</td>
 *                         <td>
 *                         open the connection to the logger immediately
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_ODELAY</td>
 *                         <td>
 *                         (default) delay opening the connection until the first
 *                         message is logged
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_PERROR</td>
 *                         <td>print log message also to standard error</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_PID</td>
 *                         <td>include PID with each message</td>
 *                         </tr>
 *                         </table>
 *                         You can use one or more of this options. When using multiple options
 *                         you need to OR them, i.e. to open the connection
 *                         immediately, write to the console and include the PID in each message,
 *                         you will use: LOG_CONS | LOG_NDELAY | LOG_PID
 *                         </p>
 * @param int    $facility <p>
 *                         The facility argument is used to specify what
 *                         type of program is logging the message. This allows you to specify
 *                         (in your machine's syslog configuration) how messages coming from
 *                         different facilities will be handled.
 *                         <table>
 *                         openlog Facilities
 *                         <tr valign="top">
 *                         <td>Constant</td>
 *                         <td>Description</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_AUTH</td>
 *                         <td>
 *                         security/authorization messages (use
 *                         LOG_AUTHPRIV instead
 *                         in systems where that constant is defined)
 *                         </td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_AUTHPRIV</td>
 *                         <td>security/authorization messages (private)</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_CRON</td>
 *                         <td>clock daemon (cron and at)</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_DAEMON</td>
 *                         <td>other system daemons</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_KERN</td>
 *                         <td>kernel messages</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_LOCAL0 ... LOG_LOCAL7</td>
 *                         <td>reserved for local use, these are not available in Windows</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_LPR</td>
 *                         <td>line printer subsystem</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_MAIL</td>
 *                         <td>mail subsystem</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_NEWS</td>
 *                         <td>USENET news subsystem</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_SYSLOG</td>
 *                         <td>messages generated internally by syslogd</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_USER</td>
 *                         <td>generic user-level messages</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_UUCP</td>
 *                         <td>UUCP subsystem</td>
 *                         </tr>
 *                         </table>
 *                         </p>
 *                         <p>
 *                         LOG_USER is the only valid log type under Windows
 *                         operating systems
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function openlog($ident, $option, $facility) { }

/**
 * Open persistent Internet or Unix domain socket connection
 *
 * @link  http://php.net/manual/en/function.pfsockopen.php
 *
 * @param string $hostname
 * @param int    $port    [optional]
 * @param int    $errno   [optional]
 * @param string $errstr  [optional]
 * @param float  $timeout [optional]
 *
 * @return resource
 * @since 4.0
 * @since 5.0
 */
function pfsockopen($hostname, $port = null, &$errno = null, &$errstr = null, $timeout = null) { }

/**
 * Send a cookie
 *
 * @link  http://php.net/manual/en/function.setcookie.php
 *
 * @param string $name     <p>
 *                         The name of the cookie.
 *                         </p>
 * @param string $value    [optional] <p>
 *                         The value of the cookie. This value is stored on the clients
 *                         computer; do not store sensitive information.
 *                         Assuming the name is 'cookiename', this
 *                         value is retrieved through $_COOKIE['cookiename']
 *                         </p>
 * @param int    $expire   [optional] <p>
 *                         The time the cookie expires. This is a Unix timestamp so is
 *                         in number of seconds since the epoch. In other words, you'll
 *                         most likely set this with the time function
 *                         plus the number of seconds before you want it to expire. Or
 *                         you might use mktime.
 *                         time()+60*60*24*30 will set the cookie to
 *                         expire in 30 days. If set to 0, or omitted, the cookie will expire at
 *                         the end of the session (when the browser closes).
 *                         </p>
 *                         <p>
 *                         <p>
 *                         You may notice the expire parameter takes on a
 *                         Unix timestamp, as opposed to the date format Wdy, DD-Mon-YYYY
 *                         HH:MM:SS GMT, this is because PHP does this conversion
 *                         internally.
 *                         </p>
 *                         <p>
 *                         expire is compared to the client's time which can
 *                         differ from server's time.
 *                         </p>
 *                         </p>
 * @param string $path     [optional] <p>
 *                         The path on the server in which the cookie will be available on.
 *                         If set to '/', the cookie will be available
 *                         within the entire domain. If set to
 *                         '/foo/', the cookie will only be available
 *                         within the /foo/ directory and all
 *                         sub-directories such as /foo/bar/ of
 *                         domain. The default value is the
 *                         current directory that the cookie is being set in.
 *                         </p>
 * @param string $domain   [optional] <p>
 *                         The domain that the cookie is available.
 *                         To make the cookie available on all subdomains of example.com
 *                         then you'd set it to '.example.com'. The
 *                         . is not required but makes it compatible
 *                         with more browsers. Setting it to www.example.com
 *                         will make the cookie only available in the www
 *                         subdomain. Refer to tail matching in the
 *                         spec for details.
 *                         </p>
 * @param bool   $secure   [optional] <p>
 *                         Indicates that the cookie should only be transmitted over a
 *                         secure HTTPS connection from the client. When set to true, the
 *                         cookie will only be set if a secure connection exists.
 *                         On the server-side, it's on the programmer to send this
 *                         kind of cookie only on secure connection (e.g. with respect to
 *                         $_SERVER["HTTPS"]).
 *                         </p>
 * @param bool   $httponly [optional] <p>
 *                         When true the cookie will be made accessible only through the HTTP
 *                         protocol. This means that the cookie won't be accessible by
 *                         scripting languages, such as JavaScript. This setting can effectively
 *                         help to reduce identity theft through XSS attacks (although it is
 *                         not supported by all browsers). Added in PHP 5.2.0.
 *                         true or false
 *                         </p>
 *
 * @return bool If output exists prior to calling this function,
 * setcookie will fail and return false. If
 * setcookie successfully runs, it will return true.
 * This does not indicate whether the user accepted the cookie.
 * @since 4.0
 * @since 5.0
 */
function setcookie(
    $name,
    $value = null,
    $expire = null,
    $path = null,
    $domain = null,
    $secure = null,
    $httponly = null
) {
}

/**
 * Send a cookie without urlencoding the cookie value
 *
 * @link  http://php.net/manual/en/function.setrawcookie.php
 *
 * @param string $name
 * @param string $value    [optional]
 * @param int    $expire   [optional]
 * @param string $path     [optional]
 * @param string $domain   [optional]
 * @param bool   $secure   [optional]
 * @param bool   $httponly [optional]
 *
 * @return bool true on success or false on failure.
 * @since 5.0
 */
function setrawcookie(
    $name,
    $value = null,
    $expire = null,
    $path = null,
    $domain = null,
    $secure = null,
    $httponly = null
) {
}

/**
 * &Alias; <function>stream_get_meta_data</function>
 * Retrieves header/meta data from streams/file pointers
 *
 * @link  http://php.net/manual/en/function.socket-get-status.php
 *
 * @param resource $stream <p>
 *                         The stream can be any stream created by fopen,
 *                         fsockopen and pfsockopen.
 *                         </p>
 *
 * @return array The result array contains the following items:
 * </p>
 * <p>
 * timed_out (bool) - true if the stream
 * timed out while waiting for data on the last call to
 * fread or fgets.
 * </p>
 * <p>
 * blocked (bool) - true if the stream is
 * in blocking IO mode. See stream_set_blocking.
 * </p>
 * <p>
 * eof (bool) - true if the stream has reached
 * end-of-file. Note that for socket streams this member can be true
 * even when unread_bytes is non-zero. To
 * determine if there is more data to be read, use
 * feof instead of reading this item.
 * </p>
 * <p>
 * unread_bytes (int) - the number of bytes
 * currently contained in the PHP's own internal buffer.
 * </p>
 * You shouldn't use this value in a script.
 * <p>
 * stream_type (string) - a label describing
 * the underlying implementation of the stream.
 * </p>
 * <p>
 * wrapper_type (string) - a label describing
 * the protocol wrapper implementation layered over the stream.
 * See for more information about wrappers.
 * </p>
 * <p>
 * wrapper_data (mixed) - wrapper specific
 * data attached to this stream. See for
 * more information about wrappers and their wrapper data.
 * </p>
 * <p>
 * filters (array) - and array containing
 * the names of any filters that have been stacked onto this stream.
 * Documentation on filters can be found in the
 * Filters appendix.
 * </p>
 * <p>
 * mode (string) - the type of access required for
 * this stream (see Table 1 of the fopen() reference)
 * </p>
 * <p>
 * seekable (bool) - whether the current stream can
 * be seeked.
 * </p>
 * <p>
 * uri (string) - the URI/filename associated with this
 * stream.
 * @since 4.3.0
 * @since 5.0
 */
function socket_get_status(resource $stream) { }

/**
 * &Alias; <function>stream_set_blocking</function>
 *
 * @link  http://php.net/manual/en/function.socket-set-blocking.php
 *
 * @param resource $socket <p>
 *                         The stream.
 *                         </p>
 * @param int      $mode   <p>
 *                         If mode is 0, the given stream
 *                         will be switched to non-blocking mode, and if 1, it
 *                         will be switched to blocking mode. This affects calls like
 *                         fgets and fread
 *                         that read from the stream. In non-blocking mode an
 *                         fgets call will always return right away
 *                         while in blocking mode it will wait for data to become available
 *                         on the stream.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function socket_set_blocking($socket, $mode) { }

/**
 * &Alias; <function>stream_set_timeout</function>
 * <p>Set timeout period on a stream
 *
 * @link  http://php.net/manual/en/function.socket-set-timeout.php
 *
 * @param resource $stream       <p>
 *                               The target stream.
 *                               </p>
 * @param int      $seconds      <p>
 *                               The seconds part of the timeout to be set.
 *                               </p>
 * @param int      $microseconds [optional] <p>
 *                               The microseconds part of the timeout to be set.
 *                               </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function socket_set_timeout($stream, $seconds, $microseconds = 0) { }

/**
 * Generate a system log message
 *
 * @link  http://php.net/manual/en/function.syslog.php
 *
 * @param int    $priority <p>
 *                         priority is a combination of the facility and
 *                         the level. Possible values are:
 *                         <table>
 *                         syslog Priorities (in descending order)
 *                         <tr valign="top">
 *                         <td>Constant</td>
 *                         <td>Description</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_EMERG</td>
 *                         <td>system is unusable</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_ALERT</td>
 *                         <td>action must be taken immediately</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_CRIT</td>
 *                         <td>critical conditions</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_ERR</td>
 *                         <td>error conditions</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_WARNING</td>
 *                         <td>warning conditions</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_NOTICE</td>
 *                         <td>normal, but significant, condition</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_INFO</td>
 *                         <td>informational message</td>
 *                         </tr>
 *                         <tr valign="top">
 *                         <td>LOG_DEBUG</td>
 *                         <td>debug-level message</td>
 *                         </tr>
 *                         </table>
 *                         </p>
 * @param string $message  <p>
 *                         The message to send, except that the two characters
 *                         %m will be replaced by the error message string
 *                         (strerror) corresponding to the present value of
 *                         errno.
 *                         </p>
 *
 * @return bool true on success or false on failure.
 * @since 4.0
 * @since 5.0
 */
function syslog($priority, $message) { }
