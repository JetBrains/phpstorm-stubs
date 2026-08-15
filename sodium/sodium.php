<?php

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use JetBrains\PhpStorm\Internal\PhpStormStubsElementAvailable;

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
const SODIUM_LIBRARY_VERSION = "1.0.19";
const SODIUM_LIBRARY_MAJOR_VERSION = 26;
const SODIUM_LIBRARY_MINOR_VERSION = 1;
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
const SODIUM_CRYPTO_STREAM_XCHACHA20_NONCEBYTES = 24;
const SODIUM_CRYPTO_STREAM_XCHACHA20_KEYBYTES = 32;
const SODIUM_CRYPTO_SCALARMULT_RISTRETTO255_BYTES = 32;
const SODIUM_CRYPTO_SCALARMULT_RISTRETTO255_SCALARBYTES = 32;
const SODIUM_CRYPTO_CORE_RISTRETTO255_BYTES = 32;
const SODIUM_CRYPTO_CORE_RISTRETTO255_HASHBYTES = 64;
const SODIUM_CRYPTO_CORE_RISTRETTO255_SCALARBYTES = 32;
const SODIUM_CRYPTO_CORE_RISTRETTO255_NONREDUCEDSCALARBYTES = 64;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_BYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_KEYBYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_ND_INPUTBYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_ND_KEYBYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_ND_OUTPUTBYTES = 24;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_ND_TWEAKBYTES = 8;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_NDX_INPUTBYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_NDX_KEYBYTES = 32;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_NDX_OUTPUTBYTES = 32;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_NDX_TWEAKBYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_PFX_BYTES = 16;
/** @since 8.6 */
const SODIUM_CRYPTO_IPCRYPT_PFX_KEYBYTES = 32;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_SHAKE128_BLOCKBYTES = 168;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_SHAKE128_STATEBYTES = 256;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_SHAKE256_BLOCKBYTES = 136;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_SHAKE256_STATEBYTES = 256;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_TURBOSHAKE128_BLOCKBYTES = 168;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_TURBOSHAKE128_STATEBYTES = 256;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_TURBOSHAKE256_BLOCKBYTES = 136;
/** @since 8.6 */
const SODIUM_CRYPTO_XOF_TURBOSHAKE256_STATEBYTES = 256;

/**
 * Adds an element
 *
 * Adds an element q to p. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-add.php
 * @param string $p An element.
 * @param string $q An element.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_add(string $p, string $q): string {}

/**
 * Maps a vector
 *
 * Maps a 64-bytes vector s to a group element. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-from-hash.php
 * @param string $s A 64-bytes vector.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_from_hash(string $s): string {}

/**
 * Determines if a point on the ristretto255 curve
 *
 * Determines if a point on the ristretto255 curve, in canonical form, on the main subgroup, and
 * that the point doesn't have a small order. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-is-valid-point.php
 * @param string $s An Elliptic-curve point.
 * @return bool Returns true if s is on the ristretto255 curve, false otherwise.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_is_valid_point(string $s): bool {}

/**
 * Generates a random key
 *
 * Generates a random key. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-random.php
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_random(): string {}

/**
 * Adds a scalar value
 *
 * Adds an element y to x. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-add.php
 * @param string $x Scalar, representing the X coordinate.
 * @param string $y Scalar, representing the Y coordinate.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_add(string $x, string $y): string {}

/**
 * The sodium_crypto_core_ristretto255_scalar_complement purpose
 *
 * Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-complement.php
 * @param string $s Scalar value.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_complement(string $s): string {}

/**
 * Inverts a scalar value
 *
 * Inverts a scalar value. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-invert.php
 * @param string $s Scalar value.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_invert(string $s): string {}

/**
 * Multiplies a scalar value
 *
 * Multiplies a scalar value. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-mul.php
 * @param string $x Scalar, representing the X coordinate.
 * @param string $y Scalar, representing the Y coordinate.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_mul(string $x, string $y): string {}

/**
 * Negates a scalar value
 *
 * Negates a scalar value. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-negate.php
 * @param string $s Scalar value.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_negate(string $s): string {}

/**
 * Reduces a scalar value
 *
 * Reduces a scalar value. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-reduce.php
 * @param string $s Scalar value.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_reduce(string $s): string {}

/**
 * Subtracts a scalar value
 *
 * Subtracts a scalar y from x. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-sub.php
 * @param string $x Scalar, representing the X coordinate.
 * @param string $y Scalar, representing the Y coordinate.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_sub(string $x, string $y): string {}

/**
 * Generates a random key
 *
 * Generates a random key. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-scalar-random.php
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_scalar_random(): string {}

/**
 * Subtracts an element
 *
 * Subtracts an element q from p. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-core-ristretto255-sub.php
 * @param string $p An element.
 * @param string $q An element.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_core_ristretto255_sub(string $p, string $q): string {}

/**
 * Computes a shared secret
 *
 * Calculates scalar n times point p. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-scalarmult-ristretto255.php
 * @param string $n A scalar, which is typically a secret key.
 * @param string $p A point (x-coordinate), which is typically a public key.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_scalarmult_ristretto255(string $n, string $p): string {}

/**
 * Calculates the public key from a secret key
 *
 * Given a secret key, calculates the corresponding public key. Available as of libsodium 1.0.18.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-scalarmult-ristretto255-base.php
 * @param string $n A secret key.
 * @return string Returns a 32-byte random string.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_scalarmult_ristretto255_base(string $n): string {}

/**
 * Expands the key and nonce into a keystream of pseudorandom bytes
 * @link https://php.net/manual/en/function.sodium-crypto-stream-xchacha20.php
 * @param int $length Number of bytes desired.
 * @param string $nonce 24-byte nonce.
 * @param string $key Key, possibly generated from sodium_crypto_stream_xchacha20_keygen.
 * @return string Returns a pseudorandom stream that can be used with
 * sodium_crypto_stream_xchacha20_xor.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_stream_xchacha20(int $length, string $nonce, string $key): string {}

/**
 * Encrypts a message using a nonce and a secret key (no authentication)
 * @link https://php.net/manual/en/function.sodium-crypto-stream-xchacha20-xor.php
 * @param string $message The message to encrypt.
 * @param string $nonce 24-byte nonce.
 * @param string $key Key, possibly generated from sodium_crypto_stream_xchacha20_keygen.
 * @return string Encrypted message.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_stream_xchacha20_xor(string $message, string $nonce, string $key): string {}

/**
 * Encrypts a message using a nonce and a secret key (no authentication)
 *
 * The function is similar to sodium_crypto_stream_xchacha20_xor but adds the ability to set the
 * initial value of the block counter to a non-zero value. This permits direct access to any block
 * without having to compute the previous ones.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-stream-xchacha20-xor-ic.php
 * @param string $message The message to encrypt.
 * @param string $nonce 24-byte nonce.
 * @param int $counter The initial value of the block counter.
 * @param string $key Key, possibly generated from sodium_crypto_stream_xchacha20_keygen.
 * @return string Encrypted message.
 */
