<?php

class RolesModel extends Model {

	//模型命名
	protected $trueTableName = 'roles';
	
	//数据模型
	protected $fields = array(
			'id', 'rolename', 'comment', 'mid',
	);
	
	// 自动验证设置
	protected $_validate	 =	 array(
	);
	
	// 自动填充设置
	public $_auto = array (
			array('id',null,self::MODEL_INSERT),
			array('mid',1,self::MODEL_INSERT),
	);
	

 }