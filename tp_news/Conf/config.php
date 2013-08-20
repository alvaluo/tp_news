<?php

function getRemoteURL(){
	$url = 'http://'.$_SERVER['HTTP_HOST'];
	return $url;
}

return array (
		
		'DB_TYPE'   => 'mysql',
		'DB_HOST'   => 'localhost',
		'DB_NAME'   => 'tp_news',
		'DB_USER'   => 'root',
		'DB_PWD'    => 'rootadmin',
		'DB_PORT'   => 3306,
		'DB_PREFIX' => '',
		
		//'URL_MODEL' => 2,
// 		'TMPL_FILE_DEPR'=>'_',
		'URL_HTML_SUFFIX'=>'.html',
		'URL_MODEL'=>1,
		'URL_CASE_INSENSITIVE' =>TRUE,
		
// 		'LANG_SWITCH_ON' => true,   // 开启语言包功能
// 		'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
// 		'DEFAULT_LANG' => 'zh-cn', // 默认语言
// 		'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
// 		'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
		'LANG_SWITCH_ON' 	=> 	true,
		'DEFAULT_LANG' 		=> 	'zh-cn', // 默认语言
		'LANG_AUTO_DETECT' 	=> 	true, // 自动侦测语言
		'LANG_LIST'			=>	'en-us,zh-cn,zh-tw', //必须写可允许的语言列表
		
		'APP_GROUP_LIST' => 'Admin,Home',
		'DEFAULT_GROUP' => 'Home',
		'DEFAULT_MODULE' => 'Index',
		'DEFAULT_ACTION' => 'index',
		                             
		TMPL_PARSE_STRING => array(
			'__REMOTEURL__' => getRemoteURL(),
			'__PUBLIC__' => getRemoteURL().'/Public',
			'__DWZ__' => getRemoteURL().'/Public/dwz'
	 	) 
);
?>