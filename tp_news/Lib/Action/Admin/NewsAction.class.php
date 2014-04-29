<?php
class NewsAction extends Action{
	
  public function lists() {
    	$map = null;
    	$companyname = $_POST['companyname'];
    	if(!empty($companyname)){
    		$this->companyname = $companyname;
    		$map['companyname'] = array('like','%'.$companyname.'%');
    	}
    	$News = M('News');
    	$count = $News->where($map) -> count();
    	
    	//import default page size
    	import("@.ORG.Constant");
    	$pageSize = Constant::$DEFAULT_PAGE_SIZE;
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $News ->field('ns.*,cat.name as categoryname')
    	-> table('news ns left join category cat on cat.id = ns.categoryid')
    	->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();

    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
    }
    
    public function edit() {
    	$Category = M('Category');
    	$CategoryData = $Category->where()->select();
    	$this->CategoryData = $CategoryData;
    	
    	$id = $_GET['id'];
    	$News = M('News');
    	if(!empty($id)){
    		$data =   $News->find($id);
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
    	 
    	$News = D('News');
    	if(empty($id)){
    		if ($vo = $News->create()) {
    			$list = $News->add();
    			if ($list !== false) {
    				$MessageArray['statusCode'] = Results::$STATUSCODE_OK;
    				$MessageArray['message'] = Results::$MESSAGE_OK;
    				$MessageArray['callbackType'] = "closeCurrent";
    				$MessageArray['navTabId'] = $_REQUEST['navtab'];
    			}
    		}
    	}else{
    		$data = $News->create();
			if($data) {
				$result = $News->save($data);
				if($result) {
					$MessageArray['statusCode'] = Results::$STATUSCODE_OK;
            		$MessageArray['message'] = Results::$MESSAGE_OK;
					$MessageArray['callbackType'] = "closeCurrent";
					$MessageArray['navTabId'] = $_REQUEST['navtab'];
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
    	 
    	$News = M('News');
    	$list = $News->delete($id);
    	if ($list !== false) {
    		$MessageArray['statusCode'] = Results::$STATUSCODE_OK;
            $MessageArray['message'] = Results::$MESSAGE_OK;
    	}
    	 
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
    
    
    public function editCategory(){
        $Category = M('Category');
    	$data = $Category->where()->select();
    	$maxId = $Category->max('id');
        $this->data = $data;
        $this->maxId = $maxId;
        $this->display();
    }
    
    public function updateCateory(){
        import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
        
        $line_data = $this->_request("line_data");
        $Category = D('Category');
        foreach($line_data as $line){
        	$ld = split("[_]",$line);
        	$data['id'] =  $ld[0];
        	$IS_TRUE = $Category->find($data['id']);
        	if(!$IS_TRUE){
        		$data = $Category->create();
        	}
        	$data['pid'] = $ld[1];
        	$data['status'] = $ld[2];
        	$data['open'] = $ld[3];
        	$data['name'] = $ld[4];
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