<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
    // 加载配置
    require_once 'init.php';
	
	// 钩子
	hook_trigger ('sign_1');
	
    // 获取贴吧信息
    $tiebalist = sign_getinfo (0, 0, 0, 0, false, 0, strtotime (date ('Y-m-d')), 0);
    if (is_array ($tiebalist)) {
	    foreach ($tiebalist as $tiebalist_d) {
	    	// 钩子
			hook_trigger ('sign_2');
			
	    	// 获取账号信息
	    	$baiduidinfo = baiduid_getinfo ($tiebalist_d['uid'], $tiebalist_d['bid']);
	    	if (is_array ($baiduidinfo)) {
	    		// 钩子
				hook_trigger ('sign_3');
				
		    	// 签到
		    	$signinfo = tieba_sign ($baiduidinfo[0]['bduss'], $tiebalist_d['kw']);
		    	if (is_array ($signinfo)) {
		    		if ($signinfo['error_code'] == '0' || $signinfo['error_code'] == '160002') { // 判断是否签到成功
		    			sign_setstate ($tiebalist_d['kid'], 1);
		    		} else {
		    			sign_setstate ($tiebalist_d['kid'], $signinfo['error_code']);
		    		}
		    	}
		    	sign_setlasttime ($tiebalist_d['kid'], time ());
		    }
	    }
	}
?>