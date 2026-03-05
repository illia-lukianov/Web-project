@extends('layouts.app')
@section('title', 'Pricing - Modern Business')
@section('content')
<!-- Pricing section-->
<section class="bg-light py-5">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Pay as you grow</h2>
            <p class="lead fw-normal text-muted mb-0">With our no hassle pricing plans</p>
        </div>
        <div class="row gx-5 justify-content-center">
            @forelse($plans as $plan)
                @php
                    $symbol = strtoupper($plan->currency) === 'USD' ? '$' : $plan->currency . ' ';
                    $price = $plan->price_cents % 100 === 0 ? (string) ($plan->price_cents / 100) : number_format($plan->price_cents / 100, 2);
                @endphp
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-5 mb-xl-0 {{ $plan->is_featured ? 'border-primary shadow' : '' }}">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold {{ $plan->is_featured ? '' : 'text-muted' }}">
                                @if($plan->is_featured)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @endif
                                {{ $plan->name }}
                                @if($plan->badge)
                                    <span class="badge bg-primary ms-2">{{ $plan->badge }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <span class="display-4 fw-bold">{{ $symbol }}{{ $price }}</span>
                                <span class="text-muted">/ {{ $plan->billing_period }}.</span>
                            </div>
                            <ul class="list-unstyled mb-4">
                                @foreach($plan->features as $feature)
                                    <li class="mb-2 {{ $feature->is_included ? '' : 'text-muted' }}">
                                        <i class="bi {{ $feature->is_included ? 'bi-check text-primary' : 'bi-x' }}"></i>
                                        {{ $feature->feature }}
                                    </li>
                                @endforeach
                            </ul>
                            <div class="d-grid">
                                <a class="btn {{ $plan->is_featured ? 'btn-primary' : 'btn-outline-primary' }}" href="{{ $plan->cta_url ?: route('contact') }}">
                                    {{ $plan->cta_text ?: 'Choose plan' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted mb-0">No pricing plans yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
