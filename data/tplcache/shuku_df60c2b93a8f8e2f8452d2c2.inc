<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ÿ���<? echo $typename; ?>С˵��ȫ_�ÿ���<? echo $typename; ?>С˵�Ƽ�_<?php echo $GLOBALS['cfg_webname']; ?></title>
<meta name="keywords" content="<? echo str_replace('��','',$typename); ?>С˵,<? echo str_replace('��','',$typename); ?>С˵���,<?php echo $GLOBALS['cfg_webname']; ?>" />
<meta name="description" content="<? echo $typename; ?>С˵��⣬������ÿ���<? echo $typename; ?>С˵����<?php echo $GLOBALS['cfg_webname']; ?>" />
<link rel="stylesheet" type="text/css" href="/css/basic.css" />
<link rel="stylesheet" type="text/css" href="/css/body_inner.css" />
</head><body class="bodyph">
<!--header��ʼ-->
<div class="Layout topbox">
  <div class="topbar">
    <div class="mainbox">
      <div class="left_con">
        <ul>
          <li><a href="<?php echo $GLOBALS['cfg_basehost']; ?>/" title="<?php echo $GLOBALS['cfg_webname']; ?>"><?php echo $GLOBALS['cgf_top_left']; ?></a></li>
          <li><em class="ver">|</em><a href="<?php echo $GLOBALS['cfg_wapurl']; ?>" class="name" style="color:#F00; text-decoration:underline" title="���ֻ����Ķ�" target="_blank">�ֻ���</a></li><li><em class="ver">|</em><a href="/over.html" class="name" style="color:#F00;" title="�걾С˵" target="_blank">�걾С˵</a></li><li><em class="ver">|</em><a href="/txt.html" class="name" style="color:#F00;" title="С˵����" target="_blank">С˵����</a></li>
        </ul>
      </div>
      <div class="right_con">
        <ul class="UL">
          <li><?php echo $GLOBALS['cgf_top_right']; ?></li>
          <li><em class="ver">|</em><a href="javascript:" title="�����ղؼ�" onclick="addBookmark('<?php echo $GLOBALS['cgf_top_left']; ?>','<?php echo $GLOBALS['cfg_basehost']; ?>')">�ղر�վ</a></li>
        </ul>
        <ul class="fUL">
          <li><a href="/" title="������ҳ">������ҳ</a></li>
			<? echo $channellist1; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="Layout h">
  <div class="header">
    <div class="top">
      <div class="logo"><a href="/" title="<?php echo $GLOBALS['cfg_webname']; ?>"><img src="/images/logo.png" alt="<?php echo $GLOBALS['cfg_webname']; ?>" /></a></div>
      <div class="c_con">
      </div>
      <div class="s_box">
        <form name="searchform" id="searchform" method="get" target="_blank" action="/plus/search.php">		
			<input type="hidden" name="kwtype" value="0" />
			<input type="hidden" name="searchtype" value="" />
			<input name="q" id="searchword" type="text" maxlength="18" />
			<input type="submit" value="����" id="s_btn" />
        </form>
      </div>
    </div>
    <div class="nav">
      <div class="box"> <a href="<?php echo $GLOBALS['cfg_basehost']; ?>" class="home" title="<?php echo $GLOBALS['cfg_webname']; ?>"><?php echo $GLOBALS['cfg_webname']; ?></a>
		<? echo $channellist2; ?>
		</div>
    </div>
  </div>
