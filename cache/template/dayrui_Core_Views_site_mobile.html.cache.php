<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache();"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-cog"></i> <?php echo dr_lang('网站设置'); ?> </a>
                </li>
                <li class="">
                    <a href="<?php echo dr_url("api/mobile"); ?>" target="_blank"> <i class="fa fa-mobile"></i> <?php echo dr_lang('手机预览'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('自动识别'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[auto]" value="1" <?php if ($data['auto']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('开启后将自动识别手机端并强制定向到此域名'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('生成静态'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[tohtml]" value="1" <?php if ($data['tohtml']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('当PC端执行生成静态命令时，移动端也会生成相应的静态文件；关闭表示移动端不生成静态文件'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('手机域名'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" id="dr_domain" type="text" name="data[domain]" value="<?php echo $data['domain']; ?>"></label>
                                <span class="help-block"><?php echo dr_lang('格式：m.test.com，不能包含/符号'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('模板路径'); ?></label>
                            <div class="col-md-9">
                                <div class="form-control-static"><label>/<?php echo dr_lang('模板目录'); ?>/mobile/<?php echo SITE_TEMPLATE; ?>/</label></div>
                            </div>
                        </div>
                        <?php if (!$is_tpl) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('模板提示'); ?></label>
                            <div class="col-md-9">
                                <div class="form-control-static" style="color:red"><label><?php echo dr_lang('没有检测到你的手机端模板，系统将调用电脑端模板'); ?></label></div>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>&page='+$('#dr_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
        </div>
    </div>
</form>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>