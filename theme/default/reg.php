<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>注册 | <?php echo $siteinfo['name']; ?></title>
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/font-awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/iCheck/square/blue.css">
  <?php hook_trigger ('header_1') ?>

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?php echo $siteinfo['url']; ?>"><b><?php echo $siteinfo['name']; ?></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">注册账号</p>

    <div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="用户名" name="name" id="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="邮箱" name="email" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="密码" name="password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <?php
        // 钩子
		hook_trigger ('reg_form_1');
      ?>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" id="reg" class="btn btn-primary btn-block btn-flat">注册</button>
        </div>
      </div>
    </div>
    <br>
    <a href="./index.php?mod=login" class="text-center">已经拥有账号了，立即登录</a>
  </div>
</div>

<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/notice/notice.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

$("body").keydown(function() {
    if (event.keyCode == "13") {//keyCode=13是回车键
        $("#reg").click();
    }
});   

// Ajax 注册
$("#reg").click(function(){ 
    var name = $("#name").val(); 
    var email = $("#email").val(); 
    var password = $("#password").val();

    $.ajax({ 
        type: "post", 
        url : "./ajax.php?mod=reg", 
        dataType: "json",
        data: "name="+name+"&email="+email+"&password="+password, 
        success: function(result){
            if (result.code == 0) {
                notie('success', '注册成功', true);
                setTimeout('window.location.href="./index.php"',500);
            } else {
                notie('error', result.msg, true);
            }
        } 
    });
});
</script>
</body>
</html>
