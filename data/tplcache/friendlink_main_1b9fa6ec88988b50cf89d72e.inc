<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>�������ӹ���</title>
<link href="img/base.css" rel="stylesheet" type="text/css" />
<link href="css/base.css" rel="stylesheet" type='text/css'>
<script language='javascript' src='../images/js/j.js'></script>
<script language='javascript'>
function Sel(stype)
{
	  for(var i=0;i < document.getElementsByName('aids').length;i++)
	  {
		  if(stype=='all') document.getElementsByName('aids')[i].checked=true;
		  else document.getElementsByName('aids')[i].checked=false;
	  }
}
function checkSubmit()
{
	var str = '';
	for(var i=0;i < document.getElementsByName('aids').length;i++)
	{
		  if(document.getElementsByName('aids')[i].checked){
		  	if(str=='') str += document.getElementsByName('aids')[i].value;
		  	else str += ',' + document.getElementsByName('aids')[i].value;
		  }
	}
	if(str=='')
	{
		alert('��ûѡ���κ����ݣ�');
		return false;
	}
	else
	{
		location="friendlink_edit.php?aids="+str+"&dopost=delall";
	}
}
</script>
</head>
<body background='images/allbg.gif' leftmargin='8' topmargin='8'>

<table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#D6D6D6">
  <tr>
    <td height="28" background="images/tbg.gif" colspan="11" style="padding-left:10px;" bgcolor="#EDF9D5">
  <div style="float:left">
  	<b>�������ӹ���</b>
	</div>
	<div style="float:right;padding-right:6px;">
		[<a href="friendlink_add.php"><u>��������</u></a>]
 	 	[<a href="friendlink_type.php"><u>��վ���͹���</u></a>]
  	[<a href='<?php echo $GLOBALS['cfg_phpurl']; ?>/flink.php' target='_blank'><u>��������Ԥ��</u></a>]
  </div>
  </td>
</tr>
<tr>
   <td height="30" align="center" bgcolor="#F9FCEF"  colspan="11"> 
   <div style="float:left; color:red;" class="msg"></div>
<form action="friendlink_main.php" name="form1" method="get">
<div style="padding:5px 20px; float:right;">
<a href="javascript:fcheck();" class="np coolbg" style="color:red;">�������Ӽ��</a>
<a href="http://check.links.cn/checklink.asp?checkbaiducount=1&checkbaidurank=1&checkpr=1&checkbacklink=1&checkbaiducachetime=1&weburl=<?php echo $cfg_basehost; ?>" class="np coolbg" style="color:red;" target="_blank">
���������</a>
<a href="http://linkche.aizhan.com/?url=<?php echo $cfg_basehost; ?>" class="np coolbg" style="color:red;" target="_blank">��վ�����</a>
</div>
<table border="0" cellspacing="0" cellpadding="3">
	<tr>
          <td>�ؼ��֣�</td>
          <td><input name="keyword" type="text" id="keyword" size="12" style="width:250px" value="<?php echo $keyword; ?>" /></td>
          <td>
          	<select name="ischeck" id="ischeck">
        			<?php
        			foreach($selCheckArr as $k=>$v)
        			{
        				if($k==$ischeck) echo "<option value='$k' selected>$v</option>\r\n";
        				else echo "<option value='$k'>$v</option>\r\n";
        			}
        			?>
			</select>
          </td>
          <td>
           <input name="imageField" class="np" type="image" src="images/button_search.gif" width="60" height="22" border="0" onerror="this.src='img/button_search.gif'" />
          </td>
        </tr>
      </table>
  </form>
    </td>
</tr>
<form name='form1' method='post' action='friendlink_edit.php' onSubmit='return checkSubmit();'>
<input type='hidden' name='dopost' value='delall'/>
<input type='hidden' name='allid' value=''/>
<tr align="center" bgcolor="#FBFCE2" height="26">
          <td width="4%">ѡ��</td>
          <td width="12%">��վ����</td>
          <td width="12%">��վLogo</td>
          <td width="8%">QQ</td>
          <td width="7%">ʱ��</td>
          <td width="5%">״̬</td>
          <td width="5%">˳��</td>
		  <td width="17%">�ٶ�</td>
		  <td width="5%">PR</td>
		  <td width="16%">����</td>
          <td width="11%">����</td>
        </tr>
        <?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?>
        <tr align="center" bgcolor="#FFFFFF" height="26" onMouseMove="javascript:this.bgColor='#FCFDEE';"
        	 onMouseOut="javascript:this.bgColor='#FFFFFF';" data="<?php echo $fields['url']; ?>" class="ncheck">
          <td><input type='checkbox' name='aids' value='<?php echo $fields['id']; ?>' class='np'></td>
          <td><a href="<?php echo $fields['url']; ?>" target='_blank'><?php echo $fields['webname']; ?></a></td>
          <td><a href="<?php echo $fields['url']; ?>" target='_blank'><?php echo GetPic($fields['logo']); ?></a></td>
          <td><?php if(is_numeric($fields['email'])) echo '<a href="tencent://message/?uin='.$fields['email'].'&amp;Site=dedeadmin&amp;Menu=yes"><img src="http://wpa.qq.com/pa?p=2:'.$fields['email'].':52" style="margin-bottom:-3px;" border="0"></a>';  echo $fields['email']; ?></td>
          <td><?php echo MyDate('Y-m-d',$fields['dtime']); ?></td>
          <td><?php echo GetSta($fields['ischeck']); ?></td>
          <td><?php echo $fields['sortrank']; ?></td>
		  <td><span class="bd"></span> <a target="_blank" href="http://www.aizhan.com/baidu/<?php echo str_replace("http://","",$fields['url']);?>"><img src="http://www.aizhan.com/getbr.php?url=<?php echo $fields['url']; ?>&style=2" width="35" height="20" border="0" style="vertical-align:middle" /></a></td>
		  <td><span class="pr"></span></td>
		  <td><span class="hl"></span></td>
          <td>
          	<a href='friendlink_edit.php?id=<?php echo $fields['id']; ?>&dopost=getedit'>[����]</a>
		        <a href='friendlink_edit.php?id=<?php echo $fields['id']; ?>&dopost=delete'>[ɾ��]</a>
		      </td>
        </tr>
		<?php
}
}?>
    </form>
     <tr bgcolor="#ffffff" height="28">
      <td colspan="11">
      	��
        <a href='#' onclick='Sel("all")' class='np coolbg'>[ȫѡ]</a>
      	<a href='#' onclick='Sel("none")' class='np coolbg'>[ȡ��]</a>
      	<a href='#' onclick='checkSubmit()' class='np coolbg'>����ɾ��</a>

      </td>
     </tr>
     <tr align="center" bgcolor="#F9FCEF" height="28">
      <td colspan="11">
      	<?php
