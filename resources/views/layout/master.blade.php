<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name')}} @yield('title') </title>
    @include('layout.parts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div id="app2">
        <div class="wrapper">
            @include('layout.parts.navbar')
            @include('layout.parts.mainsidebar')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('layout.parts.controlsidebar')
            @include('layout.parts.mainfooter')
        </div>
    </div>
    @include('layout.parts.scripts')
</body>

</html>
