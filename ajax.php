<?php
	// 检查是否已安装
    if (!is_file ('./config.php')) {
        exit ();
    }
    
    // 定义
    define ('INFO', true);
    
	// 加载配置
	require_once 'init.php';

	// 执行各类操作
	$mod = $_GET['mod']; // 获取类型
	switch ($mod) {
	    case 'login': // 登录页
	    	// 钩子
			hook_trigger ('ajax_login_1');
			
			// 检查
			if (empty ($_POST['user']) || empty ($_POST['password'])) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}

			// 登录
			$uss = user_login (user_search ($_POST['user']), $_POST['password']);
			
			// 返回
			if ($uss >= 0) {
				exit (json_encode (array ('code' => 0, 'uss' => $uss)));
			} else if ($uss == -1 || $uss == -2) {
				exit (json_encode (array ('code' => -1, 'msg' => '账号或密码错误')));
			}
	    case 'reg': // 注册页
	    	// 钩子
			hook_trigger ('ajax_reg_1');
			
			// 检查
			if (empty ($_POST['name']) || empty ($_POST['email']) || empty ($_POST['password'])) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}

			// 注册
			$reguid = user_register ($_POST['name'], $_POST['email'], $_POST['password']);

			// 返回
			if ($reguid > 0) {
				exit (json_encode (array ('code' => 0, 'uid' => $uid)));
			} else if ($reguid == -1){
				exit (json_encode (array ('code' => -1, 'msg' => '邮箱已注册')));
			} else if ($reguid == -2){
				exit (json_encode (array ('code' => -2, 'msg' => '昵称已注册')));
			}
	    case 'admin-user': // 用户管理页
	    	// 钩子
			hook_trigger ('ajax_admin-user_1');
			
			// 检查
			if (empty ($_POST['do']) || !isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}
			if ($userinfo['gid'] != 1) {
				header ('Location: ./index.php?mod=login');
				exit ();
			}

			// 获取操作
			$do = @$_POST['do'];
			if ($do == 'delete') {
				foreach (@$_POST['uid'] as $uid_d) {
					user_delete ($uid_d);
				}
			} else if ($do == 'group') {
				foreach (@$_POST['uid'] as $uid_d) {
					user_setgroup ($uid_d, $_POST['gid']);
				}
			}

			// 返回
			exit (json_encode (array ('code' => 0)));
	    case 'profile': // 用户页
	    	// 钩子
			hook_trigger ('ajax_profile_1');
			
			// 检查
			if (!isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}

			// 保存
			if (!empty ($_POST['password'])) { // 密码
				user_setpassword ($userinfo['uid'], $_POST['password']);
				user_logout ($logininfo['uss']); // 因为更改了密码，所以需要重新登录
			}
			user_setemail ($userinfo['uid'], $_POST['email']); // 邮箱
			
	    	if ($_POST['avatar_type'] == 'Gravatar') { // 头像
	    		$avatar_url = system_getgravatar ($userinfo['email']);
	    	} else {
	    		$avatar_url = isset ($baiduidinfo[0]) ? $baiduidinfo[0]['avatar'] : $userinfo['avatar'];
	    	}
			user_setavatar ($userinfo['uid'], $avatar_url);

			// 返回
			exit (json_encode (array ('code' => 0)));
	    case 'baiduid': // 百度账号管理页
	    	// 钩子
			hook_trigger ('ajax_baiduid_1');
			
			// 检查
			if (empty ($_POST['do']) || !isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}

			// 判断操作类型并执行
			$do = $_POST['do'];
			if ($do == 'add') {
				// 检查
				if (empty ($_POST['bduss'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 添加
				$ret = baiduid_add ($userinfo['uid'], $_POST['bduss']);
				if ($ret > 0) {
					exit (json_encode (array ('code' => 0)));
				} else if ($ret == -1) {
					exit (json_encode (array ('code' => -1, 'msg' => 'bduss已存在')));
				} else if ($ret == -2) {
					exit (json_encode (array ('code' => -2, 'msg' => 'bduss不正确')));
				}
			} else if ($do == 'delete') {
				// 检查
				if (empty ($_POST['bid'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 删除
				$ret = baiduid_delete ($userinfo['uid'], $_POST['bid']);
				if ($ret == 0) {
					exit (json_encode (array ('code' => 0)));
				}
			} else if ($do == 'login') {
				// 检查
				if (empty ($_POST['user']) || empty ($_POST['password'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 自动登录
				exit (tieba_login ($_POST['user'], $_POST['password'], @$_POST['vcode'], @$_POST['vcode_md5']));
			}
	    case 'admin-set': // 站点管理页
	    	// 钩子
			hook_trigger ('ajax_admin-set_1');
			
			// 检查
			if (!isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}
			if ($userinfo['gid'] != 1) {
				header ('Location: ./index.php?mod=login');
				exit ();
			}

			// 判断操作类型
			if ($_SERVER['REQUEST_METHOD'] == 'GET') {
				require_once ($siteinfo['theme']['path'] . '/admin-set.php');
			} else {
				// 保存
				system_seturl ($_POST['siteurl']);
				system_setname ($_POST['sitename']);
				system_setbeian ($_POST['sitebeian']);
				system_setnotice ($_POST['sitenotice']);

				// 返回
				exit (json_encode (array ('code' => 0)));
			}
	    case 'admin-plugins': // 插件管理页
	    	// 钩子
			hook_trigger ('ajax_admin-plugins_1');
			
			// 检查
			if (empty ($_POST['do']) || !isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}
			if ($userinfo['gid'] != 1) {
				header ('Location: ./index.php?mod=login');
				exit ();
			}

			// 判断操作类型并执行
			$do = $_POST['do'];
			if ($do == 'activate') {
				// 检查
				if (empty ($_POST['pcn'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 启用
				plugin_activate ($_POST['pcn']);
			} else if ($do == 'deactivate') {
				// 检查
				if (empty ($_POST['pcn'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 禁用
				plugin_deactivate ($_POST['pcn']);
			}

			// 返回
			exit (json_encode (array ('code' => 0)));
	    case 'admin-theme': // 插件管理页
	    	// 钩子
			hook_trigger ('ajax_admin-theme_1');
			
			// 检查
			if (!isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}
			if ($userinfo['gid'] != 1) {
				header ('Location: ./index.php?mod=login');
				exit ();
			}

			// 跳出
			break;
		case 'api_verify': // API验证
			// 显示签名
			exit (auth_getsign (auth_getskey ()));

			// 跳出
			break;
		case 'showtb': // 贴吧列表页
	    	// 钩子
			hook_trigger ('ajax_showtb_1');
			
			// 检查
			if (empty ($_POST['do']) || !isset ($userinfo)) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}

			// 保存
			$do = $_POST['do'];
			if ($do == 'ref') {
				// 检查
				if (empty ($_POST['bid'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 先删除全部
				sign_deleteall ($userinfo['uid'], $_POST['bid']);

				// 刷新
				$refid = baiduid_getinfo ($userinfo['uid'], $_POST['bid']);
				if (is_array ($refid)) {
					$tiebalist = tieba_getlike ($refid[0]['bduss']);
					if (is_array ($tiebalist)) {
						foreach ($tiebalist as $tiebalist_d) {
							sign_add ($userinfo['uid'], $_POST['bid'], $tiebalist_d['name'], $tiebalist_d['id']);
						}
					}
				}
			} else if ($do == 'delete') {
				// 检查
				if (empty ($_POST['bid'])) {
					exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
				}

				// 删除
				$ret = baiduid_delete ($userinfo['uid'], $_POST['bid']);
				if ($ret == 0) {
					exit (json_encode (array ('code' => 0)));
				}
			}

			// 返回
			exit (json_encode (array ('code' => 0)));
	}
?>