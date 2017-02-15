<?php
/**
 * PHPStorm stub file for Class/Object functions.
 *
 * @link http://php.net/manual/en/book.classobj.php
 */

/**
 * Attempt to load undefined class.
 *
 * You can define this function to enable classes autoloading.
 *
 * @link  http://php.net/manual/en/function.autoload.php
 *
 * @param string $class Name of the class to load.
 */
function __autoload($class) { }

/**
 * Call a user method on an specific object
 *
 * @link       http://php.net/manual/en/function.call-user-method.php
 * @deprecated 5.3 use call_user_func() instead
 *
 * @param string $method_name
 * @param object $obj
 * @param mixed  $parameter [optional]
 * @param mixed  $_         [optional]
 *
 * @return mixed
 * @since      4.0
 * @since      5.0
 */
function call_user_method($method_name, &$obj, $parameter = null, $_ = null) { }

/**
 * Call a user method given with an array of parameters
 *
 * @link       http://php.net/manual/en/function.call-user-method-array.php
 * @deprecated 5.3 use call_user_func_array() instead
 *
 * @param string $method_name
 * @param object $obj
 * @param array  $params
 *
 * @return mixed
 * @since      4.0.5
 * @since      5.0
 */
function call_user_method_array($method_name, &$obj, array $params) { }

/**
 * Creates an alias for a class
 *
 * @link  http://php.net/manual/en/function.class-alias.php
 *
 * @param string $original The original class.
 * @param string $alias    The alias name for the class.
 * @param bool   $autoload [optional] Whether to autoload if the original class is not found.
 *
 * @return bool true on success or false on failure.
 * @since 5.3.0
 */
function class_alias($original, $alias, $autoload = true) { }

/**
 * Checks if the class has been defined
 *
 * @link  http://php.net/manual/en/function.class-exists.php
 *
 * @param string $class_name <p>
 *                           The class name. The name is matched in a case-insensitive manner.
 *                           </p>
 * @param bool   $autoload   [optional] <p>
 *                           Whether or not to call &link.autoload; by default.
 *                           </p>
 *
 * @return bool true if <i>class_name</i> is a defined class,
 * false otherwise.
 * @since 4.0
 * @since 5.0
 */
function class_exists($class_name, $autoload = true) { }

/**
 * the "Late Static Binding" class name
 *
 * @link  http://php.net/manual/en/function.get-called-class.php
 * @return string the class name. Returns false if called from outside a class.
 * @since 5.3.0
 */
function get_called_class() { }

/**
 * Returns the name of the class of an object
 *
 * @link  http://php.net/manual/en/function.get-class.php
 *
 * @param object $object [optional] <p>
 *                       The tested object. This parameter may be omitted when inside a class.
 *                       </p>
 *
 * @return string the name of the class of which <i>object</i> is an
 * instance. Returns false if <i>object</i> is not an
 * object.
 * </p>
 * <p>
 * If <i>object</i> is omitted when inside a class, the
 * name of that class is returned.
 * @since 4.0
 * @since 5.0
 */
function get_class($object = null) { }

/**
 * Gets the class methods' names
 *
 * @link  http://php.net/manual/en/function.get-class-methods.php
 *
 * @param mixed $class_name <p>
 *                          The class name or an object instance
 *                          </p>
 *
 * @return array an array of method names defined for the class specified by
 * <i>class_name</i>. In case of an error, it returns null.
 * @since 4.0
 * @since 5.0
 */
function get_class_methods($class_name) { }

/**
 * Get the default properties of the class
 *
 * @link  http://php.net/manual/en/function.get-class-vars.php
 *
 * @param string $class_name <p>
 *                           The class name
 *                           </p>
 *
 * @return array an associative array of declared properties visible from the
 * current scope, with their default value.
 * The resulting array elements are in the form of
 * varname => value.
 * @since 4.0
 * @since 5.0
 */
function get_class_vars($class_name) { }

/**
 * Returns an array with the name of the defined classes
 *
 * @link  http://php.net/manual/en/function.get-declared-classes.php
 * @return array an array of the names of the declared classes in the current
 * script.
 * </p>
 * <p>
 * Note that depending on what extensions you have compiled or
 * loaded into PHP, additional classes could be present. This means that
 * you will not be able to define your own classes using these
 * names. There is a list of predefined classes in the Predefined Classes section of
 * the appendices.
 * @since 4.0
 * @since 5.0
 */
function get_declared_classes() { }

/**
 * Returns an array of all declared interfaces
 *
 * @link  http://php.net/manual/en/function.get-declared-interfaces.php
 * @return array an array of the names of the declared interfaces in the current
 * script.
 * @since 5.0
 */
function get_declared_interfaces() { }

