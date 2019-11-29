<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        $user = new User();
        $user->insert([
            [
                'company_id'        => 1,
                'user_role_id'      => 2,
                'display_name'      => 'User Company',
                'email'             => 'user@company.com',
                'password'          => bcrypt('12345678'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ]);

        factory(User::class, 299)->create();

    }
}
