<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Password;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function passwords()
    {
        return $this->belongsToMany(Password::class);
    }

    public function saveProfile($request)
    {
        if ($request->get('password') && $request->get('password') == $request->get('confirm_password')) {
            $this->update(['password' => \Hash::make($request->password)]);
        }

        return $this->update([
          'name' => $request->get('name')
        ]);
    }
}
