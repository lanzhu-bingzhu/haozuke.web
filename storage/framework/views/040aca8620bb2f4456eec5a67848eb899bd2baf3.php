﻿<!--_meta 作为公共模版分离出去-->
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
	<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
	<!--/meta 作为公共模版分离出去-->

	<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
	<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
	<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
	<article class="page-container">
		<form method="post" class="form form-horizontal" id="form-admin-role-add">
			<input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
			<input type="hidden" name="role_id" value="<?php echo e($id); ?>">
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">角色权限分配：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<?php $__currentLoopData = $powers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $power): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<dl class="permission-list">
						<dt>
							<label>
								<input type="checkbox" value="<?php echo e($power['id']); ?>" name="id[]"
									id="<?php echo e($power['id']); ?>" <?php if($power['is_power']=='true' ): ?> checked <?php endif; ?>>
								<label for="<?php echo e($power['id']); ?>"><?php echo e($power['power_name']); ?></label>
							</label>
						</dt>
						<dd>
							<?php $__currentLoopData = $power['treenChildren']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<dl class="cl permission-list2">
								<dt>
									<label class="">
										<input type="checkbox" id="<?php echo e($val['id']); ?>" <?php if($val['is_power']=='true' ): ?> checked <?php endif; ?>>
										<label for="<?php echo e($val['id']); ?>"><?php echo e($val['power_name']); ?></label>
									</label>
								</dt>
								<dd style="padding-left: 10px;">
									<label class="">
										<input onclick="checked_status(this)" type="checkbox" id="0-<?php echo e($val['id']); ?>" value="<?php echo e($val['id']); ?>" name="id[]" <?php if($val['is_power']=='true' ): ?> checked <?php endif; ?>>
										<label for="0-<?php echo e($val['id']); ?>">查看</label>
										<?php $__currentLoopData = $val['treenChildren']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<input type="checkbox" value="<?php echo e($v['id']); ?>" name="id[]"
											id="<?php echo e($v['id']); ?>" <?php if($v['is_power']=='true' ): ?> checked <?php endif; ?>>
										<label for="<?php echo e($v['id']); ?>"><?php echo e($v['power_name']); ?></label> 
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</label>
								</dd>
							</dl>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</dd>
					</dl>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i
							class="icon-ok"></i> 确定</button>
				</div>
			</div>
		</form>
	</article>

	<!--_footer 作为公共模版分离出去-->
	<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
	<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>
	<!--/_footer 作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
	<script type="text/javascript">
		function checked_status(obj) {
			var l = $(obj).parent().parent().find("input:checked").length;
			if ($(obj).prop("checked")) {
				$(obj).parents(".permission-list2").find("dt").find("input:checkbox").prop("checked", true)
			} else {
				if (l == 0) {
					$(obj).parents(".permission-list2").find("dt").find("input:checkbox").prop("checked", false)
				} else {
					$(obj).parents(".permission-list2").contents("dt").find("input:checkbox").prop("checked", false);
					$(obj).parents(".permission-list2").contents("dd").find("input:checkbox").prop("checked", false);
				}
			}
		}
		$(function () {
			$(".permission-list dt input:checkbox").click(function () {
				$(this).closest("dl").find("dd input:checkbox").prop("checked", $(this).prop("checked"));
			});
			$(".permission-list2 dt input:checkbox").click(function () {
				var l = $(this).parent().parent().find("input:checked").length;
				var l2 = $(this).parents(".permission-list").find(".permission-list2 dt").find("input:checked").length;
				if ($(this).prop("checked")) {
					$(this).closest("dl").find("dt input:checkbox").prop("checked", true);
					$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", true);
				}
				else {
					if (l == 0) {
						$(this).closest("dl").find("dt input:checkbox").prop("checked", false);
					}
					if (l2 == 0) {
						$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", false);
					}
				}
			})
			$(".permission-list2 dd input:checkbox").click(function () {
				var l = $(this).parent().parent().find("input:checked").length;
				var l2 = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
				var l3 = $(this).parents(".permission-list").children("dd").children("").children("dt").length;
				if ($(this).prop("checked")) {
					$(this).closest("dl").find("dd").children().children().eq(0).prop("checked", true);
					$(this).closest("dl").find("dt input:checkbox").prop("checked", true);
					$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", true);
				}
				else {
					// if (l == 0) {
						// $(this).closest("dl").find("dt input:checkbox").prop("checked", false);
					// }
					if (l2 == 0 && l3 == 0) {
						$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked", false);
					}
				}
			});

			$("#form-admin-role-add").validate({
				rules: {
					role_name: {
						required: true,
					},
				},
				onkeyup: false,
				focusCleanup: true,
				success: "valid",
				submitHandler: function (form) {
					$(form).ajaxSubmit({
						type: 'POST',
						url: '<?php echo e(route("role/powerUpdate")); ?>',
						async: false,
						success: function (data) {
							if (data.code == 200) {
								layer.msg('添加成功!', { icon: 1, time: 2000 });
							} else {
								layer.msg(data.msg, { icon: 2, time: 2000 });
							}
						},
						error: function (XmlHttpRequest, textStatus, errorThrown) {
							layer.msg('error!', { icon: 1, time: 2000 });
						}
					});
					window.parent.location.reload()
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
				}
			});
		});
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>

</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/role/admin-role-update.blade.php ENDPATH**/ ?>