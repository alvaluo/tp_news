<?php
class UsersAction extends Action{
	
    public function lists() {
    	$map = null;
    	$username = $_POST['username'];
    	if(!empty($username)){
    		$this->username = $username;
    		$map['username'] = array('like','%'.$username.'%');
    	}
    	$createtime = $_POST['createtime'];
    	if(!empty($createtime)){
    		$this->createtime = $createtime;
    		$map['createtime'] = array('like',$createtime.'%');
    	}
    	$Users = M('Users');
    	$count = $Users->where($map) -> count();
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:1;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $Users->where($map) -> page($pageNum.','.$Page->listRows) -> select();

    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
    }
    
    public function edit() {
    	
    	$this->display();
    }
    
    public function delete() {
        
    }
    

    
    public function insert() {
    	$Users = D('Users');
    	$data['username'] =	'11';
    	$data['password'] = '11';
    	$data['realname'] = '11';
//     	$data['createtime'] = '2013-08-01 23:34:56';
//     	$data['lasttime'] = '2013-08-01 23:34:56';
    	$data['email'] = '11';
    	$data['locked'] = 0;
    	$Users->add($data);

    	
    	
    	$MessageArray = array(
    			'statusCode'=>300,
    			'message'=>'操作失败!',
    			'navTabId'=>"userList",
    			'rel'=>"",
    			'callbackType'=>"",
    			'closeCurrent'=>"",
    			'forwardUrl'=>"",
    	);
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
}
?>