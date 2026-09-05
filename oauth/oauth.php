<?php

define('OAUTH_SIG_METHOD_RSASHA1', 'RSA-SHA1');
define('OAUTH_SIG_METHOD_HMACSHA1', 'HMAC-SHA1');
define('OAUTH_SIG_METHOD_HMACSHA256', 'HMAC-SHA256');

define('OAUTH_AUTH_TYPE_AUTHORIZATION', 3);
define('OAUTH_AUTH_TYPE_NONE', 2);
define('OAUTH_AUTH_TYPE_URI', 1);
define('OAUTH_AUTH_TYPE_FORM', 2);

define('OAUTH_HTTP_METHOD_GET', 'GET');
define('OAUTH_HTTP_METHOD_POST', 'POST');
define('OAUTH_HTTP_METHOD_PUT', 'PUT');
define('OAUTH_HTTP_METHOD_HEAD', 'HEAD');
define('OAUTH_HTTP_METHOD_DELETE', 'DELETE');

define('OAUTH_REQENGINE_STREAMS', 1);
define('OAUTH_REQENGINE_CURL', 2);

define('OAUTH_OK', 0);
define('OAUTH_BAD_NONCE', 4);
define('OAUTH_BAD_TIMESTAMP', 8);
define('OAUTH_CONSUMER_KEY_UNKNOWN', 16);
define('OAUTH_CONSUMER_KEY_REFUSED', 32);
define('OAUTH_INVALID_SIGNATURE', 64);
define('OAUTH_TOKEN_USED', 128);
define('OAUTH_TOKEN_EXPIRED', 256);
define('OAUTH_TOKEN_REJECTED', 1024);
define('OAUTH_VERIFIER_INVALID', 2048);
define('OAUTH_PARAMETER_ABSENT', 4096);
define('OAUTH_SIGNATURE_METHOD_REJECTED', 8192);

/**
 * Generate a Signature Base String
 *
 * @param string $http_method The HTTP method.
 * @param string $uri URI to encode.
 * @param array $request_parameters Array of request parameters.
 * @return string Returns a Signature Base String.
 */
function oauth_get_sbs($http_method, $uri, $request_parameters = []) {}

/**
 * Encode a URI to RFC 3986
 *
 * @param string $uri URI to encode.
 * @return string Returns an RFC 3986 encoded string.
 */
function oauth_urlencode($uri) {}

/**
 * The OAuth extension provides a simple interface to interact with data providers using the OAuth HTTP specification to protect private resources.
 */
class OAuth
{
    /**
     * @var bool
     */
    public $debug;

    /**
     * @var bool
     */
    public $sslChecks;

    /**
     * @var array
     */
    public $debugInfo;

    /**
     * Create a new OAuth object
     * @param string $consumer_key The consumer key provided by the service provider.
     * @param string $consumer_secret The consumer secret provided by the service provider.
     * @param string $signature_method This optional parameter defines which signature method to
     * use, by default it is OAUTH_SIG_METHOD_HMACSHA1 (HMAC-SHA1).
     * @param int $auth_type This optional parameter defines how to pass the OAuth parameters to a
     * consumer, by default it is OAUTH_AUTH_TYPE_AUTHORIZATION (in the Authorization header).
     * @throws \OAuthException
     */
    public function __construct($consumer_key, $consumer_secret, $signature_method = OAUTH_SIG_METHOD_HMACSHA1, $auth_type = OAUTH_AUTH_TYPE_AUTHORIZATION) {}

    /**
     * Turn off verbose debugging
     * @return bool true
     */
    public function disableDebug() {}

    /**
     * Turn off redirects
     * @return void
     */
    public function disableRedirects() {}

    /**
     * Turn off SSL checks
     * @return bool true
     */
    public function disableSSLChecks() {}

    /**
     * Turn on verbose debugging
     * @return bool true
     */
    public function enableDebug() {}

    /**
     * Turn on redirects
     * @return bool
     */
    public function enableRedirects() {}

    /**
     * Turn on SSL checks
     * @return bool true
     */
    public function enableSSLChecks() {}

