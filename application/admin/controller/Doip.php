<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 跳转核查IP管理
 *
 * @icon fa fa-circle-o
 */
class Doip extends Backend
{
    
    /**
     * Doip模型对象
     * @var \app\admin\model\Doip
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Domain;

        $this->view->assign("icpstatusList", $this->model->getIcpstatusList());
        $this->view->assign("psorganList", $this->model->getPsorganList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("lawtypeList", $this->model->getLawtypeList());
        $this->view->assign("stateList", $this->model->getStateList());

    }

    public function detail(){
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {

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

            //echo $this->model->getLastSql();

            $list = collection($list)->toArray();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

        return $this->view->fetch();
    }

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {

            $domainModel = new \app\admin\model\Domain;

            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            //print_r($where);

            $filter = $this->request->get("filter", '');
            $filter = (array)json_decode($filter, TRUE);

            /*if( !isset($filter['timeslot']) || !isset($filter['service_code']) ){

                $result = array("total" => 0, "rows" => []);
                return json($result);
            }*/
//            var_dump($filter['lasttime']);
//            exit;
            /*if( !isset($filter['lasttime'])){

                $result = array("total" => 0, "rows" => []);
                return json($result);
            }*/
            $total = $this->model
                ->where($where)
                ->group('ip')
                ->order($sort, $order)
                ->count();

            $list = $domainModel->field('ip, service_code, count(id) as subdomain, timeslot,lasttime')
                ->where($where)
                ->group('ip')
                ->order('subdomain', 'desc')
                ->limit($offset, $limit)
                ->select();
            $list = collection($list)->toArray();

            $ipArr = [];
            foreach($list as $v){
                $ipArr[] = $v['ip'];
            }

            $list2 = $domainModel->field('ip, count(id) as domain')
                ->where($where)
                ->whereIn('ip',$ipArr)
                ->group('ip,domain')
                ->select();

