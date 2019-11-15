<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function(Faker $faker){
    return [
        'display_name'      => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'password'          => bcrypt('123456789'),
        'email_verified_at' => Carbon::now(),
        'created_at'        => Carbon::now(),
        'updated_at'        => Carbon::now(),
        'admin_role_id'     => 2,
    ];
});
