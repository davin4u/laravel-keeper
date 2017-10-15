<?php
namespace App\Helpers;

use App\Role;

trait UserPermissionsTrait {

  public function grantRoles($roles = [])
  {
    $this->roles()->sync($roles);
  }

  public function hasRole($role)
  {
    $r = is_array($role) ? $this->roles()->whereIn('role_id', $role)->first() : $this->roles()->where('role_id', $role)->first();

    return is_object($r);
  }
}
