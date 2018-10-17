<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DwhUser extends Command implements DWHInterface
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dwh_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '仓库源数据：用户';

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
        //
	    file_put_contents('test.log','1-', FILE_APPEND);
	    echo 'This is dwh_user';
    }
}
