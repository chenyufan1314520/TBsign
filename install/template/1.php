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
              <li class="active"><a href="#">许可</a></li>
              <li><a href="#">检查</a></li>
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
		<h2>阅读许可协议</h2><br/>
		<iframe src="license.html" style="width:100%;height:500px;"></iframe>
		<br><br><input type="button" data-toggle="modal" data-target="#agree" class="btn btn-success" value="我同意" style="float: right;">

	    <div class="modal modal-success fade" id="agree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title" id="myModalLabel">请确认</h4>
                   </div>
                   <div class="modal-body">
                   我已仔细阅读协议并同意，如果我去除/更改版权信息，自愿承担损失（包含但不限于服务终止、云签自毁）
                    <br><br> 
                    请输入“我同意该协议”进入下一步
                    <br><br> 
                    <input type="text" class="form-control" id="agree_text" placeholder="请输入">
                   </div>
                   <div class="modal-footer">
                     <button class="btn btn-outline pull-left" data-dismiss="modal">取消</button>
                     <form action="./index.php?step=1" method="post">
                       <button type="submit" id="agree_button" class="btn btn-outline" disabled>下一步</button>
                     </form>
                   </div>
                </div>
            </div>
         </div>
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
<script>
$(function () {
        $('#agree_text').bind('input', function () {
            if ($('#agree_text').val() == '我同意该协议') {
                $('#agree_button').removeAttr('disabled');
            } else {
                $('#agree_button').attr('disabled', 'disabled');
            }
        });
})
</script>
</body>
</html>
