<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run(){
        $this->call(AdminRoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(LogActivitySeeder::class);
    }
}
