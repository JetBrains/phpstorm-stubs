<?php 

namespace Phalcon\Mvc\Model\Query {

	/**
	 * Phalcon\Mvc\Model\Query\Builder
	 *
	 * Helps to create PHQL queries using an OO interface
	 *
	 *<code>
	 * $params = [
	 *     "models"     => ["Users"],
	 *     "columns"    => ["id", "name", "status"],
	 *     "conditions" => [
	 *         [
	 *             "created > :min: AND created < :max:",
	 *             [
	 *                 "min" => "2013-01-01",
	 *                 "max" => "2014-01-01",
	 *             ],
	 *             [
	 *                 "min" => PDO::PARAM_STR,
	 *                 "max" => PDO::PARAM_STR,
	 *             ],
	 *         ],
	 *     ],
	 *     // or "conditions" => "created > '2013-01-01' AND created < '2014-01-01'",
	 *     "group"      => ["id", "name"],
	 *     "having"     => "name = 'Kamil'",
	 *     "order"      => ["name", "id"],
	 *     "limit"      => 20,
	 *     "offset"     => 20,
	 *     // or "limit" => [20, 20],
	 * ];
	 *
	 * $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($params);
	 *</code>
	 */
	
	class Builder implements \Phalcon\Mvc\Model\Query\BuilderInterface, \Phalcon\Di\InjectionAwareInterface {

		const OPERATOR_OR = or;

		const OPERATOR_AND = and;

		protected $_dependencyInjector;

		protected $_columns;

		protected $_models;

		protected $_joins;

		protected $_with;

		protected $_conditions;

		protected $_group;

		protected $_having;

		protected $_order;

		protected $_limit;

		protected $_offset;

		protected $_forUpdate;

		protected $_sharedLock;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_distinct;

		protected $_hiddenParamNumber;

