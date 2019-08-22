<?php
//set_time_limit(0);
//header('content-type:application/json;charset=utf8');
$apppath= dirname(__FILE__);

include $apppath."/global.php";
 
$zone = '北京大族';
$zone = '常州电信';

$zone = '上海金桥';
$zone = '深圳坂田';
$zone = '武汉火凤凰';



$date = '2019-03-07';

$list = readCsv('./'.$zone.'-'.$date.'-3012.csv');
$count = count($list);

foreach($list as $k=>$v){
	if($k==0 || $k==$count-1) continue;
	$row = explode(',', $v);

    $data = array();

    $data['timeslot'] = scr($date);
    $data['domain'] = scr($row[1]);
    $data['subdomain'] = scr($row[0]);
    $data['ip'] = scr($row[2]);
    $data['icpstatus'] = intval($icpStatusStr[$row[3]]);
    $data['service_code'] = $nodeStrArr[scr($row[4])];
    $data['lasttime'] = scr($row[5]);


    $sqlAdd = '';
    $i=0;
    foreach($data as $k=>$v){
        if($i==0){$sqlAdd.=''.$k.'="'.$v.'"';}else{$sqlAdd.=', '.$k.'="'.$v.'"';}
        $i++;
    }

    $sql = 'INSERT INTO `fa_domain` SET '.$sqlAdd;
	$stmt = $pdo->prepare($sql );
	$stmt->execute();



	//echo "<br>";
}

echo "ok ".time();



/*
$sql = "SELECT * FROM fa_doinfo  WHERE 1 ";
$stmt = $pdo->prepare($sql );
$stmt->execute();
$list = $stmt->fetchAll(PDO::FETCH_ASSOC);
*/
