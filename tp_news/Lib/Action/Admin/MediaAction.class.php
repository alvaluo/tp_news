<?php
class MediaAction extends Action{
	
  public function lists() {
        $map = null;
    	$companyname = $_POST['companyname'];
    	if(!empty($companyname)){
    		$this->companyname = $companyname;
    		$map['companyname'] = array('like','%'.$companyname.'%');
    	}
    	$Media = M('Media');
    	$count = $Media->where($map) -> count();
    	
    	//import default page size
    	import("@.ORG.Constant");
    	$pageSize = Constant::$DEFAULT_PAGE_SIZE;
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $Media->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();

    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
    }
    
    public function edit() {
    	$id = $_GET['id'];
    	if(!empty($id)){
    		$Media = M('Media');
    		$data =   $Media->find($id);
    		if($data) {
    			$this->data = $data;
    		}
    	}
    	$this->display();
    }
    
    public function update() {
    	//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	$id = $_POST['id'];
    	 
    	$Enterprise = D('Enterprise');
    	if(empty($id)){
    		if ($vo = $Enterprise->create()) {
    			$list = $Enterprise->add();
    			if ($list !== false) {
    				$MessageArray['statusCode'] = 200;
    				$MessageArray['message'] = "操作成功!";
    				$MessageArray['callbackType'] = "closeCurrent";
    			}
    		}
    	}else{
    		$data = $Enterprise->create();
			if($data) {
				$result = $Enterprise->save($data);
				if($result) {
					$MessageArray['statusCode'] = 200;
					$MessageArray['message'] = "操作成功!";
					$MessageArray['callbackType'] = "closeCurrent";
				}
			}
    	}
    	 
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
    
    public function delete() {
    	//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	 
    	$id = $_GET['id'];
    	 
    	$Enterprise = M('Enterprise');
    	$list = $Enterprise->delete($id);
    	if ($list !== false) {
    		$MessageArray['statusCode'] = 200;
    		$MessageArray['message'] = "操作成功!";
    	}
    	 
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
	
}
?>