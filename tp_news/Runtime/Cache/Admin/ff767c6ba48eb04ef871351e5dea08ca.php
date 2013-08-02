<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" method="post" action="__APP__/Admin/Users/lists">
	<input type="hidden" name="userName" value="<?php echo ($userName); ?>">
	<input type="hidden" name="inputTime" value="<?php echo ($inputTime); ?>" />
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="__APP__/Admin/Users/lists" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						查找用户：<input type="text" id="username" name="username" value="<?php echo ($userName); ?>"/>
					</td>
					<td>
						注册时间：<input type="text" class="date" readonly="true" name="inputTime" value="<?php echo ($inputTime); ?>"/>
					</td>
					<td>
						<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="add" href="__APP__/Admin/Users/edit" target="dialog" rel="dlg_Add" mask="true"><span>添加</span></a></li>
				<li><a class="delete" href="__APP__/Admin/Users/delete/a_id/{sid_user}" target="navTabTodo" title="确定要删除吗?"><span>删除</span></a></li>
				<li><a class="edit" href="__APP__/Admin/Users/edit/a_id/{sid_user}" target="dialog" rel="dlg_Add" mask="true"><span>修改</span></a></li>
				<li class="line">line</li>
				<li><a class="icon" href="javascript:void(0);"><span>导入EXCEL</span></a></li>
			</ul>
		</div>
		<table class="table" layouth="112">
			<thead>
				<tr>
					<th width="80"></th>
					<th width="120">用户名</th>
					<th width="150">密码</th>
					<th width="150">真实姓名</th>
					<th width="150">注册时间</th>
					<th width="150">最后在线时间</th>
					<th width="150">邮件地址</th>
					<th width="150">锁定</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 5 );++$i;?><tr target="sid_user" rel="<?php echo ($vo["id"]); ?>">
					<td><?php echo ($i); ?></td>
					<td><?php echo ($vo["username"]); ?></td>
					<td>***********</td>
					<td><?php echo ($vo["realname"]); ?></td>
					<td><?php echo ($vo["createtime"]); ?></td>
					<td><?php echo ($vo["lasttime"]); ?></td>
					<td><?php echo ($vo["email"]); ?></td>
					<td><?php echo ($vo["locked"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>显示</span>
				<select class="combox" id="numPerPage" name="numPerPage" change="navTabPageBreak" param="numPerPage">
					<option value="5">5</option>
					<option value="20">20</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				<span>条，共<?php echo ($count); ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo ($countSize); ?>" numPerPage="1" pageNumShown="10" currentPage="<?php echo ($currentPage); ?>"></div>

		</div>
	</div>
</div>
<script type="text/javascript">
$("#numPerPage option[value='<?php echo ($record); ?>']").attr("selected",true);
</script>