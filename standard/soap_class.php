<?php
/**
 * PHPStorm stub file for SOAP classes.
 *
 * @link http://php.net/manual/en/book.soap.php
 */

/**
 * The SoapClient class provides a client for SOAP 1.1, SOAP 1.2 servers. It can be used in WSDL
 * or non-WSDL mode.
 *
 * @link http://php.net/manual/en/class.soapclient.php
 */
class SoapClient
{
    /**
     * SoapClient constructor
     *
     * @link  http://php.net/manual/en/soapclient.soapclient.php
     *
     * @param mixed $wsdl    <p>
     *                       URI of the WSDL file or <b>NULL</b> if working in
     *                       non-WSDL mode.
     *                       </p>
     *                       <p>
     *                       During development, WSDL caching may be disabled by the
     *                       use of the soap.wsdl_cache_ttl <i>php.ini</i> setting
     *                       otherwise changes made to the WSDL file will have no effect until
     *                       soap.wsdl_cache_ttl is expired.
     *                       </p>
     * @param array $options [optional] <p>
     *                       An array of options. If working in WSDL mode, this parameter is optional.
     *                       If working in non-WSDL mode, the location and
     *                       uri options must be set, where location
     *                       is the URL of the SOAP server to send the request to, and uri
     *                       is the target namespace of the SOAP service.
     *                       </p>
     *                       <p>
     *                       The style and use options only work in
     *                       non-WSDL mode. In WSDL mode, they come from the WSDL file.
     *                       </p>
     *                       <p>
     *                       The soap_version option should be one of either
     *                       <b>SOAP_1_1</b> or <b>SOAP_1_2</b> to
     *                       select SOAP 1.1 or 1.2, respectively. If omitted, 1.1 is used.
     *                       </p>
     *                       <p>
     *                       For HTTP authentication, the login and
     *                       password options can be used to supply credentials.
     *                       For making an HTTP connection through
     *                       a proxy server, the options proxy_host,
     *                       proxy_port, proxy_login
     *                       and proxy_password are also available.
     *                       For HTTPS client certificate authentication use
     *                       local_cert and passphrase options. An
     *                       authentication may be supplied in the authentication
     *                       option. The authentication method may be either
     *                       <b>SOAP_AUTHENTICATION_BASIC</b> (default) or
     *                       <b>SOAP_AUTHENTICATION_DIGEST</b>.
     *                       </p>
     *                       <p>
     *                       The compression option allows to use compression
     *                       of HTTP SOAP requests and responses.
     *                       </p>
     *                       <p>
     *                       The encoding option defines internal character
     *                       encoding. This option does not change the encoding of SOAP requests (it is
     *                       always utf-8), but converts strings into it.
     *                       </p>
     *                       <p>
     *                       The trace option enables tracing of request so faults
     *                       can be backtraced. This defaults to <b>FALSE</b>
     *                       </p>
     *                       <p>
     *                       The classmap option can be used to map some WSDL
     *                       types to PHP classes. This option must be an array with WSDL types
     *                       as keys and names of PHP classes as values.
     *                       </p>
     *                       <p>
     *                       Setting the boolean trace option enables use of the
     *                       methods
     *                       SoapClient->__getLastRequest,
     *                       SoapClient->__getLastRequestHeaders,
     *                       SoapClient->__getLastResponse and
     *                       SoapClient->__getLastResponseHeaders.
     *                       </p>
     *                       <p>
     *                       The exceptions option is a boolean value defining whether
     *                       soap errors throw exceptions of type
     *                       SoapFault.
     *                       </p>
     *                       <p>
     *                       The connection_timeout option defines a timeout in seconds
     *                       for the connection to the SOAP service. This option does not define a timeout
     *                       for services with slow responses. To limit the time to wait for calls to finish the
     *                       default_socket_timeout setting
     *                       is available.
     *                       </p>
     *                       <p>
     *                       The typemap option is an array of type mappings.
     *                       Type mapping is an array with keys type_name,
     *                       type_ns (namespace URI), from_xml
     *                       (callback accepting one string parameter) and to_xml
     *                       (callback accepting one object parameter).
     *                       </p>
     *                       <p>
     *                       The cache_wsdl option is one of
     *                       <b>WSDL_CACHE_NONE</b>,
     *                       <b>WSDL_CACHE_DISK</b>,
     *                       <b>WSDL_CACHE_MEMORY</b> or
     *                       <b>WSDL_CACHE_BOTH</b>.
     *                       </p>
     *                       <p>
     *                       The user_agent option specifies string to use in
     *                       User-Agent header.
     *                       </p>
     *                       <p>
     *                       The stream_context option is a resource
     *                       for context.
     *                       </p>
     *                       <p>
     *                       The features option is a bitmask of
     *                       <b>SOAP_SINGLE_ELEMENT_ARRAYS</b>,
     *                       <b>SOAP_USE_XSI_ARRAY_TYPE</b>,
     *                       <b>SOAP_WAIT_ONE_WAY_CALLS</b>.
     *                       </p>
     *                       <p>
     *                       The keep_alive option is a boolean value defining whether
     *                       to send the Connection: Keep-Alive header or
     *                       Connection: close.
     *                       </p>
     *                       <p>
     *                       The ssl_method option is one of
     *                       <b>SOAP_SSL_METHOD_TLS</b>,
     *                       <b>SOAP_SSL_METHOD_SSLv2</b>,
     *                       <b>SOAP_SSL_METHOD_SSLv3</b> or
     *                       <b>SOAP_SSL_METHOD_SSLv23</b>.
     *                       </p>
     *
     * @since 5.0.1
     */
    public function __construct($wsdl, array $options = null) { }

    /**
     * Calls a SOAP function (deprecated)
     *
     * @link  http://php.net/manual/en/soapclient.call.php
     *
     * @param string $function_name
     * @param string $arguments
     *
     * @return mixed
     * @since 5.0.1
     */
    public function __call($function_name, $arguments) { }

    /**
     * Performs a SOAP request
     *
     * @link  http://php.net/manual/en/soapclient.dorequest.php
     *
     * @param string $request  <p>
     *                         The XML SOAP request.
     *                         </p>
     * @param string $location <p>
     *                         The URL to request.
     *                         </p>
     * @param string $action   <p>
     *                         The SOAP action.
     *                         </p>
     * @param int    $version  <p>
     *                         The SOAP version.
     *                         </p>
     * @param int    $one_way  [optional] <p>
     *                         If one_way is set to 1, this method returns nothing.
     *                         Use this where a response is not expected.
     *                         </p>
     *
     * @return string The XML SOAP response.
     * @since 5.0.1
     */
    public function __doRequest($request, $location, $action, $version, $one_way = 0) { }

    /**
     * Returns list of available SOAP functions
     *
     * @link  http://php.net/manual/en/soapclient.getfunctions.php
     * @return array The array of SOAP function prototypes, detailing the return type,
     * the function name and type-hinted paramaters.
     * @since 5.0.1
     */
    public function __getFunctions() { }

    /**
     * Returns last SOAP request
     *
     * @link  http://php.net/manual/en/soapclient.getlastrequest.php
     * @return string The last SOAP request, as an XML string.
     * @since 5.0.1
     */
    public function __getLastRequest() { }

    /**
     * Returns the SOAP headers from the last request
     *
     * @link  http://php.net/manual/en/soapclient.getlastrequestheaders.php
     * @return string The last SOAP request headers.
     * @since 5.0.1
     */
    public function __getLastRequestHeaders() { }

    /**
     * Returns last SOAP response
     *
     * @link  http://php.net/manual/en/soapclient.getlastresponse.php
     * @return string The last SOAP response, as an XML string.
     * @since 5.0.1
     */
    public function __getLastResponse() { }

    /**
     * Returns the SOAP headers from the last response
     *
     * @link  http://php.net/manual/en/soapclient.getlastresponseheaders.php
     * @return string The last SOAP response headers.
     * @since 5.0.1
     */
    public function __getLastResponseHeaders() { }

    /**
     * Returns a list of SOAP types
     *
     * @link  http://php.net/manual/en/soapclient.gettypes.php
     * @return array The array of SOAP types, detailing all structures and types.
     * @since 5.0.1
     */
    public function __getTypes() { }

    /**
     * The __setCookie purpose
     *
     * @link  http://php.net/manual/en/soapclient.setcookie.php
     *
     * @param string $name  <p>
     *                      The name of the cookie.
     *                      </p>
     * @param string $value [optional] <p>
     *                      The value of the cookie. If not specified, the cookie will be deleted.
     *                      </p>
     *
     * @return void No value is returned.
     * @since 5.0.4
     */
    public function __setCookie($name, $value = null) { }

    /**
     * Sets the location of the Web service to use
     *
     * @link  http://php.net/manual/en/soapclient.setlocation.php
     *
     * @param string $new_location [optional] <p>
     *                             The new endpoint URL.
     *                             </p>
     *
     * @return string The old endpoint URL.
     * @since 5.0.1
     */
    public function __setLocation($new_location = null) { }

    /**
     * Sets SOAP headers for subsequent calls
     *
     * @link  http://php.net/manual/en/soapclient.setsoapheaders.php
     *
     * @param mixed $soapheaders [optional] <p>
     *                           The headers to be set. It could be <b>SoapHeader</b>
     *                           object or array of <b>SoapHeader</b> objects.
     *                           If not specified or set to <b>NULL</b>, the headers will be deleted.
     *                           </p>
     *
     * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
     * @since 5.0.5
     */
    public function __setSoapHeaders($soapheaders = null) { }

    /**
     * Calls a SOAP function
     *
     * @link  http://php.net/manual/en/soapclient.soapcall.php
     *
     * @param string $function_name  <p>
     *                               The name of the SOAP function to call.
     *                               </p>
     * @param array  $arguments      <p>
     *                               An array of the arguments to pass to the function. This can be either
     *                               an ordered or an associative array. Note that most SOAP servers require
     *                               parameter names to be provided, in which case this must be an
     *                               associative array.
     *                               </p>
     * @param array  $options        [optional] <p>
     *                               An associative array of options to pass to the client.
     *                               </p>
     *                               <p>
     *                               The location option is the URL of the remote Web service.
     *                               </p>
     *                               <p>
     *                               The uri option is the target namespace of the SOAP service.
     *                               </p>
     *                               <p>
     *                               The soapaction option is the action to call.
     *                               </p>
     * @param mixed  $input_headers  [optional] <p>
     *                               An array of headers to be sent along with the SOAP request.
     *                               </p>
     * @param array  $output_headers [optional] <p>
     *                               If supplied, this array will be filled with the headers from the SOAP response.
     *                               </p>
     *
     * @return mixed SOAP functions may return one, or multiple values. If only one value is returned
     * by the SOAP function, the return value of __soapCall will be
     * a simple value (e.g. an integer, a string, etc). If multiple values are
     * returned, __soapCall will return
     * an associative array of named output parameters.
     * </p>
     * <p>
     * On error, if the SoapClient object was constructed with the exceptions
     * option set to <b>FALSE</b>, a SoapFault object will be returned.
     * @since 5.0.1
     */
    public function __soapCall(
        $function_name,
        array $arguments,
        array $options = null,
        $input_headers = null,
        array &$output_headers = null
    ) {
    }
}

/**
 * Represents a SOAP fault.
 *
 * @link http://php.net/manual/en/class.soapfault.php
 */
class SoapFault extends Exception
{
    /**
     * SoapFault constructor
     *
     * @link  http://php.net/manual/en/soapfault.soapfault.php
     *
     * @param string $faultcode   <p>
     *                            The error code of the <b>SoapFault</b>.
     *                            </p>
     * @param string $faultstring <p>
     *                            The error message of the <b>SoapFault</b>.
     *                            </p>
     * @param string $faultactor  [optional] <p>
     *                            A string identifying the actor that caused the error.
     *                            </p>
     * @param string $detail      [optional] <p>
     *                            More details about the cause of the error.
     *                            </p>
     * @param string $faultname   [optional] <p>
     *                            Can be used to select the proper fault encoding from WSDL.
     *                            </p>
     * @param string $headerfault [optional] <p>
     *                            Can be used during SOAP header handling to report an error in the
     *                            response header.
     *                            </p>
     *
     * @since 5.0.1
     */
    public function __construct(
        $faultcode,
        $faultstring,
        $faultactor = null,
        $detail = null,
        $faultname = null,
        $headerfault = null
    ) {
    }
}

/**
 * Represents a SOAP header.
 *
 * @link http://php.net/manual/en/class.soapheader.php
 */
