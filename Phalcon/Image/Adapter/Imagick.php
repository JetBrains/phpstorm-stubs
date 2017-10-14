<?php 

namespace Phalcon\Image\Adapter {

	/**
	 * Phalcon\Image\Adapter\Imagick
	 *
	 * Image manipulation support. Allows images to be resized, cropped, etc.
	 *
	 *<code>
	 * $image = new \Phalcon\Image\Adapter\Imagick("upload/test.jpg");
	 *
	 * $image->resize(200, 200)->rotate(90)->crop(100, 100);
	 *
	 * if ($image->save()) {
	 *     echo "success";
	 * }
	 *</code>
	 */
	
	class Imagick extends \Phalcon\Image\Adapter implements \Phalcon\Image\AdapterInterface {

		protected static $_version;

		protected static $_checked;

		/**
		 * Checks if Imagick is enabled
		 */
		public static function check(){ }


		/**
		 * \Phalcon\Image\Adapter\Imagick constructor
		 */
		public function __construct($file, $width=null, $height=null){ }


		/**
		 * Execute a resize.
		 */
		protected function _resize($width, $height){ }


		/**
		 * This method scales the images using liquid rescaling method. Only support Imagick
		 *
		 * @param int $width   new width
		 * @param int $height  new height
		 * @param int $deltaX How much the seam can traverse on x-axis. Passing 0 causes the seams to be straight.
		 * @param int $rigidity Introduces a bias for non-straight seams. This parameter is typically 0.
		 */
		protected function _liquidRescale($width, $height, $deltaX, $rigidity){ }


		/**
		 * Execute a crop.
		 */
		protected function _crop($width, $height, $offsetX, $offsetY){ }


		/**
		 * Execute a rotation.
		 */
		protected function _rotate($degrees){ }


		/**
		 * Execute a flip.
		 */
		protected function _flip($direction){ }


		/**
		 * Execute a sharpen.
		 */
		protected function _sharpen($amount){ }


		/**
		 * Execute a reflection.
		 */
		protected function _reflection($height, $opacity, $fadeIn){ }


		/**
		 * Execute a watermarking.
		 */
		protected function _watermark(\Phalcon\Image\Adapter $image, $offsetX, $offsetY, $opacity){ }


		/**
		 * Execute a text
		 */
		protected function _text($text, $offsetX, $offsetY, $opacity, $r, $g, $b, $size, $fontfile){ }


		/**
		 * Composite one image onto another
		 */
		protected function _mask(\Phalcon\Image\Adapter $image){ }


		/**
		 * Execute a background.
		 */
		protected function _background($r, $g, $b, $opacity){ }


		/**
		 * Blur image
		 *
		 * @param int $radius Blur radius
		 */
		protected function _blur($radius){ }


		/**
		 * Pixelate image
		 *
		 * @param int $amount amount to pixelate
		 */
		protected function _pixelate($amount){ }


		/**
		 * Execute a save.
		 */
		protected function _save($file, $quality){ }


		/**
		 * Execute a render.
		 */
		protected function _render($extension, $quality){ }


		/**
		 * Destroys the loaded image to free up resources.
		 */
		public function __destruct(){ }


		/**
		 * Get instance
		 */
		public function getInternalImInstance(){ }


		/**
		 * Sets the limit for a particular resource in megabytes
		 *
		 * @link http://php.net/manual/ru/imagick.constants.php#imagick.constants.resourcetypes
		 */
		public function setResourceLimit($type, $limit){ }

	}
}
