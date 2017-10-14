<?php 

namespace Phalcon\Mvc\Model {

	interface ManagerInterface {

		public function initialize(\Phalcon\Mvc\ModelInterface $model);


		public function setModelSource(\Phalcon\Mvc\ModelInterface $model, $source);


		public function getModelSource(\Phalcon\Mvc\ModelInterface $model);


		public function setModelSchema(\Phalcon\Mvc\ModelInterface $model, $schema);


		public function getModelSchema(\Phalcon\Mvc\ModelInterface $model);


		public function setConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);


		public function setReadConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);


		public function getReadConnectionService(\Phalcon\Mvc\ModelInterface $model);


		public function setWriteConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);


		public function getWriteConnectionService(\Phalcon\Mvc\ModelInterface $model);


		public function getReadConnection(\Phalcon\Mvc\ModelInterface $model);


		public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model);


		public function isInitialized($modelName);


		public function getLastInitialized();


		public function load($modelName, $newInstance=null);


		public function addHasOne(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null);


		public function addBelongsTo(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null);


		public function addHasMany(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null);


		public function existsBelongsTo($modelName, $modelRelation);


		public function existsHasMany($modelName, $modelRelation);


		public function existsHasOne($modelName, $modelRelation);


		public function getBelongsToRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null);


		public function getHasManyRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null);


		public function getHasOneRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters=null);


		public function getBelongsTo(\Phalcon\Mvc\ModelInterface $model);


		public function getHasMany(\Phalcon\Mvc\ModelInterface $model);


		public function getHasOne(\Phalcon\Mvc\ModelInterface $model);


		public function getHasOneAndHasMany(\Phalcon\Mvc\ModelInterface $model);


		public function getRelations($modelName);


		public function getRelationsBetween($first, $second);


		public function createQuery($phql);


		public function executeQuery($phql, $placeholders=null);


		public function createBuilder($params=null);


		public function addBehavior(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior);


		public function notifyEvent($eventName, \Phalcon\Mvc\ModelInterface $model);


		public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $eventName, $data);


		public function getLastQuery();


		public function getRelationByAlias($modelName, $alias);

	}
}
