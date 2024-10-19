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
        $this->call(CompanySeeder::class);
        $this->call(CompanyReviewSeeder::class); 
        $this->call(AddressSeeder::class);
        $this->call(ServiceLineSeeder::class);
        $this->call(AddIndustriesSeeder::class);
        $this->call(PortfolioItemSeeder::class);



    }
    

}

