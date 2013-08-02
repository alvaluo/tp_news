<?php
return array (
		
		'DB_TYPE'   => 'mysql',
		'DB_HOST'   => 'localhost',
		'DB_NAME'   => 'tp_news',
		'DB_USER'   => 'root',
		'DB_PWD'    => 'rootadmin',
		'DB_PORT'   => 3306,
		'DB_PREFIX' => '',
		
		//'URL_MODEL' => 2,
		//	'TMPL_FILE_DEPR'=>'_',
// 		'URL_HTML_SUFFIX'=>'.html',
		'URL_MODEL'=>1,
		
		'APP_GROUP_LIST' => 'Admin,Home',
		'DEFAULT_GROUP' => 'Home',
		'DEFAULT_MODULE' => 'Index',
		'DEFAULT_ACTION' => 'index',
		                             
		TMPL_PARSE_STRING => array(
			/* '__PUBLIC__' => '/alvaluo/Public',
	 		'__JS__' => '/Public/JS/', */
			'__DWZ__' => '/Public/dwz'
	 	) 
);
?>