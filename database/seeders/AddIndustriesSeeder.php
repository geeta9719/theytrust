<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class AddIndustriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch all companies and industries
        $companies = DB::table('companies')->pluck('id');
        $industries = DB::table('industries')->pluck('id');

        foreach ($companies as $companyId) {
            DB::table('add_industries')->where('company_id', $companyId)->delete();
            // Divide 100% across multiple industries for each company
            $percentages = $this->getPercentages(count($industries));

            // Insert industry data for each company
            foreach ($percentages as $index => $percent) {
                DB::table('add_industries')->insert([
                    'company_id' => $companyId,
                    'industry_id' => $industries[$index % count($industries)], // Rotate through industry IDs
                    'percent' => $percent, // Use calculated percentage
                    'status' => 1, // Active status
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // Helper function to generate percentages that sum to 100
    private function getPercentages($totalIndustries)
    {
        // Ensure we divide 100% into random parts that sum to exactly 100
        $percentages = [];
        $remaining = 100;

        for ($i = 1; $i < $totalIndustries; $i++) {
            $percent = rand(1, $remaining - ($totalIndustries - $i));
            $percentages[] = $percent;
            $remaining -= $percent;
        }

        // Add the remaining percentage for the last industry
        $percentages[] = $remaining;

        return $percentages;
    }
}
