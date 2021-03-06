<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/customButton.css') }}">

    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{asset('assets/admin/js/nicEdit.js')}}" type="text/javascript"></script>

    <title>Dashboard | Online News Admin Panel</title>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="">Admin Panel</a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->username}}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="{{ route('admin.update_profile') }}" class="dropdown-item">Profile</a>
                        <a href="{{ route('admin.update_password') }}" class="dropdown-item">Change Password</a>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <li class="active">
                    <a href="{{route('admin.home')}}"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#settings" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Settings
                    </a>
                    <ul id="settings" class="list-unstyled collapse">
                        <li><a href="{{route('admin.settings_general')}}">General Settings</a></li>
                        <li><a href="{{route('admin.settings_media')}}">Media Settings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#news" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> News
                    </a>
                    <ul id="news" class="list-unstyled collapse">
                        <li>
                            <a href="{{ route('admin.create_news') }}">Create News</a>
                        </li>
                        <li>
                            <a href="{{route('admin.view_news')}}">View News</a>
                        </li>
                        <li>
                            <a href="{{route('admin.settings_headlines')}}">Headline Settings</a>
                        </li>
                        <li>
                            <a href="{{route('admin.settings_sub_headlines')}}">Sub-Headline Settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#image" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Image
                    </a>
                    <ul id="image" class="list-unstyled collapse">
                        <li><a href="{{ route('admin.create_image') }}">Create Image</a></li>
                        <li><a href="{{route('admin.view_images')}}">View Images</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#video" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Video
                    </a>
                    <ul id="video" class="list-unstyled collapse">
                        <li><a href="{{ route('admin.create_video') }}">Create Video</a></li>
                        <li><a href="{{ route('admin.view_videos') }}">View Videos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#category" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Category
                    </a>
                    <ul id="category" class="list-unstyled collapse">
                        <li><a href="{{ route('admin.create_category') }}">Create Category</a></li>
                        <li><a href="{{ route('admin.view_categories') }}">View Categories</a></li>
                        <li>
                            <a href="{{ route('admin.settings_menu_categories') }}">Menu Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings_index_categories') }}">Front Categories</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings_footer_categories') }}">Footer Categories</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#editor" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Editor
                    </a>
                    <ul id="editor" class="list-unstyled collapse">
                        <li><a href="{{ route('admin.create_editor') }}">Create Editor</a></li>
                        <li><a href="{{ route('admin.view_editors') }}">View Editors</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#reporter" data-toggle="collapse">
                        <i class="fa fa-fw fa-cube"></i> Reporter
                    </a>
                    <ul id="reporter" class="list-unstyled collapse">
                        <li><a href="{{ route('admin.create_reporter') }}">Create Reporter</a></li>
                        <li><a href="{{ route('admin.view_reporters') }}">View Reporters</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="content p-4">
            @yield('contents')
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootadmin.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            @if(session()->has('success'))
            toastr.success("{{ session('success') }}", "Success")
            @endif
            @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error("{{ $error }}", "Whoops")
            @endforeach
            @endif
        });
    </script>
</body>
</html>