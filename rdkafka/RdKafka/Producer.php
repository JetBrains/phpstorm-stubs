<?php

namespace RdKafka;

class Producer extends \RdKafka
{
    /**
     * @param null|Conf $conf
     */
    public function __construct(Conf $conf = null) {}

    /**
     * @param string    $topic_name
     * @param null|TopicConf $topic_conf
     *
     * @return ProducerTopic
     */
    public function newTopic($topic_name, ?TopicConf $topic_conf = null) {}

    /**
     * @param int $timeout_ms
     *
     * @return void
     */
    public function initTransactions(int $timeout_ms) {}

    /**
     * @return void
     */
    public function beginTransaction() {}

    /**
     * @param int $timeout_ms
     *
     * @return void
     */
    public function commitTransaction(int $timeout_ms) {}

    /**
     * @param int $timeout_ms
     *
     * @return void
     */
    public function abortTransaction(int $timeout_ms) {}
}
