<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">插件管理</h3></div>
                <div class="box-body table-responsive">
                <?php
                    $plist = plugin_getlist ();
                    foreach ($plist as $plist_d) {
                        $pinfo_f = plugin_getinfo_f ($plist_d);
                        if (!is_array ($pinfo_f)) continue;
                        ?>
		                    <div class="col-md-4">
		                        <div class="box box-widget widget-user">
		                            <div class="widget-user-header bg-aqua-active" style="background-color: <?php echo getcolor(); ?>;">
		                                <div class="btn-group-vertical plugin">
		                                    <div class="pb">
		                                        <?php
		                                        	if (plugin_getstate ($plist_d)) {
		                                        		?>
                                                    		<button type="button" class="btn btn-danger-alt btn-circle" onclick="deactivate('<?php echo $plist_d ?>')"><i class="fa fa-ban"></i></button>
                                                		<?php 
                                                	} else { 
                                                		?>
                                                    		<button type="button" class="btn btn-success-alt btn-circle" onclick="activate('<?php echo $plist_d ?>')"><i class="fa fa-check"></i></button>
                                                		<?php 
                                                	} 
                                                ?>
                                            </div>
		                                    <div><button type="button" class="btn btn-info-alt btn-circle"><i class="fa fa-cog"></i></button></div>
		                                </div>
		                                <h3 class="widget-user-username"><?php echo $pinfo_f['PluginName'] ?></h3>
		                                <h5 class="widget-user-desc"><?php echo $pinfo_f['Author'] ?></h5>
		                            </div>
		                            
		                            <div class="box-footer">
		                                <div class="row">
		                                    <div class="col-sm-6 border-right">
		                                        <div class="description-block">
		                                            <h5 class="description-header"><?php echo $pinfo_f['Version'] ?></h5>
		                                            <span class="description-text">版本</span>
		                                        </div>
		                                    </div>
		                                    
		                                    <div class="col-sm-6">
		                                        <div class="description-block">
		                                            <h5 class="description-header"><?php echo $pinfo_f['For'] ?></h5>
		                                            <span class="description-text">适用版本</span>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                <?php
		            }
    			?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
  
<!-- 底部引入 -->
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="<?php echo $siteinfo['theme']['url']; ?>/assets/plugins/notice/notice.js"></script>
<script>
function activate(pcn) {
    $.ajax({ 
        type: "post", 
        url : "./ajax.php?mod=admin-plugins", 
        dataType: "json",
        data: "do=activate&pcn="+pcn, 
        success: function(result){
            if (result.code == 0) {
                notie('success', '启用成功', true);
                setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
        },
        error: function(result){
    		notie('error', '启用失败，可能是插件含有错误或者你的网络问题', true);
        }
    });
}

function deactivate(pcn) {
    $.ajax({ 
        type: "post", 
        url : "./ajax.php?mod=admin-plugins", 
        dataType: "json",
        data: "do=deactivate&pcn="+pcn, 
        success: function(result){
            if (result.code == 0) {
                notie('success', '禁用成功', true);
                setTimeout("window.location.reload()",500)
            } else {
                notie('error', result.msg , true);
            }
        } 
    });
}
</script>
<?php require_once 'footer.php'; ?>

