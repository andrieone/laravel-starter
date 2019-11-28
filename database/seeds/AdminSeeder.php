<?php

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        $admin = new Admin();
        $admin->insert([
            [
                'display_name'      => 'Super Admin',
                'email'             => 'admin@admin.com',
                'admin_role_id'     => 1,
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('12345678'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'display_name'      => 'Admin',
                'email'             => 'user@admin.com',
                'admin_role_id'     => 2,
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('12345678'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'display_name'      => 'Grune Company Admin',
                'email'             => 'company@admin.com',
                'admin_role_id'     => 3,
                'email_verified_at' => Carbon::now(),
                'password'          => bcrypt('12345678'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]
        ]);

        factory(Admin::class, 97)->create();

    }
}
