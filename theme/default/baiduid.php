<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="row">
                        
                    <div class="col-md-12">
                        <div class="callout callout-warning">
                            <p>当前已绑定 <?php echo count ($baiduidinfo) ?> 个账号。</p>
                        </div>
                        
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#adminid" data-toggle="tab">已绑定的账户</a></li>
                                <li><a href="#newid1" data-toggle="tab">自动绑定新账户</a></li>
                                <li><a href="#newid2" data-toggle="tab">手动绑定新账户</a></li>
                            </ul>

                            <div class="tab-content">
                                <!-- 已绑定的账户 -->
                                <div class="tab-pane active" id="adminid">
                                    <?php
                                    	if (!empty ($baiduidinfo)) {
	                                        foreach ($baiduidinfo as $baiduidlist_d) {
	                                            ?>
	                                                <div class="box box-widget widget-user bid">
	                                                    <div class="widget-user-header bg-aqua-active" style="background-color: <?php echo getcolor(); ?>;">
	                                                        <div class="btn-group-vertical plugin">
	                                                            <div class="pb"><button type="button" id="delbduss" onclick="delbduss('<?php echo $baiduidlist_d['bid'] ?>')" class="btn btn-danger-alt btn-circle"><i class="fa fa-trash"></i></button></div>
	                                                        </div>
	                                                        <h3 class="widget-user-username"><?php echo $baiduidlist_d['name'] ?></h3>
	                                                    </div>
			                                            <div class="widget-user-image">
    	                                                    <img class="img-circle" src="<?php echo $baiduidlist_d['avatar'] ?>" alt="User Avatar">
	                                                    </div>
	                                                    <div class="box-footer">
	                                                        <div class="row">
	                                                            <div class="col-sm-6 border-right">
	                                                                <div class="description-block">
	                                                                    <h5 class="description-header"><?php echo $baiduidlist_d['bid'] ?></h5>
	                                                                    <span class="description-text">BID</span>
	                                                                </div>
	                                                            </div>
			                                    
	                                                            <div class="col-sm-6">
	                                                                <div class="description-block">
	                                                                    <h5 class="description-header"><?php echo sign_getinfo ($userinfo['uid'], $baiduidlist_d['bid'], 0, 0, true) ?></h5>
	                                                                    <span class="description-text">贴吧数量</span>
	                                                                </div>
	                                                            </div>
	                                                            
	                                                            <div class="col-sm-12">
	                                                                <input type="text" id="showbduss" class="form-control" readonly value="<?php echo $baiduidlist_d['bduss'] ?>">
	                                                            </div>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            <?php
	                                        }
	                                    }
                                    ?>
                                    
                                </div>
                                <!-- 自动绑定新账户 -->
                                <div class="tab-pane" id="newid1">
                                    <div>
                                        <div class="input-group">
                                            <span class="input-group-addon">百度账号</span>
                                            <input type="text" class="form-control" id="user" placeholder="你的百度账户名，建议填写邮箱">
                                        </div>
                                            
                                        <br>

                                        <div class="input-group">
                                            <span class="input-group-addon">百度密码</span>
                                            <input type="password" class="form-control" id="passwd" placeholder="你的百度账号密码">
                                        </div>
                                        
                                        <br>
                                        
                                        <div id="yzm"></div>
                                        
                                        <br>
                                        
                                        <input type="submit" id="addbdid_submit" class="btn btn-primary" value="点击绑定">
                                    </div>
                                </div>
                                
                                <!-- 手动绑定新账户-->
                                <div class="tab-pane" id="newid2">
                                    <div class="input-group">
                                        <span class="input-group-addon">BDUSS</span>
                                        <input type="text" id="bduss" class="form-control" placeholder="BDUSS">
                                    </div>
                                    <br>
                                    <input type="submit" id="addbduss" class="btn btn-primary" value="点击绑定">
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
<?php require_once 'footer.php'; ?>