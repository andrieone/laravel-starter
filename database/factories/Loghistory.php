<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AdminLogHistory;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(AdminLogHistory::class, function(Faker $faker){
    return [
        'admins_id'       => 1,
        'activity'        => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'detail'          => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'ip'              => $faker->ipv4,
        'last_access'     => Carbon::now(),
        'created_at'      => Carbon::now(),
        'updated_at'      => Carbon::now(),
    ];
});
