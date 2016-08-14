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
        	'state' => 1
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
	
	function sign_reftieba ($uid, $bid) // 刷新贴吧
	{
		// 事务
		$GLOBALS['db']->pdo->beginTransaction();
		
		// 删除
		sign_deleteall ($uid, $bid);
		
		// 添加
		$refid = baiduid_getinfo ($uid, $bid);
		if (is_array ($refid)) {
			$tiebalist = tieba_getlike ($refid[0]['bduss']);
			if (is_array ($tiebalist)) {
				foreach ($tiebalist as $tiebalist_d) {
					sign_add ($uid, $bid, $tiebalist_d['name'], $tiebalist_d['id']);
				}
			}
		}
		
		// 事务
		$GLOBALS['db']->pdo->commit();
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

    function sign_getinfo ($uid, $bid, $kid, $limit = 0, $count = false, $time1 = 0, $time2 = 0, $state = 0, $not = false) // 获取某贴吧信息
    {
    	// 初始化变量
    	$uid == 0 ? : $where['AND']['uid'] = $uid;
        $bid == 0 ? : $where['AND']['bid'] = $bid;
        $kid == 0 ? : $where['AND']['kid'] = $kid;
        if ($not == false) {
        	$state == 0 ? : $where['AND']['state'] = $state;
        } else {
        	$state == 0 ? : $where['AND']['state[!]'] = $state;
        }

        // 查询
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