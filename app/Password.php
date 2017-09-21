<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Project;
use App\PasswordType;

class Password extends Model
{

    protected $fillable = ['user_id', 'project_id', 'type', 'name', 'username', 'password', 'full_description'];

    public static function boot() {
        parent::boot();

        static::creating(function($password){
            $password->password = encrypt($password->password);
        });

        static::updating(function($password){
            $password->password = encrypt($password->password);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function passwordType()
    {
        return $this->belongsTo(PasswordType::class, 'type', 'id');
    }

    public function getDecryptedPasswordAttribute()
    {
        return decrypt($this->password);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function isSharedWithUser($userId)
    {
        return $this->users()->wherePivot('user_id', $userId)->count() > 0 ? true : false;
    }

}
