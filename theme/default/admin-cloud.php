<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
    $sid = auth_getsid ();
    $skey = auth_getskey ();
?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="callout callout-info">
                    <h4>授权信息</h4>
                    <p>Sid : <?php echo $sid ?></p>
                    <p>Skey : <?php echo $skey ?></p>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">登录云平台账号</h3>
                    </div>
    
					<div id="loginbox" style="display: none;">
                        <div class="box-body table-responsive">
                            <div class="input-group">
                                <span class="input-group-addon">用户名/邮箱</span>
                                <input type="text" id="user" class="form-control" placeholder="用户名/邮箱">
                            </div>
                            <br>
                            <div class="input-group">
                                <span class="input-group-addon">密码</span>
                                <input type="password" id="password" class="form-control" placeholder="密码">
                            </div>
                            <br>
                            <input type="submit" id="login" class="btn btn-primary" value="点击绑定">
                        </div>
                        <div class="callout callout-warning">
                            <p>此为https://panel.tbsign.in的账号</p>
                        </div>
					</div>

                    <div class="box-body table-responsive" id="logined" style="display: none;">
                        <p>已绑定</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
  
<!-- 底部引入 -->
<?php require_once 'footer.php'; ?>

