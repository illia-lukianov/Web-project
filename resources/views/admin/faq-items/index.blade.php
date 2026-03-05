@extends('layouts.admin')

@section('page-title', 'FAQ Items')

@section('admin-content')
    @php
        $columns = ['section','question','answer','sort_order','is_active'];
    @endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">FAQ Items</h3>
            <div class="card-tools">
                <a href="{{ route('admin.faq-items.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> New
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
                        <th>Section</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Sort Order</th>
                        <th>Active</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->section?->title }}</td>
                            <td>{{ $item->question }}</td>
                            <td>{{ str($item->answer)->limit(50) }}</td>
                            <td>{{ $item->sort_order }}</td>
                            <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                            <td>
                                <a href="{{ route('admin.faq-items.edit', $item) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.faq-items.destroy', $item) }}" method="POST" style="display:inline;">
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
                            <td colspan="6" class="text-center py-4">
                                <p class="text-muted mb-0">No FAQ items found. <a href="{{ route('admin.faq-items.create') }}">Create one</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $items->links() }}
        </div>
    </div>
@endsection
