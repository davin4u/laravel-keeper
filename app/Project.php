<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Password;

class Project extends Model
{
    protected $fillable = ['user_id', 'name', 'url', 'short_description', 'full_description'];

    public function passwords()
    {
        return $this->hasMany(Password::class);
    }
}
