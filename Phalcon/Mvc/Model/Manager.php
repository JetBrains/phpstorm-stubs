<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Manager
	 *
	 * This components controls the initialization of models, keeping record of relations
	 * between the different models of the application.
	 *
	 * A ModelsManager is injected to a model via a Dependency Injector/Services Container such as Phalcon\Di.
	 *
	 * <code>
	 * use Phalcon\Di;
	 * use Phalcon\Mvc\Model\Manager as ModelsManager;
	 *
	 * $di = new Di();
	 *
	 * $di->set(
	 *     "modelsManager",
	 *     function() {
	 *         return new ModelsManager();
	 *     }
	 * );
	 *
	 * $robot = new Robots($di);
	 * </code>
	 */
	
	class Manager implements \Phalcon\Mvc\Model\ManagerInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_customEventsManager;

		protected $_readConnectionServices;

		protected $_writeConnectionServices;

		protected $_aliases;

		protected $_modelVisibility;

		protected $_hasMany;

		protected $_hasManySingle;

		protected $_hasOne;

		protected $_hasOneSingle;

		protected $_belongsTo;

		protected $_belongsToSingle;

		protected $_hasManyToMany;

		protected $_hasManyToManySingle;

		protected $_initialized;

		protected $_prefix;

		protected $_sources;

		protected $_schemas;

		protected $_behaviors;

		protected $_lastInitialized;

		protected $_lastQuery;

		protected $_reusable;

		protected $_keepSnapshots;

		protected $_dynamicUpdate;

		protected $_namespaceAliases;

		/**
		 * Sets the DependencyInjector container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 */
		public function getDI(){ }


		/**
		 * Sets a global events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets a custom events manager for a specific model
		 */
		public function setCustomEventsManager(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns a custom events manager related to a model
		 */
		public function getCustomEventsManager(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Initializes a model in the model manager
		 */
		public function initialize(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Check whether a model is already initialized
		 */
		public function isInitialized($modelName){ }


		/**
		 * Get last initialized model
		 */
		public function getLastInitialized(){ }


		/**
		 * Loads a model throwing an exception if it doesn't exist
		 */
		public function load($modelName, $newInstance=null){ }


		/**
		 * Sets the prefix for all model sources.
		 *
		 * <code>
		 * use \Phalcon\Mvc\Model\Manager;
		 *
		 * $di->set("modelsManager", function () {
		 *     $modelsManager = new Manager();
		 *     $modelsManager->setModelPrefix("wp_");
		 *
		 *     return $modelsManager;
		 * });
		 *
		 * $robots = new Robots();
		 * echo $robots->getSource(); // wp_robots
		 * </code>
		 */
		public function setModelPrefix($prefix){ }


		/**
		 * Returns the prefix for all model sources.
		 *
		 * <code>
		 * use \Phalcon\Mvc\Model\Manager;
		 *
		 * $di->set("modelsManager", function () {
		 *     $modelsManager = new Manager();
		 *     $modelsManager->setModelPrefix("wp_");
		 *
		 *     return $modelsManager;
		 * });
		 *
		 * $robots = new Robots();
		 * echo $robots->getSource(); // wp_robots
		 * </code>
		 */
		public function getModelPrefix(){ }


		/**
		 * Sets the mapped source for a model
		 */
		public function setModelSource(\Phalcon\Mvc\ModelInterface $model, $source){ }


		/**
		 * Check whether a model property is declared as public.
		 *
		 * <code>
		 * $isPublic = $manager->isVisibleModelProperty(
		 *     new Robots(),
		 *     "name"
		 * );
		 * </code>
		 */
		final public function isVisibleModelProperty(\Phalcon\Mvc\ModelInterface $model, $property){ }


		/**
		 * Returns the mapped source for a model
		 */
		public function getModelSource(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Sets the mapped schema for a model
		 */
		public function setModelSchema(\Phalcon\Mvc\ModelInterface $model, $schema){ }


		/**
		 * Returns the mapped schema for a model
		 */
		public function getModelSchema(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Sets both write and read connection service for a model
		 */
		public function setConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService){ }


		/**
		 * Sets write connection service for a model
		 */
		public function setWriteConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService){ }


		/**
		 * Sets read connection service for a model
		 */
		public function setReadConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService){ }


		/**
		 * Returns the connection to read data related to a model
		 */
		public function getReadConnection(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Returns the connection to write data related to a model
		 */
		public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Returns the connection to read or write data related to a model depending on the connection services.
		 */
		protected function _getConnection(\Phalcon\Mvc\ModelInterface $model, $connectionServices){ }


		/**
		 * Returns the connection service name used to read data related to a model
		 */
		public function getReadConnectionService(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Returns the connection service name used to write data related to a model
		 */
		public function getWriteConnectionService(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Returns the connection service name used to read or write data related to
		 * a model depending on the connection services
		 */
		public function _getConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionServices){ }


		/**
		 * Receives events generated in the models and dispatches them to an events-manager if available
		 * Notify the behaviors that are listening in the model
		 */
		public function notifyEvent($eventName, \Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Dispatch an event to the listeners and behaviors
		 * This method expects that the endpoint listeners/behaviors returns true
		 * meaning that a least one was implemented
		 */
		public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $eventName, $data){ }


		/**
		 * Binds a behavior to a model
		 */
		public function addBehavior(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior){ }


		/**
		 * Sets if a model must keep snapshots
		 */
		public function keepSnapshots(\Phalcon\Mvc\ModelInterface $model, $keepSnapshots){ }


		/**
		 * Checks if a model is keeping snapshots for the queried records
		 */
		public function isKeepingSnapshots(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Sets if a model must use dynamic update instead of the all-field update
		 */
		public function useDynamicUpdate(\Phalcon\Mvc\ModelInterface $model, $dynamicUpdate){ }


		/**
		 * Checks if a model is using dynamic update instead of all-field update
		 */
		public function isUsingDynamicUpdate(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Setup a 1-1 relation between two models
		 *
		 * @param   \Phalcon\Mvc\Model model
		 * @param	mixed fields
		 * @param	string referencedModel
		 * @param	mixed referencedFields
		 * @param	array options
		 * @return  \Phalcon\Mvc\Model\Relation
		 */
		public function addHasOne(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null){ }


		/**
		 * Setup a relation reverse many to one between two models
		 *
		 * @param   \Phalcon\Mvc\Model model
		 * @param	mixed fields
		 * @param	string referencedModel
		 * @param	mixed referencedFields
		 * @param	array options
		 * @return  \Phalcon\Mvc\Model\Relation
		 */
		public function addBelongsTo(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null){ }


		/**
		 * Setup a relation 1-n between two models
		 *
		 * @param 	Phalcon\Mvc\ModelInterface model
		 * @param	mixed fields
		 * @param	string referencedModel
		 * @param	mixed referencedFields
		 * @param	array options
		 */
		public function addHasMany(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null){ }


		/**
		 * Setups a relation n-m between two models
		 *
		 * @param 	Phalcon\Mvc\ModelInterface model
		 * @param	string fields
		 * @param	string intermediateModel
		 * @param	string intermediateFields
		 * @param	string intermediateReferencedFields
		 * @param	string referencedModel
		 * @param	string referencedFields
		 * @param   array options
		 * @return  \Phalcon\Mvc\Model\Relation
		 */
		public function addHasManyToMany(\Phalcon\Mvc\ModelInterface $model, $fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referencedModel, $referencedFields, $options=null){ }


		/**
		 * Checks whether a model has a belongsTo relation with another model
		 */
		public function existsBelongsTo($modelName, $modelRelation){ }


		/**
		 * Checks whether a model has a hasMany relation with another model
		 */
		public function existsHasMany($modelName, $modelRelation){ }


		/**
		 * Checks whether a model has a hasOne relation with another model
		 */
		public function existsHasOne($modelName, $modelRelation){ }


		/**
		 * Checks whether a model has a hasManyToMany relation with another model
		 */
		public function existsHasManyToMany($modelName, $modelRelation){ }


		/**
		 * Returns a relation by its alias
		 */
		public function getRelationByAlias($modelName, $alias){ }


		/**
		 * Merge two arrays of find parameters
		 */
		final protected function _mergeFindParameters($findParamsOne, $findParamsTwo){ }


		/**
		 * Helper method to query records based on a relation definition
		 *
		 * @return \Phalcon\Mvc\Model\Resultset\Simple|Phalcon\Mvc\Model\Resultset\Simple|int|false
		 */
		public function getRelationRecords(\Phalcon\Mvc\Model\RelationInterface $relation, $method, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		/**
		 * Returns a reusable object from the internal list
		 */
		public function getReusableRecords($modelName, $key){ }


		/**
		 * Stores a reusable record in the internal list
		 */
		public function setReusableRecords($modelName, $key, $records){ }


		/**
		 * Clears the internal reusable list
		 */
		public function clearReusableObjects(){ }


		/**
		 * Gets belongsTo related records from a model
		 */
		public function getBelongsToRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		/**
		 * Gets hasMany related records from a model
		 */
		public function getHasManyRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		/**
		 * Gets belongsTo related records from a model
		 */
		public function getHasOneRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null){ }


		/**
		 * Gets all the belongsTo relations defined in a model
		 *
		 *<code>
		 * $relations = $modelsManager->getBelongsTo(
		 *     new Robots()
		 * );
		 *</code>
		 */
		public function getBelongsTo(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Gets hasMany relations defined on a model
		 */
		public function getHasMany(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Gets hasOne relations defined on a model
		 */
		public function getHasOne(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Gets hasManyToMany relations defined on a model
		 */
		public function getHasManyToMany(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Gets hasOne relations defined on a model
		 */
		public function getHasOneAndHasMany(\Phalcon\Mvc\ModelInterface $model){ }


		/**
		 * Query all the relationships defined on a model
		 */
		public function getRelations($modelName){ }


		/**
		 * Query the first relationship defined between two models
		 */
		public function getRelationsBetween($first, $second){ }


		/**
		 * Creates a \Phalcon\Mvc\Model\Query without execute it
		 */
		public function createQuery($phql){ }


		/**
		 * Creates a \Phalcon\Mvc\Model\Query and execute it
		 */
		public function executeQuery($phql, $placeholders=null, $types=null){ }


		/**
		 * Creates a \Phalcon\Mvc\Model\Query\Builder
		 */
		public function createBuilder($params=null){ }


		/**
		 * Returns the last query created or executed in the models manager
		 */
		public function getLastQuery(){ }


		/**
		 * Registers shorter aliases for namespaces in PHQL statements
		 */
		public function registerNamespaceAlias($alias, $namespaceName){ }


		/**
		 * Returns a real namespace from its alias
		 */
		public function getNamespaceAlias($alias){ }


		/**
		 * Returns all the registered namespace aliases
		 */
		public function getNamespaceAliases(){ }


		/**
		 * Destroys the current PHQL cache
		 */
		public function __destruct(){ }

	}
}
