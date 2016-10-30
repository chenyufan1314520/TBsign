<?php if (!defined ('SYSTEM_ROOT')) exit (); ?>
<!-- 头部引入 -->
<?php require_once 'header.php'; ?>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right ui-sortable-handle">
                        <li class="active"><a href="#commonset" data-toggle="tab">基础设置</a></li>
                        <!--- <li class=""><a href="#signset" data-toggle="tab">签到设置</a></li> --->
                        <li class="pull-left header">站点管理</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="commonset">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>站点地址</td>
                                        <td><input type="text" name="siteurl" id="siteurl" value="<?php echo $siteinfo['url']; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>站点名称</td>
                                        <td><input type="text" name="sitename" id="sitename" value="<?php echo $siteinfo['name']; ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>备案号</td>
                                        <td><input type="text" name="beian" id="beian" value="<?php echo system_getbeian (); ?>" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td>公告</td>
                                        <td><textarea name="sitenotice" id="sitenotice" class="form-control" rows="5"><?php echo system_getnotice (); ?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="chart tab-pane" id="signset">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td>允许用户最大绑定账号数</td>
                                        <td><input type="number" name="bdussnum" id="bdussnum" value="" class="form-control"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div style="padding: 10px;">
                            <input type="submit" id="set" class="btn btn-primary" value="执行操作">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
  
<!-- 底部引入 -->
<?php require_once 'footer.php'; ?>

