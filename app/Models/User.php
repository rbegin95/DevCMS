<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Account\UserSettings;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'ip_current',
        'ip_register',
        'machine_id',
        'pincode',
        'extra_rank',
        'motto',
        'look',
        'home_room',
        'last_login',
        'last_online',
        'online',
        'rank',
        'gender',
        'credits',
        'hide_online',
        'gotw_points',
        'auth_ticket'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'ip_current',
        'ip_register',
        'pincode',
        'pixels',
        'points',
        'auth_ticket',
        'secret_key',
        'machine_id',
    ];

    /**
     * Define the relationship with the permissions table.
     */
    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Permission::class, 'rank');
    }

    /**
     * Generate SSO ticket for the user.
     */
    public function ssoTicket(): string
    {
        Log::info('Generating SSO ticket');
        // Generate the SSO ticket by combining the hotel name from .env and a unique UUID
        $sso = sprintf('%s-%s', Str::replace(' ', '', env('HOTEL_NAME')), Str::uuid());

        // Check if this auth ticket already exists; if it does, recursively call the function
        if (User::where('auth_ticket', $sso)->exists()) {
            return $this->ssoTicket();
        }

        // Save the unique auth ticket to the current user's record
        $this->update([
            'auth_ticket' => $sso,
        ]);

        return $sso;
    }

    /**
     * Check if the user is banned.
     */
    public function isBanned()
    {
        return Ban::where('user_id', $this->id)->exists();
    }

    /**
     * Relationship with the users_settings table.
     */
    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
