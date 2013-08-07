<?php

class LogsModel extends Model {

	//模型命名
	protected $trueTableName = 'logs';
	
	//数据模型
	protected $fields = array(
			'id', 'username', 'ip', 'createtime','agent','comment', 
	);
	
	// 自动验证设置
	protected $_validate	 =	 array(
	);
	
	// 自动填充设置
	public $_auto = array (
			array('id',null,self::MODEL_INSERT),
			array('createtime','date',1,'function',array('Y-m-d H:i:s')),
	);
	

 }