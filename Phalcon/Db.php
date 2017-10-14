<?php 

namespace Phalcon {

	/**
	 * Phalcon\Db
	 *
	 * Phalcon\Db and its related classes provide a simple SQL database interface for Phalcon Framework.
	 * The Phalcon\Db is the basic class you use to connect your PHP application to an RDBMS.
	 * There is a different adapter class for each brand of RDBMS.
	 *
	 * This component is intended to lower level database operations. If you want to interact with databases using
	 * higher level of abstraction use Phalcon\Mvc\Model.
	 *
	 * Phalcon\Db is an abstract class. You only can use it with a database adapter like Phalcon\Db\Adapter\Pdo
	 *
	 *<code>
	 * use Phalcon\Db;
	 * use Phalcon\Db\Exception;
	 * use Phalcon\Db\Adapter\Pdo\Mysql as MysqlConnection;
	 *
	 * try {
	 *     $connection = new MysqlConnection(
	 *         [
	 *             "host"     => "192.168.0.11",
	 *             "username" => "sigma",
	 *             "password" => "secret",
	 *             "dbname"   => "blog",
	 *             "port"     => "3306",
	 *         ]
	 *     );
	 *
	 *     $result = $connection->query(
	 *         "SELECT * FROM robots LIMIT 5"
	 *     );
	 *
	 *     $result->setFetchMode(Db::FETCH_NUM);
	 *
	 *     while ($robot = $result->fetch()) {
	 *         print_r($robot);
	 *     }
	 * } catch (Exception $e) {
	 *     echo $e->getMessage(), PHP_EOL;
	 * }
	 * </code>
	 */
	
	abstract class Db {

		const FETCH_LAZY = 1;

		const FETCH_ASSOC = 2;

		const FETCH_NAMED = 11;

		const FETCH_NUM = 3;

		const FETCH_BOTH = 4;

		const FETCH_OBJ = 5;

		const FETCH_BOUND = 6;

		const FETCH_COLUMN = 7;

		const FETCH_CLASS = 8;

		const FETCH_INTO = 9;

		const FETCH_FUNC = 10;

		const FETCH_GROUP = 65536;

		const FETCH_UNIQUE = 196608;

		const FETCH_KEY_PAIR = 12;

		const FETCH_CLASSTYPE = 262144;

		const FETCH_SERIALIZE = 524288;

		const FETCH_PROPS_LATE = 1048576;

		/**
		 * Enables/disables options in the Database component
		 */
		public static function setup($options){ }

	}
}
