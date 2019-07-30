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
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-cog"></i> <?php echo dr_lang('本站域名'); ?> </a>
                </li>
                <li class="<?php if ($page==1) { ?>active<?php } ?>">
                    <a href="#tab_1" data-toggle="tab" onclick="$('#dr_page').val('1')"> <i class="fa fa-table"></i> <?php echo dr_lang('模块域名'); ?> </a>
                </li>
                <li>
                    <a href="#tab_3" data-toggle="tab" onclick="dr_check_domain()"> <i class="fa fa-refresh"></i> <?php echo dr_lang('域名检测'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">



                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('本站电脑域名'); ?></label>
                            <div class="col-md-4">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" <?php if (SITE_ID == 1) { ?> readonly<?php } ?> name="data[site_domain]" value="<?php echo $data['site_domain']; ?>" class="form-control">
                                    <span class="input-group-btn">
                                        <?php if (SITE_ID == 1) { ?>
                                        <a class="btn red" href="javascript:dr_iframe('<?php echo dr_lang("变更域名"); ?>', '<?php echo dr_url("site_domain/edit"); ?>');"><i class="fa fa-edit"></i> <?php echo dr_lang('变更'); ?></a>
                                        <?php } else { ?>
                                        <a class="btn blue" href="<?php echo SITE_URL; ?>" target="_blank"><i class="fa fa-send"></i> <?php echo dr_lang('访问'); ?></a>
                                        <?php } ?>
                                    </span>
                                </div>
                                <span class="help-block"><?php echo dr_lang('本站的域名，通常www.xxx.com'); ?></span>
                            </div>


                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('本站手机域名'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[mobile_domain]" value="<?php echo $data['mobile_domain']; ?>"></label>
                                <span class="help-block"><?php echo dr_lang('手机访问时的域名，通常m.xxx.com'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('本站其他域名'); ?></label>
                            <div class="col-md-9">
                                <label><textarea class="form-control input-large" style="height:150px" name="data[site_domains]"><?php echo str_replace(',',PHP_EOL, $data['site_domains']); ?></textarea></label>
                                <span class="help-block"><?php echo dr_lang('当前站点支持绑定多个域名，它们将会301到主域名，域名一行一个'); ?></span>
                            </div>
                        </div>
                        <?php if (SITE_ID > 1) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('本站Web目录'); ?></label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" name="data[webpath]" id="dr_html_dir" value="<?php echo $data[webpath]; ?>" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn blue" onclick="dr_test_html_dir('dr_html_dir')" type="button"><i class="fa fa-code"></i> <?php echo dr_lang('测试'); ?></button>
                                    </span>
                                </div>
                                <span class="help-block"><?php echo dr_lang('本站的网站目录，必须填写一个有效的目录，并设置可写权限'); ?></span>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="tab-pane <?php if ($page==1) { ?>active<?php } ?>" id="tab_1">
                    <div class="form-body form">

                        <?php if (is_array($module)) { $count=count($module);foreach ($module as $dir=>$t) {  if (!$t['share']) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('%s电脑域名', $t['name']); ?></label>
                            <div class="col-md-9">
                                <?php if ($t['error']) { ?>
                                <span class="help-block" style="color:#ed6b75;margin-top:7px;"><?php echo $t['error']; ?></span>
                                <?php } else { ?>
                                <label><input class="form-control input-large" type="text" name="data[module_<?php echo $dir; ?>]" value="<?php echo $data['module_'.$dir]; ?>"></label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('%s手机域名', $t['name']); ?></label>
                            <div class="col-md-9">
                                <?php if ($t['error']) { ?>
                                <span class="help-block" style="color:#ed6b75;margin-top:7px;"><?php echo $t['error']; ?></span>
                                <?php } else { ?>
                                <label><input class="form-control input-large" type="text" name="data[module_mobile_<?php echo $dir; ?>]" value="<?php echo $data['module_mobile_'.$dir]; ?>"></label>
                                <span class="help-block"><?php echo dr_lang('如果本站绑定了手机域名，这里必须要绑定域名'); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 30px;">
                            <label class="col-md-2 control-label"><?php echo dr_lang('%s模块Web目录', $t['name']); ?></label>
                            <div class="col-md-9">
                                <?php if ($t['error']) { ?>
                                <span class="help-block" style="color:#ed6b75;margin-top:7px;"><?php echo $t['error']; ?></span>
                                <?php } else { ?>
                                <div class="input-group">
                                    <input type="text" name="data[webpath_<?php echo $dir; ?>]" id="dr_html_dir_<?php echo $dir; ?>" value="<?php echo $data['webpath_'.$dir]; ?>" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn blue" onclick="dr_test_html_dir('dr_html_dir_<?php echo $dir; ?>')" type="button"><i class="fa fa-code"></i> <?php echo dr_lang('测试'); ?></button>
                                    </span>
                                </div>
                                <span class="help-block"><?php echo dr_lang('本模块的Web目录，必须填写一个有效的目录，并设置可写权限'); ?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <?php }  } } ?>

                    </div>
                </div>

                <div class="tab-pane " id="tab_3">
                    <div class="form-body form">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('域名检测结果'); ?></label>
                            <div class="col-md-9">
                                <div id="dr_domain" style="margin-top: 8px;">

                                </div>
                            </div>
                        </div>


                    </div>
                </iv>

            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>&page='+$('#dr_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
        </div>
    </div>
</form>

<script>
    function dr_check_domain() {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "<?php echo dr_url('api/domain'); ?>",
            data: $("#myform").serialize(),
            success: function(html) {
                $("#dr_domain").html(html);
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }

</script>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>