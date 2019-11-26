<?php

use App\Models\LogActivity;
use Illuminate\Database\Seeder;

class LogActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){
        factory(LogActivity::class, 55)->create();
    }
}
