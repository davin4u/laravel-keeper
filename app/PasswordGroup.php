<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordGroup extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'icon'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwords()
    {
        return $this->hasMany(Password::class);
    }
}
