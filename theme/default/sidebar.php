<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $userinfo['avatar'] ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo $userinfo['name']; ?> </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    
      <ul class="sidebar-menu">
        <li class="header">菜单</li>
        <li class="treeview <?php if ($_GET['mod'] == 'index') echo 'active'; ?>">
            <a href="./index.php">
                <i class="fa fa-home"></i> <span> 首页</span>
            </a>
        </li>
        <li class="treeview <?php if ($_GET['mod'] == 'baiduid') echo 'active'; ?>">
            <a href="./index.php?mod=baiduid">
                <i class="fa fa-link"></i> <span> 账号管理</span>
            </a>
        </li>
        <li class="treeview <?php if ($_GET['mod'] == 'showtb') echo 'active'; ?>">
            <a href="./index.php?mod=showtb">
                <i class="fa fa-calendar-check-o"></i> <span> 贴吧签到日记</span>
            </a>
        </li>
        <?php
	    	// 钩子
			hook_trigger ('sidebar_1');
	    ?>
        
        <?php 
            if ($userinfo['gid'] == 1) {
                ?>
                    <li class="header">管理员设置</li>
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-cloud') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-cloud">
                            <i class="fa fa-cloud"></i> <span> 云平台</span>
                        </a>
                    </li>
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-set') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-set">
                            <i class="fa fa-wrench"></i> <span> 站点管理</span>
                        </a>
                    </li>
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-user') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-user">
                            <i class="fa fa-users"></i> <span> 用户管理</span>
                        </a>
                    </li>
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-plugins') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-plugins">
                            <i class="fa fa-server"></i> <span> 插件管理</span>
                        </a>
                    </li>
                    <!--
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-theme') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-theme">
                            <i class="fa fa-cogs"></i> <span> 主题管理</span>
                        </a>
                    </li> -->
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-cron') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-cron">
                            <i class="fa fa-clock-o"></i> <span> 计划任务</span>
                        </a>
                    </li>
                    <li class="treeview <?php if ($_GET['mod'] == 'admin-updata') echo 'active'; ?>">
                        <a href="./index.php?mod=admin-updata">
                            <i class="fa fa-upload"></i> <span> 检查更新</span>
                        </a>
                    </li>
                    <?php
                    	// 钩子
						hook_trigger ('sidebar_admin_1');
                    ?>
                <?php
            }
        ?>
      </ul>
    </section>
  </aside>