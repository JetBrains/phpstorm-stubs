<?php

// Start of openssl v.

/**
 * Frees a private key
 * @link https://php.net/manual/en/function.openssl-pkey-free.php
 * @param resource $key <p>
 * Resource holding the key.
 * </p>
 * @return void
 * @since 4.2.0
 * @since 5.0
 */
function openssl_pkey_free($key) { }

/**
 * Generates a new private key
 * @link https://php.net/manual/en/function.openssl-pkey-new.php
 * @param array $configargs [optional] <p>
 * You can finetune the key generation (such as specifying the number of
 * bits) using <i>configargs</i>. See
 * <b>openssl_csr_new</b> for more information about
 * <i>configargs</i>.
 * </p>
 * @return resource|false a resource identifier for the pkey on success, or false on
 * error.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_pkey_new(array $configargs = null) { }

/**
 * Gets an exportable representation of a key into a string
 * @link https://php.net/manual/en/function.openssl-pkey-export.php
 * @param mixed $key
 * @param string $out
 * @param string $passphrase [optional] <p>
 * The key is optionally protected by <i>passphrase</i>.
 * </p>
 * @param array $configargs [optional] <p>
 * <i>configargs</i> can be used to fine-tune the export
 * process by specifying and/or overriding options for the openssl
 * configuration file. See <b>openssl_csr_new</b> for more
 * information about <i>configargs</i>.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_pkey_export($key, &$out, $passphrase = null, array $configargs = null) { }

/**
 * Gets an exportable representation of a key into a file
 * @link https://php.net/manual/en/function.openssl-pkey-export-to-file.php
 * @param mixed $key
 * @param string $outfilename <p>
 * Path to the output file.
 * </p>
 * @param string $passphrase [optional] <p>
 * The key can be optionally protected by a
 * <i>passphrase</i>.
 * </p>
 * @param array $configargs [optional] <p>
 * <i>configargs</i> can be used to fine-tune the export
 * process by specifying and/or overriding options for the openssl
 * configuration file. See <b>openssl_csr_new</b> for more
 * information about <i>configargs</i>.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_pkey_export_to_file($key, $outfilename, $passphrase = null, array $configargs = null) { }

/**
 * Get a private key
 * @link https://php.net/manual/en/function.openssl-pkey-get-private.php
 * @param $key
 * <p>
 * <b><em>key</em></b> can be one of the following:
 * <ol>
 * <li>a string having the format
 * <var>file://path/to/file.pem</var>. The named file must
 * contain a PEM encoded certificate/private key (it may contain both).
 * </li>
 * <li>A PEM formatted private key.</li>
 * </ol></p>
 * @param $passphrase [optional] <p>
 * The optional parameter <b><em>passphrase</em></b> must be used
 * if the specified key is encrypted (protected by a passphrase).
 * </p>
 * @return resource|false Returns a positive key resource identifier on success, or <b>FALSE</b> on error.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_pkey_get_private($key, $passphrase = "") { }

/**
 * Extract public key from certificate and prepare it for use
 * @link https://php.net/manual/en/function.openssl-pkey-get-public.php
 * @param mixed $certificate <p><em><b>certificate</b></em> can be one of the following:
 * <ol>
 * <li>an X.509 certificate resource</li>
 * <li>a string having the format
 * <var>file://path/to/file.pem</var>. The named file must
 * contain a PEM encoded certificate/public key (it may contain both).
 * </span>
 * </li>
 * <li>A PEM formatted public key.</li>
 * </ol></p>
 * @return resource|false a positive key resource identifier on success, or false on error.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_pkey_get_public($certificate) { }

/**
 * Returns an array with the key details
 * @link https://php.net/manual/en/function.openssl-pkey-get-details.php
 * @param resource $key <p>
 * Resource holding the key.
 * </p>
 * @return array|false an array with the key details in success or false in failure.
 * Returned array has indexes bits (number of bits),
 * key (string representation of the public key) and
 * type (type of the key which is one of
 * <b>OPENSSL_KEYTYPE_RSA</b>,
 * <b>OPENSSL_KEYTYPE_DSA</b>,
 * <b>OPENSSL_KEYTYPE_DH</b>,
 * <b>OPENSSL_KEYTYPE_EC</b> or -1 meaning unknown).
 * </p>
 * <p>
 * Depending on the key type used, additional details may be returned. Note that
 * some elements may not always be available.
 * @since 5.2.0
 */
function openssl_pkey_get_details($key) { }

/**
 * Free key resource
 * @link https://php.net/manual/en/function.openssl-free-key.php
 * @param resource $key_identifier
 * @return void
 * @since 4.0.4
 * @since 5.0
 */
function openssl_free_key($key_identifier) { }

/**
 * Alias of <b>openssl_pkey_get_private</b>
 * @link https://php.net/manual/en/function.openssl-get-privatekey.php
 * @param $key
 * <p>
 * <b><em>key</em></b> can be one of the following:
 * <ol>
 * <li>a string having the format
 * <var>file://path/to/file.pem</var>. The named file must
 * contain a PEM encoded certificate/private key (it may contain both).
 * </li>
 * <li>A PEM formatted private key.</li>
 * </ol></p>
 * @param $passphrase [optional] <p>
 * The optional parameter <b><em>passphrase</em></b> must be used
 * if the specified key is encrypted (protected by a passphrase).
 * </p>
 * @return resource|false Returns a positive key resource identifier on success, or <b>FALSE</b> on error.
 * @since 4.0.4
 * @since 5.0
 */
