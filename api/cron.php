<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function cron_add ($name, $url) // 添加一个计划任务
	{
		// 钩子
        hook_trigger ('cron_add_1');
        
        // 添加
		$data = array (
			'name' => $name,
			'url' => $url,
			'lasttime' => 0,
			'protect' => 0
		);
		$ret = $GLOBALS['db']->insert ('cron', $data);

		return $ret;
	}

	function cron_delete ($cid) // 删除一个计划任务
	{
		// 钩子
        hook_trigger ('cron_delete_1');
        
        // 删除
		$where = array (
			'cid' => $cid
		);
		$GLOBALS['db']->delete ('cron', $where);
	}

	function cron_search ($name) // 搜索一个计划任务
	{
		// 钩子
        hook_trigger ('cron_search_1');
        
        // 搜索
		$where = array (
			'name' => $name,
			'LIMIT' => 1
		);
		$ret = $GLOBALS['db']->select ('cron', 'cid', $where);

		return (empty ($ret) ? -1 : $ret[0]);
	}

	function cron_getinfo ($cid) // 获取某任务信息
	{
		// 钩子
        hook_trigger ('cron_getinfo_1');
        
		// 初始化变量
		$where = array ();
		$cid == 0 ? : $where['cid'] = $cid;

		// 查询
		$ret = $GLOBALS['db']->select ('cron', '*', $where);

		return ($ret);
	}

	function cron_run ($cid) // 执行某任务
	{
		// 钩子
        hook_trigger ('cron_run_1');
        
		// 初始化变量
		$croninfo = cron_getinfo ($cid);

		// 执行
		if (is_array ($croninfo)) {
			if (is_file (SYSTEM_ROOT . '/' . $croninfo[0]['url']))
			{
				require SYSTEM_ROOT . '/' . $croninfo[0]['url'];
			}
		}

		// 更新执行时间
		$data = array (
			'lasttime' => time ()
		);
		$where = array (
			'cid' => $cid
		);
		$GLOBALS['db']->update ('cron', $data, $where);
	}
?>