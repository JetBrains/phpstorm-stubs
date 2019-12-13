<?php

// Start of Reflection v.$Revision: 307971 $

/**
 * The ReflectionException class.
 * @link https://php.net/manual/en/class.reflectionexception.php
 */
class ReflectionException extends Exception  {

}

/**
 * The reflection class.
 * @link https://php.net/manual/en/class.reflection.php
 */
class Reflection  {

	/**
	 * Gets modifier names
	 * @link https://php.net/manual/en/reflection.getmodifiernames.php
	 * @param int $modifiers <p>
	 * The modifiers to get, which is from a numeric value.
	 * </p>
	 * @return array An array of modifier names.
	 * @since 5.0
	 */
	public static function getModifierNames ($modifiers) {}

	/**
	 * Exports
	 * @link https://php.net/manual/en/reflection.export.php
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
	 * @since 5.0
	 */
	public static function export (Reflector $reflector, $return = false) {}

}

/**
 * <b>Reflector</b> is an interface implemented by all
 * exportable Reflection classes.
 * @link https://php.net/manual/en/class.reflector.php
 */
interface Reflector  {

	/**
	 * Exports
	 * @link https://php.net/manual/en/reflector.export.php
	 * @return string
	 * @since 5.0
	 * @deprecated 7.4
	 */
	static function export ();

	/**
	 * To string
	 * @link https://php.net/manual/en/reflector.tostring.php
	 * @return string 
	 * @since 5.0
	 */
	function __toString ();

}

/**
 * A parent class to <b>ReflectionFunction</b>, read its
 * description for details.
 * @link https://php.net/manual/en/class.reflectionfunctionabstract.php
 */
abstract class ReflectionFunctionAbstract implements Reflector {
	public $name;


	/**
	 * Clones function
	 * @link https://php.net/manual/en/reflectionfunctionabstract.clone.php
	 * @return void
	 * @since 5.0
	 */
	final private function __clone () {}

	/**
	 * To string
	 * @link https://php.net/manual/en/reflectionfunctionabstract.tostring.php
	 * @since 5.0
	 */
	abstract public function __toString ();

	/**
	 * Checks if function in namespace
	 * @link https://php.net/manual/en/reflectionfunctionabstract.innamespace.php
	 * @return bool <b>TRUE</b> if it's in a namespace, otherwise <b>FALSE</b>
	 * @since 5.3
	 */
	public function inNamespace () {}

	/**
	 * Checks if closure
	 * @link https://php.net/manual/en/reflectionfunctionabstract.isclosure.php
	 * @return bool <b>TRUE</b> if it's a closure, otherwise <b>FALSE</b>
	 * @since 5.3
	 */
	public function isClosure () {}

	/**
	 * Checks if deprecated
	 * @link https://php.net/manual/en/reflectionfunctionabstract.isdeprecated.php
	 * @return bool <b>TRUE</b> if it's deprecated, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isDeprecated () {}

	/**
	 * Checks if is internal
	 * @link https://php.net/manual/en/reflectionfunctionabstract.isinternal.php
	 * @return bool <b>TRUE</b> if it's internal, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isInternal () {}

	/**
	 * Checks if user defined
	 * @link https://php.net/manual/en/reflectionfunctionabstract.isuserdefined.php
	 * @return bool <b>TRUE</b> if it's user-defined, otherwise false;
	 * @since 5.0
	 */
	public function isUserDefined () {}

	/**
	 * Returns this pointer bound to closure
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getclosurethis.php
	 * @return object $this pointer.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.0
	 */
	public function getClosureThis () {}

	/**
	 * Returns the scope associated to the closure
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getclosurescopeclass.php
	 * @return ReflectionClass Returns the class on success.
	 * Returns <b>NULL</b> on failure.
	 * @since 5.4
	 */
	public function getClosureScopeClass () {}

	/**
	 * Gets doc comment
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getdoccomment.php
	 * @return string|false The doc comment if it exists, otherwise <b>FALSE</b>
	 * @since 5.1
	 */
	public function getDocComment () {}

	/**
	 * Gets end line number
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getendline.php
	 * @return int|false The ending line number of the user defined function, or <b>FALSE</b> if unknown.
	 * @since 5.0
	 */
	public function getEndLine () {}

	/**
	 * Gets extension info
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getextension.php
	 * @return ReflectionExtension The extension information, as a <b>ReflectionExtension</b> object.
	 * @since 5.0
	 */
	public function getExtension () {}

	/**
	 * Gets extension name
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getextensionname.php
	 * @return string The extensions name.
	 * @since 5.0
	 */
	public function getExtensionName () {}

	/**
	 * Gets file name
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getfilename.php
	 * @return string The file name.
	 * @since 5.0
	 */
	public function getFileName () {}

	/**
	 * Gets function name
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getname.php
	 * @return string The name of the function.
	 * @since 5.0
	 */
	public function getName () {}

	/**
	 * Gets namespace name
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getnamespacename.php
	 * @return string The namespace name.
	 * @since 5.3
	 */
	public function getNamespaceName () {}

	/**
	 * Gets number of parameters
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getnumberofparameters.php
	 * @return int The number of parameters.
	 * @since 5.0.3
	 */
	public function getNumberOfParameters () {}

	/**
	 * Gets number of required parameters
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getnumberofrequiredparameters.php
	 * @return int The number of required parameters.
	 * @since 5.0.3
	 */
	public function getNumberOfRequiredParameters () {}

	/**
	 * Gets parameters
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getparameters.php
	 * @return ReflectionParameter[] The parameters, as a ReflectionParameter objects.
	 * @since 5.0
	 */
	public function getParameters () {}

	/**
	 * Gets the specified return type of a function
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getreturntype.php
	 * @return ReflectionType|null Returns a ReflectionType object if a return type is specified, NULL otherwise.
	 * @since 7.0
	 */
	public function getReturnType () {}

	/**
	 * Gets function short name
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getshortname.php
	 * @return string The short name of the function.
	 * @since 5.3
	 */
	public function getShortName () {}

	/**
	 * Gets starting line number
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getstartline.php
	 * @return int The starting line number.
	 * @since 5.0
	 */
	public function getStartLine () {}

	/**
	 * Gets static variables
	 * @link https://php.net/manual/en/reflectionfunctionabstract.getstaticvariables.php
	 * @return array An array of static variables.
	 * @since 5.0
	 */
	public function getStaticVariables () {}

	/**
	 * Checks if the function has a specified return type
	 * @link https://php.net/manual/en/reflectionfunctionabstract.hasreturntype.php
	 * @return bool Returns TRUE if the function is a specified return type, otherwise FALSE.
	 * @since 7.0
	 */
	public function hasReturnType () {}

	/**
	 * Checks if returns reference
	 * @link https://php.net/manual/en/reflectionfunctionabstract.returnsreference.php
	 * @return bool <b>TRUE</b> if it returns a reference, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function returnsReference () {}

	/**
	 * Returns whether this function is a generator
	 * @link https://php.net/manual/en/reflectionfunctionabstract.isgenerator.php
	 * @return bool <b>TRUE</b> if the function is generator, otherwise <b>FALSE</b>
	 * @since 5.5
	 */
	public function isGenerator() {}

