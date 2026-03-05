@extends('layouts.admin')

@section('page-title', 'FAQ Sections')

@section('admin-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">FAQ Sections</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.faq-sections.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> New FAQ Section
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
                                <th>Sort Order</th>
                                <th>Items Count</th>
                                <th>Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sections as $section)
                                <tr>
                                    <td>
                                        <strong>{{ $section->title }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $section->sort_order }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $section->items_count }}</span>
                                    </td>
                                    <td>
                                        @if($section->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.faq-sections.edit', $section) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.faq-sections.destroy', $section) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No FAQ sections found. <a href="{{ route('admin.faq-sections.create') }}">Create one now</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($sections->hasPages())
                    <div class="card-footer">
                        {{ $sections->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection