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