	/**
	 * Returns whether this function is variadic
	 * @link https://php.net/manual/en/reflectionfunctionabstract.isvariadic.php
	 * @return bool <b>TRUE</b> if the function is variadic, otherwise <b>FALSE</b>
	 * @since 5.6
	 */
	public function isVariadic() {}
}

/**
 * The <b>ReflectionFunction</b> class reports
 * information about a function.
 * @link https://php.net/manual/en/class.reflectionfunction.php
 */
class ReflectionFunction extends ReflectionFunctionAbstract implements Reflector {
	const IS_DEPRECATED = 262144;

	public $name;


	/**
	 * Constructs a ReflectionFunction object
	 * @link https://php.net/manual/en/reflectionfunction.construct.php
	 * @param mixed $name <p>
	 * The name of the function to reflect or a closure.
	 * </p>
	 * @throws \ReflectionException if the function does not exist.
	 * @since 5.0
	 */
	public function __construct ($name) {}

	/**
	 * To string
	 * @link https://php.net/manual/en/reflectionfunction.tostring.php
	 * @return string <b>ReflectionFunction::export</b>-like output for
	 * the function.
	 * @since 5.0
	 */
	public function __toString () {}

	/**
	 * Exports function
	 * @link https://php.net/manual/en/reflectionfunction.export.php
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
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($name, $return = null) {}

	/**
	 * Checks if function is disabled
	 * @link https://php.net/manual/en/reflectionfunction.isdisabled.php
	 * @return bool <b>TRUE</b> if it's disable, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isDisabled () {}

	/**
	 * Invokes function
	 * @link https://php.net/manual/en/reflectionfunction.invoke.php
	 * @param string $args [optional] <p>
	 * The passed in argument list. It accepts a variable number of
	 * arguments which are passed to the function much like
	 * call_user_func is.
	 * </p>
	 * @return mixed 
	 * @since 5.0
	 */
	public function invoke ($args = null) {}

	/**
	 * Invokes function args
	 * @link https://php.net/manual/en/reflectionfunction.invokeargs.php
	 * @param array $args <p>
	 * The passed arguments to the function as an array, much like
	 * <b>call_user_func_array</b> works.
	 * </p>
	 * @return mixed the result of the invoked function
	 * @since 5.1
	 */
	public function invokeArgs (array $args) {}

	/**
	 * Returns a dynamically created closure for the function
	 * @link https://php.net/manual/en/reflectionfunction.getclosure.php
	 * @return Closure <b>Closure</b>.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.0
	 */
	public function getClosure () {}

}

/**
 * The <b>ReflectionParameter</b> class retrieves
 * information about function's or method's parameters.
 * @link https://php.net/manual/en/class.reflectionparameter.php
 */
class ReflectionParameter implements Reflector {
	public $name;


	/**
	 * Clone
	 * @link https://php.net/manual/en/reflectionparameter.clone.php
	 * @return void
	 * @since 5.0
	 */
	final private function __clone () {}

	/**
	 * Exports
	 * @link https://php.net/manual/en/reflectionparameter.export.php
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
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($function, $parameter, $return = null) {}

	/**
	 * Construct
	 * @link https://php.net/manual/en/reflectionparameter.construct.php
	 * @param string $function <p>
	 * The function to reflect parameters from.
	 * </p>
	 * @param string $parameter <p>
	 * The parameter.
	 * </p>
	 * @throws \ReflectionException if the function or parameter does not exist.
	 * @since 5.0
	 */
	public function __construct ($function, $parameter) {}

	/**
	 * To string
	 * @link https://php.net/manual/en/reflectionparameter.tostring.php
	 * @return string
	 * @since 5.0
	 */
	public function __toString () {}

	/**
	 * Gets parameter name
	 * @link https://php.net/manual/en/reflectionparameter.getname.php
	 * @return string The name of the reflected parameter.
	 * @since 5.0
	 */
	public function getName () {}

	/**
	 * Gets a parameter's type
	 * @link https://php.net/manual/en/reflectionparameter.gettype.php
	 * @return ReflectionType|null Returns a ReflectionType object if a parameter type is specified, NULL otherwise.
	 * @since 7.0
	 */
	public function getType() {}

	/**
	 * Checks if the parameter has a type associated with it.
	 * @link https://php.net/manual/en/reflectionparameter.hastype.php
	 * @return bool TRUE if a type is specified, FALSE otherwise.
	 * @since 7.0
	 */
	public function hasType () {}


	/**
	 * Checks if passed by reference
	 * @link https://php.net/manual/en/reflectionparameter.ispassedbyreference.php
	 * @return bool <b>TRUE</b> if the parameter is passed in by reference, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isPassedByReference () {}

	/**
	 * Returns whether this parameter can be passed by value
	 * @link https://php.net/manual/en/reflectionparameter.canbepassedbyvalue.php
	 * @return bool <b>TRUE</b> if the parameter can be passed by value, <b>FALSE</b> otherwise.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.4
	 */
	public function canBePassedByValue () {}

	/**
	 * Gets declaring function
	 * @link https://php.net/manual/en/reflectionparameter.getdeclaringfunction.php
	 * @return ReflectionFunctionAbstract A <b>ReflectionFunctionAbstract</b> object.
	 * @since 5.2.3
	 */
	public function getDeclaringFunction () {}

	/**
	 * Gets declaring class
	 * @link https://php.net/manual/en/reflectionparameter.getdeclaringclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object.
	 * @since 5.0
	 */
	public function getDeclaringClass () {}

	/**
	 * Get class
	 * @link https://php.net/manual/en/reflectionparameter.getclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object.
	 * @since 5.0
	 */
	public function getClass () {}

	/**
	 * Checks if parameter expects an array
	 * @link https://php.net/manual/en/reflectionparameter.isarray.php
	 * @return bool <b>TRUE</b> if an array is expected, <b>FALSE</b> otherwise.
	 * @since 5.1
	 */
	public function isArray () {}

    /**
     * Returns whether parameter MUST be callable
     * @link https://php.net/manual/en/reflectionparameter.iscallable.php
     * @return bool|null Returns TRUE if the parameter is callable, FALSE if it is not or NULL on failure.
	 * @since 5.4
     */
    public function isCallable () {}

	/**
	 * Checks if null is allowed
	 * @link https://php.net/manual/en/reflectionparameter.allowsnull.php
	 * @return bool <b>TRUE</b> if <b>NULL</b> is allowed, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function allowsNull () {}

	/**
	 * Gets parameter position
	 * @link https://php.net/manual/en/reflectionparameter.getposition.php
	 * @return int The position of the parameter, left to right, starting at position #0.
	 * @since 5.2.3
	 */
	public function getPosition () {}

