<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        Company::insert([
            ['company_name' => 'Coca-Cola', 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'サントリー', 'created_at' => now(), 'updated_at' => now()],
            ['company_name' => 'キリン', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

