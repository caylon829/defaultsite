<?php
namespace addons\crontab\controller;
use think\Controller;
use think\Db;
//ʵ�ֶ��̱߳���̳�Thread��
class Proxy extends Controller
{
    /**
     * ��ʼ������,��ǰ��ʼ��ִ��
     */
    public function _initialize()
    {
        // ֻ������cli��ʽִ��
//        if (!$this->request->isCli())
//            $this->error('Autotask script only work at client!');

        parent::_initialize();

        // �������
        error_reporting(0);

        // ����������ʱ
        set_time_limit(0);
    }

    /**
     * ִ�ж�ʱ����
     */
    public function index()
    {

    }

    public function run($i)
    {
        $host = $_SERVER['HTTP_HOST'];
        $port = 80;

        $fp = stream_socket_client('http://icp.chinaz.com/psorgan/' . $i, $errno, $errstr, 3);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            fwrite($fp, "GET / HTTP/1.0\r\nHost: www.example.com\r\nAccept: */*\r\n\r\n");
            while (!feof($fp)) {
                echo fgets($fp, 1024);
            }
            fclose($fp);
        }
    }

    public function doRequest($url, $param = array(), $timeout = 10)
    {
        $urlParmas = parse_url($url);
        $host = $urlParmas['host'];
        $path = $urlParmas['path'];
        $port = isset($urlParmas['port']) ? $urlParmas['port'] : 80;
        $errno = 0;
        $errstr = '';
        $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
        $query = isset($param) ? http_build_query($param) : '';
        $out = "POST " . $path . " HTTP/1.1\r\n";
        $out .= "host:" . $host . "\r\n";
        $out .= "content-length:" . strlen($query) . "\r\n";
        $out .= "content-type:application/x-www-form-urlencoded\r\n";
        $out .= "connection:close\r\n\r\n";
        $out .= $query;
        fputs($fp, $out);
        fclose($fp);
    }
    public function dowork(){
        $url = 'http://www.example.com/do.php';
        $param = array(
            'name'=>'ityangs',
            'job'=>'PHP Programmer'
        );
       $this-> doRequest($url, $param);
    }
}
?>