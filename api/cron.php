<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function cron_add ($name, $url) // 添加一个计划任务
    {
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
        $where = array (
			'cid' => $cid
		);
		$GLOBALS['db']->delete ('cron', $where);
    }
	
	function cron_search ($name) // 搜索一个计划任务
    {
        $where = array (
        	'name' => $name,
        	'LIMIT' => 1
        );
		$ret = $GLOBALS['db']->select ('cron', 'cid', $where);
        
        return (count ($ret) == 0 ? -1 : $ret[0]);
    }
	
    function cron_getinfo ($cid) // 获取某任务信息
    {
        // 初始化变量
        $where = array ();
        $cid == 0 ? : $where['cid'] = $cid;
        
        // 查询
		$ret = $GLOBALS['db']->select ('cron', '*', $where);

        return (count ($ret) == 0 ? '' : $ret);
    }

    function cron_run ($cid) // 执行某任务
    {
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