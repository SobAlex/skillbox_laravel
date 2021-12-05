<?php

namespace App\Http\Controllers;

use App\Step;

class CompletedStepsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Step $step)
    {
        $step->complete();
        return back();
    }

    public function destroy(Step $step)
    {
        $step->incomplete();
        return back();
    }
}
