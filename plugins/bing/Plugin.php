<?php if (!defined ('SYSTEM_ROOT')) exit (); 
	/*
	-----BEGIN INFO-----
	@Class bing
	@PluginName 每日bing图
	@Description 启用之后会将会把登录与注册页的背景替换成每日bing图
	@Author JclMiku
	@AuthorEmail kotori@moe.network
	@For 1.0
	@Version 1.1
	-----END INFO-----
	*/

	class bing {
		public static function render () {
			hook_register ('header_1', 'css');
		}
	}
	
	function css() {
	    if ($_GET['mod'] == 'login' || $_GET['mod'] == 'reg'){
    	    $data = json_decode(file_get_contents('http://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1'), true);
            echo '<style>.login-logo{color: #FFF;}.login-page, .register-page {background: url(https://api.kotori.cat/img/?url=http://s.cn.bing.net'. $data['images'][0]['url'] .');-moz-background-size: 100% 100%;background-size: 100% 100%;}</style>';
	    }
	}
?>