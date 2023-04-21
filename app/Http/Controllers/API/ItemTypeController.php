<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Items;
use Symfony\Component\VarDumper\VarDumper;

class ItemTypeController extends Controller
{
    public function itemTypeBetweenDate(Request $request)
    {
        $requestBody = json_decode($request->getContent());
        if (isset($requestBody->start_date)) {
        } else {
            $requestBody = $request;
        }

        $stocks_id = DB::table('sales as s')
            ->selectRaw("st.id ids")
            ->join('stocks as st', 'st.sale_id', '=', 's.id')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', date($requestBody->start_date))
            ->whereDate('s.transaction_date', '<=', date($requestBody->end_date))
            ->pluck("ids")
            ->toArray();

        try {
            //code...
            if (count($stocks_id) > 0) {
                $type_count = DB::table('stocks as st')
                    ->selectRaw('count(st.id) total, i.type type')
                    ->join('items as i', 'i.id', '=', 'st.item_id')
                    ->whereIn('st.id', $stocks_id)
                    ->groupBy('i.type')
                    ->pluck('total', 'type')
                    ->toArray();

                $data = $type_count;
            } else {
                $data = array(
                    "Accessories" => 0,
                    "Part" => 0,
                    "Tools" => 0,
                    "Unit" => 0
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

    public function itemTypeToday()
    {
        $stocks_id = DB::table('sales as s')
            ->selectRaw("st.id ids")
            ->join('stocks as st', 'st.sale_id', '=', 's.id')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->format('Y-m-d'))
            ->pluck("ids")
            ->toArray();

        try {
            //code...
            if (count($stocks_id) > 0) {
                $type_count = DB::table('stocks as st')
                    ->selectRaw('count(st.id) total, i.type type')
                    ->join('items as i', 'i.id', '=', 'st.item_id')
                    ->whereIn('st.id', $stocks_id)
                    ->groupBy('i.type')
                    ->pluck('total', 'type')
                    ->toArray();

                $data = $type_count;
            } else {
                $data = array(
                    "Accessories" => 0,
                    "Part" => 0,
                    "Tools" => 0,
                    "Unit" => 0
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

    public function itemTypeThisMonth()
    {
        $stocks_id = DB::table('sales as s')
            ->selectRaw("st.id ids")
            ->join('stocks as st', 'st.sale_id', '=', 's.id')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->startOfMonth())
            ->pluck("ids")
            ->toArray();

        try {
            //code...
            if (count($stocks_id) > 0) {
                $type_count = DB::table('stocks as st')
                    ->selectRaw('count(st.id) total, i.type type')
                    ->join('items as i', 'i.id', '=', 'st.item_id')
                    ->whereIn('st.id', $stocks_id)
                    ->groupBy('i.type')
                    ->pluck('total', 'type')
                    ->toArray();

                $data = $type_count;
            } else {
                $data = array(
                    "Accessories" => 0,
                    "Part" => 0,
                    "Tools" => 0,
                    "Unit" => 0
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

    public function itemTypeLastMonth()
    {
        $stocks_id = DB::table('sales as s')
            ->selectRaw("st.id ids")
            ->join('stocks as st', 'st.sale_id', '=', 's.id')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->subMonthNoOverflow()->startOfMonth())
            ->whereDate('s.transaction_date', '<=', Carbon::now()->subMonthNoOverflow()->endOfMonth())
            ->pluck("ids")
            ->toArray();

        try {
            //code...
            if (count($stocks_id) > 0) {
                $type_count = DB::table('stocks as st')
                    ->selectRaw('count(st.id) total, i.type type')
                    ->join('items as i', 'i.id', '=', 'st.item_id')
                    ->whereIn('st.id', $stocks_id)
                    ->groupBy('i.type')
                    ->pluck('total', 'type')
                    ->toArray();

                $data = $type_count;
            } else {
                $data = array(
                    "Accessories" => 0,
                    "Part" => 0,
                    "Tools" => 0,
                    "Unit" => 0
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

    public function itemTypeThisWeek()
    {
        $stocks_id = DB::table('sales as s')
            ->selectRaw("st.id ids")
            ->join('stocks as st', 'st.sale_id', '=', 's.id')
            ->where('s.deleted_at', null)
            ->whereDate('s.transaction_date', '>=', Carbon::now()->startOfWeek())
            ->pluck("ids")
            ->toArray();

        try {
            //code...
            if (count($stocks_id) > 0) {
                $type_count = DB::table('stocks as st')
                    ->selectRaw('count(st.id) total, i.type type')
                    ->join('items as i', 'i.id', '=', 'st.item_id')
                    ->whereIn('st.id', $stocks_id)
                    ->groupBy('i.type')
                    ->pluck('total', 'type')
                    ->toArray();

                $data = $type_count;
            } else {
                $data = array(
                    "Accessories" => 0,
                    "Part" => 0,
                    "Tools" => 0,
                    "Unit" => 0
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

    public function itemTypeTest()
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
