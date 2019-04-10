<?php

namespace RdKafka;

use RdKafka\Metadata\Collection;
use RdKafka\Metadata\Topic;

class Metadata
{
    /**
     * @return \RdKafka\Metadata\Collection
     */
    public function getBrokers()
    {
    }

    /**
     * @return \RdKafka\Metadata\Collection|\RdKafka\Metadata\Topic[]
     */
    public function getTopics()
    {
    }

    /**
     * @return int
     */
    public function getOrigBrokerId()
    {
    }

    /**
     * @return string
     */
    public function getOrigBrokerName()
    {
    }
}
