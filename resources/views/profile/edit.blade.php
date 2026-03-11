<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">{{ __('Profile Settings') }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="container px-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm border-danger">
                        <div class="card-body">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header border-0 bg-transparent">
                            <h6 class="card-title mb-0">👤 Profile Information</h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img src="{{ Auth::user()->image_url ?: 'https://via.placeholder.com/100x100?text=User' }}" alt="{{ Auth::user()->name }}" class="rounded-circle mb-2" style="width:100px;height:100px;object-fit:cover;" />
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Username</small>
                                <p class="fw-bold mb-0">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Email Address</small>
                                <p class="fw-bold mb-0">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <small class="text-muted d-block">Member Since</small>
                                <p class="fw-bold mb-0">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header border-0 bg-transparent">
                            <h6 class="card-title mb-0">🔒 Security</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted d-block">Last Login</small>
                                <p class="fw-bold mb-0">Today at 10:45 AM</p>
                            </div>
                            <div>
                                <small class="text-muted d-block">Active Sessions</small>
                                <p class="fw-bold mb-0"><span class="badge bg-success">1 Active</span></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
