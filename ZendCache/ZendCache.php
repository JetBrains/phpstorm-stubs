<?php

// Start of Zend Cache v.

/**
 * Stores a serializable variable into Shared Memory Cache
 *
 * @param  $key   string the data's key. Possibly prefixed with namespace
 * @param  $value mixed can be any PHP object that can be serialized.
 * @param  $ttl   int  [optional] time to live in seconds. ZendCache keeps the objects in the cache as long as the TTL is no expired, once expired it will be removed from the cache
 *
 * @return bool FALSE when stored failed, TRUE otherwise
 */
function zend_shm_cache_store($key, $value, $ttl = 0) {}

/**
 * Retrieves data stored in the Shared Memory Cache.
 * If the key is not found, returns null.
 *
 * @param $key string the data's key. Possibly prefixed with namespace
 *
 * @return null|mixed NULL when no data matching the key is found, else it returns the stored data
 */
function zend_shm_cache_fetch($key) {}

/**
 * Delete a key from the Shared Memory cache
 *
 * @param $key string the data's key. Possibly prefixed with namespace
 *
 * @return null|mixed when no data matching the key is found, else it returns the stored data
 */
function zend_shm_cache_delete($key) {}

/**
 * Clear the entire Shared Memory cache or just the provided namespace.
 *
 * @param $namespace string [optional] Namespace to clear. If blank or is not passed, it will clear entire cache.
 *
 * @return bool TRUE on success, FALSE otherwise
 */
function zend_shm_cache_clear($namespace = '') {}

/**
 * Stores a serializable variable into Disk Cache
 *
 * @param  $key   string the data's key. Possibly prefixed with namespace
 * @param  $value mixed can be any PHP object that can be serialized
 * @param  $ttl [optional] int time to live in seconds. ZendCache keeps the objects in the cache as long as the TTL is no expired, once expired it will be removed from the cache
 *
 * @return bool FALSE when stored failed, TRUE otherwise
 */
function zend_disk_cache_store($key, $value, $ttl = 0) {}

/**
 * Retrieves data stored in the Shared Memory Cache
 *
 * @param $key string NULL when no data matching the key is found, else it returns the stored data
 *
 * @return null|mixed NULL when no data matching the key is found, else it returns the stored data
 */
function zend_disk_cache_fetch($key) {}

/**
 * Delete a key from the cache
 *
 * @param $key string the data's key. Possibly prefixed with namespace
 *
 * @return null|mixed when no data matching the key is found, else it returns the stored data
 */
function zend_disk_cache_delete($key) {}

/**
 * Clear the entire Disk Memory cache or just the provided namespace.
 *
 * @param $namespace string [optional] Namespace to clear. If blank or is not passed, it will clear entire cache.
 *
 * @return bool TRUE on success, FALSE otherwise
 */
function zend_disk_cache_clear($namespace = '') {}

// End of Zend Cache v.
