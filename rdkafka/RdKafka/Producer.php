<?php

namespace RdKafka;

class Producer extends \RdKafka
{
    /**
     * @param Conf $conf
     */
    public function __construct(Conf $conf = null)
    {
    }

    /**
     * @param string    $topic_name
     * @param TopicConf $topic_conf
     *
     * @return ProducerTopic
     */
    public function newTopic($topic_name, TopicConf $topic_conf = null)
    {
    }

    /**
     * @param int $timeout_ms
     *
     * @return int
     */
    public function flush($timeout_ms)
    {
    }

    /**
     * @param int $purge_flags
     *
     * @return int
     */
    public function purge($purge_flags)
    {
    }
}
