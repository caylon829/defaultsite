<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 工单监控
 *
 * @icon fa fa-circle-o
 */
class Wlist extends Backend
{
    
    /**
     * Wlist模型对象
     * @var \app\admin\model\Wlist
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Wlist;
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 日志
     */
    public function log()
    {
        $starttime=date('Y-01-01 00:00:00');
        $endtime=date('Y-m-d 23:59:59');
        if($this->request->request()){
            if($this->request->isPost()){
                $arrtime=$this->request->post('row/a');
            }
            if($this->request->isGet()){
                $arrtime['start_date']=$this->request->get('start_date');
                $arrtime['end_date']=$this->request->get('end_date');
            }
            $starttime=$arrtime['start_date']?$arrtime['start_date']:date('Y-01-01 00:00:00');
            $endtime=$arrtime['end_date']?$arrtime['end_date']:date('Y-m-d 23:59:59');
            $where="wlist_createtime>='$starttime' and wlist_createtime<='$endtime'";
        }else{
            $where="wlist_createtime>='".date('Y-01-01 00:00:00')."' and wlist_createtime<='".date('Y-m-d 23:59:59')."'";
        }
//        $result=$this->model->query('select visit_unit,count(id) as times,sum(visit_num) as num from fa_idc_engineroomvisit_log where '.$where.' group by visit_unit');
//        $count = count($result);
        $list = Db::table('fa_wlist_log')->where($where)->paginate(20,false,['query' => ['start_date'=>$starttime,'end_date'=>$endtime]]);

        //var_dump($list);
        $this->view->assign('row',$list);
        //$this->view->assign('row',$result);
        $this->view->assign('starttime',$starttime);
        $this->view->assign('endtime',$endtime);
        //$this->assign('result',$result);

        return $this->fetch('log');
    }

    /**
     * 编辑
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        $jsonresult=\GuzzleHttp\json_decode($row['json'],true);
        $domain=Db::table('fa_domain')->field('domain')->where('id='.$row['domain_id'])->find();
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
//            var_dump($params);
//            exit;
            if ($params) {
                $params = $this->preExcludeFields($params);
                if($params['status']==1){

                    $domainid=array_shift($jsonresult);

                    Db::table('fa_domain')->where('id='.$domainid)->update($jsonresult);
                }
                $params['updatetime']=date('Y-m-d H:i:s');
                $result=Db::table('fa_wlist_log')->insert($params);
                Db::table('fa_wlist')->where('id='.$ids)->delete();
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        $this->view->assign("json", $jsonresult);
        $this->view->assign("domain", $domain['domain']);
        return $this->view->fetch();
    }
    

}
