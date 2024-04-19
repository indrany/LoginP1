<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <img src="images/background.png" class="background" >
                </div>
            </div> 
            <!-------------------- ------ Right Box ---------------------------->
            <div class="col-md-6 right-box">
                <!-- Konten yang telah ada sebelumnya -->
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center featured-image mb-3">
                        <img src="images/avatar.png" class="avatar" alt="Avatar Image">
                    </div>
                    <div>
                        <h2>Hello, Again</h2>
                        <p>We are happy to have you back.</p>
                        <!-- Kode formulir login yang diberikan -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div>
                                <label for="user" class="form-label">{{ __('Email') }}</label>
                                <input id="user" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            </div>
                            <!-- Password -->
                            <div class="mt-4">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                            </div>
                            <!-- Remember me dan forgot your password -->
                            <div class="d-flex justify-content-between align-items-center block mt-4">
                                <label for="remember_me" class="form-check-label mb-0">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    {{ __('Remember me') }}
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="mt-4 mb-2">
                                <button type="submit" class="btn btn-lg btn-success w-100 fs-6">{{ __('Login') }}</button>
                            </div>
                        </form>
                        <div class=" mb-3">
                            <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google.png" alt="Google Logo" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/main.js"></script>
</html>
