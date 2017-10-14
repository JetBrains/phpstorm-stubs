<?php 

namespace Phalcon {

	interface EscaperInterface {

		public function setEncoding($encoding);


		public function getEncoding();


		public function setHtmlQuoteType($quoteType);


		public function escapeHtml($text);


		public function escapeHtmlAttr($text);


		public function escapeCss($css);


		public function escapeJs($js);


		public function escapeUrl($url);

	}
}
