@extends('layouts.admin')

@section('page-title', 'Create Pricing Plan')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Pricing Plan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pricing-plans.store') }}" method="POST">
                        @csrf
                        @include('admin.partials.crud-form', ['model' => new \App\Models\PricingPlan])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create
                            </button>
                            <a href="{{ route('admin.pricing-plans.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
