<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
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
		<?php if(!empty($owner)): ?>
		<input type="hidden" name="id" value="<?php echo e($owner['id']); ?>">
		<?php endif; ?>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($owner)): ?><?php echo e($owner['name']); ?> <?php endif; ?>" placeholder="" id="name" name="name">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>年龄：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($owner)): ?><?php echo e($owner['age']); ?> <?php endif; ?>" placeholder="" id="age" name="age">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($owner)): ?><?php echo e($owner['phone']); ?> <?php endif; ?>" placeholder="" id="phone" name="phone">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($owner)): ?><?php echo e($owner['email']); ?> <?php endif; ?>" placeholder="" id="email" name="email">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>身份证号码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($owner)): ?><?php echo e($owner['card']); ?> <?php endif; ?>" placeholder="" id="card" name="card">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($owner)): ?><?php echo e($owner['address']); ?> <?php endif; ?>" placeholder="" id="address" name="address">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php if(!empty($owner)): ?>
					<?php if($owner['sex'] == '男'): ?>
					<div class="radio-box">
						<input type="radio" id="sex-1" name="sex" value="男" checked>
						<label for="sex-1">男</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="sex-2" name="sex" value="女">
						<label for="sex-1">女</label>
					</div>
					<?php else: ?>
					<div class="radio-box">
						<input type="radio" id="sex-1" name="sex" value="男">
						<label for="sex-1">男</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="sex-2" name="sex" value="女" checked>
						<label for="sex-1">女</label>
					</div>
					<?php endif; ?>
				<?php else: ?>
				<div class="radio-box">
					<input type="radio" id="sex-1" name="sex" value="男" checked>
					<label for="sex-1">男</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="sex" value="女">
					<label for="sex-1">女</label>
				</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>身份证照片：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="btn-upload form-group">
					<input class="input-text upload-url radius" value="<?php if(!empty($owner)): ?><?php echo e($owner['pic']); ?> <?php endif; ?>" type="text" name="uploadfile-1" id="uploadfile-1" readonly>
					<a href="javascript:void();" class="btn btn-primary radius"><i class="iconfont">&#xf0020;</i> 浏览文件</a>
					<input type="file" multiple name="pic" class="input-file">
				</span>
			</div>
			<label class="form-label col-xs-4 col-sm-6">正面、反面、手持</label>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$("#form-admin-role-add").validate({
		rules:{
			name: {
				required: true
			},
			age: {
				required: true
			},
			phone: {
				required: true
			},
			email: {
				required: true
			},
			card: {
				required: true
			},
			address: {
				required: true
			},
			sex: {
				required: true
			},
			<?php if(empty($owner)): ?>
			pic: {
				required: true
			},
			<?php endif; ?>
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'POST',
                <?php if(empty($owner)): ?>
				url: '<?php echo e(route("owner/create")); ?>',
				<?php else: ?>
				url: '<?php echo e(route("owner/update")); ?>',
                <?php endif; ?>
				async: false,
				success: res => {
					if (res.code == 200) {
						layer.msg('添加成功!', { icon: 1, time: 2000 });
					} else {
						layer.msg(res.msg, { icon: 2, time: 2000 });
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
</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/owner/owner-add.blade.php ENDPATH**/ ?>