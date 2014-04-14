<?php

class MediasAction extends Action {

    public function lists() {
        $map = null;
        $companyname = $_POST['companyname'];
        if (!empty($companyname)) {
            $this->companyname = $companyname;
            $map['companyname'] = array('like', '%' . $companyname . '%');
        }
        $Medias = M('Medias');
        $count = $Medias->where($map)->count();

        //import default page size
        import("@.ORG.Constant");
        $pageSize = Constant::$DEFAULT_PAGE_SIZE;

        $numPerPage = isset($_POST["numPerPage"]) ? $_POST["numPerPage"] : $pageSize;
        $this->numPerPage = $numPerPage;

        import('ORG.Util.Page');
        $Page = new Page($count, $numPerPage);
        $pageNum = isset($_POST['pageNum']) ? $_POST['pageNum'] : 1;
        $this->pageNum = $pageNum;

        $data = $Medias->where($map)->order('createtime desc')->page($pageNum . ',' . $Page->listRows)->select();

        $this->totalRows = $Page->totalRows;
        $this->totalPages = $Page->totalPages;
        $this->data = $data;
        $this->display();
    }

    public function edit() {
        $id = $_GET['id'];
        if (!empty($id)) {
            $Medias = M('Medias');
            $data = $Medias->find($id);
            if ($data) {
                $this->data = $data;
            }
        }
        $this->display();
    }

    public function upload() {

        import("@.ORG.UploadFile");
        import("@.ORG.Constant");
        import("@.ORG.Results");
        import("@.ORG.Image");
        $MessageArray = Results::$MessageArray;

        $upload = new UploadFile ();
        $upload->maxSize = 3292200;
        $upload->allowExts = explode(',', 'jpg,gif,png,jpeg,mp3,wma,swf,flv');
        $UPLOAD_PATH_TYPE_T = Constant::$UPLOAD_PATH.Constant::$PATH_X.Constant::$UPLOAD_TYPE_T.Constant::$PATH_X;
        mkdirs(Constant::$PATH_D.$UPLOAD_PATH_TYPE_T);
        $upload->savePath = Constant::$PATH_D.$UPLOAD_PATH_TYPE_T;
        $upload->imageClassPath = '@.ORG.Image';
        $upload->saveRule = 'uniqid';
        $upload->thumbRemoveOrigin = false;
        if (!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        } else {
            $uploadList = $upload->getUploadFileInfo();
            $savename = $uploadList [0] ['savename'];
            $extension = $uploadList [0] ['extension'];
            $name = $uploadList [0] ['name'];

            $MessageArray['fileurl'] = getRemoteURL1() . $UPLOAD_PATH_TYPE_T . $savename;
            $MessageArray['filename'] = $savename;
            $MessageArray['filetype'] = $extension;
            $MessageArray['filetime'] = date("Y年m月d日", time());
            if($extension == "mp3" || $extension == "wma"){
                $filesize=abs(filesize($UPLOAD_PATH_TYPE_T . $savename));
                $MessageArray['filesize'] = $filesize."KB";
            }else{
                list($width, $height, $type, $attr) = getimagesize(Constant::$PATH_D.$UPLOAD_PATH_TYPE_T . $savename);
                $MessageArray['filesize'] = $width . "×" . $height;
            }
            list($filetitle, $filejp) = split("[.]",$name);
            $MessageArray['filetitle'] = $filetitle;

            $MessageArray['statusCode'] = Results::$STATUSCODE_OK;
            $MessageArray['message'] = Results::$MESSAGE_OK;

        }
        $json_string = json_encode($MessageArray);
        echo $json_string;
    }

    public function deleteUpload() {
        import("@.ORG.Results");
        $MessageArray = Results::$MessageArray;

        $fileUrl = $_POST['fileUrl'];
        $deletefle = str_replace(getRemoteURL1(), ".", $fileUrl);
        if (file_exists($deletefle)) {
            $IS_DELETE = unlink($deletefle);
            if ($IS_DELETE) {
                $MessageArray['statusCode'] = Results::$STATUSCODE_OK;
                $MessageArray['message'] = Results::$MESSAGE_OK;
                $filename = current(explode('.', substr($fileUrl, strripos($fileUrl, "/") + 1)));
                $MessageArray['filename'] = $filename;
            }
        }
        $json_string = json_encode($MessageArray);
        echo $json_string;
    }

    public function saveUpload() {
        import("@.ORG.Constant");
        import("@.ORG.Results");
        $MessageArray = Results::$MessageArray;

        $MessageArray['status'] = false;
        $MessageArray['resultId'] = '';

        $filename = $_POST['filename'];
        $filetype = $_POST['filetype'];
        if (!empty($filename)) {
            if($filetype == "jpg" || $filetype == "gif" || $filetype == "png" || $filetype == "jpeg"){
                $UPLOAD_TYPE = Constant::$UPLOAD_TYPE_I;
            }else if($filetype == "mp3" || $filetype == "wma"){
                $UPLOAD_TYPE = Constant::$UPLOAD_TYPE_A;
            }else if($filetype == "swf" || $filetype == "flv"){
                $UPLOAD_TYPE = Constant::$UPLOAD_TYPE_M;
            }
            if(!empty($UPLOAD_TYPE)){
                $UPLOAD_PATH_TYPE_T = Constant::$PATH_D.Constant::$UPLOAD_PATH.Constant::$PATH_X.Constant::$UPLOAD_TYPE_T.Constant::$PATH_X;
                $savePath =Constant::$UPLOAD_PATH.Constant::$PATH_X.$UPLOAD_TYPE.Constant::$PATH_X;
                $urlPath = $savePath;
                mkdirs(Constant::$PATH_D.$savePath);
                $IS_RENAME = rename($UPLOAD_PATH_TYPE_T . $filename,  Constant::$PATH_D.$savePath . $filename);
                if ($IS_RENAME) {
                    $Medias = D('Medias');
                    $data = $Medias->create();
                    $data['url'] = getRemoteURL() . $urlPath. $filename;
                    if ($data) {
                        $result = $Medias->add($data);
                        $MessageArray['resultId'] = reset(explode(".", $filename));
                        if ($result) {
                            $MessageArray['status'] = true;
                        }
                    }
                }
            }
        }

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
            unlink($deletefle);
        }
        if ($list !== false) {
            $MessageArray['statusCode'] = Results::$STATUSCODE_OK;
            $MessageArray['message'] = Results::$MESSAGE_OK;
        }

        $json_string = json_encode($MessageArray);
        echo $json_string;
    }

    public function deleteAll(){
        import("@.ORG.Results");
        $MessageArray = Results::$MessageArray;

        $selectIdx =  $this->_post("selectIdx");
        foreach($selectIdx as $id){
            $Medias = M('Medias');
            $data = $Medias->find($id);
            if ($data) {
                $list = $Medias->delete($id);
                $deletefle = str_replace(getRemoteURL(), ".", $data['url']);
                if (file_exists($deletefle)) {
                    unlink($deletefle);
                }
                /*if ($list !== false) {
                    $MessageArray['statusCode'] = Results::$STATUSCODE_OK;
                    $MessageArray['message'] = Results::$MESSAGE_OK;
                }*/
            }
        }

        $MessageArray['statusCode'] = Results::$STATUSCODE_OK;
        $MessageArray['message'] = Results::$MESSAGE_OK;

        $json_string = json_encode($MessageArray);
        echo $json_string;
    }

    public function view() {
        $id = $_GET['id'];
        if (!empty($id)) {
            $Medias = M('Medias');
            $data = $Medias->find($id);
            if ($data) {
                $this->data = $data;
            }
        }
        $this->display();
    }

}

?>