<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-cn" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="zh-cn" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cn">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?php echo $meta_title; ?></title>
    <meta content="<?php echo $meta_keywords; ?>" name="keywords" />
    <meta content="<?php echo $meta_description; ?>" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <!-- 主要css开始 -->
    <link href="<?php echo THEME_PATH; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/components.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/common.css" rel="stylesheet" type="text/css" />
    <!-- 主要css结束 -->
    <!-- 风格css开始 -->
    <link href="<?php echo HOME_THEME_PATH; ?>web/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HOME_THEME_PATH; ?>web/css/default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo HOME_THEME_PATH; ?>web/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- 风格css结束 -->
    <!--[if lt IE 9]>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <!-- 系统关键js(所有自建模板必须引用) -->
    <script type="text/javascript">var assets_path = '<?php echo THEME_PATH; ?>assets/';var is_mobile_cms = '<?php echo \Phpcmf\Service::IS_MOBILE(); ?>';</script>
    <script src="<?php echo LANG_PATH; ?>lang.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/layer/layer.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/js/cms.js" type="text/javascript"></script>
    <!-- 系统关键js结束 -->
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="<?php echo HOME_THEME_PATH; ?>web/scripts/layout.js" type="text/javascript"></script>
    <?php if (in_array('store', [MOD_DIR, APP_DIR])) { ?>
    <!-- 加载商城模块css -->
    <link href="<?php echo HOME_THEME_PATH; ?>web/store/style.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo HOME_THEME_PATH; ?>web/store/js/mall.js"></script>
    <script src="<?php echo HOME_THEME_PATH; ?>web/store/js/jquery.counterup.min.js"></script>
    <script>
        $(function () {
            dr_cart_nums();
        });
    </script>
    <?php } ?>

