<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>后台管理系统</title>
<link rel='stylesheet' id='login-css' href='http://localhost/Public/Css/login.css' type='text/css' media='all' />
<link rel='stylesheet' id='colors-fresh-css' href='http://localhost/Public/Css/colors-fresh.css' type='text/css' media='all' />
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
</script>
</head>
<body class="login">
	<div id="login">
		<h1>
			<a href="http://wordpress.org/">阿尔瓦工作室</a>
		</h1>
		<!-- <div id="login_error">
			新用户注册暂时关闭。<br />
		</div> -->

		<form name="loginform" id="loginform" action="http://alvanews.sourceforge.net/wp-login.php" method="post">
			<p>
				<label>用户名<br /> <input type="text" name="log" id="user_login" class="input" value="" size="20" tabindex="10" /></label>
			</p>
			<p>
				<label>密码<br /> <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>
			</p>
			<p class="forgetmenot">
				<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" /> 记住我的登录信息</label>
			</p>
			<p class="submit">
			<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="登录" tabindex="100" /> 
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