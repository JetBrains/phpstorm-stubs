<?php

namespace RdKafka;

class ProducerTopic extends Topic
{
    private function __construct()
    {
    }

    /**
     * @param int         $partition
     * @param int         $msgflags
     * @param string|null $payload
     * @param string|null $key
     *
     * @return void
     */
    public function produce($partition, $msgflags, $payload = null, $key = null)
    {
    }

    /**
     * @param int         $partition
     * @param int         $msgflags
     * @param string|null $payload
     * @param string|null $key
     * @param array|null  $headers
     *
     * @return void
     */
    public function producev($partition, $msgflags, $payload = null, $key = null, $headers = null)
    {
    }
}
