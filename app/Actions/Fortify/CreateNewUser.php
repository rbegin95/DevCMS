<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use App\Services\RconService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input ): User
    {

        $ip = request()->ip();
        
        $users = User::where(function ($query) use ($ip) {
            $query->where('ip_register', $ip)->orWhere('ip_current', $ip);
        })->count();

        if ($users >= 3) {
            throw ValidationException::withMessages([
                'username' => ['You can only have a maximum of 3 accounts.'],
            ]);
        }

        Validator::make($input, [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'ip_register' => $ip, // Save the user's IP address
            'ip_current' => $ip, // Save the user IP
        ]);
    }
}