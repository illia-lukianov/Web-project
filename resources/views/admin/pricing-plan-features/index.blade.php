@extends('layouts.admin')

@section('page-title', 'Pricing Plan Features')

@section('admin-content')
    @php
        $columns = ['plan','feature','is_included','sort_order'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Pricing Plan Features', 'items' => $features, 'columns' => $columns, 'routePrefix' => 'admin.pricing-plan-features'])
@endsection
