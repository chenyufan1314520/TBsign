<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function group_add ($name) // 添加用户组
	{
		// 钩子
        hook_trigger ('group_add_1');
        
        // 添加
		$data = array (
			'gid' => NULL,
			'name' => $name
		);
		$ret = $GLOBALS['db']->insert ('groups', $data);

		return $ret;
	}

	function group_delete ($gid) // 删除用户组
	{
		// 钩子
        hook_trigger ('group_delete_1');
        
        // 删除
		$where = array (
			'gid' => $gid
		);
		$GLOBALS['db']->delete ('groups', $where);
	}

	function group_getinfo ($gid, $limit = 0, $count = false) // 获取用户组信息
	{
		// 钩子
        hook_trigger ('group_getinfo_1');
        
		// 初始化变量
		$where = array ();
		$gid == 0 ? : $where['gid'] = $gid;

		// 查询
		if ($limit != 0) {
			$where['LIMIT'] = $limit;
		}

		$ret = $count ? $GLOBALS['db']->count ('groups', $where) : $GLOBALS['db']->select ('groups', '*', $where);

		// 返回
		return $ret;
	}
?>