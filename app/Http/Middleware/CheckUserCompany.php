<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Address;
use App\Models\AddFocus;


class CheckUserCompany
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();


        if ($request->routeIs('user.basicInfo', 'user.saveBasicInfo','company.savelocation','company.location', 'user.saveBasicInfo','company.focus','company.savefocus')) {
            return $next($request);
        }

        // Exclude specific routes to avoid recursive redirect issues
        if ($request->routeIs('user.basicInfo', 'company.location')) {
            return $next($request);
        }

        if ($user) {
            // Check if the user has a company
            $company = Company::where('user_id', $user->id)->first();

            // If no company is found, redirect to basic info page
            if (!$company) {
                return redirect()->route('user.basicInfo', ['user' => $user->id]);
            }

            // Check if the company has an address
            $addresses = Address::where('company_id', $company->id)->first();

            // If no address is found, redirect to company location page
            if (!$addresses) {
                return redirect()->route('company.location', ['company' => $company->id]);
            }

            $addresses = AddFocus::where('company_id', $company->id)->first();

            // If no address is found, redirect to company location page
            if (!$addresses) {
                return redirect()->route('company.focus', ['company' => $company->id]);
            }

        }

        return $next($request);
    }
}
