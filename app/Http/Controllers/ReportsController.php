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
        $title = 'Отчеты';

        return view('pages.reports', compact('title'));
    }

    public function getExport(Request $request)
    {
        $data = $request->all();

        StatisticReports::dispatchSync($data);
    }
}
