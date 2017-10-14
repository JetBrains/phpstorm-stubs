<?php 

namespace Phalcon\Mvc\Model {

	interface CriteriaInterface {

		public function setModelName($modelName);


		public function getModelName();


		public function bind($bindParams);


		public function bindTypes($bindTypes);


		public function where($conditions);


		public function conditions($conditions);


		public function orderBy($orderColumns);


		public function limit($limit, $offset=null);


		public function forUpdate($forUpdate=null);


		public function sharedLock($sharedLock=null);


		public function andWhere($conditions, $bindParams=null, $bindTypes=null);


		public function orWhere($conditions, $bindParams=null, $bindTypes=null);


		public function betweenWhere($expr, $minimum, $maximum);


		public function notBetweenWhere($expr, $minimum, $maximum);


		public function inWhere($expr, $values);


		public function notInWhere($expr, $values);


		public function getWhere();


		public function getConditions();


		public function getLimit();


		public function getOrderBy();


		public function getParams();


		public function execute();

	}
}
