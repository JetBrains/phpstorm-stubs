<?php

/**
 * @author neeke@php.net
 * Date: 14-1-27 下午4:47
 */
class SeasLog {
    public function __construct() {
        #SeasLog init
    }

    public function __destruct() {
        #SeasLog distroy
    }

    /**
     * 设置basePath
     *
     * @param $basePath
     *
     * @return bool
     */
    static public function setBasePath($basePath) {
        return true;
    }

    /**
     * 获取basePath
     *
     * @return string
     */
    static public function getBasePath() {
        return 'the base_path';
    }

    /**
     * 设置模块目录
     *
     * @param $module
     *
     * @return bool
     */
    static public function setLogger($module) {
        return true;
    }

    /**
     * 获取最后一次设置的模块目录
     *
     * @return string
     */
    static public function getLastLogger() {
        return 'the lastLogger';
    }

    /**
     * 设置DatetimeFormat配置
     *
     * @param $format
     *
     * @return bool
     */
    static public function setDatetimeFormat($format) {
        return true;
    }

    /**
     * 返回当前DatetimeFormat配置格式
     *
     * @return string
     */
    static public function getDatetimeFormat() {
        return 'the datetimeFormat';
    }

    /**
     * 统计所有类型（或单个类型）行数
     *
     * @param string $level
     * @param string $log_path
     * @param null   $key_word
     *
     * @return array | long
     */
    static public function analyzerCount($level = 'all', $log_path = '*', $key_word = null) {
        return [];
    }

    /**
     * 以数组形式，快速取出某类型log的各行详情
     *
     * @param        $level
     * @param string $log_path
     * @param null   $key_word
     * @param int    $start
     * @param int    $limit
     * @param        $order
     *
     * @return array
     */
    static public function analyzerDetail($level = SEASLOG_INFO, $log_path = '*', $key_word = null, $start = 1, $limit = 20, $order = SEASLOG_DETIAL_ORDER_ASC) {
        return [];
    }

    /**
     * 获得当前日志buffer中的内容
     *
     * @return array
     */
    static public function getBuffer() {
        return [];
    }

    /**
     * 将buffer中的日志立刻刷到硬盘
     *
     * @return bool
     */
    static public function flushBuffer() {
        return true;
    }

    /**
     * 记录debug日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function debug($message, array $content = [], $module = '') {
        #$level = SEASLOG_DEBUG
    }

    /**
     * 记录info日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function info($message, array $content = [], $module = '') {
        #$level = SEASLOG_INFO
    }

    /**
     * 记录notice日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function notice($message, array $content = [], $module = '') {
        #$level = SEASLOG_NOTICE
    }

    /**
     * 记录warning日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function warning($message, array $content = [], $module = '') {
        #$level = SEASLOG_WARNING
    }

    /**
     * 记录error日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function error($message, array $content = [], $module = '') {
        #$level = SEASLOG_ERROR
    }

    /**
     * 记录critical日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function critical($message, array $content = [], $module = '') {
        #$level = SEASLOG_CRITICAL
    }

    /**
     * 记录alert日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function alert($message, array $content = [], $module = '') {
        #$level = SEASLOG_ALERT
    }

    /**
     * 记录emergency日志
     *
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function emergency($message, array $content = [], $module = '') {
        #$level = SEASLOG_EMERGENCY
    }

    /**
     * 通用日志方法
     *
     * @param        $level
     * @param        $message
     * @param array  $content
     * @param string $module
     */
    static public function log($level, $message, array $content = [], $module = '') {
    }
}