<?php

class RolesModel extends Model {

	//妯″瀷鍛藉悕
	protected $trueTableName = 'roles';
	
	//鏁版嵁妯″瀷
	protected $fields = array(
			'id', 'rolename', 'comment', 'sort', 'mid',
	);
	
	// 鑷姩楠岃瘉璁剧疆
	protected $_validate	 =	 array(
	);
	
	// 鑷姩濉厖璁剧疆
	public $_auto = array (
			array('id',null,self::MODEL_INSERT),
			array('mid',1,self::MODEL_INSERT),
	);
	

 }