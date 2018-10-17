<?php
namespace App\Console\Commands;
/**
 *
 * 数据仓库接口
 * @author win7
 */
interface DWHInterface {

	//获取需要数据
    public function Extract() ;

    //验证清晰
    public function Cleaning($param, $key) ;

    //转换
    public function Transform($param) ;

    //上次异常数据处理
	public function Abnormal();

	//上次插入失败数据处理
	public function Fail();

    //入库
    public function Load() ;
    
}
