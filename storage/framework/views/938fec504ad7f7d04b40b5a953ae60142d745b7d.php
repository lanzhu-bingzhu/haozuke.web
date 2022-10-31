<!--_meta 作为公共模版分离出去-->
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
    <style>
        .hui-select {
            border: solid 1px #ddd;
            box-sizing: border-box;
            cursor: pointer;
            line-height: normal;
            font-weight: normal;
            width: 100%;
            white-space: nowrap;
            font-size: 14px;
        }
        
        .hui-select-box {
            border: solid 1px #ddd;
            box-sizing: border-box;
            vertical-align: middle;
            width: 100%;
            display: inline-block;
            padding: 4px 5px;
        }
        .hui-select-box .hui-select {
            border: none;
        }
        .hui-select-box.inline, .hui-select-box.inline .select {
            width: auto;
        }
        .hui-select-box.size-M {
            padding: 4px 5px;
        }
        .hui-select-box.size-M .hui-select {
            font-size: 14px;
        }
        .hui-select-box.size-MINI {
            padding: 0px 5px;
        }
        .hui-select-box.size-MINI .hui-select {
            font-size: 12px;
        }
        .hui-select-box.size-S {
            padding: 3px 5px;
        }
        .hui-select-box.size-S .hui-select {
            font-size: 12px;
        }
        .hui-select-box.size-L {
            padding: 8px 5px;
        }
        .hui-select-box.size-L .hui-select {
            font-size: 16px;
        }
        .hui-select-box.size-XL {
            padding: 10px 5px;
        }
        .hui-select-box.size-XL .hui-select {
            font-size: 18px;
        }
        
        @media (max-width: 767px) {
            .responsive .hui-select-box {
            border: none;
            }
            .responsive .hui-select-box .hui-select,
        .responsive .select {
            border: solid 1px #ddd;
            padding: 10px;
            font-size: 16px;
            }
            .responsive .hui-select-box,
        .responsive .hui-select-box.size-M,
        .responsive .hui-select-box.size-MINI,
        .responsive .hui-select-box.size-S,
        .responsive .hui-select-box.size-L,
        .responsive .hui-select-box.size-XL {
            height: auto;
            padding: 0;
            }
        }
    </style>
	<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
	<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
	<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
	<article class="page-container">
		<form method="post" class="form form-horizontal" id="form-admin-role-add">
			<input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
			<?php if(!empty($data)): ?>
			<input name="id" type="hidden" value="<?php echo e($data['id']); ?>">
			<?php endif; ?>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="<?php if(!empty($data)): ?> <?php echo e($data['power_name']); ?><?php endif; ?>" placeholder="" id="roleName" name="power_name">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">权限归属</label>
				<div class="formControls col-xs-8 col-sm-9">
                    <span class="hui-select-box">
                        <select class="hui-select" size="1" name="pid">
							<?php if(!empty($data) && $data['pid'] == 0): ?>
								<option value="0" selected>---顶级---</option>
							<?php else: ?> 
								<option value="0">---顶级---</option>
							<?php endif; ?>
							<?php $__currentLoopData = $powers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $power): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($data['pid'] == $power['id']): ?>
									<option value="<?php echo e($power->id); ?>" selected><?php echo e($power->html); ?><?php echo e($power->power_name); ?></option>
								<?php else: ?> 
									<option value="<?php echo e($power->id); ?>"><?php echo e($power->html); ?><?php echo e($power->power_name); ?></option>
								<?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </span>
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>路由别名：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="<?php if(!empty($data)): ?> <?php echo e($data['route_name']); ?><?php endif; ?>" placeholder="" id="route_name" name="route_name">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"></label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="checkbox" id="is_show" name="is_show" <?php if(!empty($data)): ?> <?php if($data['is_show'] == "1"): ?> checked <?php endif; ?> <?php endif; ?>>
					<span class="c-red">*</span>是否显示在侧边栏
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
		$(function () {
			$(".permission-list dt input:checkbox").click(function () {
				$(this).closest("dl").find("dd input:checkbox").prop("checked", $(this).prop("checked"));
			});
			$(".permission-list2 dd input:checkbox").click(function () {
				var l = $(this).parent().parent().find("input:checked").length;
				var l2 = $(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
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
			});

			$("#form-admin-role-add").validate({
				rules: {
					power_name: {
						required: true,
					},
                    pid: {
                        required: true,
                    },
					// route_name: {
					// 	required: true
					// }
				},
				onkeyup: false,
				focusCleanup: true,
				success: "valid",
				submitHandler: function (form) {
					$(form).ajaxSubmit({
						type: 'POST',
						<?php if(!empty($data)): ?>
						url: '<?php echo e(route("power/update")); ?>',
						<?php else: ?>
						url: '<?php echo e(route("power/create")); ?>',
						<?php endif; ?>
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

</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/power/admin-permission-add.blade.php ENDPATH**/ ?>