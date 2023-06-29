<?php

namespace App\Http\Controllers;

use App\Models\EmailTracker;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    //

    public function store(Request $request)
    {
        EmailTracker::where('tracker', $request->tracker)->increment('total_clicks', 1, ['status' => 0, 'record' => 'OPENED', 'open' => 1]);
    }
}
