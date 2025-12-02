<?php
/**
 * Helper autocomplete for php solr extension.
 *
 * @author Pierre-Julien Mazenot <pj.mazenot@gmail.com>
 * @link   https://github.com/pjmazenot/phpsolr-phpdoc
 */

/**
 * (PECL solr &gt;= 0.9.2)<br/>
 * Class SolrParams<br/>
 * This class represents a a collection of name-value pairs sent to the Solr server during a request.
 * @link https://php.net/manual/en/class.solrparams.php
 */
abstract class SolrParams implements Serializable
{
    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * This is an alias for SolrParams::addParam
     * @link https://php.net/manual/en/solrparams.add.php
     * @param string $name <p>
     * The name of the parameter
     * </p>
     * @param string $value <p>
     * The value of the parameter
     * </p>
     * @return SolrParams|false <p>
     * Returns a SolrParams instance on success and <b>FALSE</b> on failure.
     * </p>
     */
    final public function add(string $name, string $value): SolrParams|false {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Adds a parameter to the object
     * @link https://php.net/manual/en/solrparams.addparam.php
     * @param string $name <p>
     * The name of the parameter
     * </p>
     * @param string $value <p>
     * The value of the parameter
     * </p>
     * @return SolrParams|false <p>
     * Returns a SolrParams instance on success and <b>FALSE</b> on failure.
     * </p>
     */
    public function addParam(string $name, string $value): SolrParams|false {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * This is an alias for SolrParams::getParam
     * @link https://php.net/manual/en/solrparams.get.php
     * @param string $param_name <p>
     * The name of the parameter
     * </p>
     * @return mixed <p>
     * Returns an array or string depending on the type of parameter
     * </p>
     */
    final public function get(string $param_name): mixed {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Returns a parameter value
     * @link https://php.net/manual/en/solrparams.getparam.php
     * @param string $param_name <p>
     * The name of the parameter
     * </p>
     * @return mixed <p>
     * Returns an array or string depending on the type of parameter
     * </p>
     */
    final public function getParam(string $param_name): mixed {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Returns an array of non URL-encoded parameters
     * @link https://php.net/manual/en/solrparams.getparams.php
     * @return array <p>
     * Returns an array of non URL-encoded parameters
     * </p>
     */
    final public function getParams(): array {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Returns an array of URL-encoded parameters
     * @link https://php.net/manual/en/solrparams.getpreparedparams.php
     * @return array <p>
     * Returns an array of URL-encoded parameters
     * </p>
     */
    final public function getPreparedParams(): array {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Used for custom serialization
     * @link https://php.net/manual/en/solrparams.serialize.php
     * @return string <p>
     * Used for custom serialization
     * </p>
     */
    final public function serialize(): string {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * An alias of SolrParams::setParam
     * @link https://php.net/manual/en/solrparams.set.php
     * @param string $name <p>
     * The name of the parameter
     * </p>
     * @param string $value <p>
     * The parameter value
     * </p>
     * @return SolrParams|false <p>
     * Returns a SolrParams instance on success and <b>FALSE</b> on failure.
     * </p>
     */
    final public function set(string $name, string $value): void {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Sets the parameter to the specified value
     * @link https://php.net/manual/en/solrparams.setparam.php
     * @param string $name <p>
     * The name of the parameter
     * </p>
     * @param string $value <p>
     * The parameter value
     * </p>
     * @return SolrParams|false <p>
     * Returns a SolrParams instance on success and <b>FALSE</b> on failure.
     * </p>
     */
    public function setParam(string $name, string $value): SolrParams|false {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Returns all the name-value pair parameters in the object
     * @link https://php.net/manual/en/solrparams.tostring.php
     * @param bool $url_encode <p>
     * Whether to return URL-encoded values
     * </p>
     * @return string|false <p>
     * Returns a string on success and <b>FALSE</b> on failure.
     * </p>
     */
    final public function toString(bool $url_encode = false): string|false {}

    /**
     * (PECL solr &gt;= 0.9.2)<br/>
     * Used for custom serialization
     * @link https://php.net/manual/en/solrparams.unserialize.php
     * @param string $serialized <p>
     * The serialized representation of the object
     * </p>
     */
    final public function unserialize(string $serialized): void {}
}
