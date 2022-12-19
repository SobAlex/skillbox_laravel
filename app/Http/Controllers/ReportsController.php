<?php

namespace App\Http\Controllers;

use App\Jobs\StatisticReports;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    public function index()
    {
        return view('pages.reports');
    }

    public function getExport(Request $request)
    {
        $data = json_encode($request->all());

        $user = auth()->user();
        $userEmail = $user->email;

        StatisticReports::dispatch($userEmail, $data);
    }
}
