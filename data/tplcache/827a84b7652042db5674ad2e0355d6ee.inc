{dede:noteinfo notename="����С˵�½ڲɼ�ģ�棨��Ҫɾ����" channelid="1" macthtype="string"
    refurl="http://" sourcelang="gb2312" cosort="desc"
  isref="no" exptime="10" usemore="1" /}
{dede:listrule sourcetype="batch" rssurl="http://" regxurl="(#)"
startid="1" endid="" addv="1" urlrule="area" musthas=".html"
 nothas="" listpic="1" usemore="1"}
    {dede:addurls}{/dede:addurls}
    {dede:batchrule}[(#)=>http://www.23wx.com/html/28/28373/; (*)=>1-1; typeid=>5045]{/dede:batchrule}
    {dede:regxrule}{/dede:regxrule}
    {dede:areastart}<table cellspacing="1"{/dede:areastart}
    {dede:areaend}<dd id="foottips">{/dede:areaend}
{/dede:listrule}
{dede:sppage sptype='full' srul='1' erul='5'}{/dede:sppage}
{dede:previewurl}http://www.23wx.com/html/28/28373/18568330.html{/dede:previewurl}
{dede:keywordtrim}*{/dede:keywordtrim}
{dede:descriptiontrim}*{/dede:descriptiontrim}
{dede:item field='title' value='' isunit='' isdown=''}
   {dede:match}<h1>[����]</h1>{/dede:match}
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
   {dede:match}<dd id="contents">[����]</dd>{/dede:match}
   {dede:trim replace=""}www(.*)com{/dede:trim}
{dede:trim replace=""}<script([^>]*)>(.*)</script>{/dede:trim}
{dede:trim replace=""}<!--(.*)-->{/dede:trim}
{dede:trim replace=""}��(.{0,2})��(.{0,2})С(.{0,2})˵{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}