<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
    function baiduid_add ($uid, $bduss) // 添加一条百度ID
    {
        // 判断是否已存在
        if (baiduid_search ($uid, $bduss) != -1) {
    		return -1;
    	}

    	// 判断是否合法
    	if (!is_array (($baiduidinfo = tieba_getuserinfo ($bduss)))) {
    		return -2;
    	}

        // 添加bduss
        $data = array (
        	'bid' => NULL,
        	'uid' => $uid,
        	'bduss' => $bduss,
        	'name' => $baiduidinfo['data']['user_name_show'],
        	'avatar' => 'http://tb.himg.baidu.com/sys/portrait/item/' . $baiduidinfo['data']['user_portrait']
        );
        $ret = $GLOBALS['db']->insert ('baiduid', $data);

        // 返回
        return $ret;
    }
    
    function baiduid_delete ($uid, $bid) // 删除一条百度ID
    {
    	// 删除表
        $where = array (
        	'AND' => array (
        		'uid' => $uid,
        		'bid' => $bid
        	)
		);
		$GLOBALS['db']->delete ('baiduid', $where);

		// 删除所刷新的贴吧列表
		sign_deleteall ($uid, $bid);
    }

    function baiduid_getinfo ($uid, $bid, $limit = 0, $count = false) // 获取某百度ID
    {
    	// 初始化变量
    	$where = array ();
        $uid == 0 ? : $where['AND']['uid'] = $uid;
        $bid == 0 ? : $where['AND']['bid'] = $bid;

        // 查询
        if ($limit != 0) {
			$where['LIMIT'] = $limit;
		}
		
		$ret = $count ? $GLOBALS['db']->count ('baiduid', $where) : $GLOBALS['db']->select ('baiduid', '*', $where);
		
		// 返回
		return (count ($ret) == 0 ? '' : $ret);
    }

    function baiduid_search ($uid, $bduss) // 搜索百度ID
    {
        $where = array (
        	'AND' => array (
        		'uid' => $uid,
        		'bduss' => $bduss
        	)
        );
		$ret = $GLOBALS['db']->select ('baiduid', 'bid', $where);
        
        return (count ($ret) == 0 ? -1 : $ret[0]);
    }
?>