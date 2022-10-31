<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport"
		content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="Bookmark" href="/favicon.ico">
	<link rel="Shortcut Icon" href="/favicon.ico" />
	<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
	<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/H-ui.admin.css" />
	<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/skin/default/skin.css" id="skin" />
	<link rel="stylesheet" type="text/css" href="/static/h-ui.admin/css/style.css" />
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
		integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
	<title>管理员列表</title>
</head>

<body>
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span
			class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r"
			style="line-height:1.3em;margin-top:-3px;" href="javascript:location.replace(location.href);" title="刷新"><i
				class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="page-container">
		<form action="<?php echo e(route('view/admin-list')); ?>" method="get">
			<div class="text-c"> 日期范围：
				<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })"
					id="datemin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })"
					id="datemax" class="input-text Wdate" style="width:120px;">
				<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="h" name="h"
					value="<?php echo e($h); ?>">
				<button type="submit" class="btn btn-success" id="" name=""><i
						class="Hui-iconfont">&#xe665;</i>
					搜用户</button>
			</div>
		</form>
		<div class="cl pd-5 bg-1 bk-gray mt-20">
			<span class="l">
				<?php echo $adminModel->deletesBtn('admin/delete'); ?>

				
				<a href="javascript:;" onclick="admin_add('添加管理员','<?php echo e(route('view/admin-add')); ?>','800','500')"
					class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
				<!-- <a href="javascript:;" onclick="admin_add('回收站','<?php echo e(route('view/admin-add')); ?>','800','500')"
					class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> -->
			</span>
			<span class="r">共有数据：<strong>54</strong> 条</span>
		</div>
		<table class="table table-border table-bordered table-bg">
			<thead>
				<tr>
					<th scope="col" colspan="9">员工列表</th>
				</tr>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="40">ID</th>
					<th width="150">登录名</th>
					<th width="100">手机</th>
					<th width="150">邮箱</th>
					<th>角色</th>
					<th width="140">加入时间</th>
					<th width="100">是否已启用</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody id="t-body">
				<?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr class="text-c">
					<td>
						<?php if($admin->id != session('user')->id): ?>
						<input class="checked" type="checkbox" value="<?php echo e($admin->id); ?>" name="checked">
						<?php endif; ?>
					</td>
					<td><?php echo e($admin->id); ?></td>
					<td><?php echo e($admin->username); ?></td>
					<td><?php echo e($admin->phone); ?></td>
					<td><?php echo e($admin->email); ?></td>
					<td><?php echo e($admin->role['role_name']); ?></td>
					<td><?php echo e($admin->created_at); ?></td>
					<td class="td-status">
						<?php if($admin->is_invoke == '1'): ?>
						<span class="label label-success radius">已启用</span>
						<?php else: ?>
						<span class="label label-default radius">已禁用</span>
						<?php endif; ?>
					</td>
					<td class="td-manage">
						<?php if($admin->id != session('user')->id): ?>
						<?php if($admin->is_invoke == '1'): ?>
						<a style="text-decoration:none" onclick="admin_stop(this,'<?php echo e($admin->id); ?>')" href="javascript:;"
							title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
						<a title="编辑" href="javascript:;"
							onclick="admin_edit('管理员编辑','<?php echo e(route('view/admin-add', ['id' => $admin->id])); ?>','<?php echo e($admin->id); ?>','800','500')"
							class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						
							<?php echo $admin->deleteBtn('admin/delete' ,$admin->id); ?>

						<?php else: ?>
						<a onclick="admin_start(this,'<?php echo e($admin->id); ?>')" href="javascript:;" title="启用"
							style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>
						<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo e($admin->id); ?>')" class="ml-5"
							style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
						<?php endif; ?>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tbody>
		</table>
		<?php echo e($admins->withQueryString()->links()); ?>

	</div>
	<!--_footer 作为公共模版分离出去-->
	<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
	<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>
	<!--/_footer 作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/lib/My97DatePicker/4.8/WdatePicker.js"></script>
	<script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/lib/laypage/1.2/laypage.js"></script>
	<script type="text/javascript">
		/*
			参数解释：
			title	标题
			url		请求的url
			id		需要操作的数据id
			w		弹出层宽度（缺省调默认值）
			h		弹出层高度（缺省调默认值）
		*/
		/*管理员-增加*/
		function admin_add(title, url, w, h) {
			layer_show(title, url, w, h);
			// location.reload();
		}
		/*管理员-删除*/
		function admin_del(obj, id) {
			layer.confirm('确认要删除吗？', index => {
				$.ajax({
					type: 'get',
					url: "<?php echo e(route('admin/delete')); ?>",
					data: { id },
					dataType: 'json',
					success: function (data) {
						if (data.code == 200) {
							$(obj).parents("tr").remove();
							layer.msg('已删除!', { icon: 1, time: 2000 });
						} else {
							layer.msg(data.msg, { icon: 2, time: 2000 });
						}
					},
				});
			});
		}

		/*管理员-编辑*/
		function admin_edit(title, url, id, w, h) {
			layer_show(title, url, w, h);
			// location.reload();
		}
		/*管理员-停用*/
		function admin_stop(obj, id) {
			layer.confirm('确认要停用吗？', index => {
				//此处请求后台程序，下方是成功后的前台处理……
				$.ajax({
					type: "get",
					url: "<?php echo e(route('admin/static')); ?>",
					data: { id },
					dataType: "json",
					success: res => {
						if (res.code == 200) {
							$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
							$(obj).parents("tr").find(".td-manage").children('a').eq(2).remove();
							$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
							$(obj).remove();
							layer.msg('已停用!', { icon: 5, time: 2000 });
						} else {
							layer.msg(res.msg, { icon: 5, time: 2000 });
						}
					}
				});
			});
		}

		/*管理员-启用*/
		function admin_start(obj, id) {
			layer.confirm('确认要启用吗？', index => {
				//此处请求后台程序，下方是成功后的前台处理……
				$.ajax({
					type: "get",
					url: "<?php echo e(route('admin/static')); ?>",
					data: { id },
					dataType: "json",
					success: res => {
						if (res.code == 200) {
							$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onclick="admin_stop(this,' + id + ')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a><a title="编辑" href="javascript:;" onclick = "admin_edit(' + '管理员编辑' + ',' + '<?php echo e(route("view/admin-add", ["id" =>' + id + '])); ?>' + ',' + id + ',' + '800' + ',' + '500' + ')" class= "ml-5" style = "text-decoration:none" > <i class="Hui-iconfont">&#xe6df;</i></a><a title="删除" href="javascript:;" onclick="admin_del(this,' + id + ')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');
							$(obj).parents("tr").find(".td-manage").children('a').eq(2).remove();
							$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
							$(obj).remove();
							layer.msg('已启用!', { icon: 6, time: 2000 });
						} else {
							layer.msg(res.msg, { icon: 5, time: 2000 });
						}
					}
				});
			});
		}

		/*批量删除*/
		function datadel() {
			layer.confirm('确认要删除吗？', index => {
				let check = $('.checked');
				let id = [];
				$(check).each((i, v) => {
					if ($(v).prop('checked') == true) {
						id.push($(v).val());
					}
				})
				if (id == '' || id == null) {
					return layer.msg('没有选中要删除的数据', { icon: 2, time: 2000 });
				}
				$.ajax({
					type: "post",
					url: "<?php echo e(route('admin/delete')); ?>",
					data: { id, _token: '<?php echo e(csrf_token()); ?>' },
					dataType: "json",
					success: res => {
						if (res.code == 200) {
							$(check).each((i, v) => {
								if ($(v).prop('checked') == true) {
									$(v).parents("tr").remove();
								}
							});
							layer.msg('已删除!', { icon: 1, time: 2000 });
						} else {
							layer.msg(res.msg, { icon: 2, time: 2000 });
						}
					}
				});
			})
		}
	</script>
</body>

</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/admin/admin-list.blade.php ENDPATH**/ ?>