<?php

namespace RdKafka;

use RdKafka\Metadata\Collection;
use RdKafka\Metadata\Topic;

class Metadata
{
    private function __construct() {}

    /**
     * @return Collection
     */
    public function getBrokers() {}

    /**
     * @return Collection|Topic[]
     */
    public function getTopics() {}

    /**
     * @return int
     */
    public function getOrigBrokerId() {}

    /**
     * @return string
     */
    public function getOrigBrokerName() {}
}