	/**
	 * Checks if optional
	 * @link https://php.net/manual/en/reflectionparameter.isoptional.php
	 * @return bool <b>TRUE</b> if the parameter is optional, otherwise <b>FALSE</b>
	 * @since 5.0.3
	 */
	public function isOptional () {}

	/**
	 * Checks if a default value is available
	 * @link https://php.net/manual/en/reflectionparameter.isdefaultvalueavailable.php
	 * @return bool <b>TRUE</b> if a default value is available, otherwise <b>FALSE</b>
	 * @since 5.0.3
	 */
	public function isDefaultValueAvailable () {}

	/**
	 * Gets default parameter value
	 * @link https://php.net/manual/en/reflectionparameter.getdefaultvalue.php
	 * @return mixed The parameters default value.
	 * @throws \ReflectionException if the parameter is not optional
	 * @since 5.0.3
	 */
	public function getDefaultValue () {}

    /**
	 * Returns whether the default value of this parameter is constant
	 * @return bool
	 * @since 5.4.6
     */
    public function isDefaultValueConstant () {}

    /**
	 * Returns the default value's constant name if default value is constant or null
     * @return string
     * @throws \ReflectionException if the parameter is not optional
	 * @since 5.4.6
     */
	public function getDefaultValueConstantName () {}

	/**
	 * Returns whether this function is variadic
	 * @link https://php.net/manual/en/reflectionparameter.isvariadic.php
	 * @return bool <b>TRUE</b> if the function is variadic, otherwise <b>FALSE</b>
	 * @since 5.6
	 */
	public function isVariadic() {}

}

/**
 * The <b>ReflectionMethod</b> class reports
 * information about a method.
 * @link https://php.net/manual/en/class.reflectionmethod.php
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
	 * Export a reflection method.
	 * @link https://php.net/manual/en/reflectionmethod.export.php
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
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($class, $name, $return = false) {}

	/**
	 * Constructs a ReflectionMethod
	 * @link https://php.net/manual/en/reflectionmethod.construct.php
	 * @param mixed $class [optional] <p>
	 * Classname or object (instance of the class) that contains the method.
	 * </p>
	 * @param string $name <p>
	 * Name of the method, or the method FQN in the form 'Foo::bar' if $class argument missing
	 * </p>
	 * @throws \ReflectionException if the class or method does not exist.
	 * @since 5.0
	 */
	public function __construct ($class, $name) {}

	/**
	 * Returns the string representation of the Reflection method object.
	 * @link https://php.net/manual/en/reflectionmethod.tostring.php
	 * @return string A string representation of this <b>ReflectionMethod</b> instance.
	 * @since 5.0
	 */
	public function __toString () {}

	/**
	 * Checks if method is public
	 * @link https://php.net/manual/en/reflectionmethod.ispublic.php
	 * @return bool <b>TRUE</b> if the method is public, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isPublic () {}

	/**
	 * Checks if method is private
	 * @link https://php.net/manual/en/reflectionmethod.isprivate.php
	 * @return bool <b>TRUE</b> if the method is private, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isPrivate () {}

	/**
	 * Checks if method is protected
	 * @link https://php.net/manual/en/reflectionmethod.isprotected.php
	 * @return bool <b>TRUE</b> if the method is protected, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isProtected () {}

	/**
	 * Checks if method is abstract
	 * @link https://php.net/manual/en/reflectionmethod.isabstract.php
	 * @return bool <b>TRUE</b> if the method is abstract, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isAbstract () {}

	/**
	 * Checks if method is final
	 * @link https://php.net/manual/en/reflectionmethod.isfinal.php
	 * @return bool <b>TRUE</b> if the method is final, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isFinal () {}

	/**
	 * Checks if method is static
	 * @link https://php.net/manual/en/reflectionmethod.isstatic.php
	 * @return bool <b>TRUE</b> if the method is static, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isStatic () {}

	/**
	 * Checks if method is a constructor
	 * @link https://php.net/manual/en/reflectionmethod.isconstructor.php
	 * @return bool <b>TRUE</b> if the method is a constructor, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isConstructor () {}

	/**
	 * Checks if method is a destructor
	 * @link https://php.net/manual/en/reflectionmethod.isdestructor.php
	 * @return bool <b>TRUE</b> if the method is a destructor, otherwise <b>FALSE</b>
	 * @since 5.0
	 */
	public function isDestructor () {}

	/**
	 * Returns a dynamically created closure for the method
	 * @link https://php.net/manual/en/reflectionmethod.getclosure.php
	 * @param object $object [optional] Forbidden for static methods, required for other methods.
	 * @return Closure <b>Closure</b>.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.4
	 */
	public function getClosure ($object) {}

	/**
	 * Gets the method modifiers
	 * @link https://php.net/manual/en/reflectionmethod.getmodifiers.php
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
	 * @since 5.0
	 */
	public function getModifiers () {}

	/**
	 * Invoke
	 * @link https://php.net/manual/en/reflectionmethod.invoke.php
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
	 * @since 5.0
	 */
	public function invoke ($object, $parameter = null, $_ = null) {}

	/**
	 * Invoke args
	 * @link https://php.net/manual/en/reflectionmethod.invokeargs.php
	 * @param object $object <p>
	 * The object to invoke the method on. In case of static methods, you can pass
	 * null to this parameter.
	 * </p>
	 * @param array $args <p>
	 * The parameters to be passed to the function, as an array.
	 * </p>
	 * @return mixed the method result.
	 * @since 5.1
	 */
	public function invokeArgs ($object, array $args) {}

	/**
	 * Gets declaring class for the reflected method.
	 * @link https://php.net/manual/en/reflectionmethod.getdeclaringclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object of the class that the
	 * reflected method is part of.
	 * @since 5.0
	 */
	public function getDeclaringClass () {}

	/**
	 * Gets the method prototype (if there is one).
	 * @link https://php.net/manual/en/reflectionmethod.getprototype.php
	 * @return ReflectionMethod A <b>ReflectionMethod</b> instance of the method prototype.
	 * @since 5.0
	 */
	public function getPrototype () {}

	/**
	 * Set method accessibility
	 * @link https://php.net/manual/en/reflectionmethod.setaccessible.php
	 * @param bool $accessible <p>
	 * <b>TRUE</b> to allow accessibility, or <b>FALSE</b>.
	 * </p>
	 * @return void No value is returned.
	 * @since 5.3.2
	 */
	public function setAccessible ($accessible) {}

}

/**
 * The <b>ReflectionClass</b> class reports
 * information about a class.
 * @link https://php.net/manual/en/class.reflectionclass.php
 */
class ReflectionClass implements Reflector {
	const IS_IMPLICIT_ABSTRACT = 16;
	const IS_EXPLICIT_ABSTRACT = 32;
	const IS_FINAL = 64;

	public $name;


	/**
	 * Clones object
	 * @link https://php.net/manual/en/reflectionclass.clone.php
	 * @return void 
	 * @since 5.0
	 */
	final private function __clone () {}

