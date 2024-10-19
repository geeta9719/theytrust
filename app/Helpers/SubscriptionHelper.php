<?php

namespace App\Helpers;

use Rennokki\Plans\Models\PlanModel;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;


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
    
        // No active subscription or plan, default review limit is 3
        return $reviews_count < 3;
    }

    public static function getReviewLimit($compnayId)
    {
        // Get the authenticated user


        // dd($compnayId);

        $company = Company::with('user')->where('id', $compnayId)->first();
        

            $user= $company->user;

        // $user = Auth::user();

        if (!$user) {
            return 3; // Default review limit if no user is authenticated
        }

        // Fetch the active subscription and plan
        $activeSubscription = $user->CurrentSubscription->first();

        if ($activeSubscription) {
            // Get the plan and its features
            $plan = $activeSubscription->plan;
            $features = $plan->features;

            // Check if the plan has a review limit (based on features)
            $reviewLimitFeature = $features->where('name', 'reviews_count')->first();
            return $reviewLimitFeature ? (int) $reviewLimitFeature->limit : 3;
        }

        // No active subscription or plan, return the default review limit
        return 3;
    }
    
}
