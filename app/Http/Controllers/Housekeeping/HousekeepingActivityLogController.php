<?php

namespace App\Http\Controllers\Housekeeping;

use App\Models\Housekeeping\HousekeepingActivityLog;
use App\Http\Controllers\Controller;

class HousekeepingActivityLogController extends Controller
{
    public function index()
    {
        $logs = HousekeepingActivityLog::with('user')->latest()->paginate(20);
        return view('housekeeping.admin.activitylog', compact('logs'));
    }
}