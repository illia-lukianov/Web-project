<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display the home page with featured posts
     */
    public function index()
    {
        $featuredPosts = Post::with('user', 'category')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        $recentPosts = Post::with('user', 'category')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('index', compact('featuredPosts', 'recentPosts'));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Display the blog home page with all published posts
     */
    public function blogHome()
    {
        $posts = Post::with('user', 'category', 'tags')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);

        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();

        return view('blog-home', compact('posts', 'categories', 'tags'));
    }

    /**
     * Display a single blog post
     */
    public function blogPost($slug)
    {
        $post = Post::with('user', 'category', 'tags')
            ->where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();

        // Get related posts from the same category
        $relatedPosts = Post::with('user', 'category')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog-post', compact('post', 'relatedPosts'));
    }

    /**
     * Display the FAQ page
     */
    public function faq()
    {
        return view('faq');
    }

    /**
     * Display the pricing page
     */
    public function pricing()
    {
        return view('pricing');
    }

    /**
     * Display portfolio overview
     */
    public function portfolioOverview()
    {
        return view('portfolio-overview');
    }

    /**
     * Display portfolio item
     */
    public function portfolioItem()
    {
        return view('portfolio-item');
    }
}