function openssl_get_privatekey($key, $passphrase) { }

/**
 * Alias of <b>openssl_pkey_get_public</b>
 * @link https://php.net/manual/en/function.openssl-get-publickey.php
 * @param mixed $certificate <p>
 * <em><b>certificate</b></em> can be one of the following:
 * <ol>
 * <li>an X.509 certificate resource</li>
 * <li>a string having the format
 * <var>file://path/to/file.pem</var>. The named file must
 * contain a PEM encoded certificate/public key (it may contain both).
 * </span>
 * </li>
 * <li>A PEM formatted public key.</li>
 * </ol> </p>
 * @return resource|false a positive key resource identifier on success, or FALSE on error.
 * @since 4.0.4
 * @since 5.0
 */
function openssl_get_publickey($certificate) { }

/**
 * Generate a new signed public key and challenge
 * @link https://php.net/manual/en/function.openssl-spki-new.php
 * @param resource $privkey <p>
 * <b>privkey</b> should be set to a private key that was
 * previously generated by {@link https://php.net/en/manual/function.openssl-pkey-new.php openssl_pkey_new()} (or
 * otherwise obtained from the other openssl_pkey family of functions).
 * The corresponding public portion of the key will be used to sign the
 * CSR.
 * </p>
 * @param string $challenge <p>The challenge associated to associate with the SPKAC</p>
 * @param int $algorithm <p>The digest algorithm. See openssl_get_md_method().</p>
 * @return string|null Returns a signed public key and challenge string or NULL on failure.
 * @since 5.6.0
 */
function openssl_spki_new(&$privkey, &$challenge, $algorithm = 0) {}


/**
 * Verifies a signed public key and challenge
 * @link https://php.net/manual/en/function.openssl-spki-verify.php
 * @param string $spkac <p>Expects a valid signed public key and challenge</p>
 * @return bool Returns a boolean on success or failure.
 * @since 5.6.0
 */
function openssl_spki_verify(&$spkac) {}

/**
 * Exports the challenge assoicated with a signed public key and challenge
 * @link https://php.net/manual/en/function.openssl-spki-export-challenge.php
 * @param string $spkac <p>Expects a valid signed public key and challenge</p>
 * @return string|null Returns the associated challenge string or NULL on failure.
 * @since 5.6.0
 */
function openssl_spki_export_challenge (&$spkac ) {}

/**
 * Exports a valid PEM formatted public key signed public key and challenge
 * @link https://php.net/manual/en/function.openssl-spki-export.php
 * @param string $spkac <p>Expects a valid signed public key and challenge</p>
 * @return string|null Returns the associated PEM formatted public key or NULL on failure.
 * @since 5.6.0
 */
function openssl_spki_export (&$spkac ) {}
/**
 * Parse an X.509 certificate and return a resource identifier for
 * @since 4.0.6
 * @since 5.0
it
 * @link https://php.net/manual/en/function.openssl-x509-read.php
 * @param mixed $x509certdata
 * @return resource|false a resource identifier on success or false on failure.
 */
function openssl_x509_read($x509certdata) { }

/**
 * @param string $x509
 * @param string $type [optional] hash method
 * @param bool $binary [optional]
 * @return string|false <b>FALSE</b> on failure
 * @since 5.6.0
 */
function openssl_x509_fingerprint($x509, $type, $binary) {}
/**
 * Free certificate resource
 * @link https://php.net/manual/en/function.openssl-x509-free.php
 * @param resource $x509cert
 * @return void
 * @since 4.0.6
 * @since 5.0
 */
function openssl_x509_free($x509cert) { }

/**
 * Parse an X509 certificate and return the information as an array
 * @link https://php.net/manual/en/function.openssl-x509-parse.php
 * @param mixed $x509cert
 * @param bool $shortnames [optional] <p>
 * <i>shortnames</i> controls how the data is indexed in the
 * array - if <i>shortnames</i> is true (the default) then
 * fields will be indexed with the short name form, otherwise, the long name
 * form will be used - e.g.: CN is the shortname form of commonName.
 * </p>
 * @return array|false The structure of the returned data is (deliberately) not
 * yet documented, as it is still subject to change.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_x509_parse($x509cert, $shortnames = true) { }

/**
 * Verifies if a certificate can be used for a particular purpose
 * @link https://php.net/manual/en/function.openssl-x509-checkpurpose.php
 * @param mixed $x509cert <p>
 * The examined certificate.
 * </p>
 * @param int $purpose <p>
 * <table>
 * <b>openssl_x509_checkpurpose</b> purposes
 * <tr valign="top">
 * <td>Constant</td>
 * <td>Description</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_SSL_CLIENT</td>
 * <td>Can the certificate be used for the client side of an SSL
 * connection?</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_SSL_SERVER</td>
 * <td>Can the certificate be used for the server side of an SSL
 * connection?</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_NS_SSL_SERVER</td>
 * <td>Can the cert be used for Netscape SSL server?</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_SMIME_SIGN</td>
 * <td>Can the cert be used to sign S/MIME email?</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_SMIME_ENCRYPT</td>
 * <td>Can the cert be used to encrypt S/MIME email?</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_CRL_SIGN</td>
 * <td>Can the cert be used to sign a certificate revocation list
 * (CRL)?</td>
 * </tr>
 * <tr valign="top">
 * <td>X509_PURPOSE_ANY</td>
 * <td>Can the cert be used for Any/All purposes?</td>
 * </tr>
 * </table>
 * These options are not bitfields - you may specify one only!
 * </p>
 * @param array $cainfo [optional] <p>
 * <i>cainfo</i> should be an array of trusted CA files/dirs
 * as described in Certificate
 * Verification.
 * </p>
 * @param string $untrustedfile [optional] <p>
 * If specified, this should be the name of a PEM encoded file holding
 * certificates that can be used to help verify the certificate, although
 * no trust is placed in the certificates that come from that file.
 * </p>
 * @return int|bool true if the certificate can be used for the intended purpose,
 * false if it cannot, or -1 on error.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_x509_checkpurpose($x509cert, $purpose, array $cainfo = null, $untrustedfile = null) { }

/**
 * Checks if a private key corresponds to a certificate
 * @link https://php.net/manual/en/function.openssl-x509-check-private-key.php
 * @param mixed $cert <p>
 * The certificate.
 * </p>
 * @param mixed $key <p>
 * The private key.
 * </p>
 * @return bool true if <i>key</i> is the private key that
 * corresponds to <i>cert</i>, or false otherwise.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_x509_check_private_key($cert, $key) { }

/**
 * Exports a certificate as a string
 * @link https://php.net/manual/en/function.openssl-x509-export.php
 * @param mixed $x509
 * @param string $output <p>
 * On success, this will hold the PEM.
 * </p>
 * @param bool $notext [optional] &note.openssl.param-notext;
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_x509_export($x509, &$output, $notext = true) { }

/**
 * Exports a certificate to file
 * @link https://php.net/manual/en/function.openssl-x509-export-to-file.php
 * @param mixed $x509
 * @param string $outfilename <p>
 * Path to the output file.
 * </p>
 * @param bool $notext [optional] &note.openssl.param-notext;
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_x509_export_to_file($x509, $outfilename, $notext = true) { }

/**
 * Exports a PKCS#12 Compatible Certificate Store File to variable.
 * @link https://php.net/manual/en/function.openssl-pkcs12-export.php
 * @param mixed $x509
 * @param string $out <p>
 * On success, this will hold the PKCS#12.
 * </p>
 * @param mixed $priv_key <p>
 * Private key component of PKCS#12 file.
 * </p>
 * @param string $pass <p>
 * Encryption password for unlocking the PKCS#12 file.
 * </p>
 * @param array $args [optional]
 * @return bool true on success or false on failure.
 * @since 5.2.2
 */
function openssl_pkcs12_export($x509, &$out, $priv_key, $pass, array $args = null) { }

/**
 * Exports a PKCS#12 Compatible Certificate Store File
 * @link https://php.net/manual/en/function.openssl-pkcs12-export-to-file.php
 * @param mixed $x509
 * @param string $filename <p>
 * Path to the output file.
 * </p>
 * @param mixed $priv_key <p>
 * Private key component of PKCS#12 file.
 * </p>
 * @param string $pass <p>
 * Encryption password for unlocking the PKCS#12 file.
 * </p>
 * @param array $args [optional]
 * @return bool true on success or false on failure.
 * @since 5.2.2
 */
function openssl_pkcs12_export_to_file($x509, $filename, $priv_key, $pass, array $args = null) { }

/**
 * Parse a PKCS#12 Certificate Store into an array
 * @link https://php.net/manual/en/function.openssl-pkcs12-read.php
 * @param string $pkcs12
 * @param array $certs <p>
 * On success, this will hold the Certificate Store Data.
 * </p>
 * @param string $pass <p>
 * Encryption password for unlocking the PKCS#12 file.
 * </p>
 * @return bool true on success or false on failure.
 * @since 5.2.2
 */
function openssl_pkcs12_read($pkcs12, array &$certs, $pass) { }

