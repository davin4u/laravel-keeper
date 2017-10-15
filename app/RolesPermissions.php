<?php

namespace App;

use App\Role;

class RolesPermissions {

  public static $permissions = [
    'dashboard' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],

    'projects_index' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'projects_create' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'projects_store' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'projects_edit' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'projects_delete' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'projects_update' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'project_passwords_list' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],

    'passwords_index' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'passwords_create' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'passwords_store' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'passwords_edit' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'passwords_update' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'passwords_delete' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],

    'settings_index' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'settings_create' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'settings_store' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'settings_edit' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'settings_update' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'settings_delete' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],

    'settings_profile_edit' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],
    'settings_profile_update' => [Role::SV_ROLE, Role::ADMIN_ROLE, Role::MANAGER_ROLE, Role::USER_ROLE],

    'settings_permissions_edit' => [Role::SV_ROLE, Role::ADMIN_ROLE],
    'settings_permissions_save' => [Role::SV_ROLE, Role::ADMIN_ROLE],
  ];

}
