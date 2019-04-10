<?php

namespace RdKafka;

class Producer extends \RdKafka
{
    /**
     * @param \RdKafka\Conf $conf
     */
    public function __construct(Conf $conf = null)
    {
    }

    /**
     * @param string    $topic_name
     * @param \RdKafka\TopicConf $topic_conf
     *
     * @return \RdKafka\ProducerTopic
     */
    public function newTopic($topic_name, TopicConf $topic_conf = null)
    {
    }
}
