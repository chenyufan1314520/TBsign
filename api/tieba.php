<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function tieba_getsign ($data) { // 签名数据
		// 初始化变量
		$ret = '';

		// 合并数组
		foreach ($data as $k => $data_d) {
			$ret .= $k . '=' . $data_d . '&';
		}

		// 签名
		$ret .= 'sign=' . md5 (str_replace ('&', '', $ret) . 'tiebaclient!!!');

		// 返回
		return $ret;
	}

	function tieba_login ($user, $password, $vcode = '', $vcode_md5 = '') // 登录
	{
		$url = API_URL . '/index.php?mod=login';
		$data = array (
			'skey' => auth_getskey (),
			'user' => $user,
			'password' => $password
		);
		$header = array (
			'tbsignversion' => system_getnotice ()
		);
		if (!empty ($vcode)) {
			$data['vcode'] = $vcode;
		}
		if (!empty ($vcode_md5)) {
			$data['vcode_md5'] = $vcode_md5;
		}

		return system_fetch ($url, $data, NULL, $header);
	}

	function tieba_getlike ($bduss) // 获取喜欢的吧
	{
		// 构造基本数据
		$url = 'http://c.tieba.baidu.com/c/f/forum/like';
		$data = array (
			'bduss' => $bduss
		);

		// 访问网页
		$ret = json_decode (system_fetch ($url, tieba_getsign ($data), 'BDUSS=' . $bduss), true);

		// 返回
		return $ret['forum_list'];
	}

	function tieba_gettbs ($bduss) // 获取tbs
	{
		// 构造基本数据
		$url = 'http://tieba.baidu.com/dc/common/tbs';

		// 访问网页
		$ret = json_decode (system_fetch ($url, NULL, 'BDUSS=' . $bduss), true);

		// 返回
		return $ret['tbs'];
	}

	function tieba_sign ($bduss, $kw) // 签到API
	{
		// 构造基本数据
		$url = 'http://c.tieba.baidu.com/c/c/forum/sign';
		$data = array (
			'bduss' => $bduss,
			'kw' => $kw,
			'tbs' => tieba_gettbs ($bduss)
		);

		// 返回
		return json_decode (system_fetch ($url, tieba_getsign ($data), 'BDUSS=' . $bduss), true); // 不知道为什么傻逼百度又要签名又要Cookie=。=
	}

	function tieba_getuserinfo ($bduss) // 获取某用户信息（不建议使用，建议使用$baiduidinfo）
	{
		// 构造基本数据
		$url = 'http://tieba.baidu.com/f/user/json_userinfo';

		// 返回
		return json_decode (system_fetch ($url, NULL, 'BDUSS=' . $bduss, NULL, true), true); // UTF-8 -> GBK
	}

	function tieba_getavatar ($bduss) // 获取某用户头像（不建议使用，建议使用$baiduidinfo）
	{
		// 获取信息
		$baiduidinfo = tieba_getuserinfo ($bduss);
		
		// 重组头像
		$avatarurl = 'http://tb.himg.baidu.com/sys/portrait/item/' . $baiduidinfo['data']['user_portrait'];

		// 返回
		return $avatarurl;
	}

	function tieba_getname ($bduss) // 获取某用户昵称（不建议使用，建议使用$baiduidinfo）
	{
		// 获取信息
		$baiduidinfo = tieba_getuserinfo ($bduss);
		
		// 返回
		return $baiduidinfo['data']['user_name_show'];
	}

	function tieba_getfid ($kw) // 获取某贴吧的fid
	{
		// 构造基本数据
		$url = 'http://tieba.baidu.com/f/commit/share/fnameShareApi?ie=utf-8&fname=' . $kw;
		
		// 访问网页
		$ret = json_decode (system_fetch ($url), true);

		// 返回
		return $ret['data']['fid'];
	}
?>