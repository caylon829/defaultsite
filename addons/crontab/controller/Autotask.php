<?php

namespace addons\crontab\controller;

use app\common\model\Crontab;
use Cron\CronExpression;
use fast\Http;
use think\Controller;
use think\Db;
use think\Exception;
use think\Log;

/**
 * 定时任务接口
 *
 * 以Crontab方式每分钟定时执行,且只可以Cli方式运行
 * @internal
 */
class Autotask extends Controller
{

    /**
     * 初始化方法,最前且始终执行
     */
    public function _initialize()
    {
        // 只可以以cli方式执行
//        if (!$this->request->isCli())
//            $this->error('Autotask script only work at client!');

        parent::_initialize();

        // 清除错误
        error_reporting(0);

        // 设置永不超时
        set_time_limit(0);
    }

    /**
     * 执行定时任务
     */
    public function index()
    {
        ini_set('memory_limit', '-1');
        $dbConfigarr=[
            /*'beijing' =>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '106.3.132.71',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'changzhou'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '112.73.76.38',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'ningbo'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '112.73.72.212',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'shandong'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '112.244.20.4',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'shanghai'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '43.254.45.156',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'wuhan'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '116.211.131.5',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],*/
            'shenzhen'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '121.201.33.160',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'zhongshan'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '121.201.112.75',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            'foshan'=>[
                // 数据库类型
                'type' => 'mysql',
                // 数据库连接DSN配置
                'dsn' => '',
                'hostname' => '121.201.33.160',
                'username' => 'root',
                'password' => 'yhsj_idc@act',
                'database' => 'ucenter',
                'hostport' => '3306',
                // 数据库连接参数
                'params' => [],
                // 数据库编码默认采用utf8
                'charset' => 'utf8',
                // 数据库表前缀
                'prefix' => '',
            ],
            ];
//        var_dump($dbConfigarr);
//        exit;
        $dbConfig1 = [
            // 数据库类型
            'type' => 'mysql',
            // 数据库连接DSN配置
            'dsn' => '',
            // 服务器地址
            'hostname' => 'localhost',
            // 数据库名
            'database' => 'dvs',
            // 数据库用户名
            'username' => 'root',
            // 数据库密码
            'password' => 'root',
            // 数据库连接端口
            'hostport' => '3306',
            // 数据库连接参数
            'params' => [],
            // 数据库编码默认采用utf8
            'charset' => 'utf8',
            // 数据库表前缀
            'prefix' => '',
        ];
        $dbConfig2 = [
            // 数据库类型
            'type' => 'mysql',
            // 数据库连接DSN配置
            'dsn' => '',
            // 服务器地址
            'hostname' => '121.201.75.243',
            // 数据库名
            'database' => 'ibss',
            // 数据库用户名
            'username' => 'ibss',
            // 数据库密码
            'password' => '4DRHS62MGBJzLDep',
            // 数据库连接端口
            'hostport' => '3306',
            // 数据库连接参数
            'params' => [],
            // 数据库编码默认采用utf8
            'charset' => 'utf8',
            // 数据库表前缀
            'prefix' => '',
        ];
        $time = time();
        $logDir = LOG_PATH . 'crontab/';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755);
        }
        //筛选未过期且未完成的任务
        $crontabList = Crontab::where('status', '=', 'normal')->order('weigh desc,id desc')->select();
        $execTime = time();
        foreach ($crontabList as $crontab) {
            $update = [];
            $execute = FALSE;
            if ($time < $crontab['begintime']) {
                //任务未开始
                continue;
            }
            if ($crontab['maximums'] && $crontab['executes'] > $crontab['maximums']) {
                //任务已超过最大执行次数
                $update['status'] = 'completed';
            } else if ($crontab['endtime'] > 0 && $time > $crontab['endtime']) {
                //任务已过期
                $update['status'] = 'expired';
            } else {
                //重复执行
                //如果未到执行时间则继续循环
                $cron = CronExpression::factory($crontab['schedule']);
                if (!$cron->isDue(date("YmdHi", $execTime)) || date("YmdHi", $execTime) === date("YmdHi", $crontab['executetime']))
                    continue;
                $execute = TRUE;
            }

            // 如果允许执行
            if ($execute) {
                $update['executetime'] = $time;
                $update['executes'] = $crontab['executes'] + 1;
                $update['status'] = ($crontab['maximums'] > 0 && $update['executes'] >= $crontab['maximums']) ? 'completed' : 'normal';
            }

            // 如果需要更新状态
            if (!$update)
                continue;
            // 更新状态
            $crontab->save($update);

            // 将执行放在后面是为了避免超时导致多次执行
            if (!$execute)
                continue;
            try {
                if ($crontab['type'] == 'url') {
                    if (substr($crontab['content'], 0, 1) == "/") {
                        // 本地项目URL
                        exec('nohup php ' . ROOT_PATH . 'public/index.php ' . $crontab['content'] . ' >> ' . $logDir . date("Y-m-d") . '.log 2>&1 &');
                    } else {
                        // 远程异步调用URL
                        Http::sendAsyncRequest($crontab['content']);
                    }
                } else if ($crontab['type'] == 'sql') {
                    //这里需要强制重连数据库,使用已有的连接会报2014错误
                    $connect = Db::connect($dbConfig1, true);
                    $resultarr2=array();
                    if($crontab['weigh']==5){
                        $resultarr2=$connect->query($crontab['content']);
                        if(empty($resultarr2)){
                            echo 'finish';
                            continue;
                        }
                    }
                    //将处理好的数据插入fa_domain表（每天执行一次）
                    if(empty($resultarr2)&&$crontab['weigh'] == 24){

                            switch ($crontab['title']) {
                                case 'fa_domain':
                                    $dataarr=$connect->query($crontab['content']);
                                    $sum=count($dataarr);
                                    Db::startTrans();
                                    try {
                                    for ($i = 0; $i < $sum; $i++) {
                                        $connect->table('fa_domain')->insert($dataarr[$i], "IGNORE");
                                        if ($i % 10000 == 0) {
                                            Db::commit();
                                            Db::startTrans();
                                        }
                                    }
                                        Db::commit();
                                    } catch (\Exception $e) {
                                        Db::rollback();
                                        return \GuzzleHttp\json_encode($e->getMessage());
                                    }
                                    break;
                                case 'domain':
                                    $sdate = date('Y-m-d', strtotime('-1 day'));
                                    $stime = $sdate . " 00:00:00";
                                    $etime = $sdate . " 23:59:59";
                                    Db::close($connect);
                                    $dataarr=array();
                                    foreach ($dbConfigarr as $key=>$value){
                                        $connectx=Db::connect($value);
                                        $sql=$crontab['content']." WHERE a.lasttime>='" . $stime . "' AND a.lasttime<='" . $etime . "' ORDER BY a.lasttime desc";
                                        $dataarr[$key]=$connectx->query($sql);
                                        Db::close($connectx);
                                    }
                                    $connect = Db::connect($dbConfig1, true);
//                                    var_dump($dataarr);
//                                    exit;
                                    foreach ($dataarr as $kk=>$vv){
                                        $sum=count($vv);
                                        if($sum==0){
                                            continue;
                                        }
                                        Db::startTrans();
                                        try{
                                            for ($i = 0; $i < $sum; $i++) {
                                                $vv[$i]['service_code']=$kk;
                                                $vv[$i]['timeslot']=$sdate;
                                                //$vv[$i]['ping_ip']=gethostbyname($vv[$i]['domain']);
                                                $connect->table('domain')->insert($vv[$i]);
                                                if ($i % 10000 == 0) {
                                                    Db::commit();
                                                    Db::startTrans();
                                                }
                                            }
                                            Db::commit();
                                        } catch (\Exception $e) {
                                            Db::rollback();
                                            return \GuzzleHttp\json_encode($e->getMessage());
                                        }
                                        }

                                    break;
                                case 'temp':
                                    $connect->table('fa_ibss_temp')->execute("truncate table fa_ibss_temp");
                                    $connect2 = Db::connect($dbConfig2, true);
                                    $dataarr=$connect2->query($crontab['content']);
                                    $sum=count($dataarr);
                                    for ($i = 0; $i < $sum; $i++) {
                                        $connect->table('fa_ibss_temp')->insert($dataarr[$i]);
                                        if ($i % 10000 == 0) {
                                            Db::commit();
                                            Db::startTrans();
                                        }
                                    }
                                    break;
                                default:
                                    break;
                            }

                        if($crontab['title']=='fa_domain'){
                            $connect->table('domain')->where('status',1)->delete();
                        }
                        continue;
                    }
//                    var_dump($resultarr2);
//                    exit;

                    foreach ($resultarr2 as $oop=>$nnp){
                        $domarr=explode('.',$resultarr2[$oop]['ip']);
                        $wstr1=$domarr[0].'.'.$domarr[1].'.'.$domarr[2];
                        $ibssarr=$connect->query('SELECT customer_id,stockhouse_id,name 
                    FROM (select * from fa_ibss_temp WHERE `begin` LIKE "'.$wstr1.'%") tmp
                    WHERE SUBSTRING_INDEX(begin,".",-1)<='.$domarr[3].' AND SUBSTRING_INDEX(end,".",-1)>='.$domarr[3].';');


                        //取得指定位址的内容，并储存至text
                        //$resultarr2[0]['domain']='baidu.com';
                        //$ping=gethostbyname($resultarr2[0]['subdomain']);
                        $strip=$resultarr2[$oop]['subdomain'];
                        $ping=gethostbyname($strip);
                        $text=$this->curl_file_get_contents('http://icp.chinaz.com/psorgan/'.$resultarr2[$oop]['domain']);
                        $preg='#<div class="govmain">.*</div>#isU';
                        //去除换行及空白字元（序列化内容才需使用）
                        //$text=str_replace(array("r","n","t","s"), '', $text);
                        //取出div的内容，并储存至阵列$result
                        preg_match($preg,$text,$result);
                        if(!empty($result)){
                            $connect->table('domain')->where('id',$resultarr2[$oop]['id'])->update(['psorgan'=>1,'status'=>1,'ping_ip'=>$ping,'customer_id'=>$ibssarr[0]['customer_id'],'engineroom_id'=>$ibssarr[0]['stockhouse_id'],'engineroom_name'=>$ibssarr[0]['name']]);
                        }else{
                            $connect->table('domain')->where('id',$resultarr2[$oop]['id'])->update(['status'=>1,'ping_ip'=>$ping,'customer_id'=>$ibssarr[0]['customer_id'],'engineroom_id'=>$ibssarr[0]['stockhouse_id'],'engineroom_name'=>$ibssarr[0]['name']]);
                        }
                    }

                    //印出match[0]
                } else if ($crontab['type'] == 'shell') {
                    // 执行Shell
                    exec($crontab['content'] . ' >> ' . $logDir . date("Y-m-d") . '.log 2>&1 &');
                }
            } catch (Exception $e) {
                Log::record($e->getMessage());
            }
        }
        return 'Execute completed!' . "\r\n" . date("h:i:sa") . "\r\n";
    }
    public function curl_file_get_contents($durl){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $contents=curl_exec($ch);
        curl_close($ch);

        return $contents;

    }

}
