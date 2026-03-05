@extends('layouts.admin')

@section('page-title', 'About Sections')

@section('admin-content')
    @php
        $columns = ['title', 'body', 'image_url', 'sort_order', 'is_active'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'About Sections', 'items' => $sections, 'columns' => $columns, 'routePrefix' => 'admin.about-sections'])
@endsection
