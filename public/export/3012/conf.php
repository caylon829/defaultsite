<?php

$node = '宁波枢纽';

$csvpath = '/data/pro/ops/export/csv';

$path1 = $csvpath.'/noicp/';
$path2 = $csvpath.'/3012/';


$nodeArr = array(
	'宁波枢纽',
	'常州电信',
	'北京大族',
	'上海金桥',
	'山东潍坊',
	'武汉火凤凰',
	'深圳坂田',
);

$code = array(
	'300001'=>'宁波枢纽',
);

$icpStatus = array(
	0=>'未备案',
	1=>'审核中',
);

$status = array(
    0=>'未处理',
    1=>'已处理',
);

$lawtypeArr = array(
	'1'=>'涉黄',
	'2'=>'涉赌',
	'3'=>'涉毒',
	'4'=>'ICP未备案跳转',
	'5'=>'其他',
);

$codeStr = array(
	'宁波枢纽'=>'300001',
);

$icpStatusStr = array(
	'审核中'=>'0',
	'未备案'=>'1',
);

$statusStr = array(
	'未处理'=>'0',
	'已处理'=>'1',
);

$lawtypeStr = array(
	'涉黄'=>'1',
	'涉赌'=>'2',
	'涉毒'=>'3',
	'ICP未备案跳转'=>'4',
	'其他'=>'5',
);


$nodeStrArr = [
    '宁波枢纽'=>'ningbo',
    '常州电信'=>'changzhou',
    '北京大族'=>'beijing',
    '上海金桥'=>'shanghai',
    '山东潍坊'=>'shandong',
    '武汉火凤凰'=>'wuhan',
    '深圳坂田'=>'shenzhen',
];
