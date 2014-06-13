<?php
class IndexAction extends Action {
	
    public function index(){
    	import('ORG.Util.Session');
    	if(session('?__USERCONF')){
    		$this->display();
    		return;
    	}
    	$CK_USER = cookie('user');
    	if(!empty($CK_USER)){
    		$log = $CK_USER['username'];
    		$pwd = $CK_USER['password'];
    		$userData = getUser($log, $pwd);
    		$ruleTag = getIndexModules($userData['mid']);
    		setDataForSession($userData, $ruleTag);
    		$this->display();
    		return;
    	}
    	$this->redirect('login');
    }
    
    public function login(){
    	import('ORG.Util.Session');
    	if(session('?__USERCONF')){
    		$this->redirect('index');
    		return;
    	}
    	$CK_USER = cookie('user');
    	if(!empty($CK_USER)){
    		$this->redirect('index');
    		return;
    	}
    	$log = $_POST['log'];
    	$pwd = $_POST['pwd'];
    	$rememberLogin = $_POST['rememberLogin'];
    	$userData = getUser($log, md5($pwd));
    	if(!empty($userData)){
    		if($userData['locked'] == 0){
    			$this->login_msg = L('LOGIN_LOCKED_LOG_PWD');
    		}else{
    			setLog($log, 'Login');
    			$ruleTag = getIndexModules($userData['mid']);
    			setDataForSession($userData, $ruleTag);
    			if(!empty($rememberLogin)){
    				cookie('user',$userData,7*24*60*60);
    			}
    			$this->redirect('index');
    			return;
    		}
    	}else if(!empty($log) && !empty($pwd)){
    		$this->login_msg = L('LOGIN_NULL_LOG_PWD');
    	}
    	$this->display();
    }
    
    public function exits() {
    	import('ORG.Util.Session');
    	Session::clear ('__USERCONF');
    	cookie('user',null);
    	cookie(null);
    	$this->redirect('login');
    }

}