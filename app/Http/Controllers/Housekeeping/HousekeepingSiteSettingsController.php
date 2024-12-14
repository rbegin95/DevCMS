<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;

class HousekeepingSiteSettingsController extends Controller
{
    public function index()
    {
        // Retrieve settings
        $staffApplicationTabVisible = WebsiteSetting::isStaffApplicationTabVisible();
        $maintenanceMode = WebsiteSetting::isMaintenanceModeEnabled();
        $currentTheme = WebsiteSetting::getTheme(); // Fetch the current theme from the database

        return view('housekeeping.admin.sitesettings', compact('staffApplicationTabVisible', 'maintenanceMode', 'currentTheme'));
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
        $maintenanceMode = $request->input('maintenance_mode');
        if (WebsiteSetting::isMaintenanceModeEnabled() != $maintenanceMode) {
            WebsiteSetting::updateMaintenanceMode($maintenanceMode);
            $messages[] = $maintenanceMode == 'true' ? 'You have enabled Maintenance Mode!' : 'You have disabled Maintenance Mode!';
            logHousekeepingActivity("User: " . auth()->user()->username . " has " . ($maintenanceMode == 'true' ? 'enabled' : 'disabled') . " Maintenance Mode.");
        }

        // Handle Theme Update
        $theme = $request->input('theme');
if (WebsiteSetting::getTheme() != $theme) {
    WebsiteSetting::setTheme($theme);
    $messages[] = "Theme has been updated to " . ucfirst($theme) . "!";

    // Trigger the NPM build
    if (WebsiteSetting::buildTheme($theme)) {
        $messages[] = "NPM build succeeded!";
    } else {
        $messages[] = "Failed to build the theme. Please check the logs.";
    }

    logHousekeepingActivity("User: " . auth()->user()->username . " updated the theme to " . ucfirst($theme) . ".");
}

        // Combine the messages into a single string
        $successMessage = implode(' ', $messages);

        return redirect()->route('housekeeping.admin.sitesettings')->with('success', $successMessage);
    }
}