</div>
<!--header����-->
<div class="clear"></div>
<!--body��ʼ-->
<div class="Layout local">��ǰλ�ã�<a href="<?php echo $GLOBALS['cfg_basehost']; ?>"><?php echo $GLOBALS['cfg_webname']; ?></a>&nbsp;>&nbsp;<a href="/shuku.html">С˵���</a></div>
<div class="clear"></div>
<div class="Layout m_list list">
  <div class="Head">
    <h2><? echo $typename; ?>С˵�б�</h2><span class="j"></span>
    <div class="morelist">
      <div class="more"><a href="<? echo $overurl; ?>" style="color:#F00;font-weight: 800; text-decoration:underline" title="ֻ���걾С˵">ֻ���걾&nbsp;>></a></div>
      <ul>
		<li>����<b><? echo $scount; ?></b>����</li>&nbsp;
		<li><a href="/shuku.html" style="color:#AA0; text-decoration:underline;font-weight: 800" title="�鿴ȫ��С˵">�鿴ȫ��С˵</a></li>&nbsp;>&nbsp;
		<? echo $channellist3; ?>
      </ul>
    </div>
  </div>
  <div class="Con">
    <div class="Left">
      <div class="m_head"> <span class="c">����</span> <span class="t">����/�½�</span> <span class="w">����</span> <span class="a">����</span><span class="z">״̬</span></div>
      <ul class="ul_m_list">
		<?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?>
        <li<? ++$i;if($i%2!=1) echo " class='odd'"  ?>>
          <div class="c">[<a href="<?php echo $fields['retypedir']; ?>.html" title="<?php echo str_replace("��","",$fields['retypename']); ?>С˵" target="_blank"><?php echo str_replace("��","",$fields['retypename']); ?></a>]</div>
          <div class="title">
            <div class="t"><a href="<?php echo $fields['typedir']; ?>/" title="<?php echo $fields['typename']; ?>" target="_blank"><?php echo $fields['typename']; ?></a></div>
            <div class="n">[<a href="/txt<?php echo $fields['typedir']; ?>.html" title="<?php echo $fields['typename']; ?>txt����" target="_blank">����</a>] <a href="<?php echo $fields['typedir']; ?>/<?php echo zhangjie($fields['id']); ?></a> </div>
          </div>
          <div class="words"><?php echo $fields['booksize']; ?></div>
          <div class="author"><a href="<?php echo $fields['zuozhedir']; ?>.html" title="<?php echo $fields['zuozhe']; ?>��Ʒ" target="_blank"><?php echo $fields['zuozhe']; ?></a></div>
          <div class="abover"><span><?php echo zhuangtai($fields['overdate']); ?></span></div>
        </li>
		<?php
}
}?>
      </ul>
      <div class="bot_more">
        <div class="page_info">ÿҳ��ʾ<b>&nbsp;50&nbsp;</b>������<b><? echo $scount; ?></b>��</div>
        <div class="page_num">
          <div><a class="info">��<b><? echo $pageno; ?></b>ҳ/��<? echo $topage; ?>ҳ</a><a href="<? echo $pagestart; ?>" title="��һҳ">��һҳ</a><a href="<? echo $pagepre; ?>" title="��һҳ">��һҳ</a></div><div><a href="<? echo $pagenext; ?>" title="��һҳ">��һҳ</a><a href="<? echo $pageend; ?>" title="���һҳ">���һҳ</a></div>
        </div>
      </div>
    </div>
    <div class="Right">
		<div class="r_box cn">
			<div class="head"><h2>С˵�����Ƽ�</h2></div>
			<ul>
				<?php
global $dsql ;
				$dsql->safeCheck = false;
				$n=1;
				$query = "SELECT COUNT(a.id) AS ano,a.zuozhe AS zuozhe,b.typeimg,b.description,b.typedir,b.tuijian,SUM(a.bookclick) AS bookclick,SUM(a.booksize) AS booksize,SUM(a.tuijian) AS booktuijian FROM dede_arctype b JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `dede_arctype`)-(SELECT MIN(id) FROM `dede_arctype`))+(SELECT MIN(id) FROM `dede_arctype`)) AS id) AS t2 LEFT JOIN dede_arctype a ON(a.zuozhe=b.typename) WHERE b.reid=45 AND b.id>t2.id GROUP BY b.typename order by booktuijian desc limit 10";
				$dsql->SetQuery($query);
				$dsql->Execute();
				while($row=$dsql->GetArray()){
					if($n==1)
					{
						$zuozhe=$row['zuozhe'];
						$newbook = $dsql->GetOne("SELECT typename,typedir FROM dede_arctype where zuozhe='$zuozhe' order by overdate");
						$newbookname = $newbook['typename'];
						$newbooktypeidr = $newbook['typedir'];
						echo "<li><a href='".$row['typedir'].".html' title='".$row['zuozhe']."��Ʒ��' target='_blank'>".$row['zuozhe']."</a><span>".$row['ano']."/".$row['booksize']."</span></li><li class='first_con'><div class='pic'><a href='".$row['typedir'].".html' title='".$row['zuozhe']."��Ʒ��' target='_blank'><img class='lazy' src='".$row['typeimg']."' alt='".$row['zuozhe']."' /></a></div>
						<div class='a_l'>
						  <div><span>��Ʒ��:</span>".$row['ano']."</div>
						  <div><span>������:</span>".$row['booksize']."</div>
						  <div><span>�ܵ��:</span>".$row['bookclick']."</div>
						  <div><span>�����Ƽ�:</span>".$row['tuijian']."</div>
						  <div><span>��Ʒ�Ƽ�:</span>".$row['booktuijian']."</div>
						  <div><span>����:</span><a href='".$newbooktypeidr."/' title='".$newbookname."' target='_blank'>".$newbookname."</a></div>
						</div>
					</li>";
					}
					else
					{
						echo "<li><a href='".$row['typedir'].".html' title='".$row['zuozhe']."��Ʒ��' target='_blank'>".$row['zuozhe']."</a><span>".$row['ano']."/".$row['booksize']."</span></li>";
					}
					$n++;
				}
