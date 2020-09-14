<?php

const SODIUM_CRYPTO_AEAD_AES256GCM_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_AES256GCM_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_AES256GCM_NPUBBYTES = 12;
const SODIUM_CRYPTO_AEAD_AES256GCM_ABYTES = 16;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_NPUBBYTES = 8;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_ABYTES = 16;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES = 12;
const SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_ABYTES = 16;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_KEYBYTES = 32;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NSECBYTES = 0;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES = 24;
const SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_ABYTES = 16;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_ABYTES = 17;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_HEADERBYTES = 24;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_KEYBYTES = 32;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_MESSAGEBYTES_MAX = 274877906816;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_MESSAGE = 0;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_PUSH = 1;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_REKEY = 2;
const SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL = 3;
const SODIUM_CRYPTO_PWHASH_ALG_ARGON2ID13 = 2;
const SODIUM_BASE64_VARIANT_ORIGINAL = 1;
const SODIUM_BASE64_VARIANT_ORIGINAL_NO_PADDING = 3;
const SODIUM_BASE64_VARIANT_URLSAFE = 5;
const SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING = 7;
const SODIUM_CRYPTO_AUTH_BYTES = 32;
const SODIUM_CRYPTO_AUTH_KEYBYTES = 32;
const SODIUM_CRYPTO_BOX_SEALBYTES = 48;
const SODIUM_CRYPTO_BOX_SECRETKEYBYTES = 32;
const SODIUM_CRYPTO_BOX_PUBLICKEYBYTES = 32;
const SODIUM_CRYPTO_BOX_KEYPAIRBYTES = 64;
const SODIUM_CRYPTO_BOX_MACBYTES = 16;
const SODIUM_CRYPTO_BOX_NONCEBYTES = 24;
const SODIUM_CRYPTO_BOX_SEEDBYTES = 32;
const SODIUM_CRYPTO_KX_BYTES = 32;
const SODIUM_CRYPTO_KX_PUBLICKEYBYTES = 32;
const SODIUM_CRYPTO_KX_SECRETKEYBYTES = 32;
const SODIUM_CRYPTO_GENERICHASH_BYTES = 32;
const SODIUM_CRYPTO_GENERICHASH_BYTES_MIN = 16;
const SODIUM_CRYPTO_GENERICHASH_BYTES_MAX = 64;
const SODIUM_CRYPTO_GENERICHASH_KEYBYTES = 32;
const SODIUM_CRYPTO_GENERICHASH_KEYBYTES_MIN = 16;
const SODIUM_CRYPTO_GENERICHASH_KEYBYTES_MAX = 64;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_SALTBYTES = 32;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_STRPREFIX = '$7$';
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE = 524288;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE = 16777216;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_SENSITIVE = 33554432;
const SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_SENSITIVE = 1073741824;
const SODIUM_CRYPTO_SCALARMULT_BYTES = 32;
const SODIUM_CRYPTO_SCALARMULT_SCALARBYTES = 32;
const SODIUM_CRYPTO_SHORTHASH_BYTES = 8;
const SODIUM_CRYPTO_SHORTHASH_KEYBYTES = 16;
const SODIUM_CRYPTO_SECRETBOX_KEYBYTES = 32;
const SODIUM_CRYPTO_SECRETBOX_MACBYTES = 16;
const SODIUM_CRYPTO_SECRETBOX_NONCEBYTES = 24;
const SODIUM_CRYPTO_SIGN_BYTES = 64;
const SODIUM_CRYPTO_SIGN_SEEDBYTES = 32;
const SODIUM_CRYPTO_SIGN_PUBLICKEYBYTES = 32;
const SODIUM_CRYPTO_SIGN_SECRETKEYBYTES = 64;
const SODIUM_CRYPTO_SIGN_KEYPAIRBYTES = 96;
const SODIUM_CRYPTO_STREAM_KEYBYTES = 32;
const SODIUM_CRYPTO_STREAM_NONCEBYTES = 24;
const SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE = 2;
const SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE = 67108864;
const SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE = 3;
const SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE = 268435456;
const SODIUM_CRYPTO_PWHASH_OPSLIMIT_SENSITIVE = 4;
const SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE = 1073741824;
const SODIUM_LIBRARY_VERSION="1.0.18";
const SODIUM_LIBRARY_MAJOR_VERSION = 10;
const SODIUM_LIBRARY_MINOR_VERSION = 3;
const SODIUM_CRYPTO_KDF_BYTES_MIN = 16;
const SODIUM_CRYPTO_KDF_BYTES_MAX = 64;
const SODIUM_CRYPTO_KDF_CONTEXTBYTES = 8;
const SODIUM_CRYPTO_KDF_KEYBYTES = 32;
const SODIUM_CRYPTO_KX_SEEDBYTES = 32;
const SODIUM_CRYPTO_KX_SESSIONKEYBYTES = 32;
const SODIUM_CRYPTO_KX_KEYPAIRBYTES = 64;
const SODIUM_CRYPTO_PWHASH_ALG_ARGON2I13 = 1;
const SODIUM_CRYPTO_PWHASH_ALG_DEFAULT = 2;
const SODIUM_CRYPTO_PWHASH_SALTBYTES = 16;
const SODIUM_CRYPTO_PWHASH_STRPREFIX = '$argon2id$';

