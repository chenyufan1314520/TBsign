<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>
<link rel="stylesheet" href="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/checkbox/checkbox.css">
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            云签到日志
        </h1>
        <div class="breadcrumb gn">
            <button type="button" class="btn btn-block btn-info" id="refall">刷新全部贴吧</button>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
            	    $ztime = strtotime (date ('Y-m-d'));
            	    if (is_array ($baiduidinfo)) {
    	            	foreach ($baiduidinfo as $baiduidlist_d) {
    						?>
    				            <div class="box">
    				                <div class="box-header">
    				                    <h3 class="box-title"><?php echo $baiduidlist_d['name'] ?></h3>
    				                    <div class="box-tools pull-right">
    				                        <button type="button" class="btn btn-box-tool" id="reftieba" onclick="reftieba('<?php echo $baiduidlist_d['bid'] ?>')"><i class="fa fa-refresh"></i></button>
    				                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    				                    </div>
    				                </div>
    				                <div class="box-body table-responsive">
    				                    <table class="table table-hover">
    				                        <thead>
    				                            <tr>
    				                                <th>ID</th>
    				                                <th>贴吧名</th>
    				                                <th>上次签到时间</th>
    				                                <th>状态</th>
    				                            </tr>
    				                        </thead>
    				                        <tbody>
    				                        	<?php
    				                        		$tiebalist = sign_getinfo ($userinfo['uid'], $baiduidlist_d['bid'], 0);
    				            					if (is_array ($tiebalist)) {
    				            						foreach ($tiebalist as $tiebalist_d) {
    				            							?>
    								                            <tr>
    								                                <td><?php echo $tiebalist_d['kid'] ?></td>
    								                                <td class="wrap"><?php echo $tiebalist_d['kw'] ?></td>
    								                                <td><?php echo ($tiebalist_d['lasttime'] ? date ('Y-m-d H:i:s', $tiebalist_d['lasttime']) : '从未') ?></td>
    								                                <td>
    								                                <?php 
    								                                	if ($tiebalist_d['state'] == '1') {
    								                                		if ($tiebalist_d['lasttime'] >= $ztime) {
    								                                			echo '成功';
    								                                		} else {
    								                                			echo '等待签到';
    								                                		}
    								                                	} else {
    																		echo '错误码：' . $tiebalist_d['state'];
    								                                	}
    								                                ?>
    								                                </td>
    								                            </tr>
    				                            			<?php
    				                               		}
    				                            	}
    				                            ?>
    				                        </tbody>
    				                    </table>
    				                </div>
    				            </div>
    	            		<?php
    	        		}
    	        	}
                ?>
            </div>
        </div>
    </section>
</div>

<!-- 底部引入 -->
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/notice/notice.js"></script>
<script>
function reftieba(bid){
    $("#reftieba").attr("disabled", "disabled");

    $.ajax({ 
        type: "post", 
        url : "./ajax.php?mod=showtb", 
        dataType: "json",
        data: "do=ref&bid="+bid, 
        success: function(result){
            if (result.code == 0) {
                notie('success', '刷新成功', true);
				setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
			$("#reftieba").attr("disabled",false);
        } 
    });
}
$('#refall').click(function(){
	$("#refall").attr("disabled", "disabled");
	$.ajax({
        type: "post",
        url : "./ajax.php?mod=showtb",
        dataType: "json",
        data: "do=refall",
        success: function(result){
            if (result.code == 0) {
                notie('success', '刷新成功', true);
				setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
			$("#refall").attr("disabled",false);
        }
    });
});
</script>

<?php require_once 'footer.php'; ?>

