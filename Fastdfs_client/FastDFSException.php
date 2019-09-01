<?php


/**
*FastDFS客户端异常类
*/
class FastDFSException extends RuntimeException
{
    /**
     * @var string $message 
     * 异常错误信息
     * @access protected
     */
    protected $message    =    '';

    /**
     * @var int $code 
     * 异常错误码
     * @access protected
     */
    protected $code    =    0;

    /**
     * @var string $file 
     * 错误文件位置
     * @access protected
     */
    protected $file;

    /**
     * @var int $line 
     * 错误文件行数
     * @access protected
     */
    protected $line;

    /**
     * 
     *克隆魔术方法(这里禁止克隆)
     * @example 
     * @return 
     */
    private final  function __clone()
    {
    }

    /**
     * 
     *异常初始化
     * @example 
     * @param string $message 异常提示信息
     * @param int $code 异常错误码
     * @param Throwable $previous 异常链中的前一个异常
     * @return 
     */
    public function __construct($message, $code, $previous)
    {
    }

    /**
     * 
     *反序列化函数调用的魔术方法(unserialize() 从字节流中创建了一个对象之后,马上检查是否具有__wakeup 的函数的存在。如果存在，__wakeup 立刻被调用。使用 __wakeup 的目的是重建在序列化中可能丢失的任何数据库连接以及处理其它重新初始化的任务)
     * @example 
     * @return 
     */
    public function __wakeup()
    {
    }

    /**
     * 
     *获取异常提示信息
     * @example 
     * @return string
     */
    public final  function getMessage()
    {
    }

    /**
     * 
     *获取异常代码
     * @example 
     * @return int
     */
    public final  function getCode()
    {
    }

    /**
     * 
     *创建异常时的程序文件名称
     * @example 
     * @return string
     */
    public final  function getFile()
    {
    }

    /**
     * 
     *获取创建的异常所在文件中的行号
     * @example 
     * @return int
     */
    public final  function getLine()
    {
    }

    /**
     * 
     *获取异常追踪信息
     * @example 
     * @return array
     */
    public final  function getTrace()
    {
    }

    /**
     * 
     *返回异常链中的前一个异常
     * @example 
     * @return Throwable
     */
    public final  function getPrevious()
    {
    }

    /**
     * 
     *获取字符串类型的异常追踪信息
     * @example 
     * @return string
     */
    public final  function getTraceAsString()
    {
    }

    /**
     * 
     *将异常信息转化为字符串
     * @example 
     * @return 
     */
    public function __toString()
    {
    }

}

