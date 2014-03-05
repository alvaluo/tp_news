<?php
class Results extends Think {
	
	/**
	 * json 返回状态数组
	 * Enter description here ...
	 * @var unknown_type
	 */
	public static $MessageArray = array(
		'statusCode'=>300,
		'message'=>'操作失败!',
		'navTabId'=>"",
		'rel'=>"",
		'callbackType'=>"",
		'closeCurrent'=>"",
		'forwardUrl'=>"",
	);
	
	public static $MESSAGE_NO = "操作失败!";
	public static $MESSAGE_OK = "操作成功!";
	public static $STATUSCODE_NO = "300";
	public static $STATUSCODE_OK = "200";
  
}
?>