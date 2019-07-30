<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 检测文件
 *
 * @icon fa fa-circle-o
 */
class Checkfile extends Backend
{
    protected $noNeedRight = ['check', 'checkother'];
    //图片
    public function check(){
        $result=$this->request->post('row/a');
        foreach ($result as $key=>$value){
            $result['image']=$value;
        }
        $file=explode('.',$result['image']);
        $temp=end($file);


        $arr=array("jpg","png","gif","bmp","jpeg");
        if(in_array($temp,$arr)){
            $this->success();
        }else{
            $this->error($temp."图片文件无效，请重新选择或上传");
        }

    }
    //其他多种类型文件
    public function checkother(){
        $result=$this->request->post('row/a');
        $file=explode('.',$result['uploadurl']);
        $temp=end($file);


        $arr=array("jpg","png","gif","bmp","jpeg","zip","rar","xls","xlsx","doc","docx");
        if(in_array($temp,$arr)){
            $this->success();
        }else{
            $this->error($temp."文件格式无效，请重新选择或上传");
        }

    }
}