/**
 * Generates a CSR
 * @link https://php.net/manual/en/function.openssl-csr-new.php
 * @param array $dn <p>
 * The Distinguished Name to be used in the certificate.
 * </p>
 * @param resource $privkey <p>
 * <i>privkey</i> should be set to a private key that was
 * previously generated by <b>openssl_pkey_new</b> (or
 * otherwise obtained from the other openssl_pkey family of functions).
 * The corresponding public portion of the key will be used to sign the
 * CSR.
 * </p>
 * @param array $configargs [optional] <p>
 * By default, the information in your system openssl.conf
 * is used to initialize the request; you can specify a configuration file
 * section by setting the config_section_section key of
 * <i>configargs</i>. You can also specify an alternative
 * openssl configuration file by setting the value of the
 * config key to the path of the file you want to use.
 * The following keys, if present in <i>configargs</i>
 * behave as their equivalents in the openssl.conf, as
 * listed in the table below.
 * <table>
 * Configuration overrides
 * <tr valign="top">
 * <td><i>configargs</i> key</td>
 * <td>type</td>
 * <td>openssl.conf equivalent</td>
 * <td>description</td>
 * </tr>
 * <tr valign="top">
 * <td>digest_alg</td>
 * <td>string</td>
 * <td>default_md</td>
 * <td>Selects which digest method to use</td>
 * </tr>
 * <tr valign="top">
 * <td>x509_extensions</td>
 * <td>string</td>
 * <td>x509_extensions</td>
 * <td>Selects which extensions should be used when creating an x509
 * certificate</td>
 * </tr>
 * <tr valign="top">
 * <td>req_extensions</td>
 * <td>string</td>
 * <td>req_extensions</td>
 * <td>Selects which extensions should be used when creating a CSR</td>
 * </tr>
 * <tr valign="top">
 * <td>private_key_bits</td>
 * <td>integer</td>
 * <td>default_bits</td>
 * <td>Specifies how many bits should be used to generate a private
 * key</td>
 * </tr>
 * <tr valign="top">
 * <td>private_key_type</td>
 * <td>integer</td>
 * <td>none</td>
 * <td>Specifies the type of private key to create. This can be one
 * of <b>OPENSSL_KEYTYPE_DSA</b>,
 * <b>OPENSSL_KEYTYPE_DH</b> or
 * <b>OPENSSL_KEYTYPE_RSA</b>.
 * The default value is <b>OPENSSL_KEYTYPE_RSA</b> which
 * is currently the only supported key type.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>encrypt_key</td>
 * <td>boolean</td>
 * <td>encrypt_key</td>
 * <td>Should an exported key (with passphrase) be encrypted?</td>
 * </tr>
 * <tr valign="top">
 * <td>encrypt_key_cipher</td>
 * <td>integer</td>
 * <td>none</td>
 * <td>
 * One of cipher constants.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @param array $extraattribs [optional] <p>
 * <i>extraattribs</i> is used to specify additional
 * configuration options for the CSR. Both <i>dn</i> and
 * <i>extraattribs</i> are associative arrays whose keys are
 * converted to OIDs and applied to the relevant part of the request.
 * </p>
 * @return false|resource the CSR.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_csr_new(array $dn, &$privkey, array $configargs = null, array $extraattribs = null) { }

/**
 * Exports a CSR as a string
 * @link https://php.net/manual/en/function.openssl-csr-export.php
 * @param resource $csr
 * @param string $out
 * @param bool $notext [optional] &note.openssl.param-notext;
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_csr_export($csr, &$out, $notext = true) { }

/**
 * Exports a CSR to a file
 * @link https://php.net/manual/en/function.openssl-csr-export-to-file.php
 * @param resource $csr
 * @param string $outfilename <p>
 * Path to the output file.
 * </p>
 * @param bool $notext [optional] &note.openssl.param-notext;
 * @return bool true on success or false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_csr_export_to_file($csr, $outfilename, $notext = true) { }

/**
 * Sign a CSR with another certificate (or itself) and generate a certificate
 * @link https://php.net/manual/en/function.openssl-csr-sign.php
 * @param mixed $csr <p>
 * A CSR previously generated by <b>openssl_csr_new</b>.
 * It can also be the path to a PEM encoded CSR when specified as
 * file://path/to/csr or an exported string generated
 * by <b>openssl_csr_export</b>.
 * </p>
 * @param mixed $cacert <p>
 * The generated certificate will be signed by <i>cacert</i>.
 * If <i>cacert</i> is null, the generated certificate
 * will be a self-signed certificate.
 * </p>
 * @param mixed $priv_key <p>
 * <i>priv_key</i> is the private key that corresponds to
 * <i>cacert</i>.
 * </p>
 * @param int $days <p>
 * <i>days</i> specifies the length of time for which the
 * generated certificate will be valid, in days.
 * </p>
 * @param array $configargs [optional] <p>
 * You can finetune the CSR signing by <i>configargs</i>.
 * See <b>openssl_csr_new</b> for more information about
 * <i>configargs</i>.
 * </p>
 * @param int $serial [optional] <p>
 * An optional the serial number of issued certificate. If not specified
 * it will default to 0.
 * </p>
 * @return resource|false an x509 certificate resource on success, false on failure.
 * @since 4.2.0
 * @since 5.0
 */
function openssl_csr_sign($csr, $cacert, $priv_key, $days, array $configargs = null, $serial = 0) { }

/**
 * Returns the subject of a CERT
 * @link https://php.net/manual/en/function.openssl-csr-get-subject.php
 * @param mixed $csr
 * @param bool $use_shortnames [optional]
 * @return array|false
 * @since 5.2.0
 */
function openssl_csr_get_subject($csr, $use_shortnames = true) { }

/**
 * Returns the public key of a CERT
 * @link https://php.net/manual/en/function.openssl-csr-get-public-key.php
 * @param mixed $csr
 * @param bool $use_shortnames [optional]
 * @return resource|false
 * @since 5.2.0
 */
function openssl_csr_get_public_key($csr, $use_shortnames = true) { }

/**
 * Computes a digest
 * @link https://php.net/manual/en/function.openssl-digest.php
 * @param string $data <p>
 * The data.
 * </p>
 * @param string $method <p>
 * The digest method.
 * </p>
 * @param bool $raw_output [optional] <p>
 * Setting to true will return as raw output data, otherwise the return
 * value is binhex encoded.
 * </p>
 * @return string|false the digested hash value on success or false on failure.
 * @since 5.3.0
 */
function openssl_digest($data, $method, $raw_output = false) { }

/**
 * Encrypts data
 * @link https://php.net/manual/en/function.openssl-encrypt.php
 * @param string $data <p>
 * The data.
 * </p>
 * @param string $method <p>
 * The cipher method. For a list of available cipher methods, use {@see openssl_get_cipher_methods()}.
 * </p>
 * @param string $key <p>
 * The key. 
 * </p>
 * @param int $options [optional] <p>
 * options is a bitwise disjunction of the flags OPENSSL_RAW_DATA and OPENSSL_ZERO_PADDING.
 * </p>
 * @param string $iv [optional] <p>
 * A non-NULL Initialization Vector.
 * </p>
 * @param string &$tag <p>The authentication tag passed by reference when using AEAD cipher mode (GCM or CCM).</p>
 * @param string $aad <p>Additional authentication data.</p>
 * @param int $tag_length [optional] <p>
 * The length of the authentication tag. Its value can be between 4 and 16 for GCM mode.
 * </p>
 * @return string|false the encrypted string on success or false on failure.
 * @since 5.3.0
 */
