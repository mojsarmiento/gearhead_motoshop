<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Accessories</title>
    <style>
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
        }

        .navbar-nav a {
            color: white;

        }

        /* Customized Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 220px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #212529;
            padding-top: 20px;
            color: #fff;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 16px;
            color: #adb5bd;
            transition: color 0.3s ease;
        }

        .sidebar a:hover {
            color: #ffc107;
        }

        /* Card Styles */
        .card {
            position: relative;
            overflow: hidden;
        }

        .card img {
            object-fit: cover;
            height: 100%;
            width: 100%;
        }

        .card-hover-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            transition: opacity 0.3s ease-in-out;
        }

        .card:hover .card-hover-overlay {
            opacity: 1;
        }

        .card-description {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 2;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .card-description h4 {
            margin-bottom: 10px;
        }

        .card:hover .card-description {
            transform: translateY(0);
        }

        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }

        #footer {
        margin-top: 270px;
        background-color: #333;
        color: #fff;
        padding: 20px 0;
        }

        .footer {
            display: block;
            text-align: center;
        }

        .brand h1 {
            font-size: 24px;
            margin: 0;
        }

        p {
            font-size: 14px;
            margin: 0;
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
                @auth
                    @if(!auth()->user()->is_seller)
                        <a class="nav-item nav-link" href="/motor">MOTORCYCLES</a>
                        <a class="nav-item nav-link" href="/accessories">ACCESSORIES</a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="justify-content: end; margin-right: 35px;">
            <div class="navbar-nav">
                @guest
                    <a class="nav-item nav-link" href="{{ route('login') }}">LOGIN</a>
                    <a class="nav-item nav-link" href="{{ route('register') }}">SIGN UP</a>
                @else
                    {{-- Removed the seller-related links --}}
                    <a class="nav-item nav-link" href="{{ route('cart') }}">CART</a>
                    <a class="nav-item nav-link" href="{{ route('profile.show') }}">PROFILE</a>
                @endguest
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="mb-3">
            <label for="typeDropdown" class="form-label">Select Accessory Type:</label>
            <select class="form-select" id="brandDropdown">
                <option value="">All Types</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>

            <!-- Your HTML code for displaying accessories -->
            <div class="container mt-4">
                <div class="row row-cols-1 row-cols-md-3 g-4" id="accessoriesContainer">
                    @foreach($accessories as $accessory)
                        <div class="col" data-type="{{ $accessory->type }}">
                            <div class="card">
                                <div style="height: 400px; overflow: hidden; position: relative;">
                                    <img src="{{ Storage::url($accessory->image_path) }}" alt="{{ $accessory->name }}" class="card-img-top">
                                    <div class="card-description">
                                        <h4>{{ $accessory->name }}</h4>
                                        <p>{{ $accessory->description }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if($accessory->quantity > 0)
                                        <p class="card-text">Price: ₱{{ number_format($accessory->price, 2) }}</p>
                                        <br>
                                        <div class="card-buttons">
                                            <button class="btn btn-primary" onclick="addToCart('{{ $accessory->id }}', '{{ $accessory->brand }}', '{{ $accessory->model }}', '{{ $accessory->price }}', '{{ Storage::url($accessory->image_path) }}')">Add to Cart</button>
                                        </div>
                                    @else
                                        <p class="card-text">Price: ₱{{ number_format($accessory->price, 2) }}</p>
                                        <br>
                                        <p class="card-text" style="color: red; font-weight: bold;">Out of Stock</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <section id="footer">
        <div class="footer container">
            <div class="brand">
                <h1>GearHead MotoShop</h1>
            </div>
            <p>Copyright © 2024 GearHead MotoShop. All rights reserved</p>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            var originalOrder = $('#accessoriesContainer').html();

            $('#brandDropdown').on('change', function () {
                var selectedType = $(this).val();
                var container = $('#accessoriesContainer');

                if (selectedType) {
                    // If a type is selected, filter and show only matching cards
                    container.find('.col').hide();
                    container.find('.col[data-type="' + selectedType + '"]').show();
                } else {
                    // If "All Types" selected, show all cards
                    container.find('.col').show();
                }
            });
        });

        function addToCart(accessoryId) {
        // Send AJAX request to add accessory to cart
        $.ajax({
            type: 'POST',
            url: '{{ route('cart.add') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: accessoryId,
                item_type: 'accessory',
            },
            success: function(response) {
                // Handle success, e.g., show a success message
                console.log('{{ route('cart') }}?successMessage=Item added to cart successfully');
                // Redirect to cart page with success message
                window.location.href = '{{ route('cart') }}?successMessage=Item added to cart successfully';
            },
            error: function(error) {
                // Handle error, e.g., show an error message
                console.error(error);
                alert('Failed to add accessory to cart. Please try again.');
            }
        });
    }
    </script>
</body>
</html>
