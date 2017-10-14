<?php 

namespace Phalcon\Translate {

	interface InterpolatorInterface {

		public function replacePlaceholders($translation, $placeholders=null);

	}
}
