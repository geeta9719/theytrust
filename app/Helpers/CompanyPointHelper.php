<?php

namespace App\Helpers;

use App\Models\CompanyPoint;
use App\Models\Weight;
use App\Models\Company;

class CompanyPointHelper
{
    public static function processReview($companyId, $overallRating, $type = 'Unverified')
    {
        $range = self::getRatingRange($overallRating);
        $weights = Weight::where('type', $type)->get();
        if ($weights->isEmpty()) {
            return ['error' => 'No weights found for the specified type.'];
        }
        $totalPoints = 0;
        $weightedPoints = 0;

        foreach ($weights as $weight) {
            $isMatchingRange = ($weight->parameter === 'Review Rating' && $weight->range === $range);
            $companyPoint = CompanyPoint::firstOrNew([
                'company_id' => $companyId,
                'weight_id' => $weight->id,
            ]);
            if ($isMatchingRange || $weight->parameter === 'Count') {
                $companyPoint->count += 1;
                $companyPoint->points = $companyPoint->count * $weight->points;
                $companyPoint->weighted_points = $companyPoint->points * ($weight->weight_percentage / 100);
                $companyPoint->save();
                $totalPoints += $companyPoint->points;
                $weightedPoints += $companyPoint->weighted_points;
            }
        }

        $totalWeightedPoints = CompanyPoint::where('company_id', $companyId)->sum('weighted_points');
        $company = Company::find($companyId);
        if ($company) {
            $company->ttu_score = $totalWeightedPoints;
            $company->save();
        }
        return [
            'total_points' => $totalPoints,
            'weighted_points' => $weightedPoints,
            'message' => 'Company points updated successfully.',
        ];
    }
    private static function getRatingRange($rating)
    {
        if ($rating == 5) {
            return '5';
        }elseif ($rating >= 4 && $rating <= 4.99) {
            return '4-4.99';
        }
        elseif ($rating >= 3 && $rating <= 3.99) {
            return '3-3.99';
        }
        elseif ($rating >= 2 && $rating <= 2.99) {
            return '2-2.99';
        }
        elseif ($rating >= 1 && $rating <= 1.99) {
            return '1-1.99';
        }
        else {
            return 'less than 1';
        }
    }

    public static function processMembershipPoints($companyId, $planName)
    {

        // Map the plan name to a membership type
    $membershipType = self::getMembershipTypeFromPlan($planName);

    // Retrieve the weight
    $weight = Weight::where('parameter', 'Level of Membership')
                    ->where('type', $membershipType)
                    ->first();


        if (!$weight) {
            return ['error' => 'Invalid membership type or weight not found.'];
        }

        $companyPoint = CompanyPoint::firstOrNew([
            'company_id' => $companyId,
            'weight_id' => $weight->id,
        ]);

        // Update company points based on membership type
        $companyPoint->count = 1; // Membership is a one-time addition
        $companyPoint->points = $weight->points;
        $companyPoint->weighted_points = $companyPoint->points * ($weight->weight_percentage / 100);
        $companyPoint->save();

        // Update the total weighted points for the company
        $totalWeightedPoints = CompanyPoint::where('company_id', $companyId)->sum('weighted_points');
        $company = Company::find($companyId);
        if ($company) {
            $company->ttu_score = $totalWeightedPoints;
            $company->save();
        }

        return [
            'points' => $companyPoint->points,
            'weighted_points' => $companyPoint->weighted_points,
            'message' => 'Membership points updated successfully.',
        ];
    }
    public static function getMembershipTypeFromPlan($planName)
{
    $membershipTypeMapping = [
        'Premium Local (Monthly)' => 'Local',
        'Premium Local (Yearly)' => 'Local',
        'Premium Regional (Monthly)' => 'Regional',
        'Premium Regional (Yearly)' => 'Regional',
        'Large Business (Monthly)' => 'Enterprise',
        'Large Business (Yearly)' => 'Enterprise',
        'Free' => 'Basic',
    ];

    return $membershipTypeMapping[$planName] ?? 'Basic'; // Default to 'Basic' if not found
}


public static function calculateProfileCompleteness($companyId)
    {
        $weight = Weight::where('parameter', 'Profile Completeness')
        ->first();

        if (!$weight) {
            return ['error' => 'Invalid membership type or weight not found.'];
        }

        $companyPoint = CompanyPoint::firstOrNew([
            'company_id' => $companyId,
            'weight_id' => $weight->id,
        ]);

        // Update company points based on membership type
        $companyPoint->count = 1; // Membership is a one-time addition
        $companyPoint->points = $weight->points;
        $companyPoint->weighted_points = $companyPoint->points * ($weight->weight_percentage / 100);
        $companyPoint->save();

        // Update the total weighted points for the company
        $totalWeightedPoints = CompanyPoint::where('company_id', $companyId)->sum('weighted_points');
        $company = Company::find($companyId);
        if ($company) {
            $company->ttu_score = $totalWeightedPoints;
            $company->save();
        }

        return [
            'points' => $companyPoint->points,
            'weighted_points' => $companyPoint->weighted_points,
            'message' => 'Membership points updated successfully.',
        ];
    }

    
}
