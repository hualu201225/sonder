<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //用户源数据仓库
//	    'App\Console\Commands\DwhUser',
	    //标源数据仓库
//	    'App\Console\Commands\DwhBorrow',
	    //所有用户总资产
	    'App\Console\Commands\DwhUserBalance',
	    //用户首投记录
	    'App\Console\Commands\DwhFirstTender'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//	    $schedule->command('dwh_user')->everyMinute()->timezone('Asia/Shanghai')->withoutOverlapping();//用户源数据仓库
//	    $schedule->command('dwh_borrow')->everyMinute()->timezone('Asia/Shanghai')->withoutOverlapping();//标源数据仓库
	    $schedule->command('dwh_user_balance')->everyMinute()->timezone('Asia/Shanghai')->withoutOverlapping();//所有用户总资产
	    $schedule->command('dwh_fister_tender')->everyMinute()->timezone('Asia/Shanghai')->withoutOverlapping();//所有用户总资产
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
