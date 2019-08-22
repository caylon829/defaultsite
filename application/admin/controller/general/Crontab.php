<?php

namespace app\admin\controller\general;

use app\common\controller\Backend;
use app\admin\library\Auth;
use Cron\CronExpression;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use think\Exception;
use think\exception\PDOException;
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
 * 定时任务
 *
 * @icon fa fa-tasks
 * @remark 类似于Linux的Crontab定时任务,可以按照设定的时间进行任务的执行,目前仅支持三种任务:请求URL、执行SQL、执行Shell
 */
class Crontab extends Backend
{

    protected $model = null;
    protected $noNeedRight = ['check_schedule', 'get_schedule_future'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Crontab');
        $this->view->assign('typedata', \app\common\model\Crontab::getTypeList());
    }

    /**
     * 查看
     */
    public function index()
    {
        if ($this->request->isAjax())
        {
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
            foreach ($list as $k => &$v)
            {
                $cron = CronExpression::factory($v['schedule']);
                $v['nexttime'] = $cron->getNextRunDate()->getTimestamp();
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 判断Crontab格式是否正确
     * @internal
     */
    public function check_schedule()
    {
        $row = $this->request->post("row/a");
        $schedule = isset($row['schedule']) ? $row['schedule'] : '';
        if (CronExpression::isValidExpression($schedule))
        {
            $this->success();
        }
        else
        {
            $this->error(__('Crontab format invalid'));
        }
    }

    /**
     * 根据Crontab表达式读取未来七次的时间
     * @internal
     */
    public function get_schedule_future()
    {
        $time = [];
        $schedule = $this->request->post('schedule');
        $days = (int) $this->request->post('days');
        try
        {
            $cron = CronExpression::factory($schedule);
            for ($i = 0; $i < $days; $i++)
            {
                $time[] = $cron->getNextRunDate(null, $i)->format('Y-m-d H:i:s');
            }
        }
        catch (\Exception $e)
        {
            
        }

        return json(['futuretime' => $time]);
    }
    /**
     * 导入
     */
    public function import()
    {
        $file = $this->request->request('file');
        if (!$file) {
            $this->error(__('Parameter %s can not be empty', 'file'));
        }
        $filePath = ROOT_PATH . DS . 'public' . DS . $file;
        $filePath=str_replace('\\','/',$filePath);

        if (!is_file($filePath)) {
            $this->error(__('No results were found'));
        }

        //实例化reader
        $ext = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!in_array($ext, ['csv', 'xls', 'xlsx'])) {
            $this->error(__('Unknown data format'));
        }
        if ($ext === 'csv') {
            $file = fopen($filePath, 'r');
            $filePath = tempnam(sys_get_temp_dir(), 'import_csv');
            $fp = fopen($filePath, "w");
            $n = 0;
            while ($line = fgets($file)) {
                $line = rtrim($line, "\n\r\0");
                $encoding = mb_detect_encoding($line, ['utf-8', 'gbk', 'latin1', 'big5']);
                if ($encoding != 'utf-8') {
                    $line = mb_convert_encoding($line, 'utf-8', $encoding);
                }
                if ($n == 0 || preg_match('/^".*"$/', $line)) {
                    fwrite($fp, $line . "\n");
                } else {
                    fwrite($fp, '"' . str_replace(['"', ','], ['""', '","'], $line) . "\"\n");
                }
                $n++;
            }
            fclose($file) || fclose($fp);

            $reader = new Csv();
        } elseif ($ext === 'xls') {
            $reader = new Xls();
        } else {
            $reader = new Xlsx();
        }

        //导入文件首行类型,默认是注释,如果需要使用字段名称请使用name
        $importHeadType = isset($this->importHeadType) ? $this->importHeadType : 'comment';

        $table = $this->model->getQuery()->getTable();
        $database = \think\Config::get('database.database');
        $fieldArr = [];
        $list = db()->query("SELECT COLUMN_NAME,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND TABLE_SCHEMA = ?", [$table, $database]);
        foreach ($list as $k => $v) {
            if ($importHeadType == 'comment') {
                $fieldArr[$v['COLUMN_COMMENT']] = $v['COLUMN_NAME'];
            } else {
                $fieldArr[$v['COLUMN_NAME']] = $v['COLUMN_NAME'];
            }
        }

        //加载文件
        $insert = [];

        try {
            if (!$PHPExcel = $reader->load($filePath)) {
                $this->error(__('Unknown data format'));
            }
            $currentSheet = $PHPExcel->getSheet(0);  //读取文件中的第一个工作表
            $allColumn = $currentSheet->getHighestDataColumn(); //取得最大的列号
            $allRow = $currentSheet->getHighestRow(); //取得一共有多少行
            $maxColumnNumber = Coordinate::columnIndexFromString($allColumn);
            $fields = [];
            for ($currentRow = 1; $currentRow <= 1; $currentRow++) {
                for ($currentColumn = 1; $currentColumn <= $maxColumnNumber; $currentColumn++) {
                    $val = $currentSheet->getCellByColumnAndRow($currentColumn, $currentRow)->getValue();
                    $fields[] = $val;
                }
            }

            for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
                $values = [];
                for ($currentColumn = 1; $currentColumn <= $maxColumnNumber; $currentColumn++) {
                    $val = $currentSheet->getCellByColumnAndRow($currentColumn, $currentRow)->getValue();
                    $values[] = is_null($val) ? '' : $val;
                }
                $row = [];
                $temp = array_combine($fields, $values);
                foreach ($temp as $k => $v) {
                    if (isset($fieldArr[$k]) && $k !== '') {
                        $row[$fieldArr[$k]] = $v;
                    }
                }
                if ($row) {
                    $row=array_splice($row,1);
                    $insert[] = $row;
                }
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }

        if (!$insert) {
            $this->error(__('No rows were updated'));
        }


//        var_dump($insert);
//        exit;
        $this->model->saveAll($insert);

        $this->success();
    }

    /**
     * 导出
     */

    public function template()
    {
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.IOFactory");
        vendor("PHPExcel.PHPExcel.Shared_Date");
        vendor("PHPExcel.PHPExcel.Style");
        vendor("PHPExcel.PHPExcel.Style.Alignment");
        vendor("PHPExcel.PHPExcel.Style.Border");
        vendor("PHPExcel.PHPExcel.Style.Fill");
        vendor("PHPExcel.PHPExcel.NumberFormat");
        set_time_limit(5);

        $excel = new PHPExcel();

        $excel->getProperties()
            ->setCreator("模板")
            ->setLastModifiedBy("模板")
            ->setTitle("模板")
            ->setSubject("模板");
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

        $list=Db::table('fa_crontab')->limit(1)->select();
        $table = $this->model->getQuery()->getTable();
        $database = \think\Config::get('database.database');
        $columnarr = db()->query("SELECT COLUMN_NAME,COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND TABLE_SCHEMA = ?", [$table, $database]);
        $str=[];
        foreach ($columnarr as $kk=>$vv){
            $str[$vv['COLUMN_NAME']]=$vv['COLUMN_COMMENT'];
        }
//        var_dump($str);
//        exit;

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
                if($field=='id'){
                    $col++;
                    continue;
                }
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
        $title = date("YmdHis").'模板';
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
}
