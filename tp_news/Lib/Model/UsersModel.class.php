<?php

class UsersModel extends Model {

	//模型命名
	protected $trueTableName = 'users';
	
	//数据模型
	protected $fields = array(
			'id', 'username', 'password', 'realname','createtime', 'lasttime', 'email', 'locked',
	);
	
	// 自动验证设置
	protected $_validate	 =	 array(
			array('username','require','内容必须'),
			array('password','require','内容必须'),
	);
	
	// 自动填充设置
	public $_auto = array (
			array('id',null,self::MODEL_INSERT),
			array('password','md5',3,'function') ,
			array('createtime','date',1,'function',array('Y-m-d H:i:s')),
			array('lasttime','date',1,'function',array('Y-m-d H:i:s')),
	);
	

 }