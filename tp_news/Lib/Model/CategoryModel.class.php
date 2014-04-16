<?php

class CategoryModel extends Model {

    protected $trueTableName = 'category';
    protected $fields = array(
        'id', 'pid', 'name', 'open','status','createtime'
    );
    protected $_validate = array(
    );
    public $_auto = array(
        array('id', null, self::MODEL_INSERT),
        array('createtime', 'date', 1, 'function', array('Y-m-d H:i:s')),
    );

}