function openssl_encrypt($data, $method, $key, $options = 0, $iv = "", &$tag = NULL, $aad = "", $tag_length = 16) { }

/**
 * Decrypts data
 * @link https://php.net/manual/en/function.openssl-decrypt.php
 * @param string $data <p>
 * The data.
 * </p>
 * @param string $method <p>
 * The cipher method.
 * </p>
 * @param string $password <p>
 * The password.
 * </p>
 * @param int $options [optional] <p>
 * Setting to true will take a raw encoded string,
 * otherwise a base64 string is assumed for the
 * <i>data</i> parameter.
 * </p>
 * @param string $iv [optional] <p>
 * A non-NULL Initialization Vector.
 * </p>
 * @param string $tag [optional] <p>
 * The authentication tag in AEAD cipher mode. If it is incorrect, the authentication fails and the function returns <b>FALSE</b>.
 * </p>
 * @param string $aad [optional] <p>Additional authentication data.</p>
 * @return string|false The decrypted string on success or false on failure.
 * @since 5.3.0
 */
function openssl_decrypt($data, $method, $password, $options = 1, $iv = "", $tag = "",  $aad = "") { }

/**
 * (PHP 5 &gt;= PHP 5.3.3)<br/>
 * Gets the cipher iv length
 * @link https://php.net/manual/en/function.openssl-cipher-iv-length.php
 * @param string $method <p>
 * The method.
 * </p>
 * @return int|false the cipher length on success, or false on failure.
 */
function openssl_cipher_iv_length($method) { }

/**
 * Generate signature
 * @link https://php.net/manual/en/function.openssl-sign.php
 * @param string $data
 * @param string $signature <p>
 * If the call was successful the signature is returned in
 * <i>signature</i>.
 * </p>
 * @param mixed $priv_key_id
 * @param int $signature_alg [optional] <p>
 * For more information see the list of Signature Algorithms.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.4
 * @since 5.0
 */
function openssl_sign($data, &$signature, $priv_key_id, $signature_alg = OPENSSL_ALGO_SHA1) { }

/**
 * Verify signature
 * @link https://php.net/manual/en/function.openssl-verify.php
 * @param string $data
 * @param string $signature
 * @param mixed $pub_key_id
 * @param int $signature_alg [optional] <p>
 * For more information see the list of Signature Algorithms.
 * </p>
 * @return int 1 if the signature is correct, 0 if it is incorrect, and
 * -1 on error.
 * @since 4.0.4
 * @since 5.0
 */
function openssl_verify($data, $signature, $pub_key_id, $signature_alg = OPENSSL_ALGO_SHA1) { }

/**
 * Seal (encrypt) data
 * @link https://php.net/manual/en/function.openssl-seal.php
 * @param string $data
 * @param string $sealed_data
 * @param array $env_keys
 * @param array $pub_key_ids
 * @param string $method [optional]
 * @param string $iv [optional]
 * @return int|false the length of the sealed data on success, or false on error.
 * If successful the sealed data is returned in
 * <i>sealed_data</i>, and the envelope keys in
 * <i>env_keys</i>.
 * @since 4.0.4
 * @since 5.0
 */
function openssl_seal($data, &$sealed_data, array &$env_keys, array $pub_key_ids, $method = null, $iv = '') { }

/**
 * Open sealed data
 * @link https://php.net/manual/en/function.openssl-open.php
 * @param string $sealed_data
 * @param string $open_data <p>
 * If the call is successful the opened data is returned in this
 * parameter.
 * </p>
 * @param string $env_key
 * @param mixed $priv_key_id
 * @param string $method [optional] The cipher method.
 * @param string $iv [optional] The initialization vector.
 * @return bool true on success or false on failure.
 * @since 4.0.4
 * @since 5.0
 */
function openssl_open($sealed_data, &$open_data, $env_key, $priv_key_id, $method = "RC4", string $iv) { }

/**
 * Generates a PKCS5 v2 PBKDF2 string, defaults to SHA-1
 * @link https://secure.php.net/manual/en/function.openssl-pbkdf2.php
 * @param string $password
 * @param string $salt
 * @param int $key_length
 * @param int $iterations
 * @param string $digest_algorithm [optional]
 * @return string|false Returns string or FALSE on failure.
 * @since 5.5.0
 */
function openssl_pbkdf2($password, $salt, $key_length, $iterations, $digest_algorithm) { }

