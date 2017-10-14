<?php 

namespace Phalcon\Mvc\Model\Query {

	/**
	 * Phalcon\Mvc\Model\Query\Status
	 *
	 * This class represents the status returned by a PHQL
	 * statement like INSERT, UPDATE or DELETE. It offers context
	 * information and the related messages produced by the
	 * model which finally executes the operations when it fails
	 *
	 *<code>
	 * $phql = "UPDATE Robots SET name = :name:, type = :type:, year = :year: WHERE id = :id:";
	 *
	 * $status = $app->modelsManager->executeQuery(
	 *     $phql,
	 *     [
	 *         "id"   => 100,
	 *         "name" => "Astroy Boy",
	 *         "type" => "mechanical",
	 *         "year" => 1959,
	 *     ]
	 * );
	 *
	 * // Check if the update was successful
	 * if ($status->success() === true) {
	 *     echo "OK";
	 * }
	 *</code>
	 */
	
	class Status implements \Phalcon\Mvc\Model\Query\StatusInterface {

		protected $_success;

		protected $_model;

		/**
		 * \Phalcon\Mvc\Model\Query\Status
		 */
		public function __construct($success, \Phalcon\Mvc\ModelInterface $model=null){ }


		/**
		 * Returns the model that executed the action
		 */
		public function getModel(){ }


		/**
		 * Returns the messages produced because of a failed operation
		 */
		public function getMessages(){ }


		/**
		 * Allows to check if the executed operation was successful
		 */
		public function success(){ }

	}
}
