@extends('layouts.app')
@section('title', 'Contact - Modern Business')
@section('content')
<!-- Page content-->
<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-4">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h1 class="fw-bolder">Get in touch</h1>
                <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-bold mb-2">Please fix the errors below.</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." value="{{ old('name') }}" required />
                            <label for="name">Full name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" required />
                            <label for="email">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" name="phone" type="text" placeholder="+1 (555) 892-9403" value="{{ old('phone') }}" />
                            <label for="phone">Phone number</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 10rem" required>{{ old('message') }}</textarea>
                            <label for="message">Message</label>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row gx-5 row-cols-2 row-cols-lg-4 py-5">
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-dots"></i></div>
                <div class="h5 mb-2">Email us</div>
                <p class="text-muted mb-0">
                    <a href="mailto:{{ data_get($site, 'site.contact.email', 'hello@domain.com') }}">{{ data_get($site, 'site.contact.email', 'hello@domain.com') }}</a>
                </p>
            </div>
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
                <div class="h5">Support</div>
                <p class="text-muted mb-0">
                    <a href="mailto:{{ data_get($site, 'site.contact.support_email', 'support@domain.com') }}">{{ data_get($site, 'site.contact.support_email', 'support@domain.com') }}</a>
                </p>
            </div>
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-question-circle"></i></div>
                <div class="h5">Support center</div>
                <p class="text-muted mb-0">Browse <a href="{{ route('faq') }}">FAQ</a> to find quick answers.</p>
            </div>
            <div class="col">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                <div class="h5">Call us</div>
                <p class="text-muted mb-0">{{ data_get($site, 'site.contact.phone', '+1 (555) 892-9403') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection