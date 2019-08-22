<?php
include $apppath."/conf.php";
include $apppath."/conf_db.php";
$dsn = 'mysql:host='.$dbhost.';dbname='.$dbname.';port='.$dbport;
$pdo = new PDO($dsn,$dbuser, $dbpass);

$pdo->exec('set names utf8');

function sendPost($url = '', $param = '') {
    if (empty($url) || empty($param)) {
        return false;
    }
    $postUrl = $url;
    $curlPost = $param;
    $curlPost['vpass'] = 'NSNJqCYlU219qvkN';

    $ch = curl_init();//初始化curl
    curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
    curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
    $data = curl_exec($ch);//运行curl
    curl_close($ch);
    
    return $data;
}



/**
 * 模拟post进行url请求
 * @param string $url
 * @param string $param
 */
function vpost($url = '', $param = '') {
		if (empty($url) || empty($param)) {
				return false;
		}
		
		$postUrl = $url;
		$curlPost = $param;
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$data = curl_exec($ch);//运行curl
		curl_close($ch);
		
		return $data;
}

//计算执行耗费时间
function getRuntime(){
    $ntime=microtime(true);
    $total=$ntime-$GLOBALS['_beginTime'];
    return round($total,2)."s";
}

//计算执行耗费时间
function getMemoryUsage(){
    $re = 's:' . round($GLOBALS['_startUseMems'] / 1024 / 1024,2)."MB";
    $end_memory = memory_get_usage();
    $re .= ' e：' . round($end_memory / 1024 / 1024, 2)."MB";
    $re .= ' dif：' . round(($end_memory-$GLOBALS['_startUseMems']) / 1024 / 1024, 2)."MB";
    return $re;
}

function succ($data){
	$res = array(
		'code'=>0,
		'msg'=>'',
		'count'=>count($data),
		'data'=>$data,
	);	
	echo json_encode($res);
}

function readCsv($filename = ''){
    $list = array();
    $file = fopen($filename, "r");
    while(!feof($file)) {
        $str = fgets($file);
        $list[] = trim($str);
    }
    fclose($file);
    return $list;
}


function scr($v){
	return htmlspecialchars(trim($v));
}

/**
 * 导出CSV文件
 * @param array $data        数据
 * @param array $header_data 首行数据
 * @param string $file_name  文件名称
 * @return string
 */
function export_csv($data = [], $header_data = [], $file_name = '')
{
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='.$file_name);
    header('Cache-Control: max-age=0');
    $fp = fopen('php://output', 'a');
    if (!empty($header_data)) {
        foreach ($header_data as $key => $value) {
            $header_data[$key] = iconv('utf-8', 'gbk', $value);
        }
        fputcsv($fp, $header_data);
    }
    $num = 0;
    //每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
    $limit = 100000;
    //逐行取出数据，不浪费内存
    $count = count($data);
    if ($count > 0) {
        for ($i = 0; $i < $count; $i++) {
            $num++;
            //刷新一下输出buffer，防止由于数据过多造成问题
            if ($limit == $num) {
                ob_flush();
                flush();
                $num = 0;
            }
            $row = $data[$i];
            foreach ($row as $key => $value) {
                $row[$key] = iconv('utf-8', 'gbk', $value);
            }
            fputcsv($fp, $row);
        }
    }
    fclose($fp);
}