{dede:sppage sptype='full' srul='1' erul='5'}{/dede:sppage}
{dede:previewurl}http://www.81zw.com/book/8262/{/dede:previewurl}
{dede:keywordtrim}*{/dede:keywordtrim}
{dede:descriptiontrim}*{/dede:descriptiontrim}
{dede:item field='title' value='' isunit='' isdown=''}
   {dede:match}<h1>[����]</h1>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='writer' value='' isunit='' isdown=''}
   {dede:match}<h2>���ߣ�[����]</h2>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='source' value='' isunit='' isdown=''}
   {dede:match}<h2>������[����]</h2>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='pubdate' value='' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='body' value='' isunit='1' isdown='1'}
   {dede:match}<div class="msgarea"><p>[����]</p></div>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='bookimg' value='' isunit='1' isdown='1'}
   {dede:match}<div class="book_news_style_img1">[����]<br /><br />{/dede:match}
   {dede:trim replace='000000'}no{/dede:trim}
   {dede:function}@me=TurnImageTag(@me);
{/dede:function}
{/dede:item}{dede:item field='bookurl' value='' isunit='' isdown=''}
   {dede:match}<br /><br /><a href="[����]" target="_blank">{/dede:match}
   
   {dede:function}@me=str_replace(array('down','txt','.html'),array('book','','/'),@me);
{/dede:function}
{/dede:item}{dede:item field='copynid' value='35' isunit='' isdown=''}
   {dede:match}{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}{dede:item field='overtag' value='' isunit='' isdown=''}
   {dede:match}<h2>״̬��[����]</h2>{/dede:match}
   
   {dede:function}{/dede:function}
{/dede:item}