class SoapHeader
{
    /**
     * SoapHeader constructor
     *
     * @link  http://php.net/manual/en/soapheader.soapheader.php
     *
     * @param string $namespace      <p>
     *                               The namespace of the SOAP header element.
     *                               </p>
     * @param string $name           <p>
     *                               The name of the SoapHeader object.
     *                               </p>
     * @param mixed  $data           [optional] <p>
     *                               A SOAP header's content. It can be a PHP value or a
     *                               <b>SoapVar</b> object.
     *                               </p>
     * @param bool   $mustunderstand [optional]
     * @param string $actor          [optional] <p>
     *                               Value of the actor attribute of the SOAP header
     *                               element.
     *                               </p>
     *
     * @since 5.0.1
     */
    public function __construct($namespace, $name, $data = null, $mustunderstand = false, $actor = null) { }
}

/**
 * Represents parameter to a SOAP call.
 *
 * @link http://php.net/manual/en/class.soapparam.php
 */
class SoapParam
{
    /**
     * SoapParam constructor
     *
     * @link  http://php.net/manual/en/soapparam.soapparam.php
     *
     * @param mixed  $data <p>
     *                     The data to pass or return. This parameter can be passed directly as PHP
     *                     value, but in this case it will be named as paramN and
     *                     the SOAP service may not understand it.
     *                     </p>
     * @param string $name <p>
     *                     The parameter name.
     *                     </p>
     *
     * @since 5.0.1
     */
    public function __construct($data, $name) { }
}

/**
 * The SoapServer class provides a server for the SOAP 1.1 and SOAP 1.2 protocols. It can be used with or without a
 * WSDL service description.
 *
 * @link http://php.net/manual/en/class.soapserver.php
 */
class SoapServer
{
    /**
     * SoapServer constructor
     *
     * @link  http://php.net/manual/en/soapserver.soapserver.php
     *
     * @param mixed $wsdl    <p>
     *                       To use the SoapServer in WSDL mode, pass the URI of a WSDL file.
     *                       Otherwise, pass <b>NULL</b> and set the uri option to the
     *                       target namespace for the server.
     *                       </p>
     * @param array $options [optional] <p>
     *                       Allow setting a default SOAP version (soap_version),
     *                       internal character encoding (encoding),
     *                       and actor URI (actor).
     *                       </p>
     *                       <p>
     *                       The classmap option can be used to map some WSDL
     *                       types to PHP classes. This option must be an array with WSDL types
     *                       as keys and names of PHP classes as values.
     *                       </p>
     *                       <p>
     *                       The typemap option is an array of type mappings.
     *                       Type mapping is an array with keys type_name,
     *                       type_ns (namespace URI), from_xml
     *                       (callback accepting one string parameter) and to_xml
     *                       (callback accepting one object parameter).
     *                       </p>
     *                       <p>
     *                       The cache_wsdl option is one of
     *                       <b>WSDL_CACHE_NONE</b>,
     *                       <b>WSDL_CACHE_DISK</b>,
     *                       <b>WSDL_CACHE_MEMORY</b> or
     *                       <b>WSDL_CACHE_BOTH</b>.
     *                       </p>
     *                       <p>
     *                       There is also a features option which can be set to
     *                       <b>SOAP_WAIT_ONE_WAY_CALLS</b>,
     *                       <b>SOAP_SINGLE_ELEMENT_ARRAYS</b>,
     *                       <b>SOAP_USE_XSI_ARRAY_TYPE</b>.
     *                       </p>
     *
     * @since 5.0.1
     */
    public function __construct($wsdl, array $options = null) { }

    /**
     * Adds one or more functions to handle SOAP requests
     *
     * @link  http://php.net/manual/en/soapserver.addfunction.php
     *
     * @param mixed $functions <p>
     *                         To export one function, pass the function name into this parameter as
     *                         a string.
     *                         </p>
     *                         <p>
     *                         To export several functions, pass an array of function names.
     *                         </p>
     *                         <p>
     *                         To export all the functions, pass a special constant <b>SOAP_FUNCTIONS_ALL</b>.
     *                         </p>
     *                         <p>
     *                         <i>functions</i> must receive all input arguments in the same
     *                         order as defined in the WSDL file (They should not receive any output parameters
     *                         as arguments) and return one or more values. To return several values they must
     *                         return an array with named output parameters.
     *                         </p>
     *
     * @return void No value is returned.
     * @since 5.0.1
     */
    public function addFunction($functions) { }

    /**
     * Add a SOAP header to the response
     *
     * @link  http://php.net/manual/en/soapserver.addsoapheader.php
     *
     * @param SoapHeader $object <p>
     *                           The header to be returned.
     *                           </p>
     *
     * @return void No value is returned.
     * @since 5.0.1
     */
    public function addSoapHeader(SoapHeader $object) { }

