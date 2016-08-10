<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">计划任务管理</h3></div>
                <div class="box-body table-responsive">
					<?php
                		$cronlist = cron_getinfo (0);
                		if (is_array ($cronlist)) {
	                		foreach ($cronlist as $cronlist_d) {
	                			?> 
				                    <div class="col-md-4">
				                        <div class="box box-widget widget-user">
				                            <div class="widget-user-header bg-aqua-active" style="background-color: <?php echo getcolor(); ?>;">
				                                <div class="btn-group-vertical plugin">
				                                    <div class="pb">
		                                                <button type="button" class="btn btn-danger-alt btn-circle" onclick="deactivate('')"><i class="fa fa-ban"></i></button>
		                                            </div>
				                                    <div><button type="button" class="btn btn-info-alt btn-circle"><i class="fa fa-cog"></i></button></div>
				                                </div>
				                                <h3 class="widget-user-username"><?php echo $cronlist_d['name'] ?></h3>
				                                <h5 class="widget-user-desc"></h5>
				                            </div>
				                            
				                            <div class="box-footer">
				                                <div class="row">
				                                    <div class="col-sm-6 border-right">
				                                        <div class="description-block">
				                                            <h5 class="description-header"><?php echo ($cronlist_d['lasttime'] ? date ('Y-m-d H:i:s', $cronlist_d['lasttime']) : '从未') ?></h5>
				                                            <span class="description-text">上次执行</span>
				                                        </div>
				                                    </div>
				                                    
				                                    <div class="col-sm-6">
				                                        <div class="description-block">
				                                            <h5 class="description-header"><?php echo basename ($cronlist_d['url']) ?></h5>
				                                            <span class="description-text">文件名</span>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                <?php
				            }
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

<?php require_once 'footer.php' ?>