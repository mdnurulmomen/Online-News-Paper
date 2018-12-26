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
                    <a href="{{ route('admin.update.profile') }}" class="dropdown-item">Profile</a>
                    <a href="{{ route('admin.update.password') }}" class="dropdown-item">Change Password</a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <li class="active"><a href="{{route('admin.home')}}"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
            <li>
                <a href="#settings" data-toggle="collapse">
                    <i class="fa fa-fw fa-cube"></i> Settings
                </a>
                <ul id="settings" class="list-unstyled collapse">
                    <li><a href="{{route('admin.settings.general')}}">General Settings</a></li>
                    <li><a href="">Other Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="#post" data-toggle="collapse">
                    <i class="fa fa-fw fa-cube"></i> Post
                </a>
                <ul id="post" class="list-unstyled collapse">
                    <li><a href="{{ route('admin.create.post') }}">Create Post</a></li>
                    <li><a href="{{route('admin.view.post')}}">View Posts</a></li>
                </ul>
            </li>
            <li>
                <a href="#category" data-toggle="collapse">
                    <i class="fa fa-fw fa-cube"></i> Categories
                </a>
                <ul id="category" class="list-unstyled collapse">
                    <li><a href="{{ route('admin.create.category') }}">Create Category</a></li>
                    <li><a href="{{route('admin.view.categories')}}">View Categories</a></li>
                </ul>
            </li>
            <li>
                <a href="#editor" data-toggle="collapse">
                    <i class="fa fa-fw fa-cube"></i> Editor
                </a>
                <ul id="editor" class="list-unstyled collapse">
                    <li><a href="{{ route('admin.create.editor') }}">Create Editor</a></li>
                    <li><a href="{{route('admin.view.editors')}}">View Editors</a></li>
                </ul>
            </li>
            <li>
                <a href="#reporter" data-toggle="collapse">
                    <i class="fa fa-fw fa-cube"></i> Reporter
                </a>
                <ul id="reporter" class="list-unstyled collapse">
                    <li><a href="{{ route('admin.create.reporter') }}">Create Reporter</a></li>
                    <li><a href="{{route('admin.view.reporters')}}">View Reporters</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-fw fa-edit"></i> Forms</a></li>
            <li><a href="#"><i class="fa fa-fw fa-table"></i> Datatables</a></li>
        </ul>
    </div>

    <div class="content p-4">

        @yield('contents')

    </div>
</div>

<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootadmin.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{asset('assets/admin/js/nicEdit.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        bkLib.onDomLoaded(function () {
            new nicEditor({iconsPath: '../../assets/admin/images/nicEditorIcons.gif'}).panelInstance('textArea');
        });

        $('[data-toggle="tooltip"]').tooltip();
        @if(session()->has('updateMsg'))
        toastr.success("{{ session('updateMsg') }}", "Success")
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