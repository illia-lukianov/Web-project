@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('admin-content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\User::count() }}</h3>
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
                    <h3>{{ \App\Models\Post::count() }}</h3>
                    <p>Total Posts</p>
                </div>
                <div class="icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ \App\Models\Category::count() }}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="bi bi-folder"></i>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-sm-6">
            <!-- small box -->
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ \App\Models\Tag::count() }}</h3>
                    <p>Tags</p>
                </div>
                <div class="icon">
                    <i class="bi bi-tags"></i>
                </div>
                <a href="{{ route('admin.tags.index') }}" class="small-box-footer link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    More info <i class="bi bi-link-45deg"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Recent Posts
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-0">
                        @if(\App\Models\Post::count() > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Post::with('user')->latest()->take(5)->get() as $post)
                                        <tr>
                                            <td>{{ Str::limit($post->title, 30) }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>
                                                @if($post->published_at)
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-warning">Draft</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted text-center py-4">No posts yet. <a href="{{ route('admin.posts.create') }}">Create your first post</a></p>
                        @endif
                    </div>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
            <!-- solid sales graph -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i>
                        Quick Actions
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Post
                        </a>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> New Category
                        </a>
                        <a href="{{ route('admin.tags.create') }}" class="btn btn-warning">
                            <i class="fas fa-plus"></i> New Tag
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-info">
                            <i class="fas fa-user"></i> Edit Profile
                        </a>
                    </div>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
@endsection
