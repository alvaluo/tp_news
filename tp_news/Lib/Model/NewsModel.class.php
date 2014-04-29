<?php

class NewsModel extends Model {

    protected $trueTableName = 'news';
    protected $fields = array(
        'id', 'title', 'status', 'categoryid','content','author','createtime'
    );
    protected $_validate = array(
    );
    public $_auto = array(
        array('id', null, self::MODEL_INSERT),
        array('createtime', 'date', 1, 'function', array('Y-m-d H:i:s')),
    );

}
