<?php
/**
 * Created by PhpStorm.
 * User: zhimiao
 * Date: 2018/5/11
 * Time: 下午9:40
 */

class Yar_Server {
    /* 属性 */
    protected $_executor ;

    /**
     * Register a server
     * Set up a Yar HTTP RPC Server, All the public methods of $obj will be register as a RPC service.
     *
     * Yar_Server constructor.
     * @param $obj object An Object, all public methods of its will be registered as RPC services.
     * @return object An instance of Yar_Server.
     * @link http://php.net/manual/en/yar-server.construct.php
     */
    final public function __construct ($obj ) {}

    /**
     * Start RPC Server
     * Start a RPC HTTP server, and ready for accpet RPC requests.
     * Note:
     *  Usual RPC calls will be issued as HTTP POST requests.
     *  If a HTTP GET request is issued to the uri,
     *  the service information (commented section above) will be printed on the page
     * @return boolean
     * @link http://php.net/manual/en/yar-server.handle.php
     */
    public function handle () {}
}


class Yar_Client {
    /* 属性 */
    protected $_protocol ;
    protected $_uri ;
    protected $_options ;
    protected $_running ;

    /**
     * Call service
     * Issue a call to remote RPC method.
     *
     * @param $method string Remote RPC method name.
     * @param $parameters array Parameters.
     * @link http://php.net/manual/en/yar-client.call.php
     */
    public function __call ( $method , $parameters ){}

    /**
     * Create a client
     * Yar_Client constructor.
     * @param $url string Yar Server URL.
     * @return $instance object Yar_Client instance.
     * @link http://php.net/manual/en/yar-client.construct.php
     */
    final public function __construct ( $url ){}

    /**
     * Set calling contexts
     *
     * @param $name int it can be:
     * - YAR_OPT_PACKAGER,
     * - YAR_OPT_PERSISTENT (Need server support),
     * - YAR_OPT_TIMEOUT,
     * - YAR_OPT_CONNECT_TIMEOUT
     * - YAR_OPT_HEADER (Since 2.0.4)
     * @param $value
     * @return object Returns $this on success or FALSE on failure.
     * @link http://php.net/manual/en/yar-client.setopt.php
     */
    public function setOpt ($name , $value ){}
}

class Yar_Concurrent_Client {
    /* 属性 */
    static $_callstack ;
    static $_callback ;
    static $_error_callback ;

    /**
     * Register a concurrent call
     * @param $uri string The RPC server URI(http, tcp)
     * @param $method string Service name(aka the method name)
     * @param $parameters array Parameters
     * @param array ...$callback A function callback, which will be called while the response return.
     * @return $id int An unique id, can be used to identified which call it is.
     * @link http://php.net/manual/en/yar-concurrent-client.call.php
     */
    public static function call (  $uri ,  $method ,  $parameters, ...$callback ){}

    /**
     * Send all calls
     * @param $callback
     *  If this callback is set, then Yar will call this callback after all calls are sent and before any response return, with a $callinfo NULL.
     *  Then, if user didn't specify callback when registering concurrent call, this callback will be used to handle response, otherwise, the callback specified while registering will be used.
     * @param $error_callback
     *  If this callback is set, then Yar will call this callback while error occurred.
     * @return $bool boolean
     * @link http://php.net/manual/en/yar-concurrent-client.loop.php
     */
    public static function loop ($callback , $error_callback) {}

    /**
     * Clean all registered calls
     * Clean all registered calls
     * @return $bool bool
     * @link http://php.net/manual/en/yar-concurrent-client.reset.php
     */
    public static function reset (){}
}

/**
 * If service threw exceptions, A Yar_Server_Exception will be threw in client side.
 * Class Yar_Server_Exception
 */
class Yar_Server_Exception extends Exception {
    /* 属性 */
    protected $_type ;

    /**
     * Retrieve exception's type
     * Get the exception original type threw by server
     * @return $type string
     * @link http://php.net/manual/en/yar-server-exception.gettype.php
     */
    public function getType (){}

}

class Yar_Client_Exception extends Exception {
    /**
     * Retrieve exception's type
     * @return string "Yar_Exception_Client".
     * @link http://php.net/manual/en/yar-client-exception.gettype.php
     */
    public function getType (){}
}