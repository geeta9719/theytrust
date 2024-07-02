<?php
// app/helpers.php

if (!function_exists('generateStarRating')) {
    function generateStarRating($rating) {
        $stars = '';
        for ($i = 0; $i < 5; $i++) {
            if ($rating > $i) {
                $stars .= '<i class="fa fa-star bluestar"></i>';
            } else {
                $stars .= '<i class="fa fa-star-o bluestar"></i>';
            }
        }
        return $stars;
    }
}

// app/helpers.php

if (!function_exists('generateStarChecked')) {
    /**
     * Generate star rating HTML based on rating.
     *
     * @param float $rating The rating value (out of 5).
     * @return string HTML representation of star rating.
     */
    function generateStarChecked($rating)
    {
        $stars = '';
        $fullStars = floor($rating); // Full stars count
        $hasHalfStar = $rating - $fullStars >= 0.5; // Check if there's a half star

        // Full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $stars .= '<span class="fa fa-star checked"></span>';
        }

        // Half star if applicable
        if ($hasHalfStar) {
            $stars .= '<span class="fa fa-star-half-o checked"></span>';
            $fullStars++; // Increment full stars count
        }

        // Empty stars
        for ($i = $fullStars; $i < 5; $i++) {
            $stars .= '<span class="fa fa-star-o checked"></span>';
        }

        return $stars;
    }
}
