<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">主题管理</h3></div>
                <div class="box-body table-responsive">
                    
                    <div class="col-md-4">
                        <div class="box box-widget widget-user">
                            <div class="widget-user-header bg-aqua-active" style="background-color: <?php echo getcolor(); ?>;">
                                <div class="btn-group-vertical plugin">
                                    <div class="pb"><button type="button" class="btn btn-info-alt btn-circle"><i class="fa fa-cog"></i></button></div>
                                    <div><button type="button" class="btn btn-danger-alt btn-circle"><i class="fa fa-trash"></i></button></div>
                                </div>
                                <h3 class="widget-user-username">主题名</h3>
                                <h5 class="widget-user-desc">主题作者</h5>
                            </div>
                            
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">1.0</h5>
                                            <span class="description-text">版本</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="description-block">
                                            <h5 class="description-header">35</h5>
                                            <span class="description-text">标识符</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</section>
</div>
  
<!-- 底部引入 -->
<?php require_once 'footer.php'; ?>

