@extends('layouts.admin')

@section('page-title', 'Home Features')

@section('admin-content')
    @php
        $columns = ['title', 'description', 'icon', 'sort_order', 'is_active'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Home Features', 'items' => $features, 'columns' => $columns, 'routePrefix' => 'admin.home-features'])
@endsection
