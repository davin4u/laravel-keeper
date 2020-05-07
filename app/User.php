<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Helpers\UserPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable;
    use UserPermissionsTrait;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordGroups()
    {
        return $this->hasMany(PasswordGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function passwords()
    {
        return $this->belongsToMany(Password::class);
    }
}