/**
 * Can you access AES-256-GCM? This is only available if you have supported
 * hardware.
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-is-available
 * @return bool
 * @since 7.2
 */
function sodium_crypto_aead_aes256gcm_is_available(): bool
{
    return false;
}

/**
 * Authenticated Encryption with Associated Data (decrypt)
 * AES-256-GCM
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-decrypt.php
 * @param string $ciphertext encrypted message
 * @param string $ad additional data
 * @param string $nonce
 * @param string $key
 * @return string|false
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_aes256gcm_decrypt(
    string $ciphertext,
    string $ad,
    string $nonce,
    string $key
): string {
    unset($msg, $ad, $nonce, $key);
    return '';
}

/**
 * Authenticated Encryption with Associated Data (encrypt)
 * AES-256-GCM
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-encrypt.php
 * @param string $msg plaintext message
 * @param string $ad
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_aes256gcm_encrypt(
    string $msg,
    string $ad,
    string $nonce,
    string $key
): string {
    unset($msg, $ad, $nonce, $key);
    return '';
}

/**
 * Authenticated Encryption with Associated Data (decrypt)
 * ChaCha20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-decrypt.php
 * @param string $ciphertext encrypted message
 * @param string $ad additional data
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_decrypt(
    string $ciphertext,
    string $ad,
    string $nonce,
    string $key
): string {
    unset($ciphertext, $ad, $nonce, $key);
    return '';
}

/**
 * Authenticated Encryption with Associated Data (encrypt)
 * ChaCha20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-encrypt.php
 * @param string $msg plaintext message
 * @param string $ad additional data
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_encrypt(
    string $msg,
    string $ad,
    string $nonce,
    string $key
): string {
    unset($msg, $ad, $nonce, $key);
    return '';
}

/**
 * Authenticated Encryption with Associated Data (decrypt)
 * ChaCha20 + Poly1305 (IETF version)
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-decrypt.php
 * @param string $ciphertext encrypted message
 * @param string $ad additional data
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_ietf_decrypt(
    string $ciphertext,
    string $ad,
    string $nonce,
    string $key
): string {
    unset($ciphertext, $ad, $nonce, $key);
    return '';
}

/**
 * Authenticated Encryption with Associated Data (encrypt)
 * ChaCha20 + Poly1305 (IETF version)
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-encrypt.php
 * @param string $msg plaintext message
 * @param string $ad additional data
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_ietf_encrypt(
    string $msg,
    string $ad,
    string $nonce,
    string $key
): string {
    unset($msg, $ad, $nonce, $key);
    return '';
}

/**
 * Secret-key message authentication
 * HMAC SHA-512/256
 * @link https://www.php.net/manual/en/function.sodium-crypto-auth.php
 * @param string $msg
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_auth(
    string $msg,
    string $key
): string {
    unset($msg, $key);
    return '';
}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-auth-keygen.php
 * @return string
 * @since 7.2
 */