	/**
	 * Exports a class
	 * @link https://php.net/manual/en/reflectionclass.export.php
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
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($argument, $return = false) {}

	/**
	 * Constructs a ReflectionClass
	 * @link https://php.net/manual/en/reflectionclass.construct.php
	 * @param mixed $argument <p>
	 * Either a string containing the name of the class to
	 * reflect, or an object.
	 * </p>
	 * @throws \ReflectionException if the class does not exist.
	 * @since 5.0
	 */
	public function __construct ($argument) {}

	/**
	 * Returns the string representation of the ReflectionClass object.
	 * @link https://php.net/manual/en/reflectionclass.tostring.php
	 * @return string A string representation of this <b>ReflectionClass</b> instance.
	 * @since 5.0
	 */
	public function __toString () {}

	/**
	 * Gets class name
	 * @link https://php.net/manual/en/reflectionclass.getname.php
	 * @return string The class name.
	 * @since 5.0
	 */
	public function getName () {}

	/**
	 * Checks if class is defined internally by an extension, or the core
	 * @link https://php.net/manual/en/reflectionclass.isinternal.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isInternal () {}

	/**
	 * Checks if user defined
	 * @link https://php.net/manual/en/reflectionclass.isuserdefined.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isUserDefined () {}

	/**
	 * Checks if the class is instantiable
	 * @link https://php.net/manual/en/reflectionclass.isinstantiable.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isInstantiable () {}

	/**
	 * Returns whether this class is cloneable
	 * @link https://php.net/manual/en/reflectionclass.iscloneable.php
	 * @return bool <b>TRUE</b> if the class is cloneable, <b>FALSE</b> otherwise.
	 * @since 5.4
	 */
	public function isCloneable () {}

	/**
	 * Gets the filename of the file in which the class has been defined
	 * @link https://php.net/manual/en/reflectionclass.getfilename.php
	 * @return string|false the filename of the file in which the class has been defined.
	 * If the class is defined in the PHP core or in a PHP extension, <b>FALSE</b>
	 * is returned.
	 * @since 5.0
	 */
	public function getFileName () {}

	/**
	 * Gets starting line number
	 * @link https://php.net/manual/en/reflectionclass.getstartline.php
	 * @return int The starting line number, as an integer.
	 * @since 5.0
	 */
	public function getStartLine () {}

	/**
	 * Gets end line
	 * @link https://php.net/manual/en/reflectionclass.getendline.php
	 * @return int|false The ending line number of the user defined class, or <b>FALSE</b> if unknown.
	 * @since 5.0
	 */
	public function getEndLine () {}

	/**
	 * Gets doc comments
	 * @link https://php.net/manual/en/reflectionclass.getdoccomment.php
	 * @return string|false The doc comment if it exists, otherwise <b>FALSE</b>
	 * @since 5.1
	 */
	public function getDocComment () {}

	/**
	 * Gets the constructor of the class
	 * @link https://php.net/manual/en/reflectionclass.getconstructor.php
	 * @return ReflectionMethod A <b>ReflectionMethod</b> object reflecting the class' constructor, or <b>NULL</b> if the class
	 * has no constructor.
	 * @since 5.0
	 */
	public function getConstructor () {}

	/**
	 * Checks if method is defined
	 * @link https://php.net/manual/en/reflectionclass.hasmethod.php
	 * @param string $name <p>
	 * Name of the method being checked for.
	 * </p>
	 * @return bool <b>TRUE</b> if it has the method, otherwise <b>FALSE</b>
	 * @since 5.1
	 */
	public function hasMethod ($name) {}

	/**
	 * Gets a <b>ReflectionMethod</b> for a class method.
	 * @link https://php.net/manual/en/reflectionclass.getmethod.php
	 * @param string $name <p>
	 * The method name to reflect.
	 * </p>
	 * @return ReflectionMethod A <b>ReflectionMethod</b>.
	 * @throws \ReflectionException if the method does not exist.
	 * @since 5.0
	 */
	public function getMethod ($name) {}

	/**
	 * Gets an array of methods
	 * @link https://php.net/manual/en/reflectionclass.getmethods.php
	 * @param int $filter [optional] <p>
	 * Filter the results to include only methods with certain attributes. Defaults
	 * to no filtering.
	 * </p>
	 * <p>
	 * Any bitwise disjunction of <b>ReflectionMethod::IS_STATIC</b>,
	 * <b>ReflectionMethod::IS_PUBLIC</b>,
	 * <b>ReflectionMethod::IS_PROTECTED</b>,
	 * <b>ReflectionMethod::IS_PRIVATE</b>,
	 * <b>ReflectionMethod::IS_ABSTRACT</b>,
	 * <b>ReflectionMethod::IS_FINAL</b>,
	 * so that all methods with <em>any</em> of the given attributes will be returned.
	 * </p>
         * @return ReflectionMethod[] An array of ReflectionMethod objects reflecting each method.
	 * @since 5.0
	 */
	public function getMethods ($filter = null) {}

	/**
	 * Checks if property is defined
	 * @link https://php.net/manual/en/reflectionclass.hasproperty.php
	 * @param string $name <p>
	 * Name of the property being checked for.
	 * </p>
	 * @return bool <b>TRUE</b> if it has the property, otherwise <b>FALSE</b>
	 * @since 5.1
	 */
	public function hasProperty ($name) {}

	/**
	 * Gets a <b>ReflectionProperty</b> for a class's property
	 * @link https://php.net/manual/en/reflectionclass.getproperty.php
	 * @param string $name <p>
	 * The property name.
	 * </p>
	 * @return ReflectionProperty A <b>ReflectionProperty</b>.
	 * @throws ReflectionException If no property exists by that name.
	 * @since 5.0
	 */
	public function getProperty ($name) {}

	/**
	 * Gets properties
	 * @link https://php.net/manual/en/reflectionclass.getproperties.php
	 * @param int $filter [optional] <p>
	 * The optional filter, for filtering desired property types. It's configured using
	 * the ReflectionProperty constants,
	 * and defaults to all property types.
	 * </p>
	 * @return ReflectionProperty[]
	 * @since 5.0
	 */
	public function getProperties ($filter = null) {}

	/**
	 * Gets a ReflectionClassConstant for a class's property
	 * @link https://php.net/manual/en/reflectionclass.getreflectionconstant.php
	 * @param string $name <p>
	 * The class constant name.
	 * </p>
	 * @return ReflectionClassConstant A ReflectionClassConstant.
	 * @since 7.1
	 */
	public function getReflectionConstant ($name) {}

	/**
	 * Gets class constants
	 * @link https://php.net/manual/en/reflectionclass.getreflectionconstants.php
	 * @return ReflectionClassConstant[] An array of ReflectionClassConstant objects.
	 * @since 7.1
	 */
	public function getReflectionConstants () {}

	/**
	 * Checks if constant is defined
	 * @link https://php.net/manual/en/reflectionclass.hasconstant.php
	 * @param string $name <p>
	 * The name of the constant being checked for.
	 * </p>
	 * @return bool <b>TRUE</b> if the constant is defined, otherwise <b>FALSE</b>.
	 * @since 5.1
	 */
	public function hasConstant ($name) {}

