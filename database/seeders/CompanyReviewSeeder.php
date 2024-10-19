<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Company; 
use App\Models\User;     
use App\Models\CompanyReview; 


class CompanyReviewSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Fetch all company and user ids
        $companyIds = Company::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            CompanyReview::create([
                'company_id' => $faker->randomElement($companyIds),
                'user_id' => $faker->randomElement($userIds),
                'project_type' => $faker->randomElement(['Web Development', 'Mobile App', 'Consulting']),
                'project_title' => $faker->sentence(3),
                'company_type' => $faker->randomElement(['Private', 'Public']),
                'cost_range' => $faker->randomElement(['$5000-$10000', '$10000-$50000']),
                'project_start' => $faker->date(),
                'project_end' => $faker->date(),
                'company_position' => $faker->sentence(),
                'for_what_project' => $faker->sentence(),
                'how_select' => $faker->paragraph(),
                'scope_of_work' => $faker->paragraph(),
                'team_composition' => $faker->paragraph(),
                'any_outcomes' => $faker->paragraph(),
                'how_effective' => $faker->paragraph(),
                'most_impressive' => $faker->paragraph(),
                'area_of_improvements' => $faker->paragraph(),
                'quality' => $faker->randomElement([1, 2, 3, 4, 5]),
                'quality_review' => $faker->sentence(),
                'timeliness' => $faker->randomElement([1, 2, 3, 4, 5]),
                'timeliness_review' => $faker->sentence(),
                'cost' => $faker->randomFloat(2, 1000, 50000),
                'cost_review' => $faker->sentence(),
                'communication' => $faker->randomElement([1, 2, 3, 4, 5]),
                'communication_review' => $faker->sentence(),
                'expertise' => $faker->randomElement([1, 2, 3, 4, 5]),
                'expertise_review' => $faker->sentence(),
                'ease_of_working' => $faker->randomElement([1, 2, 3, 4, 5]),
                'ease_of_working_review' => $faker->sentence(),
                'refer_ability' => $faker->randomElement([1, 2, 3, 4, 5]),
                'refer_ability_review' => $faker->sentence(),
                'overall_rating' => $faker->randomElement([1, 2, 3, 4, 5]),
                'overall_rating_review' => $faker->sentence(),
                'full_name' => $faker->name,
                'attribution' => $faker->company,
                'position_title' => $faker->jobTitle,
                'company_name' => $faker->company,
                'company_size' => $faker->randomElement(['Small', 'Medium', 'Large']),
                'city' => $faker->city,
                'state' => $faker->state,
                'country' => $faker->country,
                'company_email' => $faker->companyEmail,
                'phone_number' => $faker->phoneNumber,
                'linkedin_url' => $faker->url,
                'company_url' => $faker->url,
                'status' => 1,
                'project_summary' => $faker->paragraph(),
                'feedback_summary' => $faker->paragraph(),
                'published' => $faker->randomElement(['0', '1']),
                'created_at' => now(),
                'updated_at' => now(),
                'comment' => $faker->sentence(),
            ]);
        }
    }
}
