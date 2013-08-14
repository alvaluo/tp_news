<?php

function getIndexModules($mid){
	if(!empty($mid)){
		$Modules = M('Modules');
		//select * from modules where id in(1,2) or id in(select mrid from modules where id in(1,2))
// 		$dataModules = $Modules -> where(array('id' => array('in', $mid))) -> select();
// 		$dataModules = $Modules -> where($map) -> select();
		$dataModules = $Modules -> where('id in('.$mid.') or id in(select mrid from modules where id in('.$mid.'))') -> select();
		
		$dataParentModules = null;
		$dataNodeModules = null;
		foreach ($dataModules as $dataNode){
			if($dataNode['mrid'] == 0){
				$dataParentModules[$dataNode['id']] = $dataNode;
			}else{
				$dataNodeModules[$dataNode['mrid']][$dataNode['id']] = $dataNode;
			}
		}
		
		foreach ($dataParentModules as $dataParentModules1){
			$treeHtml .= "<div class='accordionHeader'><h2><span>Folder</span>".$dataParentModules1['modulename']."</h2></div>";
			$node = $dataNodeModules[$dataParentModules1['id']];
			$treeHtml .= "<div class='accordionContent'><ul class='tree treeFolder'>";
			foreach ($node as $node1){
				$treeHtml .= "<li><a href='".$node1['moduleurl']."' target='navTab' rel='".$node1['id']."'>".$node1['modulename']."</a></li>";
			}
			$treeHtml .= "</ul>";
			$treeHtml .= "</div>";
			 
			 
		}
	}
    return $treeHtml;
}