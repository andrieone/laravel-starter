<?php

use App\Models\AdminRole;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        $admin = new AdminRole();
        $admin->insert([
            [
                'name'       => 'super_admin',
                'label'      => 'Super Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'admin',
                'label'      => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'user',
                'label'      => 'User',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