function sodium_crypto_auth_keygen(): string {}

/**
 * @link https://php.net/manual/en/function.sodium-crypto-kx-keypair.php
 * @since 7.2
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_keypair (): string {}

/**
 * @link https://php.net/manual/en/function.sodium-crypto-kx-publickey.php
 * @since 7.2
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */

function sodium_crypto_kx_publickey (string $key): string {}

/**
 * @link https://php.net/manual/en/function.sodium-crypto-kx-secretkey.php
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_secretkey (string $key): string {}

/**
 * @link https://php.net/manual/en/function.sodium-crypto-kx-seed-keypair.php
 * @since 7.2
 * @param string $string
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_seed_keypair (string $string): string {}

/**
 * @link https://php.net/manual/en/function.sodium-crypto-kx-server-session-keys.php
 * @since 7.2
 * @param string $server_keypair
 * @param string $client_key
 * @return string[]
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_server_session_keys (string $server_keypair , string $client_key): array {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-generichash-keygen.php
 * @return string
 * @since 7.2
 */
function sodium_crypto_generichash_keygen(): string {}


/**
 * @link https://php.net/manual/en/function.sodium-crypto-kx-client-session-keys.php
 * @param string $client_keypair
 * @param string $server_key
 * @return string[]
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_client_session_keys (string $client_keypair, string $server_key): array {}

/**
 * @link https://www.php.net/manual/en/function.sodium-crypto-kdf-derive-from-key.php
 * @param int $subkey_len
 * @param int $subkey_id
 * @param string $context
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kdf_derive_from_key (int $subkey_len, int $subkey_id, string $context, string $key): string {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-kdf-keygen.php
 * @since 7.2
 * @return string
 */
