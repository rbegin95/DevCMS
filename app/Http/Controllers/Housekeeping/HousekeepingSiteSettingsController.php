<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;

class HousekeepingSiteSettingsController extends Controller
{
    // Display the Site Settings page
    public function index()
    {
        $staffApplicationTabVisible = WebsiteSetting::getSetting('staff_application_tab_visible', 'false');

        return view('housekeeping.admin.sitesettings', compact('staffApplicationTabVisible'));
    }

    // Update the "Staff Application" tab visibility
    public function updateStaffApplicationTab(Request $request)
    {
        $visible = $request->has('staff_application_tab_visible') ? 'true' : 'false';
        WebsiteSetting::setSetting('staff_application_tab_visible', $visible);

        return redirect()->route('housekeeping.admin.sitesettings')->with('success', 'Staff Application tab visibility updated successfully!');
    }
}