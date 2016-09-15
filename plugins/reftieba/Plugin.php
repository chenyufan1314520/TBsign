<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	/*
	-----BEGIN INFO-----
	@Class reftieba
	@PluginName 自动刷新贴吧
	@Description 启用之后会在每天0点自动刷新贴吧
	@Author U2FsdGVkX1
	@AuthorEmail U2FsdGVkX1@gmail.com
	@For 1.0
	@Version 1.1
	-----END INFO-----
	*/

	class reftieba {
		public static function activate ($pcn) {
			$GLOBALS['db']->query ('alter table `'. DBPREFIX .'baiduid` add `reftime` int null default 0');
			cron_add ('自动刷新贴吧列表', 'plugins/' . $pcn . '/cron.php');
		}
		
		public static function deactivate ($pcn) {
			$GLOBALS['db']->query ('alter table `'. DBPREFIX .'baiduid` drop column `reftime`');
			cron_delete (cron_search ('自动刷新贴吧列表'));
		}
	}
?>