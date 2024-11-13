<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Event;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use Rennokki\Plans\Traits\HasPlans;
use Rennokki\Plans\Events\NewSubscription;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            // Step 1: Create a user with all fields filled
            $user = User::create([
                'linkedin_id' => $faker->uuid,
                'name' => $faker->name,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'mobile' => $faker->phoneNumber,
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($faker->name) . '&size=200',
                'plan' => $faker->randomElement(['Free', 'Pro', 'Enterprise']),
                'role' => 2,
                'slug' => $faker->slug,
                'company' => $faker->company,
                'twitter' => $faker->userName,
                'linkedin' => 'https://linkedin.com/in/' . $faker->userName,
                'bio' => $faker->paragraphs(2, true),
                'status' => 1,
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'remember_token' => 'password',
                'created_at' => now(),
                'updated_at' => now(),
                'verification_token' => 'passwordpasswordpassword',
                'token_expires_at' => now()->addDays(7),
            ]);

            // Step 2: Create the company for the user
            $companyId = DB::table('companies')->insertGetId([
                'user_id' => $user->id,
                'logo' => 'https://via.placeholder.com/200x200.png?text=Company+' . urlencode($faker->company),
                'name' => $faker->company,
                'website' => $faker->url,
                'tagline' => $faker->catchPhrase,
                'short_description' => $faker->text(100),
                'description' => $faker->paragraphs(3, true),
                'rate' => '$50-$100',
                'budget' => '$50000-$100000',
                'size' => $faker->randomElement(['1-10', '11-50', '51-200', '201-500']),
                'mobile' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'status' => $faker->randomElement([0, 1]),
                'founded_at' => $faker->year,
                'profile_type' => $faker->randomElement(['Basic', 'Premium']),
                'avg_review_score' => $faker->randomFloat(2, 1, 5),
                'is_publish' => $faker->boolean,
                'is_flagged' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Step 3: Subscribe the user to a random plan
            $plan = PlanModel::inRandomOrder()->first();
            // if ($plan) {
                $subscription = $user->subscribeTo($plan, $plan->duration, false);
            // }
        }
    }
}
