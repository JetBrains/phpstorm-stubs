<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Collection
	 *
	 * This component implements a high level abstraction for NoSQL databases which
	 * works with documents
	 */
	
	abstract class Collection implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\CollectionInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable {

		const OP_NONE = 0;

		const OP_CREATE = 1;

		const OP_UPDATE = 2;

		const OP_DELETE = 3;

		const DIRTY_STATE_PERSISTENT = 0;

		const DIRTY_STATE_TRANSIENT = 1;

		const DIRTY_STATE_DETACHED = 2;

		public $_id;

		protected $_dependencyInjector;

		protected $_modelsManager;

		protected $_source;

		protected $_operationMade;

		protected $_dirtyState;

		protected $_connection;

		protected $_errorMessages;

		protected static $_reserved;

		protected static $_disableEvents;

		protected $_skipped;

		/**
		 * \Phalcon\Mvc\Collection constructor
		 */
		final public function __construct(\Phalcon\DiInterface $dependencyInjector=null, \Phalcon\Mvc\Collection\ManagerInterface $modelsManager=null){ }


		/**
		 * Sets a value for the _id property, creates a MongoId object if needed
		 *
		 * @param mixed id
		 */
		public function setId($id){ }


		/**
		 * Returns the value of the _id property
		 *
		 * @return \MongoId
		 */
		public function getId(){ }


		/**
		 * Sets the dependency injection container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 */
		public function getDI(){ }


		/**
		 * Sets a custom events manager
		 */
		protected function setEventsManager(\Phalcon\Mvc\Collection\ManagerInterface $eventsManager){ }


		/**
		 * Returns the custom events manager
		 */
		protected function getEventsManager(){ }


		/**
		 * Returns the models manager related to the entity instance
		 */
		public function getCollectionManager(){ }


		/**
		 * Returns an array with reserved properties that cannot be part of the insert/update
		 */
		public function getReservedAttributes(){ }


		/**
		 * Sets if a model must use implicit objects ids
		 */
		protected function useImplicitObjectIds($useImplicitObjectIds){ }


		/**
		 * Sets collection name which model should be mapped
		 */
		protected function setSource($source){ }


		/**
		 * Returns collection name mapped in the model
		 */
		public function getSource(){ }


		/**
		 * Sets the DependencyInjection connection service name
		 */
		public function setConnectionService($connectionService){ }


		/**
		 * Returns DependencyInjection connection service
		 */
		public function getConnectionService(){ }


		/**
		 * Retrieves a database connection
		 *
		 * @return \MongoDb
		 */
		public function getConnection(){ }


		/**
		 * Reads an attribute value by its name
		 *
		 *<code>
		 *	echo $robot->readAttribute("name");
		 *</code>
		 *
		 * @param string attribute
		 * @return mixed
		 */
		public function readAttribute($attribute){ }


		/**
		 * Writes an attribute value by its name
		 *
		 *<code>
		 *	$robot->writeAttribute("name", "Rosey");
		 *</code>
		 *
		 * @param string attribute
		 * @param mixed value
		 */
		public function writeAttribute($attribute, $value){ }


		/**
		 * Returns a cloned collection
		 */
		public static function cloneResult(\Phalcon\Mvc\CollectionInterface $collection, $document){ }


		/**
		 * Returns a collection resultset
		 *
		 * @param array params
		 * @param \Phalcon\Mvc\Collection collection
		 * @param \MongoDb connection
		 * @param boolean unique
		 * @return array
		 */
		protected static function _getResultset($params, \Phalcon\Mvc\CollectionInterface $collection, $connection, $unique){ }


		/**
		 * Perform a count over a resultset
		 *
		 * @param array params
		 * @param \Phalcon\Mvc\Collection collection
		 * @param \MongoDb connection
		 * @return int
		 */
		protected static function _getGroupResultset($params, \Phalcon\Mvc\Collection $collection, $connection){ }


		/**
		 * Executes internal hooks before save a document
		 *
		 * @param \Phalcon\DiInterface dependencyInjector
		 * @param boolean disableEvents
		 * @param boolean exists
		 * @return boolean
		 */
		final protected function _preSave($dependencyInjector, $disableEvents, $exists){ }


		/**
		 * Executes internal events after save a document
		 */
		final protected function _postSave($disableEvents, $success, $exists){ }


		/**
		 * Executes validators on every validation call
		 *
		 *<code>
		 * use \Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
		 *
		 * class Subscriptors extends \Phalcon\Mvc\Collection
		 * {
		 *     public function validation()
		 *     {
		 *         // Old, deprecated syntax, use new one below
		 *         $this->validate(
		 *             new ExclusionIn(
		 *                 [
		 *                     "field"  => "status",
		 *                     "domain" => ["A", "I"],
		 *                 ]
		 *             )
		 *         );
		 *
		 *         if ($this->validationHasFailed() == true) {
		 *             return false;
		 *         }
		 *     }
		 * }
		 *</code>
		 *
		 *<code>
		 * use \Phalcon\Validation\Validator\ExclusionIn as ExclusionIn;
		 * use \Phalcon\Validation;
		 *
		 * class Subscriptors extends \Phalcon\Mvc\Collection
		 * {
		 *     public function validation()
		 *     {
		 *         $validator = new Validation();
		 *         $validator->add("status",
		 *             new ExclusionIn(
		 *                 [
		 *                     "domain" => ["A", "I"]
		 *                 ]
		 *             )
		 *         );
		 *
		 *         return $this->validate($validator);
		 *     }
		 * }
		 *</code>
		 */
		protected function validate($validator){ }


		/**
		 * Check whether validation process has generated any messages
		 *
		 *<code>
		 * use \Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
		 *
		 * class Subscriptors extends \Phalcon\Mvc\Collection
		 * {
		 *     public function validation()
		 *     {
		 *         $this->validate(
		 *             new ExclusionIn(
		 *                 [
		 *                     "field"  => "status",
		 *                     "domain" => ["A", "I"],
		 *                 ]
		 *             )
		 *         );
		 *
		 *         if ($this->validationHasFailed() == true) {
		 *             return false;
		 *         }
		 *     }
		 * }
		 *</code>
		 */
		public function validationHasFailed(){ }


		/**
		 * Fires an internal event
		 */
		public function fireEvent($eventName){ }


		/**
		 * Fires an internal event that cancels the operation
		 */
		public function fireEventCancel($eventName){ }


		/**
		 * Cancel the current operation
		 */
		protected function _cancelOperation($disableEvents){ }


		/**
		 * Checks if the document exists in the collection
		 *
		 * @param \MongoCollection collection
		 * @return boolean
		 */
		protected function _exists($collection){ }


		/**
		 * Returns all the validation messages
		 *
		 * <code>
		 * $robot = new Robots();
		 *
		 * $robot->type = "mechanical";
		 * $robot->name = "Astro Boy";
		 * $robot->year = 1952;
		 *
		 * if ($robot->save() === false) {
		 *     echo "Umh, We can't store robots right now ";
		 *
		 *     $messages = $robot->getMessages();
		 *
		 *     foreach ($messages as $message) {
		 *         echo $message;
		 *     }
		 * } else {
		 *     echo "Great, a new robot was saved successfully!";
		 * }
		 * </code>
		 */
		public function getMessages(){ }


		/**
		 * Appends a customized message on the validation process
		 *
		 *<code>
		 * use \Phalcon\Mvc\Model\Message as Message;
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function beforeSave()
		 *     {
		 *         if ($this->name === "Peter") {
		 *             $message = new Message(
		 *                 "Sorry, but a robot cannot be named Peter"
		 *             );
		 *
		 *             $this->appendMessage(message);
		 *         }
		 *     }
		 * }
		 *</code>
		 */
		public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message){ }


		/**
		 * Shared Code for CU Operations
		 * Prepares Collection
		 */
		protected function prepareCU(){ }


		/**
		 * Creates/Updates a collection based on the values in the attributes
		 */
		public function save(){ }


		/**
		 * Creates a collection based on the values in the attributes
		 */
		public function create(){ }


		/**
		 * Creates a document based on the values in the attributes, if not found by criteria
		 * Preferred way to avoid duplication is to create index on attribute
		 *
		 * <code>
		 * $robot = new Robot();
		 *
		 * $robot->name = "MyRobot";
		 * $robot->type = "Droid";
		 *
		 * // Create only if robot with same name and type does not exist
		 * $robot->createIfNotExist(
		 *     [
		 *         "name",
		 *         "type",
		 *     ]
		 * );
		 * </code>
		 */
		public function createIfNotExist($criteria){ }


		/**
		 * Creates/Updates a collection based on the values in the attributes
		 */
		public function update(){ }


		/**
		 * Find a document by its id (_id)
		 *
		 * <code>
		 * // Find user by using \MongoId object
		 * $user = Users::findById(
		 *     new \MongoId("545eb081631d16153a293a66")
		 * );
		 *
		 * // Find user by using id as sting
		 * $user = Users::findById("45cbc4a0e4123f6920000002");
		 *
		 * // Validate input
		 * if ($user = Users::findById($_POST["id"])) {
		 *     // ...
		 * }
		 * </code>
		 */
		public static function findById($id){ }


		/**
		 * Allows to query the first record that match the specified conditions
		 *
		 * <code>
		 * // What's the first robot in the robots table?
		 * $robot = Robots::findFirst();
		 *
		 * echo "The robot name is ", $robot->name, "\n";
		 *
		 * // What's the first mechanical robot in robots table?
		 * $robot = Robots::findFirst(
		 *     [
		 *         [
		 *             "type" => "mechanical",
		 *         ]
		 *     ]
		 * );
		 *
		 * echo "The first mechanical robot name is ", $robot->name, "\n";
		 *
		 * // Get first virtual robot ordered by name
		 * $robot = Robots::findFirst(
		 *     [
		 *         [
		 *             "type" => "mechanical",
		 *         ],
		 *         "order" => [
		 *             "name" => 1,
		 *         ],
		 *     ]
		 * );
		 *
		 * echo "The first virtual robot name is ", $robot->name, "\n";
		 *
		 * // Get first robot by id (_id)
		 * $robot = Robots::findFirst(
		 *     [
		 *         [
		 *             "_id" => new \MongoId("45cbc4a0e4123f6920000002"),
		 *         ]
		 *     ]
		 * );
		 *
		 * echo "The robot id is ", $robot->_id, "\n";
		 * </code>
		 */
		public static function findFirst($parameters=null){ }


		/**
		 * Allows to query a set of records that match the specified conditions
		 *
		 * <code>
		 * // How many robots are there?
		 * $robots = Robots::find();
		 *
		 * echo "There are ", count($robots), "\n";
		 *
		 * // How many mechanical robots are there?
		 * $robots = Robots::find(
		 *     [
		 *         [
		 *             "type" => "mechanical",
		 *         ]
		 *     ]
		 * );
		 *
		 * echo "There are ", count(robots), "\n";
		 *
		 * // Get and print virtual robots ordered by name
		 * $robots = Robots::findFirst(
		 *     [
		 *         [
		 *             "type" => "virtual"
		 *         ],
		 *         "order" => [
		 *             "name" => 1,
		 *         ]
		 *     ]
		 * );
		 *
		 * foreach ($robots as $robot) {
		 *	   echo $robot->name, "\n";
		 * }
		 *
		 * // Get first 100 virtual robots ordered by name
		 * $robots = Robots::find(
		 *     [
		 *         [
		 *             "type" => "virtual",
		 *         ],
		 *         "order" => [
		 *             "name" => 1,
		 *         ],
		 *         "limit" => 100,
		 *     ]
		 * );
		 *
		 * foreach ($robots as $robot) {
		 *	   echo $robot->name, "\n";
		 * }
		 * </code>
		 */
		public static function find($parameters=null){ }


		/**
		 * Perform a count over a collection
		 *
		 *<code>
		 * echo "There are ", Robots::count(), " robots";
		 *</code>
		 */
		public static function count($parameters=null){ }


		/**
		 * Perform an aggregation using the Mongo aggregation framework
		 */
		public static function aggregate($parameters=null){ }


		/**
		 * Allows to perform a summatory group for a column in the collection
		 */
		public static function summatory($field, $conditions=null, $finalize=null){ }


		/**
		 * Deletes a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 * $robot = Robots::findFirst();
		 *
		 * $robot->delete();
		 *
		 * $robots = Robots::find();
		 *
		 * foreach ($robots as $robot) {
		 *     $robot->delete();
		 * }
		 * </code>
		 */
		public function delete(){ }


		/**
		 * Sets the dirty state of the object using one of the DIRTY_STATE_* constants
		 */
		public function setDirtyState($dirtyState){ }


		/**
		 * Returns one of the DIRTY_STATE_* constants telling if the document exists in the collection or not
		 */
		public function getDirtyState(){ }


		/**
		 * Sets up a behavior in a collection
		 */
		protected function addBehavior(\Phalcon\Mvc\Collection\BehaviorInterface $behavior){ }


		/**
		 * Skips the current operation forcing a success state
		 */
		public function skipOperation($skip){ }


		/**
		 * Returns the instance as an array representation
		 *
		 *<code>
		 * print_r(
		 *     $robot->toArray()
		 * );
		 *</code>
		 */
		public function toArray(){ }


		/**
		 * Serializes the object ignoring connections or protected properties
		 */
		public function serialize(){ }


		/**
		 * Unserializes the object from a serialized string
		 */
		public function unserialize($data){ }

	}
}
