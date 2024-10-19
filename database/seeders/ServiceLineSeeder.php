<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class ServiceLineSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch all companies
        $companies = DB::table('companies')->pluck('id');

        // Fetch all categories and subcategories
        $categories = DB::table('categories')->pluck('id');
        $subcategories = DB::table('subcategories')->pluck('id');

        foreach ($companies as $companyId) {
            DB::table('service_lines')->where('company_id', $companyId)->delete();

            // Fetch the current total percentage for the company
            $currentTotalPercent = DB::table('service_lines')
                                    ->where('company_id', $companyId)
                                    ->sum('percent');

            // Ensure the remaining percentage doesn't exceed 100
            $remainingPercent = 100 - $currentTotalPercent;

            if ($remainingPercent > 0) {
                // Divide remaining percentage across 3 new service lines
                $percentages = $this->getPercentages($remainingPercent);
                
                // Insert 3 new service lines for the company
                for ($i = 1; $i <= 3; $i++) {
                    DB::table('service_lines')->insert([
                        'company_id' => $companyId,
                        'category_id' => $faker->randomElement($categories), // Fetching from categories table
                        'subcategory_id' => $faker->randomElement($subcategories), // Fetching from subcategories table
                        'percent' => $percentages[$i - 1], // Assign calculated percentage
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    private function getPercentages($remainingPercent)
    {
        $percent1 = rand(10, min(50, $remainingPercent));
        $percent2 = rand(10, min(50, $remainingPercent - $percent1));
        $percent3 = $remainingPercent - ($percent1 + $percent2);
        
        return [$percent1, $percent2, $percent3];
    }
}
