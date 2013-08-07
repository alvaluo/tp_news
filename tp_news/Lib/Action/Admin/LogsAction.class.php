<?php
class LogsAction extends Action{
	
	public function lists() {
		$map = null;
		$username = $_POST['username'];
		if(!empty($username)){
			$this->username = $username;
			$map['username'] = array('like','%'.$username.'%');
		}
		$createtime = $_POST['createtime'];
		if(!empty($createtime)){
			$this->createtime = $createtime;
			$map['createtime'] = array('like',$createtime.'%');
		}

		$Logs = M('Logs');
		$count = $Logs->where($map) -> count();

		//import default page size
    	import("@.ORG.Constant");
    	$pageSize = Constant::$DEFAULT_PAGE_SIZE;
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $Logs ->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();
    	
    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
	}
	
	public function delete() {
		//import result class
		import("@.ORG.Results");
		$MessageArray = Results::$MessageArray;
		 
		$id = $_GET['id'];
		 
		$Logs = M('Logs');
		$list = $Logs->delete($id);
		if ($list !== false) {
			$MessageArray['statusCode'] = 200;
			$MessageArray['message'] = "操作成功!";
			$MessageArray['navTabId'] = "logsList";
		}
		 
		$json_string = json_encode($MessageArray);
		echo $json_string;
	}
}
?>