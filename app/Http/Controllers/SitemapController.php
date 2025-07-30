<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function htmlIndex()
    {
        $sitemaps = [
            ['url' => url('/sitemap-pages.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            // ['url' => url('/sitemap-profiles.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            ['url' => url('/sitemap-companies.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            ['url' => url('/sitemap-categories.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            ['url' => url('/sitemap-subcategories.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            // ['url' => url('/blog/sitemap_index.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            ['url' => url('/sitemap-skills.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            ['url' => url('/sitemap-deepskills.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            ['url' => url('https://theytrust.us/blog/post-sitemap.xml'), 'lastmod' => '2025-07-30 05:20 +00:00'],
            
            
        ];
        return view('home.sitemap.index', compact('sitemaps'));
    }
    
    public function htmlPages()
{
    $pages = [
        ['url' => '/', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/about', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/terms-of-use', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/privacy-policy', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/terms', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/faq', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/contact', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/blogs', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/providers/category', 'lastmod' => now()->toDateTimeString()],
        
    ];

    return view('home.sitemap.pages', compact('pages'));
}

    public function companies()
    {
        $companies = DB::table('companies')
        ->select('slug', 'updated_at', 'created_at')
        ->where('is_publish', 1)
        ->orderByDesc('updated_at')
        ->limit(1000) 
        ->get();

    return view('home.sitemap.companies', compact('companies'));

    
    }

    public function categories()
    {
        $categories = DB::table('categories')
        ->select('slug', 'status')
        ->whereIn('status', [0, 1])
        ->get();

        return view('home.sitemap.categories', compact('categories'));
    }
    

    public function subcategories()
    {
        $subcategories = DB::table('subcategories')
        ->join('categories', 'subcategories.category_id', '=', 'categories.id')
        ->where('subcategories.status', 1)
        ->whereIn('categories.status', [0, 1])
        ->select('subcategories.slug as sub_slug', 'categories.slug as cat_slug')
        ->get();

    return view('home.sitemap.subcategories', compact('subcategories'));
    }
    
    public function htmlSkills()
{
    $skills  = DB::table('subcat_children')
    ->join('subcategories', 'subcat_children.subcategory_id', '=', 'subcategories.id')
    ->join('categories', 'subcategories.category_id', '=', 'categories.id')
    ->where('subcat_children.status', 1)
    ->where('subcategories.status', 1)
    ->whereIn('categories.status', [0, 1])
    ->select(
        'subcat_children.slug as subchild_slug',
        'subcat_children.name as subchild_name',
        'subcategories.slug as sub_slug',
        'categories.slug as cat_slug'
    )
    ->get();

    return view('home.sitemap.skills', compact('skills'));
}


public function htmlDeepSkills()
{
    $deepskills  = DB::table('skills')
    ->join('subcat_children', 'skills.subcat_child_id', '=', 'subcat_children.id')
    ->join('subcategories', 'subcat_children.subcategory_id', '=', 'subcategories.id')
    ->join('categories', 'subcategories.category_id', '=', 'categories.id')
    ->where('subcat_children.status', 1)
    ->where('subcategories.status', 1)
    ->whereIn('categories.status', [0, 1])
    ->select(
        'skills.slug as skill_slug',
        'skills.name as skill_name',
        'subcat_children.slug as subchild_slug',
        'subcategories.slug as sub_slug',
        'categories.slug as cat_slug'
    )
    ->get();

    return view('home.sitemap.deepskills', compact('deepskills'));
}


    public function pages()
{
    $pages = DB::table('pages')
        ->select('slug')
        ->where('is_publish', 1)
        ->get();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($pages as $page) {
        $url = url('/page/' . $page->slug); // adjust path if needed
        $xml .= "  <url><loc>{$url}</loc></url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
}



public function BlogXml()
{
    $xml = Cache::remember('blog_sitemap', now()->addHours(6), function () {
        $response = Http::get("https://theytrust.us/blog/wp-json/wp/v2/posts", [
            'per_page' => 100,
            'page' => 1,
            '_embed' => true
        ]);

        $allPosts = collect($response->json());

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($allPosts as $post) {
            $url = url('/blog/' . $post['slug']);
            $date = Carbon::parse($post['modified'])->toAtomString();

            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($url, ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "    <lastmod>{$date}</lastmod>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';
        return $xml;
    });

    return response($xml, 200)->header('Content-Type', 'application/xml');
}

public function htmlFullSitemap()
{
    $pages = [
        ['url' => '/', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/about', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/terms-of-use', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/privacy-policy', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/terms', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/faq', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/contact', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/blogs', 'lastmod' => now()->toDateTimeString()],
        ['url' => '/providers/category', 'lastmod' => now()->toDateTimeString()],
    ];

    $companies = DB::table('companies')->where('is_publish', 1)->get(['name', 'slug']);
    $categories = DB::table('categories')->whereIn('status', [0, 1])->get(['category', 'slug']);
    $subcategories = DB::table('subcategories')->join('categories', 'subcategories.category_id', '=', 'categories.id')
        ->where('subcategories.status', 1)
        ->whereIn('categories.status', [0, 1])
        ->get(['subcategories.subcategory as sub_name', 'subcategories.slug as sub_slug', 'categories.slug as cat_slug']);

    $subsubcategories = DB::table('subcat_children')
    ->join('subcategories', 'subcat_children.subcategory_id', '=', 'subcategories.id')
    ->join('categories', 'subcategories.category_id', '=', 'categories.id')
    ->where('subcat_children.status', 1)
    ->where('subcategories.status', 1)
    ->whereIn('categories.status', [0, 1])
    ->select(
        'subcat_children.slug as subchild_slug',
        'subcat_children.name as subchild_name',
        'subcategories.slug as sub_slug',
        'categories.slug as cat_slug'
    )
    ->get();
$skills = DB::table('skills')
    ->join('subcat_children', 'skills.subcat_child_id', '=', 'subcat_children.id')
    ->join('subcategories', 'subcat_children.subcategory_id', '=', 'subcategories.id')
    ->join('categories', 'subcategories.category_id', '=', 'categories.id')
    ->where('subcat_children.status', 1)
    ->where('subcategories.status', 1)
    ->whereIn('categories.status', [0, 1])
    ->select(
        'skills.slug as skill_slug',
        'skills.name as skill_name',
        'subcat_children.slug as subchild_slug',
        'subcategories.slug as sub_slug',
        'categories.slug as cat_slug'
    )
    ->get();


    return view('home.sitemap.full', compact('pages', 'companies', 'categories', 'subcategories','subsubcategories','skills'));
}





}


