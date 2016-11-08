<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function system_fetch ($url, $postdata = null, $cookie = null, $header = array (), $convert = false) // 访问网页（半原创）
	{
		// 钩子
        hook_trigger ('system_fetch_1');
        
        // 访问
		$ch = curl_init ();
		curl_setopt ($ch, CURLOPT_URL, $url);
		if (!is_null ($postdata)) {
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
		}
		if (!is_null ($cookie)) {
			curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
		}
		if (!empty ($header)) {
			curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
		}
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_HEADER, false);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 20);
		$re = curl_exec ($ch);
		curl_close ($ch);
		if ($convert == true) {
			$re = mb_convert_encoding ($re, 'UTF-8', 'GBK');
		}
		
		return $re;
	}

	function system_scandiff ($flist = array (), $d = '') // 扫描差异文件
	{
		// 初始化变量
		$ret = array ();

		// 获取文件列表
		if (empty ($flist)) {
			$data = array (
				'sid' => auth_getsid (),
				'skey' => auth_getskey ()
			);
			$header = array (
				'version' => system_getversion ()
			);
			$flist = json_decode (system_fetch (API_URL . '/index.php?mod=updata', $data, NULL, $header), true);
		}

		// 对比文件
		if ($d != '' && ($d[strlen ($d) - 1]) != '/') {
			$d .= '/';
		}

		if (!empty ($flist)) {
			foreach ($flist as $flist_n => $flist_d) {
				if (is_array ($flist_d)) {
					$ret = array_merge ($ret, system_scandiff ($flist_d, $d . $flist_n));
				} else {
					if (!is_file ($d . $flist_n) || $flist_d != md5_file ($d . $flist_n)) {
						$ret[] = $d . $flist_n;
					}
				}
			}
		}

		// 返回
		return $ret;
	}

	function system_getroot () // 获取云签目录
	{
		// 钩子
        hook_trigger ('system_getroot_1');
        
        // 返回
		return dirname (__DIR__);
	}

	function system_geturl () // 获取云签URL
	{
		// 钩子
        hook_trigger ('system_geturl_1');
        
        // 返回
		return option_getvalue ('system_url');
	}
	function system_getname () // 获取云签站点名
	{
		// 钩子
        hook_trigger ('system_getname_1');
        
        // 返回
		return option_getvalue ('system_name');
	}
	function system_getbeian () // 获取云签备案号
	{
		// 钩子
        hook_trigger ('system_getbeian_1');
        
        // 返回
		return option_getvalue ('system_beian');
	}
	function system_getnotice () // 获取公告
	{
		// 钩子
        hook_trigger ('system_getnotice_1');
        
        // 返回
		return option_getvalue ('system_notice');
	}
	function system_getversion () // 获取版本
	{
		// 钩子
        hook_trigger ('system_getversion_1');
        
        // 返回
		return option_getvalue ('system_version');
	}

	function system_seturl ($url) // 设置云签URL
	{
		// 钩子
        hook_trigger ('system_seturl_1');
        
        // 返回
		return option_update ('system_url', $url);
	}
	function system_setname ($name) // 设置云签站点名
	{
		// 钩子
        hook_trigger ('system_setname_1');
        
        // 返回
		return option_update ('system_name', $name);
	}
	function system_setbeian ($beian) // 设置云签备案号
	{
		// 钩子
        hook_trigger ('system_setbeian_1');
        
        // 返回
		return option_update ('system_beian', $beian);
	}
	function system_setnotice ($notice) // 设置公告
	{
		// 钩子
        hook_trigger ('system_setnotice_1');
        
        // 返回
		return option_update ('system_notice', $notice);
	}
?>