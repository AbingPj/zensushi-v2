<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <link rel="icon" href="{{ asset('images/zenicon.png')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    {{-- <style>
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
    </style> --}}
</head>

<body id="pageRegister">
    <div id="app" class="container" style="margin-top:5%;
    margin-bottom:100px;">
        <div class="row">

            <div class="col-sm-12 col-md-8 col-lg-7 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="" id="signup_form">
                                        <div class="card border-success mb-3">
                                            <div class="card-header text-success text-center">
                                                <b> Sign-Up</b>
                                            </div>
                                            <div class="card-body text-success">

                                                <div class="form-group">
                                                    <label>{{ __('Name') }}</label>

                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                </div>


                                                <div class="form-group">
                                                    <label for="email">{{ __('E-Mail Address') }}</label>

                                                    <input id="email" type="email" class="form-control border-success @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror

                                                    <small id="text" class="form-text text-muted">Email must be unique.</small>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="password">{{ __('Password') }}</label>


                                                    <input id="password" type="password" class="form-control border-success @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>


                                                    <input id="password-confirm" type="password" class="form-control border-success" name="password_confirmation" required autocomplete="new-password">

                                                </div>


                                                <br>
                                                {{-- <button id="btnSignUp" class="btn btn-success btn-block ld-over"
                                                            type="submit">Sign up
                                                            <div class="ld ld-ball ld-broadcast"></div>
                                                        </button> --}}


                                                <div class="">
                                                    <button type="submit" class="btn btn-success btn-block">
                                                        {{ __('Register') }}
                                                    </button>
                                                </div>


                                                <br>

                                            </div>
                                        </div>
                                    </div>
                                </form>
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