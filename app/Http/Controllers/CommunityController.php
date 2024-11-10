<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Community;
use App\Models\Comments;
use App\Models\UserBadges;
use App\Models\UsersSetting;

use DB;

class CommunityController extends Controller
{
  public function index()
    {
        $newsController = new NewsController();
        $badgeController = new BadgeController();
        $cameraController = new CameraWebController();

        // Get the latest article from NewsController
        $articles = $newsController->getArticles();

        // Get the random badges from BadgeController
        $randomBadges = $badgeController->show();

        // Get Camera Web Photos
        $photos = $cameraController->show();

        return view('community', compact('articles', 'randomBadges', 'photos'));
    }

    public function GOTW()
    {
        // Fetch users ordered by GOTW points in descending order
        $users = User::orderBy('gotw_points', 'desc')->get();

        // Pass the data to a view
        return view('gotw', compact('users'));
    }

    public function MostStuff()
{
    // Fetch top chatters from article_comments table
    $topChatters = Community::withCount('articleComments')
        ->orderBy('article_comments_count', 'desc')
        ->take(10)
        ->get();

    // Fetch users with the most badges
    $mostBadges = Community::select('users.id', 'users.username', 'users.look', DB::raw('COUNT(users_badges.user_id) as badges_count'))
        ->leftJoin('users_badges', 'users.id', '=', 'users_badges.user_id')
        ->groupBy('users.id', 'users.username', 'users.look')
        ->orderBy('badges_count', 'desc')
        ->take(10)
        ->get();

    // Fetch users with the most respects (from users_settings table)
    $mostRespected = Community::select('users.id', 'users.username', 'users.look', 'users_settings.respects_received as respects_count')
        ->join('users_settings', 'users.id', '=', 'users_settings.user_id')
        ->groupBy('users.id', 'users.username', 'users.look', 'users_settings.respects_received')
        ->orderBy('respects_count', 'desc')
        ->take(10)
        ->get();

    // Fetch most active users (login streak from users_settings table)
    $mostActive = Community::select('users.id', 'users.username', 'users.look', 'users_settings.online_time as days_online')
        ->join('users_settings', 'users.id', '=', 'users_settings.user_id')
        ->groupBy('users.id', 'users.username', 'users.look', 'users_settings.online_time')
        ->orderBy('days_online', 'desc')
        ->take(10)
        ->get();


    // Pass the data to a view
    return view('leaderboards', compact('topChatters', 'mostBadges', 'mostRespected', 'mostActive'));
}
  }
