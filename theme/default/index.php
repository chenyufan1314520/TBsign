<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="box box-success">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="box-body chart-responsive">
                                        <canvas id="signChart" width="1500" height="750" style="width: 100%; height: 375px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="box box-success">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <h3><?php echo group_getinfo ($userinfo['gid'])[0]['name']; ?></h3>
                                            <p>用户组</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person"></i>
                                        </div>
                                    </div>

                                    <div class="small-box bg-yellow">
                                        <div class="inner">
                                            <h3><?php echo count ($baiduidinfo) ?> / ∞</h3>
                                            <p>百度ID / 可绑定</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-cloud"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="box box-success">
                            <div class="box-header">
                                <i class="fa fa-bullhorn"></i>
                                <h3 class="box-title">公告</h3>
                            </div>
                            
                            <div class="box-body">
                                <?php echo system_getnotice () ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="fa fa-info"></i>
                                <h3 class="box-title">关于程序</h3>
                            </div>
                        
                            <div class="info-box">
                                <span class="info-box-icon" style="background-image: url('https://gravatar.iwch.me/avatar/a942827e5a52be30498871a47e07c371?s=100');"></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><h3 style="margin: 0px;">JclMiku <small>程序创始人/作者</small></h3></span>
                                    <br>
                                    <span class="info-box-number"><a href="https://kotori.cat">https://kotori.cat</a></span>
                                </div>
                            </div>
                        
                            <div class="info-box">
                                <span class="info-box-icon" style="background-image: url('https://secure.gravatar.com/avatar/81004096d365a007ef80c88d4b521fa9?s=100&amp;d=mm&amp;r=g');"></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><h3 style="margin: 0px;">U2FsdGVkX1 <small>程序创始人/作者</small></h3></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <div class="box box-info">
                            <div class="info-box bg-blue" data-toggle="control-sidebar">
                                <span class="info-box-icon"><span class="glyphicon glyphicon-user"></span></span>
                                <div class="info-box-content">
                                    <h3 style="margin:10px 0px;">个人设置</h3>
                                    <small>修改您的个人设置</small>
                                </div>
                            </div>

                            <div class="info-box bg-orange" onclick="window.location.href='./index.php?mod=baiduid';">
                                <span class="info-box-icon"><span class="glyphicon glyphicon-link ico"></span></span>
                                <div class="info-box-content">
                                    <h3 style="margin:10px 0px;">账号管理</h3>
                                    <small>查看、管理您的百度账号</small>
                                </div>
                            </div>

                            <div class="info-box bg-purple" onclick="window.location.href='https://bbs.tbsign.in';">
                                <span class="info-box-icon"><span class="glyphicon glyphicon-home ico"></span></span>
                                <div class="info-box-content">
                                    <h3 style="margin:10px 0px;">官方论坛</h3>
                                    <small>访问论坛以获得帮助及支持</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
  
<!-- 底部引入 -->
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script>
    $(function(){
		var signed = "<?php echo sign_getinfo ($userinfo['uid'], 0, 0, 0, true, strtotime (date ('Y-m-d')), time (), 1) ?>";
		var error = "<?php echo sign_getinfo ($userinfo['uid'], 0, 0, 0, true, strtotime (date ('Y-m-d')), time (), 1, true) ?>";
		var waiting = "<?php echo sign_getinfo ($userinfo['uid'], 0, 0, 0, true, 0, strtotime (date ('Y-m-d')), 1) ?>";
		var data = {//折线图数据
			labels : ["已签到的贴吧","签到出错的贴吧","等待签到的贴吧"],
			datasets : [
			{
				strokeColor : "#13A1EB",
				pointColor : "#13A1EB",
				pointStrokeColor : "#fff",
				data : [signed,error,waiting]
			}
			]
		}
		var opt = {//折线图设置
			bezierCurve : true,//是否使用贝塞尔曲线
			datasetFill : false,//是否填充线下区域
			pointDotRadius : 7,//节点半径
			pointDotStrokeWidth : 5,//节点描边宽度
			datasetStrokeWidth : 3//线宽度
		}
		var chart = $("canvas#signChart");//折线图
			chart.css('width','100%');
				//绘制chart
		var ctx = chart[0].getContext("2d");
			new Chart(ctx).Line(data,opt);
			chart.css('width','100%');
});

</script>
<?php require_once 'footer.php'; ?>