<?php

namespace RdKafka;

class KafkaConsumer
{
    /**
     * @param Conf $conf
     */
    public function __construct(Conf $conf) {}

    /**
     * @param TopicPartition[] $topic_partitions
     *
     * @return void
     * @throws Exception
     */
    public function assign($topic_partitions = null) {}

    /**
     * @param null|Message|TopicPartition[] $message_or_offsets
     *
     * @return void
     * @throws Exception
     */
    public function commit($message_or_offsets = null) {}

    /**
     * @param null|Message|TopicPartition[] $message_or_offsets
     *
     * @return void
     * @throws Exception
     */
    public function commitAsync($message_or_offsets = null) {}

    /**
     * @param int $timeout_ms
     *
     * @return Message
     * @throws \InvalidArgumentException
     * @throws Exception
     */
    public function consume($timeout_ms) {}

    /**
     * @return TopicPartition[]
     * @throws Exception
     */
    public function getAssignment() {}

    /**
     * @param bool $all_topics
     * @param KafkaConsumerTopic $only_topic
     * @param int $timeout_ms
     *
     * @return Metadata
     * @throws Exception
     */
    public function getMetadata($all_topics, $only_topic = null, $timeout_ms) {}

    /**
     * @return array
     */
    public function getSubscription() {}

    /**
     * @param array $topics
     *
     * @return void
     * @throws Exception
     */
    public function subscribe($topics) {}

    /**
     * @return void
     * @throws Exception
     */
    public function unsubscribe() {}

    /**
     * @param array $topic_partitions
     * @param int $timeout_ms
     *
     * @return array
     */
    public function getCommittedOffsets(array $topic_partitions, int $timeout_ms) {}

    /**
     * @param TopicPartition[] $topic_partitions
     * @param int $timeout_ms
     *
     * @return TopicPartition[]
     */
    public function offsetsForTimes(array $topic_partitions, int $timeout_ms) {}

    /**
     * @param string $topic
     * @param int $partition
     * @param int &$low
     * @param int &$high
     * @param int $timeout_ms
     *
     * @return void
     */
    public function queryWatermarkOffsets(string $topic, int $partition = 0, int &$low = 0, int &$high = 0, int $timeout_ms = 0) {}

    /**
     * @param TopicPartition[] $topic_partitions
     */
    public function getOffsetPositions(array $topic_partitions) {}

    /**
     * @param string $topic_name
     * @param null|TopicConf $topic_conf
     *
     * @return Topic
     */
    public function newTopic($topic_name, ?TopicConf $topic_conf = null) {}

    /**
     * @return void
     */
    public function close() {}
}
