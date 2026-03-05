@extends('layouts.app')
@section('title', 'Portfolio Overview - Modern Business')
@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bolder">Our Work</h2>
            <p class="lead fw-normal text-muted mb-0">Company portfolio</p>
        </div>
        <div class="row gx-5">
            @forelse($projects as $project)
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg overflow-hidden mb-5 h-100">
                        <img class="card-img-top" src="{{ $project->hero_image_url ?: '/images/portfolio/default.jpg' }}" alt="{{ $project->title }}" />
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            @if($project->excerpt)
                                <p class="text-muted mb-4">{{ $project->excerpt }}</p>
                            @endif
                            <div class="mt-auto">
                                <a class="btn btn-primary" href="{{ route('portfolio.item', $project->slug) }}">View Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted mb-0">No portfolio projects yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <h2 class="display-4 fw-bolder mb-4">Let's build something together</h2>
        <a class="btn btn-lg btn-primary" href="{{ route('contact') }}">Contact us</a>
    </div>
</section>
@endsection
