<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Response
	 *
	 * Part of the HTTP cycle is return responses to the clients.
	 * Phalcon\HTTP\Response is the Phalcon component responsible to achieve this task.
	 * HTTP responses are usually composed by headers and body.
	 *
	 *<code>
	 * $response = new \Phalcon\Http\Response();
	 *
	 * $response->setStatusCode(200, "OK");
	 * $response->setContent("<html><body>Hello</body></html>");
	 *
	 * $response->send();
	 *</code>
	 */
	
	class Response implements \Phalcon\Http\ResponseInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_sent;

		protected $_content;

		protected $_headers;

		protected $_cookies;

		protected $_file;

		protected $_dependencyInjector;

		/**
		 * \Phalcon\Http\Response constructor
		 */
		public function __construct($content=null, $code=null, $status=null){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the HTTP response code
		 *
		 *<code>
		 * $response->setStatusCode(404, "Not Found");
		 *</code>
		 */
		public function setStatusCode($code, $message=null){ }


		/**
		 * Returns the status code
		 *
		 *<code>
		 * echo $response->getStatusCode();
		 *</code>
		 */
		public function getStatusCode(){ }


		/**
		 * Sets a headers bag for the response externally
		 */
		public function setHeaders(\Phalcon\Http\Response\HeadersInterface $headers){ }


		/**
		 * Returns headers set by the user
		 */
		public function getHeaders(){ }


		/**
		 * Sets a cookies bag for the response externally
		 */
		public function setCookies(\Phalcon\Http\Response\CookiesInterface $cookies){ }


		/**
		 * Returns cookies set by the user
		 *
		 * @return \Phalcon\Http\Response\CookiesInterface
		 */
		public function getCookies(){ }


		/**
		 * Overwrites a header in the response
		 *
		 *<code>
		 * $response->setHeader("Content-Type", "text/plain");
		 *</code>
		 */
		public function setHeader($name, $value){ }


		/**
		 * Send a raw header to the response
		 *
		 *<code>
		 * $response->setRawHeader("HTTP/1.1 404 Not Found");
		 *</code>
		 */
		public function setRawHeader($header){ }


		/**
		 * Resets all the established headers
		 */
		public function resetHeaders(){ }


		/**
		 * Sets an Expires header in the response that allows to use the HTTP cache
		 *
		 *<code>
		 * $this->response->setExpires(
		 *     new DateTime()
		 * );
		 *</code>
		 */
		public function setExpires(\DateTime $datetime){ }


		/**
		 * Sets Last-Modified header
		 *
		 *<code>
		 * $this->response->setLastModified(
		 *     new DateTime()
		 * );
		 *</code>
		 */
		public function setLastModified(\DateTime $datetime){ }


		/**
		 * Sets Cache headers to use HTTP cache
		 *
		 *<code>
		 * $this->response->setCache(60);
		 *</code>
		 */
		public function setCache($minutes){ }


		/**
		 * Sends a Not-Modified response
		 */
		public function setNotModified(){ }


		/**
		 * Sets the response content-type mime, optionally the charset
		 *
		 *<code>
		 * $response->setContentType("application/pdf");
		 * $response->setContentType("text/plain", "UTF-8");
		 *</code>
		 */
		public function setContentType($contentType, $charset=null){ }


		/**
		 * Sets the response content-length
		 *
		 *<code>
		 * $response->setContentLength(2048);
		 *</code>
		 */
		public function setContentLength($contentLength){ }


		/**
		 * Set a custom ETag
		 *
		 *<code>
		 * $response->setEtag(md5(time()));
		 *</code>
		 */
		public function setEtag($etag){ }


		/**
		 * Redirect by HTTP to another action or URL
		 *
		 *<code>
		 * // Using a string redirect (internal/external)
		 * $response->redirect("posts/index");
		 * $response->redirect("http://en.wikipedia.org", true);
		 * $response->redirect("http://www.example.com/new-location", true, 301);
		 *
		 * // Making a redirection based on a named route
		 * $response->redirect(
		 *     [
		 *         "for"        => "index-lang",
		 *         "lang"       => "jp",
		 *         "controller" => "index",
		 *     ]
		 * );
		 *</code>
		 */
		public function redirect($location=null, $externalRedirect=null, $statusCode=null){ }


		/**
		 * Sets HTTP response body
		 *
		 *<code>
		 * $response->setContent("<h1>Hello!</h1>");
		 *</code>
		 */
		public function setContent($content){ }


		/**
		 * Sets HTTP response body. The parameter is automatically converted to JSON
		 * and also sets default header: Content-Type: "application/json; charset=UTF-8"
		 *
		 *<code>
		 * $response->setJsonContent(
		 *     [
		 *         "status" => "OK",
		 *     ]
		 * );
		 *</code>
		 */
		public function setJsonContent($content, $jsonOptions=null, $depth=null){ }


		/**
		 * Appends a string to the HTTP response body
		 */
		public function appendContent($content){ }


		/**
		 * Gets the HTTP response body
		 */
		public function getContent(){ }


		/**
		 * Check if the response is already sent
		 */
		public function isSent(){ }


		/**
		 * Sends headers to the client
		 */
		public function sendHeaders(){ }


		/**
		 * Sends cookies to the client
		 */
		public function sendCookies(){ }


		/**
		 * Prints out HTTP response to the client
		 */
		public function send(){ }


		/**
		 * Sets an attached file to be sent at the end of the request
		 */
		public function setFileToSend($filePath, $attachmentName=null, $attachment=null){ }

	}
}
