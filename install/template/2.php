<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>安装</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="./template/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="./template/assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="./template/assets/dist/css/skins/_all-skins.min.css">

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
          <a href="#" class="navbar-brand">云签到</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
              <li><a href="#">许可</a></li>
              <li class="active"><a href="#">检查</a></li>
              <li><a href="#">设置</a></li>
              <li><a href="#">完成</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container">
      <section class="content">
        <h2>准备安装: 功能检查</h2><br/>

          <div class="box">
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th>名称</th>
                  <th>当前</th>
                </tr>
                <tr>
                  <td>Update software</td>
                  <td>
                    <span class="badge bg-green">支持</span>
                  </td>
                </tr>
                <tr>
                  <td>Clean database</td>
                  <td><span class="badge bg-red">不支持</span></td>
                </tr>
              </tbody>
              </table>
            </div>
          </div>
        <br><br>
        <form action="./index.php?step=2" method="post">
		    <button type="submit" class="btn btn-success" style="float: right;">下一步</button>
	    </form>
      </section>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; 2016.</strong> All rights
      reserved.
    </div>
  </footer>
</div>

<script src="./template/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="./template/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="./template/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="./template/assets/plugins/fastclick/fastclick.js"></script>
<script src="./template/assets/dist/js/app.min.js"></script>
<script src="./template/assets/dist/js/demo.js"></script>
</body>
</html>
