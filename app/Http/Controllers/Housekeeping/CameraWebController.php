<?php

namespace App\Http\Controllers\Housekeeping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CameraWebController extends Controller
{
    // Fetch and display all images
    public function index()
    {
        // Fetch only the URL and ID for the delete functionality
        $images = DB::table('camera_web')->select('id', 'url')->get();

        return view('housekeeping.camera.cameraweb', compact('images'));
    }

    // Delete an image
    public function destroy($id)
    {
        // Delete the image by ID
        DB::table('camera_web')->where('id', $id)->delete();

        logHousekeepingActivity("User: " . Auth::user()->username . " has deleted Camera Web Image");
        return redirect()->route('camera.index')->with('success', 'Image deleted successfully.');
    }
}