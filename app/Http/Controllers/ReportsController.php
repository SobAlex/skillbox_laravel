<?php

namespace App\Http\Controllers;

use App\Jobs\StatisticReports;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    public function index()
    {
        return view('pages.reports');
    }

    public function getExport(Request $request)
    {
        $data = $request->all();

        $user = auth()->user();
        $userEmail = $user->email;

        StatisticReports::dispatch($userEmail, $data);
    }
}
