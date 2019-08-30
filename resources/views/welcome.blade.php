<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zen Sushi Inventory</title>
    <link rel="icon" href="{{ asset('images/zenicon.png')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>

{{-- <body style="background-image: url({{asset('images/16.jpg')}})"> --}}

<body id=pageWelcome>
    <div id="app" class="container" style="margin-top:5%;
                margin-bottom:100px;">
        <div class="row">

            <div class="col-sm-12 col-md-11 col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-12  col-md-6">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <br>
                                    <br>
                                    <div class="text-center">
                                        <h2> Zen Sushi </h2>
                                        <p>Inventory System</p>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="form-group">


                                        <input placeholder="E-Mail Address" id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="text-align:center;">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">

                                        <input placeholder="Password" id="password" type="password" class="form-control  form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="text-align:center;">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>




                                    <div class="form-group">
                                        {{-- <button class="btn btn-primary btn-block ld-over" id="btnLogin">
                                        Log in
                                        <div class="ld ld-ball ld-broadcast"></div>
                                    </button> --}}
                                        <button type="submit" class="btn btn-primary btn-block ld-over btnLogin">
                                            {{ __('Login') }}
                                             <img style="margin:-10px;" src="{{asset('images/svg_logo/logo7.svg')}}"  class="ld ld-broadcast" />
                                        </button>
                                        <hr class="my-4">
                                    </div>





                                    <div class="form-group text-center text-success">
                                        <a class="btn btn-outline-success btn-block " href="{{ route('page.register') }}">Sign up</a>
                                    </div>
                                    <!-- <div class="form-group text-center">
                                    <a href="https://www.fb.com">Forgot Password?</a>
                                </div> -->
                                </form>
                            </div>

                            <div class="col-sm-12  col-md-6">
                                {{-- <img src="{{asset('images/logo.png')}}" style="width:100%;height:100%;"> --}}
                                <img class="welcome-image">
                            </div>
                            <br>
                            <br>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>