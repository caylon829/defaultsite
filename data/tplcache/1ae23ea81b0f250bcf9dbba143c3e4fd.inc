{dede:sppage sptype='full' srul='1' erul='5'}{/dede:sppage}
{dede:previewurl}http://www.23wx.com/book/28373{/dede:previewurl}
{dede:keywordtrim}*{/dede:keywordtrim}
{dede:descriptiontrim}*{/dede:descriptiontrim}
{dede:item field='title' value='' isunit='' isdown=''}
   {dede:match}<h1>[����] ȫ���Ķ�</h1>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='writer' value='' isunit='' isdown=''}
   {dede:match}��������</th><td>#n#[����]</td>{/dede:match}
 
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='source' value='' isunit='' isdown=''}
   {dede:match}�������</th><td>#n#[����]</td>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='pubdate' value='' isunit='' isdown=''}
   {dede:match}������</th><td>#n#[����]</td>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='body' value='' isunit='1' isdown='1'}
   {dede:match}���ݼ�飺</b></p>[����]<p style="display:none" id="sidename">{/dede:match}
   {dede:trim replace=""}<a([^>]*)>(.*)</a>{/dede:trim}
{dede:trim replace=""}<script([^>]*)>(.*)</script>{/dede:trim}
{dede:trim replace=""}<!--(.*)-->{/dede:trim}
{dede:trim replace=""}<table([^>]*)>(.*)</table>{/dede:trim}
{dede:trim replace=""}<div([^>]*)>(.*)</div>{/dede:trim}
{dede:trim replace=""}<p([^.]*)>{/dede:trim}
{dede:trim replace=""}</p>{/dede:trim}
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='bookimg' value='' isunit='1' isdown='1'}
   {dede:match}<dd><div class="fl">[����]</div>{/dede:match}
   {dede:trim replace="000000"}no{/dede:trim}
   {dede:function}@me=TurnImageTag(@me);



{/dede:function}
{/dede:item}{dede:item field='bookurl' value='' isunit='' isdown=''}
   {dede:match}<a class="read" href="[����]" title{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='copynid' value='37' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='overtag' value='������' isunit='' isdown=''}
   {dede:match}����״̬</th><td>#n#[����]</td>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}