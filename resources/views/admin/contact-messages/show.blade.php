@extends('layouts.admin')

@section('page-title', 'View Contact Message')

@section('admin-content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Message from {{ $contactMessage->name }}</h3>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
                    <p><strong>Phone:</strong> {{ $contactMessage->phone }}</p>
                    <p><strong>Status:</strong> {{ $contactMessage->status }}</p>
                    <hr>
                    <p>{{ nl2br(e($contactMessage->message)) }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
