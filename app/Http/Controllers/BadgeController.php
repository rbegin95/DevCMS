<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function show()
    {
        $badgesPath = public_path('img/badges');
        $badges = glob($badgesPath . '/*.gif'); // Get all .gif files

        if (empty($badges)) {
            $randomBadges = [];
        } else {
            // Shuffle the array and pick the first 16 elements
            shuffle($badges);
            $randomBadges = array_slice($badges, 0, 16);
            $randomBadges = array_map(function($badge) {
                return str_replace(public_path(), '', $badge);
            }, $randomBadges);
        }

        return $randomBadges; // Return the array of badges
    }
}
