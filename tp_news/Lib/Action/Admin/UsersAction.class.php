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
    	
    	//import default page size
    	import("@.ORG.Constant");
    	$pageSize = Constant::$DEFAULT_PAGE_SIZE;
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $Users->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();

    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
    }
    
    public function edit() {
    	$id = $_GET['id'];
    	if(!empty($id)){
    		$Users = M('Users');
    		$data =   $Users->find($id);
    		if($data) {
    			$this->data = $data;
    		}else{
    			$this->error('数据错误');
    		}
    	}
    	$this->display();
    }
    
    public function delete() {
    	//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	
    	$id = $_GET['id'];
    	
    	$Users = M('Users');
    	$list = $Users->delete($id);
    	if ($list !== false) {
    		$MessageArray['statusCode'] = 200;
    		$MessageArray['message'] = "操作成功!";
    		$MessageArray['navTabId'] = "userList";
    	}
    	
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
    

    
    public function update() {
    	//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	$id = $_POST['id'];
    	
    	$Users = D('Users');
    	if(empty($id)){
    		if ($vo = $Users->create()) {
    			$list = $Users->add();
    			if ($list !== false) {
    				$MessageArray['statusCode'] = 200;
    				$MessageArray['message'] = "操作成功!";
    				$MessageArray['callbackType'] = "closeCurrent";
    				$MessageArray['navTabId'] = "userList";
    			}
    		}
    	}else{
    		/* $data = $Users->create();
    		if($data) {
    			$result = $Users->save($data);
    			if($result) {
    				$MessageArray['statusCode'] = 200;
    				$MessageArray['message'] = "操作成功!";
    				$MessageArray['callbackType'] = "closeCurrent";
    				$MessageArray['navTabId'] = "userList";
    			}
    		} */
    		$data['id'] = $_POST["id"];
    		$data['username'] = $_POST["username"];
			if(!empty($_POST["password"])){
				$data['password'] = md5($_POST["password"]);
			}
    		$data['realname'] = $_POST["realname"];
    		$data['email'] = $_POST["email"];
    		$data['locked'] = $_POST["locked"];
    		$result = $Users -> save($data);
    		if($result) {
    			$MessageArray['statusCode'] = 200;
    			$MessageArray['message'] = "操作成功!";
    			$MessageArray['callbackType'] = "closeCurrent";
    			$MessageArray['navTabId'] = "userList";
    		}
    	}
    	
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
}
?>