?>
		
			</ul>
		</div><div class="r_box cmztj cn">
        <div class="head"><h2>���������Ƽ�</h2></div>
        <ul>
          <?php
global $dsql ;
				$n=1;
				$query = "SELECT a.typeimg,a.typename,a.description,a.typedir,a.bookclick,a.tuijian,a.zuozhe,b.typedir as zuozhedir,c.typename as retypename,c.typedir as retypedir FROM dede_arctype a left join dede_arctype b on(b.typename=a.zuozhe and b.reid=45) left join dede_arctype c on(c.id=a.reid) WHERE a.reid<>45 and a.reid<>0 and a.booksize<300000 order by a.bookclick+a.tuijian desc limit 0,10";
				$dsql->SetQuery($query);
				$dsql->Execute();
				while($row=$dsql->GetArray()){
					$bt=$row['bookclick']+$row['tuijian'];
					if($n==1)
					{
						echo "<li><a href='".$row['typedir']."/' title='".$row['typename']."' target='_blank'>".$row['typename']."</a><span>".$bt."</span></li><li class='first_con'><div class='pic'><a href='".$row['typedir']."/' title='".$row['typename']."' target='_blank'><img class='lazy' src='".$row['typeimg']."' alt='".$row['typename']."' /></a></div>
						<div class='a_l'>
						  <div><span>����:</span><a href='".$row['zuozhedir'].".html' title='".$row['zuozhe']."С˵��Ʒ' target='_blank'>".$row['zuozhe']."</a></div>
						  <div><span>����:</span><a href='".$row['retypedir'].".html' title='".$row['retypename']."С˵' target='_blank'>".$row['retypename']."</a></div>
						  <div><span>��/��:</span>".$row['bookclick']."/".$row['tuijian']."</div>
						</div>
					<div class='info'><p><a href='".$row['typedir']."/' target='_blank'>��飺".cn_substr(html2text($row['description']),50)."����</a></p>
					</div>
				</li>";
					}
					else
					{
						echo "<li><a href='".$row['typedir']."/' title='".$row['retypename']."С˵-".$row['typename']."�����ߣ�".$row['zuozhe']."' target='_blank'>".$row['typename']."</a><span>".$bt."</span></li>";
					}
					$n++;
				}
?>
           </ul>
      </div>
      <div class="r_box rmwbtj cn">
        <div class="head">
          <h2>�����걾�Ƽ�</h2>
        </div>
        <ul>
        <?php
global $dsql ;
				$n=1;
				$query = "SELECT a.typeimg,a.typename,a.description,a.typedir,a.bookclick,a.tuijian,a.zuozhe,b.typedir as zuozhedir,c.typename as retypename,c.typedir as retypedir FROM dede_arctype a left join dede_arctype b on(b.typename=a.zuozhe and b.reid=45) left join dede_arctype c on(c.id=a.reid) WHERE a.reid not in(0,45) and a.overdate<>'0' order by a.bookclick+a.tuijian desc limit 0,10";
				$dsql->SetQuery($query);
				$dsql->Execute();
				while($row=$dsql->GetArray()){
					$bt=$row['bookclick']+$row['tuijian'];
					if($n==1)
					{
						echo "<li><a href='".$row['typedir']."/' title='".$row['typename']."' target='_blank'>".$row['typename']."</a><span>".$bt."</span></li><li class='first_con'><div class='pic'><a href='".$row['typedir']."/' title='".$row['typename']."' target='_blank'><img class='lazy' src='".$row['typeimg']."' alt='".$row['typename']."' /></a></div>
						<div class='a_l'>
						  <div><span>����:</span><a href='".$row['zuozhedir'].".html' title='".$row['zuozhe']."С˵��Ʒ' target='_blank'>".$row['zuozhe']."</a></div>
						  <div><span>����:</span><a href='".$row['retypedir'].".html' title='".$row['retypename']."С˵' target='_blank'>".$row['retypename']."</a></div>
						  <div><span>��/��:</span>".$row['bookclick']."/".$row['tuijian']."</div>
						</div>
					<div class='info'><p><a href='".$row['typedir']."/' target='_blank'>��飺".cn_substr(html2text($row['description']),50)."����</a></p>
					</div>
				</li>";
					}
					else
					{
						echo "<li><a href='".$row['typedir']."/' title='".$row['retypename']."С˵-".$row['typename']."�����ߣ�".$row['zuozhe']."' target='_blank'>".$row['typename']."</a><span>".$bt."</span></li>";
					}
					$n++;
				}
