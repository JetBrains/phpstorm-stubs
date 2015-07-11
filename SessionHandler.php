<?php
/**
 * PHP >= 5.4.0<br/>
 * <b>SessionHandlerInterface</b> is an interface which defines
 * a prototype for creating a custom session handler.
 * In order to pass a custom session handler to
 * session_set_save_handler() using its OOP invocation,
 * the class must implement this interface.
 * @link http://php.net/manual/en/class.sessionhandlerinterface.php
 */
interface SessionHandlerInterface {

	/**
	 * PHP >= 5.4.0<br/>
	 * Close the session
	 * @link http://php.net/manual/en/sessionhandlerinterface.close.php
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function close();

	/**
	 * PHP >= 5.4.0<br/>
	 * Destroy a session
	 * @link http://php.net/manual/en/sessionhandlerinterface.destroy.php
	 * @param string $session_id The session ID being destroyed.
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function destroy($session_id);

	/**
	 * PHP >= 5.4.0<br/>
	 * Cleanup old sessions
	 * @link http://php.net/manual/en/sessionhandlerinterface.gc.php
	 * @param int $maxlifetime <p>
	 * Sessions that have not updated for
	 * the last maxlifetime seconds will be removed.
	 * </p>
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function gc($maxlifetime);

	/**
	 * PHP >= 5.4.0<br/>
	 * Initialize session
	 * @link http://php.net/manual/en/sessionhandlerinterface.open.php
	 * @param string $save_path The path where to store/retrieve the session.
	 * @param string $session_id The session id.
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function open($save_path, $session_id);


	/**
	 * PHP >= 5.4.0<br/>
	 * Read session data
	 * @link http://php.net/manual/en/sessionhandlerinterface.read.php
	 * @param string $session_id The session id to read data for.
	 * @return string <p>
	 * Returns an encoded string of the read data.
	 * If nothing was read, it must return an empty string.
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function read($session_id);

	/**
	 * PHP >= 5.4.0<br/>
	 * Write session data
	 * @link http://php.net/manual/en/sessionhandlerinterface.write.php
	 * @param string $session_id The session id.
	 * @param string $session_data <p>
	 * The encoded session data. This data is the
	 * result of the PHP internally encoding
	 * the $_SESSION superglobal to a serialized
	 * string and passing it as this parameter.
	 * Please note sessions use an alternative serialization method.
	 * </p>
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function write($session_id, $session_data);
}

/**
 * PHP >= 5.4.0<br/>
 * <b>SessionHandler</b> a special class that can
 * be used to expose the current internal PHP session
 * save handler by inheritance. There are six methods
 * which wrap the six internal session save handler
 * callbacks (open, close, read, write, destroy and gc).
 * By default, this class will wrap whatever internal
 * save handler is set as as defined by the
 * session.save_handler configuration directive which is usually
 * files by default. Other internal session save handlers are provided by
 * PHP extensions such as SQLite (as sqlite),
 * Memcache (as memcache), and Memcached (as memcached).
 * @link http://php.net/manual/en/class.reflectionzendextension.php
 */
class SessionHandler implements SessionHandlerInterface {

	/**
	 * PHP >= 5.4.0<br/>
	 * Close the session
	 * @link http://php.net/manual/en/sessionhandler.close.php
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function close() { }

	/**
	 * PHP >= 5.4.0<br/>
	 * Destroy a session
	 * @link http://php.net/manual/en/sessionhandler.destroy.php
	 * @param string $session_id The session ID being destroyed.
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function destroy($session_id) { }

	/**
	 * PHP >= 5.4.0<br/>
	 * Cleanup old sessions
	 * @link http://php.net/manual/en/sessionhandler.gc.php
	 * @param int $maxlifetime <p>
	 * Sessions that have not updated for
	 * the last maxlifetime seconds will be removed.
	 * </p>
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function gc($maxlifetime) { }

	/**
	 * PHP >= 5.4.0<br/>
	 * Initialize session
	 * @link http://php.net/manual/en/sessionhandler.open.php
	 * @param string $save_path The path where to store/retrieve the session.
	 * @param string $session_id The session id.
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function open($save_path, $session_id) { }


	/**
	 * PHP >= 5.4.0<br/>
	 * Read session data
	 * @link http://php.net/manual/en/sessionhandler.read.php
	 * @param string $session_id The session id to read data for.
	 * @return string <p>
	 * Returns an encoded string of the read data.
	 * If nothing was read, it must return an empty string.
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function read($session_id) { }

	/**
	 * PHP >= 5.4.0<br/>
	 * Write session data
	 * @link http://php.net/manual/en/sessionhandler.write.php
	 * @param string $session_id The session id.
	 * @param string $session_data <p>
	 * The encoded session data. This data is the
	 * result of the PHP internally encoding
	 * the $_SESSION superglobal to a serialized
	 * string and passing it as this parameter.
	 * Please note sessions use an alternative serialization method.
	 * </p>
	 * @return bool <p>
	 * The return value (usually TRUE on success, FALSE on failure).
	 * Note this value is returned internally to PHP for processing.
	 * </p>
	 */
	public function write($session_id, $session_data) { }
}
