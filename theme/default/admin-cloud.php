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
                    <p>Uid : <span id="uid"></span></p>
                    <p>Username : <span id="username"></span></p>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">登录云平台账号</h3>
                    </div>
                    <?php if(empty (auth_getuss ())) { ?>?
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
                        <?php } else {?>
                            <div class="box-body table-responsive">
                                <p>已绑定</p>
                            </div>
                        <?php }?>
                </div>
            </div>
        </div>
    </section>
</div>
  
<!-- 底部引入 -->
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/notice/notice.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/user/user.js"></script>

<script>
$("body").keydown(function() {
    if (event.keyCode == "13") {
        $("#login").click();
    }
});    
$("#login").click(function(){ 
    var user = $("#user").val();
    var uid = user_search(user);
    var password = $("#password").val();

    $.ajax({ 
        type: "post", 
        url : "<?php echo PANEL_URL ?>/ajax.php?mod=login", 
        dataType: "json",
        data: "uid="+uid+"&password="+password, 
        success: function(result){
            if (result.code == 0) {
                $.ajax({ 
                    type: "post",
                    url : "./ajax.php?mod=admin-cloud", 
                    dataType: "json",
                    data: "do=claim&uss="+result.uss, 
                    success: function(claim){
                        if (claim.code == 0) {
                            notie('success', '绑定成功', true);
                        } else {
                            notie('error', claim.msg, true);
                        }
                    } 
                });
            } else {
                notie('error', result.msg, true);
            }
        } 
    });
});
$(document).ready(function(){
    uss = '<?php echo auth_getuss() ?>';
    
    $.ajax({ 
        type: "post", 
        url : "<?php echo PANEL_URL ?>/function.php?mod=user_loginsearch", 
        dataType: "json",
        data: "uss="+uss, 
        success: function(result){
            if (result.code == 0) {
                if (result.uid == -1) {
                    // guo 
                    return;
                }
                
                $.ajax({ 
                    type: "post", 
                    url : "<?php echo PANEL_URL ?>/function.php?mod=user_getinfo", 
                    dataType: "json",
                    data: "uss="+uss, 
                    success: function(result){
                        if (result.code == 0) {
                            console.log(result.userinfo.uid);
                            $('#uid').html(result.userinfo.uid);
                            $('#username').html(result.userinfo.name);
                        } else {
                            notie('error', result.msg, true);
                        }
                    } 
                });
            } else {
                notie('error', result.msg, true);
            }
        } 
    });
    
    
});
</script>

<?php require_once 'footer.php'; ?>

