<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DwhFirstTender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dwh_fister_tender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '数据仓库：用户首投信息统计';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        //开启事物
	    DB::beginTransaction();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //查询最后一条的时间
	    $last_time = $this->get_last_time();
	    $where = '';
	    if ($last_time) {
	    	$where = ' where a.tender_time >= '.strtotime($last_time);
	    }
	    $sql = 'select count(a.user_id) as count,sum(a.tender_account) as account,FROM_UNIXTIME(a.tender_time,\'%Y-%m-%d\') as time from (SELECT user_id,tender_account,tender_time FROM '.TABLE_DWH_TENDER.' group by user_id) a '.$where.' group by time limit 100;';
	    $res = DB::select(DB::raw($sql));
	    foreach ($res as $k=>$v) {
	    	$res[$k] = (array) $v;
	    }
	    try {
		    if ($last_time) {
			    $update_data = $res[0];
			    DB::table(TABLE_DWH_FIRST_TEND_COUNT)
				    ->where('time', $last_time)
				    ->update($update_data);
			    unset($res[0]);
		    }
		    DB::table(TABLE_DWH_FIRST_TEND_COUNT)
			    ->insert($res);
		    DB::commit(); //提交事务
	    } catch (\Illuminate\Database\QueryException  $e) {
		    DB::rollback(); //回滚事务
	    }
    }

    //查询最后一条数据时间
	private function get_last_time()
	{
		$time = DB::table(TABLE_DWH_FIRST_TEND_COUNT)
						->orderBy('id','desc')
						->limit(1)
						->value('time');
		return $time;
	}
}
