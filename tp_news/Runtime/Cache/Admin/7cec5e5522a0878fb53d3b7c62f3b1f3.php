<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>后台管理系统</title>
<link rel='stylesheet' id='login-css' href='__PUBLIC__/css/login.css' type='text/css' media='all' />
<link rel='stylesheet' id='colors-fresh-css' href='__PUBLIC__/css/colors-fresh.css' type='text/css' media='all' />
<script src="__DWZ__/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="__DWZ__/js/jquery.validate.js" type="text/javascript"></script>
<style type="text/css" media="screen">
* {
	font: 12px Segoe UI, Tahoma, Arial, Verdana, simsun, sans-serif,"Microsoft YaHei";
}
</style>
<meta name='robots' content='noindex,nofollow' />
<script type="text/javascript">
function login_q(){
	addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
	function s(id,pos){g(id).left=pos+'px';}
	function g(id){return document.getElementById(id).style;}
	function shake(id,a,d){c=a.shift();s(id,c);if(a.length>0){setTimeout(function(){shake(id,a,d);},d);}else{try{g(id).position='static';wp_attempt_focus();}catch(e){}}}
	addLoadEvent(function(){ var p=new Array(15,30,15,0,-15,-30,-15,0);p=p.concat(p.concat(p));var i=document.forms[0].id;g(i).position='relative';shake(i,p,20);});
}
$().ready(function() {
	$("#loginform").submit(function(){
		var log = $("#log").val();
		var pwd = $("#pwd").val();
		if(log == "" || pwd == ""){
			$("#login_error").show();
			login_q();
			$("#login_error").html("用户名密码不能为空!");
			return false;
		}
	})
	$("#log").bind("blur",function(){
		var log = $(this).val();
		if(log == ""){
			$(this).focus();
			$("#login_error").show();
			$("#login_error").html("用户名密码不能为空!");
			login_q();
		}else{
			$("#login_error").hide();
			//$('#pwd').trigger("blur");
		}
	})
	$("#pwd").bind("blur",function(){
		var pwd = $(this).val();
		if(pwd == ""){
			$(this).focus();
			$("#login_error").show();
			$("#login_error").html("用户名密码不能为空!");
			login_q();
		}else{
			$("#login_error").hide();
			//$('#log').trigger("blur");
		}
	})
});
</script>
</head>
<body class="login">
	<div id="login">
		<h1>
			<a href="javascript:window.location.reload();" title="科研特科技">科研特科技</a>
		</h1>
		<?php if(!empty($login_msg)): ?><div id="login_error"><?php echo ($login_msg); ?><br /></div><?php endif; ?>
		<div id="login_error" style="display: none;">用户名密码不能为空!</div>

		<form name="loginform" id="loginform" action="__APP__/admin/index/index" method="post">
			<p>
				<label>用户名<br /> <input type="text" name="log" id="log" class="input" value="" size="20" tabindex="10"/></label>
			</p>
			<p>
				<label>密码<br /> <input type="password" name="pwd" id="pwd" class="input" value="" size="20" tabindex="20"/></label>
			</p>
			<p class="forgetmenot">
				<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> 记住我的登录信息</label>
			</p>
			<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="登录" tabindex="100"/> 
			<input type="hidden" name="redirect_to" value="http://alvanews.sourceforge.net/wp-admin/" /> 
			<input type="hidden" name="testcookie" value="1" />
			</p>
		</form>

		<p id="nav">
			<a href="http://alvanews.sourceforge.net/wp-login.php?action=lostpassword" title="找回密码">忘记密码？</a>
		</p>

		<script type="text/javascript">
		function wp_attempt_focus(){
			setTimeout( function(){ 
				try{
					d = document.getElementById('user_login');
					d.focus();
					d.select();
				} catch(e){}
			}, 200);
		}
		if(typeof wpOnload=='function')wpOnload();
		</script>

		<p id="backtoblog">
			<a href="http://alvanews.sourceforge.net/" title="不知道自己在哪？">回到 首頁</a>
		</p>
	</div>


</body>
</html>