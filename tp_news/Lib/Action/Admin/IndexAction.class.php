<?php
class IndexAction extends Action {
	
    public function index(){
    	import('ORG.Util.Session');
    	if(Session::is_set('ADMINUSER')){
    		$this->display();
    		return;
    	}
    	$log = $_POST['log'];
    	$pwd = $_POST['pwd'];
    	if(!empty($log) && !empty($pwd)){
    		$Users = M('Users');
    		$map['username']  = $log;
    		$data = $Users -> where($map) -> find();
    		if($data && strcmp($pwd,$data['password'])==0) {
    			Session::set('ADMINUSER',$data);
    			$this->display();
    			return;
    		}
    		$this->login_error = TRUE;
    	}
    	$this->display('login');
    }
    
    public function login(){
    	$this->display();
    }
    
    public function exits() {
    	import('ORG.Util.Session');
    	Session::clear ('ADMINUSER');
    	$this->redirect('login');
    }
}