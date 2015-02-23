<?php

// Start of Reflection v.$Revision: 307971 $

/**
 * The ReflectionException class.
 * @link http://php.net/manual/en/class.reflectionexception.php
 */
class ReflectionException extends Exception  {

}

/**
 * The reflection class.
 * @link http://php.net/manual/en/class.reflection.php
 */
class Reflection  {

	/**
	 * (PHP 5)<br/>
	 * Gets modifier names
	 * @link http://php.net/manual/en/reflection.getmodifiernames.php
	 * @param int $modifiers <p>
	 * The modifiers to get, which is from a numeric value.
	 * </p>
	 * @return array An array of modifier names.
	 */
	public static function getModifierNames ($modifiers) {}

	/**
	 * (PHP 5)<br/>
	 * Exports
	 * @link http://php.net/manual/en/reflection.export.php
	 * @param Reflector $reflector <p>
	 * The reflection to export.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string If the <i>return</i> parameter
	 * is set to <b>TRUE</b>, then the export is returned as a string,
	 * otherwise <b>NULL</b> is returned.
	 */
	public static function export (Reflector $reflector, $return = false) {}

}

/**
 * <b>Reflector</b> is an interface implemented by all
 * exportable Reflection classes.
 * @link http://php.net/manual/en/class.reflector.php
 */
interface Reflector  {

	/**
	 * (PHP 5)<br/>
	 * Exports
	 * @link http://php.net/manual/en/reflector.export.php
	 * @return string
	 */
	static function export ();

	/**
	 * (PHP 5)<br/>
	 * To string
	 * @link http://php.net/manual/en/reflector.tostring.php
	 * @return string 
	 */
	function __toString ();

}

/**
 * A parent class to <b>ReflectionFunction</b>, read its
 * description for details.
 * @link http://php.net/manual/en/class.reflectionfunctionabstract.php
 */
abstract class ReflectionFunctionAbstract implements Reflector {
	public $name;


	/**
	 * (PHP 5)<br/>
	 * Clones function
	 * @link http://php.net/manual/en/reflectionfunctionabstract.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP 5)<br/>
	 * To string
	 * @link http://php.net/manual/en/reflectionfunctionabstract.tostring.php
	 * @return string.
	 */
	abstract public function __toString ();

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Checks if function in namespace
	 * @link http://php.net/manual/en/reflectionfunctionabstract.innamespace.php
	 * @return bool <b>TRUE</b> if it's in a namespace, otherwise <b>FALSE</b>
	 */
	public function inNamespace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Checks if closure
	 * @link http://php.net/manual/en/reflectionfunctionabstract.isclosure.php
	 * @return bool <b>TRUE</b> if it's a closure, otherwise <b>FALSE</b>
	 */
	public function isClosure () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if deprecated
	 * @link http://php.net/manual/en/reflectionfunctionabstract.isdeprecated.php
	 * @return bool <b>TRUE</b> if it's deprecated, otherwise <b>FALSE</b>
	 */
	public function isDeprecated () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if is internal
	 * @link http://php.net/manual/en/reflectionfunctionabstract.isinternal.php
	 * @return bool <b>TRUE</b> if it's internal, otherwise <b>FALSE</b>
	 */
	public function isInternal () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if user defined
	 * @link http://php.net/manual/en/reflectionfunctionabstract.isuserdefined.php
	 * @return bool <b>TRUE</b> if it's user-defined, otherwise false;
	 */
	public function isUserDefined () {}

	/**
	 * (PHP 5)<br/>
	 * Returns this pointer bound to closure
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getclosurethis.php
	 * @return object $this pointer.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function getClosureThis () {}

	public function getClosureScopeClass () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets doc comment
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getdoccomment.php
	 * @return string The doc comment if it exists, otherwise <b>FALSE</b>
	 */
	public function getDocComment () {}

	/**
	 * (PHP 5)<br/>
	 * Gets end line number
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getendline.php
	 * @return int The ending line number of the user defined function, or <b>FALSE</b> if unknown.
	 */
	public function getEndLine () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension info
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getextension.php
	 * @return ReflectionExtension The extension information, as a <b>ReflectionExtension</b> object.
	 */
	public function getExtension () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension name
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getextensionname.php
	 * @return string The extensions name.
	 */
	public function getExtensionName () {}

	/**
	 * (PHP 5)<br/>
	 * Gets file name
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getfilename.php
	 * @return string The file name.
	 */
	public function getFileName () {}

	/**
	 * (PHP 5)<br/>
	 * Gets function name
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getname.php
	 * @return string The name of the function.
	 */
	public function getName () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Gets namespace name
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getnamespacename.php
	 * @return string The namespace name.
	 */
	public function getNamespaceName () {}

	/**
	 * (PHP 5 &gt;= 5.0.3)<br/>
	 * Gets number of parameters
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getnumberofparameters.php
	 * @return int The number of parameters.
	 */
	public function getNumberOfParameters () {}

	/**
	 * (PHP 5 &gt;= 5.0.3)<br/>
	 * Gets number of required parameters
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getnumberofrequiredparameters.php
	 * @return int The number of required parameters.
	 */
	public function getNumberOfRequiredParameters () {}

	/**
	 * (PHP 5)<br/>
	 * Gets parameters
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getparameters.php
	 * @return ReflectionParameter[] The parameters, as a ReflectionParameter objects.
	 */
	public function getParameters () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Gets function short name
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getshortname.php
	 * @return string The short name of the function.
	 */
	public function getShortName () {}

	/**
	 * (PHP 5)<br/>
	 * Gets starting line number
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getstartline.php
	 * @return int The starting line number.
	 */
	public function getStartLine () {}

