<?php
class IndexAction extends Action {
	
    public function index(){
    	$this->name = 'thinkphp';
    	$this->display();
// 		$this->show('222','utf-8');
    }
    
    public function login(){
    	$this->display();
    }
    
}