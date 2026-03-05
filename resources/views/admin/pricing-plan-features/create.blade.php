@extends('layouts.admin')

@section('page-title', 'Add Plan Feature')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Feature</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pricing-plan-features.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pricing_plan_id" class="form-label">Plan *</label>
                            <select name="pricing_plan_id" id="pricing_plan_id" class="form-control @error('pricing_plan_id') is-invalid @enderror" required>
                                <option value="">-- select --</option>
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}" {{ old('pricing_plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }}</option>
                                @endforeach
                            </select>
                            @error('pricing_plan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @include('admin.partials.crud-form', ['model' => new \App\Models\PricingPlanFeature])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Add
                            </button>
                            <a href="{{ route('admin.pricing-plan-features.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
