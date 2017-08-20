<?php

use Illuminate\Database\Seeder;

class PasswordTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('password_types')->insert([
            [
                'name' => 'FTP',
                'icon' => 'fa-floppy-o'
            ],
            [
                'name' => 'Admin panel',
                'icon' => 'fa-user'
            ]
        ]);
    }
}
