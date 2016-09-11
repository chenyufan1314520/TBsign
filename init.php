<?php
	// 定义
	define ('SYSTEM_ROOT', __DIR__);
	define ('API_URL', 'https://api.tbsign.in');

	// 引入
	require_once 'api/error.php';
	require_once 'config.php';
	require_once 'api/db.php';
	require_once 'api/auth.php';
	require_once 'api/cron.php';
	require_once 'api/hook.php';
	require_once 'api/sign.php';
	require_once 'api/user.php';
	require_once 'api/group.php';
	require_once 'api/theme.php'; 
	require_once 'api/tieba.php';
	require_once 'api/option.php';
	require_once 'api/plugin.php';
	require_once 'api/system.php';
	require_once 'api/baiduid.php';
	
	// 连接数据库
	$db = new medoo (array (
		'database_type' => DBTYPE,
		'database_name' => DBNAME,
		'server' => DBHOST,
		'username' => DBUSER,
		'password' => DBPASS,
		'charset' => 'utf8',
		'prefix' => DBPREFIX,
		'option' => array (
			PDO::ATTR_PERSISTENT => DBPERSISTENT
		)
	));
	
	if (defined ('INFO')) {
		// 获取信息
		if (empty ($skey = auth_getsid ())) {
			auth_register ();
		}
		if (!empty ($_COOKIE['uss'])) {
		    $uid = user_loginsearch ($_COOKIE['uss']);
		    if ($uid != -1) {
		        $userinfo = user_getinfo ($uid, 1)[0];
		        $logininfo = user_getlogininfo ($uid, 1)[0];
		        $baiduidinfo = baiduid_getinfo ($userinfo['uid'], 0);
		        $baiduidinfo = is_array ($baiduidinfo) ? $baiduidinfo : array ();
		    }
		}
		$siteinfo = array (
		    'name' => system_getname (),
		    'url' => system_geturl (),
		    'theme' => array (
		        'url' => theme_geturl (),
		        'path' => theme_getpath ()
		    )
		);

		// 做一些事，方便之后判断
		if (isset ($_GET['mod']) == false) {
		    $_GET['mod'] = 'index';
		}

		// 判断是否有主题函数
		if (is_file ($siteinfo['theme']['path'] . '/function.php')) {
		    require_once $siteinfo['theme']['path'] . '/function.php';
		}
	}

	// 运行插件
	plugin_runall ();
	
	// 钩子
	hook_trigger ('init_1');