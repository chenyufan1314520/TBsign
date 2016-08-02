<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function sign_add ($uid, $bid, $kw, $fid) // 添加一个贴吧
	{
		// 插入数据到数据库
        $data = array (
        	'kid' => NULL,
        	'bid' => $bid,
        	'uid' => $uid,
        	'kw' => $kw,
        	'fid' => $fid,
        	'lasttime' => '0',
        	'state' => 0
        );
        $ret = $GLOBALS['db']->insert ('tieba', $data);
        
        return $ret;
	}

	function sign_delete ($bid, $kid) // 删除一个贴吧
    {
		$where = array (
        	'AND' => array (
        		'kid' => $kid,
        		'bid' => $bid
        	)
		);
		$GLOBALS['db']->delete ('tieba', $where);
    }

    function sign_deleteall ($uid, $bid) // 删除全部贴吧
    {
		$where = array (
        	'AND' => array (
        		'bid' => $bid,
        		'uid' => $uid
        	)
		);
		$GLOBALS['db']->delete ('tieba', $where);
    }

    function sign_getinfo ($bid, $kid, $limit = 0, $count = false, $time1 = 0, $time2 = 0, $state = 0) // 获取某贴吧信息
    {
    	// 初始化变量
        $bid = $bid == 0 ? '%' : $bid;
        $kid = $kid == 0 ? '%' : $kid;
        $state = $state == 0 ? '%' : $state;

        // 查询
        $where = array (
        	'AND' => array (
        		'kid[~]' => $kid,
        		'bid[~]' => $bid,
        		'state[~]' => $state
        	)
        );
		if ($limit != 0) {
			$where['LIMIT'] = $limit;
		}
		if ($time1 != 0 || $time2 != 0) {
			$where['AND']['lasttime[>=]'] = $time1;
			$where['AND']['lasttime[<=]'] = $time2;
		}

		$ret = $count ? $GLOBALS['db']->count ('tieba', $where) : $GLOBALS['db']->select ('tieba', '*', $where);

		// 返回
		return (count ($ret) == 0 ? '' : $ret);
    }

    function sign_setstate ($kid, $newstate) // 更改状态
    {
    	$data = array (
        	'state' => $newstate
        );
        $where = array (
        	'kid' => $kid
        );
        $GLOBALS['db']->update ('tieba', $data, $where);
    }

    function sign_setlasttime ($kid, $newtime) // 更改上次签到时间
    {
    	$data = array (
        	'lasttime' => $newtime
        );
        $where = array (
        	'kid' => $kid
        );
        $GLOBALS['db']->update ('tieba', $data, $where);
    }
?>