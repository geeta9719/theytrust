<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CompanyReview;
use App\Models\Company;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
	
}
