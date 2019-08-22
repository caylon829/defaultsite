<?php
namespace addons\crontab\controller;
use think\Db;
//实现多线程必须继承Thread类
class Thread extends \Thread {
    public $name = '';
    private $total = array();
    private $startNum = array();
    private $endNum = array();

    public function __construct($name, $startNum=array(), $endNum=array()){
        $this->name = $name;
        $this->startNum = $startNum;
        $this->endNum = $endNum;
    }
    public function run(){

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

        $connect = Db::connect($dbConfig1, true);
//        var_dump($connect2);
//        var_dump($connect);
//        exit;


        /*var_dump($this->startNum);
        exit;*/
        $temparr=$this->startNum;
        $sql=array();
        foreach ($temparr as $oop=>$nnp){
            $domarr=explode('.',$temparr[$oop]['ip']);
            $wstr1=$domarr[0].'.'.$domarr[1].'.'.$domarr[2];
            $ibssarr=$connect->query('SELECT customer_id,stockhouse_id,name 
                    FROM (select * from fa_ibss_temp WHERE `begin` LIKE "'.$wstr1.'%") tmp
                    WHERE SUBSTRING_INDEX(begin,".",-1)<='.$domarr[3].' AND SUBSTRING_INDEX(end,".",-1)>='.$domarr[3].';');

            //取得指定位址的内容，并储存至text
            //$resultarr2[0]['domain']='baidu.com';
            //$ping=gethostbyname($resultarr2[0]['subdomain']);
            $strip=$temparr[$oop]['subdomain'];
            $ping=gethostbyname($strip);
            //$text=file_get_contents('http://icp.chinaz.com/psorgan/'.$temparr[$oop]['domain']);
            $text=$this->curl_file_get_contents('http://icp.chinaz.com/psorgan/'.$temparr[$oop]['domain']);
            $preg='#<div class="govmain">.*</div>#isU';
            //去除换行及空白字元（序列化内容才需使用）
            //$text=str_replace(array("r","n","t","s"), '', $text);
            //取出div的内容，并储存至阵列$result
            preg_match($preg,$text,$result);

//            var_dump($result);
//            exit;

            if(!empty($result)){
                $sql[]="update domain set psorgan=1,status=1,ping_ip='".$ping."',customer_id='".$ibssarr[0]['customer_id']."',engineroom_id='".$ibssarr[0]['stockhouse_id']."',engineroom_name='".$ibssarr[0]['name']."' where id=".$temparr[$oop]['id'];
                //$connect->table('domain')->where('id',$temparr[$oop]['id'])->update(['psorgan'=>1,'status'=>1,'ping_ip'=>$ping,'customer_id'=>$ibssarr[0]['Custom_ID'],'engineroom_id'=>$ibssarr[0]['StockHouse_ID'],'engineroom_name'=>$ibssarr[0]['Name']]);
            }else{
                //$ksdf=$connect->table('domain')->select();
                $sql[]="update domain set status=1,ping_ip='".$ping."',customer_id='".$ibssarr[0]['customer_id']."',engineroom_id='".$ibssarr[0]['stockhouse_id']."',engineroom_name='".$ibssarr[0]['name']."' where id=".$temparr[$oop]['id'];
            }
//            var_dump($sql);
//            exit;
        }
        // Db::close($connect2);
        $this->total=$sql;
//        for($ix = $this->startNum; $ix < $this->endNum; ++$ix) {
//            $this->total += $ix;
//        }
//        echo "Thread {$this->name} total: {$this->total} \r\n";
    }
    public function getTotal() {
        return $this->total;
    }

    public function index(){
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

        $sum=200;//每次处理数据量，默认200

        $less=Db::table('domain')->where('status=0')->count();//剩余数
        if($less==0){
            return 1;
        }else if($less<200){
            $sum=$less;
        }
//        echo $sum;
//        exit;
        $threadNum = 100;//进程数量
        $setp = $sum / $threadNum;


        $connect = Db::connect($dbConfig1, true);
        //获取需要处理的数据
        $temparr=$connect->query('SELECT id,subdomain,domain,ip FROM domain WHERE status=0 limit 200;');
        $tempss=array();
        $keys=0;
        for($ix = 0; $ix < $threadNum; ++$ix) {
            for($iix = 0; $iix < $setp; ++$iix) {
                $key=$keys*$setp+$iix;
                $tempss[$ix][]=$temparr[$key];
            }
            $keys++;
        }


        for($ix = 0; $ix < $threadNum; ++$ix) {


            $thread = new Proxy($ix, $tempss[$ix], []);
            $thread->start();
            $threads[] = $thread;
        }


        $total = array();
        foreach($threads as $thread) {
            $thread->join();
            $total[]= $thread->getTotal();
        }

        foreach ($total as $key=>$value){
            foreach ($value as $tsql){
                $connect->query($tsql);
            }
        }

        echo "success \r\n";
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
?>