/**
 * Returns an array of all declared traits
 *
 * @return array with names of all declared traits in values. Returns NULL in case of a failure.
 * @link  http://www.php.net/manual/en/function.get-declared-traits.php
 * @see   class_uses()
 * @since 5.4.0
 */
function get_declared_traits() { }

/**
 * Gets the properties of the given object
 *
 * @link  http://php.net/manual/en/function.get-object-vars.php
 *
 * @param object $object <p>
 *                       An object instance.
 *                       </p>
 *
 * @return array an associative array of defined object accessible non-static properties
 * for the specified <i>object</i> in scope. If a property have
 * not been assigned a value, it will be returned with a null value.
 * @since 4.0
 * @since 5.0
 */
function get_object_vars($object) { }

/**
 * Retrieves the parent class name for object or class
 *
 * @link  http://php.net/manual/en/function.get-parent-class.php
 *
 * @param mixed $object [optional] <p>
 *                      The tested object or class name
 *                      </p>
 *
 * @return string the name of the parent class of the class of which
 * <i>object</i> is an instance or the name.
 * </p>
 * <p>
 * If the object does not have a parent false will be returned.
 * </p>
 * <p>
 * If called without parameter outside object, this function returns false.
 * @since 4.0
 * @since 5.0
 */
function get_parent_class($object = null) { }

/**
 * Checks if the interface has been defined
 *
 * @link  http://php.net/manual/en/function.interface-exists.php
 *
 * @param string $interface_name <p>
 *                               The interface name
 *                               </p>
 * @param bool   $autoload       [optional] <p>
 *                               Whether to call &link.autoload; or not by default.
 *                               </p>
 *
 * @return bool true if the interface given by
 * <i>interface_name</i> has been defined, false otherwise.
 * @since 5.0.2
 */
function interface_exists($interface_name, $autoload = true) { }

/**
 * Checks if the object is of this class or has this class as one of its parents
 *
 * @link  http://php.net/manual/en/function.is-a.php
 *
 * @param object|string $object       <p>
 *                                    The tested object
 *                                    </p>
 * @param string        $class_name   <p>
 *                                    The class name
 *                                    </p>
 * @param bool          $allow_string [optional] <p>
 *                                    If this parameter set to <b>FALSE</b>, string class name as
 *                                    <em><b>object</b></em>
 *                                    is not allowed. This also prevents from calling autoloader if the class
 *                                    doesn't exist.
 *                                    </p>
 *
 * @return bool <b>TRUE</b> if the object is of this class or has this class as one of
 * its parents, <b>FALSE</b> otherwise.
 * @since 4.0.4
 * @since 5.0
 */
function is_a($object, $class_name, $allow_string = false) { }

/**
 * Checks if the object has this class as one of its parents
 *
 * @link  http://php.net/manual/en/function.is-subclass-of.php
 *
 * @param mixed  $object       <p>
 *                             A class name or an object instance
 *                             </p>
 * @param string $class_name   <p>
 *                             The class name
 *                             </p>
 * @param bool   $allow_string [optional] <p>
 *                             If this parameter set to false, string class name as object is not allowed.
 *                             This also prevents from calling autoloader if the class doesn't exist.
 *                             </p>
 *
 * @return bool This function returns true if the object <i>object</i>,
 * belongs to a class which is a subclass of
 * <i>class_name</i>, false otherwise.
 * @since 4.0
 * @since 5.0
 */
function is_subclass_of($object, $class_name, $allow_string = true) { }

/**
 * Checks if the class method exists
 *
 * @link  http://php.net/manual/en/function.method-exists.php
 *
 * @param mixed  $object      <p>
 *                            An object instance or a class name
 *                            </p>
 * @param string $method_name <p>
 *                            The method name
 *                            </p>
 *
 * @return bool true if the method given by <i>method_name</i>
 * has been defined for the given <i>object</i>, false
 * otherwise.
 * @since 4.0
 * @since 5.0
 */
function method_exists($object, $method_name) { }

/**
 * Checks if the object or class has a property
 *
 * @link  http://php.net/manual/en/function.property-exists.php
 *
 * @param mixed  $class    <p>
 *                         The class name or an object of the class to test for
 *                         </p>
 * @param string $property <p>
 *                         The name of the property
 *                         </p>
 *
 * @return bool true if the property exists, false if it doesn't exist or
 * null in case of an error.
 * @since 5.1.0
 */
function property_exists($class, $property) { }

/**
 * Checks if the trait exists
 *
 * @param string $traitname Name of the trait to check
 * @param bool   $autoload  [optional] Whether to autoload if not already loaded.
 *
 * @return boolean Returns TRUE if trait exists, FALSE if not, NULL in case of an error.
 * @link  http://www.php.net/manual/en/function.trait-exists.php
 * @since 5.4.0
 */
function trait_exists($traitname, $autoload) { }

