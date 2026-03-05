@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="mb-4">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <h1>{{ $category->name }}</h1>

                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Slug</strong></label>
                            <p class="form-control-plaintext"><code>{{ $category->slug }}</code></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Description</strong></label>
                            <p class="form-control-plaintext">{{ $category->description ?? 'No description provided.' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Posts Count</strong></label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-info">{{ $category->posts->count() }}</span>
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Created At</strong></label>
                            <p class="form-control-plaintext">{{ $category->created_at->format('M d, Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Updated At</strong></label>
                            <p class="form-control-plaintext">{{ $category->updated_at->format('M d, Y H:i') }}</p>
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline;">
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
