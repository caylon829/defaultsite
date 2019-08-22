<?php

namespace app\admin\model;

use think\Model;
use stdClass;

class Domain extends Model
{
    // 表名
    protected $name = 'domain';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'icpstatus_text',
        'status_text'
    ];

    public function getIcpstatusList()
    {
        return ['0' => __('Icpstatus 0'),'1' => __('Icpstatus 1'),'2' => __('Icpstatus 2')];
    }

    public function getPsorganList()
    {
        return ['0' => __('Psorgan 0'),'1' => __('Psorgan 1')];
    }

    public function getStatusList()
    {
        return ['0' => __('Status_0'),'1' => __('Status_1'),'2' => __('Status_2')];
    }
    public function getLawtypeList()
    {
        return ['0' => __('Lawtype_0'),'1' => __('Lawtype_1')];
    }

    public function getStateList()
    {
        return ['0' => __('State_0'),'1' => __('State_1')];
    }


    public function getIcpstatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['icpstatus']) ? $data['icpstatus'] : '');
        $list = $this->getIcpstatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }





    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getList()
    {
        $result = [];
        $list = $this->field('id,domain')->where('lasttime>="'.date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'))).'"')->select();

        foreach ($list as $v) {
            $result[$v['id']] = $v['domain'];
        }
        return $result;
    }



}
