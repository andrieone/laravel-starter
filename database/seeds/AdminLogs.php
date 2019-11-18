<?php

use Illuminate\Database\Seeder;
use App\Models\AdminLogHistory;

class AdminLogs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AdminLogHistory::class, 200)->create();
    }
}
