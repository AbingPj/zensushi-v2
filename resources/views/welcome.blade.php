<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zen Sushi Inventory</title>
        <link rel="icon" href="{{ asset('images/zenicon.png')}}">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <style>
            body {
                /* background-image: url("/images/16.jpg"); */

                height: 100%;
                background-position: center;
                /* background-repeat: no-repeat; */
                background-size: cover;
                margin-bottom: 0px;
            }

            .card {
                background-color: rgba(230, 233, 230, 0.8);
            }
        </style>
    </head>
    <body style="background-image: url({{asset('images/16.jpg')}})">
        <div class="container" style="margin-top:5%;
                margin-bottom:100px;">
        <div class="row">

            <div class="col-sm-9 col-md-7 col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-12  col-lg-6">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                <div class="text-center">
                                    <h2> Zen Sushi </h2>
                                    <p>Inventory System</p>
                                </div>


                                <div class="form-group">
                                    <div class="text-center" style="margin-bottom:-8px;">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                    </div>

                                    <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="text-align:center;">
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <div class="text-center" style="margin-bottom:-8px;">
                                            <label for="password">{{ __('Password') }}</label>
                                    </div>
                                    <input id="password" type="password" class="form-control  form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="text-align:center;" >
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
                                    <button type="submit" class="btn btn-primary btn-block btnLogin">
                                            {{ __('Login') }}
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

                            <div class="col-sm-12  col-lg-6">
                                <img src="{{asset('images/logo.png')}}" style="width:100%;height:100%;">
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
    <script>
    </script>
    </body>
</html>