	/**
	 * Gets constants
	 * @link https://php.net/manual/en/reflectionclass.getconstants.php
	 * @return array An array of constants.
	 * Constant name in key, constant value in value.
	 * @since 5.0
	 */
	public function getConstants () {}

	/**
	 * Gets defined constant
	 * @link https://php.net/manual/en/reflectionclass.getconstant.php
	 * @param string $name <p>
	 * Name of the constant.
	 * </p>
	 * @return mixed Value of the constant.
	 * @since 5.0
	 */
	public function getConstant ($name) {}

	/**
	 * Gets the interfaces
	 * @link https://php.net/manual/en/reflectionclass.getinterfaces.php
         * @return ReflectionClass[] An associative array of interfaces, with keys as interface
	 * names and the array values as <b>ReflectionClass</b> objects.
	 * @since 5.0
	 */
	public function getInterfaces () {}

	/**
	 * Gets the interface names
	 * @link https://php.net/manual/en/reflectionclass.getinterfacenames.php
	 * @return array A numerical array with interface names as the values.
	 * @since 5.2
	 */
	public function getInterfaceNames () {}

	/**
	 * Checks if the class is anonymous
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 7.0
	 */
	public function isAnonymous () {}

	/**
	 * Checks if the class is an interface
	 * @link https://php.net/manual/en/reflectionclass.isinterface.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isInterface () {}

	/**
	 * Returns an array of traits used by this class
	 * @link https://php.net/manual/en/reflectionclass.gettraits.php
	 * @return ReflectionClass[] an array with trait names in keys and instances of trait's
	 * <b>ReflectionClass</b> in values.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.4
	 */
	public function getTraits () {}

	/**
	 * Returns an array of names of traits used by this class
	 * @link https://php.net/manual/en/reflectionclass.gettraitnames.php
	 * @return array an array with trait names in values.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.4
	 */
	public function getTraitNames () {}

	/**
	 * Returns an array of trait aliases
	 * @link https://php.net/manual/en/reflectionclass.gettraitaliases.php
	 * @return array an array with new method names in keys and original names (in the
	 * format "TraitName::original") in values.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.4
	 */
	public function getTraitAliases () {}

	/**
	 * Returns whether this is a trait
	 * @link https://php.net/manual/en/reflectionclass.istrait.php
	 * @return bool <b>TRUE</b> if this is a trait, <b>FALSE</b> otherwise.
	 * Returns <b>NULL</b> in case of an error.
	 * @since 5.4
	 */
	public function isTrait () {}

	/**
	 * Checks if class is abstract
	 * @link https://php.net/manual/en/reflectionclass.isabstract.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isAbstract () {}

	/**
	 * Checks if class is final
	 * @link https://php.net/manual/en/reflectionclass.isfinal.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isFinal () {}

	/**
	 * Gets modifiers
	 * @link https://php.net/manual/en/reflectionclass.getmodifiers.php
	 * @return int bitmask of
	 * modifier constants.
	 * @since 5.0
	 */
	public function getModifiers () {}

	/**
	 * Checks class for instance
	 * @link https://php.net/manual/en/reflectionclass.isinstance.php
	 * @param object $object <p>
	 * The object being compared to.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isInstance ($object) {}

	/**
	 * Creates a new class instance from given arguments.
	 * @link https://php.net/manual/en/reflectionclass.newinstance.php
	 * @param mixed $args [optional]<p>
	 * Accepts a variable number of arguments which are passed to the class
	 * constructor, much like <b>call_user_func</b>.
	 * </p>
	 * @param mixed $_ [optional]
	 * @return object
	 * @since 5.0
	 */
	public function newInstance ($args = null, $_ = null) {}
	/**
	 * Creates a new class instance without invoking the constructor.
	 * @link https://php.net/manual/en/reflectionclass.newinstancewithoutconstructor.php
	 * @return object
	 * @since 5.4
	 */
	public function newInstanceWithoutConstructor() {}

	/**
	 * Creates a new class instance from given arguments.
	 * @link https://php.net/manual/en/reflectionclass.newinstanceargs.php
	 * @param array $args [optional] <p>
	 * The parameters to be passed to the class constructor as an array.
	 * </p>
	 * @return object a new instance of the class.
	 * @since 5.1.3
	 */
	public function newInstanceArgs (array $args = null) {}

	/**
	 * Gets parent class
	 * @link https://php.net/manual/en/reflectionclass.getparentclass.php
	 * @return ReflectionClass|false
	 * @since 5.0
	 */
	public function getParentClass () {}

	/**
	 * Checks if a subclass
	 * @link https://php.net/manual/en/reflectionclass.issubclassof.php
	 * @param string $class <p>
	 * The class name being checked against.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isSubclassOf ($class) {}

	/**
	 * Gets static properties
	 * @link https://php.net/manual/en/reflectionclass.getstaticproperties.php
	 * @return array The static properties, as an array.
	 * @since 5.0
	 */
	public function getStaticProperties () {}

	/**
	 * Gets static property value
	 * @link https://php.net/manual/en/reflectionclass.getstaticpropertyvalue.php
	 * @param string $name <p>
	 * The name of the static property for which to return a value.
	 * </p>
	 * @param string $default [optional] <p>
	 * </p>
	 * @return mixed The value of the static property.
	 * @since 5.1
	 */
	public function getStaticPropertyValue ($name, $default = null) {}

	/**
	 * Sets static property value
	 * @link https://php.net/manual/en/reflectionclass.setstaticpropertyvalue.php
	 * @param string $name <p>
	 * Property name.
	 * </p>
	 * @param mixed $value <p>
	 * New property value.
	 * </p>
	 * @return void No value is returned.
	 * @since 5.1
	 */
	public function setStaticPropertyValue ($name, $value) {}

	/**
	 * Gets default properties
	 * @link https://php.net/manual/en/reflectionclass.getdefaultproperties.php
	 * @return array An array of default properties, with the key being the name of
	 * the property and the value being the default value of the property or <b>NULL</b>
	 * if the property doesn't have a default value. The function does not distinguish
	 * between static and non static properties and does not take visibility modifiers
	 * into account.
	 * @since 5.0
	 */
	public function getDefaultProperties () {}

	/**
	 * Checks if iterateable
	 * @link https://php.net/manual/en/reflectionclass.isiterateable.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function isIterateable () {}

	/**
	 * Checks if iterateable
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 7.2
	 */
	public function isIterable () {}

	/**
	 * Implements interface
	 * @link https://php.net/manual/en/reflectionclass.implementsinterface.php
	 * @param string $interface <p>
	 * The interface name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.0
	 */
	public function implementsInterface ($interface) {}

