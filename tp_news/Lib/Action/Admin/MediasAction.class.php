<?php
class MediasAction extends Action{
	
  public function lists() {
        $map = null;
    	$companyname = $_POST['companyname'];
    	if(!empty($companyname)){
    		$this->companyname = $companyname;
    		$map['companyname'] = array('like','%'.$companyname.'%');
    	}
    	$Medias = M('Medias');
    	$count = $Medias->where($map) -> count();
    	
    	//import default page size
    	import("@.ORG.Constant");
    	$pageSize = Constant::$DEFAULT_PAGE_SIZE;
    	
    	$numPerPage = isset($_POST["numPerPage"])?$_POST["numPerPage"]:$pageSize;
    	$this->numPerPage = $numPerPage;
    	
    	import('ORG.Util.Page');
    	$Page = new Page($count,$numPerPage);
    	$pageNum = isset($_POST['pageNum'])?$_POST['pageNum']:1;
    	$this->pageNum = $pageNum;
    	
    	$data = $Medias->where($map) -> order('createtime desc') -> page($pageNum.','.$Page->listRows) -> select();

    	$this->totalRows = $Page->totalRows;
    	$this->totalPages = $Page->totalPages;
    	$this->data = $data;
    	$this->display();
    }
    
    public function edit() {
    	$id = $_GET['id'];
    	if(!empty($id)){
    		$Medias = M('Medias');
    		$data =   $Medias->find($id);
    		if($data) {
    			$this->data = $data;
    		}
    	}
    	$this->display();
    }
    
    public function upload() {
    	
		import ( "@.ORG.UploadFile" );
		$upload = new UploadFile ();
		$upload->maxSize = 3292200;
		$upload->allowExts = explode ( ',', 'jpg,gif,png,jpeg' );
		$upload->savePath = './Uploads/';
		$upload->imageClassPath = '@.ORG.Image';
		$upload->saveRule = 'uniqid';
		$upload->thumbRemoveOrigin = false;
		if (! $upload->upload ()) {
			$this->error ( $upload->getErrorMsg () );
		} else {
			$uploadList = $upload->getUploadFileInfo ();
			import ( "@.ORG.Image" );
			$_POST ['image'] = $uploadList [0] ['savename'];
		}
    	

    	 
    	$Medias = D('Medias');
    	$data = $Medias->create();
    	
    	$data['url'] = getRemoteURL1().'/Uploads/'.$_POST['image'];
    	$data['type'] = "1";
    	$data['comment'] = "1111";
    	
    	$result = $Medias->add($data);
    	
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	if($result) {
    		$MessageArray['statusCode'] = 200;
    		$MessageArray['message'] = "操作成功!";
    	}
    	
    	$MessageArray['url'] = $data['url'];
    	$MessageArray['name'] = $_POST['image'];
    	
    	$json_string = json_encode($MessageArray);
    	echo $json_string;

    }
    
    public function delete() {
    	//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    
    	$id = $_GET['id'];
    
    	$Medias = M('Medias');
    	$data = $Medias->find($id);
    	$list = $Medias->delete($id);
    	$deletefle = str_replace(getRemoteURL1(), ".", $data['url']);
    	if (file_exists($deletefle)) {
    		unlink ($deletefle);
    	}
    	if ($list !== false) {
    		$MessageArray['statusCode'] = 200;
    		$MessageArray['message'] = "操作成功!";
    	}
    
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
    
    public function view() {
    	$id = $_GET['id'];
    	if(!empty($id)){
    		$Medias = M('Medias');
    		$data =   $Medias->find($id);
    		if($data) {
    			$this->data = $data;
    		}
    	}
    	$this->display();
    }
	
}
?>