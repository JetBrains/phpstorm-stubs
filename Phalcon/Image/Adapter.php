<?php 

namespace Phalcon\Image {

	/**
	 * Phalcon\Image\Adapter
	 *
	 * All image adapters must use this class
	 */
	
	abstract class Adapter implements \Phalcon\Image\AdapterInterface {

		protected $_image;

		protected $_file;

		protected $_realpath;

		protected $_width;

		protected $_height;

		protected $_type;

		protected $_mime;

		protected static $_checked;

		public function getImage(){ }


		public function getRealpath(){ }


		/**
		 * Image width
		 */
		public function getWidth(){ }


		/**
		 * Image height
		 */
		public function getHeight(){ }


		/**
		 * Image type
		 *
		 *
		 * Driver dependent
		 *
		 */
		public function getType(){ }


		/**
		 * Image mime type
		 */
		public function getMime(){ }


		/**
		 * Resize the image to the given size
		 */
		public function resize($width=null, $height=null, $master=null){ }


		/**
		 * This method scales the images using liquid rescaling method. Only support Imagick
		 *
		 * @param int $width   new width
		 * @param int $height  new height
		 * @param int $deltaX How much the seam can traverse on x-axis. Passing 0 causes the seams to be straight.
		 * @param int $rigidity Introduces a bias for non-straight seams. This parameter is typically 0.
		 */
		public function liquidRescale($width, $height, $deltaX=null, $rigidity=null){ }


		/**
		 * Crop an image to the given size
		 */
		public function crop($width, $height, $offsetX=null, $offsetY=null){ }


		/**
		 * Rotate the image by a given amount
		 */
		public function rotate($degrees){ }


		/**
		 * Flip the image along the horizontal or vertical axis
		 */
		public function flip($direction){ }


		/**
		 * Sharpen the image by a given amount
		 */
		public function sharpen($amount){ }


		/**
		 * Add a reflection to an image
		 */
		public function reflection($height, $opacity=null, $fadeIn=null){ }


		/**
		 * Add a watermark to an image with the specified opacity
		 */
		public function watermark(\Phalcon\Image\Adapter $watermark, $offsetX=null, $offsetY=null, $opacity=null){ }


		/**
		 * Add a text to an image with a specified opacity
		 */
		public function text($text, $offsetX=null, $offsetY=null, $opacity=null, $color=null, $size=null, $fontfile=null){ }


		/**
		 * Composite one image onto another
		 */
		public function mask(\Phalcon\Image\Adapter $watermark){ }


		/**
		 * Set the background color of an image
		 */
		public function background($color, $opacity=null){ }


		/**
		 * Blur image
		 */
		public function blur($radius){ }


		/**
		 * Pixelate image
		 */
		public function pixelate($amount){ }


		/**
		 * Save the image
		 */
		public function save($file=null, $quality=null){ }


		/**
		 * Render the image and return the binary string
		 */
		public function render($ext=null, $quality=null){ }

	}
}
