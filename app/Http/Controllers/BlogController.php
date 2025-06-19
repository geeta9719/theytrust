<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
{
    $page = request()->query('page', 1); // default to 1
    $response = Http::get("https://theytrust.us/blog/wp-json/wp/v2/posts", [
        'per_page' => 6,
        'page' => $page,
    ]);

    if ($response->ok()) {
        $posts = $response->json();
        $totalPosts = $response->header('X-WP-Total');
        $totalPages = $response->header('X-WP-TotalPages');

        return view('blog.blog-list', compact('posts', 'page', 'totalPages'));
    }

    return abort(500, 'Unable to fetch blogs');
}

public function show($id)
{
    $response = Http::get("https://theytrust.us/blog/wp-json/wp/v2/posts/{$id}");

    if ($response->ok()) {
        $post = $response->json();
        return view('blog.blog-detail', compact('post'));
    }

    return abort(404, 'Post not found');
}
}
