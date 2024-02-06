<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('logo.jpeg') }}" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- fontawesome core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body>
    <form class="form-signin" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-2 text-center">
            <img src="{{ asset('logo.jpeg') }}" class="rounded-circle" width="150">
            <h2 class="fw-bold mb-5 mt-3">
                {{ env('APP_NAME') }}
            </h2>
        </div>

        <div class="form-label-group">
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="email"
                value="{{ old('email') }}" required autofocus>
            <label for="inputEmail">Email Address</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            <label for="inputPassword">Password</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <!-- <hr> -->
                <!-- <p class="text-center">Belum punya akun? <a href="/register">Register</a> sekarang!</p> -->

        <button class="btn btn-lg btn-primary w-100" type="submit">
            <i class="fa fa-unlock-alt"></i> &nbsp; Log in
        </button>

        <p class="text-muted mt-5 text-center">
            Powered by <strong class="text-primary">{{ env('APP_COPYRIGHT') }}</strong> &copy; {{ date('Y') }}
        </p>
    </form>
</body>

</html>
