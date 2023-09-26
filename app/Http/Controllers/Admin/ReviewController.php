<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function send_email_to_reviewer( Request $request )
    {
    	echo '<pre>'; die( print_r( $request->all() ) ); echo '</pre>';
    }
}
