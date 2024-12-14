<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Retrieve the staff view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $users = User::where('rank', '>=', config('habbo.default.min_rank'))
                    //->whereNotIn('username', ['Glee', 'Admin'])
                    ->with('permissions')
                    ->orderBy('rank', 'DESC')
                    ->get();

        return view('staff', [
            'users' => $users,
        ]);
    }
}