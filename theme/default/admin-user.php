<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>
<link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/checkbox/checkbox.css">
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">用户管理</h3></div>
                <div class="box-body table-responsive">
                    <?php
                		$userlist = user_getinfo (0);
                		foreach ($userlist as $userlist_d) {
                			?>        
	                            <div class="col-md-4">
			                        <div class="box box-widget widget-user">
			                            <div class="widget-user-header bg-aqua-active" style="background-color: <?php echo getcolor(); ?>;">
			                                <div class="btn-group-vertical plugin cb">
			                                    <div class="pb">
			                                        <input id="<?php echo $userlist_d['uid'] ?>" name="uid" type="checkbox" value="<?php echo $userlist_d['uid'] ?>" />
			                                        <label for="<?php echo $userlist_d['uid'] ?>"></label>
			                                    </div>
			                                </div>
			                                <h3 class="widget-user-username"><?php echo $userlist_d['name'] ?></h3>
			                                <h5 class="widget-user-desc"><?php echo $userlist_d['email'] ?></h5>
			                            </div>
			                            
			                            <div class="box-footer">
			                                <div class="row">
			                                    <div class="col-sm-4 border-right">
			                                        <div class="description-block">
			                                            <h5 class="description-header"><?php echo $userlist_d['uid'] ?></h5>
			                                            <span class="description-text">UID</span>
			                                        </div>
			                                    </div>
			                                    <div class="col-sm-4 border-right">
			                                        <div class="description-block">
			                                            <h5 class="description-header"><?php echo group_getinfo ($userlist_d['gid'])[0]['name'] ?></h5>
			                                            <span class="description-text">用户组</span>
			                                        </div>
			                                    </div>
			                                    <div class="col-sm-4">
			                                        <div class="description-block">
			                                            <h5 class="description-header"><?php echo date ('Y-m-d', $userlist_d['time']) ?></h5>
			                                            <span class="description-text">注册时间</span>
			                                        </div>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
		               		<?php
                        }
		        ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<div id="setting_panel">
	<a href="#" id="setting_panel_toggle"><i class="fa fa-cog"></i></a>
	<div class="form-group checkbox">
	    <input id='radio1' type="radio" name="do" value="cookie" />
        <label for="radio1">清除 Cookie</label>
        <br><br>
        <input id='radio2' type="radio" name="do" value="delete" />
        <label for="radio2">删除用户</label>
        <br><br>
        <input id='radio4' type="radio" name="do" value="group" />
        <label for="radio4">
            <select>
                <option>调整用户组为</option>
                <?php
                    $grouplist = group_getinfo (0);
                    foreach ($grouplist as $grouplist_d) {
                        ?>
                            <option value="<?php echo $grouplist_d['gid'] ?>"><?php echo $grouplist_d['name'] ?></option>
                        <?php
                    }
                ?>
            </select>
        </label>
        <br><br>
        <input type="submit" id="revise" class="btn btn-primary" value="设置">
        <br>
    </div>
</div>

<!-- 底部引入 -->
<?php require_once 'footer.php'; ?>

