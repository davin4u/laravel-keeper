<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Project;
use App\PasswordType;

use Carbon\Carbon;

class Password extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = ['user_id', 'project_id', 'type', 'name', 'username', 'password', 'full_description', 'viewed_at'];

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

  public function getDescriptionRowsCount($max = 20, $min = 10)
  {
    $rowsCount = count(explode("\n", $this->full_description));

    if ($rowsCount < $min) {
      $rowsCount = $min;
    }

    return $rowsCount > $max ? $max : $rowsCount;
  }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }

  public function isSharedWithUser($userId)
  {
    return $this->users()->wherePivot('user_id', $userId)->count() > 0 ? true : false;
  }

  public function editable()
  {
    return $this->user_id == auth()->user()->id;
  }

  public function removable()
  {
    return $this->user_id == auth()->user()->id;
  }

  public function updateViewed()
  {
    $this->update([
      'password' => $this->getDecryptedPasswordAttribute(),
      'viewed_at' =>Carbon::now()
    ]);
  }

}
