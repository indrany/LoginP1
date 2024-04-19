<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/media.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-2 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-2">
                    <img src="images/background.png" class="background" >
                </div>
            </div> 
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center featured-image mb-2">
                        <img src="images/avatar.png" class="avatar" alt="Avatar Image">
                    </div>
                    <div>
                        <h2>Hello, Again</h2>
                        <p>We are happy to have you back.</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                            </div>
                            <div class="mb-2">
                                <label for="user" class="form-label">{{ __('Email') }}</label>
                                <input id="user" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>
                            <div class="flex items-center justify-end mt-3">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Already have an account? Login') }}
                                </a>
                            </div>
                            <div class="mt-3 mb-2">
                                <button type="submit" class="btn btn-lg btn-success w-100 fs-6">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
