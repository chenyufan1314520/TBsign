<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	// 获取需要刷新的ID
	$column = array (
		'bid',
		'uid'
	);
	$where = array (
		'reftime[<]' => strtotime (date ('Y-m-d'))
	);
	$baiduidlist = $GLOBALS['db']->select ('baiduid', $column, $where);

	// 刷新
	foreach ($baiduidlist as $baiduidlist_d) {
		sign_reftieba ($baiduidlist_d['uid'], $baiduidlist_d['bid']); // 刷新贴吧列表

		$data = array ( // 标记刷新
			'reftime' => time ()
		);
		$where = array (
			'AND' => array (
				'bid' => $baiduidlist_d['bid'],
				'uid' => $baiduidlist_d['uid']
			),
			'LIMIT' => 1
		);
		$GLOBALS['db']->update ('baiduid', $data, $where);
	}
?>