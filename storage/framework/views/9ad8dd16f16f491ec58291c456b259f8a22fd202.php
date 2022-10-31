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
    <title>房源规格列表</title>
</head>

<body>
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 房源管理 <span
            class="c-gray en">&gt;</span> 房源规格列表 <a class="btn btn-success radius r"
            style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i
                class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c">
            <form class="Huiform" method="get" action="<?php echo e(route('view/fangattr-list')); ?>">
                <input type="text" class="input-text" style="width:250px" placeholder="规格名称" id="h" name="h" value="<?php echo e($h); ?>">
                <button type="submit" class="btn btn-success" id="" name="">
                <i class="Hui-iconfont">&#xe665;</i>搜房源属性</button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
                <a href="javascript:;" onclick="datadel()"
                    class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除
                </a>
                <a href="javascript:;"
                    onclick="fangattr_add('添加房源属性','<?php echo e(route('view/fangattr-add')); ?>','','310')"
                    class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加房源属性
                </a>
            </span>
            <span class="r">共有数据：<strong>54</strong> 条</span>
        </div>
        <table class="table table-border table-bordered table-bg">
            <thead>
                <tr>
                    <th scope="col" colspan="7">房源属性</th>
                </tr>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="40">ID</th>
                    <th width="200">房源属性名称</th>
                    <th>图标</th>
                    <th>字段名称</th>
                    <th>加入时间</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $fangattrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-c">
                    <td><input type="checkbox" class="checked" value="<?php echo e($val['id']); ?>" name=""></td>
                    <td><?php echo e($val['id']); ?></td>
                    <td style="text-align: left; padding-left: 2vw;"><?php echo e($val['html']); ?><?php echo e($val['name']); ?></td>
                    <td><img height="40px" src="/icon/<?php echo e($val['icon']); ?>" alt=""></td>
                    <td><?php echo e($val['field_name']); ?></td>
                    <td><?php echo e($val['updated_at']); ?></td>
                    <td>
                        <a title="编辑" href="javascript:;"
                            onclick="fangattr_edit('房源属性编辑','<?php echo e(route('view/fangattr-add', ['id' => $val['id']])); ?>','<?php echo e($val['id']); ?>','','310')" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                        <a title="删除" href="javascript:;" onclick="fangattr_del(this,'<?php echo e($val['id']); ?>')" class="ml-5"
                            style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->

    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        /*
            参数解释：
            title	标题
            url		请求的url
            id		需要操作的数据id
            w		弹出层宽度（缺省调默认值）
            h		弹出层高度（缺省调默认值）
        */
        /*房源-属性-添加*/
        function fangattr_add(title, url, w, h) {
            layer_show(title, url, w, h);
        }
        /*房源-属性-编辑*/
        function fangattr_edit(title, url, id, w, h) {
            layer_show(title, url, w, h);
        }

        /*房源-属性-删除*/
        function fangattr_del(obj, id) {
            layer.confirm('确认要删除吗？', index => {
                $.ajax({
                    type: 'get',
                    url: '<?php echo e(route("fangattr/delete")); ?>',
                    data: { id },
                    dataType: 'json',
                    success: function (data) {
                        if (data.code == 200) {
                            layer.msg('已删除!', { icon: 1, time: 2000 });
                            $(obj).parents("tr").remove();
                        } else {
                            layer.msg(data.msg, { icon: 2, time: 2000 });
                        }
                    },
                    error: function (data) {
                        console.log(data.msg);
                    },
                });
            });
        }

        /* 房源管理-属性-批量删除 */
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
					url: "<?php echo e(route('fangattr/delete')); ?>",
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

</html><?php /**PATH H:\phpstudy_pro\WWW\Level9\haozuke_test\resources\views/fangattr/fangattr-list.blade.php ENDPATH**/ ?>