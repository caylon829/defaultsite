<?php
if(!isset($GLOBALS['_vars'])) $GLOBALS['_vars'] = array(); 
$fields = array();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cfg_soft_lang; ?>">
<title>�ɼ��������</title>
<script language="javascript" src="js/context_menu.js"></script>
<script language="javascript" src="js/ieemu.js"></script>
<script language="javascript">
function getCheckboxItem()
{
	var allSel="";
	if(document.form1.nids.value) return document.form1.nids.value;
	for(i=0;i<document.form1.nids.length;i++)
	{
		if(document.form1.nids[i].checked)
		{
			if(allSel=="")
				allSel=document.form1.nids[i].value;
			else
				allSel=allSel+","+document.form1.nids[i].value;
		}
	}
	return allSel;	
}
function ReSel()
{
	for(i=0;i<document.form1.nids.length;i++)
	{
		if(document.form1.nids[i].checked) document.form1.nids[i].checked = false;
		else document.form1.nids[i].checked = true;
	}
}
if(moz) {
	extendEventObject();
	extendElementModel();
	emulateAttachEvent();
}
//�༭����
function EditNote(nid)
{
	if(nid=="") nid = getOneItem();
  if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_edit.php?nid="+nid;
}
//�༭��������
function EditNoteText(nid)
{
	if(nid=="") nid = getOneItem();
  if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_edit_text.php?nid="+nid;
}
//��չ���
function ClearNote(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_do.php?dopost=clear&nid="+nid;
}
//���״̬
function changerenid(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_do.php?dopost=changerenid&nid="+nid;
}
//ɾ������
function DelNote(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	if(window.confirm('��ȷ��Ҫɾ����Щ������?'))
	{ location.href = "co_do.php?dopost=delete&nid="+nid; }
}
//����Ϊ���Զ�
function setauto(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	if(window.confirm('��ȷ��Ҫ����Щ��������Ϊ���Զ���?'))
	{ location.href = "co_do.php?dopost=auto&nid="+nid; }
}
//����Ϊȫ�Զ�
function setnoeor(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	if(window.confirm('��ȷ��Ҫ����Щ��������Ϊȫ�Զ���?'))
	{ location.href = "co_do.php?dopost=noeor&nid="+nid; }
}
//����Ϊ�ֶ�
function setnoco(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	if(window.confirm('��ȷ��Ҫ����Щ��������Ϊ�ֶ���?'))
	{ location.href = "co_do.php?dopost=noco&nid="+nid; }
}
//�滻����
function setcgn(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	if(window.confirm('��ȷ��Ҫ�滻��Щ������?'))
	{ location.href = "co_do.php?dopost=setcgn&nid="+nid; }
}
//�鿴�����ص�����
function ViewDown(nid)
{
	if(nid=="") nid = getOneItem();
	location.href = "co_url.php?nid="+nid;
}
//���Թ���
function TestRule(nid)
{
	if(nid=="") nid = getOneItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_test_rule.php?nid="+nid;
}
//�����ɼ�
function ExportDown(nid)
{
	if(nid=="") nid = getOneItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_export.php?nid="+nid;;
}
function bang(nid)
{
	if(nid=="") nid = getOneItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_bang.php?nid="+nid;;
}
//�������
function GetRule()
{
	location.href = "co_get_corule.php";
}
//��������
function ExportRule(nid)
{
	if(nid=="") nid = getOneItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_export_corule.php?nid="+nid;
}