$atts = array();
$atts['tagname'] = 'pagelist';
$atts['listsize'] = '6';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>

      </td>
     </tr>
   </table>
  </td>
</tr>
</table>
<script type="text/javascript">
function fcheck(){
	nlength = nlength_a = $(".ncheck").length*3;
	$(".ncheck").each(function(){
		var url = $(this).attr("data");
		var errstr = '<a href="javascript:void(0);" style="color:red;">����ʧ��</a>';
		//�ٶ���¼���ٶȿ���
		$.ajax({
			url: "friendlink_check.php?a=linknumup&url="+url,
			dataType:"json",
			success: function(rs){
				nlength--;
				suc = (nlength_a - nlength)*100/nlength_a;
				$(".msg").show().html("��ǰ���Ӽ������ܽ���"+suc.toFixed(2)+"%�������ĵȺ�");
				if(nlength==0) $(".msg").hide();
				$("tr[data="+url+"] .bd").html("<a target=blank href='http://www.baidu.com/s?wd=site:"+url.replace("http://", "")+"'>��¼:"+rs.baidunum+" ����:"+rs.baiduup+"</a>");
			},
			error: function(){
				nlength--;
				if(nlength==0) $(".msg").hide();
				$("tr[data="+url+"] .bd").html("<a target=blank href='http://www.baidu.com/s?wd=site:"+url.replace("http://", "")+"'  style='color:red;'>����ʧ��</a>");
				
			}
		});
		//pr
		$.ajax({
			url: "friendlink_check.php?a=linkpr&url="+url,
			dataType:"json",
			success: function(rs){
				nlength--;
				suc = (nlength_a - nlength)*100/nlength_a;
				$(".msg").show().html("��ǰ���Ӽ������ܽ���"+suc.toFixed(2)+"%�������ĵȺ�");
				if(nlength==0) $(".msg").hide();
				$("tr[data="+url+"] .pr").html(rs.pr)
			},
			error: function(){
				nlength--;
				if(nlength==0) $(".msg").hide();
				$("tr[data="+url+"] .pr").html(errstr)
				
			}
		});
		//����
		$.ajax({
			url: "friendlink_check.php?a=linkhl&url="+url+"&myurl="+document.domain,
			dataType:"json",
			success: function(rs){
				nlength--;
				suc = (nlength_a - nlength)*100/nlength_a;
				$(".msg").show().html("��ǰ���Ӽ������ܽ���"+suc.toFixed(2)+"%�������ĵȺ�");
				if(nlength==0) $(".msg").hide();
				$("tr[data="+url+"] .hl").html(rs.huilian)
			},
			error: function(){
				nlength--;
				if(nlength==0) $(".msg").hide();
				$("tr[data="+url+"] .hl").html("<a target=blank href='"+url+"'  style='color:red;'>����ʧ��</a>")
			}
		});
	})
}
</script>
<div style="text-align:center; padding:10px;">�ٷ���վ��<a href="http://www.010xr.com" target="_blank">http://www.010xr.com</a> �ͷ�QQ��<a href="http://wpa.qq.com/msgrd?v=3&uin=10373458&site=qq&menu=yes" target="_blank">10373458</a> </br>
<a href="http://www.010xr.com/?a" target="_blank"><b>�������</b></a></div>
<script type="text/javascript">
$.getScript("http://openapi.dedeapps.com/?m=content&c=stats&a=friendlink&dedever=<?php echo $cfg_version;?>&softlang=<?php echo $cfg_soft_lang;?>&domain="+document.domain+"&"+Math.random(), function(){
	//ͳ��
});
</script>
<script type="text/javascript" src="http://js.tongji.linezing.com/3130013/tongji.js"></script>
</body>
</html>