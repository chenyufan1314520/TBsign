<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function option_add ($name, $value, $uid = 0) // 添加一项设置
	{
		$data = array (
			'name' => $name,
			'value' => $value,
			'uid' => $uid
		);
		$GLOBALS['db']->insert ('options', $data);
	}

	function option_update ($name, $newvalue) // 更新一项设置
	{
		$data = array (
			'value' => $newvalue
		);
		$where = array (
			'name' => $name
		);
		$GLOBALS['db']->update ('options', $data, $where);
	}

	function option_iou ($name, $value, $uid = 0) // 插入或者更新一项设置
	{
		if (option_has ($name, $uid)) { 
			// 存在
			option_update ($name, $value);
		} else {
			// 不存在
			option_add ($name, $value, $uid);
		}
	}

	function option_has ($name, $uid = 0) // 判断某项设置是否存在
	{
		$where = array (
			'AND' => array (
				'name' => $name,
				'uid' => $uid
			)
		);
		return $GLOBALS['db']->has ('options', $where);
	}

	function option_delete ($name) //  删除一项设置
	{
		$where = array (
			'name' => $name
		);
		$GLOBALS['db']->delete ('options', $where);
	}

	function option_getvalue ($name, $uid = 0) // 获取一项设置信息
	{
		$where = array (
			'AND' => array (
		    	'name' => $name,
		    	'uid' => $uid
		    ),
			'LIMIT' => 1
		);
		$ret = $GLOBALS['db']->select ('options', 'value', $where);

		return isset ($ret[0]) ? $ret[0] : '';
	}
?>