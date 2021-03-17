<?php

namespace RdKafka;

class KafkaErrorException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param string $errorString
     * @param bool $isFatal
     * @param bool $isRetriable
     * @param bool $transactionRequiresAbort
     */
    public function __construct($message, $code, $errorString, $isFatal, $isRetriable, $transactionRequiresAbort) {}

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
