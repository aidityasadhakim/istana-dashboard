<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
