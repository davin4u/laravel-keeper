<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'name' => $faker->word,
        'url' => $faker->url,
        'short_description' => $faker->paragraph,
        'full_description' => $faker->text
    ];
});

$factory->define(App\PasswordType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'icon' => 'fa-user'
    ];
});

$factory->define(App\Password::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'project_id' => function(){
            return factory('App\Project')->create()->id;
        },
        'type' => function() {
            return factory('App\PasswordType')->create()->id;
        },
        'name' => $faker->word,
        'username' => $faker->email,
        'password' => encrypt($faker->word),
        'full_description' => $faker->text
    ];
});
