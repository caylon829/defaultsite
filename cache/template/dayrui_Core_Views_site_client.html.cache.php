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
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-cog"></i> <?php echo dr_lang('网站终端'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">

                        <div class="form-group">
                            <div class="col-md-3 text-right">
                                <label><input class="form-control " type="text" readonly value="pc"></label>
                            </div>
                            <div class="col-md-7">
                                <label><input class="form-control input-large" readonly type="text" value="<?php echo $pc_domain; ?>"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 text-right">
                                <label><input class="form-control " type="text" readonly value="mobile"></label>
                            </div>
                            <div class="col-md-7">
                                <label><input class="form-control input-large" readonly type="text" value="<?php echo $mobile_domain; ?>"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3 text-right">
                                <a href="javascript:add_menu();" class="btn green"><i class="fa fa-plus"></i> <?php echo dr_lang('创建终端'); ?></a>
                            </div>
                            <div class="col-md-7">
                                <label></label>
                            </div>
                        </div>
                        <div id="menu_body">
                            <?php if (is_array($data)) { $count=count($data);foreach ($data as $t) { ?>
                            <div class="form-group">
                                <div class="col-md-3 text-right">
                                    <label><input class="form-control " type="text" name="data[][name]" placeholder="<?php echo dr_lang('终端目录'); ?>" value="<?php echo $t['name']; ?>"></label>
                                </div>
                                <div class="col-md-7">
                                    <label><input class="form-control input-large" type="text" name="data[][domain]" value="<?php echo $t['domain']; ?>" placeholder="<?php echo dr_lang('终端域名'); ?>"></label>
                                    <label><a href="javascript:;" onClick="remove_menu(this)" class="btn red"><i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></a></label>
                                </div>
                            </div>
                            <?php } } ?>
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

<script type="text/javascript">
    function add_menu() {
       var data = '<div class="form-group"><div class="col-md-3 text-right"><label><input class="form-control " type="text" name="data[][name]" placeholder="<?php echo dr_lang('终端目录'); ?>" value=""></label></div><div class="col-md-7"><label><input class="form-control input-large" type="text" name="data[][domain]" placeholder="<?php echo dr_lang('终端域名'); ?>"></label><label>&nbsp;<a href="javascript:;" onClick="remove_menu(this)" class="btn red"><i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></a></label></div></div>';
        $('#menu_body').append(data);
    }
    function remove_menu(_this) {
        $(_this).parent().parent().parent().remove()
    }
</script>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>