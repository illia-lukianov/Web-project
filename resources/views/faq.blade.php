@extends('layouts.app')
@section('title', 'FAQ - Modern Business')
@section('content')
<!-- Page Content-->
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bolder">Frequently Asked Questions</h1>
            <p class="lead fw-normal text-muted mb-0">How can we help you?</p>
        </div>
        <div class="row gx-5">
            <div class="col-xl-8">
                @forelse($faqSections as $section)
                    <h2 class="fw-bolder mb-3">{{ $section->title }}</h2>
                    <div class="accordion mb-5" id="accordionSection{{ $section->id }}">
                        @foreach($section->items as $item)
                            @php($headingId = 'heading_' . $section->id . '_' . $item->id)
                            @php($collapseId = 'collapse_' . $section->id . '_' . $item->id)
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="{{ $headingId }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                                        {{ $item->question }}
                                    </button>
                                </h3>
                                <div class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" id="{{ $collapseId }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionSection{{ $section->id }}">
                                    <div class="accordion-body">
                                        {{ $item->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-muted">No FAQ entries yet.</p>
                @endforelse
            </div>
            <div class="col-xl-4">
                <div class="card border-0 bg-light mt-xl-5">
                    <div class="card-body p-4 py-lg-5">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="text-center">
                                <div class="h6 fw-bolder">Have more questions?</div>
                                <p class="text-muted mb-4">
                                    Contact us at
                                    <br />
                                    <a href="mailto:{{ data_get($site, 'site.contact.support_email', 'support@domain.com') }}">{{ data_get($site, 'site.contact.support_email', 'support@domain.com') }}</a>
                                </p>
                                <div class="h6 fw-bolder">Follow us</div>
                                <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.twitter', '#') }}"><i class="bi bi-twitter"></i></a>
                                <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.facebook', '#') }}"><i class="bi bi-facebook"></i></a>
                                <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.linkedin', '#') }}"><i class="bi bi-linkedin"></i></a>
                                <a class="fs-5 px-2 link-dark" href="{{ data_get($site, 'site.socials.youtube', '#') }}"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection