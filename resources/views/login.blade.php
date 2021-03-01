<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

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

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="{{ asset('assets/login/images/signin-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if(Session::has('failed'))
                        <div class="alert alert-danger">
                            {{ Session::get('failed') }}
                        </div>
                    @endif
                    <h2 class="form-title">Sign in</h2>
                    <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="text" name="email" id="your_name" placeholder="Email"
                                   value="{{ old('email') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="your_pass" placeholder="Password"/>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
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
