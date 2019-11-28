<?php

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        $admin = new UserRole();
        $admin->insert([
            [
                'name'       => 'supervisor',
                'label'      => 'Super Visor',
            ],
            [
                'name'       => 'operator',
                'label'      => 'Operator',
            ]
        ]);
    }
}
