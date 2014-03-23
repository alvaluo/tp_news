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
    	
		import("@.ORG.UploadFile");
		import("@.ORG.Constant");
		import("@.ORG.Results");
		
		$upload = new UploadFile ();
		$upload->maxSize = 3292200;
		$upload->allowExts = explode ( ',', 'jpg,gif,png,jpeg' );
		$upload->savePath = generateFolderPath(Constant::$DEFAULT_UPLOADFILE_TEMPDIR);
		$upload->imageClassPath = '@.ORG.Image';
		$upload->saveRule = 'uniqid';
		$upload->thumbRemoveOrigin = false;
		if (! $upload->upload ()) {
			$this->error ( $upload->getErrorMsg () );
		} else {
			$uploadList = $upload->getUploadFileInfo ();
			import("@.ORG.Image");
			$_POST ['image'] = $uploadList [0] ['savename'];
			$_POST ['filetype'] = $uploadList [0] ['extension'];
			$_POST ['filetitle'] = $uploadList [0] ['name'];
		}
    	
		//$this->thumbnails = getRemoteURL1().'/Uploads/images/temp/'.$_POST['image'];
    	 
    	/*$Medias = D('Medias');
    	$data = $Medias->create();
    	
    	$data['url'] = getRemoteURL1().'/Uploads/'.$_POST['image'];
    	$data['type'] = "1";
    	$data['comment'] = "1111";
    	
    	$result = $Medias->add($data);*/
    	
    	
    	$MessageArray = Results::$MessageArray;
    	if($result) {
    		$MessageArray['statusCode'] = Results::$STATUSCODE_OK;
    		$MessageArray['message'] = Results::$MESSAGE_OK;
    	}
    	
    	$MessageArray['fileurl'] = getRemoteURL1().Constant::$DEFAULT_UPLOADFILE_TEMPDIR_URL.$_POST['image'];
    	$MessageArray['filename'] = $_POST['image'];
    	$MessageArray['filetype'] = "image/".$_POST ['filetype'];
    	$MessageArray['filetime'] = date("Y年m月d日",time());
    	list($width, $height, $type, $attr) = getimagesize(Constant::$DEFAULT_UPLOADFILE_TEMPDIR.$_POST['image']);
    	$MessageArray['filesize'] = $width."×".$height;
    	list($filetitle, $filejp) = split("[.]", $_POST['filetitle']); 
    	$MessageArray['filetitle'] = $filetitle;
    	
    	
    	$json_string = json_encode($MessageArray);
    	echo $json_string;

    }
    
    public function deleteUpload(){
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	
    	$fileUrl = $_POST['fileUrl'];
    	$deletefle = str_replace(getRemoteURL(), ".", $fileUrl);
    	echo $deletefle;
    	if (file_exists($deletefle)) {
    		$IS_DELETE = unlink ($deletefle);
    		if($IS_DELETE){
    			$MessageArray['statusCode'] = Results::$STATUSCODE_OK;
    			$MessageArray['message'] = Results::$MESSAGE_OK;
    			$filename = current(explode('.',substr($fileUrl,strripos($fileUrl,"/")+1)));
    			$MessageArray['filename'] = $filename;
    		}
    	}
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
    
    public function saveUpload(){
    	import("@.ORG.Constant");
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	
    	$MessageArray['status'] = false;
    	$MessageArray['resultId'] = '';
    	
    	$filename = $_POST['filename'];
    	if(!empty($filename)){
    		$IS_RENAME = rename(Constant::$DEFAULT_UPLOADFILE_TEMPDIR.$filename,Constant::$DEFAULT_UPLOADFILE_DIR.$filename);
    		if($IS_RENAME){
    			$Medias = D('Medias');
    			$data = $Medias->create();
    			$data['url'] = getRemoteURL().Constant::$DEFAULT_UPLOADFILE.$filename;
    			if($data){
    				$result = $Medias->add($data);
    				$MessageArray['resultId'] = reset(explode(".",$filename));
    				if($result){
    					$MessageArray['status'] = true;
    				}
    			}
    		}
    	}
    	
    	$MessageArray['navTabId'] = 8;
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
    }
    
    public function delete() {
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    
    	$id = $_GET['id'];
    
    	$Medias = M('Medias');
    	$data = $Medias->find($id);
    	$list = $Medias->delete($id);
    	$deletefle = str_replace(getRemoteURL(), ".", $data['url']);
    	if (file_exists($deletefle)) {
    		unlink ($deletefle);
    	}
    	if ($list !== false) {
    		$MessageArray['statusCode'] = Results::$STATUSCODE_OK;
    		$MessageArray['message'] = Results::$MESSAGE_OK;
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