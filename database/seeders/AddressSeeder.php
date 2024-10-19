<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Fetch all companies along with their associated user_id
        $companies = DB::table('companies')->select('id', 'user_id')->get();
        
        foreach ($companies as $company) {
            DB::table('addresses')->where('company_id', $company->id)->delete();

            foreach (range(1, 3) as $index) {
                DB::table('addresses')->insert([
                    'company_id' => $company->id,
                    'user_id' => $company->user_id, // Fetch user_id dynamically from company record
                    'address' => $faker->address,
                    'city' => $faker->city,
                    'state_iso2' => $faker->stateAbbr,
                    'country_iso2' => $faker->countryCode,
                    'zip' => $faker->postcode,
                    'type' => $faker->randomElement(['Headquarters', 'Branch', 'Office']),
                    'email' => $faker->companyEmail,
                    'mobile' => $faker->phoneNumber,
                    'autocomplete' => 'true',
                    'status' => 1, // Active address
                    'is_head_office' => ($index == 1) ? 1 : 0, // Set the first address as head office
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
