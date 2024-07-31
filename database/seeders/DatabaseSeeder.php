<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Title;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Seeders\HeroSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // AdminSeeder::class;
        $this->call([
            AdminSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
            TitleSeeder::class,
            HeroSeeder::class,
            LargeBannerSeeder::class,
            MedumBannerSeeder::class,
            SmallBannerSeeder::class,
            LogoSeeder::class
        ]);
    }
}
