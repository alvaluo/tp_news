<?php
 
define('APP_NAME','tp_news');
define('APP_PATH','');

$root=dirname(__FILE__);
$root=str_replace('', '/', $root);
define('__ROOT__',$root);
/* define('LIB_PATH', __ROOT__.'/libs/');
define('CONF_PATH', __ROOT__.'/config/');
define('LANG_PATH', __ROOT__.'/lang/');
define('TMPL_PATH', __ROOT__.'/templates/'); */
define('RUNTIME_PATH',__ROOT__.'/Cache/');
define('LOG_PATH', RUNTIME_PATH.'/log/');
define('TEMP_PATH', RUNTIME_PATH.'/temp/');
define('DATA_PATH',RUNTIME_PATH.'/data/');
define('CACHE_PATH', RUNTIME_PATH.'/cache/');


define('APP_DEBUG',TRUE);

require './Vendor/ThinkPHP/ThinkPHP.php';

?>