	/**
	 * Gets a <b>ReflectionExtension</b> object for the extension which defined the class
	 * @link https://php.net/manual/en/reflectionclass.getextension.php
	 * @return ReflectionExtension A <b>ReflectionExtension</b> object representing the extension which defined the class,
	 * or <b>NULL</b> for user-defined classes.
	 * @since 5.0
	 */
	public function getExtension () {}

	/**
	 * Gets the name of the extension which defined the class
	 * @link https://php.net/manual/en/reflectionclass.getextensionname.php
	 * @return string|false The name of the extension which defined the class, or <b>FALSE</b> for user-defined classes.
	 * @since 5.0
	 */
	public function getExtensionName () {}

	/**
	 * Checks if in namespace
	 * @link https://php.net/manual/en/reflectionclass.innamespace.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * @since 5.3
	 */
	public function inNamespace () {}

	/**
	 * Gets namespace name
	 * @link https://php.net/manual/en/reflectionclass.getnamespacename.php
	 * @return string The namespace name.
	 * @since 5.3
	 */
	public function getNamespaceName () {}

	/**
	 * Gets short name
	 * @link https://php.net/manual/en/reflectionclass.getshortname.php
	 * @return string The class short name.
	 * @since 5.3
	 */
	public function getShortName () {}

}

/**
 * The <b>ReflectionObject</b> class reports
 * information about an object.
 * @link https://php.net/manual/en/class.reflectionobject.php
 */
class ReflectionObject extends ReflectionClass implements Reflector {

	/**
	 * Export
	 * @link https://php.net/manual/en/reflectionobject.export.php
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
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($argument, $return = null) {}

	/**
	 * Constructs a ReflectionObject
	 * @link https://php.net/manual/en/reflectionobject.construct.php
	 * @param object $argument <p>
	 * An object instance.
	 * </p>
	 * @since 5.0
	 */
	public function __construct ($argument) {}

}

/**
 * The <b>ReflectionProperty</b> class reports
 * information about a classes properties.
 * @link https://php.net/manual/en/class.reflectionproperty.php
 */
class ReflectionProperty implements Reflector {
	const IS_STATIC = 1;
	const IS_PUBLIC = 256;
	const IS_PROTECTED = 512;
	const IS_PRIVATE = 1024;

	public $name;
	public $class;


	/**
	 * Clone
	 * @link https://php.net/manual/en/reflectionproperty.clone.php
	 * @return void 
	 * @since 5.0
	 */
	final private function __clone () {}

	/**
	 * Export
	 * @link https://php.net/manual/en/reflectionproperty.export.php
	 * @param mixed $class 
	 * @param string $name <p>
	 * The property name.
	 * </p>
	 * @param bool $return [optional] <p>
	 * Setting to <b>TRUE</b> will return the export,
	 * as opposed to emitting it. Setting to <b>FALSE</b> (the default) will do the opposite.
	 * </p>
	 * @return string
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($class, $name, $return = null) {}

	/**
	 * Construct a ReflectionProperty object
	 * @link https://php.net/manual/en/reflectionproperty.construct.php
	 * @param mixed $class <p>
	 * The class name, that contains the property.
	 * </p>
	 * @param string $name <p>
	 * The name of the property being reflected.
	 * </p>
	 * @throws \ReflectionException if the class or property does not exist.
	 * @since 5.0
	 */
	public function __construct ($class, $name) {}

	/**
	 * To string
	 * @link https://php.net/manual/en/reflectionproperty.tostring.php
	 * @return string
	 * @since 5.0
	 */
	public function __toString () {}

	/**
	 * Gets property name
	 * @link https://php.net/manual/en/reflectionproperty.getname.php
	 * @return string The name of the reflected property.
	 * @since 5.0
	 */
	public function getName () {}

	/**
	 * Gets value
	 * @link https://php.net/manual/en/reflectionproperty.getvalue.php
	 * @param object $object [optional]<p>
	 * If the property is non-static an object must be provided to fetch the
	 * property from. If you want to fetch the default property without
	 * providing an object use <b>ReflectionClass::getDefaultProperties</b>
	 * instead.
	 * </p>
	 * @return mixed The current value of the property.
	 * @since 5.0
	 */
	public function getValue ($object = null) {}

	/**
	 * Set property value
	 * @link https://php.net/manual/en/reflectionproperty.setvalue.php
	 * @param mixed $objectOrValue <p>
	 * If the property is non-static an object must be provided to change
	 * the property on. If the property is static this parameter is left
	 * out and only <i>value</i> needs to be provided.
	 * </p>
	 * @param mixed $value [optional] <p>
	 * The new value.
	 * </p>
	 * @return void No value is returned.
	 * @since 5.0
	 */
	public function setValue ($objectOrValue, $value) {}

	/**
	 * Checks if property is public
	 * @link https://php.net/manual/en/reflectionproperty.ispublic.php
	 * @return bool <b>TRUE</b> if the property is public, <b>FALSE</b> otherwise.
	 * @since 5.0
	 */
	public function isPublic () {}

	/**
	 * Checks if property is private
	 * @link https://php.net/manual/en/reflectionproperty.isprivate.php
	 * @return bool <b>TRUE</b> if the property is private, <b>FALSE</b> otherwise.
	 * @since 5.0
	 */
	public function isPrivate () {}

	/**
	 * Checks if property is protected
	 * @link https://php.net/manual/en/reflectionproperty.isprotected.php
	 * @return bool <b>TRUE</b> if the property is protected, <b>FALSE</b> otherwise.
	 * @since 5.0
	 */
	public function isProtected () {}

	/**
	 * Checks if property is static
	 * @link https://php.net/manual/en/reflectionproperty.isstatic.php
	 * @return bool <b>TRUE</b> if the property is static, <b>FALSE</b> otherwise.
	 * @since 5.0
	 */
	public function isStatic () {}

	/**
	 * Checks if default value
	 * @link https://php.net/manual/en/reflectionproperty.isdefault.php
	 * @return bool <b>TRUE</b> if the property was declared at compile-time, or <b>FALSE</b> if
	 * it was created at run-time.
	 * @since 5.0
	 */
	public function isDefault () {}

	/**
	 * Gets modifiers
	 * @link https://php.net/manual/en/reflectionproperty.getmodifiers.php
	 * @return int A numeric representation of the modifiers.
	 * @since 5.0
	 */
	public function getModifiers () {}

	/**
	 * Gets declaring class
	 * @link https://php.net/manual/en/reflectionproperty.getdeclaringclass.php
	 * @return ReflectionClass A <b>ReflectionClass</b> object.
	 * @since 5.0
	 */
	public function getDeclaringClass () {}

	/**
	 * Gets doc comment
	 * @link https://php.net/manual/en/reflectionproperty.getdoccomment.php
	 * @return string|false The doc comment if it exists, otherwise <b>FALSE</b>
	 * @since 5.1
	 */
	public function getDocComment () {}

	/**
	 * Set property accessibility
	 * @link https://php.net/manual/en/reflectionproperty.setaccessible.php
	 * @param bool $accessible <p>
	 * <b>TRUE</b> to allow accessibility, or <b>FALSE</b>.
	 * </p>
	 * @return void No value is returned.
	 * @since 5.3
	 */
	public function setAccessible ($accessible) {}

