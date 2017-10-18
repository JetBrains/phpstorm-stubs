<?php 

namespace Phalcon\Paginator\Adapter {

	/**
	 * Phalcon\Paginator\Adapter\QueryBuilder
	 *
	 * Pagination using a PHQL query builder as source of data
	 *
	 * <code>
	 * use Phalcon\Paginator\Adapter\QueryBuilder;
	 *
	 * $builder = $this->modelsManager->createBuilder()
	 *                 ->columns("id, name")
	 *                 ->from("Robots")
	 *                 ->orderBy("name");
	 *
	 * $paginator = new QueryBuilder(
	 *     [
	 *         "builder" => $builder,
	 *         "limit"   => 20,
	 *         "page"    => 1,
	 *     ]
	 * );
	 *</code>
	 */
	
	class QueryBuilder extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface {

		protected $_config;

		protected $_builder;

		protected $_columns;

		/**
		 * \Phalcon\Paginator\Adapter\QueryBuilder
		 */
		public function __construct($config){ }


		/**
		 * Get the current page number
		 */
		public function getCurrentPage(){ }


		/**
		 * Set query builder object
		 */
		public function setQueryBuilder(\Phalcon\Mvc\Model\Query\Builder $builder){ }


		/**
		 * Get query builder object
		 */
		public function getQueryBuilder(){ }


		/**
		 * Returns a slice of the resultset to show in the pagination
		 */
		public function getPaginate(){ }

	}
}
