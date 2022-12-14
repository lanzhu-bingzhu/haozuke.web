<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport"
		content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
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
	<title>添加管理员 - 管理员管理 - H-ui.admin v3.1</title>
	<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
	<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>

<body>
	<article class="page-container">
		<form class="form form-horizontal" id="form-admin-add">
			<input name="_token" type="hidden" value="{{csrf_token()}}">
			@if (!empty($admin))
			<input type="hidden" name="id" value="{{$admin->id}}">
			@endif
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
				<div class="formControls col-xs-8 col-sm-9">
					@if (!empty($admin))
					<input type="text" class="input-text" value="{{$admin->username}}" placeholder="" id="adminName" name="username">
					@else
					<input type="text" class="input-text" placeholder="" id="adminName" name="username">
					@endif
				</div>
			</div>
			@if (empty($admin))
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="password" class="input-text" autocomplete="off" placeholder="确认新密码" id="password2" name="password2">
				</div>
			</div>
			@endif
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
				<div class="formControls col-xs-8 col-sm-9 skin-minimal">
					@if (!empty($admin))
					@if ($admin->sex == '男')
					<div class="radio-box">
						<input name="sex" type="radio" id="sex-1" value="男" checked>
						<label for="sex-1">男</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="sex-2" name="sex" value="女">
						<label for="sex-2">女</label>
					</div>
					@else
					<div class="radio-box">
						<input name="sex" type="radio" id="sex-1" value="男">
						<label for="sex-1">男</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="sex-2" name="sex" value="女" checked>
						<label for="sex-2">女</label>
					</div>
					@endif
					@else
					<div class="radio-box">
						<input name="sex" type="radio" id="sex-1" value="男" checked>
						<label for="sex-1">男</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="sex-2" name="sex" value="女">
						<label for="sex-2">女</label>
					</div>
					@endif
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
				<div class="formControls col-xs-8 col-sm-9">
					@if (!empty($admin))
					<input type="text" class="input-text" value="{{$admin->phone}}" placeholder="" id="phone" name="phone">
					@else
					<input type="text" class="input-text" placeholder="" id="phone" name="phone">
					@endif
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
				<div class="formControls col-xs-8 col-sm-9">
					@if (!empty($admin))
					<input type="text" class="input-text" value="{{$admin->email}}" placeholder="@" name="email" id="email">
					@else
					<input type="text" class="input-text" placeholder="@" name="email" id="email">
					@endif
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">角色：</label>
				<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
						<select class="select" name="role_id" size="1">
							@foreach ($roles as $role)
							@if (!empty($admin) && $admin->role['id'] == $role->id)
							<option value="{{$admin->role['id']}}" selected>
								{{$admin->role['role_name']}}</option>
							@else
							<option value="{{$role->id}}">{{$role->role_name}}</option>
							@endif
							@endforeach
							{{-- <option value="1">总编</option>
				<option value="2">栏目主辑</option>
				<option value="3">栏目编辑</option> --}}
						</select>
					</span> </div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">备注：</label>
				<div class="formControls col-xs-8 col-sm-9">
					@if (!empty($admin))
					<textarea id="desc" name="desc" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内"
						dragonfly="true" onKeyUp="$.Huitextarealength(this,100)">{{$admin->desc}}</textarea>
					@else
					<textarea id="desc" name="desc" cols="" rows="" class="textarea" placeholder="说点什么...100个字符以内" dragonfly="true"
						onKeyUp="$.Huitextarealength(this,100)"></textarea>
					@endif
					<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
				</div>
			</div>
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" id="submit" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
			$('.skin-minimal input').iCheck({
				checkboxClass: 'icheckbox-blue',
				radioClass: 'iradio-blue',
				increaseArea: '20%'
			});

			$("#form-admin-add").validate({
				rules: {
					username: {
						required: true,
						minlength: 4,
						maxlength: 16,
						@if (empty($admin))
						remote: "{{route('admin/remote')}}"
						@endif
					},
					password: {
						required: true,
					},
					password2: {
						required: true,
						equalTo: "#password"
					},
					sex: {
						required: true,
					},
					phone: {
						required: true,
						isPhone: true,
					},
					email: {
						required: true,
						email: true,
					},
					role_id: {
						required: true,
					},
				},
				messages: {
					username: {
						remote: '该名称已占用'
					}
				},
				onkeyup: false,
				focusCleanup: true,
				// success:"valid",
				submitHandler: function (form) {
					$(form).ajaxSubmit({
						type: 'POST',
						@if (!empty($admin))
						url: '{{route("admin/update")}}',
						@else
						url: '{{route("admin/create")}}',
						@endif
						async: false,
						// dataType: 'json',
						success: function (data) {
							layer.msg('添加成功!', { icon: 1, time: 2000 });
							// console.log(data);
						},
						error: function (XmlHttpRequest, textStatus, errorThrown) {
							layer.msg('error!', { icon: 1, time: 2000 });
						}
					});
					window.parent.location.reload()
					var index = parent.layer.getFrameIndex(window.name);
					parent.$('.btn-refresh').click();
					parent.layer.close(index);
				}
			});
		});
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>

</html>