    /**
     * Set the timeout
     * @param int $timeout Time in milliseconds
     * @return void
     */
    public function setTimeout($timeout) {}

    /**
     * Fetch an OAuth-protected resource
     * @param string $protected_resource_url URL to the OAuth protected resource.
     * @param array $extra_parameters Extra parameters to send with the request for the resource.
     * @param string $http_method One of the OAUTH_HTTP_METHOD_* OAUTH constants, which includes
     * GET, POST, PUT, HEAD, or DELETE. HEAD (OAUTH_HTTP_METHOD_HEAD) can be useful for discovering
     * information prior to the request (if OAuth credentials are in the Authorization header).
     * @param array $http_headers HTTP client headers (such as User-Agent, Accept, etc.)
     * @throws \OAuthException
     * @return mixed Returns true on success or false on failure.
     */
    public function fetch($protected_resource_url, $extra_parameters = [], $http_method = null, $http_headers = []) {}

    /**
     * Fetch an access token
     * @param string $access_token_url URL to the access token API.
     * @param string $auth_session_handle Authorization session handle, this parameter does not have
     * any citation in the core OAuth 1.0 specification but may be implemented by large providers.
     * See ScalableOAuth for more information.
     * @param string $verifier_token For service providers which support 1.0a, a verifier_token must
     * be passed while exchanging the request token for the access token. If the verifier_token is
     * present in $_GET or $_POST it is passed automatically and the caller does not need to specify
     * a verifier_token (usually if the access token is exchanged at the oauth_callback URL). See
     * ScalableOAuth for more information.
     * @throws \OAuthException
     * @return array Returns an array containing the parsed OAuth response on success or false on
     * failure.
     */
    public function getAccessToken($access_token_url, $auth_session_handle = null, $verifier_token = null) {}

    /**
     * Get CA information
     * @return array
     */
    public function getCAPath() {}

    /**
     * Get the last response
     * @return string Returns a string containing the last response.
     */
    public function getLastResponse() {}

    /**
     * Get headers for last response
     * @return string|false A string containing the last response's headers or false on failure
     */
    public function getLastResponseHeaders() {}

    /**
     * Get HTTP information about the last response
     * @return array Returns an array containing the response information for the last request.
     * Constants from curl_getinfo may be used.
     */
    public function getLastResponseInfo() {}

    /**
     * Generate OAuth header string signature
     * @param string $http_method HTTP method for request.
     * @param string $url URL for request.
     * @param mixed  $extra_parameters String or array of additional parameters.
     * @return string|false A string containing the generated request header or false on failure
     */
    public function getRequestHeader($http_method, $url, $extra_parameters = '') {}

    /**
     * Fetch a request token
     * @param string $request_token_url URL to the request token API.
     * @param string $callback_url OAuth callback URL. If callback_url is passed and is an empty
     * value, it is set to "oob" to address the OAuth 2009.1 advisory.
     * @param string $http_method HTTP method to use, e.g. GET or POST.
     * @throws \OAuthException
     * @return array Returns an array containing the parsed OAuth response on success or false on
     * failure.
     */
    public function getRequestToken($request_token_url, $callback_url = null, $http_method = 'GET') {}

    /**
     * Set authorization type
     * @param int $auth_type auth_type can be one of the following flags (in order of decreasing
     * preference as per OAuth 1.0 section 5.2): OAUTH_AUTH_TYPE_AUTHORIZATION Pass the OAuth
     * parameters in the HTTP Authorization header. OAUTH_AUTH_TYPE_FORM Append the OAuth parameters
     * to the HTTP POST request body. OAUTH_AUTH_TYPE_URI Append the OAuth parameters to the request
     * URI. OAUTH_AUTH_TYPE_NONE None.
     * @return bool Returns true if a parameter is correctly set, otherwise false (e.g., if an
     * invalid auth_type is passed in.)
     */
    public function setAuthType($auth_type) {}

    /**
     * Set CA path and info
     * @param string $ca_path The CA Path being set.
     * @param string $ca_info The CA Info being set.
     * @return mixed
     */
    public function setCAPath($ca_path = null, $ca_info = null) {}

