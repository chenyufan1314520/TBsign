<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function auth_register ()
	{
		// 获取
		$url = PANEL_URL . '/function.php?mod=register';
		
		$data = array (
			'url' => system_geturl ()
		);
		$header = array (
			'version' => system_getversion ()
		);
		$ret = json_decode (system_fetch ($url, $data, NULL, $header), true);

		// 分析
		if ($ret['code'] == 0) {
			option_iou ('api_sid', $ret['sid']);
			option_iou ('api_skey', $ret['skey']);
		} else {
			die ('请求skey失败，原因：' . $ret['msg']);
		}
	}
	
	function auth_claim ($uss)
	{
		// 获取
		$url = PANEL_URL . '/function.php?mod=claim';
		
		$data = array (
			'sid' => auth_getsid (),
			'skey' => auth_getskey (),
			'uss' => $uss
		);
		$header = array (
			'version' => system_getversion ()
		);
		$ret = json_decode (system_fetch ($url, $data, NULL, $header), true);

		// 分析
		if ($ret['code'] == 0) {
			option_iou ('api_uss', $uss);
		}
		
		// 返回
		return $ret;
	} 
	
	function auth_getsid ()
	{
		return option_getvalue ('api_sid');
	}

	function auth_getskey ()
	{
		return option_getvalue ('api_skey');
	}
	
	function auth_getuss ()
	{
		return option_getvalue ('api_uss');
	}
	
	function auth_getsign ($data)
	{
		// 初始化变量
		$key = file_get_contents (SYSTEM_ROOT . '/public.pem');

		// 签名变量
		$data .= '|-_-|' . auth_getsid () . '|-_-|' . auth_getskey () . '|-_-|' . time ();
		$data .= '|-_-|' . md5 ($data);

		// RSA加密
		openssl_public_encrypt ($data, $sdata, $key);

		// 返回
		return base64_encode ($sdata);
	}

	function auth_verifysign ($sdata)
    {
    	// 初始化变量
    	$sdata = base64_decode ($sdata);
		$key = file_get_contents (SYSTEM_ROOT . '/public.pem');

		// 验证变量
		openssl_public_decrypt ($sdata, $data, $key); // 解密
		$data = explode ('|-_-|', $data);

		if (md5 ($data[0] . '|-_-|' . $data[1]) != $data[2]) { // 验证MD5
			return '';
		}

		if ((time () - $data[1]) > 10) { // 验证时间戳
			return '';
		}

		// 返回
		return $data[0];
    }
?>