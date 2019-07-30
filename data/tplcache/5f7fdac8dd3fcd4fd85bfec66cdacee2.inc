{dede:noteinfo notename="笔下文学章节采集模版（不要删除）" channelid="1" macthtype="string"
    refurl="http://" sourcelang="gb2312" cosort="desc"
  isref="yes" exptime="10" usemore="1" /}
{dede:listrule sourcetype="batch" rssurl="http://" regxurl="(#)"
startid="1" endid="" addv="1" urlrule="area" musthas="html"
 nothas="" listpic="0" usemore="1"}
    {dede:addurls}{/dede:addurls}
    {dede:batchrule}[(#)=>http://www.bxwx.org/b/62/62724/index.html; (*)=>1-1; typeid=>7]{/dede:batchrule}
    {dede:regxrule}{/dede:regxrule}
    {dede:areastart}<!--列表内容开始-->{/dede:areastart}
    {dede:areaend}<!--列表内容结束-->{/dede:areaend}
{/dede:listrule}
{dede:sppage sptype='full' srul='1' erul='5'}{/dede:sppage}
{dede:previewurl}http://www.bxwx.org/b/62/62724/11455543.html{/dede:previewurl}
{dede:keywordtrim}*{/dede:keywordtrim}
{dede:descriptiontrim}*{/dede:descriptiontrim}
{dede:item field='title' value='' isunit='' isdown=''}
   {dede:match}<div id="title">[内容]</div>{/dede:match}
   {dede:trim replace=""}正文{/dede:trim}
{dede:trim replace="第"}第(.*)卷(.{0,2})第{/dede:trim}
{dede:trim replace="第"}第(.*)部(.{0,2})第{/dede:trim}
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
   {dede:match}<div id="content">[内容]<div align="center">{/dede:match}
   {dede:trim replace=""}<div([^.]*)>{/dede:trim}
{dede:trim replace=""}</div>{/dede:trim}
{dede:trim replace=""}www(.*)om{/dede:trim}
{dede:trim replace=""}www(.*)org{/dede:trim}
{dede:trim replace=""}笔(.{0,2})下(.{0,2})文(.{0,2})学{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}