	/**
	 * Gets property type
	 * @return ReflectionType|null
	 * @since 7.4
	 */
	public function getType() {}

	/**
	 * Checks if property has type
	 * @return bool
	 * @since 7.4
	 */
	public function hasType() {}

	/**
	 * Checks if property is initialized
	 * @param object $object [optional]<p>
	 * If the property is non-static an object must be provided.
	 * </p>
	 * @return bool
	 * @since 7.4
	 */
	public function isInitialized ($object) {}
}

/**
 * The <b>ReflectionExtension</b> class reports
 * information about an extension.
 * @link https://php.net/manual/en/class.reflectionextension.php
 */
class ReflectionExtension implements Reflector {
	public $name;


	/**
	 * Clones
	 * @link https://php.net/manual/en/reflectionextension.clone.php
	 * @return void No value is returned, if called a fatal error will occur.
	 * @since 5.0
	 */
	final private function __clone () {}

	/**
	 * Export
	 * @link https://php.net/manual/en/reflectionextension.export.php
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
	 * @since 5.0
	 * @deprecated 7.4
	 */
	public static function export ($name, $return = false) {}

	/**
	 * Constructs a ReflectionExtension
	 * @link https://php.net/manual/en/reflectionextension.construct.php
	 * @param string $name <p>
	 * Name of the extension.
	 * </p>
	 * @throws \ReflectionException if the extension does not exist.
	 * @since 5.0
	 */
	public function __construct ($name) {}

	/**
	 * To string
	 * @link https://php.net/manual/en/reflectionextension.tostring.php
	 * @return string the exported extension as a string, in the same way as the
	 * <b>ReflectionExtension::export</b>.
	 * @since 5.0
	 */
	public function __toString () {}

	/**
	 * Gets extension name
	 * @link https://php.net/manual/en/reflectionextension.getname.php
	 * @return string The extensions name.
	 * @since 5.0
	 */
	public function getName () {}

	/**
	 * Gets extension version
	 * @link https://php.net/manual/en/reflectionextension.getversion.php
	 * @return string The version of the extension.
	 * @since 5.0
	 */
	public function getVersion () {}

	/**
	 * Gets extension functions
	 * @link https://php.net/manual/en/reflectionextension.getfunctions.php
         * @return ReflectionFunction[] An associative array of <b>ReflectionFunction</b> objects,
	 * for each function defined in the extension with the keys being the function
	 * names. If no function are defined, an empty array is returned.
	 * @since 5.0
	 */
	public function getFunctions () {}

	/**
	 * Gets constants
	 * @link https://php.net/manual/en/reflectionextension.getconstants.php
	 * @return array An associative array with constant names as keys.
	 * @since 5.0
	 */
	public function getConstants () {}

	/**
	 * Gets extension ini entries
	 * @link https://php.net/manual/en/reflectionextension.getinientries.php
	 * @return array An associative array with the ini entries as keys,
	 * with their defined values as values.
	 * @since 5.0
	 */
	public function getINIEntries () {}

	/**
	 * Gets classes
	 * @link https://php.net/manual/en/reflectionextension.getclasses.php
         * @return ReflectionClass[] An array of <b>ReflectionClass</b> objects, one
	 * for each class within the extension. If no classes are defined,
	 * an empty array is returned.
	 * @since 5.0
	 */
	public function getClasses () {}

	/**
	 * Gets class names
	 * @link https://php.net/manual/en/reflectionextension.getclassnames.php
	 * @return array An array of class names, as defined in the extension.
	 * If no classes are defined, an empty array is returned.
	 * @since 5.0
	 */
	public function getClassNames () {}

	/**
	 * Gets dependencies
	 * @link https://php.net/manual/en/reflectionextension.getdependencies.php
	 * @return array An associative array with dependencies as keys and
	 * either Required, Optional
	 * or Conflicts as the values.
	 * @since 5.0
	 */
	public function getDependencies () {}

	/**
	 * Gets extension info
	 * @link https://php.net/manual/en/reflectionextension.info.php
	 * @return string Information about the extension.
	 * @since 5.0
	 */
	public function info () {}

	/**
	 * Returns whether this extension is persistent
	 * @link https://php.net/manual/en/reflectionextension.ispersistent.php
	 * @return bool <b>TRUE</b> for extensions loaded by extension, <b>FALSE</b>
	 * otherwise.
	 * @since 5.4
	 */
	public function isPersistent () {}

	/**
	 * Returns whether this extension is temporary
	 * @link https://php.net/manual/en/reflectionextension.istemporary.php
	 * @return bool <b>TRUE</b> for extensions loaded by <b>dl</b>,
	 * <b>FALSE</b> otherwise.
	 * @since 5.4
	 */
	public function isTemporary () {}


}

/**
 * @link https://secure.php.net/manual/en/class.reflectionzendextension.php
 * @since 5.4
 */
class ReflectionZendExtension implements Reflector {
	public $name;


	/**
	 * Clone handler
	 * @link https://php.net/manual/en/reflectionzendextension.clone.php
	 * @return void
	 * @since 5.4
	 */
	final private function __clone () {}

	/**
	 * Export
	 * @link https://php.net/manual/en/reflectionzendextension.export.php
	 * @param string $name <p>
	 * </p>
	 * @param string $return [optional] <p>
	 * </p>
	 * @return string
	 * @since 5.4
	 * @deprecated 7.4
	 */
	public static function export ($name, $return = null) {}

	/**
	 * Constructor
	 * @link https://php.net/manual/en/reflectionzendextension.construct.php
	 * @param string $name <p>
	 * </p>
	 * @throws \ReflectionException if the extension does not exist.
	 * @since 5.4
	 */
	public function __construct ($name) {}

	/**
	 * To string handler
	 * @link https://php.net/manual/en/reflectionzendextension.tostring.php
	 * @return string
	 * @since 5.4
	 */
	public function __toString () {}

	/**
	 * Gets name
	 * @link https://php.net/manual/en/reflectionzendextension.getname.php
	 * @return string
	 * @since 5.4
	 */
	public function getName () {}

	/**
	 * Gets version
	 * @link https://php.net/manual/en/reflectionzendextension.getversion.php
	 * @return string
	 * @since 5.4
	 */
	public function getVersion () {}

	/**
	 * Gets author
	 * @link https://php.net/manual/en/reflectionzendextension.getauthor.php
	 * @return string
	 * @since 5.4
	 */
	public function getAuthor () {}

	/**
	 * Gets URL
	 * @link https://php.net/manual/en/reflectionzendextension.geturl.php
	 * @return string
	 * @since 5.4
	 */
	public function getURL () {}

	/**
	 * Gets copyright
	 * @link https://php.net/manual/en/reflectionzendextension.getcopyright.php
	 * @return string
	 * @since 5.4
	 */
	public function getCopyright () {}

}

