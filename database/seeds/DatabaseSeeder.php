<?php

use Illuminate\Database\Seeder;
use League\Flysystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run(){
        /** Clear Uploads File **/
        $file = new Filesystem;
        $file->cleanDirectory( public_path('uploads') );

        $this->call(AdminRoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(LogActivitySeeder::class);
    }
}