/**
 * Verifies the signature of an S/MIME signed message
 * @link https://php.net/manual/en/function.openssl-pkcs7-verify.php
 * @param string $filename <p>
 * Path to the message.
 * </p>
 * @param int $flags <p>
 * <i>flags</i> can be used to affect how the signature is
 * verified - see PKCS7 constants
 * for more information.
 * </p>
 * @param string $outfilename [optional] <p>
 * If the <i>outfilename</i> is specified, it should be a
 * string holding the name of a file into which the certificates of the
 * persons that signed the messages will be stored in PEM format.
 * </p>
 * @param array $cainfo [optional] <p>
 * If the <i>cainfo</i> is specified, it should hold
 * information about the trusted CA certificates to use in the verification
 * process - see certificate
 * verification for more information about this parameter.
 * </p>
 * @param string $extracerts [optional] <p>
 * If the <i>extracerts</i> is specified, it is the filename
 * of a file containing a bunch of certificates to use as untrusted CAs.
 * </p>
 * @param string $content [optional] <p>
 * You can specify a filename with <i>content</i> that will
 * be filled with the verified data, but with the signature information
 * stripped.
 * @param string|null $pk7 [optional]
 * </p>
 * @return bool|int true if the signature is verified, false if it is not correct
 * (the message has been tampered with, or the signing certificate is invalid),
 * or -1 on error.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_pkcs7_verify($filename, $flags, $outfilename = null, array $cainfo = null, $extracerts = null, $content = null, $pk7 = null) { }

/**
 * Decrypts an S/MIME encrypted message
 * @link https://php.net/manual/en/function.openssl-pkcs7-decrypt.php
 * @param string $infilename
 * @param string $outfilename <p>
 * The decrypted message is written to the file specified by
 * <i>outfilename</i>.
 * </p>
 * @param mixed $recipcert
 * @param mixed $recipkey [optional]
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_pkcs7_decrypt($infilename, $outfilename, $recipcert, $recipkey = null) { }

/**
 * Sign an S/MIME message
 * @link https://php.net/manual/en/function.openssl-pkcs7-sign.php
 * @param string $infilename
 * @param string $outfilename
 * @param mixed $signcert
 * @param mixed $privkey
 * @param array $headers <p>
 * <i>headers</i> is an array of headers that
 * will be prepended to the data after it has been signed (see
 * <b>openssl_pkcs7_encrypt</b> for more information about
 * the format of this parameter).
 * </p>
 * @param int $flags [optional] <p>
 * <i>flags</i> can be used to alter the output - see PKCS7 constants.
 * </p>
 * @param string $extracerts [optional] <p>
 * <i>extracerts</i> specifies the name of a file containing
 * a bunch of extra certificates to include in the signature which can for
 * example be used to help the recipient to verify the certificate that you used.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_pkcs7_sign($infilename, $outfilename, $signcert, $privkey, array $headers, $flags = PKCS7_DETACHED, $extracerts = null) { }

/**
 * Encrypt an S/MIME message
 * @link https://php.net/manual/en/function.openssl-pkcs7-encrypt.php
 * @param string $infile
 * @param string $outfile
 * @param mixed $recipcerts <p>
 * Either a lone X.509 certificate, or an array of X.509 certificates.
 * </p>
 * @param array $headers <p>
 * <i>headers</i> is an array of headers that
 * will be prepended to the data after it has been encrypted.
 * </p>
 * <p>
 * <i>headers</i> can be either an associative array
 * keyed by header name, or an indexed array, where each element contains
 * a single header line.
 * </p>
 * @param int $flags [optional] <p>
 * <i>flags</i> can be used to specify options that affect
 * the encoding process - see PKCS7
 * constants.
 * </p>
 * @param int $cipherid [optional] <p>
 * One of cipher constants.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_pkcs7_encrypt($infile, $outfile, $recipcerts, array $headers, $flags = 0, $cipherid = OPENSSL_CIPHER_RC2_40) { }

/**
 * Encrypts data with private key
 * @link https://php.net/manual/en/function.openssl-private-encrypt.php
 * @param string $data
 * @param string $crypted
 * @param mixed $key
 * @param int $padding [optional] <p>
 * <i>padding</i> can be one of
 * <b>OPENSSL_PKCS1_PADDING</b>,
 * <b>OPENSSL_NO_PADDING</b>.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_private_encrypt($data, &$crypted, $key, $padding = OPENSSL_PKCS1_PADDING) { }

/**
 * Decrypts data with private key
 * @link https://php.net/manual/en/function.openssl-private-decrypt.php
 * @param string $data
 * @param string $decrypted
 * @param mixed $key <p>
 * <i>key</i> must be the private key corresponding that
 * was used to encrypt the data.
 * </p>
 * @param int $padding [optional] <p>
 * <i>padding</i> can be one of
 * <b>OPENSSL_PKCS1_PADDING</b>,
 * <b>OPENSSL_SSLV23_PADDING</b>,
 * <b>OPENSSL_PKCS1_OAEP_PADDING</b>,
 * <b>OPENSSL_NO_PADDING</b>.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_private_decrypt($data, &$decrypted, $key, $padding = OPENSSL_PKCS1_PADDING) { }

/**
 * Encrypts data with public key
 * @link https://php.net/manual/en/function.openssl-public-encrypt.php
 * @param string $data
 * @param string $crypted <p>
 * This will hold the result of the encryption.
 * </p>
 * @param mixed $key <p>
 * The public key.
 * </p>
 * @param int $padding [optional] <p>
 * <i>padding</i> can be one of
 * <b>OPENSSL_PKCS1_PADDING</b>,
 * <b>OPENSSL_SSLV23_PADDING</b>,
 * <b>OPENSSL_PKCS1_OAEP_PADDING</b>,
 * <b>OPENSSL_NO_PADDING</b>.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_public_encrypt($data, &$crypted, $key, $padding = OPENSSL_PKCS1_PADDING) { }

/**
 * Decrypts data with public key
 * @link https://php.net/manual/en/function.openssl-public-decrypt.php
 * @param string $data
 * @param string $decrypted
 * @param mixed $key <p>
 * <i>key</i> must be the public key corresponding that
 * was used to encrypt the data.
 * </p>
 * @param int $padding [optional] <p>
 * <i>padding</i> can be one of
 * <b>OPENSSL_PKCS1_PADDING</b>,
 * <b>OPENSSL_NO_PADDING</b>.
 * </p>
 * @return bool true on success or false on failure.
 * @since 4.0.6
 * @since 5.0
 */
