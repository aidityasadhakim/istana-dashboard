<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request['active'])) {
            $active = $request['active'];
        } else {
            $active = "thismonth";
        }

        return view('home', [
            "title" => "Home",
            "active" => $active
        ]);
    }
}
