<?php 

namespace Phalcon\Mvc\Model {

	interface TransactionInterface {

		public function setTransactionManager(\Phalcon\Mvc\Model\Transaction\ManagerInterface $manager);


		public function begin();


		public function commit();


		public function rollback($rollbackMessage=null, $rollbackRecord=null);


		public function getConnection();


		public function setIsNewTransaction($isNew);


		public function setRollbackOnAbort($rollbackOnAbort);


		public function isManaged();


		public function getMessages();


		public function isValid();


		public function setRollbackedRecord(\Phalcon\Mvc\ModelInterface $record);

	}
}
