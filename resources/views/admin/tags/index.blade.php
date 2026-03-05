@extends('layouts.admin')

@section('page-title', 'Tags')

@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tags</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> New Tag
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
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Posts</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tags as $tag)
                                <tr>
                                    <td>
                                        <strong>{{ $tag->name }}</strong>
                                    </td>
                                    <td>
                                        <code>{{ $tag->slug }}</code>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $tag->posts_count }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" style="display:inline;">
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
                                    <td colspan="4" class="text-center py-4">
                                        <p class="text-muted mb-0">No tags found. <a href="{{ route('admin.tags.create') }}">Create one</a></p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
