<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $reports = Report::all();

        return view('admin.analytics', compact('reports'));
    }
}

