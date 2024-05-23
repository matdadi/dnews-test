<?php

namespace App\Http\Controllers\CMS;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
