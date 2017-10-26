<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $user = App\User::create([
          'name' => 'Administrator',
          'email' => 'super@email.com',
          'password' => bcrypt(env('SUPER', time())),
      ]);

      $user->grantRoles([App\Role::SV_ROLE, App\Role::ADMIN_ROLE, App\Role::MANAGER_ROLE, App\Role::USER_ROLE]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $user = App\User::where('email', 'super@email.com')->first();

      if (is_object($user)) {
        $user->grantRoles([]);
        $user->delete();
      }
    }
}
