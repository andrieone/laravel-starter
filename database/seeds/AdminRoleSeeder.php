<?php

use App\Models\AdminRole;
use Illuminate\Database\Seeder;

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
            ],
            [
                'name'       => 'admin',
                'label'      => 'Admin',
            ],
            [
                'name'       => 'company_admin',
                'label'      => 'Company Admin',
            ]
        ]);
    }
}