function openssl_public_decrypt($data, &$decrypted, $key, $padding = OPENSSL_PKCS1_PADDING) { }

/**
 * Gets available digest methods
 * @link https://php.net/manual/en/function.openssl-get-md-methods.php
 * @param bool $aliases [optional] <p>
 * Set to true if digest aliases should be included within the
 * returned array.
 * </p>
 * @return array An array of available digest methods.
 * @since 5.3.0
 */
function openssl_get_md_methods($aliases = false) { }

/**
 * Gets available cipher methods
 * @link https://php.net/manual/en/function.openssl-get-cipher-methods.php
 * @param bool $aliases [optional] <p>
 * Set to true if cipher aliases should be included within the
 * returned array.
 * </p>
 * @return array An array of available cipher methods.
 * @since 5.3.0
 */
function openssl_get_cipher_methods($aliases = false) { }

/**
 * (No version information available, might only be in SVN)<br/>
 * Computes shared secret for public value of remote DH key and local DH key
 * @link https://php.net/manual/en/function.openssl-dh-compute-key.php
 * @param string $pub_key <p>
 * Public key
 * </p>
 * @param resource $dh_key <p>
 * DH key
 * </p>
 * @return string|false computed key on success or false on failure.
 */
function openssl_dh_compute_key($pub_key, $dh_key) { }

/**
 * @param $peer_pub_key
 * @param $priv_key
 * @param $keylen
 * @since 7.3
 */
function openssl_pkey_derive($peer_pub_key, $priv_key, $keylen) {}

/**
 * Generates a string of pseudo-random bytes, with the number of bytes determined by the length parameter.
 * <p>It also indicates if a cryptographically strong algorithm was used to produce the pseudo-random bytes,
 * and does this via the optional crypto_strong parameter. It's rare for this to be FALSE, but some systems may be broken or old.
 * @link https://php.net/manual/en/function.openssl-random-pseudo-bytes.php
 * @param int $length <p>
 * The length of the desired string of bytes. Must be a positive integer. PHP will
 * try to cast this parameter to a non-null integer to use it.
 * </p>
 * @param bool $crypto_strong [optional]<p>
 * If passed into the function, this will hold a boolean value that determines
 * if the algorithm used was "cryptographically strong", e.g., safe for usage with GPG,
 * passwords, etc. true if it did, otherwise false
 * </p>
 * @return string|false the generated &string; of bytes on success, or false on failure.
 * @since 5.3.0
 */
function openssl_random_pseudo_bytes($length, &$crypto_strong = null) { }

/**
 * Return openSSL error message
 * @link https://php.net/manual/en/function.openssl-error-string.php
 * @return string|false an error message string, or false if there are no more error
 * messages to return.
 * @since 4.0.6
 */
function openssl_error_string() { }

/**
 * Retrieve the available certificate locations
 * @link https://php.net/manual/en/function.openssl-get-cert-locations.php
 * @return array an array with the available certificate locations
 * @since 5.6.0
 */
function openssl_get_cert_locations() { }

function openssl_get_curve_names() {}

/**
 * @param string $P7B
 * @param array $certs
 * @return bool
 * @since 7.2
 */
function openssl_pkcs7_read($P7B, &$certs) {}

define ('OPENSSL_VERSION_TEXT', "OpenSSL 1.0.0e 6 Sep 2011");
define ('OPENSSL_VERSION_NUMBER', 268435551);
define ('X509_PURPOSE_SSL_CLIENT', 1);
define ('X509_PURPOSE_SSL_SERVER', 2);
define ('X509_PURPOSE_NS_SSL_SERVER', 3);
define ('X509_PURPOSE_SMIME_SIGN', 4);
define ('X509_PURPOSE_SMIME_ENCRYPT', 5);
define ('X509_PURPOSE_CRL_SIGN', 6);
define ('X509_PURPOSE_ANY', 7);

