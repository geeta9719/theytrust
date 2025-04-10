<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;

class PortfolioItemController extends Controller
{
    public function tableView()
    {
        $company = Company::where('user_id', auth()->id())->first();

        $portfolioItems = PortfolioItem::where('company_id', $company->id)
        ->orderBy('position')
        ->paginate(10);
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
            // 'services_provided' => 'required|string|max:70',
            'short_description' => 'required|string',
            'engagement_start_date' => 'required|date',
            'engagement_end_date' => 'nullable|date|after_or_equal:engagement_start_date',
        ]);

        $media = null;

        $servicesProvidedString = implode(',', $request['services_provided']);


        if ($request->hasFile('media')) {
            $media = [
                'type' => 'file',
                'path' => $request->file('media')->store('media'),
            ];
        }
        elseif ($request->youtube_url) {
            $media = [
                'type' => 'youtube',
                'url' => $request->youtube_url,
            ];
        }

        $company = Company::where('user_id', auth()->id())->first();

        $portfolioItemData = array_merge($validated, [
            'media' => $media,
            'company_id' => $company->id,
            'services_provided' => $servicesProvidedString, // Save as comma-separated string
        ]);

        PortfolioItem::create($portfolioItemData);

        $redirectUrl = url('company/' . $company->id . '/dashboard');
        return redirect($redirectUrl)->with('success', 'Portfolio item added successfully.');
    }

    public function index($company)
    {
        $company = Company::findOrFail($company);
        $itemsPerPage = 3; // Display only 3 items per page

        $portfolioItems = PortfolioItem::where('company_id', $company->id)
            ->paginate($itemsPerPage);

        return view('home.user.portfolio_items.index', compact('company', 'portfolioItems'));
    }

    public function getData(Request $request, $company)
    {
        $company = Company::findOrFail($company);
        $itemsPerPage = 3; // Display only 3 items per page

        $portfolioItems = PortfolioItem::where('company_id', $company->id)->orderBy('position')
            ->paginate($itemsPerPage);

        return response()->json($portfolioItems);
    }
    public function edit($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);

        // Explode the stored service IDs into an array
        $serviceIds = explode(',', $portfolioItem->services_provided);
    
        // Fetch the service names using the IDs
        $services = ServiceProvider::whereIn('id', $serviceIds)->pluck('name', 'id');
        $portfolioItem['services_provided'] = 'services_provided';


// dd($portfolioItem,$services);    
        // Pass both the portfolio item and the services to the view
        return view('home.user.portfolio_items.edit', compact('portfolioItem', 'services'));
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
            // 'services_provided' => 'required|string|max:200',
            'short_description' => 'required|string',
            'engagement_start_date' => 'required|date',
            'engagement_end_date' => 'nullable|date|after_or_equal:engagement_start_date',
        ]);

        $media = $portfolioItem->media;

        $servicesProvidedString = implode(',', $request['services_provided']);

        if ($request->hasFile('media')) {
            $media = [
                'type' => 'file',
                'path' => $request->file('media')->store('media'),
            ];
        }
        elseif ($request->youtube_url) {
            $media = [
                'type' => 'youtube',
                'url' => $request->youtube_url,
            ];
        }

        $portfolioItem->update(array_merge($validated, ['media' => $media, 'services_provided' => $servicesProvidedString ]));
        return redirect()->route('portfolio_items.tableView', $portfolioItem->company_id)->with('success', 'Portfolio item updated successfully.');
    }
    public function destroy($id)
    {
        $portfolioItem = PortfolioItem::findOrFail($id);
        $portfolioItem->delete();
        return redirect()->route('')->with('success', 'Portfolio item deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            $portfolioItem = PortfolioItem::find($item['id']);
            $portfolioItem->position = $item['order'];
            $portfolioItem->save();
        }

        return response()->json(['status' => 'success']);
    }
}
