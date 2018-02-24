<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Password;

class Project extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = ['user_id', 'name', 'url', 'short_description', 'full_description'];

  public function removable()
  {
    return $this->user_id == auth()->user()->id;
  }
}
