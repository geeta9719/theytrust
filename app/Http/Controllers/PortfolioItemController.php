<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioItemController extends Controller
{

    public function tableView()
    {

        $company = Company::where('user_id', auth()->id())->first();
        // dd($company);

        $portfolioItems = PortfolioItem::paginate(10);
        return view('home.user.portfolio_items.tables', compact('company', 'portfolioItems'));
    }

    public function create()
    {
        return view('home.user.portfolio_items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media' => 'nullable|file|mimes:jpeg,png,pdf,mp4|max:10240',
            'youtube_url' => 'nullable|url',
            'project_title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'country_location' => 'required|string|max:255',
            'services_provided' => 'required|string|max:70',
            'short_description' => 'required|string',
            'engagement_start_date' => 'required|date',
            'engagement_end_date' => 'nullable|date|after_or_equal:engagement_start_date',
        ]);

        $media = null;

        if ($request->hasFile('media')) {
            $media = [
                'type' => 'file',
                'path' => $request->file('media')->store('media'),
            ];
        } elseif ($request->youtube_url) {
            $media = [
                'type' => 'youtube',
                'url' => $request->youtube_url,
            ];
        }


        $company = Company::where('user_id', auth()->id())->first();

        PortfolioItem::create(array_merge($validated, ['media' => $media, 'company_id' => $company->id]));
        $redirectUrl = url('company/' . $company->id . '/dashboard');
        return redirect($redirectUrl)->with('success', 'Portfolio item added successfully.');
    }
    public function index($company)
    {
        $company = Company::findOrFail($company);
        return view('home.user.portfolio_items.index', compact('company'));
    }

    public function getData(Request $request, $company)
    {
        $company = Company::findOrFail($company);
        $itemsPerPage = 3; // Display only 3 items per page

        $portfolioItems = PortfolioItem::where('company_id', $company->id)
            ->paginate($itemsPerPage);

        return response()->json($portfolioItems);
    }
    public function edit($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        return view('home.user.portfolio_items.edit', compact('portfolioItem'));
    }

    public function update(Request $request, $id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);

        $validated = $request->validate([
            'media' => 'nullable|file|mimes:jpeg,png,pdf,mp4|max:10240',
            'youtube_url' => 'nullable|url',
            'project_title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'country_location' => 'required|string|max:255',
            'services_provided' => 'required|string|max:70',
            'short_description' => 'required|string',
            'engagement_start_date' => 'required|date',
            'engagement_end_date' => 'nullable|date|after_or_equal:engagement_start_date',
        ]);

        $media = $portfolioItem->media;

        if ($request->hasFile('media')) {
            $media = [
                'type' => 'file',
                'path' => $request->file('media')->store('media'),
            ];
        } elseif ($request->youtube_url) {
            $media = [
                'type' => 'youtube',
                'url' => $request->youtube_url,
            ];
        }

        $portfolioItem->update(array_merge($validated, ['media' => $media]));
        return redirect()->route('portfolio.index', $portfolioItem->company_id)->with('success', 'Portfolio item updated successfully.');
    }
    public function destroy($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        $portfolioItem->delete();
        return redirect()->route('portfolio_items.tableView')->with('success', 'Portfolio item deleted successfully.');
    }
}
