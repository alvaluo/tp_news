<?php
class NewsAction extends Action{
	
  public function lists() {
    	$map = null;
    	$companyname = $_POST['companyname'];
    	if(!empty($companyname)){
    		$this->companyname = $companyname;
    		$map['companyname'] = array('like','%'.$companyname.'%');
    	}
    	$Enterprise = M('Enterprise');
    	$count = $Enterprise->where($map) -> count();
    	
    	//import default page size
    	import("@.ORG.Constant");
    	$pageSize = Constant::$DEFAULT_PAGE_SIZE;
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $Enterprise->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();

    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
    }
    
    public function edit() {
    	$id = $_GET['id'];
    	if(!empty($id)){
    		$Enterprise = M('Enterprise');
    		$data =   $Enterprise->find($id);
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
    
    
    public function editCategory(){
        $Category = M('Category');
    	$data = $Category->where()->select();
        $this->data = $data;
        $this->display();
    }
    
    public function updateCateory(){
        import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
        
        $line_data = $this->_request("line_data");
        $Category = M('Category');
        foreach($line_data as $line){
            $ld = split("[_]",$line);
            $data['id'] =  $ld[0];
            $data['pid'] = $ld[1];
            $data['status'] = $ld[2];
            $data['open'] = $ld[3];
            $data['name'] = $ld[4];
            $data['date'] = date("Y-m-d H:i:s", time());
            $IS_TRUE = $Category->find($data['id']);
            if($IS_TRUE){
                $result = $Category->save($data);
            }else{
                $result = $Category->add($data);
            }
        }
        $json_string = json_encode($MessageArray);
    	echo $json_string;
    }
	
}
?>