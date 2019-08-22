<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use fast\Random;
use PHPExcel_IOFactory;
use PHPExcel;
use PHPExcel_Shared_Date;
use PHPExcel_Style;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;

/**
 * 域名处理信息管理
 *
 * @icon fa fa-circle-o
 */
class Domain extends Backend
{
    
    /**
     * Domain模型对象
     * @var \app\admin\model\Domain
     */
    protected $model = null;
    protected $noNeedRight=['resolve'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Domain;
        $this->view->assign("icpstatusList", $this->model->getIcpstatusList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("stateList", $this->model->getStateList());
        $this->view->assign("psorganList", $this->model->getPsorganList());
        $this->view->assign("lawtypeList", $this->model->getLawtypeList());
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */



    /**
     * 后台首页
     */
    public function main()
    {
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
//        var_dump($this->auth->getUserInfo());
////        exit;
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
            if ($params) {
                $params['operator']=$this->auth->id;
                $params['operatorname']=$this->auth->nickname;

                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($row->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                } catch (\think\Exception $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("url", $url);
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    public function resolve($ids = NULL){
        $row = $this->model->get(['id' => $ids]);
//        var_dump($pid);
//        exit;

        if (!$row)
            $this->error(__('No Results were found'));
        if ($this->request->isAjax()) {
            $ip=gethostbyname($row['subdomain']);
            Db::table('fa_domain')->where('id='.$ids)->update(['ping_ip'=>$ip]);
            //$this->model->where($where)->update($data);
            $this->success("IP解析成功", null, ['id' => $ids]);
        }else{
            $this->error('网络错误');
        }

    }

    /**
     * 导出
     */

    public function export()
    {
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.IOFactory");
        vendor("PHPExcel.PHPExcel.Shared_Date");
        vendor("PHPExcel.PHPExcel.Style");
        vendor("PHPExcel.PHPExcel.Style.Alignment");
        vendor("PHPExcel.PHPExcel.Style.Border");
        vendor("PHPExcel.PHPExcel.Style.Fill");
        vendor("PHPExcel.PHPExcel.NumberFormat");
            set_time_limit(15);
            $datawhere=$this->request->request();
//            var_dump($datawhere);
//            exit;
            $starttime=date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y')));

            $endtime=date('Y-m-d H:i:s',mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y')));
$where='1';
        if(!empty($datawhere['stime'])){
            $starttime=substr($datawhere['stime'],0,19);
            $endtime=substr($datawhere['stime'],-19,19);
            $where=" lasttime>='$starttime' and lasttime<='$endtime' ";
        }else{
            $where=" lasttime>='$starttime' and lasttime<='$endtime' ";
        }
        if(!empty($datawhere['ip'])){
            $where.="and ip LIKE '%".$datawhere['ip']."%'";
        }

//            var_dump($starttime);
//            var_dump($endtime);
//            exit;

            $excel = new PHPExcel();

            $excel->getProperties()
                ->setCreator("双备案核查")
                ->setLastModifiedBy("双备案核查")
                ->setTitle("双备案核查")
                ->setSubject("导出");
            $excel->getDefaultStyle()->getFont()->setName('Microsoft Yahei');
            $excel->getDefaultStyle()->getFont()->setSize(12);

            $this->sharedStyle = new PHPExcel_Style();
            $this->sharedStyle->applyFromArray(
                array(
                    'fill'      => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '000000')
                    ),
                    'font'      => array(
                        'color' => array('rgb' => "000000"),
                    ),
                    'alignment' => array(
                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'indent'     => 1
                    ),
                    'borders'   => array(
                        'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                    )
                ));

            $worksheet = $excel->setActiveSheetIndex(0);
            $worksheet->setTitle('域名处理');


            //0申请，1申请成功，2已进入，3已离开，4登记完成，5申请已撤销
            $str=[
                'domain'  =>  '顶级域名',
                'subdomain'  =>  '接入域名',
                'redirecturl'  =>  '跳转地址',
                'ip'  =>  '节点IP',
                'ping_ip'  =>  '解析IP',
                'icpstatus'  =>  'ICP备案状态',
                'icpstatus_0'  =>  '审核中',
                'icpstatus_1'  =>  '未备案',
                'icpstatus_2'  =>  '已备案',
                'psorgan'  =>  '公安备案状态',
                'psorgan_1'  =>  '是',
                'psorgan_0'  =>  '否',
                'service_code'=>'域名节点',
                'customer_id'=>'客户ID',
                'engineroom_name'=>'机房',
                'lasttime'=>'活跃时间',
                'status'=>'公安备案人工状态',
                'status_0'=>'已提交',
                'status_1'=>'已备案',
                'status_2'=>'拉黑',
                'state'=>'封阻状态',
                'state_0'=>'白名单',
                'state_1'=>'黑名单',
                'lawtype'=>'存在非法',
                'lawtype_0'=>'否',
                'lawtype_1'=>'是',
                'note'=>'备注'
                ];
            $resultarr=Db::table('fa_domain')->query('select domain,subdomain,ip,ping_ip,lasttime,icpstatus,service_code,customer_id,engineroom_name,psorgan,status,state,lawtype,note from fa_domain where '.$where);

            if(empty($resultarr)){
                $this->error('无数据，请重新选择筛选条件');
            }
            if(count($resultarr)>1000){
                $this->error('数据过大，请重新选择筛选条件');
            }
            foreach ($resultarr as $key=> $value){
                $resultarr[$key]['icpstatus']=$str['icpstatus_'.$value['icpstatus']];
                $resultarr[$key]['psorgan']=$str['psorgan_'.$value['psorgan']];
                $resultarr[$key]['status']=$str['status_'.$value['status']];
                $resultarr[$key]['state']=$str['state_'.$value['state']];
                $resultarr[$key]['lawtype']=$str['lawtype_'.$value['state']];

            }

        $list=$resultarr;
//            var_dump($resultarr);
//            exit;
            $line = 1;
            //$list = ['0'=>['admin_id'=>1,'id'=>12,'idc_sign'=>'test'],'1'=>['admin_id'=>1,'id'=>12,'idc_sign'=>'test'],'2'=>['admin_id'=>1,'id'=>12,'idc_sign'=>'test']];
            $styleArray = array(
                'font' => array(
                    'bold'  => false,
                    'color' => array('rgb' => '000000'),
                    'size'  => 12,
                    'name'  => 'Verdana'
                ));
            $list = $items = collection($list)->toArray();
            foreach ($items as $index => $item) {
                $line++;
                $col = 0;
                foreach ($item as $field => $value) {

                    $worksheet->setCellValueByColumnAndRow($col, $line, $value);
                    $worksheet->getStyleByColumnAndRow($col, $line)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    $worksheet->getCellByColumnAndRow($col, $line)->getStyle()->applyFromArray($styleArray);
                    $col++;
                }
            }

            $first = array_keys(reset($list));
            foreach ($first as $index => $item) {
                $worksheet->setCellValueByColumnAndRow($index, 1, $str[$item]);
            }

            $excel->createSheet();
            // Redirect output to a client’s web browser (Excel2007)
            $title = date("YmdHis").Random::alnum(6);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $objWriter->save('php://output');
            return 'success';
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
        $filter = (array)json_decode($filter, true);
        $op = (array)json_decode($op, true);
        $filter = $filter ? $filter : [];
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
