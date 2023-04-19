<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class CashController extends Controller
{
    // This API return all the income with no debts and paid by Cash

    public function cashBetweenDate(Request $request)
    {
        // Get all the id from sales table which fulfill the requirement
        $profit_id = DB::table('sales as s')
            ->selectRaw("s.id")
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', date($request->start_date))
            ->whereDate('s.transaction_date', '<=', date($request->end_date))
            ->pluck('id')
            ->toArray();

        // Get the total modal for the sales which fulfill the requirement
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) as Total')
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', date($request->start_date))
            ->whereDate('s.transaction_date', '<=', date($request->end_date))
            ->get();

        try {
            //code...
            if (count($profit_id) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->whereIn('st.sale_id', $profit_id)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => 0
            );
        }
        $data[] = date($request->start_date);


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function cashToday()
    {
        // Get all the id from sales table which fulfill the requirement
        $profit_id = DB::table('sales as s')
            ->selectRaw("s.id")
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m-d'))
            ->pluck('id')
            ->toArray();

        // Get the total modal for the sales which fulfill the requirement
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) as Total')
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

        try {
            //code...
            if (count($profit_id) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->whereIn('st.sale_id', $profit_id)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => 0
            );
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function cashThisMonth()
    {
        // Get all the id from sales table which fulfill the requirement
        $profit_id = DB::table('sales as s')
            ->selectRaw("s.id")
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m') . '-01')
            ->pluck('id')
            ->toArray();

        // Get the total modal for the sales which fulfill the requirement
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) as Total')
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m') . '-01')
            ->get();

        try {
            //code...
            if (count($profit_id) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->whereIn('st.sale_id', $profit_id)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => 0
            );
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function cashLastMonth()
    {
        // Get all the id from sales table which fulfill the requirement
        $profit_id = DB::table('sales as s')
            ->selectRaw("s.id")
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subMonth()->format('Y-m') . '-01')
            ->whereDate('s.transaction_date', '<=', Carbon::now()->format('Y-m') . '-01')
            ->pluck('id')
            ->toArray();

        // Get the total modal for the sales which fulfill the requirement
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) as Total')
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subMonth()->format('Y-m') . '-01')
            ->whereDate('s.transaction_date', '<=', Carbon::now()->format('Y-m') . '-01')
            ->get();

        try {
            //code...
            if (count($profit_id) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->whereIn('st.sale_id', $profit_id)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function cashThisWeek()
    {
        // Get all the id from sales table which fulfill the requirement
        $profit_id = DB::table('sales as s')
            ->selectRaw("s.id")
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subDays(7))
            ->pluck('id')
            ->toArray();

        // Get the total modal for the sales which fulfill the requirement
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) as Total')
            ->where('deleted_at', null)
            ->where('is_cash', '!=', 0)
            ->where('method_id', 1)
            ->where('status', 2)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subDays(7))
            ->get();

        try {
            //code...
            if (count($profit_id) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->whereIn('st.sale_id', $profit_id)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function cashTest()
    {
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) Total, max(s.id) max, min(s.id) min')
            ->where('deleted_at', null)
            ->whereDate('s.transaction_date', '>=', '2023-04-04')
            ->whereDate('s.transaction_date', '<=', '2023-04-04')
            ->get();

        if (count($profit) > 0) {
            $modal = DB::table('stocks as st')
                ->selectRaw('sum(st.buyPrice) TotalModal')
                ->where('deleted_at', null)
                ->where('st.sale_id', '>=', $profit[0]->min)
                ->where('st.sale_id', '<=', $profit[0]->max)
                ->get();
        }

        var_dump(Carbon::now()->month);

        $data = array(
            "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
        );

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