	/**
	 * (PHP 5)<br/>
	 * Gets static variables
	 * @link http://php.net/manual/en/reflectionfunctionabstract.getstaticvariables.php
	 * @return array An array of static variables.
	 */
	public function getStaticVariables () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if returns reference
	 * @link http://php.net/manual/en/reflectionfunctionabstract.returnsreference.php
	 * @return bool <b>TRUE</b> if it returns a reference, otherwise <b>FALSE</b>
	 */
	public function returnsReference () {}

}

/**
 * The <b>ReflectionFunction</b> class reports
 * information about a function.
 * @link http://php.net/manual/en/class.reflectionfunction.php
 */
class ReflectionFunction extends ReflectionFunctionAbstract implements Reflector {
	const IS_DEPRECATED = 262144;

	public $name;


	/**
	 * (PHP 5)<br/>
	 * Constructs a ReflectionFunction object
	 * @link http://php.net/manual/en/reflectionfunction.construct.php
	 * @param mixed $name <p>
	 * The name of the function to reflect or a closure.
	 * </p>
	 */
	public function __construct ($name) {}

	/**
	 * (PHP 5)<br/>
	 * To string
	 * @link http://php.net/manual/en/reflectionfunction.tostring.php
	 * @return string <b>ReflectionFunction::export</b>-like output for
	 * the function.
	 */
	public function __toString () {}

	/**
	 * (PHP 5)<br/>
	 * Exports function
	 * @link http://php.net/manual/en/reflectionfunction.export.php
	 * @param string $name <p>
	 * The reflection to export.
	 * </p>
	 * @param string $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string If the <i>return</i> parameter
	 * is set to <b>TRUE</b>, then the export is returned as a string,
	 * otherwise <b>NULL</b> is returned.
	 */
	public static function export ($name, $return = null) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if function is disabled
	 * @link http://php.net/manual/en/reflectionfunction.isdisabled.php
	 * @return bool <b>TRUE</b> if it's disable, otherwise <b>FALSE</b>
	 */
	public function isDisabled () {}

