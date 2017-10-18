<?php 

namespace Phalcon\Http\Request {

	/**
	 * Phalcon\Http\Request\File
	 *
	 * Provides OO wrappers to the $_FILES superglobal
	 *
	 *<code>
	 * use Phalcon\Mvc\Controller;
	 *
	 * class PostsController extends Controller
	 * {
	 *     public function uploadAction()
	 *     {
	 *         // Check if the user has uploaded files
	 *         if ($this->request->hasFiles() == true) {
	 *             // Print the real file names and their sizes
	 *             foreach ($this->request->getUploadedFiles() as $file) {
	 *                 echo $file->getName(), " ", $file->getSize(), "\n";
	 *             }
	 *	       }
	 *     }
	 * }
	 *</code>
	 */
	
	class File implements \Phalcon\Http\Request\FileInterface {

		protected $_name;

		protected $_tmp;

		protected $_size;

		protected $_type;

		protected $_realType;

		protected $_error;

		protected $_key;

		protected $_extension;

		/**
		 */
		public function getError(){ }


		/**
		 */
		public function getKey(){ }


		/**
		 */
		public function getExtension(){ }


		/**
		 * \Phalcon\Http\Request\File constructor
		 */
		public function __construct($file, $key=null){ }


		/**
		 * Returns the file size of the uploaded file
		 */
		public function getSize(){ }


		/**
		 * Returns the real name of the uploaded file
		 */
		public function getName(){ }


		/**
		 * Returns the temporary name of the uploaded file
		 */
		public function getTempName(){ }


		/**
		 * Returns the mime type reported by the browser
		 * This mime type is not completely secure, use getRealType() instead
		 */
		public function getType(){ }


		/**
		 * Gets the real mime type of the upload file using finfo
		 */
		public function getRealType(){ }


		/**
		 * Checks whether the file has been uploaded via Post.
		 */
		public function isUploadedFile(){ }


		/**
		 * Moves the temporary file to a destination within the application
		 */
		public function moveTo($destination){ }

	}
}
