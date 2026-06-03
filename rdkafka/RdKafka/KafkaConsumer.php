<?php

namespace RdKafka;

use JetBrains\PhpStorm\Internal\TentativeType;

class KafkaConsumer
{
    /**
     * @var callable|null
     */
    private $error_cb;

    /**
     * @var callable|null
     */
    private $rebalance_cb;

    /**
     * @var callable|null
     */
    private $dr_msg_cb;

    /**
     * @param Conf $conf
     */
    public function __construct($conf) {}

    /**
     * @param TopicPartition[] $topic_partitions
     *
     * @throws Exception
     * @return void
     */
    public function assign($topic_partitions = null) {}

    #[TentativeType]
    public function incrementalAssign(array $topic_partitions): void {}

    #[TentativeType]
    public function incrementalUnassign(array $topic_partitions): void {}

    /**
     * @param null|Message|TopicPartition[] $message_or_offsets
     *
     * @throws Exception
     * @return void
     */
    public function commit($message_or_offsets = null) {}

    /**
     * @param null|Message|TopicPartition[] $message_or_offsets
     *
     * @throws Exception
     * @return void
     */
    public function commitAsync($message_or_offsets = null) {}

    /**
     * @param int $timeout_ms
     *
     * @throws Exception
     * @throws \InvalidArgumentException
     * @return Message
     */
    public function consume($timeout_ms) {}

    /**
     * @throws Exception
     * @return TopicPartition[]
     */
    public function getAssignment() {}

    /**
     * @param bool               $all_topics
     * @param null|KafkaConsumerTopic $only_topic
     * @param int                $timeout_ms
     *
     * @throws Exception
     * @return Metadata
     */
    public function getMetadata($all_topics, $only_topic = null, $timeout_ms) {}

    /**
     * @return array
     */
    public function getSubscription() {}

    /**
     * @param array $topics
     *
     * @throws Exception
     * @return void
     */
    public function subscribe($topics) {}

    /**
     * @throws Exception
     * @return void
     */
    public function unsubscribe() {}

    /**
     * @param array $topic_partitions
     * @param int   $timeout_ms
     *
     * @return array
     */
    public function getCommittedOffsets($topic_partitions, $timeout_ms) {}

    /**
     * @param TopicPartition[] $topic_partitions
     * @param int $timeout_ms
     *
     * @return TopicPartition[]
     */
    public function offsetsForTimes($topic_partitions, $timeout_ms) {}

    /**
     * @param string $topic
     * @param int $partition
     * @param int &$low
     * @param int &$high
     * @param int $timeout_ms
     *
     * @return void
     */
    public function queryWatermarkOffsets($topic, $partition = 0, &$low = 0, &$high = 0, $timeout_ms = 0) {}

    /**
     * @param TopicPartition[] $topic_partitions
     */
    public function getOffsetPositions($topic_partitions) {}

    /**
     * @param string    $topic_name
     * @param null|TopicConf $topic_conf
     *
     * @return KafkaConsumerTopic
     */
    public function newTopic($topic_name, $topic_conf = null) {}

    #[TentativeType]
    public function getControllerId(int $timeout_ms): int {}

    #[TentativeType]
    public function pausePartitions(array $topic_partitions): array {}

    #[TentativeType]
    public function resumePartitions(array $topic_partitions): array {}

    #[TentativeType]
    public function poll(int $timeout_ms): int {}

    #[TentativeType]
    public function oauthbearerSetToken(string $token_value, int $lifetime_ms, string $principal_name, array $extensions = []): void {}

    #[TentativeType]
    public function oauthbearerSetTokenFailure(string $error): void {}

    /**
     * @return void
     */
    public function close() {}
}
