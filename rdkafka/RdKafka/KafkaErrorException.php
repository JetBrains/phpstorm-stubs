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
     * @returns string
     */
    public function getErrorString()
    {
    }

    /**
     * @returns boolean
     */
    public function isFatal()
    {
    }

    /**
     * @returns boolean
     */
    public function isRetriable()
    {
    }

    /**
     * @returns boolean
     */
    public function transactionRequiresAbort()
    {
    }
}
