<?php

namespace {

    /**
     * @param mixed $_ [optional]
     * @return array
     */
    function PS_UNRESERVE_PREFIX_array(...$_){};

    /**
     * @param mixed $var1
     * @param mixed $_ [optional]
     * @return array
     */
    function PS_UNRESERVE_PREFIX_list($var1, ...$_){};

    /**
     * @param int|string $status [optional]
     * @return void
     */
    function PS_UNRESERVE_PREFIX_die($status = ""){};

    /**
     * @param int|string $status [optional]
     * @return void
     */
    function PS_UNRESERVE_PREFIX_exit($status = ""){};

    /**
     * @param mixed $var
     * @return bool
     */
    function PS_UNRESERVE_PREFIX_empty($var){};

    /**
     * @param mixed $var
     * @param mixed $_ [optional]
     * @return bool
     */
    function PS_UNRESERVE_PREFIX_isset($var, ...$_){};

    /**
     * @param mixed $var
     * @param mixed $_ [optional]
     * @return void
     */
    function PS_UNRESERVE_PREFIX_unset($var, ...$_){};

    /**
     * @param string $code
     * @return mixed
     */
    function PS_UNRESERVE_PREFIX_eval($code){};

    /**
     * Generator objects are returned from generators, cannot be instantiated via new.
     * @link http://www.php.net/manual/en/class.generator.php
     * @link https://wiki.php.net/rfc/generators
     */
    final class Generator implements Iterator {
        /**
         * Throws an exception if the generator is currently after the first yield.
         * @return void
         */
        function rewind() {}
        /**
         * Returns false if the generator has been closed, true otherwise.
         * @return bool
         */
        function valid() {}
        /**
         * Returns whatever was passed to yield or null if nothing was passed or the generator is already closed.
         * @return mixed
         */
        function current() {}
        /**
         * Returns the yielded key or, if none was specified, an auto-incrementing key or null if the generator is already closed.
         * @return mixed
         */
        function key() {}
        /**
         * Resumes the generator (unless the generator is already closed).
         * @return void
         */
        function next() {}

        /**
         * Sets the return value of the yield expression and resumes the generator (unless the generator is already closed).
         * @param mixed $value
         * @return mixed
         */
        function send($value) {}

        /**
         * Throws an exception at the current suspension point in the generator.
         * @param Exception $exception
         * @return mixed
         */
        function PS_UNRESERVE_PREFIX_throw(Exception $exception) {}

        /**
         * Returns whatever was passed to return or null if nothing.
         * Throws an exception if the generator is still valid.
         * @link https://wiki.php.net/rfc/generator-return-expressions
         * @return mixed|null
         */
        function getReturn() {}
    }

}

namespace ___PHPSTORM_HELPERS {

class PS_UNRESERVE_PREFIX_this {}
class PS_UNRESERVE_PREFIX_static {}
class object {
  /**
   * PHP 5 allows developers to declare constructor methods for classes.
   * Classes which have a constructor method call this method on each newly-created object,
   * so it is suitable for any initialization that the object may need before it is used.
   *
   * Note: Parent constructors are not called implicitly if the child class defines a constructor.
   * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
   *
   * param [ mixed $args [, $... ]]
   * @return void
   * @link http://php.net/manual/en/language.oop5.decon.php
   */
  function __construct() {}

  /**
   * PHP 5 introduces a destructor concept similar to that of other object-oriented languages, such as C++.
   * The destructor method will be called as soon as all references to a particular object are removed or
   * when the object is explicitly destroyed or in any order in shutdown sequence.
   *
   * Like constructors, parent destructors will not be called implicitly by the engine.
   * In order to run a parent destructor, one would have to explicitly call parent::__destruct() in the destructor body.
   *
   * Note: Destructors called during the script shutdown have HTTP headers already sent.
   * The working directory in the script shutdown phase can be different with some SAPIs (e.g. Apache).
   *
   * Note: Attempting to throw an exception from a destructor (called in the time of script termination) causes a fatal error.
   *
   * @return void
   * @link http://php.net/manual/en/language.oop5.decon.php
   */
  function __destruct() {}

  /**
   * is triggered when invoking inaccessible methods in an object context.
   *
   * @param $name string
   * @param $arguments array
   * @return mixed
   * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
   */
  function __call($name, $arguments) {}

  /**
   * is triggered when invoking inaccessible methods in a static context.
   *
   * @param $name string
   * @param $arguments array
   * @return mixed
   * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
   */
  public static function __callStatic($name, $arguments) {}

  /**
   * is utilized for reading data from inaccessible members.
   *
   * @param $name string
   * @return mixed
   * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
   */
  function __get($name) {}

  /**
   * run when writing data to inaccessible members.
   *
   * @param $name string
   * @param $value mixed
   * @return void
   * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
   */
  function __set($name, $value) {}

  /**
   * is triggered by calling isset() or empty() on inaccessible members.
   *
   * @param $name string
   * @return bool
   * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
   */
  function __isset($name) {}
  /**
   * is invoked when unset() is used on inaccessible members.
   *
   * @param $name string
   * @return void
   * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
   */
  function __unset($name) {}

  /**
   * serialize() checks if your class has a function with the magic name __sleep.
   * If so, that function is executed prior to any serialization.
   * It can clean up the object and is supposed to return an array with the names of all variables of that object that should be serialized.
   * If the method doesn't return anything then NULL is serialized and E_NOTICE is issued.
   * The intended use of __sleep is to commit pending data or perform similar cleanup tasks.
   * Also, the function is useful if you have very large objects which do not need to be saved completely.
   *
   * @return array|NULL
   * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.sleep
   */
  function __sleep() {}

  /**
   * unserialize() checks for the presence of a function with the magic name __wakeup.
   * If present, this function can reconstruct any resources that the object may have.
   * The intended use of __wakeup is to reestablish any database connections that may have been lost during
   * serialization and perform other reinitialization tasks.
   *
   * @return void
   * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.sleep
   */
  function __wakeup() {}

  /**
   * The __toString method allows a class to decide how it will react when it is converted to a string.
   *
   * @return string
   * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
   */
  function __toString() {}

  /**
   * The __invoke method is called when a script tries to call an object as a function.
   *
   * @return mixed
   * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
   */
  function __invoke() {}

    /**
     * This method is called by var_dump() when dumping an object to get the properties that should be shown.
     * If the method isn't defined on an object, then all public, protected and private properties will be shown.
     * @since PHP 5.6.0
     *
     * @return array
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo
     */
    function __debugInfo(){}

  /**
   * This static method is called for classes exported by var_export() since PHP 5.1.0.
   * The only parameter of this method is an array containing exported properties in the form array('property' => value, ...).
   * @since 5.1.0
   *
   * @param $an_array array
   * @return mixed
   * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.set-state
   */
  static function __set_state($an_array) {}

  /**
   * When an object is cloned, PHP 5 will perform a shallow copy of all of the object's properties.
   * Any properties that are references to other variables, will remain references.
   * Once the cloning is complete, if a __clone() method is defined,
   * then the newly created object's __clone() method will be called, to allow any necessary properties that need to be changed.
   * NOT CALLABLE DIRECTLY.
   *
   * @return mixed
   * @link http://php.net/manual/en/language.oop5.cloning.php
   */
  function __clone() {}

}

}
