<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    // Define the table explicitly
    protected $table = 'website_settings';
    
    // Define the columns you can fill
    protected $fillable = ['staff_application_tab_visible', 'maintenance_mode'];

    // Disable incrementing ID since the table doesn't have one
    public $incrementing = false;

    // Disable timestamp columns since the table doesn't have `created_at` and `updated_at`
    public $timestamps = false;

    // Update staff application tab visibility
    public static function updateStaffApplicationTab($value)
    {
        // Update the value directly in the only row of the table
        static::query()->update(['staff_application_tab_visible' => $value]);
    }

    // Update maintenance mode
    public static function setMaintenanceMode($value)
    {
        // Update the value directly in the only row of the table
        static::query()->update(['maintenance_mode' => $value]);
    }

    // Check if staff application tab is visible
    public static function isStaffApplicationTabVisible()
    {
        $setting = static::first();
        return $setting ? $setting->staff_application_tab_visible : false;
    }

    // Get the current maintenance mode value
    public static function getMaintenanceMode()
    {
        $setting = static::first();
        return $setting ? $setting->maintenance_mode : 'false';
    }
}
