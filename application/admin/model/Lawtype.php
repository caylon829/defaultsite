<?php

namespace app\admin\model;

use think\Model;

class Lawtype extends Model
{
    // 表名
    protected $name = 'lawtype';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'automatch_switch_text'
    ];
    

    
    public function getAutomatchSwitchList()
    {
        return ['0' => __('Automatch_switch 0'),'1' => __('Automatch_switch 1')];
    }     


    public function getAutomatchSwitchTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['automatch_switch']) ? $data['automatch_switch'] : '');
        $list = $this->getAutomatchSwitchList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
