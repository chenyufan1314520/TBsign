<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	// 函数
    function system_fetch ($url, $postdata = null, $cookie = null, $header = array (), $convert = false) // 访问网页（半原创）
	{
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
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_TIMEOUT, 20);
		$re = curl_exec ($ch);
		curl_close ($ch);
		if ($convert == true) {
			$re = mb_convert_encoding ($re, 'UTF-8', 'GBK');
		}
		return $re;
	}

	function system_getroot () // 获取云签目录
	{
		return dirname (__DIR__);
	}

	function system_geturl () // 获取云签URL
	{
		return option_getvalue ('system_url');
	}
	function system_getname () // 获取云签站点名
	{
		return option_getvalue ('system_name');
	}
	function system_getbeian () // 获取云签备案号
	{
		return option_getvalue ('system_beian');
	}
	
	function system_seturl ($url) // 设置云签URL
	{
		return option_update ('system_url', $url);
	}
	function system_setname ($name) // 设置云签站点名
	{
		return option_update ('system_name', $name);
	}
	function system_setbeian ($beian) // 设置云签备案号
	{
		return option_update ('system_beian', $beian);
	}
?>