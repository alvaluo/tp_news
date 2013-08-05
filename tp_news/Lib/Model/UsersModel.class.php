<?php

class UsersModel extends Model {
	
//     // 定义自动验证
//     protected $_validate    =   array(
//         array('title','require','标题必须'),
//         );
//     // 定义自动完成
//     protected $_auto    =   array(
//         array('create_time','time',1,'function'),
//         );

	//模型命名
	protected $trueTableName = 'users';
	
	//数据模型
	protected $fields = array(
			'id', 'username', 'password', 'relname','createtime', 'lasttime', 'email', 'locked'
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
			/* array('createtime','date',1,'function',array('Y-m-d H:i:s')),
			array('lasttime','date',1,'function',array('Y-m-d H:i:s')), */
	);
	

 }