<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'url', 'short_description', 'full_description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwords()
    {
        return $this->hasMany(Password::class);
    }
}
