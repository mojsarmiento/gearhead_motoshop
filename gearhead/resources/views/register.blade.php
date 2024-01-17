<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Signup</title>
    <style>
        @media (max-width: 600px) {
            body {
                overflow-x: hidden;
                background: #eff0f3;
                font-family: Arial;
            }

            nav {
                font-size: 20px;
            }
        }

        @media (min-width: 601px) and (max-width: 992px) {
            body {
                overflow-x: hidden;
                background: #eff0f3;
            }

            nav {
                font-size: 20px;
            }
        }

        @media (min-width: 993px) {
            body {
                overflow-x: hidden;
                background: #eff0f3;
                font-family: Helvetica;
                font-weight: bold;
            }

            nav {
                font-size: 20px;
            }
        }

        #imageCarousel {
            text-align: center;
        }

        .carousel-inner img {
            width: 100%;
            max-height: 500px; /* Adjust the max height as needed */
            margin: auto;
        }

        .carousel-control-prev, .carousel-control-next {
            width: 10%;
            color: #fff;
            opacity: 0.8;
        }

        .carousel-control-prev-icon, .carousel-control-next-icon {
            background-color: #000; /* Adjust the background color as needed */
            border-radius: 50%;
        }

        .carousel-control-prev:hover, .carousel-control-next:hover {
            color: #fff;
            opacity: 1;
        }

        .navbar-nav a:hover {
            color: red; /* Change the color to your desired hover color */
            text-decoration: underline; /* You can use other styles like 'bold', 'italic', etc. */
        }

        .navbar-nav a{
            color:white;
        }

        .brand-logo-container {
            height: 210px; /* Set the height as per your design preference */
            overflow: hidden;
            border: 2px solid #B2BEB5;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
        <a class="navbar-brand" href="/" style="margin-left: 20px;">
            <img src="{{ asset('images/gearhead_logo2.png') }}" alt="GearHead Logo" height="60">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="margin-right:20px;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: start;">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/motor" >MOTORCYCLES</a>
                <a class="nav-item nav-link" href="/accessories" >ACCESSORIES</a>
                <a class="nav-item nav-link" href="/community" >COMMUNITY</a>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: end; margin-right: 35px;">
            <div class="navbar-nav">
                @guest
                    <a class="nav-item nav-link" href="{{ route('login') }}">LOGIN</a>
                    <a class="nav-item nav-link" href="{{ route('register') }}">SIGN UP</a>
                @else
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-item nav-link" style="background: none; border: none; cursor: pointer;">LOGOUT</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>