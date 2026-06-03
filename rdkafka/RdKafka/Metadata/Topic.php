<?php

namespace RdKafka\Metadata;

class Topic
{
    private function __construct() {}

    /**
     * @return string
     */
    public function getTopic() {}

    /**
     * @return Partition[]
     */
    public function getPartitions() {}

    /**
     * @return mixed
     */
    public function getErr() {}
}
