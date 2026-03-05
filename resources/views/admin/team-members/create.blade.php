@extends('layouts.admin')

@section('page-title', 'Add Team Member')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Team Member</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.team-members.store') }}" method="POST">
                        @csrf
                        @include('admin.partials.crud-form', ['model' => new \App\Models\TeamMember])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Add
                            </button>
                            <a href="{{ route('admin.team-members.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
