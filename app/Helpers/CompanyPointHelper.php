<?php

namespace App\Helpers;

use App\Models\CompanyPoint;
use App\Models\Weight;

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
        return [
            'total_points' => $totalPoints,
            'weighted_points' => $weightedPoints,
            'message' => 'Company points updated successfully.',
        ];
    }
    private static function getRatingRange($rating)
    {
        if ($rating >= 4 && $rating <= 4.99) {
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
}
