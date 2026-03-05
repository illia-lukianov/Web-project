@extends('layouts.admin')

@section('page-title', 'Edit Home Feature')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Home Feature</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.home-features.update', $homeFeature) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.partials.crud-form', ['model' => $homeFeature])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save
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
