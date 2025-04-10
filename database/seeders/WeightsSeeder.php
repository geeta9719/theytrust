<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Weight;

class WeightsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['parameter' => 'Count', 'type' => 'Verified', 'range' => null, 'points' => 5, 'weight_percentage' => 20, 'identifier' => 'count_verified'],
            ['parameter' => 'Review Rating', 'type' => 'Verified', 'range' => '4-4.99', 'points' => 8, 'weight_percentage' => 10, 'identifier' => 'rating_verified_4_4_99'],
            ['parameter' => 'Review Rating', 'type' => 'Verified', 'range' => '3-3.99', 'points' => 6, 'weight_percentage' => 10, 'identifier' => 'rating_verified_3_3_99'],
            ['parameter' => 'Review Rating', 'type' => 'Verified', 'range' => '2-2.99', 'points' => 4, 'weight_percentage' => 10, 'identifier' => 'rating_verified_2_2_99'],
            ['parameter' => 'Review Rating', 'type' => 'Verified', 'range' => '1-1.99', 'points' => 2, 'weight_percentage' => 10, 'identifier' => 'rating_verified_1_1_99'],
            ['parameter' => 'Review Rating', 'type' => 'Verified', 'range' => 'less than 1', 'points' => 0, 'weight_percentage' => 10, 'identifier' => 'rating_verified_less_1'],
            ['parameter' => 'Count', 'type' => 'Unverified', 'range' => null, 'points' => 2, 'weight_percentage' => 15, 'identifier' => 'count_unverified'],
            ['parameter' => 'Review Rating', 'type' => 'Unverified', 'range' => '4-4.99', 'points' => 4, 'weight_percentage' => 5, 'identifier' => 'rating_unverified_4_4_99'],
            ['parameter' => 'Review Rating', 'type' => 'Unverified', 'range' => '3-3.99', 'points' => 3, 'weight_percentage' => 5, 'identifier' => 'rating_unverified_3_3_99'],
            ['parameter' => 'Review Rating', 'type' => 'Unverified', 'range' => '2-2.99', 'points' => 2, 'weight_percentage' => 5, 'identifier' => 'rating_unverified_2_2_99'],
            ['parameter' => 'Review Rating', 'type' => 'Unverified', 'range' => '1-1.99', 'points' => 1, 'weight_percentage' => 5, 'identifier' => 'rating_unverified_1_1_99'],
            ['parameter' => 'Review Rating', 'type' => 'Unverified', 'range' => 'less than 1', 'points' => 0, 'weight_percentage' => 5, 'identifier' => 'rating_unverified_less_1'],
            ['parameter' => 'Profile Completeness', 'type' => null, 'range' => null, 'points' => 10, 'weight_percentage' => 10, 'identifier' => 'profile_completeness'],
            ['parameter' => 'Count of Portfolio Items', 'type' => null, 'range' => null, 'points' => 1, 'weight_percentage' => 5, 'identifier' => 'portfolio_count'],
            ['parameter' => 'Semantic Review Quality', 'type' => 'Positive', 'range' => null, 'points' => 5, 'weight_percentage' => 10, 'identifier' => 'semantic_positive'],
            ['parameter' => 'Semantic Review Quality', 'type' => 'Neutral', 'range' => null, 'points' => 2, 'weight_percentage' => 10, 'identifier' => 'semantic_neutral'],
            ['parameter' => 'Semantic Review Quality', 'type' => 'Negative', 'range' => null, 'points' => 0, 'weight_percentage' => 10, 'identifier' => 'semantic_negative'],
            ['parameter' => 'Level of Membership', 'type' => 'Basic', 'range' => null, 'points' => 0, 'weight_percentage' => 0, 'identifier' => 'membership_basic'],
            ['parameter' => 'Level of Membership', 'type' => 'Local', 'range' => null, 'points' => 100, 'weight_percentage' => 5, 'identifier' => 'membership_local'],
            ['parameter' => 'Level of Membership', 'type' => 'Regional', 'range' => null, 'points' => 500, 'weight_percentage' => 5, 'identifier' => 'membership_regional'],
            ['parameter' => 'Level of Membership', 'type' => 'Enterprise', 'range' => null, 'points' => 1000, 'weight_percentage' => 5, 'identifier' => 'membership_enterprise'],
            ['parameter' => 'Review Response Rate', 'type' => null, 'range' => null, 'points' => 10, 'weight_percentage' => 10, 'identifier' => 'review_response_rate'],
        ];

        foreach ($data as $row) {
            Weight::create($row);
        }
    }
}
