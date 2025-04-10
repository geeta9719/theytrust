<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'review_id' => 'required|exists:company_reviews,id',
            'verification_description' => 'required|string',
        ]);

        $review = CompanyReview::find($request->review_id);
        $review->verified_by = auth()->id(); // Assuming the admin is logged in
        $review->verification_description = $request->verification_description;
        $review->save();

        return response()->json(['message' => 'Review verified successfully']);
    }
}
