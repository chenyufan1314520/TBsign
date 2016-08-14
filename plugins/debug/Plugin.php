<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	/*
	-----BEGIN INFO-----
	@Class debug
	@PluginName 调试插件
	@Description 一个抄袭来的调试插件
	@Author U2FsdGVkX1
	@AuthorEmail U2FsdGVkX1@gmail.com
	@For 1.0
	@Version 1.1
	-----END INFO-----
	*/

	class debug {
		public static function render () {
			hook_register ('init_1', 'startt');
			hook_register ('footer_2', 'endt');
		}
	}

	function startt ()
	{
		global $t;
		$t = microtime (true);
	}

	function endt ()
	{
		global $t;
		echo '<br><b>PHP 执行时间：' . (microtime (true) - $t) . '</b>';
	}
?>
