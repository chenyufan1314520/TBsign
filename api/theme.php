<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function theme_getname_f () // 获取主题文件名称
	{
		return option_getvalue ('system_theme');
	}

	function theme_getpath () // 获取主题本地路径
	{
		return system_getroot () . '/theme/' . theme_getname_f ();
	}

	function theme_geturl () // 获取主题网络路径
	{
		return system_geturl () . '/theme/' . theme_getname_f ();
	}
?>