//�ɼ���ѡ����
function GatherSel(nid)
{
	if(nid=="") nid = getCheckboxItem();
	if(nid==""){ window.open("../download/caiji.htm");return;}
	window.open("../download/caiji.php?nid="+nid);
}
//������ѡ����
function CopyNote(nid)
{
	if(nid=="") nid = getOneItem();
	if(nid==""){ alert("��ѡ��һ������"); return;}
	location.href = "co_do.php?dopost=copy&nid="+nid;
}
//�����Ĳ˵�
function ShowMenu(evt,obj,nid)
{
  var eobj,popupoptions
  popupoptions = [
    new ContextItem("���Ե�ǰ����",function(){ TestRule(nid); }),
    new ContextItem("�ɼ���ǰ����",function(){ GatherSel(nid); }),
    new ContextSeperator(),
    new ContextItem("���ĵ�ǰ����",function(){ EditNote(nid); }),
    new ContextItem("���Ĺ�������",function(){ EditNoteText(nid); }),
    new ContextSeperator(),
    new ContextItem("�鿴�ɼ�����",function(){ ViewDown(nid); }),
    new ContextItem("�����ɼ�",function(){ ExportDown(nid); }),
    new ContextSeperator(),
    new ContextItem("�����������Ϣ",function(){ ClearNote(nid); }),
    new ContextItem("ɾ����ǰ����",function(){ DelNote(nid); }),
    new ContextSeperator(),
    new ContextItem("���Ƶ�ǰ����",function(){ CopyNote(nid); }),
    new ContextSeperator(),
    new ContextItem("�������ù���",function(){ ExportRule(nid); }),
    new ContextItem("�رղ˵�(<u>C</u>)",function(){})
  ]
  ContextMenu.display(evt,popupoptions)
}
//���ѡ������һ����id
function getOneItem()
{
	var allSel="";
	if(document.form1.nids.value) return document.form1.nids.value;
	for(i=0;i<document.form1.nids.length;i++)
	{
		if(document.form1.nids[i].checked)
		{
				allSel = document.form1.nids[i].value;
				break;
		}
	}
	return allSel;	
}
//������п��Ըı���е���ɫ
var currentActiveRow;
function changeActiveRow(obj) {
	currentActiveRow = obj;
	var rowcolor;
	rowcolor=currentActiveRow.style.backgroundColor;
	if (rowcolor=="#F2F2F2"){
		currentActiveRow.style.backgroundColor = "";
	}
	else
	{
		currentActiveRow.style.backgroundColor = "#F2F2F2";
	}
}
//���й�ѡ���ж��ı���ɫ
function tr_bgcolor(c){
var tr = c.parentNode.parentNode;
tr.rowIndex % 1 == 1 ? tr.style.backgroundColor = c.checked ? '#ffff00' : '#FFFFF' : tr.style.backgroundColor = c.checked ? '#ffff00' : '';
} 
</script>
<link href="css/base.css" rel="stylesheet" type="text/css">
</head>
<body background='images/allbg.gif' leftmargin='8' topmargin='8' onLoad="ContextMenu.intializeContextMenu()">
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#D1DDAA" align="left">
  <tr> 
    <td height="20" colspan="10" background='images/tbg.gif'> <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="20%" height="18"><strong>�ɼ����������</strong></td>
          <td width="80%" align="right">�ɼ������ϵͳ��������-ģ����������ã�����ֶ���ȡ���ɼ��ù���<input type="button" name="ba" value="�滻������" onClick="location='pr_str_replace.php';" class="coolbg np" style="width:100px" />
          	<input type="button" name="ba" value="�����¹���" onClick="location='co_add.php?action=select';" class="coolbg np" style="width:100px" /> 
          </td>
        </tr>
      </table></td>
  </tr>
  <tr align="center" bgcolor="#FAFAF1"> 
    <td width="30px">ѡ��</td>
    <td width="300px">��������</td>
	<td width="420px">�������</td>
	<td width="60px">�ɼ�����</td>
    <td width="60px">��������</td>
    <td width="120px">���ɼ�ʱ��</td>
    <td width="120px">��������</td>
    <td width="40px">����</td>
    <td width="100px">��ַ��</td>
    <td width="100px">��ע</td>
  </tr>
  <form name="form1">
    <?php
