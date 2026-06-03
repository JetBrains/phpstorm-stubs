<?php

namespace RdKafka\Metadata;

class Partition
{
    private function __construct() {}

    /**
     * @return int
     */
    public function getId() {}

    /**
     * @return mixed
     */
    public function getErr() {}

    /**
     * @return mixed
     */
    public function getLeader() {}

    /**
     * @return mixed
     */
    public function getReplicas() {}

    /**
     * @return mixed
     */
    public function getIsrs() {}
}
