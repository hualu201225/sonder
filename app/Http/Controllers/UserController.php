<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	//
	public function index()
	{
		$res = DB::select('select sum(a.balance) from (select id,user_id,balance,max(addtime) as addtime from dwh_account_log group by user_id) a');
		return $res;
	}
}
