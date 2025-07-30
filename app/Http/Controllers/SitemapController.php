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
    public function index()
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        $content .= '  <sitemap><loc>' . url('/sitemap-pages.xml') . '</loc></sitemap>' . "\n";
        $content .= '  <sitemap><loc>' . url('/sitemap-profiles.xml') . '</loc></sitemap>' . "\n";
        $content .= '  <sitemap><loc>' . url('/sitemap-companies.xml') . '</loc></sitemap>' . "\n";
        $content .= '  <sitemap><loc>' . url('/sitemap-categories.xml') . '</loc></sitemap>' . "\n";
        $content .= '  <sitemap><loc>' . url('/sitemap-subcategories.xml') . '</loc></sitemap>' . "\n";
        $content .= '  <sitemap><loc>' . url('blog/sitemap_index.xml') . '</loc></sitemap>' . "\n";
        $content .= '</sitemapindex>';

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
    public function companies()
    {
        $companies = DB::table('companies')
        ->select('slug')
        ->where('is_publish', 1)
        ->get();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($companies as $company) {
        $url = url("/profile/" . $company->slug);
        $xml .= "  <url><loc>{$url}</loc></url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    public function categories()
    {
        $categories = DB::table('categories')
            ->select('slug')
            ->whereIn('status', [0, 1])
            ->get();
    
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
        foreach ($categories as $category) {
            $url = url('companies/' . $category->slug);
            $escapedUrl = htmlspecialchars($url, ENT_XML1, 'UTF-8'); // ✅ escape special characters
            $xml .= "  <url><loc>{$escapedUrl}</loc></url>\n";
        }
    
        $xml .= '</urlset>';
    
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
    

    public function subcategories()
    {
        $subcategories = DB::table('subcategories')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where('subcategories.status', 1)
            ->whereIn('categories.status', [0, 1])
            ->select('subcategories.slug as sub_slug', 'categories.slug as cat_slug')
            ->get();
    
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
        foreach ($subcategories as $item) {
            $url = url('companies/' . $item->cat_slug . '/' . $item->sub_slug);
            $escapedUrl = htmlspecialchars($url, ENT_XML1, 'UTF-8');
            $xml .= "  <url><loc>{$escapedUrl}</loc></url>\n";
        }
    
        $xml .= '</urlset>';
    
        return response($xml, 200)->header('Content-Type', 'application/xml');
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


}


