<?php 

namespace Phalcon\Mvc\Model\Transaction {

	interface ManagerInterface {

		public function has();


		public function get($autoBegin=null);


		public function rollbackPendent();


		public function commit();


		public function rollback($collect=null);


		public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction);


		public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction);


		public function collectTransactions();

	}
}
