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

	<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
	<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
	<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
	<article class="page-container">
		<form method="post" class="form form-horizontal" id="form-admin-role-add">
			<input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房东：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_name" name="fang_name">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>租客：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_addr" name="fang_addr">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>预约时间：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="datetime-local" class="input-text" value="" placeholder="" id="fang_xiaoqu" name="fang_xiaoqu">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>内容：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_xiaoqu" name="fang_xiaoqu">
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

			$('#province').change(function () {
				city(this, $('#city'));
				$('#region').children().remove();
			});

			$('#city').change(function () {
				city(this, $('#region'));
			});

			function city (obj1, obj2){
				let id = $(obj1).val();

				// 获取select所有的option
				let obj = $(obj1).children();
				// 循环所有的dom元素
				$(obj).each(function () {
					// 判断是否被选中
					if ($(obj1).prop('selected')) {
						// 获取被选中的option的nid
						let nid = $(obj1).attr('nid');
					}
				});

				$.ajax({
					type: "get",
					url: "<?php echo e(route('fang/city')); ?>",
					data: { id },
					dataType: "json",
					success: response => {
						let data = response.data;
						let arr = [];
						$(data).each((i, v) => {
							arr.push('<option value="' + v.id + '">' + v.name + '</option>');
						});
						$(obj2).html(arr);
					}
				});
			}

			$("#form-admin-role-add").validate({
				rules: {
					fang_name: {
						required: true
					},
				},
				onkeyup: false,
				focusCleanup: true,
				success: "valid",
				submitHandler: function (form) {
					$(form).ajaxSubmit({
						type: 'POST',
						url: '<?php echo e(route("fang/create")); ?>',
						async: false,
						success: res => {
							if (res.code == 200) {
								layer.msg('添加成功!', { icon: 1, time: 2000 });
							}
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

</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/notice/notice-add.blade.php ENDPATH**/ ?>