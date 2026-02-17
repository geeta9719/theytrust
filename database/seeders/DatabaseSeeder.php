<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // CompanySeeder: companies + addresses + industries + service lines + client sizes + portfolio items
        // CompanyReviewSeeder: AI-generated reviews via OpenAI for all companies
        $this->call([
            CompanySeeder::class,
            CompanyReviewSeeder::class,
        ]);
    }
    

}

