<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title', 'Modern Business')</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <!-- Unified theme CSS-->
        <link href="{{ asset('css/theme-custom.css') }}" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            @include('components.navbar')

            <!-- Page Content -->
            {{-- support both classic section-based views and component slots --}}
            @if(isset($slot) && trim($slot) !== '')
                {{ $slot }}
            @endif

            @yield('content')
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">{{ data_get($site, 'site.footer.copyright', 'Copyright © ' . now()->year) }}</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="{{ route('contact') }}">Contact</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="{{ route('pricing') }}">Pricing</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="{{ route('faq') }}">FAQ</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
