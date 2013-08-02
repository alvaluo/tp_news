<?php
//date_default_timezone_set('PRC');

class UsersAction extends Action{
	
    public function lists() {
    	
    	$username = $_POST['username'];
    	
    	$Users = M('Users');
    	$list_users = $Users->select();
    	$this->data = $list_users;
    	$this->display();
    }
    
    public function delete() {
        import("@.ORG.Results");
        $MessageArray = Results::$MessageArray;
    	
    	if(!empty($_GET['a_id'])) {
			$Ad_Users = M("ad_users");
			$result	=	$Ad_Users->delete($_GET['a_id']);
			if($result){
				$MessageArray['statusCode'] = 200;
        		$MessageArray['message'] = "�����ɹ�!";
			}
		}
		$json_string = json_encode($MessageArray);
		echo $json_string;
    }
    
	public function edit() {
		$A_id = $_GET['a_id'];
		if(!empty($A_id)) {
			$Ad_Users = M("ad_users");
			$vo	= $Ad_Users->getByAId($_GET['a_id']);
			if($vo) {
				$this->assign('vo',$vo);
			}
			$this->assign('update','true');
		}
		$list = M("ad_roleclass")->order('r_id desc')->findAll();
		$this->assign('list',$list);
		$this->display();
    }
    
    public function insert() {
        import("@.ORG.Results");
        $MessageArray = Results::$MessageArray;
        
        $A_id = $_POST["a_id"];

        $Ad_Users = M("ad_users");
//    	$AdminUser = M("adminuser",new AdminUserModel());
//    	$AdminUser -> startTrans();
//    	if($vo = $AdminUser->create()) {
        	if(empty($A_id)){  //�����ݲ���
        		$data['a_username'] = $_REQUEST["a_username"];
        		$data['a_password'] = $_REQUEST["a_password"];
        		$data['a_roleid'] = $_REQUEST["a_roleid"];
        		$data['a_realname'] = $_REQUEST["a_realname"];
        		
				$data['a_status'] = 1;
				$data['a_modleid'] = '1,2,3';
//				$data['a_inputtime'] = date("Y-m-d H:i:s",time());
//				$data['a_lasttime'] = date("Y-m-d H:i:s",time());
				$data['a_inputtime'] = date("Y-m-d H:i:s",strtotime('-1 day',strtotime('+9 hours',time())));
				$data['a_lasttime'] = date("Y-m-d H:i:s",strtotime('-1 day',strtotime('+9 hours',time())));
				
				$list=$Ad_Users->data($data)->add();
        		if($list!==false){
					$MessageArray['statusCode'] = 200;
	        		$MessageArray['message'] = "�����ɹ�!";
	        		$MessageArray['navTabId'] = "userList";
//	        		$AdminUser -> commit();
				}else{
//					$AdminUser -> rollback();
				}
        	}else{	  //������ݲ���
        		
        		$data['a_password'] = $_REQUEST["a_password"];
        		$data['a_realname'] = $_REQUEST["a_realname"];
        		$data['a_roleid'] = $_REQUEST["a_roleid"];
        		
        		$list=$Ad_Users->where("a_id=".$A_id)->save($data);
        		if($list!==false){
					$MessageArray['statusCode'] = 200;
	        		$MessageArray['message'] = "�����ɹ�!";
	        		$MessageArray['navTabId'] = "userList";
//	        		$AdminUser -> commit();
				}else{
//					$AdminUser -> rollback();
				}
        	}
//    	}
		$json_string = json_encode($MessageArray);
		echo $json_string;
		//$this->redirect();
    }
}
?>