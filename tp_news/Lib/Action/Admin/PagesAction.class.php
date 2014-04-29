<?php 

class PagesAction extends Action{
	
	public function lists() {
		
		$Pages = M('Pages');
		$count = $Pages->where($map) -> count();
		
		//import default page size
		import("@.ORG.Constant");
		$pageSize = Constant::$DEFAULT_PAGE_SIZE;
		 
		$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
		$this->numPerPage = $numPerPage;
		 
		import('ORG.Util.Page');
		$Page = new Page($count,$numPerPage);
		$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
		$this->pageNum = $pageNum;
		 
		$data = $Pages ->field('p.*,p1.title as  mtitle')
			-> table('pages p left join pages p1 on   p1.id = p.parent')
			-> where($map) -> order('time desc') -> page($pageNum.','.$Page->listRows) -> select();
		 
		$this->totalRows = $Page->totalRows;
		$this->totalPages = $Page->totalPages;
		$this->data = $data;
		
		$this->display();
	}
	
	
	public function edit() {
		$Pages = M('Pages');
		$parentDataPage = $Pages -> where(array("parent"=>"0")) -> select();
		$this -> parentDataPage = $parentDataPage;
		
		$id = $_GET['id'];
		if(!empty($id)){
			$data =   $Pages->find($id);
			if($data) {
				$this->data = $data;
			}
		}else{
			$data['url'] = getRemoteURL()."/index.php";
			$this->data = $data;
		}
		$this->display();
	}
	
	public function update() {
		//import result class
		import("@.ORG.Results");
		$MessageArray = Results::$MessageArray;
		$id = $_POST['id'];
			
		$Pages = D('Pages');
		if(empty($id)){
			if ($vo = $Pages->create()) {
				$list = $Pages->add();
				if ($list !== false) {
					$MessageArray['statusCode'] = 200;
					$MessageArray['message'] = "操作成功!";
					$MessageArray['callbackType'] = "closeCurrent";
// 					$MessageArray['navTabId'] = "6";
				}
			}
		}else{
			$data = $Pages->create();
			if($data) {
				$result = $Pages->save($data);
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
			
		$Pages = M('Pages');
		$list = $Pages->delete($id);
		if ($list !== false) {
			$MessageArray['statusCode'] = 200;
			$MessageArray['message'] = "操作成功!";
		}
			
		$json_string = json_encode($MessageArray);
		echo $json_string;
	}
}