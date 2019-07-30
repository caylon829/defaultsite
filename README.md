迅睿CMS介绍

迅睿CMS内容管理框架是基于PHP7语言采用最新CodeIgniter4作为开发框架生产的网站内容管理框架，提供“电脑网站 + 手机网站 + APP 接口”一体化网站技术解决方案。她拥有强大稳定底层框架，以灵活扩展为主的开发理念，二次开发方便且不破坏程序内核，为 WEB 艺术家创造的 PHP 建站程序，堪称 PHP 万能建站框架。



迅睿CMS框架特点

一、程序架构

迅睿CMS框架是采用PHP7全新语法开发的web内容管理系统开发框架，拥有迅睿CMS强大的内容管理功能和灵活扩展的特性，堪称 PHP 万能建站框架。强大而灵活的内容模块和插件机制，开发者可以自定义内容模块，也可以根据自身的需求以插件的形式进行扩展。

迅睿CMS框架采用最新CodeIgniter4框架，拥有完善的二次开发文档，并且遵循框架原生编程风格，非常方便二次开发；CodeIgniter 安装包中包含《用户手册》，手册囊括了入门介绍、教程、“手把手”指导，还包括了框架组件的参考文档。




二、效率与安全

1、运用全新PHP7语法特性，设计时考虑到性能优化，运行效率高达4倍于PHP5系列开发环境

2、运用CI框架的扩展性和路由模式，加上ZF框架强大丰富的中间件和扩展包，大大提高系统的扩展性能

3、Zend框架官方全部扩展包支持自由引入本系统，按需加载模式，最大限度地提高开发效率

4、利用ZF提供的与安全相关的组件，包括 SQL 注入、XSS、CSRF、垃圾邮件和密码暴力破解攻击

5、动态缓存技术让动态页面新增支持缓存，让采用动态页面模式的网站访问速度更快，效率更高

6、全站支持HTTPS传输协议，更安全，支持小程序数据请求的URL规范

7、表单增加“csrf_token”验证功能，防护更强



三、多插件机制

CI4框架采用多个Module作为App应用，迅睿CMS继续沿用此设计模式，并且支持多个App插件化。

1、插件目录结构：dayrui/App/***/。

2、插件支持独立运行。

3、插件内部结构遵循CI4App规则。



四、自定义CI扩展类

迅睿CMS在不破坏CI4框架本身的情况下，进行了扩展CI自带的类库。

1、重写CI错误异常显示类，中国化。

2、重写路由类，符合国内建站程序的URL结构，如：c=控制器&m=方法名&id=参数。

3、重写钩子类，CI4钩子类会加载所有App中的自定义钩子，App数量过多时会影响速度，迅睿CMS提出全局钩子配置文件。

4、重写安全类，强化过滤非法字符串。



五、模板解析类（视图）

CI4本身的模板解析类不太灵活，迅睿CMS采用天睿自主研发天睿模板引擎技术，MVC设计模式实现业务逻辑与表现层的适当分离，使网页设计师能够轻松设计出理想的模板。

1、支持原生态PHP语法特性。

2、支持CI框架语法结构。

3、{变量}自定义系统标签语法结构。

4、模板缓存，只需要一次解析，提升性能。



六、自定义扩展类目录

迅睿CMS有全局Library目录，专门用于扩展类库，与Librarys用法不太一样，但原理一样。

1、全局Library调用。

2、可继承全局Library函数类。

3、App有自己独立的Library函数类。

4、跨App支持调用任意App的Library函数类。



七、网站模板机制

CI4不具备终端识别模式，迅睿CMS增加多终端识别和自定义终端显示。

1、迅睿CMS模板分为手机端和电脑端。

2、后台可以直接编辑网站模板和手机模板。

3、编辑模板自动备份，以免老模板丢失。

4、编辑模板时自动检测模板语法是否正确。

5、为模板文件中文命名，以免快速区分。



八、万能Table类

迅睿CMS框架为开发者准备了万能的Table类，此类用于对数据表的增删改查操作，只需要配置文件，逻辑功能由迅睿CMS来帮你完成。

1、支持任意表数据展示。

2、多表联合查询。

3、自定义字段格式入库规则。



九、自定义字段

迅睿CMS采用非常成熟的自定义字段方案，可以支持到栏目表自定义字段、内容表自定义字段、表单表自定义字段、用户表自定义字段、评论表自定义字段、页面表自定义字段、链接表自定义字段、tag表自定义字段等。

1、文本字段，有单行文本、多行文本、文本事件字段

2、上传字段，有单文件上传、多文件上传

3、日期时间字段，支持自定义年月格式显示

4、联动菜单字段，用于无限分类层级显示的数据，例如城市

5、百度地图字段，用于定位地图坐标，坐标范围内筛选数据

6、富文本字段，百度编辑器、百度移动编辑器

7、选项字段，单选字段、多选字段、下拉选择字段

8、颜色字段，用于选择网页颜色值

9、属性字段，用于类似于商品属性的数据

10、内容关联字段，用于加载其他模块内容的字段，例如专题功能

11、价格字段，用于CMF站内购物交易，例如文章买卖、下载收费

12、单行分组字段，用于把N个字段放在一行显示

12、多行分组字段，用于把N个字段放在一个组里面显示

13、强大的DIY字段，此字段功能相当强大，可以让开发者打造自己的字段




----------------------------------------

FineCMS系统免费并开放源代码，推荐开发者或公司在此基础上进行二次开发或者发行，本人一直提倡免费开源，希望在此基础上开发的开发者也能保持免费开源，为本土的开源事业做一点贡献。

FineCMS以“小巧、精干、轻量”为设计理念，不用太多复杂的功能，有一套强大和稳定内容管理机制足以，以简洁的基础CMS程序+多样化插件为开发目的。 

FineCMS是不要钱的程序，没有那么多条条款款限制，喜欢用就拿去用，无论你改名字发布还是去申请版权都是可以的。 
有人会问，国内大大小小CMS程序已经很多了，但是为什么还要继续这么一个CMS？其实也是有很多原因的！最主要的原因是不放弃最初的信念，开始主要为了提高自己的PHP开发水平以及对手头正在做的网站项目所使用的开发方式和开发规范并不是很满意，所以就开始写了这个CMS。 

FineCMS v1：2009年开始开发，一开始用于自己就职公司的小网站项目，然后发布到网上供免费下载使用，并收集了很多热心网友的建议。 

FineCMS v2：2012年发布，基础框架采用codeigniter2，支持php5全系列版本，任然免费开源。 

FineCMS 高级版 v3（现POSCMS3）：2013年发布，采用codeigniter3全新开发，作为商业版程序。 

FineCMS v5：2016年发布，使用FineCms高级版内核新设计一款企业网站管理系统，任然免费开源。 

2018年秋，不再对FineCMS现有的源码进行维护。 

2019年，在FineCMS部分老用户的强烈建议之下，发布全新PHP7程序【迅睿CMS（TPCMF）】内容管理框架，作为FineCMS的全新替代产品，它依然保持免费开源无商业限制。
