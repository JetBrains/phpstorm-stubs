<?php


/**
*FastDFS客户端
*/
/**
FastDFS文件ID分割符
*/
define('FDFS_FILE_ID_SEPERATOR', '/');
/**
FastDFS元数据覆盖标识
*/
define('FDFS_STORAGE_SET_METADATA_FLAG_OVERWRITE', 'O');
/**
FastDFS元数据合并标识
*/
define('FDFS_STORAGE_SET_METADATA_FLAG_MERGE', 'M');
/**
FastDFS存储服务器初始化状态
*/
define('FDFS_STORAGE_STATUS_INIT', 0);
/**
FastDFS存储服务器等待同步状态
*/
define('FDFS_STORAGE_STATUS_WAIT_SYNC', 1);
/**
FastDFS存储服务器正在同步中状态
*/
define('FDFS_STORAGE_STATUS_SYNCING', 2);
/**
FastDFS存储服务器删除状态
*/
define('FDFS_STORAGE_STATUS_DELETED', 4);
/**
FastDFS存储服务器下线状态
*/
define('FDFS_STORAGE_STATUS_OFFLINE', 5);
/**
FastDFS存储服务器在线状态
*/
define('FDFS_STORAGE_STATUS_ONLINE', 6);
/**
FastDFS存储服务器活动状态
*/
define('FDFS_STORAGE_STATUS_ACTIVE', 7);
/**
FastDFS存储服务器未知状态
*/
define('FDFS_STORAGE_STATUS_NONE', 99);
/**
* 
*
* @example 
* 获取FastDFS客户端库版本号
* @return string
*/
function fastdfs_client_version()
{
}

/**
* 
*向服务器发送ACTIVE_TEST命令
* @example 
* 
* @param array $server_info:服务器信息(包括ip_addr和port的关联数组) 
* @return boolean
*/
function fastdfs_active_test(Array $server_info)
{
}

/**
* 
*连接服务器
* @example 
* 
* @param string $ip_addr:服务器IP地址 
* @param int $port:服务器端口 
* @return array | boolean
*/
function fastdfs_connect_server($ip_addr, $port)
{
}

/**
* 
*关闭与服务器的连接
* @example 
* 
* @param array $server_info:服务器信息(包括ip_addr和port的关联数组) 
* @return array | boolean
*/
function fastdfs_disconnect_server(Array $server_info)
{
}

/**
* 
*获取上次错误码
* @example 
* 
* @return int
*/
function fastdfs_get_last_error_no()
{
}

/**
* 
*获取上次错误信息
* @example 
* 
* @return string
*/
function fastdfs_get_last_error_info()
{
}

/**
* 
*获取已连接的跟踪服务器信息(成功时返回包括ip_addr和port的关联数组)
* @example 
* 
* @return array | boolean
*/
function fastdfs_tracker_get_connection()
{
}

/**
* 
*连接所有跟踪服务器
* @example 
* 
* @return boolean
*/
function fastdfs_tracker_make_all_connections()
{
}

/**
* 
*关闭所有与跟踪服务器的连接
* @example 
* 
* @return boolean
*/
function fastdfs_tracker_close_all_connections()
{
}

/**
* 
*获取分组统计信息
* @example 
* 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_list_groups($group_name, Array $track_servers)
{
}

/**
* 
*获取上传时的存储服务器信息(成功时返回包含ip_addr, port, sock 和 store_path_index　三个元素的数组)
* @example 
* 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_store($group_name, Array $track_servers)
{
}

/**
* 
*获取上传时的存储服务器列表(成功时返回一个数组，每个元素包含ip_addr, port, sock 和 store_path_index　三个元素)
* @example 
* 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_store_list($group_name, Array $track_servers)
{
}

/**
* 
*获取设置元数据时的存储服务器信息(成功时返回包含ip_addr, port, sock 和 store_path_index　三个元素的数组)
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_update($group_name, $remote_filename, Array $track_servers)
{
}

/**
* 
*获取下载文件设置元数据时的存储服务器信息(成功时返回包含ip_addr, port, sock 和 store_path_index　三个元素的数组)
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_fetch($group_name, $remote_filename, Array $track_servers)
{
}

/**
* 
*获取可以检索文件内容或元数据的存储服务器列表
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_list($group_name, $remote_filename, Array $track_servers)
{
}

/**
* 
*获取设置元数据时的存储服务器信息(成功时返回包含ip_addr, port, sock 和 store_path_index　三个元素的数组)
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_file＿id:文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_update1($group_name, $remote_file＿id, Array $track_servers)
{
}

/**
* 
*获取下载文件或设置元数据时的存储服务器信息(成功时返回包含ip_addr, port, sock 和 store_path_index　三个元素的数组)
* @example 
* 
* @param string $remote_file_id:文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_fetch1($remote_file_id, Array $track_servers)
{
}

/**
* 
*获取可以检索文件内容或元数据的存储服务器列表
* @example 
* 
* @param string $remote_file＿id:文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_tracker_query_storage_list1($remote_file＿id, Array $track_servers)
{
}

/**
* 
*从集群中删除服务器
* @example 
* 
* @param string $group_name:分组名 
* @param array $storage_ip:被删除的服务器IP 
* @return boolean
*/
function fastdfs_tracker_delete_storage($group_name, Array $storage_ip)
{
}

/**
* 
*将本地文件上传到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param string $local_filename:本地文件 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_by_filename($local_filename, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将本地文件上传到远程服务器(成功返回一个包括文件ID)
* @example 
* 
* @param string $local_filename:本地文件 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_by_filename1($local_filename, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过文件内容将文件上传到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param string $file_buf:文件内容 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_by_filebuff($file_buf, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过文件内容将文件上传到远程服务器(成功返回文件ID)
* @example 
* 
* @param string $file_buf:文件内容 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_by_filebuff1($file_buf, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数上传文件到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_by_callback(Array $callback_array, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数上传文件到远程服务器(成功返回文件ID)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_by_callback1(Array $callback_array, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将文件追加到存储服务器中的文件中(一般用于断点续传)
* @example 
* 
* @param string $local_filename:文件名 
* @param string $group_name:分组名 
* @param string $appender_filename:被追加的文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_append_by_filename($local_filename, $group_name, $appender_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将文件追加到存储服务器中的文件中(一般用于断点续传)
* @example 
* 
* @param string $local_filename:文件名 
* @param string $appender_file_id:被追加的文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_append_by_filename1($local_filename, $appender_file_id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将文件追加到存储服务器中的文件中(一般用于断点续传)
* @example 
* 
* @param string $file_buff:文件内容 
* @param string $group_name:分组名 
* @param string $appender_filename:被追加的文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_append_by_filebuff($file_buff, $group_name, $appender_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将文件追加到存储服务器中的文件中(一般用于断点续传)
* @example 
* 
* @param string $file_buff:文件内容 
* @param string $appender_file_id:被追加的文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_append_by_filebuff1($file_buff, $appender_file_id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数将文件追加到存储服务器中的文件中(一般用于断点续传)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $group_name:分组名 
* @param string $appender_filename:被追加的文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_append_by_callback(Array $callback_array, $group_name, $appender_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将文件追加到存储服务器中的文件中(一般用于断点续传)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $appender_file＿id:被追加的文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_append_by_callback1(Array $callback_array, $appender_file＿id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过本地文件修改追加的文件
* @example 
* 
* @param string $local_filename:本地文件名 
* @param int $file_offset:文件位置 
* @param string $group_name:分组名 
* @param string $appender_filename:被追加的文件 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_modify_by_filename($local_filename, $file_offset, $group_name, $appender_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过本地文件修改追加的文件
* @example 
* 
* @param string $local_filename:本地文件名 
* @param int $file_offset:文件位置 
* @param string $appender_file＿id:被追加的文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_modify_by_filename1($local_filename, $file_offset, $appender_file＿id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过本地文件修改追加的文件
* @example 
* 
* @param string $file_buff:本地文件内容 
* @param int $file_offset:文件位置 
* @param string $group_name:分组名 
* @param string $appender_filename:被追加的文件 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_modify_by_filebuff($file_buff, $file_offset, $group_name, $appender_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过本地文件修改追加的文件
* @example 
* 
* @param string $local_filename:本地文件名 
* @param int $file_offset:文件位置 
* @param string $appender_file_id:被追加的文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_modify_by_filebuff1($local_filename, $file_offset, $appender_file_id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数修改追加的文件
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param int $file_offset:文件位置 
* @param string $group_name:分组名 
* @param string $appender_filename:被追加的文件 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_modify_by_callback(Array $callback_array, $file_offset, $group_name, $appender_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数修改追加的文件
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param int $file_offset:文件位置 
* @param string $appender_file_id:被追加的文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_modify_by_callback1(Array $callback_array, $file_offset, $appender_file_id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将本地文件作为副加文件上传到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param string $local_filename:本地文件 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_appender_by_filename($local_filename, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将本地文件作为附加文件上传到远程服务器(成功返回文件ID)
* @example 
* 
* @param string $local_filename:本地文件 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_appender_by_filename1($local_filename, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通本地文件内容上传文件到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param string $file_buf:文件内容 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_appender_by_filebuff($file_buf, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过文件内容将本地文件上传到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param string $file_buff:文件内容 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_appender_by_filebuff1($file_buff, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数上传文件到远程服务器(成功返回一个包括group_name和filename信息的关联数组)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_appender_by_callback(Array $callback_array, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数上传文件到远程服务器(成功返回文件ID)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $group_name:分组名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_appender_by_callback1(Array $callback_array, $file_ext_name, Array $meta_list, $group_name, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*上传本地文件到存储服务器(从文件模式，成功返回一个包含 group_name和filename的关联数组)
* @example 
* 
* @param string $local_filename:本地文件名 
* @param string $group_name:分组名 
* @param string $master_filename:主文件名 
* @param string $prefix_name:前缀名 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_slave_by_filename($local_filename, $group_name, $master_filename, $prefix_name, $file_ext_name, Array $meta_list, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*上传本地文件到存储服务器(从文件模式，成功返回文件ID)
* @example 
* 
* @param string $local_filename:本地文件名 
* @param string $master_file＿id:主文件ID 
* @param string $prefix_name:前缀名 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_slave_by_filename1($local_filename, $master_file＿id, $prefix_name, $file_ext_name, Array $meta_list, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*上传本地文件到存储服务器(从文件模式，成功返回一个包含 group_name和filename的关联数组)
* @example 
* 
* @param string $file_buff:本地文件内容 
* @param string $group_name:分组名 
* @param string $master_filename:主文件名 
* @param string $prefix_name:前缀名 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_slave_by_filebuff($file_buff, $group_name, $master_filename, $prefix_name, $file_ext_name, Array $meta_list, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*上传本地文件到存储服务器(从文件模式，成功返回文件ID)
* @example 
* 
* @param string $file_buff:本地文件内容 
* @param string $master_file_id:主文件ID 
* @param string $prefix_name:前缀名 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_slave_by_filebuff1($file_buff, $master_file_id, $prefix_name, $file_ext_name, Array $meta_list, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数上传本地文件到存储服务器(从文件模式，成功返回一个包含 group_name和filename的关联数组)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $group_name:分组名 
* @param string $master_filename:主文件名 
* @param string $prefix_name:前缀名 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_upload_slave_by_callback(Array $callback_array, $group_name, $master_filename, $prefix_name, $file_ext_name, Array $meta_list, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数上传本地文件到存储服务器(从文件模式，成功返回文件ID)
* @example 
* 
* @param array $callback_array:回调函数(应包括callback, file_size和args三个元素) 
* @param string $master_file_id:主文件ID 
* @param string $prefix_name:前缀名 
* @param string $file_ext_name:文件扩展名(不包括.) 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_upload_slave_by_callback1(Array $callback_array, $master_file_id, $prefix_name, $file_ext_name, Array $meta_list, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*删除存储服务器上的文件
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_delete_file($group_name, $remote_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*删除存储服务器上的文件
* @example 
* 
* @param string $remote_file＿id:文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_delete_file1($remote_file＿id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*根据指定的大小截取文件
* @example 
* 
* @param string $group_name:分组名 
* @param string $appender_filename:被截取的文件名 
* @param int $truncated_file_size:截取大小 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_truncate_file($group_name, $appender_filename, $truncated_file_size, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*根据指定的大小截取文件
* @example 
* 
* @param string $appender_file_id:被截取的文件ID 
* @param int $truncated_file_size:截取大小 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_truncate_file1($appender_file_id, $truncated_file_size, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*获取服务器上的文件内容
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:文件名 
* @param int $file_offset:文件位置 
* @param int $download_bytes:下载的字节数(默认为0,表示下载整个文件) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_download_file_to_buff($group_name, $remote_filename, $file_offset, $download_bytes, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*获取服务器上的文件内容
* @example 
* 
* @param string $remote_file_id:文件ID 
* @param int $file_offset:文件位置 
* @param int $download_bytes:下载的字节数(默认为0,表示下载整个文件) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return string | boolean
*/
function fastdfs_storage_download_file_to_buff1($remote_file_id, $file_offset, $download_bytes, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将服务器上的文件下载到本地，存储为本地文件
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:服务器上文件名 
* @param string $local_filename:本地文件名 
* @param int $file_offset:文件位置 
* @param int $download_bytes:下载的字节数(默认为0,表示下载整个文件) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_download_file_to_file($group_name, $remote_filename, $local_filename, $file_offset, $download_bytes, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*将服务器上的文件下载到本地，存储为本地文件
* @example 
* 
* @param string $remote_file_id:服务器上文件ID 
* @param string $local_filename:本地文件名 
* @param int $file_offset:文件位置 
* @param int $download_bytes:下载的字节数(默认为0,表示下载整个文件) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_download_file_to_file1($remote_file_id, $local_filename, $file_offset, $download_bytes, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数处理将服务器上的下载的文件
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:服务器上文件名 
* @param array $download_callback:回调函数(应包括callback和args两个元素) 
* @param int $file_offset:文件位置 
* @param int $download_bytes:下载的字节数(默认为0,表示下载整个文件) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_download_file_to_callback($group_name, $remote_filename, Array $download_callback, $file_offset, $download_bytes, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过回调函数处理将服务器上的下载的文件
* @example 
* 
* @param string $remote_file_id:服务器上文件ID 
* @param array $download_callback:回调函数(应包括callback和args两个元素) 
* @param int $file_offset:文件位置 
* @param int $download_bytes:下载的字节数(默认为0,表示下载整个文件) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_download_file_to_callback1($remote_file_id, Array $download_callback, $file_offset, $download_bytes, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*设置文件元数据
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:服务器上文件名 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $op_type:操作标识(共有以下两个可选项：
      FDFS_STORAGE_SET_METADATA_FLAG_MERGE: 与旧元数据合并 
      FDFS_STORAGE_SET_METADATA_FLAG_OVERWRITE: 覆盖旧元数据) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_set_metadata($group_name, $remote_filename, Array $meta_list, $op_type, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*设置文件元数据
* @example 
* 
* @param string $remote_file_id:服务器上文件ID 
* @param array $meta_list:文件相关数据，如:array('width'=>1024, 'height'=>768) 
* @param string $op_type:操作标识(共有以下两个可选项：
      FDFS_STORAGE_SET_METADATA_FLAG_MERGE: 与旧元数据合并 
      FDFS_STORAGE_SET_METADATA_FLAG_OVERWRITE: 覆盖旧元数据) 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_set_metadata1($remote_file_id, Array $meta_list, $op_type, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*获取文件元数据(成功返回如：array('width' => 1024, 'height' => 768))
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:服务器上文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_get_metadata($group_name, $remote_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*获取文件元数据(成功返回如：array('width' => 1024, 'height' => 768))
* @example 
* 
* @param string $remote_file_id:服务器上文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return array | boolean
*/
function fastdfs_storage_get_metadata1($remote_file_id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*生成针对http下载防止盗用链接的token
* @example 
* 
* @param string $remote_filename:下载的文件地址(不包含group的名称) 
* @param int $timestamp:时间戳 
* @return string | boolean
*/
function fastdfs_http_gen_token($remote_filename, $timestamp)
{
}

/**
* 
*获取文件信息(返回值包括３个信息：
*        create_timestamp:文件创建时间;
*        file_size: 文件大小 (字节)
*        source_ip_addr: 文件存储原始的IP地址)
* @example 
* 
* @param string $group_name:分组名称 
* @param string $filename:文件名 
* @return array|boolean
*/
function fastdfs_get_file_info($group_name, $filename)
{
}

/**
* 
*获取文件ID获取文件信息(返回值包括３个信息：
*        create_timestamp:文件创建时间;
*        file_size: 文件大小 (字节)
*        source_ip_addr: 文件存储原始的IP地址)
* @example 
* 
* @param string $file_id:文件ID 
* @return array|boolean
*/
function fastdfs_get_file_info1($file_id)
{
}

/**
* 
*通过文件名等检查文件是否存在
* @example 
* 
* @param string $group_name:分组名 
* @param string $remote_filename:文件名 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_file_exist($group_name, $remote_filename, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过文件ID检查文件是否存在
* @example 
* 
* @param string $file_id:文件ID 
* @param array $track_servers:指定跟踪的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @param array $storage_servers:指定存储的服务器(每个数组元素包括ip_addr, port 和 sock三个子元素) 
* @return boolean
*/
function fastdfs_storage_file_exist1($file_id, Array $track_servers, Array $storage_servers)
{
}

/**
* 
*通过主文件，文件前缀和文件扩展名生成从文件
* @example 
* 
* @param string $master_filename:主文件 
* @param string $suffix:文件前缀 
* @param string $extension:文件扩展名 
* @return string | boolean
*/
function fastdfs_gen_slave_filename($master_filename, $suffix, $extension)
{
}

/**
* 
*向指定的连接发送数据
* @example 
* 
* @param int $sock:连接描述符 
* @param string $buff:发送的数据 
* @return boolean
*/
function fastdfs_send_data($sock, $buff)
{
}

