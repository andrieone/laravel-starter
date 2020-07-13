<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run(){
        /** Clear Uploads Folder **/
        $path = public_path('uploads');
        $file = new Filesystem;
        if (!$file->exists($path)) {
            $file->makeDirectory($path);
        }
        $file->cleanDirectory( public_path('uploads') );

        /** Clear Storage Files, works on s3 driver **/
        $storageFiles =   Storage::allFiles();
        Storage::delete($storageFiles);

        $this->call(AdminRoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PostcodeSeeder::class);
        $this->call(LogActivitySeeder::class);
    }
}
