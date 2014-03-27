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

        $upload = new UploadFile ();
        $upload->maxSize = 3292200;
        $upload->allowExts = explode(',', 'jpg,gif,png,jpeg,mp3,wma,swf,flv');
        mkdirs(Constant::$DEFAULT_UPLOADFILE_TEMPDIR);
        $upload->savePath = Constant::$DEFAULT_UPLOADFILE_TEMPDIR;
        $upload->imageClassPath = '@.ORG.Image';
        $upload->saveRule = 'uniqid';
        $upload->thumbRemoveOrigin = false;
        if (!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        } else {
            $uploadList = $upload->getUploadFileInfo();
            import("@.ORG.Image");
            $_POST ['filename'] = $uploadList [0] ['savename'];
            $_POST ['filetype'] = $uploadList [0] ['extension'];
            $_POST ['filetitle'] = $uploadList [0] ['name'];
        }

        $MessageArray = Results::$MessageArray;
        if ($result) {
            $MessageArray['statusCode'] = Results::$STATUSCODE_OK;
            $MessageArray['message'] = Results::$MESSAGE_OK;
        }

        $filetype = $_POST ['filetype'];
        $MessageArray['fileurl'] = getRemoteURL1() . Constant::$DEFAULT_UPLOADFILE_TEMPDIR_URL . $_POST['filename'];
        $MessageArray['filename'] = $_POST['filename'];
        $MessageArray['filetype'] = $filetype;
        $MessageArray['filetime'] = date("Y年m月d日", time());
        if($filetype == "mp3" || $filetype == "wma"){
            $filesize=abs(filesize(Constant::$DEFAULT_UPLOADFILE_TEMPDIR . $_POST['filename']));
            $MessageArray['filesize'] = $filesize."KB";
        }else{
            list($width, $height, $type, $attr) = getimagesize(Constant::$DEFAULT_UPLOADFILE_TEMPDIR . $_POST['filename']);
             $MessageArray['filesize'] = $width . "×" . $height;
        }
        list($filetitle, $filejp) = split("[.]", $_POST['filetitle']);
        $MessageArray['filetitle'] = $filetitle;


        $json_string = json_encode($MessageArray);
        echo $json_string;
    }

    public function deleteUpload() {
        import("@.ORG.Results");
        $MessageArray = Results::$MessageArray;

        $fileUrl = $_POST['fileUrl'];
        $deletefle = str_replace(getRemoteURL(), ".", $fileUrl);
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
            $savePath = Constant::$DEFAULT_UPLOADFILE_DIR;
            $urlPath = Constant::$DEFAULT_UPLOADFILE;
            if($filetype == "mp3" || $filetype == "wma"){
                $savePath = Constant::$DEFAULT_UPLOADFILE_AUDIO_DIR;
                $urlPath = Constant::$DEFAULT_UPLOADFILE_AUDIO;
            }else if($filetype == "swf" || $filetype == "flv"){
                $savePath = Constant::$DEFAULT_UPLOADFILE_VIEDO_DIR;
                $urlPath = Constant::$DEFAULT_UPLOADFILE_VIEDO;
            }
            mkdirs($savePath);
            $IS_RENAME = rename(Constant::$DEFAULT_UPLOADFILE_TEMPDIR . $filename, $savePath . $filename);
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