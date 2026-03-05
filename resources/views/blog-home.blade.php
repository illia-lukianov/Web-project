@extends('layouts.app')
@section('title', 'Blog - ' . config('app.name'))
@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h1 class="fw-bolder fs-3 mb-0">Company Blog</h1>
            <div class="small text-muted">
                @if($categorySlug)
                    Category: <span class="badge bg-secondary">{{ $categorySlug }}</span>
                @endif
                @if($tagSlug)
                    Tag: <span class="badge bg-primary">{{ $tagSlug }}</span>
                @endif
                @if($categorySlug || $tagSlug)
                    <a class="ms-2" href="{{ route('blog.home') }}">Clear filters</a>
                @endif
            </div>
        </div>
    </div>
</section>

<div class="container px-5 my-4">
    <p class="small text-center text-muted">
        For an insightful comparison of hand coding versus WYSIWYG editors, check out
        <a href="https://idg.net.ua/blog/hand-coding-vs-wysiwyg" target="_blank" rel="noopener noreferrer">this article</a>.
    </p>
</div>

@if($featuredPost)
    <section class="pb-5">
        <div class="container px-5">
            <div class="card border-0 shadow rounded-3 overflow-hidden">
                <div class="card-body p-0">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5">
                            <div class="p-4 p-md-5">
                                @if($featuredPost->category)
                                    <a class="badge bg-primary bg-gradient rounded-pill mb-2 text-decoration-none link-light" href="{{ route('blog.home', ['category' => $featuredPost->category->slug]) }}">
                                        {{ $featuredPost->category->name }}
                                    </a>
                                @endif
                                <div class="h2 fw-bolder">{{ $featuredPost->title }}</div>
                                <p class="text-muted mb-4">{{ str(strip_tags($featuredPost->content))->limit(170) }}</p>
                                <a class="text-decoration-none" href="{{ route('blog.post', $featuredPost->slug) }}">
                                    Read more <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="bg-featured-blog" style="background-image: url('{{ $featuredPost->image_url }}'); background-size: cover; background-position: center;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="py-5 bg-light">
    <div class="container px-5">
        <div class="row gx-5">
            <div class="col-xl-8">
                <h2 class="fw-bolder fs-5 mb-4">Latest Posts</h2>

                @forelse($posts as $post)
                    <div class="mb-4 pb-4 border-bottom">
                        <div class="small text-muted">{{ $post->published_at->format('M d, Y') }}</div>
                        <a class="link-dark text-decoration-none" href="{{ route('blog.post', $post->slug) }}">
                            <h3 class="mb-2">{{ $post->title }}</h3>
                        </a>
                        <p class="mb-2">{{ str(strip_tags($post->content))->limit(220) }}</p>
                        <div class="small">
                            By {{ $post->user->name }}
                            @if($post->category)
                                in <a class="text-decoration-none" href="{{ route('blog.home', ['category' => $post->category->slug]) }}"><span class="badge bg-secondary">{{ $post->category->name }}</span></a>
                            @endif
                            @if($post->tags->count() > 0)
                                <span class="ms-2">
                                    @foreach($post->tags as $tag)
                                        <a class="text-decoration-none" href="{{ route('blog.home', ['tag' => $tag->slug]) }}"><span class="badge bg-light text-dark border">{{ $tag->name }}</span></a>
                                    @endforeach
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">No blog posts available yet.</p>
                    </div>
                @endforelse

                {{ $posts->links() }}

                <div class="text-end mt-4">
                    <a class="text-decoration-none" href="{{ route('index') }}">
                        <i class="bi bi-arrow-left"></i> Back to Home
                    </a>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="h6 fw-bolder mb-3">Categories</div>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($categories as $cat)
                                <a class="text-decoration-none" href="{{ route('blog.home', ['category' => $cat->slug]) }}">
                                    <span class="badge bg-secondary">{{ $cat->name }} ({{ $cat->posts_count }})</span>
                                </a>
                            @empty
                                <span class="text-muted small">No categories.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="h6 fw-bolder mb-3">Tags</div>
                        <div class="d-flex flex-wrap gap-2">
                            @forelse($tags as $tag)
                                <a class="text-decoration-none" href="{{ route('blog.home', ['tag' => $tag->slug]) }}">
                                    <span class="badge bg-light text-dark border">{{ $tag->name }} ({{ $tag->posts_count }})</span>
                                </a>
                            @empty
                                <span class="text-muted small">No tags.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="h6 fw-bolder">Contact</div>
                        <p class="text-muted mb-3">
                            For press inquiries, email us at
                            <br />
                            <a href="mailto:{{ data_get($site, 'site.contact.press_email', 'press@domain.com') }}">{{ data_get($site, 'site.contact.press_email', 'press@domain.com') }}</a>
                        </p>
                        <div class="h6 fw-bolder">Follow us</div>
                        <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.twitter', '#') }}"><i class="bi bi-twitter"></i></a>
                        <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.facebook', '#') }}"><i class="bi bi-facebook"></i></a>
                        <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.linkedin', '#') }}"><i class="bi bi-linkedin"></i></a>
                        <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.youtube', '#') }}"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection