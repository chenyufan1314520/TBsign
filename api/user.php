<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
    function user_register ($name, $email, $password) // 注册账号
    {
        // 判断是否已注册过了
        if (user_search ($email) != -1) { // 邮箱
            return -1;
        } 
        if (user_search ($name) != -1) { // 昵称
            return -2;
        } 
        
        // 插入账号到数据库
        $data = array (
        	'uid' => NULL,
        	'name' => $name,
        	'email' => $email,
        	'password' => md5 (md5 (md5 ($password))),
        	'time' => time (),
        	'gid' => '2',
        	'avatar' => user_getgravatar ($email)
        );
        $ret = $GLOBALS['db']->insert ('users', $data);
        
        return $ret;
    }
    
    function user_delete ($uid) // 删除账号
    {
    	// 删除表
		$where = array (
			'uid' => $uid
		);
		$GLOBALS['db']->delete ('users', $where);

		// 删除所绑定的百度帐号
		$baiduidlist = baiduid_getinfo ($uid, 0);
		foreach ($baiduidlist as $baiduidlist_d) {
			baiduid_delete ($uid, $baiduidlist_d['bid']);
		}
    }
    
    function user_login ($uid, $password) // 登录账号
    {
        // 验证信息
        $userinfo = user_getinfo ($uid);
        if (!is_array ($userinfo)) { // 账号不正确
        	return -1;
        }
        if (md5 (md5 (md5 ($password))) != $userinfo[0]['password']) { // 密码不正确
            return -2;
        }
        
        // 登录
        $uss = md5 ($userinfo[0]['uid'] . $userinfo[0]['password'] . time () . rand ());
        if (!empty ($logininfo = user_getlogininfo ($uid))) { // 判断是否已经登录过了，是的话删除
            user_logout ($logininfo[0]['uss']);
        }
        
        $data = array (
            'uid' => $uid,
        	'uss' => $uss,
        	'time' => time (),
        	'ip' => $_SERVER['REMOTE_ADDR']
        );
        $GLOBALS['db']->insert ('online', $data);

        return $uss;
    }
    
    function user_logout ($uss) // 登出
    {
        $where = array (
        	'uss' => $uss
        );
		$GLOBALS['db']->delete ('online', $where);
    }
    
    function user_search ($user) // 搜索帐号
    {
        $where = array (
        	'OR' => array (
        		'email' => $user,
        		'name' => $user
        	),
        	'LIMIT' => 1
        );
		$ret = $GLOBALS['db']->select ('users', 'uid', $where);
        
        return (count ($ret) == 0 ? -1 : $ret[0]);
    }
    
    function user_getinfo ($uid, $limit = 0, $count = false) // 获取帐号信息
    {
        // 初始化变量
        $where = array ();
        $uid == 0 ? : $where['uid'] = $uid;
        
        // 查询
        if ($limit != 0) {
			$where['LIMIT'] = $limit;
		}

		$ret = $count ? $GLOBALS['db']->count ('users', $where) : $GLOBALS['db']->select ('users', '*', $where);

		// 返回
        return (count ($ret) == 0 ? '' : $ret);
    }
    
    function user_loginsearch ($uss) // 搜索登录帐号
    {
        $where = array (
        	'uss' => $uss,
        	'LIMIT' => 1
        );
		$ret = $GLOBALS['db']->select ('online', 'uid', $where);
        
        return (count ($ret) == 0 ? -1 : $ret[0]);
    }
    
    function user_getlogininfo ($uid, $limit = 0, $count = false) // 获取帐号登录信息
    {
        // 初始化变量
        $uid == 0 ? : $where['uid'] = $uid;
        
        // 查询
        if ($limit != 0) {
			$where['LIMIT'] = $limit;
		}

		$ret = $count ? $GLOBALS['db']->count ('online', $where) : $GLOBALS['db']->select ('online', '*', $where);

		// 返回
        return (count ($ret) == 0 ? '' : $ret);
    }
    
    function user_setgroup ($uid, $gid) // 设置某账号的用户组
    {
        $data = array (
        	'gid' => $gid
        );
        $where = array (
        	'uid' => $uid
        );
        $GLOBALS['db']->update ('users', $data, $where);
    }

    function user_setpassword ($uid, $password) // 设置某账号的密码
    {
        $data = array (
        	'password' => md5 (md5 (md5 ($password)))
        );
        $where = array (
        	'uid' => $uid
        );
        $GLOBALS['db']->update ('users', $data, $where);
    }

    function user_setemail ($uid, $email) // 设置某账号的邮箱
    {
        $data = array (
        	'email' => $email
        );
        $where = array (
        	'uid' => $uid
        );
        $GLOBALS['db']->update ('users', $data, $where);
    }
    
    function user_setavatar ($uid, $avatarurl) // 设置某账号的头像
    {
    	$data = array (
        	'avatar' => $avatarurl
        );
        $where = array (
        	'uid' => $uid
        );
        $GLOBALS['db']->update ('users', $data, $where);
    }

    function user_getgravatar ($email) // 通过email获取Gravatar头像
    {
        return 'https://gravatar.iwch.me/avatar/' . md5 (strtolower ($email)) . '?s=200';
    }
?>