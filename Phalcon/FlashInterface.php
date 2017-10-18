<?php 

namespace Phalcon {

	interface FlashInterface {

		public function error($message);


		public function notice($message);


		public function success($message);


		public function warning($message);


		public function message($type, $message);

	}
}
