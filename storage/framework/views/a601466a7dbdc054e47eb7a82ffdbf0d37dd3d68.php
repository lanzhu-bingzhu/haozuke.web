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
				<label class="form-label col-xs-4 col-sm-3">房源名称：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_name" name="fang_name">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">房源地址：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_addr" name="fang_addr">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">小区名称：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_xiaoqu" name="fang_xiaoqu">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>小区地址：</label>
				<div class="formControls col-xs-8 col-sm-3">
					<span class="select-box">
						<select class="select" size="1" name="fang_province" id="province">
							<?php $__currentLoopData = $data['city']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($val['id']); ?>" nid="<?php echo e($val['nid']); ?>"><?php echo e($val['name']); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</span>
				</div>
				<div class="formControls col-xs-8 col-sm-3">
					<span class="select-box">
						<select class="select" size="1" name="fang_city" id="city">
							<option value=""></option>
						</select>
					</span>
				</div>
				<div class="formControls col-xs-8 col-sm-3">
					<span class="select-box">
						<select class="select" size="1" name="fang_region" id="region">
							<option value=""></option>
						</select>
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">租金：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_rent" name="fang_rent">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">楼层：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_floor" name="fang_floor">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>付款方式：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box">
						<select class="select" size="1" name="fang_rent_type">
							<?php $__currentLoopData = $data['rent_type_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($val['id']); ?>"><?php echo e($val['name']); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">几室：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_shi" name="fang_shi">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">几厅：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_ting" name="fang_ting">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">几卫：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_wei" name="fang_wei">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>朝向：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box">
						<select class="select" size="1" name="fang_direction">
							<?php $__currentLoopData = $data['direction_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($val['id']); ?>"><?php echo e($val['name']); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">租赁方式：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box">
						<select class="select" size="1" name="fang_rent_class">
							<?php $__currentLoopData = $data['rent_class_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($val['id']); ?>"><?php echo e($val['name']); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">建筑面积：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_build_area"
						name="fang_build_area">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">使用面积：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_using_area"
						name="fang_using_area">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">建筑年代：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="fang_year" name="fang_year">
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">配套设施：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<?php $__currentLoopData = $data['config_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="check-box">
						<input type="checkbox" id="checkbox-<?php echo e($val['id']); ?>" value="<?php echo e($val['id']); ?>" name="fang_config[]">
						<label for="checkbox-<?php echo e($val['id']); ?>"><?php echo e($val['name']); ?></label>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">房屋照片：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="btn-upload form-group">
						<input class="input-text upload-url radius" type="text" name="uploadfile-1" id="uploadfile-1"
							readonly>
						<a href="javascript:void();" class="btn btn-primary radius"><i class="iconfont">&#xf0020;</i>
							浏览文件</a>
						<input type="file" multiple name="fang_pic" class="input-file">
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">房东：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box">
						<select class="select" size="1" name="fang_owner">
							<?php $__currentLoopData = $data['owners']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($val['id']); ?>"><?php echo e($val['name']); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</span>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">是否推荐：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<div class="radio-box">
						<input name="is_recommend" type="radio" id="sex-1" value="1" checked>
						<label for="sex-1">是</label>
					</div>
					<div class="radio-box">
						<input type="radio" id="sex-2" name="is_recommend" value="0">
						<label for="sex-2">否</label>
					</div>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">房屋描述：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea class="textarea" name="fang_desn" id="fang_desn" cols="30" rows="4"></textarea>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">房屋详情：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea name="fang_body" id="body" hidden class="textarea"></textarea>
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
		editor.config.uploadImgServer = "<?php echo e(route('fang/imageUpload')); ?>"

		// 设置上传携带参数
		editor.config.uploadImgParams = {
			_token: "<?php echo e(csrf_token()); ?>",
		}

		editor.create()

		// 第一步，初始化 textarea 的值
		$text1.val(editor.txt.html())

	</script>


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
					fang_addr: {
						required: true
					},
					fang_xiaoqu: {
						required: true
					},
					fang_rent: {
						required: true,
						number: true
					},
					fang_floor: {
						required: true,
						number: true
					},
					fang_rent_type: {
						required: true,
						number: true
					},
					fang_shi: {
						required: true,
						number: true
					},
					fang_ting: {
						required: true,
						number: true
					},
					fang_wei: {
						required: true,
						number: true
					},
					fang_direction: {
						required: true,
						number: true
					},
					fang_rent_class: {
						required: true,
						number: true
					},
					fang_build_area: {
						required: true,
						number: true
					},
					fang_using_area: {
						required: true,
						number: true
					},
					fang_year: {
						required: true,
						number: true
					},
					fang_config: {
						required: true
					},
					fang_pic: {
						required: true
					},
					fang_owner: {
						required: true,
						number: true
					},
					is_recommend: {
						required: true,
						number: true
					},
					fang_desn: {
						required: true
					},
					fang_body: {
						required: true
					},
					fang_province: {
						required: true,
						number: true
					},
					fang_city: {
						required: false,
						number: true
					},
					fang_region: {
						required: false,
						number: true
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

</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/fang/fang-add.blade.php ENDPATH**/ ?>