$atts = array();
$atts['tagname'] = 'datalist';
$blockValue = $this->refObj->GetArcList($atts,$this->refObj,$fields); 
if(is_array($blockValue)){
foreach( $blockValue as $key=>$fields )
{
?> 
    <tr bgcolor="#FFFFFF" align="center" onMouseMove="javascript:this.bgColor='#ddffff';"
    	 onMouseOut="javascript:this.bgColor='#FFFFFF';" height="22" oncontextmenu="ShowMenu(event,this,<?php echo $fields['nid']; ?>);"> 
      <td><input type='checkbox' name='nids' value='<?php echo $fields['nid']; ?>' class='np' onclick="tr_bgcolor(this);"></td>
      <td align="left"><a href='co_url.php?nid=<?php echo $fields['nid']; ?>' title='�鿴�Ѿ��ɼ�������'>[ID:<?php echo $fields['nid']; ?>]<?php echo $fields['notename']; ?></a></td>
      <td>[<a href='co_edit.php?nid=<?php echo $fields['nid']; ?>'>�༭</a>] [<a href='../download/caiji.php?nid=<?php echo $fields['nid']; ?>' target="_blank" title="ע�⣺���Զ���Ҳ��ɼ���">�ɼ�</a>] [<a href='co_do.php?dopost=clear&nid=<?php echo $fields['nid']; ?>'>���</a>] [<a href='co_do.php?dopost=auto&nid=<?php echo $fields['nid']; ?>' title="ע�⣺���ú���������ʱ��ֹͣ������Ĳɼ�����Ҫ�ֶ���������ܼ����ɼ���">���Զ�</a>] [<a href='co_do.php?dopost=noeor&nid=<?php echo $fields['nid']; ?>' title="ע�⣺���ú��������󶼽��Զ������������ɼ������ܻ����©�£�">ȫ�Զ�</a>] [<a href='co_do.php?dopost=noco&nid=<?php echo $fields['nid']; ?>' title="ע�⣺ȡ���Զ��ɼ���">�ֶ�</a>] [<a href='co_hebing.php?nid=<?php echo $fields['nid']; ?>'>�ϲ�</a>] [<a href='co_do.php?dopost=setcgn&nid=<?php echo $fields['nid']; ?>' title="��������վ�ɼ���С˵������ֻ��һ��С˵�Ĺ�����Ч">��վ</a>] [<a href='co_do.php?dopost=setautocgn&nid=<?php echo $fields['nid']; ?>' title="�Զ���վ�ɼ�">�Զ���վ</a>] [<a href='co_do.php?dopost=changerenid&nid=<?php echo $fields['nid']; ?>' title="�ı��걾������״̬��">���״̬</a>]</td>
	  <td><?php echo typeye($fields['typeid']); ?></td>
      <td><?php echo type($fields['typename']); ?></td>
      <td><?php echo GetDatePage($fields['cotime']); ?></td>
      <td><?php echo date("y-m-d H:i",$fields['uptime']); ?></td>
      <td><?php echo $fields['sourcelang']; ?></td>
      <td><?php echo TjUrlNum($fields['nid']); ?></td>
	  <td><?php echo $fields['remark']; ?></td>
    </tr>
    <?php
}
}?> 
  </form>
  <tr bgcolor="#FAFAF1"> 
    <td height="24" colspan="10"> 
      <table width="90%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
			<input type="button" name="b11" value="��ѡ" class="coolbg np" style="width:40px" onClick="ReSel();" /> 
          	&nbsp;
          	<a href="#" onClick="location='co_add.php?action=select';" class='coolbg np'>�����¹���</a>
            <a href="javascript:GetRule();" class='coolbg np'>�������</a>
            <a href="javascript:ExportRule('');" class='coolbg np'>��������</a> 
             | 
            <a href="../download/caiji.htm" target="_blank" class='coolbg np' style='color:red' title="��ȫ�Զ��ɼ�ҳ��">��ʼ�ɼ�</a>
            <a href="javascript:setauto('');" class='coolbg np' title="����ѡ��������Ϊ���Զ��ɼ�ģʽ">����Ϊ���Զ�</a>
            <a href="javascript:setnoeor('');" class='coolbg np' style='color:blue' title="����ѡ��������Ϊȫ�Զ��ɼ�ģʽ">����Ϊȫ�Զ�</a>
            <a href="javascript:setnoco('');" class='coolbg np' style='color:blue' title="ȡ����ѡ������Զ��ɼ�">����Ϊ�ֶ�</a>
            <a href="javascript:setcgn('');" class='coolbg np' style='color:blue' title="��������վ�ɼ���ѡ�����ڵ�С˵">��վ</a>
             |
            <a href="javascript:CopyNote('');" class='coolbg np'>����</a>
            <a href="javascript:ClearNote('');" class='coolbg np' title="���ѡ���������Ѳɼ������ݣ��������������������">���</a> 
             | 
            <a href="javascript:DelNote('');" class='coolbg np'>ɾ��</a>
           </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr bgcolor="#FAFAF1"> 
    <td height="24" colspan="10" align="center">
    	<?php
$atts = array();
$atts['tagname'] = 'pagelist';
$atts['listsize'] = '5';
$atts['listitem'] = 'info,index,end,pre,next,pageno,select';
 echo $this->refObj->GetPageList($atts,$this->refObj,$fields); 
?>

    </td>
  </tr>
  <tr bgcolor="#FAFAF1"> 
    <td colspan="10">
	<font color="red">˵����<br />1��ȫ�Զ������Ŀ��վ�½�����Ϊ�ջ��߲�����������ʱ�����Զ������������ɼ�������½ڡ�<br />2�����Զ������Ŀ��վ�½�����Ϊ�ջ��߲�����������ʱ����ֹͣ�ɼ��ù��򣬵ȴ��ֶ�������<br />3���ֶ���ֹͣ�ɼ��ù��򣬿��ֶ��㡰�ɼ������е����ɼ���<br />4�����С��½ڲɼ�ģ�塱����������Ϊȫ�Զ����߰��Զ���������ɾ����<br />5����ַ�����������ֱַ��������Ҫ�ɼ�����ַ/�Ѳɼ���/�����ġ���������������ֿ��Բ鿴Ŀǰ�ɼ��������ݡ�<br />6����վ�ɼ�����Ŀ��վAת����Ŀ��վB�ɼ�����������Ŀ��վB�Ĳɼ�����<br />7���ɼ�ǰ�����ȿ���װʹ��˵����ÿ����ť������ʾ��Ϣ��Ҫ�ȿ�����ٲ�����</font>
	</td>
  </tr>
</table>
</body>
</html>