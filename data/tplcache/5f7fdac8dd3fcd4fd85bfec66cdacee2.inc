{dede:noteinfo notename="������ѧ�½ڲɼ�ģ�棨��Ҫɾ����" channelid="1" macthtype="string"
    refurl="http://" sourcelang="gb2312" cosort="desc"
  isref="yes" exptime="10" usemore="1" /}
{dede:listrule sourcetype="batch" rssurl="http://" regxurl="(#)"
startid="1" endid="" addv="1" urlrule="area" musthas="html"
 nothas="" listpic="0" usemore="1"}
    {dede:addurls}{/dede:addurls}
    {dede:batchrule}[(#)=>http://www.bxwx.org/b/62/62724/index.html; (*)=>1-1; typeid=>7]{/dede:batchrule}
    {dede:regxrule}{/dede:regxrule}
    {dede:areastart}<!--�б����ݿ�ʼ-->{/dede:areastart}
    {dede:areaend}<!--�б����ݽ���-->{/dede:areaend}
{/dede:listrule}
{dede:sppage sptype='full' srul='1' erul='5'}{/dede:sppage}
{dede:previewurl}http://www.bxwx.org/b/62/62724/11455543.html{/dede:previewurl}
{dede:keywordtrim}*{/dede:keywordtrim}
{dede:descriptiontrim}*{/dede:descriptiontrim}
{dede:item field='title' value='' isunit='' isdown=''}
   {dede:match}<div id="title">[����]</div>{/dede:match}
   {dede:trim replace=""}����{/dede:trim}
{dede:trim replace="��"}��(.*)��(.{0,2})��{/dede:trim}
{dede:trim replace="��"}��(.*)��(.{0,2})��{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='writer' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='source' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='pubdate' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='body' value='' isunit='1' isdown='1'}
   {dede:match}<div id="content">[����]<div align="center">{/dede:match}
   {dede:trim replace=""}<div([^.]*)>{/dede:trim}
{dede:trim replace=""}</div>{/dede:trim}
{dede:trim replace=""}www(.*)om{/dede:trim}
{dede:trim replace=""}www(.*)org{/dede:trim}
{dede:trim replace=""}��(.{0,2})��(.{0,2})��(.{0,2})ѧ{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}