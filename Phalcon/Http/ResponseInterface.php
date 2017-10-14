<?php 

namespace Phalcon\Http {

	interface ResponseInterface {

		public function setStatusCode($code, $message=null);


		public function getHeaders();


		public function setHeader($name, $value);


		public function setRawHeader($header);


		public function resetHeaders();


		public function setExpires(\DateTime $datetime);


		public function setNotModified();


		public function setContentType($contentType, $charset=null);


		public function setContentLength($contentLength);


		public function redirect($location=null, $externalRedirect=null, $statusCode=null);


		public function setContent($content);


		public function setJsonContent($content);


		public function appendContent($content);


		public function getContent();


		public function sendHeaders();


		public function sendCookies();


		public function send();


		public function setFileToSend($filePath, $attachmentName=null);

	}
}