function sodium_crypto_kdf_keygen(): string {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-shorthash-keygen.php
 * @since 7.2
 * @return string
 */
function sodium_crypto_shorthash_keygen(): string {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-stream-keygen.php
 * @since 7.2
 * @return string
 */
function sodium_crypto_stream_keygen(): string {}

/**
 * Add padding data
 * @link https://php.net/manual/en/function.sodium-pad.php
 * @param string $string
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_pad ($string, $length): string {}

/**
 * Remove padding data
 * @link https://php.net/manual/en/function.sodium-unpad.php
 * @param string $string
 * @param int $length
 * @throws SodiumException
 * @since 7.2
 */
function sodium_unpad ($string, $length): string {}



/**
 * Secret-key message verification
 * HMAC SHA-512/256
 * @link https://www.php.net/manual/en/function.sodium-crypto-auth-verify.php
 * @param string $mac
 * @param string $msg
 * @param string $key
 * @return bool
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_auth_verify(
    string $mac,
    string $msg,
    string $key
): bool {
    unset($mac, $msg, $key);
    return false;
}

/**
 * Public-key authenticated encryption (encrypt)
 * X25519 + Xsalsa20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-box.php
 * @param string $msg
 * @param string $nonce
 * @param string $keypair
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box(
    string $msg,
    string $nonce,
    string $keypair
): string {
    unset($msg, $nonce, $keypair);
    return '';
}

/**
 * Generate an X25519 keypair for use with the sodium_crypto_box API
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-keypair.php
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_keypair(): string {
    return '';
}

/**
 * Derive an X25519 keypair for use with the sodium_crypto_box API from a seed
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-seed-keypair.php
 * @param string $seed
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_seed_keypair(
    string $seed
): string {
    unset($seed);
    return '';
}

/**
 * Create an X25519 keypair from an X25519 secret key and X25519 public key
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-keypair-from-secretkey-and-publickey.php
 * @param string $secretkey
 * @param string $publickey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_keypair_from_secretkey_and_publickey(
    string $secretkey,
    string $publickey
): string {
    unset($secretkey, $publickey);
    return '';
}

/**
 * Public-key authenticated encryption (decrypt)
 * X25519 + Xsalsa20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-open.php
 * @param string $msg
 * @param string $nonce
 * @param string $keypair
 * @return string|false
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_open(
    string $msg,
    string $nonce,
    string $keypair
): string {
    unset($msg, $nonce, $keypair);
    return '';
}

/**
 * Get an X25519 public key from an X25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-publickey.php
 * @param string $keypair
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_publickey(
    string $keypair
): string {
    unset($keypair);
    return '';
}

/**
 * Derive an X25519 public key from an X25519 secret key
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-publickey-from-secretkey.php
 * @param string $secretkey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_publickey_from_secretkey(
    string $secretkey
): string {
    unset($secretkey);
    return '';
}

/**
 * Anonymous public-key encryption (encrypt)
 * X25519 + Xsalsa20 + Poly1305 + BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-seal.php
 * @param string $message
 * @param string $publickey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_seal(
    string $message,
    string $publickey
): string {
    unset($message, $publickey);
    return '';
}

/**
 * Anonymous public-key encryption (decrypt)
 * X25519 + Xsalsa20 + Poly1305 + BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-seal-open.php
 * @param string $encrypted
 * @param string $keypair
 * @return string|false
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_seal_open(
    string $encrypted,
    string $keypair
): string {
    unset($encrypted, $keypair);
    return '';
}

/**
 * Extract the X25519 secret key from an X25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-secretkey.php
 * @param string $keypair
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_secretkey(string $keypair): string
{
    unset($keypair);
    return '';
}

/**
 * Elliptic Curve Diffie Hellman Key Exchange
 * X25519
 * @param string $secretkey
 * @param string $publickey
 * @param string $client_publickey
 * @param string $server_publickey
 * @return string
 * @since 7.2
 */
function sodium_crypto_kx(
    string $secretkey,
    string $publickey,
    string $client_publickey,
    string $server_publickey
): string {
    unset($secretkey, $publickey, $client_publickey, $server_publickey);
    return '';
}

/**
 * Fast and secure cryptographic hash
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash.php
 * @param string $input
 * @param string $key
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash(
    string $input,
    string $key = '',
    int $length = 32
): string{
    unset($input, $key, $length);
    return '';
}

/**
 * Create a new hash state (e.g. to use for streams)
 * BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash-init.php
 * @param string $key
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash_init(
    string $key = '',
    int $length = 32
): string {
    unset($key, $length);
    return '';
}

/**
 * Update the hash state with some data
 * BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash-update.php
 * @param string &$state
 * @param string $append
 * @return bool
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash_update(
    string &$state,
    string $append
): bool {
    unset($hashState, $append);
    return '';
}

/**
 * Get the final hash
 * BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash-final.php
 * @param string $state
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash_final(
    string $state,
    int $length = 32
): string {
    unset($state, $length);
    return '';
}

/**
 * Secure password-based key derivation function
 * Argon2i
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash.php
 * @param int $out_len
 * @param string $passwd
 * @param string $salt
 * @param int $opslimit
 * @param int $memlimit
 * @param int $alg [optional]
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash(
    int $out_len,
    string $passwd,
    string $salt,
    int $opslimit,
    int $memlimit,
    int $alg
): string {
    unset($out_len, $passwd, $salt, $opslimit, $memlimit);
    return '';
}

/**
 * Get a formatted password hash (for storage)
 * Argon2i
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-str.php
 * @param string $passwd
 * @param int $opslimit
 * @param int $memlimit
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_str(
    string $passwd,
    int $opslimit,
    int $memlimit
): string {
    unset($passwd, $opslimit, $memlimit);
    return '';
}

/**
 * Verify a password against a hash
 * Argon2i
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-str-verify.php
 * @param string $hash
 * @param string $passwd
 * @return bool
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_str_verify(
    string $hash,
    string $passwd
): bool {
    unset($hash, $passwd);
    return false;
}

/**
 * Secure password-based key derivation function
 * Scrypt
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256.php
 * @param int $out_len
 * @param string $passwd
 * @param string $salt
 * @param int $opslimit
 * @param int $memlimit
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_scryptsalsa208sha256(
    int $length,
    string $passwdord,
    string $salt,
    int $opslimit,
    int $memlimit
): string {
    unset($out_len, $passwd, $salt, $opslimit, $memlimit);
    return '';
}

/**
 * Get a formatted password hash (for storage)
 * Scrypt
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str.php
 * @param string $passwd
 * @param int $opslimit
 * @param int $memlimit
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_scryptsalsa208sha256_str(
    string $passwd,
    int $opslimit,
    int $memlimit
): string {
    unset($passwd, $opslimit, $memlimit);
    return '';
}

/**
 * Verify a password against a hash
 * Scrypt
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str-verify
 * @param string $hash
 * @param string $passwd
 * @return bool
 * @since 7.2
 */
function sodium_crypto_pwhash_scryptsalsa208sha256_str_verify(
    string $hash,
    string $passwd
): bool {
    unset($hash, $passwd);
    return false;
}

/**
 * Elliptic Curve Diffie Hellman over Curve25519
 * X25519
 * @link https://www.php.net/manual/en/function.sodium-crypto-scalarmult.php
 * @param string $ecdhA
 * @param string $ecdhB
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_scalarmult(
    string $ecdhA,
    string $ecdhB
): string {
    unset($ecdhA, $ecdhB);
    return '';
}

/**
 * Authenticated secret-key encryption (encrypt)
 * Xsals20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-secretbox.php
 * @param string $plaintext
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_secretbox(
    string $plaintext,
    string $nonce,
    string $key
): string {
    unset($plaintext, $nonce, $key);
    return '';
}

/**
 * Authenticated secret-key encryption (decrypt)
 * Xsals20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-secretbox-open.php
 * @param string $ciphertext
 * @param string $nonce
 * @param string $key
 * @return string|false
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_secretbox_open(
    string $ciphertext,
    string $nonce,
    string $key
): string {
    unset($ciphertext, $nonce, $key);
    return '';
}

/**
 * A short keyed hash suitable for data structures
 * SipHash-2-4
 * @link https://www.php.net/manual/en/function.sodium-crypto-shorthash.php
 * @param string $message
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_shorthash(
    string $message,
    string $key
): string {
    unset($message, $key);
    return '';
}

/**
 * Digital Signature
 * Ed25519
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign.php
 * @param string $message
 * @param string $secretkey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign(
    string $message,
    string $secretkey
): string {
    unset($message, $secretkey);
    return '';
}

/**
 * Digital Signature (detached)
 * Ed25519
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-detached.php
 * @param string $message
 * @param string $secretkey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_detached(
    string $message,
    string $secretkey
): string {
    unset($message, $secretkey);
    return '';
}

/**
 * Convert an Ed25519 public key to an X25519 public key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-ed25519-pk-to-curve25519.php
 * @param string $sign_pk
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_ed25519_pk_to_curve25519(
    string $sign_pk
): string {
    unset($sign_pk);
    return '';
}

/**
 * Convert an Ed25519 secret key to an X25519 secret key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-ed25519-sk-to-curve25519.php
 * @param string $sign_sk
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_ed25519_sk_to_curve25519(
    string $sign_sk
): string {
    unset($sign_sk);
    return '';
}

/**
 * Generate an Ed25519 keypair for use with the crypto_sign API
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-keypair.php
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_keypair(): string
{
    return '';
}


/**
 * Create an Ed25519 keypair from an Ed25519 secret key + Ed25519 public key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-keypair-from-secretkey-and-publickey.php
 * @param string $secretkey
 * @param string $publickey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_keypair_from_secretkey_and_publickey(
    string $secretkey,
    string $publickey
): string {
    unset($secretkey, $publickey);
    return '';
}

/**
 * Verify a signed message and return the plaintext
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-open.php
 * @param string $signed_message
 * @param string $publickey
 * @return string|false
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_open(
    string $signed_message,
    string $publickey
): string {
    unset($signed_message, $publickey);
    return '';
}

/**
 * Get the public key from an Ed25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-publickey.php
 * @param string $keypair
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_publickey(
    string $keypair
): string {
    unset($keypair);
    return '';
}

/**
 * Get the secret key from an Ed25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-secretkey.php
 * @param string $keypair
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_secretkey(
    string $keypair
): string {
    unset($keypair);
    return '';
}

/**
 * Derive an Ed25519 public key from an Ed25519 secret key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-publickey-from-secretkey.php
 * @param string $secretkey
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_publickey_from_secretkey(
    string $secretkey
): string {
    unset($secretkey);
    return '';
}

/**
 * Derive an Ed25519 keypair for use with the crypto_sign API from a seed
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-seed-keypair.php
 * @param string $seed
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_seed_keypair(
    string $seed
): string {
    unset($seed);
    return '';
}

/**
 * Verify a detached signature
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-verify-detached.php
 * @param string $signature
 * @param string $msg
 * @param string $publickey
 * @return bool
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_verify_detached(
    string $signature,
    string $msg,
    string $publickey
): bool {
    unset($signature, $msg, $publickey);
    return false;
}

/**
 * Create a keystream from a key and nonce
 * Xsalsa20
 * @link https://www.php.net/manual/en/function.sodium-crypto-stream.php
 * @param int $length
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_stream(
    int $length,
    string $nonce,
    string $key
): string {
    unset($length, $nonce, $key);
    return '';
}

/**
 * Encrypt a message using a stream cipher
 * Xsalsa20
 * @link https://www.php.net/manual/en/function.sodium-crypto-stream-xor.php
 * @param string $plaintext
 * @param string $nonce
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_stream_xor(
    string $plaintext,
    string $nonce,
    string $key
): string {
    unset($plaintext, $nonce, $key);
    return '';
}

/**
 * Generate a string of random bytes
 * /dev/urandom
 *
 * @param int $length
 * @return string
 * @since 7.2
 */
function sodium_randombytes_buf(
    int $length
): string {
    unset($length);
    return '';
}

/**
 * Generate a 16-bit integer
 * /dev/urandom
 *
 * @return int
 * @since 7.2
 */
function sodium_randombytes_random16(): int {
    return '';
}

/**
 * Generate an unbiased random integer between 0 and a specified value
 * /dev/urandom
 *
 * @param int $upperBoundNonInclusive
 * @return int
 * @since 7.2
 */
function sodium_randombytes_uniform(
    int $upperBoundNonInclusive
): int {
    unset($upperBoundNonInclusive);
    return 0;
}

/**
 * Convert to hex without side-chanels
 * @link https://www.php.net/manual/en/function.sodium-bin2hex.php
 * @param string $binary
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_bin2hex(
    string $binary
): string {
    unset($binary);
    return '';
}

/**
 * Compare two strings in constant time
 * @link https://www.php.net/manual/en/function.sodium-compare.php
 * @param string $left
 * @param string $right
 * @return int
 * @throws SodiumException
 * @since 7.2
 */
function sodium_compare(
    string $left,
    string $right
): int {
    unset($left, $right);
    return 0;
}

/**
 * Convert from hex without side-chanels
 * @link https://www.php.net/manual/en/function.sodium-hex2bin.php
 * @param string $binary
 * @param string $ignore [optional]
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_hex2bin(
    string $hex, string $ignore
): string {
    unset($hex);
    return '';
}

/**
 * Increment a string in little-endian
 * @link https://www.php.net/manual/en/function.sodium-increment.php
 * @param string &$nonce
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_increment(
    string &$nonce
) {
    unset($nonce);
}

/**
 * Add the right operand to the left
 * @link https://www.php.net/manual/en/function.sodium-add.php
 * @param string &$left
 * @param string $right
 * @throws SodiumException
 * @since 7.2
 */
function sodium_add(
    string &$left,
    string $right
) {
    unset($left, $right);
}

/**
 * Get the true major version of libsodium
 * @return int
 * @since 7.2
 */
function sodium_library_version_major(): int {
    return 0;
}

/**
 * Get the true minor version of libsodium
 * @return int
 * @since 7.2
 */
function sodium_library_version_minor(): int {
    return 0;
}

/**
 * Compare two strings in constant time
 * @link https://www.php.net/manual/en/function.sodium-memcmp.php
 * @param string $left
 * @param string $right
 * @return int
 * @throws SodiumException
 * @since 7.2
 */
function sodium_memcmp(
    string $left,
    string $right
): int {
    unset($right, $left);
    return 0;
}

/**
 * Wipe a buffer
 * @link https://www.php.net/manual/en/function.sodium-memzero.php
 * @param string &$nonce
 * @throws SodiumException
 * @since 7.2
 */
function sodium_memzero(
    &$reference
) {
    $target = '';
}

/**
 * Get the version string
 *
 * @return string
 * @since 7.2
 */
function sodium_version_string(): string {
    return 'NA';
}

/**
 * Scalar multiplication of the base point and your key
 * @link https://www.php.net/manual/en/function.sodium-crypto-scalarmult-base
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_scalarmult_base(
    string $key
): string {
    unset($sk);

    return '';
}

/**
 * Creates a random key
 *
 * It is equivalent to calling random_bytes() but improves code clarity and can
 * prevent misuse by ensuring that the provided key length is always be correct.
 *
 * @since 7.2
 * @see https://secure.php.net/manual/en/function.sodium-crypto-secretbox-keygen.php
 */
function sodium_crypto_secretbox_keygen(): string {}

/**
 * Creates a random key
 *
 * It is equivalent to calling random_bytes() but improves code clarity and can
 * prevent misuse by ensuring that the provided key length is always be correct.
 *
 * @since 7.2
 * @see https://secure.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-keygen.php
 */
function sodium_crypto_aead_aes256gcm_keygen(): string {}

/**
 * Creates a random key
 * It is equivalent to calling random_bytes() but improves code clarity and can
 * prevent misuse by ensuring that the provided key length is always be correct.
 *
 * @since 7.2
 * @see https://secure.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-keygen.php
 */
function sodium_crypto_aead_chacha20poly1305_keygen(): string {}

/**
 * Creates a random key
 *
 * It is equivalent to calling random_bytes() but improves code clarity and can
 * prevent misuse by ensuring that the provided key length is always be correct.
 *
 * @since 7.2
 * @see https://secure.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-keygen.php
 */
function sodium_crypto_aead_chacha20poly1305_ietf_keygen(): string {}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-decrypt.php
 */
function sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(string $ciphertext,string $ad,string $nonce,string $key): string {}

/**
 * @throws SodiumException
 * @since 7.2
 * https://www.php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-encrypt.php
 */
function sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(string $msg, string $ad, string $nonce, string $key): string{}

/**
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-keygen.php
 */
function sodium_crypto_aead_xchacha20poly1305_ietf_keygen():string {}

/**
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-pwhash-str-needs-rehash.php
 */
function sodium_crypto_pwhash_str_needs_rehash(string $password, int $opslimit, int $memlimit): bool{}

/**
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-keygen.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_keygen(): string {}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-init-push.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_init_push(string $key): array{}

/**
 * @param string &$state
 * @param string $msg
 * @param string $ad [optional]
 * @param int $tag [optional]
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-push.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_push(string &$state, string $msg, string $ad, int $tag): string{}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-init-pull.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_init_pull($header, $key): string{}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-pull.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_pull(string &$state, string $c, string $ad = ''): array {}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-rekey.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_rekey(string &$state): void{}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-bin2base64.php
 */
function sodium_bin2base64(string $bin, int $id): string {}

/**
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-base642bin.php
 */
function sodium_base642bin(string $b64, int $id, string $ignore = ''){}

class SodiumException extends Exception {

}
