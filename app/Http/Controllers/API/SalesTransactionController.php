<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\TryCatch;

class SalesTransactionController extends Controller
{
    public function salesTransactionBetweenDate(Request $request)
    {
        $requestBody = json_decode($request->getContent());
        if (isset($requestBody->start_date)) {
        } else {
            $requestBody = $request;
        }

        $details = Sales::selectRaw("COUNT(id) totalTransaction,
        SUM(total) total,
        CONCAT(MONTH(DATE(transaction_date)),'-',DAY(DATE(transaction_date))) AS date")
            ->where('type', 'sale')
            ->where('deleted_at', null)
            ->where('is_cash', 1)
            ->where('method_id', '!=', 0)
            ->whereDate('transaction_date', '>=', date($requestBody->start_date))
            ->whereDate('transaction_date', '<=', date($requestBody->end_date))
            ->groupBy(DB::raw("DATE_FORMAT(transaction_date, '%m%d')"))
            ->get('totalTransaction', 'total', 'date');

        try {
            //code...
            if (count($details) > 0) {
                $data = array(
                    "totalTransaction" => $details->map->totalTransaction->toArray(),
                    "totalCash" => $details->map->total->toArray(),
                    "date" => $details->map->date->toArray()
                );
            } else {
                $data = array(
                    "totalTransaction" => [],
                    "totalCash" => [],
                    "date" => []
                );
            }
        } catch (Exception $e) {
            $data = null;
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function salesTransactionToday()
    {
        $details = Sales::selectRaw("COUNT(id) totalTransaction,
        SUM(total) total,
        CONCAT(MONTH(DATE(transaction_date)),'-',DAY(DATE(transaction_date))) AS date")
            ->where('type', 'sale')
            ->where('deleted_at', null)
            ->where('is_cash', 1)
            ->where('method_id', '!=', 0)
            ->whereDate('transaction_date', '>=', Carbon::now()->format('Y-m-d'))
            ->groupBy(DB::raw("DATE_FORMAT(transaction_date, '%m%d')"))
            ->get('totalTransaction', 'total', 'date');

        try {
            //code...
            if (count($details) > 0) {
                $data = array(
                    "totalTransaction" => $details->map->totalTransaction->toArray(),
                    "totalCash" => $details->map->total->toArray(),
                    "date" => $details->map->date->toArray()
                );
            } else {
                $data = array(
                    "totalTransaction" => [],
                    "totalCash" => [],
                    "date" => []
                );
            }
        } catch (Exception $e) {
            $data = null;
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function salesTransactionThisMonth()
    {
        $details = Sales::selectRaw("COUNT(id) totalTransaction,
        SUM(total) total,
        CONCAT(MONTH(DATE(transaction_date)),'-',DAY(DATE(transaction_date))) AS date")
            ->where('type', 'sale')
            ->where('deleted_at', null)
            ->where('is_cash', 1)
            ->where('method_id', '!=', 0)
            ->whereDate('transaction_date', '>=', Carbon::now()->format('Y-m') . '-01')
            ->groupBy(DB::raw("DATE_FORMAT(transaction_date, '%m%d')"))
            ->get('totalTransaction', 'total', 'date');

        try {
            //code...
            if (count($details) > 0) {
                $data = array(
                    "totalTransaction" => $details->map->totalTransaction->toArray(),
                    "totalCash" => $details->map->total->toArray(),
                    "date" => $details->map->date->toArray()
                );
            } else {
                $data = array(
                    "totalTransaction" => [],
                    "totalCash" => [],
                    "date" => []
                );
            }
        } catch (Exception $e) {
            $data = null;
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function salesTransactionLastMonth()
    {
        $details = Sales::selectRaw("COUNT(id) totalTransaction,
        SUM(total) total,
        CONCAT(MONTH(DATE(transaction_date)),'-',DAY(DATE(transaction_date))) AS date")
            ->where('type', 'sale')
            ->where('deleted_at', null)
            ->where('is_cash', 1)
            ->where('method_id', '!=', 0)
            ->whereDate('transaction_date', '>=', Carbon::now()->subMonth()->format('Y-m') . '-01')
            ->whereDate('transaction_date', '<=', Carbon::now()->subMonthsNoOverflow()->endOfMonth())
            ->groupBy(DB::raw("DATE_FORMAT(transaction_date, '%m%d')"))
            ->get('totalTransaction', 'total', 'date');

        try {
            //code...
            if (count($details) > 0) {
                $data = array(
                    "totalTransaction" => $details->map->totalTransaction->toArray(),
                    "totalCash" => $details->map->total->toArray(),
                    "date" => $details->map->date->toArray()
                );
            } else {
                $data = array(
                    "totalTransaction" => [],
                    "totalCash" => [],
                    "date" => []
                );
            }
        } catch (Exception $e) {
            $data = null;
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function salesTransactionThisWeek()
    {
        $details = Sales::selectRaw("COUNT(id) totalTransaction,
        SUM(total) total,
        CONCAT(MONTH(DATE(transaction_date)),'-',DAY(DATE(transaction_date))) AS date")
            ->where('type', 'sale')
            ->where('deleted_at', null)
            ->where('is_cash', 1)
            ->where('method_id', '!=', 0)
            ->whereDate('transaction_date', '>=', Carbon::now()->startOfWeek()->format(('Y-m-d')))
            ->groupBy(DB::raw("DATE_FORMAT(transaction_date, '%m%d')"))
            ->get('totalTransaction', 'total', 'date');

        try {
            //code...
            if (count($details) > 0) {
                $data = array(
                    "totalTransaction" => $details->map->totalTransaction->toArray(),
                    "totalCash" => $details->map->total->toArray(),
                    "date" => $details->map->date->toArray()
                );
            } else {
                $data = array(
                    "totalTransaction" => [],
                    "totalCash" => [],
                    "date" => []
                );
            }
        } catch (Exception $e) {
            $data = null;
        }


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(200, 'Failed', $data);
        }
    }

    public function salesTransactionTest()
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