</head>
<body class="page-container-bg-solid">
<div class="page-wrapper">

    <div class="page-wrapper-row" style="height: 180px;">
        <div class="page-wrapper-top">
            <div class="page-header">
                <div class="page-header-top-index">
                    <div class="container">
                        <div class="page-top-index-left">
                            <a href="<?php echo SITE_URL; ?>">网站首页</a> <span>|</span>
                            <a href="javascript:dr_pc_or_mobile('<?php echo FC_NOW_URL; ?>');">手机网站</a> <span>|</span>
                            <a href="<?php echo MEMBER_URL; ?>">用户中心</a>
                        </div>
                        <div class="page-top-index-right">
                            <?php if (dr_is_module('store')) { ?>
                            <a href="/index.php?s=store&c=cart">我的购物车（<b id="dr_cart_nums">0</b>）</a> <span>|</span>
                            <a href="/index.php?s=store&c=zhe">折扣商品</a> <span>|</span>
                            <?php } ?>
                            <a href="<?php echo MEMBER_URL; ?>">用户中心</a>
                        </div>
                    </div>
                </div>

                <div class="page-header-top">
                    <div class="container">

                        <div class="page-logo">
                            <a href="<?php echo SITE_URL; ?>">
                                <img src="<?php echo SITE_LOGO; ?>" alt="<?php echo SITE_NAME; ?>" class="logo-default">
                            </a>
                        </div>
                        <div class="page-header-module">
                            <?php if (defined('MOD_DIR') && !IS_SHARE) {  echo MODULE_NAME;  } ?>
                        </div>
                        <div class="page-header-search">
                            <form class="search-form" action="/index.php" method="get">
                                <input type="hidden" name="s" value="api">
                                <input type="hidden" name="c" value="api">
                                <input type="hidden" name="m" value="search">
                                <input type="hidden" name="dir" id="dr_search_module_dir" >
                                <div class="input-group">
                                    <div class="input-group-btn btn-group">
                                        <button id="dr_search_module_name" type="button" class="btn default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <!--这是来列出全部可以搜索的内容模块-->
                                            <?php $top_search=[]; ?>
                                            <?php $list_return = $this->list_tag("action=cache name=module-content"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                            <?php if ($t['search']) {  !$top_search && $top_search=$t; ?>
                                            <li><a href="javascript:dr_search_module_select('<?php echo $t['dirname']; ?>', '<?php echo $t['name']; ?>');"> <?php echo $t['name']; ?> </a></li>
                                            <?php } ?>
                                            <?php } } ?>
                                        </ul>
                                    </div>
                                    <input type="text" placeholder="搜索内容..." name="keyword" class="fc-search-keyword form-control">
                                    <div class="input-group-btn">
                                        <button class="btn default" type="submit"> <i class="fa fa-search"></i> </button>
                                    </div>
                                </div>
                                <script>
                                    // 这段js是用来执行搜索的
                                    function dr_search_module_select(dir, name) {
                                        $("#dr_search_module_dir").val(dir);
                                        $("#dr_search_module_name").html(name+' <i class="fa fa-angle-down"></i>');
                                    }
                                    dr_search_module_select('<?php echo defined('MOD_DIR') ? MOD_DIR : $top_search['dirname'] ?>', '<?php echo defined('MOD_DIR') ? MODULE_NAME : $top_search['name'] ?>');
                                </script>
                            </form>
                        </div>
                        <div class="page-header-member" id="dr_member_info">

                        </div>
                        <!-- 动态调用member.html模板的会员登录信息 -->
                        <?php echo dr_ajax_template('dr_member_info', 'member.html'); ?>
                    </div>
                </div>
                <div class="page-header-menu">
                    <div class="container">
                        <div class="hor-menu">
                            <ul class="nav navbar-nav">
                                <li id="dr_nav_0" class="menu-dropdown classic-menu-dropdown <?php if ($indexc) { ?>active<?php } ?>">
                                    <a href="<?php echo SITE_URL; ?>" title="<?php echo SITE_TITLE; ?>">首页</a>
                                </li>

                                <!--调用共享栏目-->
                                <!--第一层：调用pid=0表示顶级-->
                                <?php $list_return = $this->list_tag("action=category module=share pid=0"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                <li class="menu-dropdown classic-menu-dropdown <?php if (IS_SHARE && $catid && in_array($catid, $t['catids'])) { ?> active<?php } ?>">
                                    <a href="<?php echo $t['url']; ?>" title="<?php echo $t['name']; ?>" <?php if ($t['tid']==2) { ?> target="_blank"<?php } ?>><?php echo $t['name']; ?></a>
                                    <?php if ($t['child']) { ?>
                                    <ul class="dropdown-menu pull-left">
                                        <!--第二层：调用第二级共享栏目-->
                                        <?php $list_return_t2 = $this->list_tag("action=category module=share pid=$t[id]  return=t2"); if ($list_return_t2) extract($list_return_t2, EXTR_OVERWRITE); $count_t2=count($return_t2); if (is_array($return_t2)) { foreach ($return_t2 as $key_t2=>$t2) {  $is_first=$key_t2==0 ? 1 : 0;$is_last=$count_t2==$key_t2+1 ? 1 : 0; ?>
                                        <li class="<?php if ($t2['child']) { ?> dropdown-submenu<?php }  if (IS_SHARE && $catid && in_array($catid, $t2['catids'])) { ?> active<?php } ?>">
                                            <a href="<?php echo $t2['url']; ?>" class="nav-link nav-toggle " title="<?php echo $t2['name']; ?>">
                                                <?php echo $t2['name']; ?>
                                            </a>
                                            <?php if ($t2['child']) { ?>
                                            <ul class="dropdown-menu pull-left">
                                                <!--第三层：调用第三级共享栏目数据-->
                                                <?php $list_return_t3 = $this->list_tag("action=category module=share pid=$t2[id]  return=t3"); if ($list_return_t3) extract($list_return_t3, EXTR_OVERWRITE); $count_t3=count($return_t3); if (is_array($return_t3)) { foreach ($return_t3 as $key_t3=>$t3) {  $is_first=$key_t3==0 ? 1 : 0;$is_last=$count_t3==$key_t3+1 ? 1 : 0; ?>
                                                <li class="<?php if (IS_SHARE && $catid && in_array($catid, $t3['catids'])) { ?> active<?php } ?>">
                                                    <a href="<?php echo $t3['url']; ?>" title="<?php echo $t3['name']; ?>">
                                                        <?php echo $t3['name']; ?>
                                                    </a>
                                                </li>
                                                <?php } } ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                    <?php } ?>
                                </li>
                                <?php } } ?>



                                <!--调用全部独立模块-->
								<?php $list_return_m = $this->list_tag("action=cache name=module-content  return=m"); if ($list_return_m) extract($list_return_m, EXTR_OVERWRITE); $count_m=count($return_m); if (is_array($return_m)) { foreach ($return_m as $key_m=>$m) {  $is_first=$key_m==0 ? 1 : 0;$is_last=$count_m==$key_m+1 ? 1 : 0; ?>
                                <?php if (!$m['share']) { ?>
                                <li class="menu-dropdown classic-menu-dropdown <?php if (MOD_DIR==$m['dirname']) { ?>active<?php } ?>">
                                    <a href="<?php echo $m['url']; ?>"><?php echo $m['name']; ?></a>
                                    <ul class="dropdown-menu pull-left">
                                        <!--第一层：调用独立模块下的顶级栏目-->
                                        <?php $list_return_t2 = $this->list_tag("action=category module=$m[dirname] pid=0  return=t2"); if ($list_return_t2) extract($list_return_t2, EXTR_OVERWRITE); $count_t2=count($return_t2); if (is_array($return_t2)) { foreach ($return_t2 as $key_t2=>$t2) {  $is_first=$key_t2==0 ? 1 : 0;$is_last=$count_t2==$key_t2+1 ? 1 : 0; ?>
                                        <li class="<?php if ($t2['child']) { ?> dropdown-submenu<?php }  if (MOD_DIR==$m['dirname'] && $catid && in_array($catid, $t2['catids'])) { ?> active<?php } ?>">
                                            <a href="<?php echo $t2['url']; ?>" class="nav-link nav-toggle " title="<?php echo $t2['name']; ?>">
                                                <?php echo $t2['name']; ?>
                                            </a>
                                            <?php if ($t2['child']) { ?>
                                            <ul class="dropdown-menu pull-left">
                                                <!--第二层：调用第二级栏目-->
                                                <?php $list_return_t3 = $this->list_tag("action=category module=$m[dirname] pid=$t2[id]  return=t3"); if ($list_return_t3) extract($list_return_t3, EXTR_OVERWRITE); $count_t3=count($return_t3); if (is_array($return_t3)) { foreach ($return_t3 as $key_t3=>$t3) {  $is_first=$key_t3==0 ? 1 : 0;$is_last=$count_t3==$key_t3+1 ? 1 : 0; ?>
                                                <li class="<?php if (MOD_DIR==$m['dirname'] && $catid && in_array($catid, $t3['catids'])) { ?> active<?php } ?>">
                                                    <a href="<?php echo $t3['url']; ?>" title="<?php echo $t3['name']; ?>">
                                                        <?php echo $t3['name']; ?>
                                                    </a>
                                                </li>
                                                <?php } } ?>
                                            </ul>
                                            <?php } ?>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                </li>
								<?php } ?>
								<?php } } ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>