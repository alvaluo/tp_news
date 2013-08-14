<?php

class ModulesModel extends Model {

	//模型命名
	protected $trueTableName = 'modules';
	
	//数据模型
	protected $fields = array(
			'id', 'modulename', 'moduleurl', 'operatingtype', 'mrid', 
	);
	
	// 自动验证设置
	protected $_validate	 =	 array(
	);
	
	// 自动填充设置
	public $_auto = array (
			array('id',null,self::MODEL_INSERT),
	);
	

 }