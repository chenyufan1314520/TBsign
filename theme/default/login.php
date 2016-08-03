<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>登录 | <?php echo $siteinfo['name']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/iCheck/square/blue.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $siteinfo['url']; ?>"><b><?php echo $siteinfo['name']; ?></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">登录</p>
    
    <div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="用户名 or 邮箱" name="user" id="user">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="密码" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> 记住我
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" id="login" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
      </div>
    </div>
    <br>
    <a href="./index.php?mod=reg" class="text-center">还没有账号？那就注册一个呗^_^</a>

  </div>
</div>

<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/notice/notice.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/cookie/jquery.cookie.js"></script>

<script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    
    
});
$("body").keydown(function() {
    if (event.keyCode == "13") {
        $("#login").click();
    }
});    
$("#login").click(function(){ 
    var user = $("#user").val(); 
    var password = $("#password").val();

    $.ajax({ 
        type: "post", 
        url : "./ajax.php?mod=login", 
        dataType: "json",
        data: "user="+user+"&password="+password, 
        success: function(result){
            if (result.code == 0) {
                $.cookie('uss', result.uss);
                window.location.href="./index.php";
            } else if (result.code == -1) {
                notie('error', result.msg, true)
            }
        } 
    });
});

</script>
</body>
</html>
