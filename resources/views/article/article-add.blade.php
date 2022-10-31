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
			<input name="_token" type="hidden" value="{{csrf_token()}}">
			@if (!empty($article)) <input type="hidden" name="id" value="{{$article['id']}}">@endif
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章标题:</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="@if (!empty($article)) {{$article['title']}}@endif" placeholder="" id="title" name="title">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">文章摘要:</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="@if (!empty($article)) {{$article['desc']}}@endif" placeholder="" id="desc" name="desc">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">作者:</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="@if (!empty($article)) {{$article['author']}}@endif" placeholder="" id="author" name="author">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">封面图:</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="file" class="input-text" value="" placeholder="" id="pic" name="pic">
					<img height="60px" src="/upload/article/@if (!empty($article)){{$article['pic']}}@endif" alt="">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">正文:</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea name="body" id="body" hidden class="textarea"></textarea>
					<div id="div1"></div>
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

	<!-- 引入富文本编辑器 -->
	<script src="https://cdn.jsdelivr.net/npm/wangeditor@latest/dist/wangEditor.min.js"></script>
	<!-- /引入富文本编辑器 -->

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

	<!-- 引入 wangEditor.min.js -->
	<script type="text/javascript">
		const E = window.wangEditor
		const editor = new E('#div1')
		const $text1 = $('#body')
		editor.config.onchange = function (html) {
			// 第二步，监控变化，同步更新到 textarea
			$text1.val(html)
		}

		// 配置 server 接口地址
		editor.config.uploadImgServer = "{{route('article/imageUpload')}}"

		// 设置上传携带参数
		editor.config.uploadImgParams = {
			_token: "{{csrf_token()}}",
		}

		editor.create()

		// 第一步，初始化 textarea 的值
		$text1.val(editor.txt.html())

		@if (!empty($article))
		editor.txt.html("{!!$article['body']!!}");
		@endif
	</script>

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
					title: {
						required: true,
					},
					desc: {
						required: true,
					},
					author: {
						required: true,
					},
					@if (empty($article))
					pic: {
						required: true,
					},
					@endif
					body: {
						required: true,
					},
				},
				onkeyup: false,
				focusCleanup: true,
				success: "valid",
				submitHandler: function (form) {
					$(form).ajaxSubmit({
						type: 'POST',
						@if (!empty($article))
						url: '{{route("article/update")}}',
						@else
						url: '{{route("article/save")}}',
						@endif
						async: false,
						success: function (data) {
							if (data.code == 200) {
								layer.msg('添加成功!', { icon: 1, time: 2000 });
							} else {
								layer.msg(data.msg, { icon: 2, time: 2000 });
							}
						},
						error: function (XmlHttpRequest, textStatus, errorThrown) {
							layer.msg('error!', { icon: 2, time: 2000 });
						}
					})
					window.parent.location.reload()
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
				}
			});
		});
	</script>
	<!--/请在上方写此页面业务相关的脚本-->
</body>

</html>