            $list2 = collection($list2)->toArray();
            $iplist = [];
            foreach($list2 as $v){
                $iplist[$v['ip']] = $v['domain'];
            }
            foreach($list as $k=>$v){
                $list[$k]['domain'] = $iplist[$v['ip']];
            }
            $result = array("total" => $total, "rows" => $list);
            return json($result);
        }


        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function editext($ids = NULL)
    {
        $url = $this->request->param("url");
        $row = $this->model->get($ids);
        $url = $url ? $url : $row['domain'];
        if (!$row)
            $this->error(__('No Results were found'));
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
                $userInfo = $this->auth->getUserInfo();
                $opp['operator'] = $userInfo['id'];
                $opp['operatorname'] = $userInfo['username'];
                $this->model->isUpdate(true)->save($opp, ['id'=>$ids]);
                $data['domain_id']=$params['domain_id'];
                $data['domain']=$url;
                $data['type']=$params['state'];
                $data['wlist_creator']=$userInfo['username'];
                $data['wlist_createtime']=date("Y-m-d H:i:s");
                $data['json']=\GuzzleHttp\json_encode($params);
                $wlistModel = new \app\admin\model\Wlist();
                $re=$wlistModel->isUpdate(true)->insert($data,'IGNORE');
//                var_dump($re);
//                exit;
                if($re==1){
                    $this->success();
                }else{
                    $this->error('该域名正在审核中,请查看工单监控');
                }

            }
        }
        $this->view->assign("row", $row);
        $this->view->assign("url", $url);
        return $this->view->fetch();
    }

    /**
     * 批量修改
     */
    public function editall($ip)
    {
        $ip = $ip ? $ip : $this->request->param("ip");
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            $params['operator']=$this->auth->id;
            $params['operatorname']=$this->auth->nickname;
            $this->model->isUpdate(true)->save($params, ['ip'=>$ip]);
            $this->success();
        }
        $this->view->assign("ip", $ip);
        return $this->fetch();
    }

    /**
     * 生成查询所需要的条件,排序方式
     * @param mixed   $searchfields   快速查询的字段
     * @param boolean $relationSearch 是否关联查询
     * @return array
     */
    protected function buildparams($searchfields = null, $relationSearch = null)
    {
        $searchfields = is_null($searchfields) ? $this->searchFields : $searchfields;
        $relationSearch = is_null($relationSearch) ? $this->relationSearch : $relationSearch;
        $search = $this->request->get("search", '');
        $filter = $this->request->get("filter", '');
        $op = $this->request->get("op", '', 'trim');
        $sort = $this->request->get("sort", !empty($this->model) && $this->model->getPk() ? $this->model->getPk() : 'id');
        $order = $this->request->get("order", "DESC");
        $offset = $this->request->get("offset", 0);
        $limit = $this->request->get("limit", 0);
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
//        var_dump(date("Y-m-d H:i:s",$beginLastweek));
//        exit;
        $startdate=date("Y-m-d H:i:s",$beginLastweek);
        $enddate=date("Y-m-d H:i:s",$endLastweek);
        $filter = (array)json_decode($filter, true);
        $op = (array)json_decode($op, true);
        $filter = $filter ? $filter : ["lasttime"=>"$startdate - $enddate"];
        $op=$op?$op:["lasttime"=>"RANGE"];
//        var_dump($op);
//        exit;
        $where = [];
        $tableName = '';
        if ($relationSearch) {
            if (!empty($this->model)) {
                $name = \think\Loader::parseName(basename(str_replace('\\', '/', get_class($this->model))));
                $tableName = $name . '.';
            }
            $sortArr = explode(',', $sort);
            foreach ($sortArr as $index => & $item) {
                $item = stripos($item, ".") === false ? $tableName . trim($item) : $item;
            }
            unset($item);
            $sort = implode(',', $sortArr);
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            $where[] = [$tableName . $this->dataLimitField, 'in', $adminIds];
        }
        if ($search) {
            $searcharr = is_array($searchfields) ? $searchfields : explode(',', $searchfields);
            foreach ($searcharr as $k => &$v) {
                $v = stripos($v, ".") === false ? $tableName . $v : $v;
            }
            unset($v);
            $where[] = [implode("|", $searcharr), "LIKE", "%{$search}%"];
        }
        foreach ($filter as $k => $v) {
            $sym = isset($op[$k]) ? $op[$k] : '=';
            if (stripos($k, ".") === false) {
                $k = $tableName . $k;
            }
            $v = !is_array($v) ? trim($v) : $v;
            $sym = strtoupper(isset($op[$k]) ? $op[$k] : $sym);
            switch ($sym) {
                case '=':
                case '<>':
                    $where[] = [$k, $sym, (string)$v];
                    break;
                case 'LIKE':
                case 'NOT LIKE':
                case 'LIKE %...%':
                case 'NOT LIKE %...%':
                    $where[] = [$k, trim(str_replace('%...%', '', $sym)), "%{$v}%"];
                    break;
                case '>':
                case '>=':
                case '<':
                case '<=':
                    $where[] = [$k, $sym, (string)$v];
                    break;
                case 'FINDIN':
                case 'FINDINSET':
                case 'FIND_IN_SET':
                    $where[] = "FIND_IN_SET('{$v}', " . ($relationSearch ? $k : '`' . str_replace('.', '`.`', $k) . '`') . ")";
                    break;
                case 'IN':
                case 'IN(...)':
                case 'NOT IN':
                case 'NOT IN(...)':
                    $where[] = [$k, str_replace('(...)', '', $sym), is_array($v) ? $v : explode(',', $v)];
                    break;
                case 'BETWEEN':
                case 'NOT BETWEEN':
                    $arr = array_slice(explode(',', $v), 0, 2);
                    if (stripos($v, ',') === false || !array_filter($arr)) {
                        continue 2;
                    }
                    //当出现一边为空时改变操作符
                    if ($arr[0] === '') {
                        $sym = $sym == 'BETWEEN' ? '<=' : '>';
                        $arr = $arr[1];
                    } elseif ($arr[1] === '') {
                        $sym = $sym == 'BETWEEN' ? '>=' : '<';
                        $arr = $arr[0];
                    }
                    $where[] = [$k, $sym, $arr];
                    break;
                case 'RANGE':
                case 'NOT RANGE':
                    $v = str_replace(' - ', ',', $v);
                    $arr = array_slice(explode(',', $v), 0, 2);
                    if (stripos($v, ',') === false || !array_filter($arr)) {
                        continue 2;
                    }
                    //当出现一边为空时改变操作符
                    if ($arr[0] === '') {
                        $sym = $sym == 'RANGE' ? '<=' : '>';
                        $arr = $arr[1];
                    } elseif ($arr[1] === '') {
                        $sym = $sym == 'RANGE' ? '>=' : '<';
                        $arr = $arr[0];
                    }
                    $where[] = [$k, str_replace('RANGE', 'BETWEEN', $sym) . ' time', $arr];
                    break;
                case 'LIKE':
                case 'LIKE %...%':
                    $where[] = [$k, 'LIKE', "%{$v}%"];
                    break;
                case 'NULL':
                case 'IS NULL':
                case 'NOT NULL':
                case 'IS NOT NULL':
                    $where[] = [$k, strtolower(str_replace('IS ', '', $sym))];
                    break;
                default:
                    break;
            }
        }
        $where = function ($query) use ($where) {
            foreach ($where as $k => $v) {
                if (is_array($v)) {
                    call_user_func_array([$query, 'where'], $v);
                } else {
                    $query->where($v);
                }
            }
        };
        return [$where, $sort, $order, $offset, $limit];
    }
}
