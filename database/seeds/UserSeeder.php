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
                'allow_login'       => 1,
                'company_id'        => 1,
                'display_name'      => 'Normal User',
                'email'             => 'normal@user.com',
                'admin_role_id'     => 3,
                'password'          => bcrypt('12345678'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ]);

        factory(User::class, 299)->create();

    }
}
