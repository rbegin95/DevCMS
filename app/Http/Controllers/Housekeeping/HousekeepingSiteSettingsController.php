<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Models\CheckMaintenanceMode;

class HousekeepingSiteSettingsController extends Controller
{
    public function index()
    {
        $staffApplicationTabVisible = WebsiteSetting::isStaffApplicationTabVisible();
        $maintenanceMode = WebsiteSetting::first()->maintenance_mode;

        return view('housekeeping.admin.sitesettings', compact('staffApplicationTabVisible', 'maintenanceMode'));
    }

    public function updateSiteSettings(Request $request)
{
    $messages = [];

    // Handle Staff Application Tab Visibility
    $staffApplicationTabVisible = $request->input('staff_application_tab_visible');
    if (WebsiteSetting::isStaffApplicationTabVisible() != $staffApplicationTabVisible) {
        WebsiteSetting::updateStaffApplicationTab($staffApplicationTabVisible);
        $messages[] = $staffApplicationTabVisible == 'true' ? 'You have enabled Staff Applications!' : 'You have disabled Staff Applications!';
        logHousekeepingActivity("User: " . auth()->user()->username . " has " . ($staffApplicationTabVisible == 'true' ? 'enabled' : 'disabled') . " Staff Application Tab.");
    }

    // Handle Maintenance Mode
    $maintenanceMode = $request->input('maintenance_mode') === 'true' ? 'true' : 'false';
    if (WebsiteSetting::first()->maintenance_mode != $maintenanceMode) {
        WebsiteSetting::setMaintenanceMode($maintenanceMode);
        $messages[] = $maintenanceMode == 'true' ? 'You have enabled Maintenance Mode!' : 'You have disabled Maintenance Mode!';
        logHousekeepingActivity("User: " . auth()->user()->username . " has " . ($maintenanceMode == 'true' ? 'enabled' : 'disabled') . " Maintenance Mode.");
    }

    // Combine the messages into a single string
    $successMessage = implode(' ', $messages);

    return redirect()->route('housekeeping.admin.sitesettings')->with('success', $successMessage);
}
}
