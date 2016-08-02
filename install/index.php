<?php
    // 检查是否已安装，防止恶意访问
    if (is_file ('../config.php') == true) {
        die ('云签已经安装完成，如需重新安装请删除config.php文件。');
    }
    
    // 定义
    define ('SYSTEM_ROOT', __DIR__);

    // 请求包含少部分API文件
    require_once '../api/error.php';
	require_once '../api/db.php';
    require_once '../api/cron.php';
    require_once '../api/user.php';
    require_once '../api/group.php';
    require_once '../api/option.php';
    
    // 判断类型并载入对应模版
    $step = isset ($_GET['step']) ? $_GET['step'] : '1'; // 获取类型
    switch ($step) {
        case $step == '1': // 协议页
            // 判断操作类型
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                require_once ('template/1.php');
            } else {
                // 乱七八糟的准备工作
                
                // 跳转
                header ('Location: ./index.php?step=2');
            }
            
            // 跳出
            break;
        case '2': // 环境检测页
            // 判断操作类型
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                require_once ('template/2.php');
            } else {
                // 乱七八糟的准备工作
                
                // 跳转
                header ('Location: ./index.php?step=3');
            }
            
            // 跳出
            break;
        case '3': // 数据库填写页
            // 判断操作类型
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                require_once ('template/3.php');
            } else {
                // 初始化变量
                $siteurl = isset ($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . dirname (dirname ($_SERVER['SCRIPT_NAME']));
                $db = new medoo (array (
					'database_type' => 'mysql',
					'database_name' => $_POST['dbname'],
					'server' => $_POST['dbhost'],
					'username' => $_POST['dbuser'],
					'password' => $_POST['dbpass'],
					'charset' => 'utf8',
					'prefix' => $_POST['dbprefix']
				));

                // 初始化数据库
                $sql = file_get_contents ('./install.sql'); // 初始化数据库结构
                $sql = str_replace ('%PREFIX%', $_POST['dbprefix'], $sql);
                $sql = explode (';', $sql);
                
                foreach ($sql as $sql_d) {
                    $db->query ($sql_d);
                }

                group_add ('管理员'); // 插入用户组
                group_add ('用户');
                group_add ('禁止访问');

                user_register ($_POST['user'], $_POST['email'], $_POST['pass']); // 插入管理员账号
                user_setgroup (1, 1);

                option_add ('system_name', '又一个云签'); // 插入云签站点名称
                option_add ('system_url', $siteurl); // 插入云签URL
                option_add ('system_beian', '备你妈案'); // 插入云签站点备案号
                option_add ('system_version', '1.0'); // 插入云签版本
                option_add ('system_theme', 'default'); // 插入云签主题TCN
                option_add ('system_notice', 'NicoNicoNi~'); // 插入云签公告
                option_add ('api_skey', ''); // 插入云签skey

                cron_add ('签到任务', 'sign.php'); // 插入签到CRON任务

                // 初始化配置文件
                file_put_contents ('../config.php', "<?php
    define ('DBHOST', '{$_POST['dbhost']}');
    define ('DBNAME', '{$_POST['dbname']}');
    define ('DBUSER', '{$_POST['dbuser']}');
    define ('DBPASS', '{$_POST['dbpass']}');
    define ('DBPREFIX', '{$_POST['dbprefix']}');
    define ('DBTYPE', 'mysql');
");
                
                // 跳转
                header ('Location: ../index.php');
            }
            
            // 跳出
            break;
    }
?>