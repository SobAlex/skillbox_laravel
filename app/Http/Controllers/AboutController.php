<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $title = 'О нас';

        return view('pages.about', compact('title'));
    }
}
