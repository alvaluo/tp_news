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
    	
    	$data = $Users ->field('u.*,r.rolename')
    			-> table('users u')->join('roles r on u.roleid = r.id')
    			->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();

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
    		}
    	}
    	
    	$Roles = M('Roles');
		$roleData = $Roles -> where() -> select();
		$this->roleData = $roleData;
		
    	$this->display();
    }
    
    public function delete() {
    	//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	
    	$id = $_GET['id'];
    	$navTabId = $_GET['navTabId'];
    	
    	$Users = M('Users');
    	$list = $Users->delete($id);
    	if ($list !== false) {
    		$MessageArray['statusCode'] = 200;
    		$MessageArray['message'] = "操作成功!";
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
    			}
    		}
    	}else{
    		$data['id'] = $_POST["id"];
    		$data['username'] = $_POST["username"];
			if(!empty($_POST["password"])){
				$data['password'] = md5($_POST["password"]);
			}
    		$data['realname'] = $_POST["realname"];
    		$data['email'] = $_POST["email"];
    		$data['locked'] = $_POST["locked"];
    		$data['roleid'] = $_POST["roleid"];
    		$result = $Users -> save($data);
    		if($result) {
    			$MessageArray['statusCode'] = 200;
    			$MessageArray['message'] = "操作成功!";
    			$MessageArray['callbackType'] = "closeCurrent";
    		}
    	}
    	
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
}
?>