/**
 * The ReflectionGenerator class reports information about a generator.
 * @since 7.0
 */
class ReflectionGenerator
{
	/* Methods */
	/**
	 * Constructs a ReflectionGenerator object
	 * @link https://php.net/manual/en/reflectiongenerator.construct.php
	 * @param Generator $generator A generator object.
	 * @since 7.0
	 */
	public function __construct(Generator $generator)
	{
	}

	/**
	 *  Gets the file name of the currently executing generator
	 * @link https://php.net/manual/en/reflectiongenerator.getexecutingfile.php
	 * @return string Returns the full path and file name of the currently executing generator.
	 * @since 7.0
	 *
	 */
	public function getExecutingFile()
	{
	}

	/**
	 * Gets the executing Generator object
	 * @link https://php.net/manual/en/reflectiongenerator.construct.php
	 * @return Generator Returns the currently executing Generator object.
	 * @since 7.0
	 *
	 */
	public function getExecutingGenerator()
	{
	}

	/**
	 * Gets the currently executing line of the generator
	 * @link https://php.net/manual/en/reflectiongenerator.getexecutingline.php
	 * @return int Returns the line number of the currently executing statement in the generator.
	 * @since 7.0
	 */
	public function getExecutingLine()
	{
	}

	/**
	 * Gets the function name of the generator
	 * @link https://php.net/manual/en/reflectiongenerator.getfunction.php
	 * @return ReflectionFunctionAbstract Returns a ReflectionFunctionAbstract class. This will be ReflectionFunction for functions, or ReflectionMethod for methods.
	 * @since 7.0
	 */
	public function getFunction()
	{
	}

	/**
	 * Gets the function name of the generator
	 * @link https://php.net/manual/en/reflectiongenerator.getthis.php
	 * @return object|null Returns the $this value, or NULL if the generator was not created in a class context.
	 * @since 7.0
	 */
	public function getThis()
	{
	}

	/**
	 * Gets the trace of the executing generator
	 * @link https://php.net/manual/en/reflectiongenerator.gettrace.php
	 * @param int $options [optional] <p>
	 * The value of <em>options</em> can be any of the following
	 * the following flags.
	 * </p>
	 * <table>
	 * <b>Available options</b>
	 *
	 * <thead>
	 * <tr>
	 * <th>Option</th>
	 * <th>Description</th>
	 * </tr>
	 *
	 * </thead>
	 *
	 * <tbody class="tbody">
	 * <tr>
	 * <td>
	 * <b>DEBUG_BACKTRACE_PROVIDE_OBJECT</b>
	 * </td>
	 * <td>
	 * Default.
	 * </td>
	 * </tr>
	 *
	 * <tr>
	 * <td>
	 * <b>DEBUG_BACKTRACE_IGNORE_ARGS</B>
	 * </td>
	 * <td>
	 * Don't include the argument information for functions in the stack
	 * trace.
	 * </td>
	 * </tr>
	 *
	 * </tbody>
	 *
	 * </table>
	 * @return array Returns the trace of the currently executing generator.
	 * @since 7.0
	 */
	public function getTrace($options = DEBUG_BACKTRACE_PROVIDE_OBJECT)
	{
	}
}

/**
 * The ReflectionType class reports information about a function's parameters.
 * @since 7.0
 */
class ReflectionType
{
	/* Methods */
	/**
	 * Checks if null is allowed
	 * @link https://php.net/manual/en/reflectiontype.allowsnull.php
	 * @return bool TRUE if NULL is allowed, otherwise FALSE
	 * @since 7.0
	 */
	public function allowsNull()
	{
	}

	/**
	 * Checks if it is a built-in type
	 * @link https://php.net/manual/en/reflectiontype.isbuiltin.php
	 * @return bool TRUE if it's a built-in type, otherwise FALSE
	 * @since 7.0
	 */
	public function isBuiltin()
	{
	}

	/**
	 * To string
	 * @link https://php.net/manual/en/reflectiontype.tostring.php
	 * @return string Returns the type of the parameter.
	 * @since 7.0
	 * @deprecated 7.1 Please use getName()
	 * @see \ReflectionType::getName()
	 */
	public function __toString()
	{
	}

    private final function __clone() {}

}

/**
 * The ReflectionClassConstant class reports information about a class constant.
 * @since 7.1
 */
class ReflectionClassConstant implements Reflector {

    public $name ;
    public $class ;

    /**
     * ReflectionClassConstant constructor.
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.construct.php
     * @param mixed $class Either a string containing the name of the class to reflect, or an object.
     * @param string $name The name of the class constant.
     */
    public function __construct($class, $name) {}

    /**
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.export.php
     * @param mixed $class The reflection to export.
     * @param string $name The class constant name.
     * @param bool $return Setting to TRUE will return the export, as opposed to emitting it. Setting to FALSE (the default) will do the opposite.
     * @return string
     * @deprecated 7.4
     */
	public static function export($class, $name, $return) {}

    /**
     * Gets declaring class
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.getdeclaringclass.php
     * @return ReflectionClass
     */
	public function getDeclaringClass() {}

    /**
     * Gets doc comments
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.getdoccomment.php
     * @return string|false The doc comment if it exists, otherwise <b>FALSE</b>
     */
	public function getDocComment() {}

    /**
     * Gets the class constant modifiers
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.getmodifiers.php
     * @return int
     */
	public function getModifiers() {}

    /**
     * Get name of the constant
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.getname.php
     * @return string
     */
	public function getName() {}

    /**
     * Gets value
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.getvalue.php
     * @return mixed
     */
	public function getValue() {}

    /**
     * Checks if class constant is private
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.isprivate.php
     * @return bool
     */
	public function isPrivate() {}

    /**
     * Checks if class constant is protected
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.isprotected.php
     * @return bool
     */
	public function isProtected() {}

    /**
     * Checks if class constant is public
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.ispublic.php
     * @return bool
     */
	public function isPublic() {}

    /**
     * Returns the string representation of the ReflectionClassConstant object.
     * @since 7.1
     * @link https://php.net/manual/en/reflectionclassconstant.tostring.php
     * @return string|void
     */
	public function __toString() {}

    private final function __clone() {}

}

/**
 * @since 7.1
 */
class ReflectionNamedType extends ReflectionType
{
	/**
	 * Get the text of the type hint.
	 * @return string Returns the text of the type hint.
	 */
	public function getName()
	{
	}
}

/**
 * @since 7.4
 */
final class ReflectionReference
{
	/**
	 * Returns ReflectionReference if array element is a reference, null otherwise
	 * @param array $array
	 * @param int|string $key
	 * @return self|null
	 */
	public static function fromArrayElement($array, $key) {}
	
	/**
	 * Returns unique identifier for the reference. The return value format is unspecified
	 * @return int|string
	 */
	public function getId() {}
	
	private function __construct() {}
	
	private function __clone() {}
}

// End of Reflection v.$Id: bcdcdaeea3aba34a8083bb62c6eda69ff3c3eab5 $
?>
