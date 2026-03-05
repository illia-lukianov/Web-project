@extends('layouts.admin')

@section('page-title', 'Edit Team Member')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Team Member</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.partials.crud-form', ['model' => $teamMember])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save
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
