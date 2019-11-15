<?php

use App\Models\AdminRoles;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        $admin = new AdminRoles();
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
            ]
        ]);
    }
}
