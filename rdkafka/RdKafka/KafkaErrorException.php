<?php

namespace RdKafka;

class KafkaErrorException extends Exception
{
    private string $error_string;
    private bool $isFatal;
    private bool $isRetriable;
    private bool $transactionRequiresAbort;

    /**
     * @param string $message
     * @param int $code
     * @param string $error_string
     * @param bool $isFatal
     * @param bool $isRetriable
     * @param bool $transactionRequiresAbort
     */
    public function __construct($message, $code, $error_string, $isFatal, $isRetriable, $transactionRequiresAbort) {}

    /**
     * @return string
     */
    public function getErrorString() {}

    /**
     * @return bool
     */
    public function isFatal() {}

    /**
     * @return bool
     */
    public function isRetriable() {}

    /**
     * @return bool
     */
    public function transactionRequiresAbort() {}
}