?>
		</ul>
      </div>
      <div class="r_box ad ad200"><!--ad-->
      </div>
    </div>
  </div>
</div>
<!--body����-->
<div class="clear"></div>
<!--footer��ʼ-->
<div class="Layout ft">
  <div class="center">
    <div class="bot_logo"><a href="/" title="��������"><img src="/images/bot_logo.png" alt="��������" /></a></div>
    <div class="link">
      <div class="z"><?php
$atts = array();
$atts['tagname'] = 'flink';
$atts['typeid'] = '1';
$blockValue = MakePublicTag($atts,$this->refObj,$fields); 
if(is_array($blockValue) && count($blockValue) > 0){
foreach( $blockValue as $key=>$fields )
{

}
}
?></div>
      <div class="f"><span>��Ȩ������<?php echo $GLOBALS['novel_powerby']; ?></span></div>
    </div>
  </div>
</div>
<div class="floatBox">
  <ul class="fbox">
    <li class="fli udLI"><a class="fbtn UD">���ض���</a></li>
  </ul>
</div>
<div class="TIP"></div>
<div class="MAK"></div>
<!--footer����-->
<div style="display:none;">
  <script type="text/javascript" src="/js/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="/js/jquery.lazyload.min.js"></script>
  <script type="text/javascript">
  var cmsUrl="/";
  $("img.lazy").show().lazyload({placeholder:"/images/loading.gif",loading:true,threshold:200,failure_limit:10,skip_invisible:false,effect:"fadeIn"});
  function btnin(){$("#info").css("display","block")};function btnout(){$("#info").css("display","none")};
  window.onscroll=function(){var top = (document.documentElement.scrollTop || document.body.scrollTop);if (top>170){$(".topbox").addClass("topFLOAT");$(".UD").fadeIn();}else{$(".topbox").removeClass("topFLOAT");$(".UD").fadeOut();}};
  $(".UD").click(function(){$("html,body").animate({scrollTop:0});});
  $(".fli").hover(function(){$(this).addClass("on");},function(){$(this).removeClass("on");});
  $(".tab .head a").hover(function(){$(this).siblings().removeClass("active");$(this).addClass("active");$(".tab .box").hide();var showBOX=$(this).attr("showBOX");$("."+showBOX).show();});
  $(".t_btn a").hover(function(){$(".t_btn a").removeClass("active");$(this).addClass("active");var ul_class=$(this).attr("name");$(".r_box.djb ul").css("display","none");$(".r_box.djb ul"+"."+ul_class).css("display","block");});
  function addBookmark(title,url) {
  if(!title){title =document.title};
  if(!url){url=window.location.href}
  try{  
		  window.external.AddFavorite(url,title);  
	  }catch(e){  
		  try{  
			  window.sidebar.addPanel(title,url,"");  
		  }catch(e){  
			  alert("360��������������֧���Զ������ղؼб�ǩ���رձ��Ի��������ʹ�ÿ�ݼ� Ctrl+D �������ӡ�");  
		  }
	}
}
  </script>
  <script type="text/javascript" src="/js/xmlJS.js"></script>
  <?php
$atts = array();
$atts['tagname'] = 'myad';
$atts['name'] = 'tongji';
$blockValue = MakePublicTag($atts,$this->refObj,$fields); 
if(is_array($blockValue) && count($blockValue) > 0){
foreach( $blockValue as $key=>$fields )
{

}
}
?>
</div>
</body></html>