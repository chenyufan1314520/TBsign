<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>更新</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/style.css">
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
                    <a href="#" class="navbar-brand">云签到</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="#">更新</a></li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo $siteinfo['url']; ?>">返回</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="content-wrapper">
        <div class="container">
            <section class="content-header">
                <h1>
                    更新
                </h1>
            </section>
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div id="progress"></div>
                        <br>
                        <button type="submit" id="updata" class="btn btn-primary btn-block btn-flat">更新</button>

                    </div>
                </div>
                <br><br>
            </section>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container">
            <?php hook_trigger ('footer_1') ?>
            <strong>Copyright &copy; 2016 <a href="<?php echo $siteinfo['url']; ?>"><?php echo $siteinfo['name']; ?></a></strong>  |  <a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow"><?php echo system_getbeian() ?></a>
            <?php hook_trigger ('footer_2') ?>
        </div>
    </footer>
</div>

<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/cookie/jquery.cookie.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/js/app.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/dist/js/demo.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/notice/notice.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/ProgressBar/progressbar.js"></script>

<script>
    var bar = new ProgressBar.Circle(progress, {
        color: '#aaa',
        strokeWidth: 4,
        trailWidth: 1,
        easing: 'easeInOut',
        duration: 1400,
        text: {
            autoStyleContainer: false
        },
        from: { color: '#aaa', width: 1 },
        to: { color: '#333', width: 4 },
        // Set default step function for all animate calls
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);
            
            var value = Math.round(circle.value() * 100);
            if (value === 0) {
                circle.setText('0%');
            } else {
                circle.setText(value+'%');
            }

        }
    });
    bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    bar.text.style.fontSize = '2rem';
    bar.animate(0);
    $('#progress').hide();
    $("#updata").click(function() {
        $('#progress').fadeIn();
        $.ajax({
            type: "post",
            url: "./ajax.php?mod=admin-updata",
            dataType: "json",
            data: "do=diff",
            success: function (result) {
                if (result.code == 0) {
                    var filelist = result.filelist;
                    for(filelist_i in filelist) {
                        $.ajax({
                            type: "post",
                            url: "./ajax.php?mod=admin-updata",
                            dataType: "json",
                            data: "do=download&file="+filelist[filelist_i],
                            success: function(result) {
                                if (result.code != 0) {
                                	notie('error', result.msg, true);
                                }
                            }
                        });
                        var width = (filelist_i/filelist.length).toFixed(2);
                        bar.animate(width);
                    }
                    window.location.href="./index.php";
                } else {
                    notie('error', result.msg, true);
                }
            }
        });
    });
</script>
</body>
</html>
