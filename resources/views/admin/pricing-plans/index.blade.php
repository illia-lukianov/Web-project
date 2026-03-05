@extends('layouts.admin')

@section('page-title', 'Pricing Plans')

@section('admin-content')
    @php
        $columns = ['name','slug','price_cents','currency','billing_period','is_featured','sort_order','is_active'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Pricing Plans', 'items' => $plans, 'columns' => $columns, 'routePrefix' => 'admin.pricing-plans'])
@endsection
