<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zen Sushi Inventory</title>
    <link rel="icon" href="{{ asset('images/zenicon.png')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <style type="text/css">
    .centered-block {
    width: 100px; 
    left: 50%; 
    -webkit-transform: translate(-50%, 0); 
    position: absolute;
}
    </style>
</head>

{{-- <body style="background-image: url({{asset('images/16.jpg')}})"> --}}

<body id=pageWelcome>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="ld ld-blur">
                        <img src="{{asset('images/svg_logo/logo1.svg')}}" class="ld ld-float" />
                    </div>

                </div>
                <div class="col text-center">
                    <img src="{{asset('images/svg_logo/logo2.svg')}}" class="ld ld-shadow" />
                </div>
                <div class="col text-center">
                       <button class="btn btn-primary btn-block ld-over running">
                                        My Button
                            <div class="ld ld-ball ld-broadcast"></div>
                      </button>
                        <button class="btn btn-primary btn-block ld-ext-right running">
                                        My Button2
                         
                             <img src="{{asset('images/svg_logo/logo7.svg')}}"  class="ld ld-spin "  />
                      </button>

                       <div class="text-center">
                        <div class="ld-over-full running">
                            <img src="{{asset('images/svg_logo/logo2.svg')}}"  class="ld ld-shadow centered-block"  />
                        </div>
                      </div>

                      <a class="btn btn-danger" href="/">TO HOME</a>

                      

                </div>
            </div>
        </div>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    
</body>

</html>