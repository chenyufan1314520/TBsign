<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $siteinfo['name']; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/font-awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/style.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/checkbox/checkbox.css">
  <?php hook_trigger ('header_1') ?>
  
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="skin-blue sidebar-mini fixed">
<div class="wrapper">
  <header class="main-header">

    <a href="index2.html" class="logo">
        <span class="logo-mini"><i class="fa fa-cloud"></i></span>
        <span class="logo-lg"><?php echo $siteinfo['name']; ?></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $userinfo['avatar'] ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $userinfo['name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="https://gravatar.iwch.me/avatar/<?php echo md5 (strtolower ($userinfo['email'])); ?>?s=200" class="img-circle" alt="User Image">
                            <p><?php echo $userinfo['name']; ?> 
                                <small style="margin-top:3px;"><?php echo $userinfo['email']; ?></small> 
                                <small>加入时间：<?php echo date ('Y-m-d', $userinfo['time']); ?> </small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" data-toggle="control-sidebar"class="btn btn-default btn-flat">个人设置</a>
                            </div>
                            <div class="pull-right">
                                <a href="javascript:if(confirm('将要注销您的账号。是否继续？')){ $.cookie('uss', null);window.location.href='./index.php'; }" class="btn btn-default btn-flat">注销</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
            </ul>
		</div>
    </nav>
  </header>
  <!-- 菜单引入 -->
  <?php require_once 'sidebar.php'; ?>
  