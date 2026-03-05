@extends('layouts.admin')

@section('page-title', 'Team Members')

@section('admin-content')
    @php
        $columns = ['name','role','avatar_url','sort_order','is_active'];
    @endphp
    @include('admin.partials.crud-index', ['title' => 'Team Members', 'items' => $members, 'columns' => $columns, 'routePrefix' => 'admin.team-members'])
@endsection
