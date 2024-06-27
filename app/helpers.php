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
