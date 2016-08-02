<?php
    // 检查是否已安装，防止恶意访问
    if (is_file ('../config.php') == true) {
        die ('云签已经安装完成，如需重新安装请删除config.php文件。');
    }
    
    // 请求包含少部分API文件
    require_once '../api/error.php';
	require_once '../api/db.php';
    
    // 判断类型并载入对应模版
    $step = isset ($_GET['step']) ? $_GET['step'] : ''; // 获取类型
    switch ($step) {
        case '' || $step == '1': // 协议页
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

                // 数据库配置
                $sql = file_get_contents ('./install.sql'); // 初始化数据库结构
                $sql = str_replace ('%PREFIX%', $_POST['dbprefix'], $sql);
                $sql = explode (';', $sql);
                
                foreach ($sql as $sql_d) {
                    $db->query ($sql_d);
                }
                
                $db->insert ('users', array (
                	'uid' => NULL,
                	'name' => $_POST['user'],
                	'email' => $_POST['email'],
                	'password' => md5 (md5 (md5 ($_POST['pass']))),
                	'time' => time (),
                	'gid' => '1',
                	'avatar' => 'https://gravatar.iwch.me/avatar/?s=200'
                )); // 插入管理员账号

                $db->insert ('options', array (
                	'name' => 'system_url',
                	'value' => $siteurl,
                	'uid' => 0
                )); // 插入云签URL

                // 文件配置
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