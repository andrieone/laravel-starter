<?php

    use App\Models\Admin;
    use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(){

        $company = new Company();
        $company->insert([
            'admin_id'      => 3,
            'company_name'  => 'Grune',
            'post_code'     => '1000000',
            'address'       => 'Tokyo, Japan',
            'phone'         => '0987654321',
            'status'        => 'active',
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        factory(Admin::class, 10)->create(['admin_role_id' => 3])->each(function ($admin) {
            $company = factory(Company::class)->make();
            $admin->company()->save($company);
        });
    }
}
