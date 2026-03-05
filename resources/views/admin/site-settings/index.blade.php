@extends('layouts.admin')

@section('page-title', 'Site Settings')

@section('admin-content')
    @php
        $columns = ['key', 'value'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Site Settings', 'items' => $settings, 'columns' => $columns, 'routePrefix' => 'admin.site-settings'])
@endsection
