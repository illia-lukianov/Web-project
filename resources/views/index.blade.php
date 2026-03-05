@extends('layouts.app')
@section('title', data_get($site, 'site.company.tagline', 'Modern Business') . ' - ' . data_get($site, 'site.company.name', config('app.name')))
@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">
                        Build a modern website for {{ data_get($site, 'site.company.name', config('app.name')) }}
                    </h1>
                    <p class="lead fw-normal text-white-50 mb-4">
                        Blog, pricing, FAQ, and portfolio content are now driven by the database and seeded with real examples.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Get Started</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="{{ route('contact') }}">Contact</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <img class="img-fluid rounded-3 my-5" src="https://source.unsplash.com/600x400/?startup,hero" alt="Hero image" />
            </div>
        </div>
    </div>
</header>

<!-- Features section-->
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">A better way to start building.</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    @forelse($features as $feature)
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="{{ $feature->icon ?: 'bi bi-collection' }}"></i>
                            </div>
                            <h2 class="h5">{{ $feature->title }}</h2>
                            <p class="mb-0">{{ $feature->description }}</p>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted mb-0">No features yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial section-->
@if(($testimonials ?? collect())->count() > 0)
    @php($t = $testimonials->first())
    <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">"{{ $t->quote }}"</div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="rounded-circle me-3" width="40" height="40" src="{{ $t->avatar_url ?: 'https://source.unsplash.com/40x40/?face' }}" alt="{{ $t->name }}" />
                            <div class="fw-bold">
                                {{ $t->name }}
                                @if($t->role || $t->company)
                                    <span class="fw-bold text-primary mx-1">/</span>
                                    {{ trim(($t->role ? $t->role . ', ' : '') . ($t->company ?? ''), ', ') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Blog preview section-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="text-center">
                    <h2 class="fw-bolder">From our blog</h2>
                    <p class="lead fw-normal text-muted mb-5">Latest articles and insights from our team</p>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            @forelse($recentPosts->take(3) as $post)
                @php($minutes = max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)))
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" src="https://source.unsplash.com/600x350/?blog,preview" alt="{{ $post->title }}" />
                        <div class="card-body p-4">
                            @if($post->category)
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $post->category->name }}</div>
                            @endif
                            <a class="text-decoration-none link-dark stretched-link" href="{{ route('blog.post', $post->slug) }}">
                                <h5 class="card-title mb-3">{{ $post->title }}</h5>
                            </a>
                            <p class="card-text mb-0">{{ str(strip_tags($post->content))->limit(100) }}</p>
                        </div>
                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" width="40" height="40" src="https://via.placeholder.com/40x40/007bff/ffffff?text={{ substr($post->user->name, 0, 1) }}" alt="{{ $post->user->name }}" />
                                    <div class="small">
                                        <div class="fw-bold">{{ $post->user->name }}</div>
                                        <div class="text-muted">{{ $post->published_at->format('M d, Y') }} &middot; {{ $minutes }} min read</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No blog posts available yet.</p>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a class="btn btn-primary btn-lg" href="{{ route('blog.home') }}">View All Blog Posts</a>
        </div>
    </div>
</section>

<!-- Call to action-->
<section class="py-5 bg-light">
    <div class="container px-5 my-5 text-center">
        <h2 class="fw-bolder mb-3">Ready to build something together?</h2>
        <p class="lead fw-normal text-muted mb-4">Explore our portfolio or get in touch.</p>
        <a class="btn btn-primary btn-lg me-2" href="{{ route('portfolio.overview') }}">View Portfolio</a>
        <a class="btn btn-outline-primary btn-lg" href="{{ route('contact') }}">Contact Us</a>
    </div>
</section>
@endsection
