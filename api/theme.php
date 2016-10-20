<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function theme_getname_f () // 获取主题文件名称
	{
		// 钩子
        hook_trigger ('tieba_getsign_1');
        
        // 返回
		return option_getvalue ('system_theme');
	}

	function theme_getpath () // 获取主题本地路径
	{
		// 钩子
        hook_trigger ('theme_getpath_1');
        
        // 返回
		return system_getroot () . '/theme/' . theme_getname_f ();
	}

	function theme_geturl () // 获取主题网络路径
	{
		// 钩子
        hook_trigger ('theme_geturl_1');
        
        // 返回
		return system_geturl () . '/theme/' . theme_getname_f ();
	}
	
	function theme_select ($tcn) // 更换主题
	{
		// 钩子
        hook_trigger ('theme_select_1');
        
        // 更换
		option_update ('system_theme', $tcn);
	}
?>