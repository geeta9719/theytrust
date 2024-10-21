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


    public static function canAddPortfolio($portfolio_count)
{
    // Get the authenticated user
    $user = Auth::user();

    if (!$user) {
        return false; // No user, cannot add portfolio
    }

    // Fetch the active subscription and plan
    $activeSubscription = $user->CurrentSubscription->first();

    if ($activeSubscription) {
        // Get the plan and its features
        $plan = $activeSubscription->plan;
        $features = $plan->features;

        // Check if the plan has a portfolio limit (based on features)
        $portfolioLimitFeature = $features->where('name', 'portfolio_limit')->first();
        $portfolio_limit = $portfolioLimitFeature ? (int) $portfolioLimitFeature->limit : 0;

        // Return true if the user has not exceeded the portfolio limit
        return $portfolio_count < $portfolio_limit;
    }

    // No active subscription or plan, default portfolio limit is 5
    return $portfolio_count < 3;
}


public static function getPortfolioLimit($companyId)
{
    // Fetch the company along with the associated user
    $company = Company::with('user')->where('id', $companyId)->first();

    $user = $company ? $company->user : null;

    if (!$user) {
        return 3; // Default portfolio limit if no user is associated
    }

    // Fetch the active subscription and plan
    $activeSubscription = $user->CurrentSubscription->first();

    if ($activeSubscription) {
        // Get the plan and its features
        $plan = $activeSubscription->plan;
        $features = $plan->features;

        // Check if the plan has a portfolio limit (based on features)
        $portfolioLimitFeature = $features->where('name', 'portfolio_limit')->first();
        return $portfolioLimitFeature ? (int) $portfolioLimitFeature->limit : 5;
    }

    // No active subscription or plan, return the default portfolio limit
    return 3;
}

    
}
