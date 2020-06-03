<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    public function postAnalytic()
    {
        return view('admin.analytics.post');
    }
}