#[PhpStormStubsElementAvailable('8.2')]
function sodium_crypto_stream_xchacha20_xor_ic(#[\SensitiveParameter] string $message, string $nonce, int $counter, #[\SensitiveParameter] string $key): string {}

/**
 * Returns a secure random key
 *
 * Returns a secure random key for use with sodium_crypto_stream_xchacha20.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-stream-xchacha20-keygen.php
 * @return string Returns a 32-byte secure random key for use with sodium_crypto_stream_xchacha20.
 */
#[PhpStormStubsElementAvailable('8.1')]
function sodium_crypto_stream_xchacha20_keygen(): string {}

/**
 * Can you access AES-256-GCM? This is only available if you have supported
 * hardware.
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-is-available
 * @return bool Returns true if it is safe to encrypt with AES-256-GCM, and false otherwise.
 * @since 7.2
 */
function sodium_crypto_aead_aes256gcm_is_available(): bool {}

/**
 * Authenticated Encryption with Associated Data (decrypt)
 * AES-256-GCM
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-decrypt.php
 * @param string $ciphertext encrypted message
 * @param string $additional_data additional data
 * @param string $nonce A number that must be only used once, per message. 12 bytes long.
 * @param string $key Encryption key (256-bit).
 * @return string|false Returns the plaintext on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_aes256gcm_decrypt(string $ciphertext, string $additional_data, string $nonce, string $key): string|false {}

/**
 * Authenticated Encryption with Associated Data (encrypt)
 * AES-256-GCM
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-encrypt.php
 * @param string $message plaintext message
 * @param string $additional_data Additional, authenticated data. This is used in the verification
 * of the authentication tag appended to the ciphertext, but it is not encrypted or stored in the
 * ciphertext.
 * @param string $nonce A number that must be only used once, per message. 12 bytes long.
 * @param string $key Encryption key (256-bit).
 * @return string Returns the ciphertext and authentication tag as a string of raw binary bytes.
 * (Format: ciphertext, then tag.)
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_aes256gcm_encrypt(string $message, string $additional_data, string $nonce, string $key): string {}

/**
 * Authenticated Encryption with Associated Data (decrypt)
 * ChaCha20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-decrypt.php
 * @param string $ciphertext encrypted message
 * @param string $additional_data additional data
 * @param string $nonce A number that must be only used once, per message. 8 bytes long.
 * @param string $key Encryption key (256-bit).
 * @return string|false Returns the plaintext on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_decrypt(string $ciphertext, string $additional_data, string $nonce, string $key): string|false {}

/**
 * Authenticated Encryption with Associated Data (encrypt)
 * ChaCha20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-encrypt.php
 * @param string $message plaintext message
 * @param string $additional_data additional data
 * @param string $nonce A number that must be only used once, per message. 8 bytes long.
 * @param string $key Encryption key (256-bit).
 * @return string Returns the ciphertext and authentication tag as a string of raw binary bytes.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_encrypt(string $message, string $additional_data, string $nonce, string $key): string {}

/**
 * Authenticated Encryption with Associated Data (decrypt)
 * ChaCha20 + Poly1305 (IETF version)
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-decrypt.php
 * @param string $ciphertext encrypted message
 * @param string $additional_data additional data
 * @param string $nonce A number that must be only used once, per message. 12 bytes long.
 * @param string $key Encryption key (256-bit).
 * @return string|false Returns the plaintext on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_ietf_decrypt(string $ciphertext, string $additional_data, string $nonce, string $key): string|false {}

/**
 * Authenticated Encryption with Associated Data (encrypt)
 * ChaCha20 + Poly1305 (IETF version)
 * @link https://www.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-encrypt.php
 * @param string $message plaintext message
 * @param string $additional_data additional data
 * @param string $nonce A number that must be only used once, per message. 12 bytes long.
 * @param string $key Encryption key (256-bit).
 * @return string Returns the ciphertext and authentication tag as a string of raw binary bytes.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_aead_chacha20poly1305_ietf_encrypt(
    string $message,
    string $additional_data,
    string $nonce,
    string $key
): string {}

/**
 * Secret-key message authentication
 * HMAC SHA-512/256
 * @link https://www.php.net/manual/en/function.sodium-crypto-auth.php
 * @param string $message The message you intend to authenticate
 * @param string $key Authentication key
 * @return string Authentication tag
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_auth(
    string $message,
    string $key
): string {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-auth-keygen.php
 * @return string Returns a 256-bit random key.
 * @since 7.2
 */
function sodium_crypto_auth_keygen(): string {}

/**
 * Creates a new sodium keypair
 *
 * Create a new sodium keypair consisting of the secret key (32 bytes) followed by the public key
 * (32 bytes). The keys can be retrieved by calling sodium_crypto_kx_secretkey and
 * sodium_crypto_kx_publickey, respectively.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-kx-keypair.php
 * @since 7.2
 * @return string Returns the new keypair on success; throws an exception otherwise.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_keypair(): string {}

/**
 * Extract the public key from a crypto_kx keypair
 * @link https://php.net/manual/en/function.sodium-crypto-kx-publickey.php
 * @since 7.2
 * @param string $key_pair X25519 keypair, such as one generated by sodium_crypto_kx_keypair.
 * @return string X25519 public key.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_publickey(string $key_pair): string {}

/**
 * Extract the secret key from a crypto_kx keypair.
 * @link https://php.net/manual/en/function.sodium-crypto-kx-secretkey.php
 * @param string $key_pair X25519 keypair, such as one generated by sodium_crypto_kx_keypair.
 * @return string X25519 secret key.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_secretkey(string $key_pair): string {}

/**
 * Description
 * @link https://php.net/manual/en/function.sodium-crypto-kx-seed-keypair.php
 * @since 7.2
 * @param string $seed
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_seed_keypair(string $seed): string {}

/**
 * Calculate the server-side session keys.
 *
 * Calculate the server-side session keys, using the X25519 + BLAKE2b key-exchange method.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-kx-server-session-keys.php
 * @since 7.2
 * @param string $server_key_pair A crypto_kx keypair, such as one generated by
 * sodium_crypto_kx_keypair.
 * @param string $client_key A crypto_kx public key.
 * @return string[] An array consisting of two strings. The first should be used for receiving data
 * from the client. The second should be used for sending data to the client.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_server_session_keys(string $server_key_pair, string $client_key): array {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-generichash-keygen.php
 * @return string A random 256-bit key.
 * @since 7.2
 */
function sodium_crypto_generichash_keygen(): string {}

/**
 * Calculate the client-side session keys.
 *
 * Calculate the client-side session keys, using the X25519 + BLAKE2b key-exchange method.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-kx-client-session-keys.php
 * @param string $client_key_pair A crypto_kx keypair, such as one generated by
 * sodium_crypto_kx_keypair.
 * @param string $server_key A crypto_kx public key.
 * @return string[] An array consisting of two strings. The first should be used for receiving data
 * from the server. The second should be used for sending data to the server.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kx_client_session_keys(string $client_key_pair, string $server_key): array {}

/**
 * Derive a subkey
 *
 * Derive a subkey from a root key and additional context.
 *
 * @link https://www.php.net/manual/en/function.sodium-crypto-kdf-derive-from-key.php
 * @param int $subkey_length Length of the key to return (in bytes)
 * @param int $subkey_id Return the Nth subkey from a given root key. Useful for seeking.
 * @param string $context Application-specific context.
 * @param string $key The root key from which the subkey is derived.
 * @return string A string of pseudorandom (raw binary) bytes.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_kdf_derive_from_key(int $subkey_length, int $subkey_id, string $context, string $key): string {}

/**
 * Get random bytes for key
 * @link https://php.net/manual/en/function.sodium-crypto-kdf-keygen.php
 * @since 7.2
 * @return string A random 256-bit key.
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
 * @return string Encryption key (256-bit).
 */
function sodium_crypto_stream_keygen(): string {}

/**
 * Add padding data
 * @link https://php.net/manual/en/function.sodium-pad.php
 * @param string $string Unpadded string.
 * @param int $block_size The string will be padded until it is an even multiple of the block size.
 * @return string Padded string.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_pad(string $string, int $block_size): string {}

/**
 * Remove padding data
 * @link https://php.net/manual/en/function.sodium-unpad.php
 * @param string $string Padded string.
 * @param int $block_size The block size for padding.
 * @return string Unpadded string.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_unpad(string $string, int $block_size): string {}

/**
 * Secret-key message verification
 * HMAC SHA-512/256
 * @link https://www.php.net/manual/en/function.sodium-crypto-auth-verify.php
 * @param string $mac Authentication tag produced by sodium_crypto_auth
 * @param string $message Message
 * @param string $key Authentication key
 * @return bool Returns true on success or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_auth_verify(string $mac, string $message, string $key): bool {}

/**
 * Public-key authenticated encryption (encrypt)
 * X25519 + Xsalsa20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-box.php
 * @param string $message The message to be encrypted.
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key_pair See sodium_crypto_box_keypair_from_secretkey_and_publickey. This should
 * include the sender's X25519 secret key and the recipient's X25519 public key.
 * @return string Returns the encrypted message (ciphertext plus authentication tag). The ciphertext
 * will be 16 bytes longer than the plaintext, and a raw binary string. See sodium_bin2base64 for
 * safe encoding for storage.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box(string $message, string $nonce, string $key_pair): string {}

/**
 * Generate an X25519 keypair for use with the sodium_crypto_box API
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-keypair.php
 * @return string One string containing both the X25519 secret key and corresponding X25519 public
 * key.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_keypair(): string {}

/**
 * Derive an X25519 keypair for use with the sodium_crypto_box API from a seed
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-seed-keypair.php
 * @param string $seed Some cryptographic input. Must be 32 bytes.
 * @return string X25519 Keypair (secret key and public key).
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_seed_keypair(string $seed): string {}

/**
 * Create an X25519 keypair from an X25519 secret key and X25519 public key
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-keypair-from-secretkey-and-publickey.php
 * @param string $secret_key Secret key.
 * @param string $public_key Public key.
 * @return string X25519 Keypair.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_keypair_from_secretkey_and_publickey(string $secret_key, string $public_key): string {}

/**
 * Public-key authenticated encryption (decrypt)
 * X25519 + Xsalsa20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-open.php
 * @param string $ciphertext The encrypted message to attempt to decrypt.
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key_pair See sodium_crypto_box_keypair_from_secretkey_and_publickey. This should
 * include the sender's public key and the recipient's secret key.
 * @return string|false Returns the plaintext message on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_open(string $ciphertext, string $nonce, string $key_pair): string|false {}

/**
 * Get an X25519 public key from an X25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-publickey.php
 * @param string $key_pair A keypair, such as one generated by sodium_crypto_box_keypair or
 * sodium_crypto_box_seed_keypair
 * @return string X25519 public key.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_publickey(string $key_pair): string {}

/**
 * Derive an X25519 public key from an X25519 secret key
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-publickey-from-secretkey.php
 * @param string $secret_key X25519 secret key
 * @return string X25519 public key.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_publickey_from_secretkey(string $secret_key): string {}

/**
 * Anonymous public-key encryption (encrypt)
 * X25519 + Xsalsa20 + Poly1305 + BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-seal.php
 * @param string $message The message to encrypt.
 * @param string $public_key The public key that corresponds to the only key that can decrypt the
 * message.
 * @return string A ciphertext string in the format of (one-time public key, encrypted message,
 * authentication tag).
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_seal(string $message, string $public_key): string {}

/**
 * Anonymous public-key encryption (decrypt)
 * X25519 + Xsalsa20 + Poly1305 + BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-seal-open.php
 * @param string $ciphertext The encrypted message
 * @param string $key_pair The keypair of the recipient. Must include the secret key.
 * @return string|false The plaintext on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_seal_open(string $ciphertext, string $key_pair): string|false {}

/**
 * Extract the X25519 secret key from an X25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-box-secretkey.php
 * @param string $key_pair A keypair, such as one generated by sodium_crypto_box_keypair or
 * sodium_crypto_box_seed_keypair
 * @return string X25519 secret key.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_box_secretkey(string $key_pair): string {}

/**
 * Elliptic Curve Diffie Hellman Key Exchange
 * X25519
 * @param string $secret_key
 * @param string $public_key
 * @param string $client_publickey
 * @param string $server_publickey
 * @return string
 * @since 7.2
 */
function sodium_crypto_kx(
    string $secret_key,
    string $public_key,
    string $client_publickey,
    string $server_publickey
): string {}

/**
 * Fast and secure cryptographic hash
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash.php
 * @param string $message The message being hashed.
 * @param string $key (Optional) cryptographic key. This serves the same function as a HMAC key, but
 * it's utilized as a reserved section of the internal BLAKE2 state.
 * @param int $length Output size.
 * @return string The cryptographic hash as raw bytes. If a hex-encoded output is desired, the
 * result can be passed to sodium_bin2hex.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash(string $message, string $key = '', int $length = 32): string {}

/**
 * Create a new hash state (e.g. to use for streams)
 * BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash-init.php
 * @param string $key The generichash key.
 * @param int $length The expected output length of the hash function.
 * @return string Returns a hash state, serialized as a raw binary string.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash_init(
    string $key = '',
    int $length = 32
): string {}

/**
 * Update the hash state with some data
 * BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash-update.php
 * @param string &$state The return value of sodium_crypto_generichash_init.
 * @param string $message Data to append to the hashing state.
 * @return bool Always returns true.
 * @throws SodiumException
 * @since 7.2
 */
#[LanguageLevelTypeAware(['8.2' => 'true'], default: 'bool')]
function sodium_crypto_generichash_update(string &$state, string $message) {}

/**
 * Get the final hash
 * BLAKE2b
 * @link https://www.php.net/manual/en/function.sodium-crypto-generichash-final.php
 * @param string &$state Hash state returned from sodium_crypto_generichash_init
 * @param int $length Output length.
 * @return string Cryptographic hash.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_generichash_final(
    string &$state,
    int $length = 32
): string {}

/**
 * Secure password-based key derivation function
 * Argon2i
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash.php
 * @param int $length int; The length of the password hash to generate, in bytes.
 * @param string $password string; The password to generate a hash for.
 * @param string $salt A salt to add to the password before hashing. The salt should be
 * unpredictable, ideally generated from a good random number source such as random_bytes, and have
 * a length of exactly SODIUM_CRYPTO_PWHASH_SALTBYTES bytes.
 * @param int $opslimit Represents a maximum amount of computations to perform. Raising this number
 * will make the function require more CPU cycles to compute a key. There are some constants
 * available to set the operations limit to appropriate values depending on intended use, in order
 * of strength: SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE
 * and SODIUM_CRYPTO_PWHASH_OPSLIMIT_SENSITIVE.
 * @param int $memlimit The maximum amount of RAM that the function will use, in bytes. There are
 * constants to help you choose an appropriate value, in order of size:
 * SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE, and
 * SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE. Typically these should be paired with the matching
 * opslimit values.
 * @param int $algo [optional]
 * @return string Returns the derived key. The return value is a binary string of the hash, not an
 * ASCII-encoded representation, and does not contain additional information about the parameters
 * used to create the hash, so you will need to keep that information if you are ever going to
 * verify the password in future. Use sodium_crypto_pwhash_str to avoid needing to do all that.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash(int $length, string $password, string $salt, int $opslimit, int $memlimit, int $algo = SODIUM_CRYPTO_PWHASH_ALG_DEFAULT): string {}

/**
 * Get a formatted password hash (for storage)
 * Argon2i
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-str.php
 * @param string $password string; The password to generate a hash for.
 * @param int $opslimit Represents a maximum amount of computations to perform. Raising this number
 * will make the function require more CPU cycles to compute a key. There are constants available to
 * set the operations limit to appropriate values depending on intended use, in order of strength:
 * SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_OPSLIMIT_MODERATE and
 * SODIUM_CRYPTO_PWHASH_OPSLIMIT_SENSITIVE.
 * @param int $memlimit The maximum amount of RAM that the function will use, in bytes. There are
 * constants to help you choose an appropriate value, in order of size:
 * SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE, SODIUM_CRYPTO_PWHASH_MEMLIMIT_MODERATE, and
 * SODIUM_CRYPTO_PWHASH_MEMLIMIT_SENSITIVE. Typically these should be paired with the matching
 * opslimit values.
 * @return string Returns the hashed password. In order to produce the same password hash from the
 * same password, the same values for opslimit and memlimit must be used. These are embedded within
 * the generated hash, so everything that's needed to verify the hash is included. This allows the
 * sodium_crypto_pwhash_str_verify function to verify the hash without needing separate storage for
 * the other parameters.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_str(string $password, int $opslimit, int $memlimit): string {}

/**
 * Verify a password against a hash
 * Argon2i
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-str-verify.php
 * @param string $hash A hash created by password_hash.
 * @param string $password The user's password.
 * @return bool Returns true if the password and hash match, or false otherwise.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_str_verify(string $hash, string $password): bool {}

/**
 * Secure password-based key derivation function
 * Scrypt
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256.php
 * @param int $length The length of the password hash to generate, in bytes.
 * @param string $password The password to generate a hash for.
 * @param string $salt A salt to add to the password before hashing. The salt should be
 * unpredictable, ideally generated from a good random number source such as random_bytes, and have
 * a length of at least SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_SALTBYTES bytes.
 * @param int $opslimit Represents a maximum amount of computations to perform. Raising this number
 * will make the function require more CPU cycles to compute a key. There are some constants
 * available to set the operations limit to appropriate values depending on intended use, in order
 * of strength: SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_INTERACTIVE and
 * SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_OPSLIMIT_SENSITIVE.
 * @param int $memlimit The maximum amount of RAM that the function will use, in bytes. There are
 * constants to help you choose an appropriate value, in order of size:
 * SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_INTERACTIVE and
 * SODIUM_CRYPTO_PWHASH_SCRYPTSALSA208SHA256_MEMLIMIT_SENSITIVE. Typically these should be paired
 * with the matching opslimit values.
 * @return string A string of bytes of the desired length.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_scryptsalsa208sha256(
    int $length,
    string $password,
    string $salt,
    int $opslimit,
    int $memlimit,
    #[PhpStormStubsElementAvailable(from: '7.2', to: '7.4')] $alg = null
): string {}

/**
 * Get a formatted password hash (for storage)
 * Scrypt
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str.php
 * @param string $password
 * @param int $opslimit
 * @param int $memlimit
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_pwhash_scryptsalsa208sha256_str(string $password, int $opslimit, int $memlimit): string {}

/**
 * Verify a password against a hash
 * Scrypt
 * @link https://www.php.net/manual/en/function.sodium-crypto-pwhash-scryptsalsa208sha256-str-verify
 * @param string $hash
 * @param string $password
 * @return bool
 * @since 7.2
 */
function sodium_crypto_pwhash_scryptsalsa208sha256_str_verify(string $hash, string $password): bool {}

/**
 * Elliptic Curve Diffie Hellman over Curve25519
 * X25519
 * @link https://www.php.net/manual/en/function.sodium-crypto-scalarmult.php
 * @param string $n scalar, which is typically a secret key
 * @param string $p point (x-coordinate), which is typically a public key
 * @return string A 32-byte random string.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_scalarmult(string $n, string $p): string {}

/**
 * Authenticated secret-key encryption (encrypt)
 * Xsals20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-secretbox.php
 * @param string $message The plaintext message to encrypt.
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key Encryption key (256-bit).
 * @return string Returns the encrypted string.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_secretbox(string $message, string $nonce, string $key): string {}

/**
 * Authenticated secret-key encryption (decrypt)
 * Xsals20 + Poly1305
 * @link https://www.php.net/manual/en/function.sodium-crypto-secretbox-open.php
 * @param string $ciphertext Must be in the format provided by sodium_crypto_secretbox (ciphertext
 * and tag, concatenated).
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key Encryption key (256-bit).
 * @return string|false The decrypted string on success or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_secretbox_open(string $ciphertext, string $nonce, string $key): string|false {}

/**
 * A short keyed hash suitable for data structures
 * SipHash-2-4
 * @link https://www.php.net/manual/en/function.sodium-crypto-shorthash.php
 * @param string $message The message to hash.
 * @param string $key The hash key.
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_shorthash(string $message, string $key): string {}

/**
 * Digital Signature
 * Ed25519
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign.php
 * @param string $message Message to sign.
 * @param string $secret_key Secret key. See sodium_crypto_sign_secretkey
 * @return string Signed message (not encrypted).
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign(string $message, string $secret_key): string {}

/**
 * Digital Signature (detached)
 * Ed25519
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-detached.php
 * @param string $message Message to sign.
 * @param string $secret_key Secret key. See sodium_crypto_sign_secretkey
 * @return string Cryptographic signature.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_detached(string $message, string $secret_key): string {}

/**
 * Convert an Ed25519 public key to an X25519 public key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-ed25519-pk-to-curve25519.php
 * @param string $public_key Public key suitable for the crypto_sign functions.
 * @return string Public key suitable for the crypto_box functions.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_ed25519_pk_to_curve25519(string $public_key): string {}

/**
 * Convert an Ed25519 secret key to an X25519 secret key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-ed25519-sk-to-curve25519.php
 * @param string $secret_key Secret key suitable for the crypto_sign functions.
 * @return string Secret key suitable for the crypto_box functions.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_ed25519_sk_to_curve25519(string $secret_key): string {}

/**
 * Generate an Ed25519 keypair for use with the crypto_sign API
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-keypair.php
 * @return string Ed25519 keypair.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_keypair(): string {}

/**
 * Create an Ed25519 keypair from an Ed25519 secret key + Ed25519 public key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-keypair-from-secretkey-and-publickey.php
 * @param string $secret_key Ed25519 secret key
 * @param string $public_key Ed25519 public key
 * @return string Keypair
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_keypair_from_secretkey_and_publickey(
    string $secret_key,
    string $public_key
): string {}

/**
 * Verify a signed message and return the plaintext
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-open.php
 * @param string $signed_message A message signed with sodium_crypto_sign
 * @param string $public_key An Ed25519 public key
 * @return string|false Returns the original signed message on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_open(string $signed_message, string $public_key): string|false {}

/**
 * Get the public key from an Ed25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-publickey.php
 * @param string $key_pair Ed25519 keypair (see: sodium_crypto_sign_keypair)
 * @return string Ed25519 public key
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_publickey(string $key_pair): string {}

/**
 * Get the secret key from an Ed25519 keypair
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-secretkey.php
 * @param string $key_pair Ed25519 keypair (see: sodium_crypto_sign_keypair)
 * @return string Ed25519 secret key
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_secretkey(string $key_pair): string {}

/**
 * Derive an Ed25519 public key from an Ed25519 secret key
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-publickey-from-secretkey.php
 * @param string $secret_key Ed25519 secret key
 * @return string Ed25519 public key
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_publickey_from_secretkey(string $secret_key): string {}

/**
 * Derive an Ed25519 keypair for use with the crypto_sign API from a seed
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-seed-keypair.php
 * @param string $seed Some cryptographic input. Must be 32 bytes.
 * @return string Keypair (secret key and public key)
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_seed_keypair(string $seed): string {}

/**
 * Verify a detached signature
 * @link https://www.php.net/manual/en/function.sodium-crypto-sign-verify-detached.php
 * @param string $signature The cryptographic signature obtained from sodium_crypto_sign_detached
 * @param string $message The message being verified
 * @param string $public_key Ed25519 public key
 * @return bool Returns true on success or false on failure.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_sign_verify_detached(string $signature, string $message, string $public_key): bool {}

/**
 * Create a keystream from a key and nonce
 * Xsalsa20
 * @link https://www.php.net/manual/en/function.sodium-crypto-stream.php
 * @param int $length The number of bytes to return.
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key Encryption key (256-bit).
 * @return string String of pseudorandom bytes.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_stream(
    int $length,
    string $nonce,
    string $key
): string {}

/**
 * Encrypt a message using a stream cipher
 * Xsalsa20
 * @link https://www.php.net/manual/en/function.sodium-crypto-stream-xor.php
 * @param string $message The message to encrypt
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key Encryption key (256-bit).
 * @return string Encrypted message.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_stream_xor(
    string $message,
    string $nonce,
    string $key
): string {}

/**
 * Generate a string of random bytes
 * /dev/urandom
 *
 * @param int $length
 * @return string|false
 * @since 7.2
 */
function sodium_randombytes_buf(int $length): string {}

/**
 * Generate a 16-bit integer
 * /dev/urandom
 *
 * @return int
 * @since 7.2
 */
function sodium_randombytes_random16(): int {}

/**
 * Generate an unbiased random integer between 0 and a specified value
 * /dev/urandom
 *
 * @param int $upperBoundNonInclusive
 * @return int
 * @since 7.2
 */
function sodium_randombytes_uniform(int $upperBoundNonInclusive): int {}

/**
 * Convert to hex without side-channels
 * @link https://www.php.net/manual/en/function.sodium-bin2hex.php
 * @param string $string Raw binary string.
 * @return string Hex encoded string.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_bin2hex(string $string): string {}

/**
 * Compare two strings in constant time
 * @link https://www.php.net/manual/en/function.sodium-compare.php
 * @param string $string1 Left operand
 * @param string $string2 Right operand
 * @return int Returns -1 if string1 is less than string2. Returns 1 if string1 is greater than
 * string2. Returns 0 if both strings are equal.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_compare(string $string1, string $string2): int {}

/**
 * Convert from hex without side-channels
 * @link https://www.php.net/manual/en/function.sodium-hex2bin.php
 * @param string $string Hexadecimal representation of data.
 * @param string $ignore Optional string argument for characters to ignore.
 * @return string Returns the binary representation of the given string data.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_hex2bin(string $string, string $ignore = ''): string {}

/**
 * Increment a string in little-endian
 * @link https://www.php.net/manual/en/function.sodium-increment.php
 * @param string &$string String to increment.
 * @return void No value is returned.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_increment(string &$string): void {}

/**
 * Add the right operand to the left
 * @link https://www.php.net/manual/en/function.sodium-add.php
 * @param string &$string1 String representing an arbitrary-length unsigned integer in little-endian
 * byte order. This parameter is passed by reference and will hold the sum of the two parameters.
 * @param string $string2 String representing an arbitrary-length unsigned integer in little-endian
 * byte order.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_add(string &$string1, string $string2): void {}

/**
 * Get the true major version of libsodium
 * @return int
 * @since 7.2
 */
function sodium_library_version_major(): int {}

/**
 * Get the true minor version of libsodium
 * @return int
 * @since 7.2
 */
function sodium_library_version_minor(): int {}

/**
 * Compare two strings in constant time
 * @link https://www.php.net/manual/en/function.sodium-memcmp.php
 * @param string $string1 String to compare
 * @param string $string2 Other string to compare
 * @return int Returns 0 if both strings are equal; -1 otherwise.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_memcmp(string $string1, string $string2): int {}

/**
 * Wipe a buffer
 * @link https://www.php.net/manual/en/function.sodium-memzero.php
 * @param string &$string String.
 * @throws SodiumException
 * @since 7.2
 */
function sodium_memzero(string &$string): void {}

/**
 * Get the version string
 *
 * @return string
 * @since 7.2
 */
function sodium_version_string(): string {}

/**
 * Scalar multiplication of the base point and your key
 * @link https://www.php.net/manual/en/function.sodium-crypto-scalarmult-base
 * @param string $secret_key
 * @return string
 * @throws SodiumException
 * @since 7.2
 */
function sodium_crypto_scalarmult_base(
    string $secret_key,
    #[PhpStormStubsElementAvailable(from: '7.2', to: '7.4')] $string_2
): string {}

/**
 * Creates a random key
 *
 * It is equivalent to calling random_bytes() but improves code clarity and can
 * prevent misuse by ensuring that the provided key length is always be correct.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-secretbox-keygen.php
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
 * @link https://php.net/manual/en/function.sodium-crypto-aead-aes256gcm-keygen.php
 * @since 7.2
 * @see https://secure.php.net/manual/en/function.sodium-crypto-aead-aes256gcm-keygen.php
 */
function sodium_crypto_aead_aes256gcm_keygen(): string {}

/**
 * Creates a random key
 * It is equivalent to calling random_bytes() but improves code clarity and can
 * prevent misuse by ensuring that the provided key length is always be correct.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-keygen.php
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
 * @link https://php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-keygen.php
 * @since 7.2
 * @see https://secure.php.net/manual/en/function.sodium-crypto-aead-chacha20poly1305-ietf-keygen.php
 */
function sodium_crypto_aead_chacha20poly1305_ietf_keygen(): string {}

/**
 * (Preferred) Verify then decrypt with XChaCha20-Poly1305
 *
 * Verify then decrypt with ChaCha20-Poly1305 (eXtended-nonce variant).
 *
 * @link https://php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-decrypt.php
 * @param string $ciphertext Must be in the format provided by
 * sodium_crypto_aead_xchacha20poly1305_ietf_encrypt (ciphertext and tag, concatenated).
 * @param string $additional_data Additional, authenticated data. This is used in the verification
 * of the authentication tag appended to the ciphertext, but it is not encrypted or stored in the
 * ciphertext.
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key Encryption key (256-bit).
 * @return string|false Returns the plaintext on success, or false on failure.
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-decrypt.php
 */
function sodium_crypto_aead_xchacha20poly1305_ietf_decrypt(string $ciphertext, string $additional_data, string $nonce, string $key): string|false {}

/**
 * (Preferred) Encrypt then authenticate with XChaCha20-Poly1305
 *
 * Encrypt then authenticate with XChaCha20-Poly1305 (eXtended-nonce variant).
 *
 * @link https://php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-encrypt.php
 * @param string $message The plaintext message to encrypt.
 * @param string $additional_data Additional, authenticated data. This is used in the verification
 * of the authentication tag appended to the ciphertext, but it is not encrypted or stored in the
 * ciphertext.
 * @param string $nonce A number that must be only used once, per message. 24 bytes long. This is a
 * large enough bound to generate randomly (i.e. random_bytes).
 * @param string $key Encryption key (256-bit).
 * @return string Returns the ciphertext and authentication tag as a string of raw binary bytes.
 * @throws SodiumException
 * @since 7.2
 * https://www.php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-encrypt.php
 */
function sodium_crypto_aead_xchacha20poly1305_ietf_encrypt(string $message, string $additional_data, string $nonce, string $key): string {}

/**
 * Generate a random XChaCha20-Poly1305 key.
 *
 * Generate a random key for use with sodium_crypto_aead_xchacha20poly1305_ietf_encrypt and
 * sodium_crypto_aead_xchacha20poly1305_ietf_decrypt.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-keygen.php
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-aead-xchacha20poly1305-ietf-keygen.php
 */
function sodium_crypto_aead_xchacha20poly1305_ietf_keygen(): string {}

/**
 * Determine whether or not to rehash a password
 *
 * Determine whether or not to rehash a password, based on the current hash opslimit and memlimit.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-pwhash-str-needs-rehash.php
 * @param string $password Password hash
 * @param int $opslimit Configured opslimit; see sodium_crypto_pwhash_str
 * @param int $memlimit Configured memlimit; see sodium_crypto_pwhash_str
 * @return bool Returns true if the provided memlimit/opslimit do not match what's stored in the
 * hash. Returns false if they match.
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-pwhash-str-needs-rehash.php
 */
function sodium_crypto_pwhash_str_needs_rehash(string $password, int $opslimit, int $memlimit): bool {}

/**
 * Generate a random secretstream key.
 * @link https://php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-keygen.php
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-keygen.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_keygen(): string {}

/**
 * Initialize a secretstream context for encryption
 * @link https://php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-init-push.php
 * @param string $key Cryptography key. See sodium_crypto_secretstream_xchacha20poly1305_keygen.
 * @return array An array with two string values: The secretstream state, needed for further pushes
 * The secretstream header, which needs to be provided to the recipient so they can pull data
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-init-push.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_init_push(string $key): array {}

/**
 * Encrypt a chunk of data so that it can safely be decrypted in a streaming API
 * @link https://php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-push.php
 * @param string $state See sodium_crypto_secretstream_xchacha20poly1305_init_pull and
 * sodium_crypto_secretstream_xchacha20poly1305_init_push
 * @param string $message
 * @param string $additional_data
 * @param int $tag Optional. Can be used to assert decryption behavior (i.e. re-keying or indicating
 * the final chunk in a stream). SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_MESSAGE: the most
 * common tag, that doesn't add any information about the nature of the message.
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL: indicates that the message marks the end
 * of the stream, and erases the secret key used to encrypt the previous sequence.
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_PUSH: indicates that the message marks the end
 * of a set of messages, but not the end of the stream. For example, a huge JSON string sent as
 * multiple chunks can use this tag to indicate to the application that the string is complete and
 * that it can be decoded. But the stream itself is not closed, and more data may follow.
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_REKEY: "forget" the key used to encrypt this
 * message and the previous ones, and derive a new secret key.
 * @return string Returns the encrypted ciphertext.
 */
#[PhpStormStubsElementAvailable('7.2')]
function sodium_crypto_secretstream_xchacha20poly1305_push(string &$state, #[\SensitiveParameter] string $message, string $additional_data = "", int $tag = SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_MESSAGE): string {}

/**
 * Initialize a secretstream context for decryption
 * @link https://php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-init-pull.php
 * @param string $header The header of the secretstream. This should be one of the values produced
 * by sodium_crypto_secretstream_xchacha20poly1305_init_push.
 * @param string $key Encryption key (256-bit).
 * @return string Secretstream state.
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-init-pull.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_init_pull(string $header, string $key): string {}

/**
 * Decrypt a chunk of data from an encrypted stream
 * @link https://php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-pull.php
 * @param string $state See sodium_crypto_secretstream_xchacha20poly1305_init_pull and
 * sodium_crypto_secretstream_xchacha20poly1305_init_push
 * @param string $ciphertext The ciphertext chunk to decrypt.
 * @param string $additional_data Optional additional data to include in the authentication tag.
 * @return array|false An array with two values: string; The decrypted chunk int; An optional tag
 * (if provided during push). Possible values:
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_MESSAGE: the most common tag, that doesn't add
 * any information about the nature of the message.
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_FINAL: indicates that the message marks the end
 * of the stream, and erases the secret key used to encrypt the previous sequence.
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_PUSH: indicates that the message marks the end
 * of a set of messages, but not the end of the stream. For example, a huge JSON string sent as
 * multiple chunks can use this tag to indicate to the application that the string is complete and
 * that it can be decoded. But the stream itself is not closed, and more data may follow.
 * SODIUM_CRYPTO_SECRETSTREAM_XCHACHA20POLY1305_TAG_REKEY: "forget" the key used to encrypt this
 * message and the previous ones, and derive a new secret key.
 */
#[PhpStormStubsElementAvailable('7.2')]
function sodium_crypto_secretstream_xchacha20poly1305_pull(string &$state, string $ciphertext, string $additional_data = ""): array|false {}

/**
 * Explicitly rotate the key in the secretstream state
 *
 * Explicitly rotate the key in the secretstream state. Overwrites the value passed in.
 *
 * @link https://php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-rekey.php
 * @param string &$state Secretstream state.
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-crypto-secretstream-xchacha20poly1305-rekey.php
 */
function sodium_crypto_secretstream_xchacha20poly1305_rekey(string &$state): void {}

/**
 * Encodes a raw binary string with base64.
 *
 * Converts a raw binary string into a base64-encoded string. Unlike base64_encode,
 * sodium_bin2base64 is constant-time (a property that is important for any code that touches
 * cryptographic inputs, such as plaintexts or keys) and supports multiple character sets.
 *
 * @link https://php.net/manual/en/function.sodium-bin2base64.php
 * @param string $string Raw binary string.
 * @param int $id SODIUM_BASE64_VARIANT_ORIGINAL for standard (A-Za-z0-9/\+) Base64 encoding.
 * SODIUM_BASE64_VARIANT_ORIGINAL_NO_PADDING for standard (A-Za-z0-9/\+) Base64 encoding, without =
 * padding characters. SODIUM_BASE64_VARIANT_URLSAFE for URL-safe (A-Za-z0-9\-_) Base64 encoding.
 * SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING for URL-safe (A-Za-z0-9\-_) Base64 encoding, without =
 * padding characters.
 * @return string Base64-encoded string.
 * @throws SodiumException in cases of invalid input (e.g., an unsupported base64 variant) or other errors like memory allocation failures
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-bin2base64.php
 */
function sodium_bin2base64(string $string, int $id): string {}

/**
 * Decodes a base64-encoded string into raw binary.
 *
 * Converts a base64 encoded string into raw binary. Unlike base64_decode, sodium_base642bin is
 * constant-time (a property that is important for any code that touches cryptographic inputs, such
 * as plaintexts or keys) and supports multiple character sets.
 *
 * @link https://php.net/manual/en/function.sodium-base642bin.php
 * @param string $string string; Encoded string.
 * @param int $id SODIUM_BASE64_VARIANT_ORIGINAL for standard (A-Za-z0-9/\+) Base64 encoding.
 * SODIUM_BASE64_VARIANT_ORIGINAL_NO_PADDING for standard (A-Za-z0-9/\+) Base64 encoding, without =
 * padding characters. SODIUM_BASE64_VARIANT_URLSAFE for URL-safe (A-Za-z0-9\-_) Base64 encoding.
 * SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING for URL-safe (A-Za-z0-9\-_) Base64 encoding, without =
 * padding characters.
 * @param string $ignore Characters to ignore when decoding (e.g. whitespace characters).
 * @throws SodiumException
 * @since 7.2
 * @see https://www.php.net/manual/en/function.sodium-base642bin.php
 * @return string Decoded string.
 */
function sodium_base642bin(string $string, int $id, string $ignore = ''): string {}

/**
 * Convert a binary representation of an IP address to its string form.
 * @param string $bin
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_bin2ip(string $bin): string {}

/**
 * Convert a string representation of an IP address to its binary form.
 * @param string $ip
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_ip2bin(string $ip): string {}

/**
 * Encrypt an IP address using the deterministic ipcrypt construction.
 * @param string $ip
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_encrypt(string $ip, string $key): string {}

/**
 * Decrypt an IP address using the deterministic ipcrypt construction.
 * @param string $encrypted_ip
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_decrypt(string $encrypted_ip, string $key): string {}

/**
 * Generate a random key for the deterministic ipcrypt construction.
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_keygen(): string {}

/**
 * Encrypt an IP address using the non-deterministic ipcrypt-nd construction.
 * @param string $ip
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_nd_encrypt(string $ip, string $key): string {}

/**
 * Decrypt an IP address using the non-deterministic ipcrypt-nd construction.
 * @param string $ciphertext_hex
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_nd_decrypt(string $ciphertext_hex, string $key): string {}

/**
 * Generate a random key for the non-deterministic ipcrypt-nd construction.
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_nd_keygen(): string {}

/**
 * Encrypt an IP address using the non-deterministic ipcrypt-ndx construction.
 * @param string $ip
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_ndx_encrypt(string $ip, string $key): string {}

/**
 * Decrypt an IP address using the non-deterministic ipcrypt-ndx construction.
 * @param string $ciphertext_hex
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_ndx_decrypt(string $ciphertext_hex, string $key): string {}

/**
 * Generate a random key for the non-deterministic ipcrypt-ndx construction.
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_ndx_keygen(): string {}

/**
 * Encrypt an IP address using the prefix-preserving ipcrypt-pfx construction.
 * @param string $ip
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_pfx_encrypt(string $ip, string $key): string {}

/**
 * Decrypt an IP address using the prefix-preserving ipcrypt-pfx construction.
 * @param string $encrypted_ip
 * @param string $key
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_pfx_decrypt(string $encrypted_ip, string $key): string {}

/**
 * Generate a random key for the prefix-preserving ipcrypt-pfx construction.
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_ipcrypt_pfx_keygen(): string {}

/**
 * Compute a SHAKE128 extendable-output function digest of the given length.
 * @param int $length
 * @param string $message
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake128(int $length, string $message): string {}

/**
 * Initialize a SHAKE128 extendable-output function state.
 * @param int|null $domain
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake128_init(?int $domain = null): string {}

/**
 * Squeeze output bytes from a SHAKE128 extendable-output function state.
 * @param string &$state
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake128_squeeze(string &$state, int $length): string {}

/**
 * Absorb a message into a SHAKE128 extendable-output function state.
 * @param string &$state
 * @param string $message
 * @return true
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake128_update(string &$state, string $message): true {}

/**
 * Compute a SHAKE256 extendable-output function digest of the given length.
 * @param int $length
 * @param string $message
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake256(int $length, string $message): string {}

/**
 * Initialize a SHAKE256 extendable-output function state.
 * @param int|null $domain
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake256_init(?int $domain = null): string {}

/**
 * Squeeze output bytes from a SHAKE256 extendable-output function state.
 * @param string &$state
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake256_squeeze(string &$state, int $length): string {}

/**
 * Absorb a message into a SHAKE256 extendable-output function state.
 * @param string &$state
 * @param string $message
 * @return true
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_shake256_update(string &$state, string $message): true {}

/**
 * Compute a TurboSHAKE128 extendable-output function digest of the given length.
 * @param int $length
 * @param string $message
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake128(int $length, string $message): string {}

/**
 * Initialize a TurboSHAKE128 extendable-output function state.
 * @param int|null $domain
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake128_init(?int $domain = null): string {}

/**
 * Squeeze output bytes from a TurboSHAKE128 extendable-output function state.
 * @param string &$state
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake128_squeeze(string &$state, int $length): string {}

/**
 * Absorb a message into a TurboSHAKE128 extendable-output function state.
 * @param string &$state
 * @param string $message
 * @return true
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake128_update(string &$state, string $message): true {}

/**
 * Compute a TurboSHAKE256 extendable-output function digest of the given length.
 * @param int $length
 * @param string $message
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake256(int $length, string $message): string {}

/**
 * Initialize a TurboSHAKE256 extendable-output function state.
 * @param int|null $domain
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake256_init(?int $domain = null): string {}

/**
 * Squeeze output bytes from a TurboSHAKE256 extendable-output function state.
 * @param string &$state
 * @param int $length
 * @return string
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake256_squeeze(string &$state, int $length): string {}

/**
 * Absorb a message into a TurboSHAKE256 extendable-output function state.
 * @param string &$state
 * @param string $message
 * @return true
 * @throws SodiumException
 * @since 8.6
 */
function sodium_crypto_xof_turboshake256_update(string &$state, string $message): true {}

/**
 * Exceptions thrown by the sodium functions.
 * @link https://php.net/manual/en/class.sodiumexception.php
 */
class SodiumException extends Exception {}
