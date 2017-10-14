<?php 

namespace Phalcon\Http {

	interface RequestInterface {

		public function get($name=null, $filters=null, $defaultValue=null);


		public function getPost($name=null, $filters=null, $defaultValue=null);


		public function getQuery($name=null, $filters=null, $defaultValue=null);


		public function getServer($name);


		public function has($name);


		public function hasPost($name);


		public function hasPut($name);


		public function hasQuery($name);


		public function hasServer($name);


		public function getHeader($header);


		public function getScheme();


		public function isAjax();


		public function isSoapRequested();


		public function isSecureRequest();


		public function getRawBody();


		public function getServerAddress();


		public function getServerName();


		public function getHttpHost();


		public function getPort();


		public function getClientAddress($trustForwardedHeader=null);


		public function getMethod();


		public function getUserAgent();


		public function isMethod($methods, $strict=null);


		public function isPost();


		public function isGet();


		public function isPut();


		public function isHead();


		public function isDelete();


		public function isOptions();


		public function isPurge();


		public function isTrace();


		public function isConnect();


		public function hasFiles($onlySuccessful=null);


		public function getUploadedFiles($onlySuccessful=null);


		public function getHTTPReferer();


		public function getAcceptableContent();


		public function getBestAccept();


		public function getClientCharsets();


		public function getBestCharset();


		public function getLanguages();


		public function getBestLanguage();


		public function getBasicAuth();


		public function getDigestAuth();

	}
}
