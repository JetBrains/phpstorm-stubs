<?php

namespace RdKafka;

class ProducerTopic extends Topic
{
    private function __construct()
    {
    }

    /**
     * @param int    $partition
     * @param int    $msgflags
     * @param string $payload
     * @param string $key
     *
     * @return void
     */
    public function produce($partition, $msgflags, $payload, $key = null)
    {
    }
}
