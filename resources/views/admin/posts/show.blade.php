@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="mb-4">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <h1>{{ $post->title }}</h1>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Author</strong></label>
                            <p class="form-control-plaintext">{{ $post->user->name }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Category</strong></label>
                                    <p class="form-control-plaintext">
                                        @if ($post->category)
                                            <span class="badge bg-secondary">{{ $post->category->name }}</span>
                                        @else
                                            <span class="badge bg-light text-dark">Uncategorized</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Status</strong></label>
                                    <p class="form-control-plaintext">
                                        @if ($post->published_at)
                                            <span class="badge bg-success">Published</span>
                                            <small>{{ $post->published_at->format('M d, Y H:i') }}</small>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Slug</strong></label>
                            <p class="form-control-plaintext"><code>{{ $post->slug }}</code></p>
                        </div>

                        @if ($post->excerpt)
                            <div class="mb-3">
                                <label class="form-label"><strong>Excerpt</strong></label>
                                <p class="form-control-plaintext">{{ $post->excerpt }}</p>
                            </div>
                        @endif

                        @if ($post->tags->count())
                            <div class="mb-3">
                                <label class="form-label"><strong>Tags</strong></label>
                                <p class="form-control-plaintext">
                                    @foreach ($post->tags as $tag)
                                        <span class="badge bg-info">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label"><strong>Content</strong></label>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($post->content)) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Created At</strong></label>
                            <p class="form-control-plaintext">{{ $post->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Updated At</strong></label>
                            <p class="form-control-plaintext">{{ $post->updated_at->format('M d, Y H:i') }}</p>
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure? This action cannot be undone.')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
