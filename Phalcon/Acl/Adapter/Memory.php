<?php 

namespace Phalcon\Acl\Adapter {

	/**
	 * Phalcon\Acl\Adapter\Memory
	 *
	 * Manages ACL lists in memory
	 *
	 *<code>
	 * $acl = new \Phalcon\Acl\Adapter\Memory();
	 *
	 * $acl->setDefaultAction(
	 *     \Phalcon\Acl::DENY
	 * );
	 *
	 * // Register roles
	 * $roles = [
	 *     "users"  => new \Phalcon\Acl\Role("Users"),
	 *     "guests" => new \Phalcon\Acl\Role("Guests"),
	 * ];
	 * foreach ($roles as $role) {
	 *     $acl->addRole($role);
	 * }
	 *
	 * // Private area resources
	 * $privateResources = [
	 *     "companies" => ["index", "search", "new", "edit", "save", "create", "delete"],
	 *     "products"  => ["index", "search", "new", "edit", "save", "create", "delete"],
	 *     "invoices"  => ["index", "profile"],
	 * ];
	 *
	 * foreach ($privateResources as $resourceName => $actions) {
	 *     $acl->addResource(
	 *         new \Phalcon\Acl\Resource($resourceName),
	 *         $actions
	 *     );
	 * }
	 *
	 * // Public area resources
	 * $publicResources = [
	 *     "index"   => ["index"],
	 *     "about"   => ["index"],
	 *     "session" => ["index", "register", "start", "end"],
	 *     "contact" => ["index", "send"],
	 * ];
	 *
	 * foreach ($publicResources as $resourceName => $actions) {
	 *     $acl->addResource(
	 *         new \Phalcon\Acl\Resource($resourceName),
	 *         $actions
	 *     );
	 * }
	 *
	 * // Grant access to public areas to both users and guests
	 * foreach ($roles as $role){
	 *     foreach ($publicResources as $resource => $actions) {
	 *         $acl->allow($role->getName(), $resource, "*");
	 *     }
	 * }
	 *
	 * // Grant access to private area to role Users
	 * foreach ($privateResources as $resource => $actions) {
	 *     foreach ($actions as $action) {
	 *         $acl->allow("Users", $resource, $action);
	 *     }
	 * }
	 *</code>
	 */
	
	class Memory extends \Phalcon\Acl\Adapter implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Acl\AdapterInterface {

		protected $_rolesNames;

		protected $_roles;

		protected $_resourcesNames;

		protected $_resources;

		protected $_access;

		protected $_roleInherits;

		protected $_accessList;

		protected $_func;

		protected $_noArgumentsDefaultAction;

		/**
		 * \Phalcon\Acl\Adapter\Memory constructor
		 */
		public function __construct(){ }


		/**
		 * Adds a role to the ACL list. Second parameter allows inheriting access data from other existing role
		 *
		 * Example:
		 * <code>
		 * $acl->addRole(
		 *     new \Phalcon\Acl\Role("administrator"),
		 *     "consultant"
		 * );
		 *
		 * $acl->addRole("administrator", "consultant");
		 * </code>
		 *
		 * @param  array|string         accessInherits
		 * @param  RoleInterface|string role
		 */
		public function addRole($role, $accessInherits=null){ }


		/**
		 * Do a role inherit from another existing role
		 */
		public function addInherit($roleName, $roleToInherit){ }


		/**
		 * Check whether role exist in the roles list
		 */
		public function isRole($roleName){ }


		/**
		 * Check whether resource exist in the resources list
		 */
		public function isResource($resourceName){ }


		/**
		 * Adds a resource to the ACL list
		 *
		 * Access names can be a particular action, by example
		 * search, update, delete, etc or a list of them
		 *
		 * Example:
		 * <code>
		 * // Add a resource to the the list allowing access to an action
		 * $acl->addResource(
		 *     new \Phalcon\Acl\Resource("customers"),
		 *     "search"
		 * );
		 *
		 * $acl->addResource("customers", "search");
		 *
		 * // Add a resource  with an access list
		 * $acl->addResource(
		 *     new \Phalcon\Acl\Resource("customers"),
		 *     [
		 *         "create",
		 *         "search",
		 *     ]
		 * );
		 *
		 * $acl->addResource(
		 *     "customers",
		 *     [
		 *         "create",
		 *         "search",
		 *     ]
		 * );
		 * </code>
		 *
		 * @param   \Phalcon\Acl\Resource|string resourceValue
		 * @param   array|string accessList
		 */
		public function addResource($resourceValue, $accessList){ }


		/**
		 * Adds access to resources
		 *
		 * @param array|string accessList
		 */
		public function addResourceAccess($resourceName, $accessList){ }


		/**
		 * Removes an access from a resource
		 *
		 * @param array|string accessList
		 */
		public function dropResourceAccess($resourceName, $accessList){ }


		/**
		 * Checks if a role has access to a resource
		 */
		protected function _allowOrDeny($roleName, $resourceName, $access, $action, $func=null){ }


		/**
		 * Allow access to a role on a resource
		 *
		 * You can use '*' as wildcard
		 *
		 * Example:
		 * <code>
		 * //Allow access to guests to search on customers
		 * $acl->allow("guests", "customers", "search");
		 *
		 * //Allow access to guests to search or create on customers
		 * $acl->allow("guests", "customers", ["search", "create"]);
		 *
		 * //Allow access to any role to browse on products
		 * $acl->allow("*", "products", "browse");
		 *
		 * //Allow access to any role to browse on any resource
		 * $acl->allow("*", "*", "browse");
		 * </code>
		 */
		public function allow($roleName, $resourceName, $access, $func=null){ }


		/**
		 * Deny access to a role on a resource
		 *
		 * You can use '*' as wildcard
		 *
		 * Example:
		 * <code>
		 * //Deny access to guests to search on customers
		 * $acl->deny("guests", "customers", "search");
		 *
		 * //Deny access to guests to search or create on customers
		 * $acl->deny("guests", "customers", ["search", "create"]);
		 *
		 * //Deny access to any role to browse on products
		 * $acl->deny("*", "products", "browse");
		 *
		 * //Deny access to any role to browse on any resource
		 * $acl->deny("*", "*", "browse");
		 * </code>
		 */
		public function deny($roleName, $resourceName, $access, $func=null){ }


		/**
		 * Check whether a role is allowed to access an action from a resource
		 *
		 * <code>
		 * //Does andres have access to the customers resource to create?
		 * $acl->isAllowed("andres", "Products", "create");
		 *
		 * //Do guests have access to any resource to edit?
		 * $acl->isAllowed("guests", "*", "edit");
		 * </code>
		 *
		 * @param  RoleInterface|RoleAware|string roleName
		 * @param  ResourceInterface|ResourceAware|string resourceName
		 */
		public function isAllowed($roleName, $resourceName, $access, $parameters=null){ }


		/**
		 * Sets the default access level (Phalcon\Acl::ALLOW or \Phalcon\Acl::DENY)
		 * for no arguments provided in isAllowed action if there exists func for
		 * accessKey
		 */
		public function setNoArgumentsDefaultAction($defaultAccess){ }


		/**
		 * Returns the default ACL access level for no arguments provided in
		 * isAllowed action if there exists func for accessKey
		 */
		public function getNoArgumentsDefaultAction(){ }


		/**
		 * Return an array with every role registered in the list
		 */
		public function getRoles(){ }


		/**
		 * Return an array with every resource registered in the list
		 */
		public function getResources(){ }

	}
}
