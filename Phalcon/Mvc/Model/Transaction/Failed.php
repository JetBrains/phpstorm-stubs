<?php 

namespace Phalcon\Mvc\Model\Transaction {

	/**
	 * Phalcon\Mvc\Model\Transaction\Failed
	 *
	 * This class will be thrown to exit a try/catch block for isolated transactions
	 */
	
	class Failed extends \Phalcon\Mvc\Model\Transaction\Exception implements \Throwable {

		protected $_record;

		/**
		 * \Phalcon\Mvc\Model\Transaction\Failed constructor
		 */
		public function __construct($message, \Phalcon\Mvc\ModelInterface $record=null){ }


		/**
		 * Returns validation record messages which stop the transaction
		 */
		public function getRecordMessages(){ }


		/**
		 * Returns validation record messages which stop the transaction
		 */
		public function getRecord(){ }

	}
}
