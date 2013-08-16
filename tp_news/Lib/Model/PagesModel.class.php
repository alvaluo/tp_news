<?php

class PagesModel extends Model {

	//模型命名
	protected $trueTableName = 'pages';
	
	//数据模型
	protected $fields = array(
			'id', 'title', 'url', 'content', 'author', 'time', 'status', 'sort', 'parent',
	);
	
	// 自动验证设置
	protected $_validate	 =	 array(
	);
	
	// 自动填充设置
	public $_auto = array (
			array('id',null,self::MODEL_INSERT),
			array('time','date',1,'function',array('Y-m-d H:i:s')),
	);
	

 }