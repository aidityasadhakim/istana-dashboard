<?php

namespace App\Http\Controllers\API;

use App\Models\Sales;
use App\Models\Stocks;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Symfony\Component\VarDumper\VarDumper;

class ProfitController extends Controller
{
    public function show($id)
    {
        $data = Sales::where('id', '=', $id)->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function profitBetweenDate(Request $request)
    {
        $subquery = '(SELECT 
                        sale_id, SUM(buyPrice) Total
                    FROM
                        stocks
                    WHERE sale_id is not null
                    GROUP BY sale_id) AS st';

        $data = DB::table('sales as s')
            ->selectRaw('SUM(s.total) - SUM(st.Total)')
            ->join(DB::raw($subquery), 's.id', '=', 'st.sale_id')
            ->whereDate('s.transaction_date', '>=', date($request->start_date))
            ->whereDate('s.transaction_date', '<=', date($request->end_date))
            ->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    public function profitToday()
    {
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) Total, max(s.id) max, min(s.id) min')
            ->where('deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m-d'))
            ->get();
        try {
            //code...
            if (count($profit) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->where('st.sale_id', '>=', $profit[0]->min)
                    ->where('st.sale_id', '<=', $profit[0]->max)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => null
            );
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function profitThisMonth()
    {
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) Total, max(s.id) max, min(s.id) min')
            ->where('deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m') . '-01')
            ->get();
        try {
            //code...
            if (count($profit) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('deleted_at', null)
                    ->where('st.sale_id', '>=', $profit[0]->min)
                    ->where('st.sale_id', '<=', $profit[0]->max)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => null
            );
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function profitLastMonth()
    {
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) Total, max(s.id) max, min(s.id) min')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subMonth()->format('Y-m') . '-01')
            ->whereDate('s.transaction_date', '<=', Carbon::now()->format('Y-m') . '-01')
            ->get();
        try {
            //code...
            if (count($profit) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('st.deleted_at', null)
                    ->where('st.sale_id', '>=', $profit[0]->min)
                    ->where('st.sale_id', '<=', $profit[0]->max)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => null
            );
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function profitThisWeek()
    {
        $profit = DB::table('sales as s')
            ->selectRaw('sum(s.total) Total, max(s.id) max, min(s.id) min')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subDays(7))
            ->get();
        try {
            //code...
            if (count($profit) > 0) {
                $modal = DB::table('stocks as st')
                    ->selectRaw('sum(st.buyPrice) TotalModal')
                    ->where('st.deleted_at', null)
                    ->where('st.sale_id', '>=', $profit[0]->min)
                    ->where('st.sale_id', '<=', $profit[0]->max)
                    ->get();
            }
            $data = array(
                "TotalProfit" => (int)$profit[0]->Total - (int)$modal[0]->TotalModal
            );
        } catch (Exception $e) {
            //throw $th;
            $data = array(
                "TotalProfit" => null
            );
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function profitTest()
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

    public function transCash(Request $request)
    {
        $subquery = '(SELECT 
                        sale_id, SUM(buyPrice) Total
                    FROM
                        stocks
                    WHERE sale_id is not null
                    GROUP BY sale_id) AS st';

        $data = DB::table('sales as s')
            ->selectRaw('SUM(s.total) - SUM(st.Total)')
            ->join(DB::raw($subquery), 's.id', '=', 'st.sale_id')
            ->whereDate('s.transaction_date', '>=', date($request->start_date))
            ->whereDate('s.transaction_date', '<=', date($request->end_date))
            ->get();

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }
}
