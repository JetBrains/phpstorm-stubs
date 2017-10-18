<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Request
	 *
	 * Encapsulates request information for easy and secure access from application controllers.
	 *
	 * The request object is a simple value object that is passed between the dispatcher and controller classes.
	 * It packages the HTTP request environment.
	 *
	 *<code>
	 * use Phalcon\Http\Request;
	 *
	 * $request = new Request();
	 *
	 * if ($request->isPost() && $request->isAjax()) {
	 *     echo "Request was made using POST and AJAX";
	 * }
	 *
	 * $request->getServer("HTTP_HOST"); // Retrieve SERVER variables
	 * $request->getMethod();            // GET, POST, PUT, DELETE, HEAD, OPTIONS, PATCH, PURGE, TRACE, CONNECT
	 * $request->getLanguages();         // An array of languages the client accepts
	 *</code>
	 */
	
	class Request implements \Phalcon\Http\RequestInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_rawBody;

		protected $_filter;

		protected $_putCache;

		protected $_httpMethodParameterOverride;

		protected $_strictHostCheck;

		public function getHttpMethodParameterOverride(){ }


		public function setHttpMethodParameterOverride($httpMethodParameterOverride){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Gets a variable from the $_REQUEST superglobal applying filters if needed.
		 * If no parameters are given the $_REQUEST superglobal is returned
		 *
		 *<code>
		 * // Returns value from $_REQUEST["user_email"] without sanitizing
		 * $userEmail = $request->get("user_email");
		 *
		 * // Returns value from $_REQUEST["user_email"] with sanitizing
		 * $userEmail = $request->get("user_email", "email");
		 *</code>
		 */
		public function get($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		/**
		 * Gets a variable from the $_POST superglobal applying filters if needed
		 * If no parameters are given the $_POST superglobal is returned
		 *
		 *<code>
		 * // Returns value from $_POST["user_email"] without sanitizing
		 * $userEmail = $request->getPost("user_email");
		 *
		 * // Returns value from $_POST["user_email"] with sanitizing
		 * $userEmail = $request->getPost("user_email", "email");
		 *</code>
		 */
		public function getPost($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		/**
		 * Gets a variable from put request
		 *
		 *<code>
		 * // Returns value from $_PUT["user_email"] without sanitizing
		 * $userEmail = $request->getPut("user_email");
		 *
		 * // Returns value from $_PUT["user_email"] with sanitizing
		 * $userEmail = $request->getPut("user_email", "email");
		 *</code>
		 */
		public function getPut($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		/**
		 * Gets variable from $_GET superglobal applying filters if needed
		 * If no parameters are given the $_GET superglobal is returned
		 *
		 *<code>
		 * // Returns value from $_GET["id"] without sanitizing
		 * $id = $request->getQuery("id");
		 *
		 * // Returns value from $_GET["id"] with sanitizing
		 * $id = $request->getQuery("id", "int");
		 *
		 * // Returns value from $_GET["id"] with a default value
		 * $id = $request->getQuery("id", null, 150);
		 *</code>
		 */
		public function getQuery($name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		/**
		 * Helper to get data from superglobals, applying filters if needed.
		 * If no parameters are given the superglobal is returned.
		 */
		final protected function getHelper($source, $name=null, $filters=null, $defaultValue=null, $notAllowEmpty=null, $noRecursive=null){ }


		/**
		 * Gets variable from $_SERVER superglobal
		 */
		public function getServer($name){ }


		/**
		 * Checks whether $_REQUEST superglobal has certain index
		 */
		public function has($name){ }


		/**
		 * Checks whether $_POST superglobal has certain index
		 */
		public function hasPost($name){ }


		/**
		 * Checks whether the PUT data has certain index
		 */
		public function hasPut($name){ }


		/**
		 * Checks whether $_GET superglobal has certain index
		 */
		public function hasQuery($name){ }


		/**
		 * Checks whether $_SERVER superglobal has certain index
		 */
		final public function hasServer($name){ }


		/**
		 * Gets HTTP header from request data
		 */
		final public function getHeader($header){ }


		/**
		 * Gets HTTP schema (http/https)
		 */
		public function getScheme(){ }


		/**
		 * Checks whether request has been made using ajax
		 */
		public function isAjax(){ }


		/**
		 * Checks whether request has been made using SOAP
		 */
		public function isSoap(){ }


		/**
		 * Alias of isSoap(). It will be deprecated in future versions
		 */
		public function isSoapRequested(){ }


		/**
		 * Checks whether request has been made using any secure layer
		 */
		public function isSecure(){ }


		/**
		 * Alias of isSecure(). It will be deprecated in future versions
		 */
		public function isSecureRequest(){ }


		/**
		 * Gets HTTP raw request body
		 */
		public function getRawBody(){ }


		/**
		 * Gets decoded JSON HTTP raw request body
		 */
		public function getJsonRawBody($associative=null){ }


		/**
		 * Gets active server address IP
		 */
		public function getServerAddress(){ }


		/**
		 * Gets active server name
		 */
		public function getServerName(){ }


		/**
		 * Gets host name used by the request.
		 *
		 * `Request::getHttpHost` trying to find host name in following order:
		 *
		 * - `$_SERVER["HTTP_HOST"]`
		 * - `$_SERVER["SERVER_NAME"]`
		 * - `$_SERVER["SERVER_ADDR"]`
		 *
		 * Optionally `Request::getHttpHost` validates and clean host name.
		 * The `Request::$_strictHostCheck` can be used to validate host name.
		 *
		 * Note: validation and cleaning have a negative performance impact because
		 * they use regular expressions.
		 *
		 * <code>
		 * use \Phalcon\Http\Request;
		 *
		 * $request = new Request;
		 *
		 * $_SERVER["HTTP_HOST"] = "example.com";
		 * $request->getHttpHost(); // example.com
		 *
		 * $_SERVER["HTTP_HOST"] = "example.com:8080";
		 * $request->getHttpHost(); // example.com:8080
		 *
		 * $request->setStrictHostCheck(true);
		 * $_SERVER["HTTP_HOST"] = "ex=am~ple.com";
		 * $request->getHttpHost(); // UnexpectedValueException
		 *
		 * $_SERVER["HTTP_HOST"] = "ExAmPlE.com";
		 * $request->getHttpHost(); // example.com
		 * </code>
		 */
		public function getHttpHost(){ }


		/**
		 * Sets if the `Request::getHttpHost` method must be use strict validation of host name or not
		 */
		public function setStrictHostCheck($flag=null){ }


		/**
		 * Checks if the `Request::getHttpHost` method will be use strict validation of host name or not
		 */
		public function isStrictHostCheck(){ }


		/**
		 * Gets information about the port on which the request is made.
		 */
		public function getPort(){ }


		/**
		 * Gets HTTP URI which request has been made
		 */
		final public function getURI(){ }


		/**
		 * Gets most possible client IPv4 Address. This method searches in
		 * $_SERVER["REMOTE_ADDR"] and optionally in $_SERVER["HTTP_X_FORWARDED_FOR"]
		 */
		public function getClientAddress($trustForwardedHeader=null){ }


		/**
		 * Gets HTTP method which request has been made
		 *
		 * If the X-HTTP-Method-Override header is set, and if the method is a POST,
		 * then it is used to determine the "real" intended HTTP method.
		 *
		 * The _method request parameter can also be used to determine the HTTP method,
		 * but only if setHttpMethodParameterOverride(true) has been called.
		 *
		 * The method is always an uppercased string.
		 */
		final public function getMethod(){ }


		/**
		 * Gets HTTP user agent used to made the request
		 */
		public function getUserAgent(){ }


		/**
		 * Checks if a method is a valid HTTP method
		 */
		public function isValidHttpMethod($method){ }


		/**
		 * Check if HTTP method match any of the passed methods
		 * When strict is true it checks if validated methods are real HTTP methods
		 */
		public function isMethod($methods, $strict=null){ }


		/**
		 * Checks whether HTTP method is POST. if _SERVER["REQUEST_METHOD"]==="POST"
		 */
		public function isPost(){ }


		/**
		 * Checks whether HTTP method is GET. if _SERVER["REQUEST_METHOD"]==="GET"
		 */
		public function isGet(){ }


		/**
		 * Checks whether HTTP method is PUT. if _SERVER["REQUEST_METHOD"]==="PUT"
		 */
		public function isPut(){ }


		/**
		 * Checks whether HTTP method is PATCH. if _SERVER["REQUEST_METHOD"]==="PATCH"
		 */
		public function isPatch(){ }


		/**
		 * Checks whether HTTP method is HEAD. if _SERVER["REQUEST_METHOD"]==="HEAD"
		 */
		public function isHead(){ }


		/**
		 * Checks whether HTTP method is DELETE. if _SERVER["REQUEST_METHOD"]==="DELETE"
		 */
		public function isDelete(){ }


		/**
		 * Checks whether HTTP method is OPTIONS. if _SERVER["REQUEST_METHOD"]==="OPTIONS"
		 */
		public function isOptions(){ }


		/**
		 * Checks whether HTTP method is PURGE (Squid and Varnish support). if _SERVER["REQUEST_METHOD"]==="PURGE"
		 */
		public function isPurge(){ }


		/**
		 * Checks whether HTTP method is TRACE. if _SERVER["REQUEST_METHOD"]==="TRACE"
		 */
		public function isTrace(){ }


		/**
		 * Checks whether HTTP method is CONNECT. if _SERVER["REQUEST_METHOD"]==="CONNECT"
		 */
		public function isConnect(){ }


		/**
		 * Checks whether request include attached files
		 */
		public function hasFiles($onlySuccessful=null){ }


		/**
		 * Recursively counts file in an array of files
		 */
		final protected function hasFileHelper($data, $onlySuccessful){ }


		/**
		 * Gets attached files as \Phalcon\Http\Request\File instances
		 */
		public function getUploadedFiles($onlySuccessful=null){ }


		/**
		 * Smooth out $_FILES to have plain array with all files uploaded
		 */
		final protected function smoothFiles($names, $types, $tmp_names, $sizes, $errors, $prefix){ }


		/**
		 * Returns the available headers in the request
		 *
		 * <code>
		 * $_SERVER = [
		 *     "PHP_AUTH_USER" => "phalcon",
		 *     "PHP_AUTH_PW"   => "secret",
		 * ];
		 *
		 * $headers = $request->getHeaders();
		 *
		 * echo $headers["Authorization"]; // Basic cGhhbGNvbjpzZWNyZXQ=
		 * </code>
		 */
		public function getHeaders(){ }


		/**
		 * Gets web page that refers active request. ie: http://www.google.com
		 */
		public function getHTTPReferer(){ }


		/**
		 * Process a request header and return the one with best quality
		 */
		final protected function _getBestQuality($qualityParts, $name){ }


		/**
		 * Gets content type which request has been made
		 */
		public function getContentType(){ }


		/**
		 * Gets an array with mime/types and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT"]
		 */
		public function getAcceptableContent(){ }


		/**
		 * Gets best mime/type accepted by the browser/client from _SERVER["HTTP_ACCEPT"]
		 */
		public function getBestAccept(){ }


		/**
		 * Gets a charsets array and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT_CHARSET"]
		 */
		public function getClientCharsets(){ }


		/**
		 * Gets best charset accepted by the browser/client from _SERVER["HTTP_ACCEPT_CHARSET"]
		 */
		public function getBestCharset(){ }


		/**
		 * Gets languages array and their quality accepted by the browser/client from _SERVER["HTTP_ACCEPT_LANGUAGE"]
		 */
		public function getLanguages(){ }


		/**
		 * Gets best language accepted by the browser/client from _SERVER["HTTP_ACCEPT_LANGUAGE"]
		 */
		public function getBestLanguage(){ }


		/**
		 * Gets auth info accepted by the browser/client from $_SERVER["PHP_AUTH_USER"]
		 */
		public function getBasicAuth(){ }


		/**
		 * Gets auth info accepted by the browser/client from $_SERVER["PHP_AUTH_DIGEST"]
		 */
		public function getDigestAuth(){ }


		/**
		 * Process a request header and return an array of values with their qualities
		 */
		final protected function _getQualityHeader($serverIndex, $name){ }

	}
}
