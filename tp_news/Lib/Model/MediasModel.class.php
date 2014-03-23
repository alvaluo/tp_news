<?php

class  MediasModel extends Model {

	//模型命名
	protected $trueTableName = 'medias';
	
	//数据模型
	protected $fields = array(
			'id', 'filename','filetype','filesize','url','title','rentext','explain','description','createtime',
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