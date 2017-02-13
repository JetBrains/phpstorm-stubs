<?php
/**
 * PHPStorm stub file for OpenSSL constants.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */

/**
 * @link  http://php.net/manual/en/openssl.constants.php
 */
const OPENSSL_ALGO_DSS1 = 5;
const OPENSSL_ALGO_MD2 = 4;
const OPENSSL_ALGO_MD4 = 3;
const OPENSSL_ALGO_MD5 = 2;
const OPENSSL_ALGO_RMD160 = 10;
/**
 * Used as default algorithm by <b>openssl_sign</b> and
 * <b>openssl_verify</b>.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const OPENSSL_ALGO_SHA1 = 1;
const OPENSSL_ALGO_SHA224 = 6;
const OPENSSL_ALGO_SHA256 = 7;
const OPENSSL_ALGO_SHA384 = 8;
const OPENSSL_ALGO_SHA512 = 9;
const OPENSSL_CIPHER_3DES = 4;
/** @link http://php.net/manual/en/openssl.ciphers.php */
const OPENSSL_CIPHER_AES_128_CBC = 5;
/** @link http://php.net/manual/en/openssl.ciphers.php */
const OPENSSL_CIPHER_AES_192_CBC = 6;
/** @link http://php.net/manual/en/openssl.ciphers.php */
const OPENSSL_CIPHER_AES_256_CBC = 7;
const OPENSSL_CIPHER_DES = 3;
const OPENSSL_CIPHER_RC2_128 = 1;
const OPENSSL_CIPHER_RC2_40 = 0;
const OPENSSL_CIPHER_RC2_64 = 2;
const OPENSSL_DEFAULT_STREAM_CIPHERS = 'ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES128-GCM-SHA256:' .
    'ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:' .
    'DHE-DSS-AES128-GCM-SHA256:kEDH+AESGCM:ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA256:' .
    'ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES256-SHA384:' .
    'ECDHE-RSA-AES256-SHA:ECDHE-ECDSA-AES256-SHA:DHE-RSA-AES128-SHA256:DHE-RSA-AES128-SHA:' .
    'DHE-DSS-AES128-SHA256:DHE-RSA-AES256-SHA256:DHE-DSS-AES256-SHA:DHE-RSA-AES256-SHA:AES128-GCM-SHA256:' .
    'AES256-GCM-SHA384:AES128:AES256:HIGH:!SSLv2:!aNULL:!eNULL:!EXPORT:!DES:!MD5:!RC4:!ADH';
const OPENSSL_KEYTYPE_DH = 2;
const OPENSSL_KEYTYPE_DSA = 1;
const OPENSSL_KEYTYPE_EC = 3;
const OPENSSL_KEYTYPE_RSA = 0;
const OPENSSL_NO_PADDING = 3;
const OPENSSL_PKCS1_OAEP_PADDING = 4;
const OPENSSL_PKCS1_PADDING = 1;
const OPENSSL_RAW_DATA = 1;
const OPENSSL_SSLV23_PADDING = 2;
/**
 * Whether SNI support is available or not.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const OPENSSL_TLSEXT_SERVER_NAME = 1;
const OPENSSL_VERSION_NUMBER = 268435551;
const OPENSSL_VERSION_TEXT = 'OpenSSL 1.0.0e 6 Sep 2011';
const OPENSSL_ZERO_PADDING = 2;
/**
 * Normally the input message is converted to 'canonical' format
 * which is effectively using CR and LF
 * as end of line: as required by the S/MIME specification. When this
 * option is present, no translation occurs. This is useful when
 * handling binary data which may not be in MIME format.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_BINARY = 128;
/**
 * When signing a message, use cleartext signing with the MIME
 * type 'multipart/signed'. This is the default
 * if you do not specify any <i>flags</i> to
 * <b>openssl_pkcs7_sign</b>.
 * If you turn this option off, the message will be signed using
 * opaque signing, which is more resistant to translation by mail relays
 * but cannot be read by mail agents that do not support S/MIME.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_DETACHED = 64;
/**
 * Normally when a message is signed, a set of attributes are
 * included which include the signing time and the supported symmetric
 * algorithms. With this option they are not included.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_NOATTR = 256;
/**
 * When signing a message the signer's certificate is normally
 * included - with this option it is excluded. This will reduce the
 * size of the signed message but the verifier must have a copy of the
 * signers certificate available locally (passed using the
 * <i>extracerts</i> to
 * <b>openssl_pkcs7_verify</b> for example).
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_NOCERTS = 2;
/**
 * Do not chain verification of signers certificates: that is
 * don't use the certificates in the signed message as untrusted CAs.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_NOCHAIN = 8;
/**
 * When verifying a message, certificates (if
 * any) included in the message are normally searched for the
 * signing certificate. With this option only the
 * certificates specified in the <i>extracerts</i>
 * parameter of <b>openssl_pkcs7_verify</b> are
 * used. The supplied certificates can still be used as
 * untrusted CAs however.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_NOINTERN = 16;
/**
 * Don't try and verify the signatures on a message
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_NOSIGS = 4;
/**
 * Do not verify the signers certificate of a signed
 * message.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_NOVERIFY = 32;
/**
 * Adds text/plain content type headers to encrypted/signed
 * message. If decrypting or verifying, it strips those headers from
 * the output - if the decrypted or verified message is not of MIME type
 * text/plain then an error will occur.
 *
 * @link http://php.net/manual/en/openssl.constants.php
 */
const PKCS7_TEXT = 1;
const STREAM_CRYPTO_METHOD_ANY_CLIENT = 63;
// End of openssl v.
const STREAM_CRYPTO_METHOD_ANY_SERVER = 62;
const STREAM_CRYPTO_METHOD_SSLv23_CLIENT = 2;
const STREAM_CRYPTO_METHOD_SSLv23_SERVER = 6;
const STREAM_CRYPTO_METHOD_SSLv2_CLIENT = 0;
const STREAM_CRYPTO_METHOD_SSLv2_SERVER = 4;
const STREAM_CRYPTO_METHOD_SSLv3_CLIENT = 1;
const STREAM_CRYPTO_METHOD_SSLv3_SERVER = 5;
const STREAM_CRYPTO_METHOD_TLS_CLIENT = 3;
const STREAM_CRYPTO_METHOD_TLS_SERVER = 7;
const STREAM_CRYPTO_METHOD_TLSv1_0_CLIENT = 9;
const STREAM_CRYPTO_METHOD_TLSv1_0_SERVER = 8;
const STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT = 17;
const STREAM_CRYPTO_METHOD_TLSv1_1_SERVER = 16;
const STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT = 33;
const STREAM_CRYPTO_METHOD_TLSv1_2_SERVER = 32;
const X509_PURPOSE_ANY = 7;
const X509_PURPOSE_CRL_SIGN = 6;
const X509_PURPOSE_NS_SSL_SERVER = 3;
const X509_PURPOSE_SMIME_ENCRYPT = 5;
const X509_PURPOSE_SMIME_SIGN = 4;
const X509_PURPOSE_SSL_CLIENT = 1;
const X509_PURPOSE_SSL_SERVER = 2;