    /**
     * Set the nonce for subsequent requests
     * @param string $nonce The value for oauth_nonce.
     * @return mixed Returns true on success, or false if the nonce is considered invalid.
     */
    public function setNonce($nonce) {}

    /**
     * @param int $reqengine The desired request engine. Set to OAUTH_REQENGINE_STREAMS to use PHP
     * Streams, or OAUTH_REQENGINE_CURL to use Curl.
     * @return void
     */
    public function setRequestEngine($reqengine) {}

    /**
     * Set the RSA certificate
     * @param string $cert The RSA certificate.
     * @return mixed
     */
    public function setRSACertificate($cert) {}

    /**
     * Set the timestamp
     * @param string $timestamp The timestamp.
     * @return mixed
     */
    public function setTimestamp($timestamp) {}

    /**
     * Set the token and secret
     * @param string $token The OAuth token.
     * @param string $token_secret The OAuth token secret.
     * @return bool true
     */
    public function setToken($token, $token_secret) {}

    /**
     * Set the OAuth version
     * @param string $version OAuth version, default value is always "1.0"
     * @return bool Returns true on success or false on failure.
     */
    public function setVersion($version) {}
}

class OAuthException extends Exception
{
    /**
     * The response of the exception which occurred, if any
     * @var string
     */
    public $lastResponse;

    /**
     * @var array
     */
    public $debugInfo;
}

;

/**
 * Manages an OAuth provider class.
 */
class OAuthProvider
{
    /**
     * @param string $req_params The required parameters.
     * @return bool
     */
    final public function addRequiredParameter($req_params) {}

    /**
     * @return void
     */
    public function callconsumerHandler() {}

    /**
     * @return void
     */
    public function callTimestampNonceHandler() {}

    /**
     * @return void
     */
    public function calltokenHandler() {}

    /**
     * @param string $uri The optional URI, or endpoint.
     * @param string $method The HTTP method. Optionally pass in one of the OAUTH_HTTP_METHOD_*
     * OAuth constants.
     * @return void
     */
    public function checkOAuthRequest($uri = '', $method = '') {}

    /**
     * @param array $params_array Setting these optional parameters is limited to the CLI SAPI.
     */
    public function __construct($params_array) {}

    /**
     * @param callable $callback_function The callable functions name.
     * @return void
     */
    public function consumerHandler($callback_function) {}

    /**
     * @param int $size The desired token length, in terms of bytes.
     * @param bool $strong Setting to true means /dev/random will be used for entropy, as otherwise
     * the non-blocking /dev/urandom is used. This parameter is ignored on Windows.
     * @return string The generated token, as a string of bytes.
     */
    final public static function generateToken($size, $strong = false) {}

    /**
     * @param mixed $params_array
     * @return void
     */
    public function is2LeggedEndpoint($params_array) {}

    /**
     * @param bool $will_issue_request_token Sets whether or not it will issue a request token, thus
     * determining if OAuthProvider::tokenHandler needs to be called.
     * @return void
     */
    public function isRequestTokenEndpoint($will_issue_request_token) {}

    /**
     * @param string $req_params The required parameter to be removed.
     * @return bool
     */
    final public function removeRequiredParameter($req_params) {}

    /**
     * @param string $oauthexception The OAuthException.
     * @param bool $send_headers
     * @return string
     */
    final public static function reportProblem($oauthexception, $send_headers = true) {}

    /**
     * @param string $param_key The parameter key.
     * @param mixed $param_val The optional parameter value. To exclude a parameter from signature
     * verification, set its value to null.
     * @return bool
     */
    final public function setParam($param_key, $param_val = null) {}

    /**
     * @param string $path The path.
     * @return bool
     */
    final public function setRequestTokenPath($path) {}

    /**
     * @param callable $callback_function The callable functions name.
     * @return void
     */
    public function timestampNonceHandler($callback_function) {}

    /**
     * @param callable $callback_function The callable functions name.
     * @return void
     */
    public function tokenHandler($callback_function) {}
}
