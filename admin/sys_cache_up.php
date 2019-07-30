<?php
/**
 * �������
 *
 * @version        $Id: sys_cache_up.php 1 16:22 2010��7��20��Z tianya $
 * @package        DedeCMS.Administrator
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
require_once(dirname(__FILE__)."/config.php");
CheckPurview('sys_ArcBatch');
if(empty($dopost)) $dopost = '';
if(empty($step)) $step = 1;
function clean_cachefiles( $path )
{
	//print_r(glob( $path . '/*'));
	$list = array();
	foreach( glob( $path . '/*') as $item )
	{
		if( is_dir( $item ) )
			clean_cachefiles( $item );
		else
			@unlink( $item );
	}
	return true;
}
if($dopost=="ok")
{
    if(empty($uparc)) $uparc = 0;
    if($step == -1)
    {
        if($uparc == 0) sleep(1);
        ShowMsg("�ɹ��������л��棡","javascript:;");
        exit();
    }

    //������Ŀ����
    else if($step == 1)
    {
        UpDateCatCache();
        ClearOptCache();
		clean_cachefiles( "../html" );
        ShowMsg("�ɹ�������Ŀ���棬����̨��Ŀѡ��,׼������ö�ٻ���...","sys_cache_up.php?dopost=ok&step=2&uparc=$uparc");
        exit();
    }

    //����ö�ٻ���
    else if($step == 2)
    {
        include_once(DEDEINC."/enums.func.php");
        WriteEnumsCache();
        //WriteAreaCache(); �ѹ���
        ShowMsg("�ɹ�����ö�ٻ��棬׼�����µ��û���...", "sys_cache_up.php?dopost=ok&step=3&uparc=$uparc");
        exit();
    }

    //����arclist���û��桢���ڻ�Ա������ʷ�����ڶ���
    else if($step == 3)
    {
        echo '<meta http-equiv="Content-Type" content="text/html; charset='.$cfg_soft_lang.'">';
        $dsql->ExecuteNoneQuery("DELETE FROM `#@__arccache`");
        echo "\n�ɹ�����arclist���û��棬׼���������ڻ�Ա������ʷ...<hr />";
        $oldtime = time() - (90 * 24 * 3600);
        $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_vhistory` WHERE vtime<'$oldtime' ");
        echo "�ɹ��������ڻ�Ա������ʷ��׼���������ڶ���...<hr />";
        $dsql->ExecuteNoneQuery("DELETE FROM `#@__member_pms` WHERE sendtime<'$oldtime' ");
        echo "�ɹ��������ڶ��ţ�׼�����������ĵ��������Ҫռ�ϳ���ʱ��...";
        if($uparc == 1)
        {
            echo "<script language='javascript'>location='sys_cache_up.php?dopost=ok&step=9';</script>";
        }
        else
        {
            echo "<script language='javascript'>location='sys_cache_up.php?dopost=ok&step=-1&uparc=$uparc';</script>";
        }
        exit();
    }
    //���������ĵ�
    else if($step == 9)
    {
        ShowMsg('���������ĵ������Ѿ�ȡ��������&lt;ϵͳ-&gt;ϵͳ�����޸�[S]&gt;�в���...','sys_cache_up.php?dopost=ok&step=-1&uparc=1',0,5000);
      exit();
    }
}
include DedeInclude('templets/sys_cache_up.htm');