<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function termsOfUse()
    {
        return view('home.terms-of-use');
    }

    public function privacyPolicy()
    {
        return view('home.privacy-policy');
    }
}