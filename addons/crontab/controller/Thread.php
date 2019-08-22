<?php
namespace addons\crontab\controller;
use think\Db;
//ʵ�ֶ��̱߳���̳�Thread��
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
            // ���ݿ�����
            'type' => 'mysql',
            // ���ݿ�����DSN����
            'dsn' => '',
            // ��������ַ
            'hostname' => 'localhost',
            // ���ݿ���
            'database' => 'dvs',
            // ���ݿ��û���
            'username' => 'root',
            // ���ݿ�����
            'password' => 'root',
            // ���ݿ����Ӷ˿�
            'hostport' => '3306',
            // ���ݿ����Ӳ���
            'params' => [],
            // ���ݿ����Ĭ�ϲ���utf8
            'charset' => 'utf8',
            // ���ݿ��ǰ׺
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

            //ȡ��ָ��λַ�����ݣ���������text
            //$resultarr2[0]['domain']='baidu.com';
            //$ping=gethostbyname($resultarr2[0]['subdomain']);
            $strip=$temparr[$oop]['subdomain'];
            $ping=gethostbyname($strip);
            //$text=file_get_contents('http://icp.chinaz.com/psorgan/'.$temparr[$oop]['domain']);
            $text=$this->curl_file_get_contents('http://icp.chinaz.com/psorgan/'.$temparr[$oop]['domain']);
            $preg='#<div class="govmain">.*</div>#isU';
            //ȥ�����м��հ���Ԫ�����л����ݲ���ʹ�ã�
            //$text=str_replace(array("r","n","t","s"), '', $text);
            //ȡ��div�����ݣ�������������$result
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
            // ���ݿ�����
            'type' => 'mysql',
            // ���ݿ�����DSN����
            'dsn' => '',
            // ��������ַ
            'hostname' => 'localhost',
            // ���ݿ���
            'database' => 'dvs',
            // ���ݿ��û���
            'username' => 'root',
            // ���ݿ�����
            'password' => 'root',
            // ���ݿ����Ӷ˿�
            'hostport' => '3306',
            // ���ݿ����Ӳ���
            'params' => [],
            // ���ݿ����Ĭ�ϲ���utf8
            'charset' => 'utf8',
            // ���ݿ��ǰ׺
            'prefix' => '',
        ];

        $sum=200;//ÿ�δ�����������Ĭ��200

        $less=Db::table('domain')->where('status=0')->count();//ʣ����
        if($less==0){
            return 1;
        }else if($less<200){
            $sum=$less;
        }
//        echo $sum;
//        exit;
        $threadNum = 100;//��������
        $setp = $sum / $threadNum;


        $connect = Db::connect($dbConfig1, true);
        //��ȡ��Ҫ���������
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