    /**
     * Issue SoapServer fault indicating an error
     *
     * @link  http://php.net/manual/en/soapserver.fault.php
     *
     * @param string $code    <p>
     *                        The error code to return
     *                        </p>
     * @param string $string  <p>
     *                        A brief description of the error
     *                        </p>
     * @param string $actor   [optional] <p>
     *                        A string identifying the actor that caused the fault.
     *                        </p>
     * @param string $details [optional] <p>
     *                        More details of the fault
     *                        </p>
     * @param string $name    [optional] <p>
     *                        The name of the fault. This can be used to select a name from a WSDL file.
     *                        </p>
     *
     * @return void No value is returned.
     * @since 5.0.1
     */
    public function fault($code, $string, $actor = null, $details = null, $name = null) { }

    /**
     * Returns list of defined functions
     *
     * @link  http://php.net/manual/en/soapserver.getfunctions.php
     * @return array An array of the defined functions.
     * @since 5.0.1
     */
    public function getFunctions() { }

    /**
     * Handles a SOAP request
     *
     * @link  http://php.net/manual/en/soapserver.handle.php
     *
     * @param string $soap_request [optional] <p>
     *                             The SOAP request. If this argument is omitted, the request is assumed to be
     *                             in the raw POST data of the HTTP request.
     *                             </p>
     *
     * @return void No value is returned.
     * @since 5.0.1
     */
    public function handle($soap_request = null) { }

    /**
     * Sets the class which handles SOAP requests
     *
     * @link  http://php.net/manual/en/soapserver.setclass.php
     *
     * @param string $class_name <p>
     *                           The name of the exported class.
     *                           </p>
     * @param mixed  $args       [optional] <p>
     *                           These optional parameters will be passed to the default class constructor
     *                           during object creation.
     *                           </p>
     * @param mixed  $_          [optional]
     *
     * @return void No value is returned.
     * @since 5.0.1
     */
    public function setClass($class_name, $args = null, $_ = null) { }

    /**
     * Sets the object which will be used to handle SOAP requests
     *
     * @link  http://php.net/manual/en/soapserver.setobject.php
     *
     * @param object $object <p>
     *                       The object to handle the requests.
     *                       </p>
     *
     * @return void No value is returned.
     * @since 5.2.0
     */
    public function setObject($object) { }

    /**
     * Sets SoapServer persistence mode
     *
     * @link  http://php.net/manual/en/soapserver.setpersistence.php
     *
     * @param int $mode <p>
     *                  One of the SOAP_PERSISTENCE_XXX constants.
     *                  </p>
     *                  <p>
     *                  <b>SOAP_PERSISTENCE_REQUEST</b> - SoapServer data does not persist between
     *                  requests. This is the default behavior of any SoapServer
     *                  object after setClass is called.
     *                  </p>
     *                  <p>
     *                  <b>SOAP_PERSISTENCE_SESSION</b> - SoapServer data persists between requests.
     *                  This is accomplished by serializing the SoapServer class data into
     *                  $_SESSION['_bogus_session_name'], because of this
     *                  <b>session_start</b> must be called before this persistence mode is set.
     *                  </p>
     *
     * @return void No value is returned.
     * @since 5.1.2
     */
    public function setPersistence($mode) { }
}

/**
 * A class representing a variable or object for use with SOAP services.
 *
 * @link http://php.net/manual/en/class.soapvar.php
 */
class SoapVar
{
    /**
     * SoapVar constructor
     *
     * @link  http://php.net/manual/en/soapvar.soapvar.php
     *
     * @param mixed  $data           <p>
     *                               The data to pass or return.
     *                               </p>
     * @param string $encoding       <p>
     *                               The encoding ID, one of the XSD_... constants.
     *                               </p>
     * @param string $type_name      [optional] <p>
     *                               The type name.
     *                               </p>
     * @param string $type_namespace [optional] <p>
     *                               The type namespace.
     *                               </p>
     * @param string $node_name      [optional] <p>
     *                               The XML node name.
     *                               </p>
     * @param string $node_namespace [optional] <p>
     *                               The XML node namespace.
     *                               </p>
     *
     * @since 5.0.1
     */
    public function __construct(
        $data,
        $encoding,
        $type_name = null,
        $type_namespace = null,
        $node_name = null,
        $node_namespace = null
    ) {
    }
}
