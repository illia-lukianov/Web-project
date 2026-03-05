@extends('layouts.app')
@section('title', 'About - Modern Business')
@section('content')
<!-- Header-->
<header class="py-5">
    <div class="container px-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-6">
                <div class="text-center my-5">
                    <h1 class="fw-bolder mb-3">
                        Our mission is to make building websites easier for everyone.
                    </h1>
                    <p class="lead fw-normal text-muted mb-4">
                        {{ data_get($site, 'site.company.name', config('app.name')) }} focuses on clean UX, fast pages, and a structure that scales from a landing page to a full content-driven site.
                    </p>
                    <a class="btn btn-primary btn-lg" href="#scroll-target">Read our story</a>
                </div>
            </div>
        </div>
    </div>
</header>

@php($storySections = $aboutSections ?? collect())
@if($storySections->count() > 0)
    @foreach($storySections as $section)
        <section class="py-5 {{ $loop->first ? 'bg-light' : '' }}" id="{{ $loop->first ? 'scroll-target' : '' }}">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 {{ $loop->iteration % 2 === 0 ? 'order-first order-lg-last' : '' }}">
                        <img class="img-fluid rounded mb-5 mb-lg-0" src="{{ $section->image_url ?: 'https://source.unsplash.com/600x400/?story' }}" alt="{{ $section->title }}" />
                    </div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder">{{ $section->title }}</h2>
                        <p class="lead fw-normal text-muted mb-0">{{ $section->body }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endif

<!-- Team members section-->
<section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <div class="text-center">
            <h2 class="fw-bolder">Our team</h2>
            <p class="lead fw-normal text-muted mb-5">Dedicated to quality and your success</p>
        </div>
        <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
            @forelse($teamMembers as $member)
                <div class="col mb-5 mb-5 mb-xl-0">
                    <div class="text-center">
                        <img class="img-fluid rounded-circle mb-4 px-4" src="{{ $member->avatar_url ?: 'https://source.unsplash.com/150x150/?avatar' }}" alt="{{ $member->name }}" />
                        <h5 class="fw-bolder">{{ $member->name }}</h5>
                        <div class="fst-italic text-muted">{{ $member->role }}</div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted mb-0">No team members yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection