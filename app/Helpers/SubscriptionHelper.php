<?php

namespace App\Helpers;

use Rennokki\Plans\Models\PlanModel;
use Illuminate\Support\Facades\Auth;

class SubscriptionHelper
{
    /**
     * Check if the user can write a review based on the plan's review limit.
     *
     * @param int $reviews_count
     * @return bool
     */
    public static function canWriteReview($reviews_count)
    {
        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return false; // No user, cannot write review
        }


        // Fetch the active subscription and plan
        $activeSubscription = $user->CurrentSubscription->first();

    dd($activeSubscription);
        if ($activeSubscription) {
            // Get the plan and its features
            $plan = $activeSubscription->plan;
            $features = $plan->features;

            // Check if the plan has a review limit (based on features)
            $reviewLimitFeature = $features->where('name', 'reviews_count')->first();
            $review_limit = $reviewLimitFeature ? (int) $reviewLimitFeature->limit : 0;

            // Return true if the user has not exceeded the review limit
            return $reviews_count < $review_limit;
        }

        return false; // No active subscription or plan found
    }
}
