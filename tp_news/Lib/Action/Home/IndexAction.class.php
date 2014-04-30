<?php
class IndexAction extends Action {
	
    public function index(){
// 		$this->show('111','utf-8');

    	$page = $_REQUEST['page'];
    	if(!empty($page)){
    		$templateFile  =  $this->view->parseTemplate($page);
    		if(is_file($templateFile)){
    			$this->display($page);
    			return;
    		}
    	}
    	$this->display();
    	
		
    }
    
}