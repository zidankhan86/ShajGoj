<?php

namespace Database\Seeders;

use App\Models\CompanyLogo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       CompanyLogo::create([

            'tittle'=>"100% Trusted",
            'image'=>"2024071312150715.png",

        ]);
    }
}
