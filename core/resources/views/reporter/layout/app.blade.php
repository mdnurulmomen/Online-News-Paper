<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/reporter/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/reporter/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/reporter/css/bootadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/reporter/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/reporter/css/bootstrap-toggle.min.css') }}">

    <title>Dashboard | Online News Admin Panel</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="">Admin Panel</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{\Illuminate\Support\Facades\Auth::guard('reporter')->user()->username}}</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="{{ route('reporter.update.profile') }}" class="dropdown-item">Profile</a>
                    <a href="{{ route('reporter.update.password') }}" class="dropdown-item">Change Password</a>
                    <a href="{{ route('reporter.logout') }}" class="dropdown-item">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <li class="active"><a href="{{route('reporter.home')}}"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</a></li>
            <li>
                <a href="#view" data-toggle="collapse">
                    <i class="fa fa-fw fa-cube"></i> Post
                </a>
                <ul id="view" class="list-unstyled collapse">
                    <li><a href="{{route('reporter.create.post')}}">Create Post</a></li>
                    <li><a href="{{route('reporter.view.posts')}}">View Posts</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-fw fa-table"></i> Datatables</a></li>
        </ul>
    </div>

    <div class="content p-4">

        @yield('contents')

    </div>
</div>

<script src="{{ asset('assets/reporter/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/reporter/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/reporter/js/bootadmin.min.js') }}"></script>
<script src="{{ asset('assets/reporter/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/reporter/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{asset('assets/reporter/js/nicEdit.js')}}" type="text/javascript"></script>
<script>
    bkLib.onDomLoaded(function () {
        new nicEditor({iconsPath: '../../assets/reporter/images/nicEditorIcons.gif'}).panelInstance('textArea');
    });
</script>
<script>
    (function ($) {
        $(document).ready(function () {
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
    })(jQuery);
</script>
</body>
</html>