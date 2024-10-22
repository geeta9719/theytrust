<?php


namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Faker\Factory as Faker;
// use Illuminate\Http\File;
use Illuminate\Support\Facades\Http; // For Laravel HTTP Client



class PortfolioItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Step 1: Fetch all company IDs from the companies table
        $companies = DB::table('companies')->pluck('id');

        // Step 2: Loop through each company and create 10 portfolio items
        foreach ($companies as $companyId) {
            foreach (range(1, 10) as $index) {
                

                // Insert YouTube media
                DB::table('portfolio_items')->insert([
                    'company_id' => $companyId,
                    'media' => json_encode([
                        'url' => 'https://www.youtube.com/watch?v=ShgimS7GdLY', // Faker-generated YouTube URL
                        'type' => 'youtube'
                    ]),
                    'project_title' => 'Project ' . $index . ' for Company ' . $companyId,
                    'client_name' => $faker->company, // Use Faker to generate a realistic company name
                    'country_location' => $faker->country, // Use Faker to generate a real country
                    'services_provided' => $faker->randomElement($services), // Randomly pick a service
                    'short_description' => 'This is a short description for project ' . $index,
                    'engagement_start_date' => now()->subDays(rand(1, 365)),
                    'engagement_end_date' => rand(0, 1) ? now() : null,
                    'position' => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }
    }
}

