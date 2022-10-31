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
  <link href="/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
  <link href="/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
  <link href="/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
  <link href="/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
  <!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
  <title>后台登录 - H-ui.admin v3.1</title>
  <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
  <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
  <style>
    .error-column {
      color: #ff4949;
      padding: 0 10px;
      background-color: #ff99999a;
      border: 1px solid #ff7c7c9a;
      margin: 8px 1px;
      line-height: 35px
    }

    .loginBox {
      height: auto;
      padding-bottom: 30px;
      background-size: 100% 100%;
    }

    .loginBox::after {
      content: '';
      display: block;
      clear: both;
    }
  </style>
</head>

<body>
  <input type="hidden" id="TenantId" name="TenantId" value="" />
  <div class="header"></div>
  <div class="loginWraper">
    <div id="loginform" class="loginBox">
      @if (!empty(session('msg')))
      <div class="error-column">
        {{ session('msg') }}
      </div>
      @endif
      @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="error-column">
        {{ $error }}
      </div>
      @endforeach
      @endif
      <form class="form form-horizontal" action="{{route('login/sign')}}" method="post">
        @csrf
        <div class="row cl">
          <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
          <div class="formControls col-xs-8">
            <input id="" name="username" type="text" placeholder="账户" class="input-text size-L"
              value="{{ old('username') }}">
          </div>
        </div>
        <div class="row cl">
          <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
          <div class="formControls col-xs-8">
            <input id="" name="password" type="password" placeholder="密码" class="input-text size-L">
          </div>
        </div>
        <div class="row cl">
          <div class="formControls col-xs-8 col-xs-offset-3">
            <input name="code" class="input-text size-L" type="text" placeholder="验证码" style="width:150px;">
            <img src="{{$code}}">
            <a id="kanbuq" href="javascript:;" onclick="get_code(this)">看不清，换一张</a>
          </div>
        </div>
        <div class="row cl">
          <div class="formControls col-xs-8 col-xs-offset-3">
            <label for="online">
              <input type="checkbox" name="online" id="online" value="">
              使我保持登录状态
            </label>
          </div>
        </div>
        <div class="row cl">
          <div class="formControls col-xs-8 col-xs-offset-3">
            <input name="" type="submit" class="btn btn-success radius size-L"
              value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
            <input name="" type="reset" class="btn btn-default radius size-L"
              value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="footer">Copyright 你的公司名称 by H-ui.admin v3.1</div>
  <script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
  <script>
    function get_code(obj) {
      let img = $(obj).prevAll()[0];
      $.ajax({
        type: "get",
        url: "{{route('login/getCode')}}",
        dataType: "json",
        success: res => {
          $(img).prop('src', res.data.code);
        }
      });
    }
  </script>
  <!--此乃百度统计代码，请自行删除-->
  <!-- <script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script> -->
  <!--/此乃百度统计代码，请自行删除
</body>
</html>