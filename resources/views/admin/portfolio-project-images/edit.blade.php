@extends('layouts.admin')

@section('page-title', 'Edit Project Image')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Image</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.portfolio-project-images.update', $portfolioProjectImage) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="portfolio_project_id" class="form-label">Project *</label>
                            <select name="portfolio_project_id" id="portfolio_project_id" class="form-control @error('portfolio_project_id') is-invalid @enderror" required>
                                <option value="">-- select --</option>
                                @foreach($projects as $proj)
                                    <option value="{{ $proj->id }}" {{ old('portfolio_project_id', $portfolioProjectImage->portfolio_project_id) == $proj->id ? 'selected' : '' }}>{{ $proj->title }}</option>
                                @endforeach
                            </select>
                            @error('portfolio_project_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @include('admin.partials.crud-form', ['model' => $portfolioProjectImage])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <a href="{{ route('admin.portfolio-project-images.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
