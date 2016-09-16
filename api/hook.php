<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	$hook = array ();
	
	function hook_register ($hookname, $func) // 注册钩子
	{
		// 全局变量
		global $hook;
		
		// 添加钩子
		$hook[$hookname][] = $func;
	}
	
	function hook_trigger ($hookname) // 触发钩子
	{
		// 全局变量
		global $hook;
		
		// 调用钩子
		if (isset ($hook[$hookname])) {
			foreach ($hook[$hookname] as $func)
			{
				call_user_func ($func);
			}
		}
	}
?>