@extends('layouts.admin')

@section('page-title', 'User Details')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Details: {{ $user->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-info' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Email Verified</th>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">Yes</span>
                                    <small class="text-muted">({{ $user->email_verified_at->format('M d, Y H:i') }})</small>
                                @else
                                    <span class="badge bg-warning">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created</th>
                            <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection