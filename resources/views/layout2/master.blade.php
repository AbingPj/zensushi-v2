<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name')}} @yield('title') </title>
    @include('layout2.parts.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div id="app2">
        <div class="wrapper">
            @include('layout2.parts.navbar')
            @include('layout2.parts.mainsidebar')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('layout2.parts.controlsidebar')
            @include('layout2.parts.mainfooter')
        </div>
    </div>
    @include('layout2.parts.scripts')
</body>

</html>
