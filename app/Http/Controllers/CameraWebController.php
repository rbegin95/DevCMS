<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CameraWebController extends Controller
{
    public function show()
    {
         $photos = DB::table('camera_web')
            ->join('users', 'camera_web.user_id', '=', 'users.id') // Join with the users table
            ->select('camera_web.id', 'camera_web.url', 'camera_web.timestamp', 'users.username', 'users.look') // Select relevant columns
            ->orderBy('camera_web.timestamp', 'desc')
            ->get();

        return $photos; // Return the data for use in other controllers
    }
}
