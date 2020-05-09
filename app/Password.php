<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Password extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'project_id', 'group_id', 'name', 'username', 'password', 'full_description', 'viewed_at'];

    /**
     * @var array
     */
    protected $hidden = ['password'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($password) {
            $password->password = encrypt($password->password);
        });

        static::updating(function ($password) {
            $password->password = encrypt($password->password);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(PasswordGroup::class);
    }

    /**
     * @return mixed
     */
    public function getDecryptedPasswordAttribute()
    {
        return decrypt($this->password);
    }
}
