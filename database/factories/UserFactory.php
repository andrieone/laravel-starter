<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function(Faker $faker){
    return [
        'allow_login'       => 1,
        'company_id'        => rand(1, 10),
        'display_name'      => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'admin_role_id'     => 3,
        'password'          => bcrypt('12345678'),
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now(),
    ];
});
