<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Criteria
	 *
	 * This class is used to build the array parameter required by
	 * Phalcon\Mvc\Model::find() and Phalcon\Mvc\Model::findFirst()
	 * using an object-oriented interface.
	 *
	 * <code>
	 * $robots = Robots::query()
	 *     ->where("type = :type:")
	 *     ->andWhere("year < 2000")
	 *     ->bind(["type" => "mechanical"])
	 *     ->limit(5, 10)
	 *     ->orderBy("name")
	 *     ->execute();
	 * </code>
	 */
	
	class Criteria implements \Phalcon\Mvc\Model\CriteriaInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_model;

		protected $_params;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_hiddenParamNumber;

		/**
		 * Sets the DependencyInjector container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 */
		public function getDI(){ }


		/**
		 * Set a model on which the query will be executed
		 */
		public function setModelName($modelName){ }


		/**
		 * Returns an internal model name on which the criteria will be applied
		 */
		public function getModelName(){ }


		/**
		 * Sets the bound parameters in the criteria
		 * This method replaces all previously set bound parameters
		 */
		public function bind($bindParams, $merge=null){ }


		/**
		 * Sets the bind types in the criteria
		 * This method replaces all previously set bound parameters
		 */
		public function bindTypes($bindTypes){ }


		/**
		 * Sets SELECT DISTINCT / SELECT ALL flag
		 */
		public function distinct($distinct){ }


		/**
		 * Sets the columns to be queried
		 *
		 *<code>
		 * $criteria->columns(
		 *     [
		 *         "id",
		 *         "name",
		 *     ]
		 * );
		 *</code>
		 *
		 * @param string|array columns
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function columns($columns){ }


		/**
		 * Adds an INNER join to the query
		 *
		 *<code>
		 * $criteria->join("Robots");
		 * $criteria->join("Robots", "r.id = RobotsParts.robots_id");
		 * $criteria->join("Robots", "r.id = RobotsParts.robots_id", "r");
		 * $criteria->join("Robots", "r.id = RobotsParts.robots_id", "r", "LEFT");
		 *</code>
		 */
		public function join($model, $conditions=null, $alias=null, $type=null){ }


		/**
		 * Adds an INNER join to the query
		 *
		 *<code>
		 * $criteria->innerJoin("Robots");
		 * $criteria->innerJoin("Robots", "r.id = RobotsParts.robots_id");
		 * $criteria->innerJoin("Robots", "r.id = RobotsParts.robots_id", "r");
		 *</code>
		 */
		public function innerJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a LEFT join to the query
		 *
		 *<code>
		 * $criteria->leftJoin("Robots", "r.id = RobotsParts.robots_id", "r");
		 *</code>
		 */
		public function leftJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a RIGHT join to the query
		 *
		 *<code>
		 * $criteria->rightJoin("Robots", "r.id = RobotsParts.robots_id", "r");
		 *</code>
		 */
		public function rightJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Sets the conditions parameter in the criteria
		 */
		public function where($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current conditions using an AND operator (deprecated)
		 *
		 * @deprecated 1.0.0
		 * @see \Phalcon\Mvc\Model\Criteria::andWhere()
		 */
		public function addWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current conditions using an AND operator
		 */
		public function andWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current conditions using an OR operator
		 */
		public function orWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a BETWEEN condition to the current conditions
		 *
		 *<code>
		 * $criteria->betweenWhere("price", 100.25, 200.50);
		 *</code>
		 */
		public function betweenWhere($expr, $minimum, $maximum){ }


		/**
		 * Appends a NOT BETWEEN condition to the current conditions
		 *
		 *<code>
		 * $criteria->notBetweenWhere("price", 100.25, 200.50);
		 *</code>
		 */
		public function notBetweenWhere($expr, $minimum, $maximum){ }


		/**
		 * Appends an IN condition to the current conditions
		 *
		 * <code>
		 * $criteria->inWhere("id", [1, 2, 3]);
		 * </code>
		 */
		public function inWhere($expr, $values){ }


		/**
		 * Appends a NOT IN condition to the current conditions
		 *
		 *<code>
		 * $criteria->notInWhere("id", [1, 2, 3]);
		 *</code>
		 */
		public function notInWhere($expr, $values){ }


		/**
		 * Adds the conditions parameter to the criteria
		 */
		public function conditions($conditions){ }


		/**
		 * Adds the order-by parameter to the criteria (deprecated)
		 *
		 * @see \Phalcon\Mvc\Model\Criteria::orderBy()
		 */
		public function order($orderColumns){ }


		/**
		 * Adds the order-by clause to the criteria
		 */
		public function orderBy($orderColumns){ }


		/**
		 * Adds the group-by clause to the criteria
		 */
		public function groupBy($group){ }


		/**
		 * Adds the having clause to the criteria
		 */
		public function having($having){ }


		/**
		 * Adds the limit parameter to the criteria.
		 *
		 * <code>
		 * $criteria->limit(100);
		 * $criteria->limit(100, 200);
		 * $criteria->limit("100", "200");
		 * </code>
		 */
		public function limit($limit, $offset=null){ }


		/**
		 * Adds the "for_update" parameter to the criteria
		 */
		public function forUpdate($forUpdate=null){ }


		/**
		 * Adds the "shared_lock" parameter to the criteria
		 */
		public function sharedLock($sharedLock=null){ }


		/**
		 * Sets the cache options in the criteria
		 * This method replaces all previously set cache options
		 */
		public function cache($cache){ }


		/**
		 * Returns the conditions parameter in the criteria
		 */
		public function getWhere(){ }


		/**
		 * Returns the columns to be queried
		 *
		 * @return string|array|null
		 */
		public function getColumns(){ }


		/**
		 * Returns the conditions parameter in the criteria
		 */
		public function getConditions(){ }


		/**
		 * Returns the limit parameter in the criteria, which will be
		 * an integer if limit was set without an offset,
		 * an array with 'number' and 'offset' keys if an offset was set with the limit,
		 * or null if limit has not been set.
		 *
		 * @return int|array|null
		 */
		public function getLimit(){ }


		/**
		 * Returns the order clause in the criteria
		 */
		public function getOrderBy(){ }


		/**
		 * Returns the group clause in the criteria
		 */
		public function getGroupBy(){ }


		/**
		 * Returns the having clause in the criteria
		 */
		public function getHaving(){ }


		/**
		 * Returns all the parameters defined in the criteria
		 *
		 * @return array
		 */
		public function getParams(){ }


		/**
		 * Builds a \Phalcon\Mvc\Model\Criteria based on an input array like $_POST
		 */
		public static function fromInput(\Phalcon\DiInterface $dependencyInjector, $modelName, $data, $operator=null){ }


		/**
		 * Creates a query builder from criteria.
		 *
		 * <code>
		 * $builder = Robots::query()
		 *     ->where("type = :type:")
		 *     ->bind(["type" => "mechanical"])
		 *     ->createBuilder();
		 * </code>
		 */
		public function createBuilder(){ }


		/**
		 * Executes a find using the parameters built with the criteria
		 */
		public function execute(){ }

	}
}