/**
 * Used as default algorithm by <b>openssl_sign</b> and
 * <b>openssl_verify</b>.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('OPENSSL_ALGO_SHA1', 1);
define ('OPENSSL_ALGO_MD5', 2);
define ('OPENSSL_ALGO_MD4', 3);
define ('OPENSSL_ALGO_MD2', 4);
define ('OPENSSL_ALGO_DSS1', 5);
define ('OPENSSL_ALGO_SHA224', 6);
define ('OPENSSL_ALGO_SHA256', 7);
define ('OPENSSL_ALGO_SHA384', 8);
define ('OPENSSL_ALGO_SHA512', 9);
define ('OPENSSL_ALGO_RMD160', 10);
/**
 * When signing a message, use cleartext signing with the MIME
 * type "multipart/signed". This is the default
 * if you do not specify any <i>flags</i> to
 * <b>openssl_pkcs7_sign</b>.
 * If you turn this option off, the message will be signed using
 * opaque signing, which is more resistant to translation by mail relays
 * but cannot be read by mail agents that do not support S/MIME.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_DETACHED', 64);

/**
 * Adds text/plain content type headers to encrypted/signed
 * message. If decrypting or verifying, it strips those headers from
 * the output - if the decrypted or verified message is not of MIME type
 * text/plain then an error will occur.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_TEXT', 1);

/**
 * When verifying a message, certificates (if
 * any) included in the message are normally searched for the
 * signing certificate. With this option only the
 * certificates specified in the <i>extracerts</i>
 * parameter of <b>openssl_pkcs7_verify</b> are
 * used. The supplied certificates can still be used as
 * untrusted CAs however.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_NOINTERN', 16);

/**
 * Do not verify the signers certificate of a signed
 * message.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_NOVERIFY', 32);

/**
 * Do not chain verification of signers certificates: that is
 * don't use the certificates in the signed message as untrusted CAs.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_NOCHAIN', 8);

/**
 * When signing a message the signer's certificate is normally
 * included - with this option it is excluded. This will reduce the
 * size of the signed message but the verifier must have a copy of the
 * signers certificate available locally (passed using the
 * <i>extracerts</i> to
 * <b>openssl_pkcs7_verify</b> for example).
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_NOCERTS', 2);

/**
 * Normally when a message is signed, a set of attributes are
 * included which include the signing time and the supported symmetric
 * algorithms. With this option they are not included.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_NOATTR', 256);

/**
 * Normally the input message is converted to "canonical" format
 * which is effectively using CR and LF
 * as end of line: as required by the S/MIME specification. When this
 * option is present, no translation occurs. This is useful when
 * handling binary data which may not be in MIME format.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_BINARY', 128);

/**
 * Don't try and verify the signatures on a message
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('PKCS7_NOSIGS', 4);
define ('OPENSSL_PKCS1_PADDING', 1);
define ('OPENSSL_SSLV23_PADDING', 2);
define ('OPENSSL_NO_PADDING', 3);
define ('OPENSSL_PKCS1_OAEP_PADDING', 4);
define ('OPENSSL_CIPHER_RC2_40', 0);
define ('OPENSSL_CIPHER_RC2_128', 1);
define ('OPENSSL_CIPHER_RC2_64', 2);
define ('OPENSSL_CIPHER_DES', 3);
define ('OPENSSL_CIPHER_3DES', 4);
define ('OPENSSL_KEYTYPE_RSA', 0);
define ('OPENSSL_KEYTYPE_DSA', 1);
define ('OPENSSL_KEYTYPE_DH', 2);
define ('OPENSSL_KEYTYPE_EC', 3);

/**
 * Whether SNI support is available or not.
 * @link https://php.net/manual/en/openssl.constants.php
 */
define ('OPENSSL_TLSEXT_SERVER_NAME', 1);

// End of openssl v.


/** @link https://php.net/manual/en/openssl.ciphers.php */
define('OPENSSL_CIPHER_AES_128_CBC', 5);
/** @link https://php.net/manual/en/openssl.ciphers.php */
define('OPENSSL_CIPHER_AES_192_CBC', 6);
/** @link https://php.net/manual/en/openssl.ciphers.php */
define('OPENSSL_CIPHER_AES_256_CBC', 7);
define('OPENSSL_RAW_DATA', 1);
define('OPENSSL_ZERO_PADDING', 2);
define('OPENSSL_DONT_ZERO_PAD_KEY', 4);

define('OPENSSL_DEFAULT_STREAM_CIPHERS', "ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:" .
"ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:" .
"DHE-DSS-AES128-GCM-SHA256:kEDH+AESGCM:ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA256:" .
"ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES256-SHA384:" .
"ECDHE-RSA-AES256-SHA:ECDHE-ECDSA-AES256-SHA:DHE-RSA-AES128-SHA256:DHE-RSA-AES128-SHA:" .
"DHE-DSS-AES128-SHA256:DHE-RSA-AES256-SHA256:DHE-DSS-AES256-SHA:DHE-RSA-AES256-SHA:AES128-GCM-SHA256:" .
"AES256-GCM-SHA384:AES128:AES256:HIGH:!SSLv2:!aNULL:!eNULL:!EXPORT:!DES:!MD5:!RC4:!ADH");

define ('STREAM_CRYPTO_METHOD_SSLv2_CLIENT', 0);
define ('STREAM_CRYPTO_METHOD_SSLv3_CLIENT', 1);
define ('STREAM_CRYPTO_METHOD_SSLv23_CLIENT', 2);
define ('STREAM_CRYPTO_METHOD_TLS_CLIENT', 3);
define ('STREAM_CRYPTO_METHOD_SSLv2_SERVER', 4);
define ('STREAM_CRYPTO_METHOD_SSLv3_SERVER', 5);
define ('STREAM_CRYPTO_METHOD_SSLv23_SERVER', 6);
define ('STREAM_CRYPTO_METHOD_TLS_SERVER', 7);

define("STREAM_CRYPTO_METHOD_ANY_CLIENT", 63);
define("STREAM_CRYPTO_METHOD_ANY_SERVER", 62);
define("STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT", 9);
define("STREAM_CRYPTO_METHOD_TLSv1_0_SERVER", 8);
define("STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT", 17);
define("STREAM_CRYPTO_METHOD_TLSv1_1_SERVER", 16);
define("STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT", 33);
define("STREAM_CRYPTO_METHOD_TLSv1_2_SERVER", 32);

define("STREAM_CRYPTO_PROTO_SSLv3", 4);
define("STREAM_CRYPTO_PROTO_TLSv1_0", 8);
define("STREAM_CRYPTO_PROTO_TLSv1_1", 16);
define("STREAM_CRYPTO_PROTO_TLSv1_2", 32);
