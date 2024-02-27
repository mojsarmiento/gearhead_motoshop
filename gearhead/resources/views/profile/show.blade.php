<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Show Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

        @media (max-width: 600px) {
            body {
                overflow-x: hidden;
                background: #eff0f3;
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
            }

            nav {
                font-size: 20px;
            }
        }

        .navbar-nav a:hover {
            color: red;
            /* Change the color to your desired hover color */
        }

        .navbar-nav a {
            color: white;
        }

        .brand-logo-container {
            height: 210px;
            /* Set the height as per your design preference */
            overflow: hidden;
            border: 2px solid #B2BEB5;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Updated styles for the profile page */
        .main-content {
            margin-left: 220px; /* Adjust the margin based on your sidebar width */
            padding: 20px;
        }

        .profile-container {
            margin-top: 2rem;
        }

        .profile-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-card-header {
            background-color: #343a40;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .profile-card-body {
            padding: 1.5rem;
        }

        .profile-card-body p {
            margin-bottom: 0.5rem;
        }

        .edit-profile-btn {
            background-color: #007bff;
            color: white;
            border: none;
        }

        /* Updated styles for the sidebar */
            .sidebar {
        height: calc(100vh - 85px); /* Adjust the height as needed, subtracting the height of the navbar */
        width: 220px;
        position: fixed;
        z-index: 1;
        top: 85px; /* Match the height of your navbar */
        left: 0;
        background-color: #212529;
        /* Dark background color */
        padding-top: 20px;
        color: #fff;
        /* Text color */
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-right: 20px;
        /* Added margin to prevent overlapping */
        }

        .sidebar a {
        padding: 10px;
        text-decoration: none;
        font-size: 16px;
        color: #adb5bd;
        /* Link color */
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
        }

        .sidebar a:hover {
        color: #ffc107;
        /* Hover color */
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

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup1" style="justify-content: start;">
            <div class="navbar-nav">
                @auth
                <a class="nav-item nav-link" href="/motor">MOTORCYCLES</a>
                <a class="nav-item nav-link" href="/accessories">ACCESSORIES</a>
                @endauth
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup2" style="justify-content: end; margin-right: 35px;">
            <div class="navbar-nav">
                @guest
                <a class="nav-item nav-link" href="{{ route('login') }}">LOGIN</a>
                <a class="nav-item nav-link" href="{{ route('register') }}">SIGN UP</a>
                @else
                <a class="nav-item nav-link" href="{{ route('cart') }}">CART</a>
                <a class="nav-item nav-link" href="{{ route('profile.show') }}">PROFILE</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <div class="sidebar-heading">Profile</div>
                <a class="nav-link" href="{{ route('profile.edit') }}">
                    <i class="bi bi-pencil me-2"></i> Edit Profile
                </a>
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="bi bi-cart me-2"></i> Orders
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="padding: 0; background: none; border: none; cursor: pointer;">
                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 main-content">
                <div class="profile-container">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            Your Profile
                        </div>
                        <div class="profile-card-body">
                            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                            <!-- Add other profile fields as needed -->

                            <a href="{{ route('profile.edit') }}" class="btn btn-primary edit-profile-btn">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

