<?php
declare(strict_types=1);

use SimpleKafkaClient\Exception;
use SimpleKafkaClient\Metadata;
use SimpleKafkaClient\Topic;
use SimpleKafkaClient\TopicPartition;

abstract class SimpleKafkaClient
{
    /**
     * @param bool $allTopics
     * @param int $timeoutMs
     * @param Topic $topic
     * @return Metadata
     * @throws Exception
     */
    public function getMetadata(bool $allTopics, int $timeoutMs, Topic $topic): Metadata {}

    /**
     * @return int
     */
    public function getOutQLen(): int {}

    /**
     * @param int $timeoutMs
     * @return int
     */
    public function poll(int $timeoutMs): int {}

    /**
     * @param string $topic
     * @param int $partition
     * @param int $low is passed as reference, contains result after call
     * @param int $high is passed as reference, contains result after call
     * @param int $timeoutMs
     * @throws Exception
     */
    public function queryWatermarkOffsets(string $topic, int $partition, int &$low, int &$high, int $timeoutMs): void {}

    /**
     * @param TopicPartition[] $topicPartitions
     * @param int $timeoutMs
     * @return TopicPartition[]
     * @throws Exception
     */
    public function offsetsForTimes(array $topicPartitions, int $timeoutMs): array {}
}
