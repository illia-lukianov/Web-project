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
                    <div class="text-center mb-4">
                        @if($user->image_url)
                            <img src="{{ $user->image_url }}" alt="{{ $user->name }}" class="rounded-circle mb-3" width="120" height="120">
                        @else
                            <div class="bg-secondary rounded-circle d-inline-block mb-3" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <h4>{{ $user->name }}</h4>
                    </div>
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
                            <th>Profile Image</th>
                            <td>
                                @if($user->image_url)
                                    <a href="{{ $user->image_url }}" target="_blank">{{ $user->image_url }}</a>
                                @else
                                    <span class="text-muted">No image set</span>
                                @endif
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