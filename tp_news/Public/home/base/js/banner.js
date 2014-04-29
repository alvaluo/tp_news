var runobj  	= document.getElementById("bansmall").getElementsByTagName("li");	// 徇环的标签
var runnums 	= runobj.length; // 徇环的标签个数
var sss = runnums-vnums;
var mwidth 		= single*runnums;
document.getElementById("ulsmall").style.width = mwidth + "px";
var bar			= document.getElementById("sbar");
var ban1		= document.getElementById("ban1");
var view1		= document.getElementById("view1");
var view2		= document.getElementById("view2");
var banscroll	= document.getElementById("banscroll");
var ulsmall		= document.getElementById("ulsmall");
var bigimg		= document.getElementById("bigimg");
var wh 			= ban1.clientWidth;
var ht 			= ban1.clientHeight;

var ws 			= banscroll.offsetWidth;
var bw         	= bar.clientWidth ? bar.clientWidth : 244;
var view, backs = 0;
var returnnums;						// 回滚长度
var scale 		= single*sss/(ws-bw);
var ctime1, ctime2, interval;

// 右滚
function scrollright() {
	if (pause == 1) {
		// 颜色往后一个
		idnums = nowli.split("_");
		var newidnums = parseInt(idnums[1])+1;
		var newid = "list_" + newidnums;

		moveleft = ulsmall.style.left;
		leftnums = parseInt(moveleft.replace("px", ""));
		if (Math.abs(leftnums) >= sss*single) {
			if (newidnums > runnums) {
				nowli = "list_1";
				// 切换到第一个
				ShowPic(document.getElementById(nowli));
				returncolor (0, 0, "view2");
				if (runnums>vnums) {
					toinit = -single*sss;
					returnnums = Math.abs(toinit);
					ml(toinit, pause);
				}
			} else {
				idint = nowli.split("_");
				var newidnums = parseInt(idint[1])+1;
				var newid = "list_" + newidnums;
				ShowPic(document.getElementById(newid));
			}
		} else {			
			if (newidnums > runnums) {
				nowli = "list_1";
				// 切换到第一个
				ShowPic(document.getElementById(nowli));
				returncolor (0, 0, "view2");
				if (runnums>vnums) {
					toinit = -single*sss;
					returnnums = Math.abs(toinit);
					ml(toinit, pause);
				}
			} else {
				// 向右切换当前项
				idint = nowli.split("_");
				var newidnums = parseInt(idint[1])+1;
				var newid = "list_" + newidnums;
				ShowPic(document.getElementById(newid));
				ml(single, pause);
			}
		}
	}
}
	
// 移动过程
function ml(nums, pause) {
	if (pause == 1) {
			// 左边距转为int型
			// 计算最后一次移动的移动量
			moveleft = ulsmall.style.left;
			leftnums = parseInt(moveleft.replace("px", ""));
			barleft = document.getElementById("sbar").style.left;
			barnums = parseInt(barleft.replace("px", ""));
		if (nums > 0) {
			if (nums - Math.round(single*step) < 0) {
				movenums = nums;
				pause = 0;
			} else
				movenums = Math.round(single*step);
			
			ulsmall.style.left = Math.round(Math.max(-single*sss, Math.min(0, leftnums-movenums))) + 'px';
			nums = nums-Math.round(single*step);				// 还需移动量
			bar.style.left = Math.round(Math.min((ws - bw), Math.max(0, barnums+movenums/scale))) + 'px';
			ctime1 = setTimeout(function () {ml(nums, pause);}, delay);	// 重复移动
		} else if (nums < 0) {
			if (nums - Math.round(returnnums*step) > 0) {
				movenums = nums;
				pause = 0;
			} else
				movenums = Math.round(returnnums*step);
			ulsmall.style.left = Math.round(Math.max(-single*sss, Math.min(0, leftnums+movenums))) + 'px';
			nums = nums+Math.round(returnnums*step);			// 还需移动量

			bar.style.left = Math.round(Math.min((ws - bw), Math.max(0, barnums-movenums/scale))) + 'px';
			
			if (nums > 0)
				nums = 0;
			ctime2 = setTimeout(function () {ml(nums, pause);}, delay);	// 重复移动
		}
	}
}

