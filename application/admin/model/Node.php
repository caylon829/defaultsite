<?php

namespace app\admin\model;

use think\Model;

class Node extends Model
{
    // 表名
    protected $name = 'node';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];

    protected function getDbPwdAttr($value = '', $data = []){
        //$pwd = $this->decrypt($data['db_pwd'], '123456789');
        //return $pwd;
        return '**********';
    }

    protected function setDbPwdAttr($value = '', $data = []){
        if($value == '**********'){
            $pwd = $this->where('id','=',$data['id'])->value('db_pwd');
        }else{
            $pwd = $this->encrypt($data['db_pwd'], '123456789');
        }
        return $pwd;
    }

    /**
     * @desc加密
     * @param string $str 待加密字符串
     * @param string $key 密钥
     * @return string
     */
    private function encrypt($str, $key){
        $mixStr = md5(date('Y-m-d H:i:s').rand(1, 1000));
        $tmp = '';
        $strLen = strlen($str);
        for($i=0, $j=0; $i<$strLen; $i++, $j++){
            $j = $j == 32 ? 0 : $j;
            $tmp .= $mixStr[$j].($str[$i] ^ $mixStr[$j]);
        }
        return base64_encode($this->bind_key($tmp, $key));
    }

    /**
     * @desc解密
     * @param string $str 待解密字符串
     * @param string $key 密钥
     * @return string
     */
    private function decrypt($str, $key){
        $str = $this->bind_key(base64_decode($str), $key);
        $strLen = strlen($str);
        $tmp = '';
        for($i=0; $i<$strLen; $i++){
            $tmp .= $str[$i] ^ $str[++$i];
        }
        return $tmp;
    }

    /**
     * @desc辅助方法 用密钥对随机化操作后的字符串进行处理
     * @param $str
     * @param $key
     * @return string
     */
    private function bind_key($str, $key){
        $encrypt_key = md5($key);

        $tmp = '';
        $strLen = strlen($str);
        for($i=0, $j=0; $i<$strLen; $i++, $j++){
            $j = $j == 32 ? 0 : $j;
            $tmp .= $str[$i] ^ $encrypt_key[$j];
        }
        return $tmp;
    }
}
