<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><?php echo dr_lang('仅限于本地存储的图片文件，此处设置针对远程图片无效'); ?></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-photo"></i> <?php echo dr_lang('水印设置'); ?> </a>
                </li>
                <li class="<?php if ($page==1) { ?>active<?php } ?>">
                    <a href="#tab_1" data-toggle="tab" onclick="$('#dr_page').val('1')"> <i class="fa fa-cog"></i> <?php echo dr_lang('策略设置'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">


                <div class="tab-pane <?php if ($page==1) { ?>active<?php } ?>" id="tab_1">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('图片大小限制'); ?></label>
                            <div class="col-md-9">
                                <label><input name="data[width]" value="<?php echo $data[width]; ?>" type="text" style="width: 70px" class="form-control" placeholder="<?php echo dr_lang('宽 px'); ?>"></label>
                                <label><input name="data[height]" value="<?php echo $data[height]; ?>" type="text" style="width: 70px" class="form-control" placeholder="<?php echo dr_lang('高 px'); ?>"></label>
                                <span class="help-block"><?php echo dr_lang('对超过设定值的图片附件加水印'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('百度编辑器水印'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[ueditor]" value="0" <?php if (empty($data['ueditor'])) { ?>checked<?php } ?> /> <?php echo dr_lang('按编辑器属性'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[ueditor]" value="1" <?php if ($data['ueditor']) { ?>checked<?php } ?> /> <?php echo dr_lang('全部水印'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印位置'); ?></label>
                            <div class="col-md-9">
                                <div class="btn-group fc-3x3" data-toggle="buttons">
                                    <?php if (is_array($locate)) { $count=count($locate);foreach ($locate as $i=>$t) { ?>
                                    <label class="btn btn-default  <?php if ($data['locate'] == $i) { ?> active<?php }  if (strpos($i, 'bottom')!==false) { ?> btn2<?php } ?>">
                                        <input type="radio" name="data[locate]" <?php if ($data['locate'] == $i) { ?>checked<?php } ?> value="<?php echo $i; ?>" class="toggle"> <?php echo dr_lang($t); ?>
                                    </label>
                                    <?php } } ?>
                                </div>
                                <span class="help-block"><?php echo dr_lang('选择水印在图片中的位置'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印类型'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" onclick="dr_type(0)" name="data[type]" value="0" <?php if (empty($data['type'])) { ?>checked<?php } ?> /> <?php echo dr_lang('图片'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" onclick="dr_type(1)" name="data[type]" value="1" <?php if ($data['type']) { ?>checked<?php } ?> /> <?php echo dr_lang('文字'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group dr_sy dr_sy_1">
                            <label class="col-md-2 control-label"><?php echo dr_lang('文字字体'); ?></label>
                            <div class="col-md-9">
                                <label><select class="form-control" name="data[wm_font_path]">
                                    <?php if (is_array($waterfont)) { $count=count($waterfont);foreach ($waterfont as $t) { ?>
                                    <option <?php if ($t==$data['wm_font_path']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                    <?php } } ?>
                                </select></label>
                                <span class="help-block"><?php echo dr_lang('自定义字体文件./config/font/'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_sy dr_sy_1">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印文字'); ?></label>
                            <div class="col-md-5">
                                <input name="data[wm_text]" value="<?php echo $data[wm_text]; ?>" type="text" class="form-control">
                                <span class="help-block"><?php echo dr_lang('如果为中文，先要font目录中添加中文字体'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_sy dr_sy_1">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印文字大小'); ?></label>
                            <div class="col-md-9">
                                <label><input name="data[wm_font_size]" value="<?php echo $data[wm_font_size]; ?>" type="text" class="form-control"></label>
                                <span class="help-block"><?php echo dr_lang('字体大小，单位px像素'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_sy dr_sy_1">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印文字颜色'); ?></label>
                            <div class="col-md-9" style="padding-top: 2px;">
                                <label><input type="hidden" id="hue-demo" data-control="hue" class="form-control demo" name="data[wm_font_color]" value="<?php echo $data[wm_font_color]; ?>"></label>
                            </div>
                        </div>

                        <div class="form-group dr_sy dr_sy_0">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印文件'); ?></label>
                            <div class="col-md-9">
                                <label><select class="form-control" name="data[wm_overlay_path]">
                                    <?php if (is_array($waterfile)) { $count=count($waterfile);foreach ($waterfile as $t) { ?>
                                    <option <?php if ($t==$data['wm_overlay_path']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
                                    <?php } } ?>
                                </select></label>
                                <span class="help-block"><?php echo dr_lang('自定义图片水印文件./config/watermark/'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_sy dr_sy_0">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印透明度'); ?></label>
                            <div class="col-md-5">
                                <input type="hidden" name="data[wm_opacity]" id="wm_opacity" value="<?php echo $data['wm_opacity']; ?>">
                                <div id="demo6_slider1" class="noUi-danger"></div>
                                <span id="demo6_slider1-span"></span>

                                <span class="help-block"><?php echo dr_lang('设置水印图标透明度，数值越大，图标越清晰'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印图片质量'); ?></label>
                            <div class="col-md-5">
                                <input type="hidden" name="data[quality]" id="quality" value="<?php echo $data['quality']; ?>">
                                <div id="demo6_slider2" class="noUi-success"></div>
                                <span id="demo6_slider2-span"></span>
                                <span class="help-block"><?php echo dr_lang('设置添加水印后的图片质量，数值越大，图片越清晰'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印图片内边距'); ?></label>
                            <div class="col-md-9">
                                <label><input name="data[wm_padding]" value="<?php echo $data[wm_padding]; ?>" type="text" class="form-control" placeholder="<?php echo dr_lang('px'); ?>"></label>
                                <span class="help-block"><?php echo dr_lang('内边距，以像素为单位，是水印与图片边缘之间的距离'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('水印图片偏移量'); ?></label>
                            <div class="col-md-9">
                                <label><input name="data[wm_hor_offset]" value="<?php echo $data[wm_hor_offset]; ?>" type="text" style="width: 120px" class="form-control" placeholder="<?php echo dr_lang('水平 px'); ?>"></label>
                                <label><input name="data[wm_vrt_offset]" value="<?php echo $data[wm_vrt_offset]; ?>" type="text" style="width: 120px" class="form-control" placeholder="<?php echo dr_lang('垂直 px'); ?>"></label>

                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>&page='+$('#dr_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
            <button type="button" onclick="dr_preview()" class="btn red"> <i class="fa fa-photo"></i> <?php echo dr_lang('预览'); ?></button>
        </div>
    </div>
</form>


<link href="<?php echo THEME_PATH; ?>assets/global/plugins/nouislider/nouislider.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo THEME_PATH; ?>assets/global/plugins/nouislider/nouislider.pips.css" rel="stylesheet" type="text/css" />
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/nouislider/wNumb.min.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/nouislider/nouislider.min.js" type="text/javascript"></script>

<link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo THEME_PATH; ?>assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" type="text/css" />
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
<script type="text/javascript">

function dr_type(v) {
    $('.dr_sy').hide();
    $('.dr_sy_'+v).show();
}
function dr_preview() {

    layer.open({
        type: 2,
        title: '<?php echo dr_lang('水印预览'); ?>',
        fix:true,
        scrollbar: false,
        shadeClose: true,
        shade: 0,
        area: ['50%', '50%'],
        success: function(layero, index){
            var body = layer.getChildFrame('body', index);
            $(body).attr("style", "text-align:center");
        },
        content: '<?php echo dr_url("api/preview"); ?>&'+$("#myform").serialize()+'&is_ajax=1'
    });
}

$(function(){


    $("#hue-demo").minicolors({
        control: $(this).attr('data-control') || 'hue',
        defaultValue: $(this).attr('data-defaultValue') || '',
        inline: $(this).attr('data-inline') === 'true',
        letterCase: $(this).attr('data-letterCase') || 'lowercase',
        opacity: $(this).attr('data-opacity'),
        position: $(this).attr('data-position') || 'bottom left',
        change: function(hex, opacity) {
            if (!hex) return;
            if (opacity) hex += ', ' + opacity;
            if (typeof console === 'object') {
                console.log(hex);
            }
        },
        theme: 'bootstrap'
    });


    dr_type(<?php echo intval($data['type']); ?>);
    // Store the locked state and slider values.
    var lockedState = false,
            lockedSlider = false,
            lockedValues = [60, 80],
            slider1 = document.getElementById('demo6_slider1'),
            slider2 = document.getElementById('demo6_slider2'),
            slider1Value = document.getElementById('demo6_slider1-span'),
            slider2Value = document.getElementById('demo6_slider2-span');

    // When the button is clicked, the locked
    // state is inverted.
    function crossUpdate ( value, slider ) {

        // If the sliders aren't interlocked, don't
        // cross-update.
        if ( !lockedState ) return;

        // Select whether to increase or decrease
        // the other slider value.
        var a = slider1 === slider ? 0 : 1, b = a ? 0 : 1;

        // Offset the slider value.
        value -= lockedValues[b] - lockedValues[a];

        // Set the value
        slider.noUiSlider.set();
    }

    noUiSlider.create(slider1, {
        start: <?php echo intval($data['wm_opacity']); ?>,

        // Disable animation on value-setting,
        // so the sliders respond immediately.
        animate: false,
        range: {
            min: 1,
            max: 100
        }
    });

    noUiSlider.create(slider2, {
        start: <?php echo intval($data['quality']); ?>,
        animate: false,
        range: {
            min: 1,
            max: 100
        }
    });

    slider1.noUiSlider.on('update', function( values, handle ){
        slider1Value.innerHTML = parseInt(values[handle]);
        $('#wm_opacity').val(parseInt(values[handle]));
    });

    slider2.noUiSlider.on('update', function( values, handle ){
        slider2Value.innerHTML = parseInt(values[handle]);
        $('#quality').val(parseInt(values[handle]));
    });

    function setLockedValues ( ) {
        lockedValues = [
            Number(slider1.noUiSlider.get()),
            Number(slider2.noUiSlider.get())
        ];
    }

    slider1.noUiSlider.on('change', setLockedValues);
    slider2.noUiSlider.on('change', setLockedValues);

    slider1.noUiSlider.on('slide', function( values, handle ){
        crossUpdate(values[handle], slider2);
    });

    slider2.noUiSlider.on('slide', function( values, handle ){
        crossUpdate(values[handle], slider1);
    });
});


</script>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>