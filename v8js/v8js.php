<?php

class V8Js
{
    /* Constants */

    public const V8_VERSION = '';
    public const FLAG_NONE = 1;
    public const FLAG_FORCE_ARRAY = 2;
    public const FLAG_PROPAGATE_PHP_EXCEPTIONS = 4;

    /* Methods */

    /**
     * Initializes and starts V8 engine and returns new V8Js object with it's own V8 context.
     * Snapshots are supported by V8 4.3.7 and higher.
     * @param string $object_name The name of the object passed to Javascript.
     * @param array $variables Map of PHP variables that will be available in Javascript. Must be an
     * associative array in format array("name-for-js" => "name-of-php-variable"). Defaults to empty
     * array.
     * @param array $extensions List of extensions registered using V8Js::registerExtension which
     * should be available in the Javascript context of the created V8Js object. Extensions
     * registered to be enabled automatically do not need to be listed in this array. Also if an
     * extension has dependencies, those dependencies can be omitted as well. Defaults to empty
     * array.
     * @param bool $report_uncaught_exceptions Controls whether uncaught Javascript exceptions are
     * reported immediately or not. Defaults to true. If set to false the uncaught exception can be
     * accessed using V8Js::getPendingException.
     * @param string $snapshot_blob
     */
    public function __construct($object_name = "PHP", array $variables = [], array $extensions = [], $report_uncaught_exceptions = true, $snapshot_blob = null) {}

    /**
     * Provide a function or method to be used to load required modules. This can be any valid PHP callable.
     * The loader function will receive the normalised module path and should return Javascript code to be executed.
     * @param callable $loader
     */
    public function setModuleLoader(callable $loader) {}

    /**
     * Provide a function or method to be used to normalise module paths. This can be any valid PHP callable.
     * This can be used in combination with setModuleLoader to influence normalisation of the module path (which
     * is normally done by V8Js itself but can be overriden this way).
     * The normaliser function will receive the base path of the current module (if any; otherwise an empty string)
     * and the literate string provided to the require method and should return an array of two strings (the new
     * module base path as well as the normalised name).  Both are joined by a '/' and then passed on to the
     * module loader (unless the module was cached before).
     * @param callable $normaliser
     */
    public function setModuleNormaliser(callable $normaliser) {}

    /**
     * Compiles and executes script in object's context with optional identifier string.
     * A time limit (milliseconds) and/or memory limit (bytes) can be provided to restrict execution. These options will throw a V8JsTimeLimitException or V8JsMemoryLimitException.
     * @param string $script The code string to be executed.
     * @param string $identifier Identifier string for the executed code. Used for debugging.
     * @param int $flags Execution flags. This value must be one of the V8Js::FLAG_* constants,
     * defaulting to V8Js::FLAG_NONE. V8Js::FLAG_NONE: no flags V8Js::FLAG_FORCE_ARRAY: forces all
     * Javascript objects passed to PHP to be associative arrays
     * @param int $time_limit in milliseconds
     * @param int $memory_limit in bytes
     * @return mixed Returns the last variable instantiated in the Javascript code converted to
     * matching PHP variable type.
     */
    public function executeString($script, $identifier = '', $flags = V8Js::FLAG_NONE, $time_limit = 0, $memory_limit = 0) {}

    /**
     * Compiles a script in object's context with optional identifier string.
     * @param $script
     * @param string $identifier
     * @return resource
     */
    public function compileString($script, $identifier = '') {}

    /**
     * Executes a precompiled script in object's context.
     * A time limit (milliseconds) and/or memory limit (bytes) can be provided to restrict execution. These options will throw a V8JsTimeLimitException or V8JsMemoryLimitException.
     * @param resource $script
     * @param int $flags
     * @param int $time_limit
     * @param int $memory_limit
     */
    public function executeScript($script, $flags = V8Js::FLAG_NONE, $time_limit = 0, $memory_limit = 0) {}

    /**
     * Set the time limit (in milliseconds) for this V8Js object
     * works similar to the set_time_limit php
     * @param int $limit
     */
    public function setTimeLimit($limit) {}

    /**
     * Set the memory limit (in bytes) for this V8Js object
     * @param int $limit
     */
    public function setMemoryLimit($limit) {}

    /**
     * Set the average object size (in bytes) for this V8Js object.
     * V8's "amount of external memory" is adjusted by this value for every exported object.  V8 triggers a garbage collection once this totals to 192 MB.
     * @param int $average_object_size
     */
    public function setAverageObjectSize($average_object_size) {}

    /**
     * Returns uncaught pending exception or null if there is no pending exception.
     * @return V8JsScriptException|null Either V8JsException or null.
     */
    public function getPendingException() {}

    /**
     * Clears the uncaught pending exception
     */
    public function clearPendingException() {}

    /* Static methods */

    /**
     * Registers persistent context independent global Javascript extension.
     * NOTE! These extensions exist until PHP is shutdown and they need to be registered before V8 is initialized.
     * For best performance V8 is initialized only once per process thus this call has to be done before any V8Js objects are created!
     * @param string $extension_name Name of the extension to be registered.
     * @param string $code
     * @param array $dependencies Array of extension names the extension to be registered depends
     * on. Any such extension is enabled automatically when this extension is loaded. All
     * extensions, including the dependencies, must be registered before any V8Js are created which
     * use them.
     * @param bool $auto_enable If set to true, the extension will be enabled automatically in all
     * V8Js contexts.
     * @return bool Returns true if extension was registered successfully, false otherwise.
     */
    public static function registerExtension($extension_name, $code, array $dependencies = [], $auto_enable = false) {}

    /**
     * Returns extensions successfully registered with V8Js::registerExtension().
     * @return string[] Returns an array of registered extensions or an empty array if there are
     * none.
     */
    public static function getExtensions() {}

    /**
     * Creates a custom V8 heap snapshot with the provided JavaScript source embedded.
     * Snapshots are supported by V8 4.3.7 and higher.  For older versions of V8 this
     * extension doesn't provide this method.
     * @param string $embed_source
     * @return string|false
     */
    public static function createSnapshot($embed_source) {}
}

final class V8JsScriptException extends Exception
{
    /**
     * @return string
     */
    final public function getJsFileName() {}

    /**
     * @return int
     */
    final public function getJsLineNumber() {}

    /**
     * @return int
     */
    final public function getJsStartColumn() {}

    /**
     * @return int
     */
    final public function getJsEndColumn() {}

    /**
     * @return string
     */
    final public function getJsSourceLine() {}

    /**
     * @return string
     */
    final public function getJsTrace() {}
}

final class V8JsTimeLimitException extends Exception {}

final class V8JsMemoryLimitException extends Exception {}
