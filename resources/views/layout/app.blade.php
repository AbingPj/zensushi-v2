<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{config('app.name')}} @yield('title') </title>
    @include('layout.partials.head')  
  </head>
  <body>
      <div id="app">
        @include('layout.partials.nav')
        <div class="main-container">

            @yield('content')
        </div>
        @include('layout.partials.footer')
      </div>
      @include('layout.partials.footer-scripts')
  </body>
</html>
