<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Home</title>
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

    <!-- Bootstrap Carousel -->
    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block 80" src="{{ asset('images/nmax1.jpg') }}" alt="NMAX">
            </div>
            <div class="carousel-item">
                <img class="d-block 80" src="{{ asset('images/suzuki-burgman.png') }}" alt="SUZUKI BURGMAN">
            </div>
            <div class="carousel-item">
                <img class="d-block 80" src="{{ asset('images/honda-eclutch.webp') }}" alt="HONDA E-CLUTCH">
            </div>
            <div class="carousel-item">
                <img class="d-block 80" src="{{ asset('images/kawasaki.jpg') }}" alt="KAWASAKI">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h1 style="margin-top: 40px; font-size: 20px; text-align: center; font-weight: bold;">POPULAR MOTORCYCLES BRANDS</h1>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-2">
                <div class="brand-logo-container">
                    <img class="d-block w-80 h-100 object-fit-cover img-fluid" src="{{ asset('images/suzuki-logo.png') }}" alt="Suzuki Logo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="brand-logo-container">
                    <img class="d-block w-80 h-100 object-fit-cover img-fluid" src="{{ asset('images/honda_logo.png') }}" alt="Honda Logo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="brand-logo-container">
                    <img class="d-block w-80 h-100 object-fit-cover img-fluid" src="{{ asset('images/kawasaki_logo.png') }}" alt="Kawasaki Logo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="brand-logo-container">
                    <img class="d-block w-80 h-100 object-fit-cover v" src="{{ asset('images/yamaha_logo.png') }}" alt="Yamaha Logo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="brand-logo-container">
                    <img class="d-block w-80 h-100 object-fit-cover img-fluid" src="{{ asset('images/bmw_logo.png') }}" alt="Bmw Logo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="brand-logo-container">
                    <img class="d-block w-80 h-100 object-fit-cover img-fluid" src="{{ asset('images/skygo_logo.png') }}" alt="Skygo Logo">
                </div>
            </div>
        </div>
    </div>
</body>
</html>