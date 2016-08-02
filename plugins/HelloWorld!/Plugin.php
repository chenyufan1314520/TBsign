<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	/*
	-----BEGIN INFO-----
	@Class HelloWorld
	@PluginName 你好世界
	@Description 启用之后就会弹出Hello World!
	@Author U2FsdGVkX1
	@AuthorEmail U2FsdGVkX1@gmail.com
	@For 1.0
	@Version 1.0
	-----END INFO-----
	*/

	class HelloWorld {
		public static function render () {
			echo '<script>alert("我只是一个插件(*/ω＼*)");</script>';
		}
	}
?>