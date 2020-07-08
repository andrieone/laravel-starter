<?php

use App\Models\Weekly;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeeklySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $weekly = new Weekly();
        $weekly->insert([
            'monday'        => '2020/1/15',
            'sunday'        => '2020/1/6',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        // factory(Admin::class, 10)->create(['admin_role_id' => 3])->each(function ($admin) {
        //     $company = factory(Company::class)->make();
        //     $admin->company()->save($company);
        // });
    }
}