// 切换当前突然项
function ShowPic(obj) {
	clearTimeout(interval);
	nowli = obj.id;
	for (i=0; i<runnums; i++) {
		if (runobj.item(i) != null) {
			if (runobj.item(i).className == "mainimg2") {
				runobj.item(i).className = "mainimg1";
			}
		}
	}
	obj.className = "mainimg2";
	var lia = document.getElementById(obj.id).getElementsByTagName("a");
	var bighref= document.getElementById("view2").getElementsByTagName("a");
	bighref.item(0).href = lia.item(0).lang;
	document.getElementById("bigimg").src = obj.lang;
	returncolor (0, 0, "view2");
	interval = setInterval('scrollright()', turntimes); 
}

// 大图渐变切换
var m = 5;		// IE 一次增量
var n = 0.1;	// FF 一次增量
var p; 			// IE 不透明
var q;			// FF 不透明
var r;			// IE 透明
var s;			// FF 透明
var k = 0;
function returncolor (r, s, obj) {
	k++;
	if (k <= 100/m) {
		r = r + m;
		s = r / 100;
		document.getElementById(obj).style.filter = "alpha(opacity=" + r + ")";
		document.getElementById(obj).style.opacity = s;
		setTimeout(function(){returncolor(r,s, obj);},delay);
	} else {		
		p = 100; 	// IE 不透明
		q = 1;		// FF 不透明
		r = 0;		// IE 透明
		s = 0;		// FF 透明
		k = 0;
	}
}

// 滚动条位置
bar.onmousedown = function (e) {
	alert("123")
	if (!e) e = window.event;
	var scl = e.screenX - this.offsetLeft;
var bwidth  = ulsmall.style.width;
var intbw   = parseInt(bwidth.replace("px", ""));
var scrollw = bar.style.width;
var intsw   = parseInt(scrollw.replace("px", ""));
var mp = 1;

	ban1.onmousemove = function (e) {
		if (!e) e = window.event;

			bar.style.left = Math.round(Math.min((ws - bw), Math.max(0, e.screenX - scl))) + 'px';
			ulsmall.style.left = Math.round(Math.max(-single*sss, Math.min(0, -(e.screenX - scl)*scale))) + 'px';
		return false;
	}

	ban1.onmouseup = function (e) {
		ban1.onmousemove = null;
		return false;
	}
	return false;
}

// 页面加载
window.onload = function () {
	view1.style.display = "none";
	view2.style.display = "";
	www_helpor_net();
}
/*var scrollFunc=function(e){ 
	var direct; 
	e=e || window.event; 
	
	if(e.wheelDelta){//IE/Opera/Chrome 
		movebar = bar.style.left;
		barnums = parseInt(movebar.replace("px", ""));
		if (!e) e = window.event;
		bar.style.left = Math.round(Math.min((ws - bw), Math.max(0, barnums - event.wheelDelta/2))) + 'px';
		ulsmall.style.left = Math.round(Math.max(-single*sss, Math.min(0, -(barnums - event.wheelDelta/2)*scale))) + 'px';
		return false;
	}else if(e.detail){//Firefox 
		banscroll.addEventListener('DOMMouseScroll', function(e) {
			movebar = bar.style.left;
			barnums = parseInt(movebar.replace("px", ""));
			if (!e) e = window.event;
			bar.style.left = Math.round(Math.min((ws - bw), Math.max(0, barnums + e.detail*20))) + 'px';
			ulsmall.style.left = Math.round(Math.max(-single*sss, Math.min(0, -(barnums + e.detail*20)*scale))) + 'px';
			return false;
		}, false);
	} 
} */
/*注册事件*/ 
/*if(banscroll.addEventListener){ 
banscroll.addEventListener('DOMMouseScroll',scrollFunc,false); 
}*///W3C 
//window.onmousewheel=banscroll.onmousewheel=scrollFunc;//IE/Opera/Chrome/Safari 

// 自动滚动
function www_helpor_net() { 
	interval = setInterval('scrollright()', turntimes); 
} 
	
function stoproll() {pause = 0;}
function startroll() {pause = 1;}
function turnright() {pause = 1; scrollright();pause = 0; }