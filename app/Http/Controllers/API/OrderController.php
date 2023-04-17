<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sales;

class OrderController extends Controller
{
    public function orderBetweenDate(Request $request)
    {
        // Get all the id from sales table which fulfill the requirement
        $data = Sales::selectRaw('count(id) as TotalOrder')
            ->where('deleted_at', null)
            ->whereDate('transaction_date', '>=', date($request->start_date))
            ->whereDate('transaction_date', '<=', date($request->end_date))
            ->get();

        try {
            //code...
            if (count($data) > 0) {
                $data = array(
                    "TotalOrder" => $data[0]->TotalOrder
                );
            }
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalOrder" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function orderToday()
    {
        // Get all the id from sales table which fulfill the requirement
        $data = Sales::selectRaw('count(id) as TotalOrder')
            ->where('deleted_at', null)
            ->whereDate('transaction_date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();

        try {
            //code...
            if (count($data) > 0) {
                $data = array(
                    "TotalOrder" => $data[0]->TotalOrder
                );
            }
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalOrder" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function orderThisMonth()
    {
        // Get all the id from sales table which fulfill the requirement
        $data = Sales::selectRaw('count(id) as TotalOrder')
            ->where('deleted_at', null)
            ->whereDate('transaction_date', '>=', Carbon::now()->format('Y-m') . '-01')
            ->get();

        try {
            //code...
            if (count($data) > 0) {
                $data = array(
                    "TotalOrder" => $data[0]->TotalOrder
                );
            }
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalOrder" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function orderLastMonth()
    {
        // Get all the id from sales table which fulfill the requirement
        $data = Sales::selectRaw('count(id) as TotalOrder')
            ->where('deleted_at', null)
            ->whereDate('transaction_date', '>=', Carbon::now()->subMonth()->format('Y-m') . '-01')
            ->whereDate('transaction_date', '<=', Carbon::now()->format('Y-m') . '-01')
            ->get();

        try {
            //code...
            if (count($data) > 0) {
                $data = array(
                    "TotalOrder" => $data[0]->TotalOrder
                );
            }
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalOrder" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function orderThisWeek()
    {
        // Get all the id from sales table which fulfill the requirement
        $data = Sales::selectRaw('count(id) as TotalOrder')
            ->where('deleted_at', null)
            ->whereDate('transaction_date', '>=', Carbon::now()->subDays(7))
            ->get();

        try {
            //code...
            if (count($data) > 0) {
                $data = array(
                    "TotalOrder" => $data[0]->TotalOrder
                );
            }
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalOrder" => 0
            );
        }

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function orderTest()
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
