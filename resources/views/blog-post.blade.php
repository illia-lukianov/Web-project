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
                                        <a class="badge bg-secondary text-decoration-none link-light me-2" href="#">{{ $post->category->name }}</a>
                                    @endif
                                    @foreach($post->tags as $tag)
                                        <a class="badge bg-primary text-decoration-none link-light me-2" href="#">{{ $tag->name }}</a>
                                    @endforeach
                                </header>
                                <!-- Preview image figure-->
                                <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="{{ $post->title }}" /></figure>
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
                                                <p class="card-text">{{ Str::limit(strip_tags($relatedPost->content), 100) }}</p>
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
                            <!-- Comments section-->
                            <section>
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <!-- Comment form-->
                                        <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                        <!-- Comment with nested comments-->
                                        <div class="d-flex mb-4">
                                            <!-- Parent comment-->
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                                <!-- Child comment 1-->
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                    <div class="ms-3">
                                                        <div class="fw-bold">Commenter Name</div>
                                                        And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                                    </div>
                                                </div>
                                                <!-- Child comment 2-->
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                    <div class="ms-3">
                                                        <div class="fw-bold">Commenter Name</div>
                                                        When you put money directly to a problem, it makes a good headline.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single comment-->
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
@endsection