		/**
		 * \Phalcon\Mvc\Model\Query\Builder constructor
		 */
		public function __construct($params=null, \Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * Sets the DependencyInjector container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 */
		public function getDI(){ }


		/**
		 * Sets SELECT DISTINCT / SELECT ALL flag
		 *
		 *<code>
		 * $builder->distinct("status");
		 * $builder->distinct(null);
		 *</code>
		 */
		public function distinct($distinct){ }


		/**
		 * Returns SELECT DISTINCT / SELECT ALL flag
		 */
		public function getDistinct(){ }


		/**
		 * Sets the columns to be queried
		 *
		 *<code>
		 * $builder->columns("id, name");
		 *
		 * $builder->columns(
		 *     [
		 *         "id",
		 *         "name",
		 *     ]
		 * );
		 *
		 * $builder->columns(
		 *     [
		 *         "name",
		 *         "number" => "COUNT(*)",
		 *     ]
		 * );
		 *</code>
		 */
		public function columns($columns){ }


		/**
		 * Return the columns to be queried
		 *
		 * @return string|array
		 */
		public function getColumns(){ }


		/**
		 * Sets the models who makes part of the query
		 *
		 *<code>
		 * $builder->from("Robots");
		 *
		 * $builder->from(
		 *     [
		 *         "Robots",
		 *         "RobotsParts",
		 *     ]
		 * );
		 *
		 * $builder->from(
		 *     [
		 *         "r"  => "Robots",
		 *         "rp" => "RobotsParts",
		 *     ]
		 * );
		 *</code>
		 */
		public function from($models){ }


		/**
		 * Add a model to take part of the query
		 *
		 * NOTE: The third parameter $with is deprecated and will be removed in future releases.
		 *
		 *<code>
		 * // Load data from models Robots
		 * $builder->addFrom("Robots");
		 *
		 * // Load data from model 'Robots' using 'r' as alias in PHQL
		 * $builder->addFrom("Robots", "r");
		 *</code>
		 */
		public function addFrom($model, $alias=null, $with=null){ }


		/**
		 * Return the models who makes part of the query
		 *
		 * @return string|array
		 */
		public function getFrom(){ }


		/**
		 * Adds an :type: join (by default type - INNER) to the query
		 *
		 *<code>
		 * // Inner Join model 'Robots' with automatic conditions and alias
		 * $builder->join("Robots");
		 *
		 * // Inner Join model 'Robots' specifying conditions
		 * $builder->join("Robots", "Robots.id = RobotsParts.robots_id");
		 *
		 * // Inner Join model 'Robots' specifying conditions and alias
		 * $builder->join("Robots", "r.id = RobotsParts.robots_id", "r");
		 *
		 * // Left Join model 'Robots' specifying conditions, alias and type of join
		 * $builder->join("Robots", "r.id = RobotsParts.robots_id", "r", "LEFT");
		 *</code>
		 *
		 * @param string model
		 * @param string conditions
		 * @param string alias
		 * @param string type
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function join($model, $conditions=null, $alias=null, $type=null){ }


		/**
		 * Adds an INNER join to the query
		 *
		 *<code>
		 * // Inner Join model 'Robots' with automatic conditions and alias
		 * $builder->innerJoin("Robots");
		 *
		 * // Inner Join model 'Robots' specifying conditions
		 * $builder->innerJoin("Robots", "Robots.id = RobotsParts.robots_id");
		 *
		 * // Inner Join model 'Robots' specifying conditions and alias
		 * $builder->innerJoin("Robots", "r.id = RobotsParts.robots_id", "r");
		 *</code>
		 *
		 * @param string model
		 * @param string conditions
		 * @param string alias
		 * @param string type
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function innerJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a LEFT join to the query
		 *
		 *<code>
		 * $builder->leftJoin("Robots", "r.id = RobotsParts.robots_id", "r");
		 *</code>
		 *
		 * @param string model
		 * @param string conditions
		 * @param string alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function leftJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a RIGHT join to the query
		 *
		 *<code>
		 * $builder->rightJoin("Robots", "r.id = RobotsParts.robots_id", "r");
		 *</code>
		 *
		 * @param string model
		 * @param string conditions
		 * @param string alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function rightJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Return join parts of the query
		 *
		 * @return array
		 */
		public function getJoins(){ }


		/**
		 * Sets the query WHERE conditions
		 *
		 *<code>
		 * $builder->where(100);
		 *
		 * $builder->where("name = 'Peter'");
		 *
		 * $builder->where(
		 *     "name = :name: AND id > :id:",
		 *     [
		 *         "name" => "Peter",
		 *         "id"   => 100,
		 *     ]
		 * );
		 *</code>
		 *
		 * @param mixed conditions
		 * @param array bindParams
		 * @param array bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function where($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current WHERE conditions using a AND operator
		 *
		 *<code>
		 * $builder->andWhere("name = 'Peter'");
		 *
		 * $builder->andWhere(
		 *     "name = :name: AND id > :id:",
		 *     [
		 *         "name" => "Peter",
		 *         "id"   => 100,
		 *     ]
		 * );
		 *</code>
		 *
		 * @param string conditions
		 * @param array bindParams
		 * @param array bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function andWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current conditions using an OR operator
		 *
		 *<code>
		 * $builder->orWhere("name = 'Peter'");
		 *
		 * $builder->orWhere(
		 *     "name = :name: AND id > :id:",
		 *     [
		 *         "name" => "Peter",
		 *         "id"   => 100,
		 *     ]
		 * );
		 *</code>
		 *
		 * @param string conditions
		 * @param array bindParams
		 * @param array bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function orWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a BETWEEN condition to the current WHERE conditions
		 *
		 *<code>
		 * $builder->betweenWhere("price", 100.25, 200.50);
		 *</code>
		 */
		public function betweenWhere($expr, $minimum, $maximum, $operator=null){ }


		/**
		 * Appends a NOT BETWEEN condition to the current WHERE conditions
		 *
		 *<code>
		 * $builder->notBetweenWhere("price", 100.25, 200.50);
		 *</code>
		 */
		public function notBetweenWhere($expr, $minimum, $maximum, $operator=null){ }


		/**
		 * Appends an IN condition to the current WHERE conditions
		 *
		 *<code>
		 * $builder->inWhere("id", [1, 2, 3]);
		 *</code>
		 */
		public function inWhere($expr, $values, $operator=null){ }


		/**
		 * Appends a NOT IN condition to the current WHERE conditions
		 *
		 *<code>
		 * $builder->notInWhere("id", [1, 2, 3]);
		 *</code>
		 */
		public function notInWhere($expr, $values, $operator=null){ }


		/**
		 * Return the conditions for the query
		 *
		 * @return string|array
		 */
		public function getWhere(){ }


		/**
		 * Sets an ORDER BY condition clause
		 *
		 *<code>
		 * $builder->orderBy("Robots.name");
		 * $builder->orderBy(["1", "Robots.name"]);
		 *</code>
		 *
		 * @param string|array orderBy
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function orderBy($orderBy){ }


		/**
		 * Returns the set ORDER BY clause
		 *
		 * @return string|array
		 */
		public function getOrderBy(){ }


		/**
		 * Sets the HAVING condition clause
		 *
		 *<code>
		 * $builder->having("SUM(Robots.price) > 0");
		 *
		 * $builder->having(
		 * 		"SUM(Robots.price) > :sum:",
		 *   	[
		 *    		"sum" => 100,
		 *      ]
		 * );
		 *</code>
		 *
		 * @param mixed conditions
		 * @param array bindParams
		 * @param array bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function having($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current HAVING conditions clause using a AND operator
		 *
		 *<code>
		 * $builder->andHaving("SUM(Robots.price) > 0");
		 *
		 * $builder->andHaving(
		 * 		"SUM(Robots.price) > :sum:",
		 *   	[
		 *    		"sum" => 100,
		 *      ]
		 * );
		 *</code>
		 *
		 * @param string conditions
		 * @param array bindParams
		 * @param array bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function andHaving($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current HAVING conditions clause using an OR operator
		 *
		 *<code>
		 * $builder->orHaving("SUM(Robots.price) > 0");
		 *
		 * $builder->orHaving(
		 * 		"SUM(Robots.price) > :sum:",
		 *   	[
		 *    		"sum" => 100,
		 *      ]
		 * );
		 *</code>
		 *
		 * @param string conditions
		 * @param array bindParams
		 * @param array bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function orHaving($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a BETWEEN condition to the current HAVING conditions clause
		 *
		 *<code>
		 * $builder->betweenHaving("SUM(Robots.price)", 100.25, 200.50);
		 *</code>
		 */
		public function betweenHaving($expr, $minimum, $maximum, $operator=null){ }


		/**
		 * Appends a NOT BETWEEN condition to the current HAVING conditions clause
		 *
		 *<code>
		 * $builder->notBetweenHaving("SUM(Robots.price)", 100.25, 200.50);
		 *</code>
		 */
		public function notBetweenHaving($expr, $minimum, $maximum, $operator=null){ }


		/**
		 * Appends an IN condition to the current HAVING conditions clause
		 *
		 *<code>
		 * $builder->inHaving("SUM(Robots.price)", [100, 200]);
		 *</code>
		 */
		public function inHaving($expr, $values, $operator=null){ }


		/**
		 * Appends a NOT IN condition to the current HAVING conditions clause
		 *
		 *<code>
		 * $builder->notInHaving("SUM(Robots.price)", [100, 200]);
		 *</code>
		 */
		public function notInHaving($expr, $values, $operator=null){ }


		/**
		 * Return the current having clause
		 *
		 * @return string
		 */
		public function getHaving(){ }


		/**
		 * Sets a FOR UPDATE clause
		 *
		 *<code>
		 * $builder->forUpdate(true);
		 *</code>
		 */
		public function forUpdate($forUpdate){ }


		/**
		 * Sets a LIMIT clause, optionally an offset clause
		 *
		 * <code>
		 * $builder->limit(100);
		 * $builder->limit(100, 20);
		 * $builder->limit("100", "20");
		 * </code>
		 */
		public function limit($limit, $offset=null){ }


		/**
		 * Returns the current LIMIT clause
		 *
		 * @return string|array
		 */
		public function getLimit(){ }


		/**
		 * Sets an OFFSET clause
		 *
		 *<code>
		 * $builder->offset(30);
		 *</code>
		 */
		public function offset($offset){ }


		/**
		 * Returns the current OFFSET clause
		 *
		 * @return string|array
		 */
		public function getOffset(){ }


		/**
		 * Sets a GROUP BY clause
		 *
		 *<code>
		 * $builder->groupBy(
		 *     [
		 *         "Robots.name",
		 *     ]
		 * );
		 *</code>
		 *
		 * @param string|array group
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function groupBy($group){ }


		/**
		 * Returns the GROUP BY clause
		 *
		 * @return string
		 */
		public function getGroupBy(){ }


		/**
		 * Returns a PHQL statement built based on the builder parameters
		 *
		 * @return string
		 */
		final public function getPhql(){ }


		/**
		 * Returns the query built
		 */
		public function getQuery(){ }


		/**
		 * Automatically escapes identifiers but only if they need to be escaped.
		 */
		final public function autoescape($identifier){ }


		/**
		 * Appends a BETWEEN condition
		 */
		private function _conditionBetween($clause, $operator, $expr, $minimum, $maximum){ }


		/**
		 * Appends a NOT BETWEEN condition
		 */
		private function _conditionNotBetween($clause, $operator, $expr, $minimum, $maximum){ }


		/**
		 * Appends an IN condition
		 */
		private function _conditionIn($clause, $operator, $expr, $values){ }


		/**
		 * Appends a NOT IN condition
		 */
		private function _conditionNotIn($clause, $operator, $expr, $values){ }

	}
}
