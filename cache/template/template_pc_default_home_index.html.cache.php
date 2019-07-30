<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-head">
            <div class="container">
                <div class="page-title">
                    欢迎使用迅睿CMS建站程序
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                <div class="page-content-inner">



                    <div class="row">
                        <div class="col-md-4">
                            <div class="bg-white">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- 幻灯图片 -->
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <a href="http://www.xunruicms.com" target="_blank"><img src="<?php echo HOME_THEME_PATH; ?>web/ad/1.jpg" style="width:360px;height:245px" /></a>
                                        </div>
                                        <div class="item ">
                                            <a href="http://www.xunruicms.com" target="_blank"><img src="<?php echo HOME_THEME_PATH; ?>web/ad/2.jpg" style="width:360px;height:245px" /></a>
                                        </div>
                                    </div>
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="portlet light" style="height: 245px;">
                                <div class="portlet-title ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><a href="http://www.xunruicms.com" target="_blank" class="title">迅睿CMS基于CI4框架开发的PHP7建站程序</a></h4>

                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <!--调用新闻模块的最新7条-->
                                                <?php $list_return = $this->list_tag("action=module module=news order=updatetime num=7"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                <li style="line-height: 23px"><span class="badge badge-empty badge-success"></span>&nbsp;<a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 20); ?></a></li>
                                                <?php } } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="list-unstyled">
                                                <!--调用新闻模块的最新从7开始数的7条-->
                                                <?php $list_return = $this->list_tag("action=module module=news order=updatetime num=7,7"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                <li style="line-height: 23px"><span class="badge badge-empty badge-success"></span>&nbsp;<a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 20); ?></a></li>
                                                <?php } } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- 调用新闻模块 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject bold uppercase font-green"> 新闻模块</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled fc-list-row">
                                                        <!-- 调用新闻模块的最新10条数据 -->
                                                        <?php $list_return = $this->list_tag("action=module module=news order=updatetime num=9"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                        <li><span class="badge badge-empty badge-success"></span>&nbsp;<a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 20); ?></a></li>
                                                        <?php } } ?>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled fc-list-row">
                                                        <!-- 调用新闻模块浏览量最高的数据 -->
                                                        <?php $list_return = $this->list_tag("action=module module=news order=hits num=9"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                        <li><span class="badge badge-empty badge-success"></span>&nbsp;<a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 20); ?></a></li>
                                                        <?php } } ?>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                <!-- 调用新闻模块带“图片”的数据 -->
                                                <?php $list_return = $this->list_tag("action=module thumb=1 module=news order=updatetime num=6"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                <div class="col-sm-4 fc-list-image">
                                                    <div class="tile-container">
                                                        <div class="tile-thumbnail">
                                                            <a href="<?php echo $t['url']; ?>" ><img src="<?php echo dr_thumb($t['thumb'], 120, 75); ?>" height="75"></a>
                                                        </div>
                                                        <div class="tile-title">
                                                            <h5><a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 7); ?></a></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 调用图片模块 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject bold uppercase font-green">图片模块</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <!-- 最新数据 -->
                                        <?php $list_return = $this->list_tag("action=module module=photo order=updatetime num=8"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                        <div class="col-sm-3">
                                            <div class="tile-container">
                                                <div class="tile-thumbnail">
                                                    <a href="<?php echo $t['url']; ?>" ><img src="<?php echo dr_thumb($t['thumb'], 250, 200); ?>" width="250" height="200"></a>

                                                </div>
                                                <div class="tile-title text-center">
                                                    <h5><a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 15); ?></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- 调用下载模块 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject bold uppercase font-green">下载模块</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <!-- 最新数据 -->
                                        <?php $list_return = $this->list_tag("action=module module=down order=updatetime num=8"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                        <div class="col-sm-3">
                                            <div class="tile-container">
                                                <div class="tile-thumbnail">
                                                    <a href="<?php echo $t['url']; ?>" ><img src="<?php echo dr_thumb($t['thumb'], 250, 200); ?>" width="250" height="200"></a>

                                                </div>
                                                <div class="tile-title text-center">
                                                    <h5><a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 15); ?></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } ?>
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

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>