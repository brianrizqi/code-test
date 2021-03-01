<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up </title>

    <!-- Font Icon -->
    <link rel="stylesheet"
          href="{{ asset('assets/login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    <style>
        .alert {
            padding: 20px;
            color: white;
        }

        .alert-danger {
            background-color: #f44336;
        }

        .alert-success {
            background-color: limegreen;
        }
    </style>
</head>
<body>

<div class="main">
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as  $e)
                                    <li>{{$e}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="register-form" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"
                                   value="{{ old('email') }}" required/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirmation" id="re_pass"
                                   placeholder="Repeat your password" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="terms" id="agree-term" class="agree-term" required/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                statements in <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('assets/login/images/signup-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('login') }}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- JS -->
<script src="{{ asset('assets/login/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/login/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
