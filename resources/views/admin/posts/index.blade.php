@extends('layouts.admin')

@section('page-title', 'Posts')

@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Posts</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> New Post
                        </a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Published</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>
                                        <strong>{{ $post->title }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <code>{{ $post->slug }}</code>
                                        </small>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        @if ($post->category)
                                            <span class="badge bg-secondary">{{ $post->category->name }}</span>
                                        @else
                                            <span class="badge bg-light text-dark">Uncategorized</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->published_at)
                                            <small>{{ $post->published_at->format('M d, Y') }}</small>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <p class="text-muted mb-0">No posts found. <a href="{{ route('admin.posts.create') }}">Create one</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
