<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sales;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        $sales = Sales::where('id', 197988)->get();
        // dd($sales[0]);
        $data = DB::table('sales as s')
            ->select('*')
            ->whereDate('s.transaction_date', '>=', date('2023-04-05'))
            ->whereDate('s.transaction_date', '<=', date('2023-04-05'))
            ->get();
        dd($data);
        return view('test/index', [
            "sales" => Sales::with('paymentmethods')->first(),
            "user" => User::has('sales')->with('sales')->where("id", 3)->first()
        ]);
    }
}