	/**
	 * (PHP 5)<br/>
	 * Invokes function
	 * @link http://php.net/manual/en/reflectionfunction.invoke.php
	 * @param string $args [optional] <p>
	 * The passed in argument list. It accepts a variable number of
	 * arguments which are passed to the function much like
	 * call_user_func is.
	 * </p>
	 * @return mixed 
	 */
	public function invoke ($args = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Invokes function args
	 * @link http://php.net/manual/en/reflectionfunction.invokeargs.php
	 * @param array $args <p>
	 * The passed arguments to the function as an array, much like
	 * <b>call_user_func_array</b> works.
	 * </p>
	 * @return mixed the result of the invoked function
	 */
	public function invokeArgs (array $args) {}

	/**
	 * (PHP 5)<br/>
	 * Returns a dynamically created closure for the function
	 * @link http://php.net/manual/en/reflectionfunction.getclosure.php
	 * @return Closure <b>Closure</b>.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function getClosure () {}

}

/**
 * The <b>ReflectionParameter</b> class retrieves
 * information about function's or method's parameters.
 * @link http://php.net/manual/en/class.reflectionparameter.php
 */
class ReflectionParameter implements Reflector {
	public $name;


	/**
	 * (PHP 5)<br/>
	 * Clone
	 * @link http://php.net/manual/en/reflectionparameter.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP 5)<br/>
	 * Exports
	 * @link http://php.net/manual/en/reflectionparameter.export.php
	 * @param string $function <p>
	 * The function name.
	 * </p>
	 * @param string $parameter <p>
	 * The parameter name.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string The exported reflection.
	 */
	public static function export ($function, $parameter, $return = null) {}

	/**
	 * (PHP 5)<br/>
	 * Construct
	 * @link http://php.net/manual/en/reflectionparameter.construct.php
	 * @param string $function <p>
	 * The function to reflect parameters from.
	 * </p>
	 * @param string $parameter <p>
	 * The parameter.
	 * </p>
	 */
	public function __construct ($function, $parameter) {}

	/**
	 * (PHP 5)<br/>
	 * To string
	 * @link http://php.net/manual/en/reflectionparameter.tostring.php
	 * @return string
	 */
	public function __toString () {}

	/**
	 * (PHP 5)<br/>
	 * Gets parameter name
	 * @link http://php.net/manual/en/reflectionparameter.getname.php
	 * @return string The name of the reflected parameter.
	 */
	public function getName () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if passed by reference
	 * @link http://php.net/manual/en/reflectionparameter.ispassedbyreference.php
	 * @return bool <b>TRUE</b> if the parameter is passed in by reference, otherwise <b>FALSE</b>
	 */
	public function isPassedByReference () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns whether this parameter can be passed by value
	 * @link http://php.net/manual/en/reflectionparameter.canbepassedbyvalue.php
	 * @return bool <b>TRUE</b> if the parameter can be passed by value, <b>FALSE</b> otherwise.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function canBePassedByValue () {}

	/**
	 * (PHP 5 &gt;= 5.2.3)<br/>
	 * Gets declaring function
	 * @link http://php.net/manual/en/reflectionparameter.getdeclaringfunction.php
	 * @return ReflectionFunctionAbstract A <b>ReflectionFunctionAbstract</b> object.
	 */
	public function getDeclaringFunction () {}

	/**
	 * (PHP 5)<br/>
	 * Gets declaring class
	 * @link http://php.net/manual/en/reflectionparameter.getdeclaringclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object.
	 */
	public function getDeclaringClass () {}

	/**
	 * (PHP 5)<br/>
	 * Get class
	 * @link http://php.net/manual/en/reflectionparameter.getclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object.
	 */
	public function getClass () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Checks if parameter expects an array
	 * @link http://php.net/manual/en/reflectionparameter.isarray.php
	 * @return bool <b>TRUE</b> if an array is expected, <b>FALSE</b> otherwise.
	 */
	public function isArray () {}

    /**
     * (PHP 5 &gt;= 5.4.0)<>br/
     * Returns whether parameter MUST be callable
     * @link http://php.net/manual/en/reflectionparameter.iscallable.php
     * @return bool Returns TRUE if the parameter is callable, FALSE if it is not or NULL on failure.
     */
    public function isCallable () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if null is allowed
	 * @link http://php.net/manual/en/reflectionparameter.allowsnull.php
	 * @return bool <b>TRUE</b> if <b>NULL</b> is allowed, otherwise <b>FALSE</b>
	 */
	public function allowsNull () {}

	/**
	 * (PHP 5 &gt;= 5.2.3)<br/>
	 * Gets parameter position
	 * @link http://php.net/manual/en/reflectionparameter.getposition.php
	 * @return int The position of the parameter, left to right, starting at position #0.
	 */
	public function getPosition () {}

	/**
	 * (PHP 5 &gt;= 5.0.3)<br/>
	 * Checks if optional
	 * @link http://php.net/manual/en/reflectionparameter.isoptional.php
	 * @return bool <b>TRUE</b> if the parameter is optional, otherwise <b>FALSE</b>
	 */
	public function isOptional () {}

	/**
	 * (PHP 5 &gt;= 5.0.3)<br/>
	 * Checks if a default value is available
	 * @link http://php.net/manual/en/reflectionparameter.isdefaultvalueavailable.php
	 * @return bool <b>TRUE</b> if a default value is available, otherwise <b>FALSE</b>
	 */
	public function isDefaultValueAvailable () {}

	/**
	 * (PHP 5 &gt;= 5.0.3)<br/>
	 * Gets default parameter value
	 * @link http://php.net/manual/en/reflectionparameter.getdefaultvalue.php
	 * @return mixed The parameters default value.
	 */
	public function getDefaultValue () {}

    /**
     * @return boolean
     */
    public function isDefaultValueConstant () {}

    /**
     * @return string
     */
	public function getDefaultValueConstantName () {}

}

/**
 * The <b>ReflectionMethod</b> class reports
 * information about a method.
 * @link http://php.net/manual/en/class.reflectionmethod.php
 */
class ReflectionMethod extends ReflectionFunctionAbstract implements Reflector {
	const IS_STATIC = 1;
	const IS_PUBLIC = 256;
	const IS_PROTECTED = 512;
	const IS_PRIVATE = 1024;
	const IS_ABSTRACT = 2;
	const IS_FINAL = 4;

	public $name;
	public $class;


	/**
	 * (PHP 5)<br/>
	 * Export a reflection method.
	 * @link http://php.net/manual/en/reflectionmethod.export.php
	 * @param string $class <p>
	 * The class name.
	 * </p>
	 * @param string $name <p>
	 * The name of the method.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string If the <i>return</i> parameter
	 * is set to <b>TRUE</b>, then the export is returned as a string,
	 * otherwise <b>NULL</b> is returned.
	 */
	public static function export ($class, $name, $return = false) {}

	/**
	 * (PHP 5)<br/>
	 * Constructs a ReflectionMethod
	 * @link http://php.net/manual/en/reflectionmethod.construct.php
	 * @param mixed $class <p>
	 * Classname or object (instance of the class) that contains the method.
	 * </p>
	 * @param string $name <p>
	 * Name of the method.
	 * </p>
	 */
	public function __construct ($class, $name) {}

	/**
	 * (PHP 5)<br/>
	 * Returns the string representation of the Reflection method object.
	 * @link http://php.net/manual/en/reflectionmethod.tostring.php
	 * @return string A string representation of this <b>ReflectionMethod</b> instance.
	 */
	public function __toString () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is public
	 * @link http://php.net/manual/en/reflectionmethod.ispublic.php
	 * @return bool <b>TRUE</b> if the method is public, otherwise <b>FALSE</b>
	 */
	public function isPublic () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is private
	 * @link http://php.net/manual/en/reflectionmethod.isprivate.php
	 * @return bool <b>TRUE</b> if the method is private, otherwise <b>FALSE</b>
	 */
	public function isPrivate () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is protected
	 * @link http://php.net/manual/en/reflectionmethod.isprotected.php
	 * @return bool <b>TRUE</b> if the method is protected, otherwise <b>FALSE</b>
	 */
	public function isProtected () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is abstract
	 * @link http://php.net/manual/en/reflectionmethod.isabstract.php
	 * @return bool <b>TRUE</b> if the method is abstract, otherwise <b>FALSE</b>
	 */
	public function isAbstract () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is final
	 * @link http://php.net/manual/en/reflectionmethod.isfinal.php
	 * @return bool <b>TRUE</b> if the method is final, otherwise <b>FALSE</b>
	 */
	public function isFinal () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is static
	 * @link http://php.net/manual/en/reflectionmethod.isstatic.php
	 * @return bool <b>TRUE</b> if the method is static, otherwise <b>FALSE</b>
	 */
	public function isStatic () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is a constructor
	 * @link http://php.net/manual/en/reflectionmethod.isconstructor.php
	 * @return bool <b>TRUE</b> if the method is a constructor, otherwise <b>FALSE</b>
	 */
	public function isConstructor () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if method is a destructor
	 * @link http://php.net/manual/en/reflectionmethod.isdestructor.php
	 * @return bool <b>TRUE</b> if the method is a destructor, otherwise <b>FALSE</b>
	 */
	public function isDestructor () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns a dynamically created closure for the method
	 * @link http://php.net/manual/en/reflectionmethod.getclosure.php
	 * @param object $object [optional] Forbidden for static methods, required for other methods.
	 * @return Closure <b>Closure</b>.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function getClosure ($object) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the method modifiers
	 * @link http://php.net/manual/en/reflectionmethod.getmodifiers.php
	 * @return int A numeric representation of the modifiers. The modifiers are listed below.
	 * The actual meanings of these modifiers are described in the
	 * predefined constants.
	 * <table>
	 * ReflectionMethod modifiers
	 * <tr valign="top">
	 * <td>value</td>
	 * <td>constant</td>
	 * </tr>
	 * <tr valign="top">
	 * <td>1</td>
	 * <td>
	 * ReflectionMethod::IS_STATIC
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>2</td>
	 * <td>
	 * ReflectionMethod::IS_ABSTRACT
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>4</td>
	 * <td>
	 * ReflectionMethod::IS_FINAL
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>256</td>
	 * <td>
	 * ReflectionMethod::IS_PUBLIC
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>512</td>
	 * <td>
	 * ReflectionMethod::IS_PROTECTED
	 * </td>
	 * </tr>
	 * <tr valign="top">
	 * <td>1024</td>
	 * <td>
	 * ReflectionMethod::IS_PRIVATE
	 * </td>
	 * </tr>
	 * </table>
	 */
	public function getModifiers () {}

	/**
	 * (PHP 5)<br/>
	 * Invoke
	 * @link http://php.net/manual/en/reflectionmethod.invoke.php
	 * @param object $object <p>
	 * The object to invoke the method on. For static methods, pass
	 * null to this parameter.
	 * </p>
	 * @param mixed $parameter [optional] <p>
	 * Zero or more parameters to be passed to the method.
	 * It accepts a variable number of parameters which are passed to the method.
	 * </p>
	 * @param mixed $_ [optional]
	 * @return mixed the method result.
	 */
	public function invoke ($object, $parameter = null, $_ = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Invoke args
	 * @link http://php.net/manual/en/reflectionmethod.invokeargs.php
	 * @param object $object <p>
	 * The object to invoke the method on. In case of static methods, you can pass
	 * null to this parameter.
	 * </p>
	 * @param array $args <p>
	 * The parameters to be passed to the function, as an array.
	 * </p>
	 * @return mixed the method result.
	 */
	public function invokeArgs ($object, array $args) {}

	/**
	 * (PHP 5)<br/>
	 * Gets declaring class for the reflected method.
	 * @link http://php.net/manual/en/reflectionmethod.getdeclaringclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object of the class that the
	 * reflected method is part of.
	 */
	public function getDeclaringClass () {}

	/**
	 * (PHP 5)<br/>
	 * Gets the method prototype (if there is one).
	 * @link http://php.net/manual/en/reflectionmethod.getprototype.php
	 * @return ReflectionMethod A <b>ReflectionMethod</b> instance of the method prototype.
	 */
	public function getPrototype () {}

	/**
	 * (PHP 5 &gt;= 5.3.2)<br/>
	 * Set method accessibility
	 * @link http://php.net/manual/en/reflectionmethod.setaccessible.php
	 * @param bool $accessible <p>
	 * <b>TRUE</b> to allow accessibility, or <b>FALSE</b>.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setAccessible ($accessible) {}

}

/**
 * The <b>ReflectionClass</b> class reports
 * information about a class.
 * @link http://php.net/manual/en/class.reflectionclass.php
 */
class ReflectionClass implements Reflector {
	const IS_IMPLICIT_ABSTRACT = 16;
	const IS_EXPLICIT_ABSTRACT = 32;
	const IS_FINAL = 64;

	public $name;


	/**
	 * (PHP 5)<br/>
	 * Clones object
	 * @link http://php.net/manual/en/reflectionclass.clone.php
	 * @return void 
	 */
	final private function __clone () {}

	/**
	 * (PHP 5)<br/>
	 * Exports a class
	 * @link http://php.net/manual/en/reflectionclass.export.php
	 * @param mixed $argument <p>
	 * The reflection to export.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string If the <i>return</i> parameter
	 * is set to <b>TRUE</b>, then the export is returned as a string,
	 * otherwise <b>NULL</b> is returned.
	 */
	public static function export ($argument, $return = false) {}

	/**
	 * (PHP 5)<br/>
	 * Constructs a ReflectionClass
	 * @link http://php.net/manual/en/reflectionclass.construct.php
	 * @param mixed $argument <p>
	 * Either a string containing the name of the class to
	 * reflect, or an object.
	 * </p>
	 */
	public function __construct ($argument) {}

	/**
	 * (PHP 5)<br/>
	 * Returns the string representation of the ReflectionClass object.
	 * @link http://php.net/manual/en/reflectionclass.tostring.php
	 * @return string A string representation of this <b>ReflectionClass</b> instance.
	 */
	public function __toString () {}

	/**
	 * (PHP 5)<br/>
	 * Gets class name
	 * @link http://php.net/manual/en/reflectionclass.getname.php
	 * @return string The class name.
	 */
	public function getName () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if class is defined internally by an extension, or the core
	 * @link http://php.net/manual/en/reflectionclass.isinternal.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isInternal () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if user defined
	 * @link http://php.net/manual/en/reflectionclass.isuserdefined.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isUserDefined () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the class is instantiable
	 * @link http://php.net/manual/en/reflectionclass.isinstantiable.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isInstantiable () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns whether this class is cloneable
	 * @link http://php.net/manual/en/reflectionclass.iscloneable.php
	 * @return bool <b>TRUE</b> if the class is cloneable, <b>FALSE</b> otherwise.
	 */
	public function isCloneable () {}

	/**
	 * (PHP 5)<br/>
	 * Gets the filename of the file in which the class has been defined
	 * @link http://php.net/manual/en/reflectionclass.getfilename.php
	 * @return string the filename of the file in which the class has been defined.
	 * If the class is defined in the PHP core or in a PHP extension, <b>FALSE</b>
	 * is returned.
	 */
	public function getFileName () {}

	/**
	 * (PHP 5)<br/>
	 * Gets starting line number
	 * @link http://php.net/manual/en/reflectionclass.getstartline.php
	 * @return int The starting line number, as an integer.
	 */
	public function getStartLine () {}

	/**
	 * (PHP 5)<br/>
	 * Gets end line
	 * @link http://php.net/manual/en/reflectionclass.getendline.php
	 * @return int The ending line number of the user defined class, or <b>FALSE</b> if unknown.
	 */
	public function getEndLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets doc comments
	 * @link http://php.net/manual/en/reflectionclass.getdoccomment.php
	 * @return string The doc comment if it exists, otherwise <b>FALSE</b>
	 */
	public function getDocComment () {}

	/**
	 * (PHP 5)<br/>
	 * Gets the constructor of the class
	 * @link http://php.net/manual/en/reflectionclass.getconstructor.php
	 * @return ReflectionMethod A <b>ReflectionMethod</b> object reflecting the class' constructor, or <b>NULL</b> if the class
	 * has no constructor.
	 */
	public function getConstructor () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Checks if method is defined
	 * @link http://php.net/manual/en/reflectionclass.hasmethod.php
	 * @param string $name <p>
	 * Name of the method being checked for.
	 * </p>
	 * @return bool <b>TRUE</b> if it has the method, otherwise <b>FALSE</b>
	 */
	public function hasMethod ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Gets a <b>ReflectionMethod</b> for a class method.
	 * @link http://php.net/manual/en/reflectionclass.getmethod.php
	 * @param string $name <p>
	 * The method name to reflect.
	 * </p>
	 * @return ReflectionMethod A <b>ReflectionMethod</b>.
	 */
	public function getMethod ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Gets an array of methods
	 * @link http://php.net/manual/en/reflectionclass.getmethods.php
	 * @param string $filter [optional] <p>
	 * Filter the results to include only methods with certain attributes. Defaults
	 * to no filtering.
	 * </p>
	 * <p>
	 * Any combination of <b>ReflectionMethod::IS_STATIC</b>,
	 * <b>ReflectionMethod::IS_PUBLIC</b>,
	 * <b>ReflectionMethod::IS_PROTECTED</b>,
	 * <b>ReflectionMethod::IS_PRIVATE</b>,
	 * <b>ReflectionMethod::IS_ABSTRACT</b>,
	 * <b>ReflectionMethod::IS_FINAL</b>.
	 * </p>
         * @return ReflectionMethod[] An array of methods.
	 */
	public function getMethods ($filter = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Checks if property is defined
	 * @link http://php.net/manual/en/reflectionclass.hasproperty.php
	 * @param string $name <p>
	 * Name of the property being checked for.
	 * </p>
	 * @return bool <b>TRUE</b> if it has the property, otherwise <b>FALSE</b>
	 */
	public function hasProperty ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Gets a <b>ReflectionProperty</b> for a class's property
	 * @link http://php.net/manual/en/reflectionclass.getproperty.php
	 * @param string $name <p>
	 * The property name.
	 * </p>
	 * @return ReflectionProperty A <b>ReflectionProperty</b>.
	 */
	public function getProperty ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Gets properties
	 * @link http://php.net/manual/en/reflectionclass.getproperties.php
	 * @param int $filter [optional] <p>
	 * The optional filter, for filtering desired property types. It's configured using
	 * the ReflectionProperty constants,
	 * and defaults to all property types.
	 * </p>
	 * @return ReflectionProperty[]
	 */
	public function getProperties ($filter = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Checks if constant is defined
	 * @link http://php.net/manual/en/reflectionclass.hasconstant.php
	 * @param string $name <p>
	 * The name of the constant being checked for.
	 * </p>
	 * @return bool <b>TRUE</b> if the constant is defined, otherwise <b>FALSE</b>.
	 */
	public function hasConstant ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Gets constants
	 * @link http://php.net/manual/en/reflectionclass.getconstants.php
	 * @return array An array of constants.
	 * Constant name in key, constant value in value.
	 */
	public function getConstants () {}

	/**
	 * (PHP 5)<br/>
	 * Gets defined constant
	 * @link http://php.net/manual/en/reflectionclass.getconstant.php
	 * @param string $name <p>
	 * Name of the constant.
	 * </p>
	 * @return mixed Value of the constant.
	 */
	public function getConstant ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the interfaces
	 * @link http://php.net/manual/en/reflectionclass.getinterfaces.php
         * @return ReflectionClass[] An associative array of interfaces, with keys as interface
	 * names and the array values as <b>ReflectionClass</b> objects.
	 */
	public function getInterfaces () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Gets the interface names
	 * @link http://php.net/manual/en/reflectionclass.getinterfacenames.php
	 * @return array A numerical array with interface names as the values.
	 */
	public function getInterfaceNames () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the class is an interface
	 * @link http://php.net/manual/en/reflectionclass.isinterface.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isInterface () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns an array of traits used by this class
	 * @link http://php.net/manual/en/reflectionclass.gettraits.php
	 * @return ReflectionClass[] an array with trait names in keys and instances of trait's
	 * <b>ReflectionClass</b> in values.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function getTraits () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns an array of names of traits used by this class
	 * @link http://php.net/manual/en/reflectionclass.gettraitnames.php
	 * @return array an array with trait names in values.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function getTraitNames () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns an array of trait aliases
	 * @link http://php.net/manual/en/reflectionclass.gettraitaliases.php
	 * @return array an array with new method names in keys and original names (in the
	 * format "TraitName::original") in values.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function getTraitAliases () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns whether this is a trait
	 * @link http://php.net/manual/en/reflectionclass.istrait.php
	 * @return bool <b>TRUE</b> if this is a trait, <b>FALSE</b> otherwise.
	 * Returns <b>NULL</b> in case of an error.
	 */
	public function isTrait () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if class is abstract
	 * @link http://php.net/manual/en/reflectionclass.isabstract.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isAbstract () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if class is final
	 * @link http://php.net/manual/en/reflectionclass.isfinal.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isFinal () {}

	/**
	 * (PHP 5)<br/>
	 * Gets modifiers
	 * @link http://php.net/manual/en/reflectionclass.getmodifiers.php
	 * @return int bitmask of
	 * modifier constants.
	 */
	public function getModifiers () {}

	/**
	 * (PHP 5)<br/>
	 * Checks class for instance
	 * @link http://php.net/manual/en/reflectionclass.isinstance.php
	 * @param object $object <p>
	 * The object being compared to.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isInstance ($object) {}

	/**
	 * (PHP 5)<br/>
	 * Creates a new class instance from given arguments.
	 * @link http://php.net/manual/en/reflectionclass.newinstance.php
	 * @param mixed $args [optional]<p>
	 * Accepts a variable number of arguments which are passed to the class
	 * constructor, much like <b>call_user_func</b>.
	 * </p>
	 * @param mixed $_ [optional]
	 * @return object
	 */
	public function newInstance ($args = null, $_ = null) {}
	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Creates a new class instance without invoking the constructor.
	 * @link http://php.net/manual/en/reflectionclass.newinstancewithoutconstructor.php
	 * @return object
	 */
	public function newInstanceWithoutConstructor() {}

	/**
	 * (PHP 5 &gt;= 5.1.3)<br/>
	 * Creates a new class instance from given arguments.
	 * @link http://php.net/manual/en/reflectionclass.newinstanceargs.php
	 * @param array $args [optional] <p>
	 * The parameters to be passed to the class constructor as an array.
	 * </p>
	 * @return object a new instance of the class.
	 */
	public function newInstanceArgs (array $args = null) {}

	/**
	 * (PHP 5)<br/>
	 * Gets parent class
	 * @link http://php.net/manual/en/reflectionclass.getparentclass.php
	 * @return ReflectionClass
	 */
	public function getParentClass () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if a subclass
	 * @link http://php.net/manual/en/reflectionclass.issubclassof.php
	 * @param string $class <p>
	 * The class name being checked against.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSubclassOf ($class) {}

	/**
	 * (PHP 5)<br/>
	 * Gets static properties
	 * @link http://php.net/manual/en/reflectionclass.getstaticproperties.php
	 * @return array The static properties, as an array.
	 */
	public function getStaticProperties () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets static property value
	 * @link http://php.net/manual/en/reflectionclass.getstaticpropertyvalue.php
	 * @param string $name <p>
	 * The name of the static property for which to return a value.
	 * </p>
	 * @param string $default [optional] <p>
	 * </p>
	 * @return mixed The value of the static property.
	 */
	public function getStaticPropertyValue ($name, $default = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Sets static property value
	 * @link http://php.net/manual/en/reflectionclass.setstaticpropertyvalue.php
	 * @param string $name <p>
	 * Property name.
	 * </p>
	 * @param string $value <p>
	 * New property value.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setStaticPropertyValue ($name, $value) {}

	/**
	 * (PHP 5)<br/>
	 * Gets default properties
	 * @link http://php.net/manual/en/reflectionclass.getdefaultproperties.php
	 * @return array An array of default properties, with the key being the name of
	 * the property and the value being the default value of the property or <b>NULL</b>
	 * if the property doesn't have a default value. The function does not distinguish
	 * between static and non static properties and does not take visibility modifiers
	 * into account.
	 */
	public function getDefaultProperties () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if iterateable
	 * @link http://php.net/manual/en/reflectionclass.isiterateable.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isIterateable () {}

	/**
	 * (PHP 5)<br/>
	 * Implements interface
	 * @link http://php.net/manual/en/reflectionclass.implementsinterface.php
	 * @param string $interface <p>
	 * The interface name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function implementsInterface ($interface) {}

	/**
	 * (PHP 5)<br/>
	 * Gets a <b>ReflectionExtension</b> object for the extension which defined the class
	 * @link http://php.net/manual/en/reflectionclass.getextension.php
	 * @return ReflectionExtension A <b>ReflectionExtension</b> object representing the extension which defined the class,
	 * or <b>NULL</b> for user-defined classes.
	 */
	public function getExtension () {}

	/**
	 * (PHP 5)<br/>
	 * Gets the name of the extension which defined the class
	 * @link http://php.net/manual/en/reflectionclass.getextensionname.php
	 * @return string The name of the extension which defined the class, or <b>FALSE</b> for user-defined classes.
	 */
	public function getExtensionName () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Checks if in namespace
	 * @link http://php.net/manual/en/reflectionclass.innamespace.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function inNamespace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Gets namespace name
	 * @link http://php.net/manual/en/reflectionclass.getnamespacename.php
	 * @return string The namespace name.
	 */
	public function getNamespaceName () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Gets short name
	 * @link http://php.net/manual/en/reflectionclass.getshortname.php
	 * @return string The class short name.
	 */
	public function getShortName () {}

}

/**
 * The <b>ReflectionObject</b> class reports
 * information about an object.
 * @link http://php.net/manual/en/class.reflectionobject.php
 */
class ReflectionObject extends ReflectionClass implements Reflector {

	/**
	 * (PHP 5)<br/>
	 * Export
	 * @link http://php.net/manual/en/reflectionobject.export.php
	 * @param string $argument <p>
	 * The reflection to export.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string If the <i>return</i> parameter
	 * is set to <b>TRUE</b>, then the export is returned as a string,
	 * otherwise <b>NULL</b> is returned.
	 */
	public static function export ($argument, $return = null) {}

	/**
	 * (PHP 5)<br/>
	 * Constructs a ReflectionObject
	 * @link http://php.net/manual/en/reflectionobject.construct.php
	 * @param object $argument <p>
	 * An object instance.
	 * </p>
	 */
	public function __construct ($argument) {}

}

/**
 * The <b>ReflectionProperty</b> class reports
 * information about a classes properties.
 * @link http://php.net/manual/en/class.reflectionproperty.php
 */
class ReflectionProperty implements Reflector {
	const IS_STATIC = 1;
	const IS_PUBLIC = 256;
	const IS_PROTECTED = 512;
	const IS_PRIVATE = 1024;

	public $name;
	public $class;


	/**
	 * (PHP 5)<br/>
	 * Clone
	 * @link http://php.net/manual/en/reflectionproperty.clone.php
	 * @return void 
	 */
	final private function __clone () {}

	/**
	 * (PHP 5)<br/>
	 * Export
	 * @link http://php.net/manual/en/reflectionproperty.export.php
	 * @param mixed $class 
	 * @param string $name <p>
	 * The property name.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string
	 */
	public static function export ($class, $name, $return = null) {}

	/**
	 * (PHP 5)<br/>
	 * Construct a ReflectionProperty object
	 * @link http://php.net/manual/en/reflectionproperty.construct.php
	 * @param mixed $class <p>
	 * The class name, that contains the property.
	 * </p>
	 * @param string $name <p>
	 * The name of the property being reflected.
	 * </p>
	 */
	public function __construct ($class, $name) {}

	/**
	 * (PHP 5)<br/>
	 * To string
	 * @link http://php.net/manual/en/reflectionproperty.tostring.php
	 * @return string
	 */
	public function __toString () {}

	/**
	 * (PHP 5)<br/>
	 * Gets property name
	 * @link http://php.net/manual/en/reflectionproperty.getname.php
	 * @return string The name of the reflected property.
	 */
	public function getName () {}

	/**
	 * (PHP 5)<br/>
	 * Gets value
	 * @link http://php.net/manual/en/reflectionproperty.getvalue.php
	 * @param object $object [optional]<p>
	 * If the property is non-static an object must be provided to fetch the
	 * property from. If you want to fetch the default property without
	 * providing an object use <b>ReflectionClass::getDefaultProperties</b>
	 * instead.
	 * </p>
	 * @return mixed The current value of the property.
	 */
	public function getValue ($object) {}

	/**
	 * (PHP 5)<br/>
	 * Set property value
	 * @link http://php.net/manual/en/reflectionproperty.setvalue.php
	 * @param object $object [optional]<p>
	 * If the property is non-static an object must be provided to change
	 * the property on. If the property is static this parameter is left
	 * out and only <i>value</i> needs to be provided.
	 * </p>
	 * @param mixed $value <p>
	 * The new value.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setValue ($object, $value) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if property is public
	 * @link http://php.net/manual/en/reflectionproperty.ispublic.php
	 * @return bool <b>TRUE</b> if the property is public, <b>FALSE</b> otherwise.
	 */
	public function isPublic () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if property is private
	 * @link http://php.net/manual/en/reflectionproperty.isprivate.php
	 * @return bool <b>TRUE</b> if the property is private, <b>FALSE</b> otherwise.
	 */
	public function isPrivate () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if property is protected
	 * @link http://php.net/manual/en/reflectionproperty.isprotected.php
	 * @return bool <b>TRUE</b> if the property is protected, <b>FALSE</b> otherwise.
	 */
	public function isProtected () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if property is static
	 * @link http://php.net/manual/en/reflectionproperty.isstatic.php
	 * @return bool <b>TRUE</b> if the property is static, <b>FALSE</b> otherwise.
	 */
	public function isStatic () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if default value
	 * @link http://php.net/manual/en/reflectionproperty.isdefault.php
	 * @return bool <b>TRUE</b> if the property was declared at compile-time, or <b>FALSE</b> if
	 * it was created at run-time.
	 */
	public function isDefault () {}

	/**
	 * (PHP 5)<br/>
	 * Gets modifiers
	 * @link http://php.net/manual/en/reflectionproperty.getmodifiers.php
	 * @return int A numeric representation of the modifiers.
	 */
	public function getModifiers () {}

	/**
	 * (PHP 5)<br/>
	 * Gets declaring class
	 * @link http://php.net/manual/en/reflectionproperty.getdeclaringclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object.
	 */
	public function getDeclaringClass () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets doc comment
	 * @link http://php.net/manual/en/reflectionproperty.getdoccomment.php
	 * @return string The doc comment.
	 */
	public function getDocComment () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Set property accessibility
	 * @link http://php.net/manual/en/reflectionproperty.setaccessible.php
	 * @param bool $accessible <p>
	 * <b>TRUE</b> to allow accessibility, or <b>FALSE</b>.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setAccessible ($accessible) {}

}

/**
 * The <b>ReflectionExtension</b> class reports
 * information about an extension.
 * @link http://php.net/manual/en/class.reflectionextension.php
 */
class ReflectionExtension implements Reflector {
	public $name;


	/**
	 * (PHP 5)<br/>
	 * Clones
	 * @link http://php.net/manual/en/reflectionextension.clone.php
	 * @return void No value is returned, if called a fatal error will occur.
	 */
	final private function __clone () {}

	/**
	 * (PHP 5)<br/>
	 * Export
	 * @link http://php.net/manual/en/reflectionextension.export.php
	 * @param string $name <p>
	 * The reflection to export.
	 * </p>
	 * @param string $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string If the <i>return</i> parameter
	 * is set to <b>TRUE</b>, then the export is returned as a string,
	 * otherwise <b>NULL</b> is returned.
	 */
	public static function export ($name, $return = false) {}

	/**
	 * (PHP 5)<br/>
	 * Constructs a ReflectionExtension
	 * @link http://php.net/manual/en/reflectionextension.construct.php
	 * @param string $name <p>
	 * Name of the extension.
	 * </p>
	 */
	public function __construct ($name) {}

	/**
	 * (PHP 5)<br/>
	 * To string
	 * @link http://php.net/manual/en/reflectionextension.tostring.php
	 * @return string the exported extension as a string, in the same way as the
	 * <b>ReflectionExtension::export</b>.
	 */
	public function __toString () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension name
	 * @link http://php.net/manual/en/reflectionextension.getname.php
	 * @return string The extensions name.
	 */
	public function getName () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension version
	 * @link http://php.net/manual/en/reflectionextension.getversion.php
	 * @return string The version of the extension.
	 */
	public function getVersion () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension functions
	 * @link http://php.net/manual/en/reflectionextension.getfunctions.php
         * @return ReflectionFunction[] An associative array of <b>ReflectionFunction</b> objects,
	 * for each function defined in the extension with the keys being the function
	 * names. If no function are defined, an empty array is returned.
	 */
	public function getFunctions () {}

	/**
	 * (PHP 5)<br/>
	 * Gets constants
	 * @link http://php.net/manual/en/reflectionextension.getconstants.php
	 * @return array An associative array with constant names as keys.
	 */
	public function getConstants () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension ini entries
	 * @link http://php.net/manual/en/reflectionextension.getinientries.php
	 * @return array An associative array with the ini entries as keys,
	 * with their defined values as values.
	 */
	public function getINIEntries () {}

	/**
	 * (PHP 5)<br/>
	 * Gets classes
	 * @link http://php.net/manual/en/reflectionextension.getclasses.php
         * @return ReflectionClass[] An array of <b>ReflectionClass</b> objects, one
	 * for each class within the extension. If no classes are defined,
	 * an empty array is returned.
	 */
	public function getClasses () {}

	/**
	 * (PHP 5)<br/>
	 * Gets class names
	 * @link http://php.net/manual/en/reflectionextension.getclassnames.php
	 * @return array An array of class names, as defined in the extension.
	 * If no classes are defined, an empty array is returned.
	 */
	public function getClassNames () {}

	/**
	 * (PHP 5)<br/>
	 * Gets dependencies
	 * @link http://php.net/manual/en/reflectionextension.getdependencies.php
	 * @return array An associative array with dependencies as keys and
	 * either Required, Optional
	 * or Conflicts as the values.
	 */
	public function getDependencies () {}

	/**
	 * (PHP 5)<br/>
	 * Gets extension info
	 * @link http://php.net/manual/en/reflectionextension.info.php
	 * @return string Information about the extension.
	 */
	public function info () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns whether this extension is persistent
	 * @link http://php.net/manual/en/reflectionextension.ispersistent.php
	 * @return bool <b>TRUE</b> for extensions loaded by extension, <b>FALSE</b>
	 * otherwise.
	 */
	public function isPersistent () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Returns whether this extension is temporary
	 * @link http://php.net/manual/en/reflectionextension.istemporary.php
	 * @return bool <b>TRUE</b> for extensions loaded by <b>dl</b>,
	 * <b>FALSE</b> otherwise.
	 */
	public function isTemporary () {}


}

/**
 * @since 5.4.0
 * @link http://www.php.net/manual/en/class.reflectionzendextension.php
 */
class ReflectionZendExtension implements Reflector {
	public $name;


	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Clone handler
	 * @link http://php.net/manual/en/reflectionzendextension.clone.php
	 * @return void
	 */
	final private function __clone () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Export
	 * @link http://php.net/manual/en/reflectionzendextension.export.php
	 * @param string $name <p>
	 * </p>
	 * @param string $return [optional] <p>
	 * </p>
	 * @return string
	 */
	public static function export ($name, $return = null) {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Constructor
	 * @link http://php.net/manual/en/reflectionzendextension.construct.php
	 * @param string $name <p>
	 * </p>
	 */
	public function __construct ($name) {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * To string handler
	 * @link http://php.net/manual/en/reflectionzendextension.tostring.php
	 * @return string
	 */
	public function __toString () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Gets name
	 * @link http://php.net/manual/en/reflectionzendextension.getname.php
	 * @return string
	 */
	public function getName () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Gets version
	 * @link http://php.net/manual/en/reflectionzendextension.getversion.php
	 * @return string
	 */
	public function getVersion () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Gets author
	 * @link http://php.net/manual/en/reflectionzendextension.getauthor.php
	 * @return string
	 */
	public function getAuthor () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Gets URL
	 * @link http://php.net/manual/en/reflectionzendextension.geturl.php
	 * @return string
	 */
	public function getURL () {}

	/**
	 * (PHP &gt;= 5.4.0)<br/>
	 * Gets copyright
	 * @link http://php.net/manual/en/reflectionzendextension.getcopyright.php
	 * @return string
	 */
	public function getCopyright () {}

}
// End of Reflection v.$Id: bcdcdaeea3aba34a8083bb62c6eda69ff3c3eab5 $
?>
