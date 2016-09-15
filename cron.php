<?php
    // 检查是否已安装
    if (!is_file (__DIR__ . '/config.php')) {
        exit ();
    }

    // 加载配置
    require_once 'init.php';
	
    // 执行计划任务
    $cronlist = cron_getinfo (0); // 获取并循环执行
    foreach ($cronlist as $cronlist_d) {
    	cron_run ($cronlist_d['cid']);
    }
?>