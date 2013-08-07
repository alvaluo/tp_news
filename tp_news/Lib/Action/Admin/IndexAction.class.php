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
    		if($data && strcmp(md5($pwd),$data['password'])==0) {
    			//Save db logs
    			$Logs = D('Logs');
    			$data = $Logs->create();
    			$data['username'] = $log;
    			$data['ip'] = get_client_ip();
    			$data['agent']= $_SERVER['HTTP_USER_AGENT'];
    			$data['comment']= 'Login';
    			$Logs->add($data);
    			//Save to session
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