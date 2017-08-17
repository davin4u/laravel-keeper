<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;

class Password extends Model
{

    protected $fillable = ['user_id', 'project_id', 'type', 'name', 'username', 'password', 'full_description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
