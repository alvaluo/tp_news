<?php
class RulesAction extends Action{
	
	public function lists() {
		// select list roles
		$Roles = M('Roles');
		$data = $Roles -> where($map) -> select();
		$this->data = $data;
    	$this->display();
	}
	
	public function editRole() {
		$id = $_GET['id'];
		if(!empty($id)){
			$Roles = M('Roles');
			$data =   $Roles->find($id);
			if($data) {
				$this->data = $data;
			}
		}
		$this->display();
	}	
	
	public function updateRole() {
		//import result class
		import("@.ORG.Results");
		$MessageArray = Results::$MessageArray;
		$id = $_POST['id'];
		 
		$Roles = D('Roles');
		if(empty($id)){
			if ($vo = $Roles->create()) {
				$list = $Roles->add();
				if ($list !== false) {
					$MessageArray['statusCode'] = 200;
					$MessageArray['message'] = "操作成功!";
					$MessageArray['callbackType'] = "closeCurrent";
					$MessageArray['navTabId'] = "rulesList";
				}
			}
		}else{
			$data = $Roles->create();
		 	if($data) {
				$result = $Roles->save($data);
				if($result) {
					$MessageArray['statusCode'] = 200;
					$MessageArray['message'] = "操作成功!";
					$MessageArray['callbackType'] = "closeCurrent";
					$MessageArray['navTabId'] = "rulesList";
				}
			}
		}
		 
		$json_string = json_encode($MessageArray);
		echo $json_string;
	}
	
	
	public function deleteRole() {
		//import result class
    	import("@.ORG.Results");
    	$MessageArray = Results::$MessageArray;
    	
    	$id = $_GET['id'];
    	
    	$Roles = M('Roles');
    	$list = $Roles->delete($id);
    	if ($list !== false) {
    		$MessageArray['statusCode'] = 200;
    		$MessageArray['message'] = "操作成功!";
    		$MessageArray['navTabId'] = "rulesList";
    	}
    	
    	$json_string = json_encode($MessageArray);
    	echo $json_string;
	}
	
	public function editModule() {
		
		$id = $_GET['id'];
		$this->id = $id;
		
		$Roles = M('Roles');
		$data =  $Roles->find($id);
		$mid = $data['mid'];
		$midarry = explode(",",$mid);
		
		$Modules = M('Modules');
		$dataModules = $Modules -> where($map) -> order('mrid asc') -> select();
		$this->dataModules = $dataModules;
		
		$dataParentModules = null;
		$dataNodeModules = null;
		foreach ($dataModules as $dataNode){
			if($dataNode['mrid'] == 0){
				$dataParentModules[$dataNode['id']] = $dataNode;
			}else{
				$dataNodeModules[$dataNode['mrid']][$dataNode['id']] = $dataNode;
			}
		}
		$this->dataParentModules = $dataParentModules;
		$this->dataNodeModules = $dataNodeModules;
		
		foreach ($dataParentModules as $dataParentModules1){
			$treeHtml .= "<li><a tname='moduleid[]' tvalue='".$dataParentModules1['id']."'>".$dataParentModules1['modulename']."</a>";
			$node = $dataNodeModules[$dataParentModules1['id']];
			foreach ($node as $node1){
				$checked = "";
				if(in_array($node1['id'],$midarry)){
					$checked = "checked='true'";
				}
				$treeHtml .= "<ul><li><a tname='moduleid[]' tvalue='".$node1['id']."' ".$checked.">".$node1['modulename']."</a>";
				$treeHtml .= "</li></ul>";
			}
			$treeHtml .= "</li>";
		}
		$this->treeHtml = $treeHtml;
		
		$this->display();
	}
	
	public function updateModule() {
		//import result class
		import("@.ORG.Results");
		$MessageArray = Results::$MessageArray;
		$roleid = $_POST['roleid'];
		
		$mid = "";
// 		$modulesid = $_REQUEST['moduleid'];
		$modulesid = $_POST['moduleid'];
		
		if(!empty($modulesid)){
			$mid = implode(',',$modulesid);
			$data['id'] = $roleid;
			$data['mid'] = $mid;
			
			$Roles = M('Roles');
			$result = $Roles -> save($data);
			if ($result !== false) {
				$MessageArray['statusCode'] = 200;
				$MessageArray['message'] = "操作成功!";
				$MessageArray['navTabId'] = "rulesList";
			}
		}
		
			
		$json_string = json_encode($MessageArray);
		echo $json_string;
	}
}
?>