@extends('layouts.admin')

@section('page-title', 'Portfolio Projects')

@section('admin-content')
    @php
        $columns = ['title','slug','client','is_featured','sort_order','is_active'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Portfolio Projects', 'items' => $projects, 'columns' => $columns, 'routePrefix' => 'admin.portfolio-projects'])
@endsection
