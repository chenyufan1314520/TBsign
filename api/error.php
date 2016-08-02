<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<?php
	// 设置处理
	set_error_handler ('error_error');
	set_exception_handler ('error_exception');
	
	// 函数
	function error_error ($errno , $errstr , string $errfile , int $errline) // 错误
	{
		?>
			<html>
				<head>
					<title>Error</title>
					<style type="text/css">
						body { background-color: white; color: black; font: 9pt/11pt verdana, arial, sans-serif;}
						#container { width: 1024px; }

						.red  {color: red;}
							a:link     { font: 9pt/11pt verdana, arial, sans-serif; color: red; }
							a:visited  { font: 9pt/11pt verdana, arial, sans-serif; color: #4e4e4e; }
							h1 { color: #FF0000; font: 18pt "Verdana"; margin-bottom: 0.5em;}
							.bg1{ background-color: #FFFFCC;}
							.bg2{ background-color: #EEEEEE;}
							.table {background: #AAAAAA; font: 11pt Menlo,Consolas,"Lucida Console"}
							.info {
							background: none repeat scroll 0 0 #F3F3F3;
							border: 0px solid #aaaaaa;
							border-radius: 10px 10px 10px 10px;
							color: #000000;
							font-size: 11pt;
							line-height: 160%;
							margin-bottom: 1em;
							padding: 1em;
						}

						.help {
							background: #F3F3F3;
							border-radius: 10px 10px 10px 10px;
							font: 12px verdana, arial, sans-serif;
							text-align: center;
							line-height: 160%;
							padding: 1em;
						}
					</style>
				</head>
				<body>
					<div id="container">
						<h1>贴吧云签到错误</h1>
						<div class="info">
							<p><strong>PHP Debug</strong></p>
								<table cellpadding="5" cellspacing="1" width="100%" class="table">
								<tr class="bg2">
									<td>Erron</td>
									<td>File</td>
									<td>Line</td>
									<td>Msg</td>
								</tr>
								<tr class="bg1">
									<td><?php echo $errno ?></td>
									<td><?php echo basename ($errfile) ?></td>
									<td><?php echo $errline ?></td>
									<td><?php echo $errstr ?></td>
								</tr>
							</table>
						</div>
						<div class="help">
							已经将此出错信息详细记录, 由此给您带来的访问不便我们深感歉意.
							<a href="https://bbs.tbsign.in" target="_blank">
								<span class="red">Need Help?</span>
							</a>
						</div>
					</div>
				</body>
			</html>
		<?php
		exit ();
	}
	
	function error_exception ($exception) // 异常
	{
		?>
			<html>
				<head>
					<title>Error</title>
					<style type="text/css">
						body { background-color: white; color: black; font: 9pt/11pt verdana, arial, sans-serif;}
						#container { width: 1024px; }

						.red  {color: red;}
							a:link     { font: 9pt/11pt verdana, arial, sans-serif; color: red; }
							a:visited  { font: 9pt/11pt verdana, arial, sans-serif; color: #4e4e4e; }
							h1 { color: #FF0000; font: 18pt "Verdana"; margin-bottom: 0.5em;}
							.bg1{ background-color: #FFFFCC;}
							.bg2{ background-color: #EEEEEE;}
							.table {background: #AAAAAA; font: 11pt Menlo,Consolas,"Lucida Console"}
							.info {
							background: none repeat scroll 0 0 #F3F3F3;
							border: 0px solid #aaaaaa;
							border-radius: 10px 10px 10px 10px;
							color: #000000;
							font-size: 11pt;
							line-height: 160%;
							margin-bottom: 1em;
							padding: 1em;
						}

						.help {
							background: #F3F3F3;
							border-radius: 10px 10px 10px 10px;
							font: 12px verdana, arial, sans-serif;
							text-align: center;
							line-height: 160%;
							padding: 1em;
						}
					</style>
				</head>
				<body>
					<div id="container">
						<h1>贴吧云签到错误</h1>
						<div class="info">
							<p><strong>PHP Debug</strong></p>
								<table cellpadding="5" cellspacing="1" width="100%" class="table">
								<tr class="bg2">
									<td>No.</td>
									<td>File</td>
									<td>Line</td>
									<td>Code</td>
								</tr>
								<?php
									// 判断是否是插件引起的错误，是的话强制禁用
									if (isset ($GLOBALS['plugin_cuplugin'])) {
										plugin_deactivate ($GLOBALS['plugin_cuplugin'], true);
									}
									
									// 循环
									foreach ($exception->getTrace () as $i => $ep_d) {
										?>
											<tr class="bg1">
												<td><?php echo $i + 1 ?></td>
												<td><?php echo basename ($ep_d['file']) ?></td>
												<td><?php echo $ep_d['line'] ?></td>
												<td>
													<?php
														if (!empty ($ep_d['class'])) {
															echo $ep_d['class'] . '->';
														}
														
														if (!empty ($ep_d['function'])) {
															echo $ep_d['function'];
															echo '(';
															
															if (isset ($ep_d['args']) && count ($ep_d['args']) != 0) {
																$args_tmp = $ep_d['args'];
																if (is_array ($args_tmp[0])) {
																	$args_tmp = $args_tmp[0];
																}

																if (defined ('DBPASS')) {
																	foreach ($args_tmp as &$arg_tmp) { // 防止数据库连接错误之后，数据库信息被爆出来
																		switch ($arg_tmp) {
																			case DBHOST:
																				$arg_tmp = '%DBHOST%';
																				break;
																			case DBNAME:
																				$arg_tmp = '%DBNAME%';
																				break;
																			case DBUSER:
																				$arg_tmp = '%DBUSER%';
																				break;
																			case DBPASS:
																				$arg_tmp = '%DBPASS%';
																				break;
																			case DBPREFIX:
																				$arg_tmp = '%DBPREFIX%';
																				break;
																			case DBTYPE:
																				$arg_tmp = '%DBTYPE%';
																				break;
																		}
																	}
																}

																if (count ($args_tmp) != 0) {
																	echo implode (', ', $args_tmp);
																}
															}
															
															echo ')';
														}
													?>
												</td>
											</tr>
										<?php
									}
								?>
							</table>
						</div>
						<div class="help">
							已经将此出错信息详细记录, 由此给您带来的访问不便我们深感歉意.
							<a href="https://bbs.tbsign.in" target="_blank">
								<span class="red">Need Help?</span>
							</a>
						</div>
					</div>
				</body>
			</html>
		<?php
		exit ();
	}
?>