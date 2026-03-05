@extends('layouts.admin')

@section('page-title', 'Create FAQ Item')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create FAQ Item</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.faq-items.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="faq_section_id" class="form-label">Section *</label>
                            <select name="faq_section_id" id="faq_section_id" class="form-control @error('faq_section_id') is-invalid @enderror" required>
                                <option value="">-- select --</option>
                                @foreach($sections as $sec)
                                    <option value="{{ $sec->id }}" {{ old('faq_section_id') == $sec->id ? 'selected' : '' }}>{{ $sec->title }}</option>
                                @endforeach
                            </select>
                            @error('faq_section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        @include('admin.partials.crud-form', ['model' => new \App\Models\FaqItem])
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create
                            </button>
                            <a href="{{ route('admin.faq-items.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
