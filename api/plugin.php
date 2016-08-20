<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	function plugin_getlist () // 枚举插件列表
	{
		// 初始化变量
		$plist = array ();

		// 获取目录
		$dirlist = scandir (SYSTEM_ROOT . '/plugins');

		// 遍历
		foreach ($dirlist as $dirlist_d) {
			if (is_dir (SYSTEM_ROOT . '/plugins/' . $dirlist_d)) {
				if (is_file (SYSTEM_ROOT . '/plugins/' . $dirlist_d . '/Plugin.php')) {
					$plist[] .= $dirlist_d;
				}
			}
		}

		// 返回
		return $plist;
	}

	function plugin_activate ($pcn) // 启用某插件
	{
		// 获取插件信息
		$pinfo_f = plugin_getinfo_f ($pcn);
		$classname = $pinfo_f['Class'];

		// 启用插件
		require_once plugin_getroot ($pcn) . '/Plugin.php';
		if (class_exists ($classname)) {
			// 调用插件事件
			if (method_exists ($classname, 'activate')) {
				$classname::activate ($pcn);
			}

			// 保存数据库信息
			$data = array (
				'pcn' => $pcn,
				'class' => $classname,
				'isactivate' => 1
			);
			$GLOBALS['db']->insert ('plugins', $data);
		}
	}

	function plugin_deactivate ($pcn, $nocall = false) // 停用某插件
	{
		// 获取插件信息
		$pinfo = plugin_getinfo ($pcn);
		$classname = $pinfo[0]['class'];

		// 删除数据库信息
		$where = array (
			'pcn' => $pcn
		);
		$GLOBALS['db']->delete ('plugins', $where);

		// 禁用插件
		if (!$nocall) {
			require_once plugin_getroot ($pcn) . '/Plugin.php';
			if (class_exists ($classname)) {
				// 调用插件事件
				if (method_exists ($classname, 'deactivate')) {
					$classname::deactivate ($pcn);
				}
			}
		}
	}

	function plugin_runall () // 加载所有插件
	{
		// 初始化变量
		global $plugin_cuplugin;

		// 获取所有已启用的插件
		$plist = plugin_getinfo ('');
		if (is_array ($plist)) {
			foreach ($plist as $plist_d) {
				// 记录
				$plugin_cuplugin = $plist_d['pcn'];

				// 包含插件
				require_once plugin_getroot ($plist_d['pcn']) . '/Plugin.php';

				// 调用插件事件
				if (method_exists ($plist_d['class'], 'render')) {
					$plist_d['class']::render ($plugin_cuplugin);
				}
			}
		}

		// 销毁变量
		unset ($plugin_cuplugin);
	}

	function plugin_getstate ($pcn) // 检测某插件是否启用
	{
		$where = array (
			'pcn' => $pcn
		);
		$ret = $GLOBALS['db']->has ('plugins', $where);

		return $ret;
	}

	/*
	function plugin_callmethod ($pcn, $method) // 调用某插件方法
	{

	}
	*/

	function plugin_getinfo ($pcn, $limit = 0, $count = false) // 获取某插件信息
	{
		// 初始化变量
		$pcn = empty ($pcn) ? '%' : $pcn;

		// 查询
		$where = array (
			'pcn[~]' => $pcn
		);
		if ($limit != 0) {
			$where['LIMIT'] = $limit;
		}

		$ret = $count ? $GLOBALS['db']->count ('plugins', $where) : $GLOBALS['db']->select ('plugins', '*', $where);

		// 返回
		return $ret;
	}

	function plugin_getroot ($pcn) // 获取某插件根目录
	{
		return SYSTEM_ROOT . '/plugins/' . $pcn;
	}

	function plugin_getinfo_f ($pcn) // 获取某插件信息（文件）
	{
		// 检查是否合法
		if (!is_file ($pfile = plugin_getroot ($pcn) . '/Plugin.php')) {
			return '';
		}

		// 初始化变量
		$isdoc = false;

		// 读入和分割
		$pcode = file_get_contents ($pfile);
		$token = token_get_all ($pcode);

		// 分析
		foreach ($token as $token_d) {
			if ($token_d[0] == T_COMMENT) {
				$doc = preg_split ("#\n#", $token_d[1]);
				
				if (trim ($doc[1]) == '-----BEGIN INFO-----') {
					// 标记
					$isdoc = true;

					// 循环
					foreach ($doc as $doc_d) {
						// 处理
						$doc_t = trim ($doc_d); // 删除首尾的各种乱七八糟

						// 判断是否已结束
						if ($doc_t == '-----END INFO-----') {
							break;
						}

						// 分析
						if (!empty ($doc_t) && $doc_t[0] == '@') {
							$args = explode (' ', substr ($doc_t, 1, strlen ($doc_t) - 1)); // 分割
							if (!empty ($args[0]) && count ($args) >= 2) {
								$pinfo_f[$args[0]] = $args[1];
							}
						}
					}
				}
			}

			if ($isdoc == true) {
				break;
			}
		}

		// 最后处理并返回
		if (!isset ($pinfo_f['Class']) || !isset ($pinfo_f['PluginName']) || !isset ($pinfo_f['Description']) || !isset ($pinfo_f['Author']) || !isset ($pinfo_f['Version']) || !isset ($pinfo_f['For'])) {
			return '';
		} else {
			return $pinfo_f;
		}
	}
?>