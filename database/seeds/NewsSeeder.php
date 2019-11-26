<?php

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        $file = new Filesystem;
        $file->cleanDirectory( public_path('uploads') );

        factory(News::class, 10)->create();
    }
}
