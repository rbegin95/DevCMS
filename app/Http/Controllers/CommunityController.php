<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

        // Get the latest article from NewsController
        $articles = $newsController->getArticles();

        // Get the random badges from BadgeController
        $randomBadges = $badgeController->show();

         // Fetch photos for the community page (similar to the gallery method)
        $photos = DB::table('camera_web')
        ->join('users', 'camera_web.user_id', '=', 'users.id')
        ->select('camera_web.*', 'users.username', 'users.look')
        ->orderBy('camera_web.timestamp', 'desc')
        ->limit(12) // Fetch only the latest 12 photos
        ->get()
        ->map(function ($photo) {
            $likedBy = json_decode($photo->liked_by ?? '[]');
            $photo->liked_by_user = in_array(Auth::id(), $likedBy);
            return $photo;
        });


        return view('community', compact('articles', 'randomBadges', 'photos'));
    }

    public function gallery(Request $request)
{
    $perPage = 12; // Number of photos per page
    $page = $request->input('page', 1);

    // Paginate photos
    $photos = DB::table('camera_web')
        ->join('users', 'camera_web.user_id', '=', 'users.id')
        ->select(
            'camera_web.*',
            'users.username',
            'users.look'
        )
        ->orderBy('camera_web.timestamp', 'desc')
        ->offset(($page - 1) * $perPage)
        ->limit($perPage)
        ->get()
        ->map(function ($photo) {
            $likedBy = json_decode($photo->liked_by ?? '[]'); // Decode liked_by field
            $photo->liked_by_user = in_array(Auth::id(), $likedBy); // Check if the user has liked this photo
            return $photo; // Add the property
        });

    // Statistics for the logged-in user
    $photoCount = DB::table('camera_web')->where('user_id', Auth::id())->count();
    $likedCount = DB::table('camera_web')
        ->where('liked_by', 'LIKE', '%' . Auth::id() . '%')
        ->count();
    $totalLikes = DB::table('camera_web')->sum('likes_count');

    if ($request->ajax()) {
        return response()->json(['data' => $photos]);
    }

    return view('gallery', compact('photos', 'photoCount', 'likedCount', 'totalLikes'));
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
