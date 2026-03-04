<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <a href="#" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>42</h3>
                    <p>Total Posts</p>
                </div>
                <div class="icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <a href="#" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>228</h3>
                    <p>Comments</p>
                </div>
                <div class="icon">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <a href="#" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>1.4K</h3>
                    <p>Total Views</p>
                </div>
                <div class="icon">
                    <i class="bi bi-eye"></i>
                </div>
                <a href="#" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <!-- Main row -->
    <div class="row">
        <div class="col-md-8">
            <!-- TABLE: RECENT USERS -->
            <div class="card">
                <div class="card-header text-bg-primary">
                    <h3 class="card-title">Recent Users</h3>
                    <div class="card-tools ms-auto">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i class="bi bi-dash"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th style="width: 60px">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <td><span class="badge bg-success">User</span></td>
                                    <td><span class="badge bg-info">Active</span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Jane Smith</td>
                                    <td>jane@example.com</td>
                                    <td><span class="badge bg-success">User</span></td>
                                    <td><span class="badge bg-info">Active</span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Admin User</td>
                                    <td>admin@example.com</td>
                                    <td><span class="badge bg-danger">Admin</span></td>
                                    <td><span class="badge bg-info">Active</span></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Bob Johnson</td>
                                    <td>bob@example.com</td>
                                    <td><span class="badge bg-success">User</span></td>
                                    <td><span class="badge bg-warning">Inactive</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- TABLE: RECENT POSTS -->
            <div class="card mt-3">
                <div class="card-header text-bg-primary">
                    <h3 class="card-title">Recent Posts</h3>
                    <div class="card-tools ms-auto">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i class="bi bi-dash"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Views</th>
                                    <th style="width: 80px">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Laravel Best Practices</td>
                                    <td>Admin</td>
                                    <td><span class="badge bg-info">245</span></td>
                                    <td>2026-03-02</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Getting Started with Vue</td>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-info">189</span></td>
                                    <td>2026-03-01</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Advanced PHP Techniques</td>
                                    <td>Admin</td>
                                    <td><span class="badge bg-info">356</span></td>
                                    <td>2026-02-28</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-4">
            <!-- INFO BOX -->
            <div class="info-box">
                <div class="info-box-icon text-bg-info">
                    <i class="bi bi-bar-chart-line"></i>
                </div>
                <div class="info-box-content">
                    <span class="info-box-text">Website Visits</span>
                    <span class="info-box-number">15,234</span>
                    <span class="progress-description">4% Increase from last week</span>
                </div>
            </div>
            <!-- /.info-box -->

            <!-- PROFILE CARD -->
            <div class="card card-primary card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">Your Profile</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid rounded-circle" src="{{ asset('images/adminlte/user4-128x128.jpg') }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center mt-3">{{ Auth::user()->name }}</h3>
                    <p class="text-muted text-center">Administrator</p>
                    <ul class="metadata list-unstyled">
                        <li><b>Email:</b> {{ Auth::user()->email }}</li>
                        <li class="mt-2"><b>Role:</b> <span class="badge bg-danger">Admin</span></li>
                        <li class="mt-2"><b>Joined:</b> {{ Auth::user()->created_at->format('M d, Y') }}</li>
                    </ul>
                </div>
            </div>
            <!-- /.card -->

            <!-- ACTIVITY LIST -->
            <div class="card card-success card-outline mt-3">
                <div class="card-header">
                    <h3 class="card-title">Recent Activity</h3>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="time-label">
                            <span class="bg-success">5 mins ago</span>
                        </li>
                        <li>
                            <i class="bi bi-person-plus-fill text-bg-success timeline-icon"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="bi bi-clock"></i> 5 mins ago</span>
                                <h3 class="timeline-header">New user registered</h3>
                            </div>
                        </li>
                        <li class="time-label">
                            <span class="bg-info">1 hour ago</span>
                        </li>
                        <li>
                            <i class="bi bi-file-earmark-text text-bg-info timeline-icon"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="bi bi-clock"></i> 1 hour ago</span>
                                <h3 class="timeline-header">New post published</h3>
                            </div>
                        </li>
                        <li class="time-label">
                            <span class="bg-warning">3 hours ago</span>
                        </li>
                        <li>
                            <i class="bi bi-chat-dots text-bg-warning timeline-icon"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="bi bi-clock"></i> 3 hours ago</span>
                                <h3 class="timeline-header">Comment approved</h3>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</x-admin-layout>
