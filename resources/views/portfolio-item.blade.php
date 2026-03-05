@extends('layouts.app')
@section('title', 'Portfolio Item - Modern Business')
@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">{{ $project->title }}</h1>
                    @if($project->excerpt)
                        <p class="lead fw-normal text-muted mb-0">{{ $project->excerpt }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row gx-5">
            <div class="col-12">
                <img class="img-fluid rounded-3 mb-5" src="{{ $project->hero_image_url ?: '/images/portfolio/default.jpg' }}" alt="{{ $project->title }}" />
            </div>
            @foreach($project->images as $image)
                <div class="col-lg-6">
                    <img class="img-fluid rounded-3 mb-4" src="{{ $image->image_url }}" alt="{{ $image->caption ?: $project->title }}" />
                    @if($image->caption)
                        <div class="small text-muted mb-4">{{ $image->caption }}</div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="row gx-5 justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    @if($project->description)
                        <p class="lead fw-normal text-muted">{{ $project->description }}</p>
                    @endif

                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        @if($project->project_url)
                            <a class="btn btn-primary" href="{{ $project->project_url }}" target="_blank" rel="noopener noreferrer">
                                View project <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif
                        <a class="btn btn-outline-primary" href="{{ route('portfolio.overview') }}">
                            <i class="bi bi-arrow-left"></i> Back to portfolio
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(($otherProjects ?? collect())->count() > 0)
            <hr class="my-5" />
            <div class="text-center mb-4">
                <h2 class="fw-bolder">Other projects</h2>
                <p class="text-muted mb-0">More work from our portfolio</p>
            </div>
            <div class="row gx-5">
                @foreach($otherProjects as $p)
                    <div class="col-lg-6 col-xl-3 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img class="card-img-top" src="{{ $p->hero_image_url ?: '/images/portfolio/default.jpg' }}" alt="{{ $p->title }}" />
                            <div class="card-body">
                                <div class="fw-bold">{{ $p->title }}</div>
                                @if($p->excerpt)
                                    <div class="small text-muted">{{ str($p->excerpt)->limit(70) }}</div>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('portfolio.item', $p->slug) }}">Open</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
