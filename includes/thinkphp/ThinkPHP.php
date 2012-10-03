<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id: ThinkPHP.php 2791 2012-02-29 10:08:57Z liu21st $
// ThinkPHP 入口文件
/*apache
 * [SERVER_SOFTWARE] => Apache/2.2.21 (Win32) mod_ssl/2.2.21 OpenSSL/1.0.0e PHP/5.3.8 mod_perl/2.0.4 Perl/v5.10.1
 * [REQUEST_URI] => /pinphp/test.php?cid=1
 *
 * iis 7.5(不存在REQUEST_URI)
 * [HTTP_X_REWRITE_URL] => /test.php?cid=1
 * [SERVER_SOFTWARE] => Microsoft-IIS/7.5
 * */
$_SERVER['REQUEST_URI']=isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:$_SERVER["HTTP_X_REWRITE_URL"];
/*
 if(strpos($_SERVER['SERVER_SOFTWARE'],'IIS')){
 $_SERVER['REQUEST_URI']=$_SERVER["HTTP_X_REWRITE_URL"];
 }
 */

//记录开始运行时间
$GLOBALS['_beginTime'] = microtime(TRUE);
// 记录内存初始使用
define('MEMORY_LIMIT_ON', function_exists('memory_get_usage'));
if (MEMORY_LIMIT_ON)
$GLOBALS['_startUseMems'] = memory_get_usage();
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . '/');
defined('RUNTIME_PATH') or define('RUNTIME_PATH', APP_PATH . 'Runtime/');
defined('APP_DEBUG') or define('APP_DEBUG', false); // 是否调试模式
$runtime = defined('MODE_NAME') ? '~' . strtolower(MODE_NAME) . '_runtime.php' : '~runtime.php';
defined('RUNTIME_FILE') or define('RUNTIME_FILE', RUNTIME_PATH . $runtime);
if (!APP_DEBUG && is_file(RUNTIME_FILE)) {
	// 部署模式直接载入运行缓存
	require RUNTIME_FILE;
} else {
	// 系统目录定义
	defined('THINK_PATH') or define('THINK_PATH', dirname(__FILE__) . '/');
	// 加载运行时文件
	require THINK_PATH . 'Common/runtime.php';
}