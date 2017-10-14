<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Model
	 *
	 * Phalcon\Mvc\Model connects business objects and database tables to create
	 * a persistable domain model where logic and data are presented in one wrapping.
	 * It‘s an implementation of the object-relational mapping (ORM).
	 *
	 * A model represents the information (data) of the application and the rules to manipulate that data.
	 * Models are primarily used for managing the rules of interaction with a corresponding database table.
	 * In most cases, each table in your database will correspond to one model in your application.
	 * The bulk of your application's business logic will be concentrated in the models.
	 *
	 * Phalcon\Mvc\Model is the first ORM written in Zephir/C languages for PHP, giving to developers high performance
	 * when interacting with databases while is also easy to use.
	 *
	 * <code>
	 * $robot = new Robots();
	 *
	 * $robot->type = "mechanical";
	 * $robot->name = "Astro Boy";
	 * $robot->year = 1952;
	 *
	 * if ($robot->save() === false) {
	 *     echo "Umh, We can store robots: ";
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
	
	abstract class Model implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\ModelInterface, \Phalcon\Mvc\Model\ResultInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable, \JsonSerializable {

		const OP_NONE = 0;

		const OP_CREATE = 1;

		const OP_UPDATE = 2;

		const OP_DELETE = 3;

		const DIRTY_STATE_PERSISTENT = 0;

		const DIRTY_STATE_TRANSIENT = 1;

		const DIRTY_STATE_DETACHED = 2;

		protected $_dependencyInjector;

		protected $_modelsManager;

		protected $_modelsMetaData;

		protected $_errorMessages;

		protected $_operationMade;

		protected $_dirtyState;

		protected $_transaction;

		protected $_uniqueKey;

		protected $_uniqueParams;

		protected $_uniqueTypes;

		protected $_skipped;

		protected $_related;

		protected $_snapshot;

		protected $_oldSnapshot;

		/**
		 * \Phalcon\Mvc\Model constructor
		 */
		final public function __construct($data=null, \Phalcon\DiInterface $dependencyInjector=null, \Phalcon\Mvc\Model\ManagerInterface $modelsManager=null){ }


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
		protected function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the custom events manager
		 */
		protected function getEventsManager(){ }


		/**
		 * Returns the models meta-data service related to the entity instance
		 */
		public function getModelsMetaData(){ }


		/**
		 * Returns the models manager related to the entity instance
		 */
		public function getModelsManager(){ }


		/**
		 * Sets a transaction related to the Model instance
		 *
		 *<code>
		 * use \Phalcon\Mvc\Model\Transaction\Manager as TxManager;
		 * use \Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
		 *
		 * try {
		 *     $txManager = new TxManager();
		 *
		 *     $transaction = $txManager->get();
		 *
		 *     $robot = new Robots();
		 *
		 *     $robot->setTransaction($transaction);
		 *
		 *     $robot->name       = "WALL·E";
		 *     $robot->created_at = date("Y-m-d");
		 *
		 *     if ($robot->save() === false) {
		 *         $transaction->rollback("Can't save robot");
		 *     }
		 *
		 *     $robotPart = new RobotParts();
		 *
		 *     $robotPart->setTransaction($transaction);
		 *
		 *     $robotPart->type = "head";
		 *
		 *     if ($robotPart->save() === false) {
		 *         $transaction->rollback("Robot part cannot be saved");
		 *     }
		 *
		 *     $transaction->commit();
		 * } catch (TxFailed $e) {
		 *     echo "Failed, reason: ", $e->getMessage();
		 * }
		 *</code>
		 */
		public function setTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction){ }


		/**
		 * Sets the table name to which model should be mapped
		 */
		protected function setSource($source){ }


		/**
		 * Returns the table name mapped in the model
		 */
		public function getSource(){ }


		/**
		 * Sets schema name where the mapped table is located
		 */
		protected function setSchema($schema){ }


		/**
		 * Returns schema name where the mapped table is located
		 */
		public function getSchema(){ }


		/**
		 * Sets the DependencyInjection connection service name
		 */
		public function setConnectionService($connectionService){ }


		/**
		 * Sets the DependencyInjection connection service name used to read data
		 */
		public function setReadConnectionService($connectionService){ }


		/**
		 * Sets the DependencyInjection connection service name used to write data
		 */
		public function setWriteConnectionService($connectionService){ }


		/**
		 * Returns the DependencyInjection connection service name used to read data related the model
		 */
		public function getReadConnectionService(){ }


		/**
		 * Returns the DependencyInjection connection service name used to write data related to the model
		 */
		public function getWriteConnectionService(){ }


		/**
		 * Sets the dirty state of the object using one of the DIRTY_STATE_* constants
		 */
		public function setDirtyState($dirtyState){ }


		/**
		 * Returns one of the DIRTY_STATE_* constants telling if the record exists in the database or not
		 */
		public function getDirtyState(){ }


		/**
		 * Gets the connection used to read data for the model
		 */
		public function getReadConnection(){ }


		/**
		 * Gets the connection used to write data to the model
		 */
		public function getWriteConnection(){ }


		/**
		 * Assigns values to a model from an array
		 *
		 * <code>
		 * $robot->assign(
		 *     [
		 *         "type" => "mechanical",
		 *         "name" => "Astro Boy",
		 *         "year" => 1952,
		 *     ]
		 * );
		 *
		 * // Assign by db row, column map needed
		 * $robot->assign(
		 *     $dbRow,
		 *     [
		 *         "db_type" => "type",
		 *         "db_name" => "name",
		 *         "db_year" => "year",
		 *     ]
		 * );
		 *
		 * // Allow assign only name and year
		 * $robot->assign(
		 *     $_POST,
		 *     null,
		 *     [
		 *         "name",
		 *         "year",
		 *     ]
		 * );
		 *
		 * // By default assign method will use setters if exist, you can disable it by using ini_set to directly use properties
		 *
		 * ini_set("phalcon.orm.disable_assign_setters", true);
		 *
		 * $robot->assign(
		 *     $_POST,
		 *     null,
		 *     [
		 *         "name",
		 *         "year",
		 *     ]
		 * );
		 * </code>
		 *
		 * @param array data
		 * @param array dataColumnMap array to transform keys of data to another
		 * @param array whiteList
		 * @return \Phalcon\Mvc\Model
		 */
		public function assign($data, $dataColumnMap=null, $whiteList=null){ }


		/**
		 * Assigns values to a model from an array, returning a new model.
		 *
		 *<code>
		 * $robot = \Phalcon\Mvc\Model::cloneResultMap(
		 *     new Robots(),
		 *     [
		 *         "type" => "mechanical",
		 *         "name" => "Astro Boy",
		 *         "year" => 1952,
		 *     ]
		 * );
		 *</code>
		 *
		 * @param \Phalcon\Mvc\ModelInterface|\Phalcon\Mvc\Model\Row base
		 * @param array data
		 * @param array columnMap
		 * @param int dirtyState
		 * @param boolean keepSnapshots
		 */
		public static function cloneResultMap($base, $data, $columnMap, $dirtyState=null, $keepSnapshots=null){ }


		/**
		 * Returns an hydrated result based on the data and the column map
		 *
		 * @param array data
		 * @param array columnMap
		 * @param int hydrationMode
		 * @return mixed
		 */
		public static function cloneResultMapHydrate($data, $columnMap, $hydrationMode){ }


		/**
		 * Assigns values to a model from an array returning a new model
		 *
		 *<code>
		 * $robot = \Phalcon\Mvc\Model::cloneResult(
		 *     new Robots(),
		 *     [
		 *         "type" => "mechanical",
		 *         "name" => "Astro Boy",
		 *         "year" => 1952,
		 *     ]
		 * );
		 *</code>
		 *
		 * @param \Phalcon\Mvc\ModelInterface $base
		 * @param array data
		 * @param int dirtyState
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public static function cloneResult(\Phalcon\Mvc\ModelInterface $base, $data, $dirtyState=null){ }


		/**
		 * Query for a set of records that match the specified conditions
		 *
		 * <code>
		 * // How many robots are there?
		 * $robots = Robots::find();
		 *
		 * echo "There are ", count($robots), "\n";
		 *
		 * // How many mechanical robots are there?
		 * $robots = Robots::find(
		 *     "type = 'mechanical'"
		 * );
		 *
		 * echo "There are ", count($robots), "\n";
		 *
		 * // Get and print virtual robots ordered by name
		 * $robots = Robots::find(
		 *     [
		 *         "type = 'virtual'",
		 *         "order" => "name",
		 *     ]
		 * );
		 *
		 * foreach ($robots as $robot) {
		 *	 echo $robot->name, "\n";
		 * }
		 *
		 * // Get first 100 virtual robots ordered by name
		 * $robots = Robots::find(
		 *     [
		 *         "type = 'virtual'",
		 *         "order" => "name",
		 *         "limit" => 100,
		 *     ]
		 * );
		 *
		 * foreach ($robots as $robot) {
		 *	 echo $robot->name, "\n";
		 * }
		 * </code>
		 */
		public static function find($parameters=null){ }


		/**
		 * Query the first record that matches the specified conditions
		 *
		 * <code>
		 * // What's the first robot in robots table?
		 * $robot = Robots::findFirst();
		 *
		 * echo "The robot name is ", $robot->name;
		 *
		 * // What's the first mechanical robot in robots table?
		 * $robot = Robots::findFirst(
		 *     "type = 'mechanical'"
		 * );
		 *
		 * echo "The first mechanical robot name is ", $robot->name;
		 *
		 * // Get first virtual robot ordered by name
		 * $robot = Robots::findFirst(
		 *     [
		 *         "type = 'virtual'",
		 *         "order" => "name",
		 *     ]
		 * );
		 *
		 * echo "The first virtual robot name is ", $robot->name;
		 * </code>
		 *
		 * @param string|array parameters
		 * @return static
		 */
		public static function findFirst($parameters=null){ }


		/**
		 * Create a criteria for a specific model
		 */
		public static function query(\Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * Checks whether the current record already exists
		 *
		 * @param \Phalcon\Mvc\Model\MetaDataInterface metaData
		 * @param \Phalcon\Db\AdapterInterface connection
		 * @param string|array table
		 * @return boolean
		 */
		protected function _exists(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table=null){ }


		/**
		 * Generate a PHQL SELECT statement for an aggregate
		 *
		 * @param string function
		 * @param string alias
		 * @param array parameters
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		protected static function _groupResult($functionName, $alias, $parameters){ }


		/**
		 * Counts how many records match the specified conditions
		 *
		 * <code>
		 * // How many robots are there?
		 * $number = Robots::count();
		 *
		 * echo "There are ", $number, "\n";
		 *
		 * // How many mechanical robots are there?
		 * $number = Robots::count("type = 'mechanical'");
		 *
		 * echo "There are ", $number, " mechanical robots\n";
		 * </code>
		 *
		 * @param array parameters
		 * @return mixed
		 */
		public static function count($parameters=null){ }


		/**
		 * Calculates the sum on a column for a result-set of rows that match the specified conditions
		 *
		 * <code>
		 * // How much are all robots?
		 * $sum = Robots::sum(
		 *     [
		 *         "column" => "price",
		 *     ]
		 * );
		 *
		 * echo "The total price of robots is ", $sum, "\n";
		 *
		 * // How much are mechanical robots?
		 * $sum = Robots::sum(
		 *     [
		 *         "type = 'mechanical'",
		 *         "column" => "price",
		 *     ]
		 * );
		 *
		 * echo "The total price of mechanical robots is  ", $sum, "\n";
		 * </code>
		 *
		 * @param array parameters
		 * @return mixed
		 */
		public static function sum($parameters=null){ }


		/**
		 * Returns the maximum value of a column for a result-set of rows that match the specified conditions
		 *
		 * <code>
		 * // What is the maximum robot id?
		 * $id = Robots::maximum(
		 *     [
		 *         "column" => "id",
		 *     ]
		 * );
		 *
		 * echo "The maximum robot id is: ", $id, "\n";
		 *
		 * // What is the maximum id of mechanical robots?
		 * $sum = Robots::maximum(
		 *     [
		 *         "type = 'mechanical'",
		 *         "column" => "id",
		 *     ]
		 * );
		 *
		 * echo "The maximum robot id of mechanical robots is ", $id, "\n";
		 * </code>
		 *
		 * @param array parameters
		 * @return mixed
		 */
		public static function maximum($parameters=null){ }


		/**
		 * Returns the minimum value of a column for a result-set of rows that match the specified conditions
		 *
		 * <code>
		 * // What is the minimum robot id?
		 * $id = Robots::minimum(
		 *     [
		 *         "column" => "id",
		 *     ]
		 * );
		 *
		 * echo "The minimum robot id is: ", $id;
		 *
		 * // What is the minimum id of mechanical robots?
		 * $sum = Robots::minimum(
		 *     [
		 *         "type = 'mechanical'",
		 *         "column" => "id",
		 *     ]
		 * );
		 *
		 * echo "The minimum robot id of mechanical robots is ", $id;
		 * </code>
		 *
		 * @param array parameters
		 * @return mixed
		 */
		public static function minimum($parameters=null){ }


		/**
		 * Returns the average value on a column for a result-set of rows matching the specified conditions
		 *
		 * <code>
		 * // What's the average price of robots?
		 * $average = Robots::average(
		 *     [
		 *         "column" => "price",
		 *     ]
		 * );
		 *
		 * echo "The average price is ", $average, "\n";
		 *
		 * // What's the average price of mechanical robots?
		 * $average = Robots::average(
		 *     [
		 *         "type = 'mechanical'",
		 *         "column" => "price",
		 *     ]
		 * );
		 *
		 * echo "The average price of mechanical robots is ", $average, "\n";
		 * </code>
		 *
		 * @param array parameters
		 * @return double
		 */
		public static function average($parameters=null){ }


		/**
		 * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
		 */
		public function fireEvent($eventName){ }


		/**
		 * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
		 * This method stops if one of the callbacks/listeners returns boolean false
		 */
		public function fireEventCancel($eventName){ }


		/**
		 * Cancel the current operation
		 */
		protected function _cancelOperation(){ }


		/**
		 * Appends a customized message on the validation process
		 *
		 * <code>
		 * use \Phalcon\Mvc\Model;
		 * use \Phalcon\Mvc\Model\Message as Message;
		 *
		 * class Robots extends Model
		 * {
		 *     public function beforeSave()
		 *     {
		 *         if ($this->name === "Peter") {
		 *             $message = new Message(
		 *                 "Sorry, but a robot cannot be named Peter"
		 *             );
		 *
		 *             $this->appendMessage($message);
		 *         }
		 *     }
		 * }
		 * </code>
		 */
		public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message){ }


		/**
		 * Executes validators on every validation call
		 *
		 *<code>
		 * use \Phalcon\Mvc\Model;
		 * use \Phalcon\Validation;
		 * use \Phalcon\Validation\Validator\ExclusionIn;
		 *
		 * class Subscriptors extends Model
		 * {
		 *     public function validation()
		 *     {
		 *         $validator = new Validation();
		 *
		 *         $validator->add(
		 *             "status",
		 *             new ExclusionIn(
		 *                 [
		 *                     "domain" => [
		 *                         "A",
		 *                         "I",
		 *                     ],
		 *                 ]
		 *             )
		 *         );
		 *
		 *         return $this->validate($validator);
		 *     }
		 * }
		 *</code>
		 */
		protected function validate(\Phalcon\ValidationInterface $validator){ }


		/**
		 * Check whether validation process has generated any messages
		 *
		 *<code>
		 * use \Phalcon\Mvc\Model;
		 * use \Phalcon\Validation;
		 * use \Phalcon\Validation\Validator\ExclusionIn;
		 *
		 * class Subscriptors extends Model
		 * {
		 *     public function validation()
		 *     {
		 *         $validator = new Validation();
		 *
		 *         $validator->validate(
		 *             "status",
		 *             new ExclusionIn(
		 *                 [
		 *                     "domain" => [
		 *                         "A",
		 *                         "I",
		 *                     ],
		 *                 ]
		 *             )
		 *         );
		 *
		 *         return $this->validate($validator);
		 *     }
		 * }
		 *</code>
		 */
		public function validationHasFailed(){ }


		/**
		 * Returns array of validation messages
		 *
		 *<code>
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
		public function getMessages($filter=null){ }


		/**
		 * Reads "belongs to" relations and check the virtual foreign keys when inserting or updating records
		 * to verify that inserted/updated values are present in the related entity
		 */
		final protected function _checkForeignKeysRestrict(){ }


		/**
		 * Reads both "hasMany" and "hasOne" relations and checks the virtual foreign keys (cascade) when deleting records
		 */
		final protected function _checkForeignKeysReverseCascade(){ }


		/**
		 * Reads both "hasMany" and "hasOne" relations and checks the virtual foreign keys (restrict) when deleting records
		 */
		final protected function _checkForeignKeysReverseRestrict(){ }


		/**
		 * Executes internal hooks before save a record
		 */
		protected function _preSave(\Phalcon\Mvc\Model\MetaDataInterface $metaData, $exists, $identityField){ }


		/**
		 * Executes internal events after save a record
		 */
		protected function _postSave($success, $exists){ }


		/**
		 * Sends a pre-build INSERT SQL statement to the relational database system
		 *
		 * @param \Phalcon\Mvc\Model\MetaDataInterface metaData
		 * @param \Phalcon\Db\AdapterInterface connection
		 * @param string|array table
		 * @param boolean|string identityField
		 * @return boolean
		 */
		protected function _doLowInsert(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table, $identityField){ }


		/**
		 * Sends a pre-build UPDATE SQL statement to the relational database system
		 *
		 * @param \Phalcon\Mvc\Model\MetaDataInterface metaData
		 * @param \Phalcon\Db\AdapterInterface connection
		 * @param string|array table
		 * @return boolean
		 */
		protected function _doLowUpdate(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table){ }


		/**
		 * Saves related records that must be stored prior to save the master record
		 *
		 * @param \Phalcon\Db\AdapterInterface connection
		 * @param \Phalcon\Mvc\ModelInterface[] related
		 * @return boolean
		 */
		protected function _preSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related){ }


		/**
		 * Save the related records assigned in the has-one/has-many relations
		 *
		 * @param  \Phalcon\Db\AdapterInterface connection
		 * @param  \Phalcon\Mvc\ModelInterface[] related
		 * @return boolean
		 */
		protected function _postSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related){ }


		/**
		 * Inserts or updates a model instance. Returning true on success or false otherwise.
		 *
		 *<code>
		 * // Creating a new robot
		 * $robot = new Robots();
		 *
		 * $robot->type = "mechanical";
		 * $robot->name = "Astro Boy";
		 * $robot->year = 1952;
		 *
		 * $robot->save();
		 *
		 * // Updating a robot name
		 * $robot = Robots::findFirst("id = 100");
		 *
		 * $robot->name = "Biomass";
		 *
		 * $robot->save();
		 *</code>
		 *
		 * @param array data
		 * @param array whiteList
		 * @return boolean
		 */
		public function save($data=null, $whiteList=null){ }


		/**
		 * Inserts a model instance. If the instance already exists in the persistence it will throw an exception
		 * Returning true on success or false otherwise.
		 *
		 *<code>
		 * // Creating a new robot
		 * $robot = new Robots();
		 *
		 * $robot->type = "mechanical";
		 * $robot->name = "Astro Boy";
		 * $robot->year = 1952;
		 *
		 * $robot->create();
		 *
		 * // Passing an array to create
		 * $robot = new Robots();
		 *
		 * $robot->create(
		 *     [
		 *         "type" => "mechanical",
		 *         "name" => "Astro Boy",
		 *         "year" => 1952,
		 *     ]
		 * );
		 *</code>
		 */
		public function create($data=null, $whiteList=null){ }


		/**
		 * Updates a model instance. If the instance doesn't exist in the persistence it will throw an exception
		 * Returning true on success or false otherwise.
		 *
		 *<code>
		 * // Updating a robot name
		 * $robot = Robots::findFirst("id = 100");
		 *
		 * $robot->name = "Biomass";
		 *
		 * $robot->update();
		 *</code>
		 */
		public function update($data=null, $whiteList=null){ }


		/**
		 * Deletes a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 * $robot = Robots::findFirst("id=100");
		 *
		 * $robot->delete();
		 *
		 * $robots = Robots::find("type = 'mechanical'");
		 *
		 * foreach ($robots as $robot) {
		 *     $robot->delete();
		 * }
		 * </code>
		 */
		public function delete(){ }


		/**
		 * Returns the type of the latest operation performed by the ORM
		 * Returns one of the OP_* class constants
		 */
		public function getOperationMade(){ }


		/**
		 * Refreshes the model attributes re-querying the record from the database
		 */
		public function refresh(){ }


		/**
		 * Skips the current operation forcing a success state
		 */
		public function skipOperation($skip){ }


		/**
		 * Reads an attribute value by its name
		 *
		 * <code>
		 * echo $robot->readAttribute("name");
		 * </code>
		 */
		public function readAttribute($attribute){ }


		/**
		 * Writes an attribute value by its name
		 *
		 *<code>
		 * $robot->writeAttribute("name", "Rosey");
		 *</code>
		 */
		public function writeAttribute($attribute, $value){ }


		/**
		 * Sets a list of attributes that must be skipped from the
		 * generated INSERT/UPDATE statement
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->skipAttributes(
		 *             [
		 *                 "price",
		 *             ]
		 *         );
		 *     }
		 * }
		 *</code>
		 */
		protected function skipAttributes($attributes){ }


		/**
		 * Sets a list of attributes that must be skipped from the
		 * generated INSERT statement
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->skipAttributesOnCreate(
		 *             [
		 *                 "created_at",
		 *             ]
		 *         );
		 *     }
		 * }
		 *</code>
		 */
		protected function skipAttributesOnCreate($attributes){ }


		/**
		 * Sets a list of attributes that must be skipped from the
		 * generated UPDATE statement
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->skipAttributesOnUpdate(
		 *             [
		 *                 "modified_in",
		 *             ]
		 *         );
		 *     }
		 * }
		 *</code>
		 */
		protected function skipAttributesOnUpdate($attributes){ }


		/**
		 * Sets a list of attributes that must be skipped from the
		 * generated UPDATE statement
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->allowEmptyStringValues(
		 *             [
		 *                 "name",
		 *             ]
		 *         );
		 *     }
		 * }
		 *</code>
		 */
		protected function allowEmptyStringValues($attributes){ }


		/**
		 * Setup a 1-1 relation between two models
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->hasOne("id", "RobotsDescription", "robots_id");
		 *     }
		 * }
		 *</code>
		 */
		protected function hasOne($fields, $referenceModel, $referencedFields, $options=null){ }


		/**
		 * Setup a reverse 1-1 or n-1 relation between two models
		 *
		 *<code>
		 *
		 * class RobotsParts extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->belongsTo("robots_id", "Robots", "id");
		 *     }
		 * }
		 *</code>
		 */
		protected function belongsTo($fields, $referenceModel, $referencedFields, $options=null){ }


		/**
		 * Setup a 1-n relation between two models
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->hasMany("id", "RobotsParts", "robots_id");
		 *     }
		 * }
		 *</code>
		 */
		protected function hasMany($fields, $referenceModel, $referencedFields, $options=null){ }


		/**
		 * Setup an n-n relation between two models, through an intermediate relation
		 *
		 *<code>
		 *
		 * class Robots extends \Phalcon\Mvc\Model
		 * {
		 *     public function initialize()
		 *     {
		 *         // Setup a many-to-many relation to Parts through RobotsParts
		 *         $this->hasManyToMany(
		 *             "id",
		 *             "RobotsParts",
		 *             "robots_id",
		 *             "parts_id",
		 *             "Parts",
		 *             "id",
		 *         );
		 *     }
		 * }
		 *</code>
		 *
		 * @param	string|array fields
		 * @param	string intermediateModel
		 * @param	string|array intermediateFields
		 * @param	string|array intermediateReferencedFields
		 * @param	string referencedModel
		 * @param   string|array referencedFields
		 * @param   array options
		 * @return  \Phalcon\Mvc\Model\Relation
		 */
		protected function hasManyToMany($fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referenceModel, $referencedFields, $options=null){ }


		/**
		 * Setups a behavior in a model
		 *
		 *<code>
		 *
		 * use \Phalcon\Mvc\Model;
		 * use \Phalcon\Mvc\Model\Behavior\Timestampable;
		 *
		 * class Robots extends Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->addBehavior(
		 *             new Timestampable(
		 *                [
		 *                    "onCreate" => [
		 *                         "field"  => "created_at",
		 *                         "format" => "Y-m-d",
		 * 	                   ],
		 *                 ]
		 *             )
		 *         );
		 *     }
		 * }
		 *</code>
		 */
		public function addBehavior(\Phalcon\Mvc\Model\BehaviorInterface $behavior){ }


		/**
		 * Sets if the model must keep the original record snapshot in memory
		 *
		 *<code>
		 *
		 * use \Phalcon\Mvc\Model;
		 *
		 * class Robots extends Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->keepSnapshots(true);
		 *     }
		 * }
		 *</code>
		 */
		protected function keepSnapshots($keepSnapshot){ }


		/**
		 * Sets the record's snapshot data.
		 * This method is used internally to set snapshot data when the model was set up to keep snapshot data
		 *
		 * @param array data
		 * @param array columnMap
		 */
		public function setSnapshotData($data, $columnMap=null){ }


		/**
		 * Checks if the object has internal snapshot data
		 */
		public function hasSnapshotData(){ }


		/**
		 * Returns the internal snapshot data
		 */
		public function getSnapshotData(){ }


		/**
		 * Returns the internal old snapshot data
		 */
		public function getOldSnapshotData(){ }


		/**
		 * Check if a specific attribute has changed
		 * This only works if the model is keeping data snapshots
		 *
		 *<code>
		 * $robot = new Robots();
		 *
		 * $robot->type = "mechanical";
		 * $robot->name = "Astro Boy";
		 * $robot->year = 1952;
		 *
		 * $robot->create();
		 * $robot->type = "hydraulic";
		 * $hasChanged = $robot->hasChanged("type"); // returns true
		 * $hasChanged = $robot->hasChanged(["type", "name"]); // returns true
		 * $hasChanged = $robot->hasChanged(["type", "name", true]); // returns false
		 *</code>
		 *
		 * @param string|array fieldName
		 * @param boolean allFields
		 */
		public function hasChanged($fieldName=null, $allFields=null){ }


		/**
		 * Check if a specific attribute was updated
		 * This only works if the model is keeping data snapshots
		 *
		 * @param string|array fieldName
		 */
		public function hasUpdated($fieldName=null, $allFields=null){ }


		/**
		 * Returns a list of changed values.
		 *
		 * <code>
		 * $robots = Robots::findFirst();
		 * print_r($robots->getChangedFields()); // []
		 *
		 * $robots->deleted = 'Y';
		 *
		 * $robots->getChangedFields();
		 * print_r($robots->getChangedFields()); // ["deleted"]
		 * </code>
		 */
		public function getChangedFields(){ }


		/**
		 * Returns a list of updated values.
		 *
		 * <code>
		 * $robots = Robots::findFirst();
		 * print_r($robots->getChangedFields()); // []
		 *
		 * $robots->deleted = 'Y';
		 *
		 * $robots->getChangedFields();
		 * print_r($robots->getChangedFields()); // ["deleted"]
		 * $robots->save();
		 * print_r($robots->getChangedFields()); // []
		 * print_r($robots->getUpdatedFields()); // ["deleted"]
		 * </code>
		 */
		public function getUpdatedFields(){ }


		/**
		 * Sets if a model must use dynamic update instead of the all-field update
		 *
		 *<code>
		 *
		 * use \Phalcon\Mvc\Model;
		 *
		 * class Robots extends Model
		 * {
		 *     public function initialize()
		 *     {
		 *         $this->useDynamicUpdate(true);
		 *     }
		 * }
		 *</code>
		 */
		protected function useDynamicUpdate($dynamicUpdate){ }


		/**
		 * Returns related records based on defined relations
		 *
		 * @param string alias
		 * @param array arguments
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function getRelated($alias, $arguments=null){ }


		/**
		 * Returns related records defined relations depending on the method name
		 *
		 * @param string modelName
		 * @param string method
		 * @param array arguments
		 * @return mixed
		 */
		protected function _getRelatedRecords($modelName, $method, $arguments){ }


		/**
		 * Try to check if the query must invoke a finder
		 *
		 * @param  string method
		 * @param  array arguments
		 * @return \Phalcon\Mvc\ModelInterface[]|\Phalcon\Mvc\ModelInterface|boolean
		 */
		final protected static function _invokeFinder($method, $arguments){ }


		/**
		 * Handles method calls when a method is not implemented
		 *
		 * @param	string method
		 * @param	array arguments
		 * @return	mixed
		 */
		public function __call($method, $arguments){ }


		/**
		 * Handles method calls when a static method is not implemented
		 *
		 * @param	string method
		 * @param	array arguments
		 * @return	mixed
		 */
		public static function __callStatic($method, $arguments){ }


		/**
		 * Magic method to assign values to the the model
		 *
		 * @param string property
		 * @param mixed value
		 */
		public function __set($property, $value){ }


		/**
		 * Check for, and attempt to use, possible setter.
		 *
		 * @param string property
		 * @param mixed value
		 * @return string
		 */
		final protected function _possibleSetter($property, $value){ }


		/**
		 * Magic method to get related records using the relation alias as a property
		 *
		 * @param string property
		 * @return \Phalcon\Mvc\Model\Resultset|Phalcon\Mvc\Model
		 */
		public function __get($property){ }


		/**
		 * Magic method to check if a property is a valid relation
		 */
		public function __isset($property){ }


		/**
		 * Serializes the object ignoring connections, services, related objects or static properties
		 */
		public function serialize(){ }


		/**
		 * Unserializes the object from a serialized string
		 */
		public function unserialize($data){ }


		/**
		 * Returns a simple representation of the object that can be used with var_dump
		 *
		 *<code>
		 * var_dump(
		 *     $robot->dump()
		 * );
		 *</code>
		 */
		public function dump(){ }


		/**
		 * Returns the instance as an array representation
		 *
		 *<code>
		 * print_r(
		 *     $robot->toArray()
		 * );
		 *</code>
		 *
		 * @param array $columns
		 * @return array
		 */
		public function toArray($columns=null){ }


		/**
		 * Serializes the object for json_encode
		 *
		 *<code>
		 * echo json_encode($robot);
		 *</code>
		 *
		 * @return array
		 */
		public function jsonSerialize(){ }


		/**
		 * Enables/disables options in the ORM
		 */
		public static function setup($options){ }


		/**
		 * Reset a model instance data
		 */
		public function reset(){ }

	}
}
