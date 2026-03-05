<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\ContactMessage;
use App\Models\FaqSection;
use App\Models\HomeFeature;
use App\Models\Post;
use App\Models\PortfolioProject;
use App\Models\PricingPlan;
use App\Models\Category;
use App\Models\Tag;
use App\Models\TeamMember;
use App\Models\Testimonial;
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

        $features = HomeFeature::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $testimonials = Testimonial::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('index', compact('featuredPosts', 'recentPosts', 'features', 'testimonials'));
    }

    /**
     * Display the about page
     */
    public function about()
    {
        $aboutSections = AboutSection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $teamMembers = TeamMember::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('about', compact('aboutSections', 'teamMembers'));
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! Your message has been sent.');
    }

    /**
     * Display the blog home page with all published posts
     */
    public function blogHome()
    {
        $baseQuery = Post::with('user', 'category', 'tags')
            ->whereNotNull('published_at')
            ->latest('published_at');

        $categorySlug = request()->query('category');
        if ($categorySlug) {
            $baseQuery->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        $tagSlug = request()->query('tag');
        if ($tagSlug) {
            $baseQuery->whereHas('tags', fn ($q) => $q->where('slug', $tagSlug));
        }

        $featuredPost = (clone $baseQuery)->first();

        $posts = (clone $baseQuery)
            ->when($featuredPost, fn ($q) => $q->where('id', '!=', $featuredPost->id))
            ->paginate(9)
            ->withQueryString();

        $categories = Category::withCount(['posts' => fn ($q) => $q->whereNotNull('published_at')])
            ->orderBy('name')
            ->get();

        $tags = Tag::withCount(['posts' => fn ($q) => $q->whereNotNull('published_at')])
            ->orderBy('name')
            ->get();

        return view('blog-home', compact('featuredPost', 'posts', 'categories', 'tags', 'categorySlug', 'tagSlug'));
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
        $faqSections = FaqSection::query()
            ->where('is_active', true)
            ->with(['items' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('faq', compact('faqSections'));
    }

    /**
     * Display the pricing page
     */
    public function pricing()
    {
        $plans = PricingPlan::query()
            ->where('is_active', true)
            ->with('features')
            ->orderBy('sort_order')
            ->get();

        return view('pricing', compact('plans'));
    }

    /**
     * Display portfolio overview
     */
    public function portfolioOverview()
    {
        $projects = PortfolioProject::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('portfolio-overview', compact('projects'));
    }

    /**
     * Display portfolio item
     */
    public function portfolioItem(string $slug)
    {
        $project = PortfolioProject::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('images')
            ->firstOrFail();

        $otherProjects = PortfolioProject::query()
            ->where('is_active', true)
            ->where('id', '!=', $project->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('portfolio-item', compact('project', 'otherProjects'));
    }
}
