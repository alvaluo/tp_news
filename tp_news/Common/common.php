<?php
/**
 * Admin - section to generate
 * @param unknown $mid
 * @return string
 */
function getIndexModules($mid){
	if(!empty($mid)){
		$Modules = M('Modules');
		$dataModules = $Modules -> where('id in('.$mid.') or id in(select mrid from modules where id in('.$mid.'))')
				-> order('sort,mrid asc') -> select();
		
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
				$treeHtml .= "<li><a href='".$node1['moduleurl']."/navtab/".$node1['id']."' target='navTab' rel='".$node1['id']."'>".$node1['modulename']."</a></li>";
			}
			$treeHtml .= "</ul>";
			$treeHtml .= "</div>";
		}
	}
    return $treeHtml;
}
function getUser($log,$pwd){
	if(!empty($log) && !empty($pwd)){
		$Users = M('Users');
		$map['username']  = $log;
		$data = $Users ->field('u.*,r.rolename,r.mid')-> table('users u')->join('roles r on u.roleid = r.id')-> where($map) -> find();
		if($data && strcmp($pwd,$data['password'])==0) {
			return $data;
		}
	}
	return null;
}
function setLog($log,$comment){
	$Logs = D('Logs');
	$dataLog = $Logs->create();
	$dataLog['username'] = $log;
	$dataLog['ip'] = get_client_ip();
	$dataLog['agent']= $_SERVER['HTTP_USER_AGENT'];
	$dataLog['comment']= $comment;
	$Logs->add($dataLog);
}
function setDataForSession($userData,$userRuleTag){
	$current_user['user'] = $userData;
	$current_user['ruleTag'] = $userRuleTag;
	session('__USERCONF',$current_user);
}



/**
 * 前台
 * 获取页面
 */
function pagesList(){
	$Pages = M('Pages');
	$data = $Pages -> where(array("status"=>1)) -> order('sort asc') -> select();
	return $data;
}
/**
 * 前台
 * 获取站点信息
 * @param unknown $field
 */
function webInfo($field){
	$Enterprise = M('Enterprise');
	$data = $Enterprise -> where(array("type"=>1)) -> select();
	$field = $data[0][$field];
	return $field;
}
function webInfoSplit($field,$start,$end){
	$field = webInfo($field);
	$field = msubstr($field, $start,$end);
	return $field;
}
/**
 * 字符串分割
 * @param unknown $str
 * @param number $start
 * @param unknown $length
 * @param string $charset
 * @param string $suffix
 * @return string|unknown
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
	if(function_exists("mb_substr")){
		if ($suffix && strlen($str)>$length)
			return mb_substr($str, $start, $length, $charset)."...";
		else
			return mb_substr($str, $start, $length, $charset);
	}
	elseif(function_exists('iconv_substr')) {
		if ($suffix && strlen($str)>$length)
			return iconv_substr($str,$start,$length,$charset)."...";
		else
			return iconv_substr($str,$start,$length,$charset);
	}
	$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}
function getRemoteURL1(){
	$url = 'http://'.$_SERVER['HTTP_HOST'];
	return $url;
}
function generateFolderPath($path){
	if(!file_exists($path)){
		mkdir($path);
	}
	return $path;
}
function mkdirs($dir)
{
    if(!is_dir($dir))
    {
        if(!mkdirs(dirname($dir))){
            return false;
        }
        if(!mkdir($dir,0777)){
            return false;
        }
    }
    return true;
}
function getMediaTypePath($type,$filename){
    import("@.ORG.Constant");
    if($type == "jpg" || $type == "gif" || $type == "png" || $type == "jpeg"){
        Constant::$DEFAULT_UPLOADFILE_TEMPDIR;
    }
}