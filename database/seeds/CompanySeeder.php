<?php

use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(){

        $company = new Company();
        $company->insert([
            'company_name'  => 'Grune',
            'post_code'     => '1000000',
            'address'       => 'Tokyo, Japan',
            'phone'         => '0987654321',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        factory(Company::class, 10)->create();
    }
}
