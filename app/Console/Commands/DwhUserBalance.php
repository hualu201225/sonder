<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DwhUserBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dwh_user_balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '数据仓库：所有用户总资产';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //账户余额
	    $user_balance = DB::select('select sum(a.balance) as balance from '.TABLE_DWH_ACCOUNT_LOG.' a INNER JOIN (select id, MAX(addtime) addtime,balance from '.TABLE_DWH_ACCOUNT_LOG.' GROUP BY user_id) b on a.id = b.id ');
	    //待还款
	    $user_repay = DB::table(TABLE_DWH_REPAY)->select(DB::raw('sum(repay_account) as repay'))->where('repay_status', '=', 0)->value('repay');
	    $sum = $user_balance[0]->balance+$user_repay;
	    //平台总用户人数
	    $user_count = DB::table(TABLE_DWH_USER)
		                    ->select(DB::raw('count(user_id) as count'))
		                    ->value('count');
	    $data = array(
	    	'account'=>$sum,
		    'count' => $user_count
	    );
	    //查询是否已经有存储
	    $res = DB::table(TABLE_DWH_USER_BALANCE)->first();
	    if ($res) {
		    DB::table(TABLE_DWH_USER_BALANCE)->where('id', 1)->update($data);
	    } else {
			DB::table(TABLE_DWH_USER_BALANCE)->insert($data);
	    }
    }
}
