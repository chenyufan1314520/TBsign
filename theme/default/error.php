<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> - 提示信息</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/skins/_all-skins.min.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo $siteinfo['url']; ?>" class="navbar-brand"><?php echo $siteinfo['name']; ?></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content">
		<h2>提示信息</h2><br/>
	    
      </section>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; 2016 <?php echo $siteinfo['name']; ?> .</strong> All rights
      reserved.
    </div>
  </footer>
</div>

<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/js/app.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/js/demo.js"></script>
</body>
</html>
