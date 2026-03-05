@extends('layouts.app')
@section('title', $post->title . ' - ' . config('app.name'))
@section('content')
            <!-- Page Content-->
            <section class="py-5">
                <div class="container px-5 my-5">
                    <div class="row gx-5">
                        <div class="col-lg-3">
                            <div class="d-flex align-items-center mt-lg-5 mb-4">
                                <img class="img-fluid rounded-circle" src="https://via.placeholder.com/50x50/007bff/ffffff?text={{ substr($post->user->name, 0, 1) }}" alt="{{ $post->user->name }}" />
                                <div class="ms-3">
                                    <div class="fw-bold">{{ $post->user->name }}</div>
                                    <div class="text-muted">
                                        @if($post->category)
                                            {{ $post->category->name }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <!-- Post content-->
                            <article>
                                <!-- Post header-->
                                <header class="mb-4">
                                    <!-- Post title-->
                                    <h1 class="fw-bolder mb-1">{{ $post->title }}</h1>
                                    <!-- Post meta content-->
                                    <div class="text-muted fst-italic mb-2">Published {{ $post->published_at->format('F j, Y') }}</div>
                                    <!-- Post categories and tags-->
                                    @if($post->category)
                                        <a class="badge bg-secondary text-decoration-none link-light me-2" href="{{ route('blog.home', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                                    @endif
                                    @foreach($post->tags as $tag)
                                        <a class="badge bg-primary text-decoration-none link-light me-2" href="{{ route('blog.home', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a>
                                    @endforeach
                                </header>
                                <!-- Preview image figure-->
                                <figure class="mb-4"><img class="img-fluid rounded" src="https://source.unsplash.com/900x400/?article" alt="{{ $post->title }}" /></figure>
                                <!-- Post content-->
                                <section class="mb-5">
                                    {!! nl2br(e($post->content)) !!}
                                </section>
                            </article>

                            <!-- Related posts -->
                            @if($relatedPosts->count() > 0)
                            <div class="mt-5">
                                <h3 class="fw-bolder mb-4">Related Posts</h3>
                                <div class="row">
                                    @foreach($relatedPosts as $relatedPost)
                                    <div class="col-md-6 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('blog.post', $relatedPost->slug) }}" class="text-decoration-none">{{ $relatedPost->title }}</a>
                                                </h5>
                                                <p class="card-text">{{ str(strip_tags($relatedPost->content))->limit(100) }}</p>
                                                <div class="small text-muted">
                                                    By {{ $relatedPost->user->name }} on {{ $relatedPost->published_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Back to blog link -->
                            <div class="mt-4">
                                <a href="{{ route('blog.home') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-left"></i> Back to Blog
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endsection