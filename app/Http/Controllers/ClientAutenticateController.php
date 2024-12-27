<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthenticateController extends Controller
{
    public function handle(Request $request)
    {
        // Handle GET request: Show the authenticate form
        if ($request->isMethod('get')) {
            return view('client.authenticate');
        }

        // Handle POST request: Process re-authentication
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            // Update session timestamp for client re-authentication
            session(['client_last_authenticated_at' => now()]);
            return redirect('/client')->with('message', 'Successfully authenticated.');
        }

        // If authentication fails, return an error
        return back()->withErrors(['password' => 'The provided password is incorrect.']);
    }
}
