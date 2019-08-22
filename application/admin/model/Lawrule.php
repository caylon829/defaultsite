<?php

namespace app\admin\model;

use think\Model;
use stdClass;

class Lawrule extends Model
{
    // 表名
    protected $name = 'lawrule';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'lawtype_text',
        'state_switch_text'
    ];

    public function getLawtypeList()
    {
        $result = [];
        $mode = new Lawtype();
        $list = $mode->select();
        foreach($list as $v){
            $result[$v['id']] = $v['name'];
        }
        return $result;
    }

    public function getStateSwitchList()
    {
        return ['0' => __('State_switch 0'),'1' => __('State_switch 1')];
    }     


    public function getLawtypeTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['lawtype']) ? $data['lawtype'] : '');
        $list = $this->getLawtypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStateSwitchTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['state_switch']) ? $data['state_switch'] : '');
        $list = $this->getStateSwitchList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
