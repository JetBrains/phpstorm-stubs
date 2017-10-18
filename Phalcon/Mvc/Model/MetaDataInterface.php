<?php 

namespace Phalcon\Mvc\Model {

	interface MetaDataInterface {

		public function setStrategy(\Phalcon\Mvc\Model\MetaData\StrategyInterface $strategy);


		public function getStrategy();


		public function readMetaData(\Phalcon\Mvc\ModelInterface $model);


		public function readMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index);


		public function writeMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index, $data);


		public function readColumnMap(\Phalcon\Mvc\ModelInterface $model);


		public function readColumnMapIndex(\Phalcon\Mvc\ModelInterface $model, $index);


		public function getAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function getPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function getNonPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function getNotNullAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function getDataTypes(\Phalcon\Mvc\ModelInterface $model);


		public function getDataTypesNumeric(\Phalcon\Mvc\ModelInterface $model);


		public function getIdentityField(\Phalcon\Mvc\ModelInterface $model);


		public function getBindTypes(\Phalcon\Mvc\ModelInterface $model);


		public function getAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function getAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function setAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model, $attributes);


		public function setAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model, $attributes);


		public function setEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model, $attributes);


		public function getEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model);


		public function getDefaultValues(\Phalcon\Mvc\ModelInterface $model);


		public function getColumnMap(\Phalcon\Mvc\ModelInterface $model);


		public function getReverseColumnMap(\Phalcon\Mvc\ModelInterface $model);


		public function hasAttribute(\Phalcon\Mvc\ModelInterface $model, $attribute);


		public function isEmpty();


		public function reset();


		public function read($key);


		public function write($key, $data);

	}
}
