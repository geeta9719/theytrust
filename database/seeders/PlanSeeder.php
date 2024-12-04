<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    public function run()
    {
        $plans = [
            [
                'id' => 1,
                'name' => 'Free',
                'code' => 'Free',
                'tag' => 'default',
                'description' => 'Monthly data for Premium Local',
                'price' => 0,
                'currency' => 'USD',
                'duration' => 365, 
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 10,
                'recurring' => false, 
            ],
            [
                'id' => 2,
                'name' => 'Premium Local (Monthly)',
                'code' => 'premium_local_monthly',
                'tag' => 'default',
                'description' => 'Monthly data for Premium Local',
                'price' => 199,
                'currency' => 'USD',
                'duration' => 30, 
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 9,
                'recurring' => false, 
            ],
            [
                'id' => 3,
                'name' => 'Premium Regional (Monthly)',
                'code' => 'premium_regional_monthly',
                'tag' => 'default',
                'description' => 'Monthly data for Premium Regional',
                'price' => 598,
                'currency' => 'USD',
                'duration' => 30, 
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 8,
                'recurring' => false, 
            ],
            [
                'id' => 4,
                'name' => 'Large Business (Monthly)',
                'code' => 'large_business_monthly',
                'tag' => 'default',
                'description' => 'Monthly data for Large Business',
                'price' => 0,
                'currency' => 0,
                'duration' => 30, 
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 7,
                'recurring' => false, 
            ],
            [
                'id' => 5,
                'name' => 'Premium Local (Monthly)',
                'code' => 'premium_local_monthly',
                'tag' => 'default',
                'description' => 'Monthly data for Premium Local',
                'price' => 99,
                'currency' => 'USD',
                'duration' => 30, 
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 6,
                'recurring' => true, 
            ],
            [
                'id' => 6,
                'name' => 'Premium Regional (Monthly)',
                'code' => 'premium_regional_monthly',
                'tag' => 'default',
                'description' => 'Monthly data for Premium Regional',
                'price' => 299,
                'currency' => 'USD',
                'duration' => 30, 
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 5,
                'recurring' => true, 
            ],
            [
                'id' => 7,
                'name' => 'Large Business (Monthly)',
                'code' => 'large_business_monthly',
                'tag' => 'default',
                'description' => 'Monthly data for Large Business',
                'price' => 0,
                'currency' => 0,
                'duration' => 30, // 30 days
                'metadata' => json_encode(['type' => 'monthly']),
                'priority' => 4,
                'recurring' => true, 
            ],
            // Yearly Plans
            [
                'id' => 8,
                'name' => 'Premium Local (Yearly)',
                'code' => 'premium_local_yearly',
                'tag' => 'default',
                'description' => 'Yearly data for Premium Local',
                'price' => 950,
                'currency' => 'USD',
                'duration' => 365, // 1 year
                'metadata' => json_encode(['type' => 'yearly']),
                'priority' => 3,
                'recurring' => false, 
            ],
            [
                'id' => 9,
                'name' => 'Premium Regional (Yearly)',
                'code' => 'premium_regional_yearly',
                'tag' => 'default',
                'description' => 'Yearly data for Premium Regional',
                'price' => 2870,
                'currency' => 'USD',
                'duration' => 365, // 1 year
                'metadata' => json_encode(['type' => 'yearly']),
                'priority' => 2,
                'recurring' => false, 
            ],
            [
                'id' => 10,
                'name' => 'Large Business (Yearly)',
                'code' => 'large_business_yearly',
                'tag' => 'default',
                'description' => 'Yearly data for Large Business',
                'price' => 0,
                'currency' => 'USD',
                'duration' => 365, // 1 year
                'metadata' => json_encode(['type' => 'yearly']),
                'priority' => 1,
                'recurring' => false, 
            ],
        ];

        foreach ($plans as $plan) {
            DB::table('plans')->updateOrInsert(['id' => $plan['id']], $plan);
        }
        $planFeatures = [
            // Features for Free Plan
            [
                'name' => 'reviews_count',
                'code' => 'reviews_count_free',
                'description' => 'Number of reviews allowed for Free plan',
                'limit' => 3,
                'type' => 'basic',
                'plan_id' => 1, // Free Plan
            ],
            [
                'name' => 'portfolio_items',
                'code' => 'portfolio_items_free',
                'description' => 'Number of portfolio items allowed for Free plan',
                'limit' => 3,
                'type' => 'basic',
                'plan_id' => 1, // Free Plan
            ],
            // Features for Premium Local (Monthly)
            [
                'name' => 'reviews_count',
                'code' => 'reviews_count_premium_local_monthly',
                'description' => 'Number of reviews allowed for Premium Local (Monthly)',
                'limit' => 100000,
                'type' => 'premium',
                'plan_id' => 2,
            ],
            [
                'name' => 'portfolio_items',
                'code' => 'portfolio_items_premium_local_monthly',
                'description' => 'Number of portfolio items allowed for Premium Local (Monthly)',
                'limit' => 100000,
                'type' => 'premium',
                'plan_id' => 2,
            ],
            // Features for Premium Regional (Monthly)
            [
                'name' => 'reviews_count',
                'code' => 'reviews_count_premium_regional_monthly',
                'description' => 'Number of reviews allowed for Premium Regional (Monthly)',
                'limit' => 100000,
                'type' => 'premium',
                'plan_id' => 3,
            ],
            [
                'name' => 'portfolio_items',
                'code' => 'portfolio_items_premium_regional_monthly',
                'description' => 'Number of portfolio items allowed for Premium Regional (Monthly)',
                'limit' => 100000,
                'type' => 'premium',
                'plan_id' => 3,
            ],
            // Features for Large Business (Monthly)
            [
                'name' => 'reviews_count',
                'code' => 'reviews_count_large_business_monthly',
                'description' => 'Number of reviews allowed for Large Business (Monthly)',
                'limit' => 100000,
                'type' => 'enterprise',
                'plan_id' => 4,
            ],
            [
                'name' => 'portfolio_items',
                'code' => 'portfolio_items_large_business_monthly',
                'description' => 'Number of portfolio items allowed for Large Business (Monthly)',
                'limit' => 100000,
                'type' => 'enterprise',
                'plan_id' => 4,
            ],
        ];

        foreach ($planFeatures as $feature) {
            DB::table('plans_features')->updateOrInsert([
                'code' => $feature['code'],
                'plan_id' => $feature['plan_id']
            ], $feature);
        }
    }
}
