@extends('layouts.admin')

@section('page-title', 'Testimonials')

@section('admin-content')
    @php
        $columns = ['name', 'role', 'company', 'quote', 'avatar_url', 'sort_order', 'is_active'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Testimonials', 'items' => $testimonials, 'columns' => $columns, 'routePrefix' => 'admin.testimonials'])
@endsection
