<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

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

    if ($request->hasFile('avatar')) {
      $request->file('avatar')->storeAs('avatars', $this->id . '.' . $request->file('avatar')->extension(), 'public_uploads');
    }

    return $this->update([
      'name' => $request->get('name')
    ]);
  }

  public function getAvatarAttribute()
  {
    $file = '/images/img.jpg'; // @TODO use gravatar instead of this

    foreach (['.png', '.jpg', '.jpeg'] as $ext) {
      if (Storage::disk('public_uploads')->exists('avatars/' . $this->id . $ext)) {
        $file = '/uploads/avatars/' . $this->id . $ext;
      }
    }

    return $file;
  }
}
