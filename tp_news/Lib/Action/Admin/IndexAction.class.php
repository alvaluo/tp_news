<?php
class IndexAction extends Action {
	
    public function index(){
    	import('ORG.Util.Session');
//     	if(Session::is_set('CURRENT_USER')){
		if(Session::isExpired()){
			$this->display('login');
			return;
		}
		if(session('?__USERCONF')){
    		$this->display();
    		return;
    	}
    	$log = $_POST['log'];
    	$pwd = $_POST['pwd'];
    	if(!empty($log) && !empty($pwd)){
    		$msg = L('LOGIN_NULL_LOG_PWD');
    		$Users = M('Users');
    		$map['username']  = $log;
    		$data = $Users ->field('u.*,r.rolename,r.mid')
    			-> table('users u')->join('roles r on u.roleid = r.id')
    			-> where($map) -> find();
    		if($data && strcmp(md5($pwd),$data['password'])==0) {
    			if($data['locked'] == 0){
    				$this->login_msg = L('LOGIN_LOCKED_LOG_PWD');
    			}else{
    				//Save db logs
    				$Logs = D('Logs');
    				$dataLog = $Logs->create();
    				$dataLog['username'] = $log;
    				$dataLog['ip'] = get_client_ip();
    				$dataLog['agent']= $_SERVER['HTTP_USER_AGENT'];
    				$dataLog['comment']= 'Login';
    				$Logs->add($dataLog);
    				//Rule
    				$mid = $data['mid'];
    				$ruleTag = getIndexModules($mid);
    				//Save to session
    				$current_user['user'] = $data;
    				$current_user['ruleTag'] = $ruleTag;
//     				Session::set('CURRENT_USER',$current_user);
    				//$lifeTime = 00.1 * 3600;   
    				//session_set_cookie_params($lifeTime);
    				session('__USERCONF',$current_user);
    				$this->display();
    				return;
    			}
    		}else{
    			$this->login_msg = $msg;
    		}
    		
    	}
    	$this->display('login');
    }
    
    public function login(){
    	$this->display();
    }
    
    public function exits() {
    	import('ORG.Util.Session');
    	Session::clear ('__USERCONF');
    	$this->redirect('login');
    }
    

}