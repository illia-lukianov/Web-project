@extends('layouts.admin')

@section('page-title', 'Create Home Feature')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Home Feature</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.home-features.store') }}" method="POST">
                        @csrf
                        @include('admin.partials.crud-form', ['model' => new \App\Models\HomeFeature])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create
                            </button>
                            <a href="{{ route('admin.home-features.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
