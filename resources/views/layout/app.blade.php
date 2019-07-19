<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>
  <body>
      <div id="app">
        @include('layout.partials.nav')
        <div class="main-container">
        {{-- <div class="container"> --}}
            @yield('content')
        </div>
        @include('layout.partials.footer')
      </div>
      @include('layout.partials.footer-scripts')
  </body>
</html>
