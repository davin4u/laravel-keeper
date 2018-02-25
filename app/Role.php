<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SV_ROLE = 1;
    const ADMIN_ROLE = 2;
    const MANAGER_ROLE = 3;
    const USER_ROLE = 4;
}
