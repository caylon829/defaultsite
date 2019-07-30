<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
 echo"<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<title><?php echo "{$typename}"; ?>最新章节_<?php echo "{$zuozhe}"; ?>新书作品_<?php echo $cfg_webname; ?></title>
<meta name="keywords" content="<?php echo "{$typename}"; ?>,<?php echo "{$typename}"; ?>在线阅读,<?php echo "{$typename}"; ?>最新章节,<?php echo "{$typename}"; ?>5200,<?php echo "{$typename}"; ?>txt下载,<?php echo $cfg_webname; ?>" />
<meta name="description" content="<?php echo $cfg_webname; ?>提供<?php echo $zuozhe; ?>新书作品_<?php echo "{$typename}"; ?>最新章节全文免费在线阅读，<?php echo "{$typename}"; ?>txt电子书免费下载。最快更新<?php echo "{$typename}"; ?>，来自<?php echo "{$typename}"; ?>" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />
<meta name="format-detection" content="telephone=no" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="/css/h_wap.css" media="all" />
</head>
<body class="cover">
<?php include($cfg_templets_dir."/wap/head.htm"); ?>
<div class="channel">
	<?php echo $channellist; ?>
</div>
<form name="From" method="post" action="/wap.php?action=search<?php echo $wxuid; ?>" class="search-form">
	<input type="hidden" name="objectType" value="2" />
	<table>
		<tr>
			<td><input type="text" name="wd" class="text-border vm" value="" /></td>
			<td width="8"></td>
			<td width="70"><input type="submit" class="btn btn-auto btn-blue vm" value="搜索" /></td>
		</tr>
	</table>
</form>
<div class="container">
	<div class="mod mod-back breadcrumb">
		<div class="bd">
			<a href="/" class="home"></a>
			<span class="divide"></span>
			<a href="/wap.php?action=list&type=top&id=<?php echo $reid.$wxuid; ?>"><?php echo str_replace("小说","",str_replace("·","",$retypename)); ?>小说</a>
			<span class="divide"></span>
			<a href="/wap.php?action=list&id=<?php echo $id.$wxuid; ?>"><?php echo "{$typename}"; ?>章节目录</a>
		</div>
	</div>
	<div class="mod detail">
		<div class="bd column-2">
			<div class="left">
				<img src="<?php echo $typeimg; ?>" width="90" alt="<?php echo $typename; ?>" />
			</div>
			<div class="right">
				<h1><?php echo $typename; ?></h1>
				<p class="info">
					作者：<?php echo $zuozhe; ?><br />
					类型：<?php echo str_replace("·","",$retypename); ?><br />
					字数：<?php echo $booksize; ?><br />
					人气：<?php echo $bookclick; ?>
				</p>
				<p></p>
				<span class="status is-serialize"><?php if($overdate=='0') echo "连载中••"; else echo "已完结";?></span>
			</div>
		</div>
		<div class="ft">
			<table>
				<tr>
					<td width="50%">
						<a class="read start" href="/wap.php?action=article&id=0&tid=<?php echo $id.$wxuid; ?>">从头开始阅读</a>
					</td>
					<td width="5">&nbsp;</td>
					<td width="50%">
						<a class="collect" href="/download/download.php?filetype=txt&filename=<?php echo $id.$wxuid; ?>"><?php echo $typename; ?>txt下载</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php if($pageno<2){ echo '
	<div class="mod book-intro">
		<div class="bd">
			'.$description.'
		</div>
	</div>
	<div class="slide-ad"><!--广告--></div>
	<div class="mod block update chapter-list">
		<div class="hd">
			<h4>'.$typename.'最新章节</h4>
		</div>
		<div class="bd">
			<ul class="list">
				'.$channellistnext.'
			</ul>
		</div>
	</div>';} ?>
	<div class="slide-ad"><!--广告--></div>
	<div class="mod block update chapter-list">
		<div class="hd">
			<h4><?php echo $typename; ?>章节列表</h4>
		</div>
		<div class="bd">
			<ul class="list">
			<?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{

			if(preg_match('#^gb#i',$cfg_soft_lang)) $fields['title'] = gb2utf8($fields['title']);
			?>
			<li><a href="/wap.php?action=article&id=<?php echo $fields['id'].$wxuid; ?>"><?php echo ConvertStr($fields['title']); ?></a></li>
			<?php
}
}?>
			</ul>
		</div>
	</div>
	<div class="slide-ad"><!--广告--></div>
	<div class="mod page">
	<?php
$atts = array();
$atts['tagname'] = 'pagelist';
$atts['listsize'] = '1';
$atts['listitem'] = 'index pre pageno next end select';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>

	</div>
	<div class="mod block column-list">
		<div class="hd" boxid="heiyanMobileChapterJingpin">
			<h4>类似<?php echo "{$typename}"; ?>的小说推荐</h4>
		</div>
		<div class="bd">
			<?php echo $leishi; ?>
		</div>
	</div>
	<div class="mod mod-back">
		<div class="bd">
			<a href="/" class="home"></a>
			<span class="divide"></span>
			<a href="/wap.php?action=list&type=top&id=<?php echo $reid.$wxuid; ?>"><?php echo str_replace("小说","",str_replace("·","",$retypename)); ?>小说</a>
			<span class="divide"></span>
			<a href="/wap.php?action=list&id=<?php echo $id.$wxuid; ?>"><?php echo "{$typename}"; ?>最新章节</a>
		</div>
	</div>
</div>
<?php include($cfg_templets_dir."/wap/footer.htm"); ?>
<!--[if IE]>
<link href="" rel="stylesheet" type="text/css" />
<![endif]-->
</body>
</html>