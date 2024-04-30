<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Tautkan ke file CSS yang diperlukan -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
    <!-- Tautkan ke font dan Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Tautkan ke FontAwesome -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <img src="{{ asset('images/background.png') }}" class="background" alt="Background Image">
                </div>
            </div> 
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="d-flex justify-content-center featured-image mb-3">
                        <img src="{{ asset('images/avatar.png') }}" class="avatar" alt="Avatar Image">
                    </div>
                    <div>
                        <h2>Hello, Again</h2>
                        <p>We are happy to have you back.</p>
                        <form id="loginForm" method="GET">
                            <div class="mb-3">
                                <label for="user" class="form-label">{{ __('Email') }}</label>
                                <input id="user" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                            </div>
                            <div class="mb-3 form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900 ms-2">{{ __('Forgot your password?') }}</a>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-lg btn-success w-100 fs-6">login</button>
                            </div>
                        </form>
                        <div class="mb-3">
                            <button class="btn btn-lg btn-light w-100 fs-6"><img src="{{ asset('images/google.png') }}" alt="Google Logo" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan elemen untuk loading indicator -->
    <div id="loading" style="display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

    <!-- Tambahkan script JavaScript -->
   <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);

        // Tampilkan loading indicator saat pengguna mengirim formulir
       document.getElementById('loading').style.display = 'block';

        fetch('api/login', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'accept': 'application/json',
            },
            body: JSON.stringify({
                email: formData.get('email'),
                password: formData.get('password'),
            })

        })
        .then(response => {
            console.log(response);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // if (data.status.status ==) {
                if (data.data.status === 'accepted') {
                    window.location.href = '/dashboard';
                } else if (data.data.status === 'pending') {
                    // Tampilkan loading indicator 
                    document.getElementById('loading').style.display = 'block';
                    // Tampilkan pesan atau animasi loading
                    // document.getElementById('loading').innerHTML = 'Waiting for account approval...';
                    pollAccountStatus(data.data.token); // Memanggil fungsi pollAccountStatus untuk memeriksa status setiap 3 detik
                } else {
                    alert('Your account is not rejected.');
                    document.getElementById('loading').style.display = 'none'; // Sembunyikan loading indicator jika tidak rejected
                }
            // } else {
            //     alert(data.message || 'An error occurred. Please try again later.');
            //     document.getElementById('loading').style.display = 'none'; // Sembunyikan loading indicator jika tidak ada status
            // }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later. Error dari dari cekstatus');

            // Sembunyikan loading indicator jika terjadi kesalahan
            document.getElementById('loading').style.display = 'none';
        });
    });

    function pollAccountStatus(token) {
        const checkStatus = () => {
            console.log('Checking account status...');
            console.log(token);
            fetch('/api/status', {
                method: 'GET',
                headers:{
                    'Content-Type': 'application/json',
                    'accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                }
            })
            .then(response => {
                console.log(response);
                console.log('ini respon dari /api/status');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // if (data.status) {
                    if (data.data.status === 'accepted') {
                        window.location.href = '/dashboard';
                    } else if (data.data.status === 'pending') {
                        // Tampilkan pesan atau animasi loading
                    console.log(data.message);
                        // Recursively call checkStatus after 3 seconds
                        setTimeout(checkStatus, 3000);
                    } else {
                        alert('Your account is not rejected.');
                    }
                // } else {
                //     alert(data.message || 'user not found.');
                // }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });
        };

        // Memanggil fungsi pengecekan status secara rekursif
        checkStatus();
    }
</script>

</body>
</html>
