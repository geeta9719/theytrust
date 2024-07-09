<?php

namespace App\Http\Controllers;

use App\Models\ReviewRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewReviewRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReviewResent;



class ReviewController extends Controller
{

    public function index()
    {
        // dd("asdfasdf");

        $user = Auth::user();
        // dd($user);
        $company = Company::where('user_id', $user->id)->first();


        if (!$company) {
            return redirect()->back()->with('error', 'No company associated with this user.');
        }

        $reviews = ReviewRequest::with('company')
            ->where('company_id', $company->id)
            ->get();

        return view('home.user.reviewsRequest', compact('reviews', 'company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'note' => 'nullable|string',
        ]);
    
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
    
        if (!$company) {
            return redirect()->back()->with('error', 'No company associated with this user.');
        }
    
        $review = ReviewRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'note' => $request->note,
            'company_id' => $company->id,
        ]);
    
        // Send email notification
        Mail::to($request->email)->send(new NewReviewRequest($review, $company));
    
        return redirect()->route('comapany.reviews.request.index')->with('success', 'Review request submitted successfully!');
    }

    public function resend($id)
    {
        $review = ReviewRequest::findOrFail($id);
       
        $user = Auth::user();
        $company = Company::where('user_id', $user->id)->first();
    
        // Logic to resend the request (e.g., send an email)
        Mail::to($review->email)->send(new ReviewResent($review, $company));
    
        return redirect()->route('comapany.reviews.request.index')->with('success', 'Review request resent successfully!');
    }
}