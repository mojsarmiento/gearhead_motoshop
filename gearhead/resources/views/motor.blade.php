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

        .navbar-nav a:hover {
            color: red; /* Change the color to your desired hover color */
            text-decoration: underline; /* You can use other styles like 'bold', 'italic', etc. */
        }

        .navbar-nav a{
            color:white;
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
                <a class="nav-item nav-link" href="{{ route('login') }}" >LOGIN</a>
                <a class="nav-item nav-link" href="{{ route('register') }}" >SIGN UP</a>
            </div>
        </div>
    </nav>
    <h1>MOTORCYCLES</h1>
</body>
</html>