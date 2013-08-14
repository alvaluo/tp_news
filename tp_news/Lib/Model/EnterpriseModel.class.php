<?php

class  EnterpriseModel extends Model {

	//模型命名
	protected $trueTableName = 'enterprise';
	
	//数据模型
	protected $fields = array(
			'id', 'companyname', 'englishname', 'companynature ','companytype','address','regname','phone'
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