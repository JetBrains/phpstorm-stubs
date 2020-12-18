<?php

namespace RdKafka;

class KafkaErrorException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param string $errorString
     * @param boolean $isFatal
     * @param boolean $isRetriable
     * @param boolean $transactionRequiresAbort
     */
    public function __construct($message, $code, $errorString, $isFatal, $isRetriable, $transactionRequiresAbort)
    {
    }

    /**
     * @return string
     */
    public function getErrorString()
    {
    }

    /**
     * @return boolean
     */
    public function isFatal()
    {
    }

    /**
     * @return boolean
     */
    public function isRetriable()
    {
    }

    /**
     * @return boolean
     */
    public function transactionRequiresAbort()
    {
    }
}
