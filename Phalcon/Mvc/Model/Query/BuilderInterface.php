<?php 

namespace Phalcon\Mvc\Model\Query {

	interface BuilderInterface {

		const OPERATOR_OR = or;

		const OPERATOR_AND = and;

		public function columns($columns);


		public function getColumns();


		public function from($models);


		public function addFrom($model, $alias=null);


		public function getFrom();


		public function join($model, $conditions=null, $alias=null, $type=null);


		public function innerJoin($model, $conditions=null, $alias=null);


		public function leftJoin($model, $conditions=null, $alias=null);


		public function rightJoin($model, $conditions=null, $alias=null);


		public function getJoins();


		public function where($conditions, $bindParams=null, $bindTypes=null);


		public function andWhere($conditions, $bindParams=null, $bindTypes=null);


		public function orWhere($conditions, $bindParams=null, $bindTypes=null);


		public function betweenWhere($expr, $minimum, $maximum, $operator=null);


		public function notBetweenWhere($expr, $minimum, $maximum, $operator=null);


		public function inWhere($expr, $values, $operator=null);


		public function notInWhere($expr, $values, $operator=null);


		public function getWhere();


		public function orderBy($orderBy);


		public function getOrderBy();


		public function having($having);


		public function getHaving();


		public function limit($limit, $offset=null);


		public function getLimit();


		public function groupBy($group);


		public function getGroupBy();


		public function getPhql();


		public function getQuery();

	}
}
