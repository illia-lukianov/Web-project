@extends('layouts.admin')

@section('page-title', 'Create Testimonial')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Testimonial</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.testimonials.store') }}" method="POST">
                        @csrf
                        @include('admin.partials.crud-form', ['model' => new \App\Models\Testimonial])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create
                            </button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
