@extends('layouts.admin')

@section('page-title', 'Project Images')

@section('admin-content')
    @php
        $columns = ['project','image_url','caption','sort_order'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Portfolio Images', 'items' => $images, 'columns' => $columns, 'routePrefix' => 'admin.portfolio-project-images'])
@endsection
