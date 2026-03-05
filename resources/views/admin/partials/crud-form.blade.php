@php
    // helper to decide input type
    function fieldType($name) {
        if (Str::contains($name, ['url'])) return 'url';
        if (Str::contains($name, ['email'])) return 'email';
        if (Str::endsWith($name, '_at')) return 'date';
        if (in_array($name, ['price_cents','sort_order'])) return 'number';
        return 'text';
    }
@endphp

@foreach($model->getFillable() as $field)
    <div class="mb-3">
        <label for="{{ $field }}" class="form-label">{{ ucwords(str_replace('_', ' ', $field)) }}@if(!in_array($field,['is_active','is_featured'])) *@endif</label>

        @if(in_array($field, ['is_active','is_featured']))
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="{{ $field }}" name="{{ $field }}" value="1" {{ old($field, $model->{$field} ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $field }}">Active</label>
            </div>
        @else
            @php $type = fieldType($field); @endphp
            @if($type === 'text' && in_array($field, ['description','body','excerpt','quote','answer']))
                <textarea class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" rows="3">{{ old($field, $model->{$field} ?? '') }}</textarea>
            @else
                <input type="{{ $type }}" class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" value="{{ old($field, $model->{$field} ?? '') }}" @if(!in_array($field,['value','description','body','excerpt','quote','answer'])) required @endif>
            @endif
            @error($field)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        @endif
    </div>
@endforeach
