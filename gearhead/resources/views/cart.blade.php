<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Shopping Cart</title>
    <style>
        body {
            background: #eff0f3;
            padding-top: 50px;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .remove-btn {
            color: #dc3545;
            cursor: pointer;
            text-decoration: underline;
        }

        .remove-btn:hover {
            text-decoration: none;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .cart-table th,
        .cart-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .cart-table th {
            background-color: #f2f2f2;
        }

        .cart-item img {
            max-width: 80px;
            margin-right: 10px;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
        }

        .total {
            font-weight: bold;
            font-size: 25px;
            margin-top: 20px;
        }

        .back-to-shopping {
            margin-top: 20px;
        }

        .out-of-stock {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        @if(session('successMessage'))
            <div class="alert alert-success">
                {{ session('successMessage') }}
            </div>
        @endif
        <h2>Your Shopping Cart</h2>
        @php
        $totalPrice = 0; // Initialize totalPrice variable
        $canCheckout = true; // Initialize canCheckout variable
        @endphp
        @if($cart && is_array($cart->items) && count($cart->items) > 0)
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                    $canCheckout = true; // Initialize canCheckout flag
                @endphp
                @foreach($cart->items as $item)
                    @php
                        $itemTotal = $item['price'] * ($item['quantity'] > 0 ? 1 : 0);
                        $totalPrice += $itemTotal;
                        // Check if quantity available is 0
                        if($item['quantity'] == 0) {
                            $canCheckout = false; // Disable checkout if any item has quantity 0
                        }
                    @endphp
                    <tr class="cart-item {{ $item['quantity'] == 0 ? 'out-of-stock' : '' }}">
                        <td>
                            <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}">
                            <div>
                                <h4>{{ $item['name'] }}</h4>
                                @if($item['quantity'] == 0)
                                    <p class="out-of-stock-msg">Out of Stock</p>
                                @endif
                            </div>
                        </td>
                        <td>
                            ₱{{ number_format($item['price'], 2) }}
                        </td>
                        <td>
                            ₱{{ number_format($itemTotal, 2) }}
                        </td>
                        <td>
                            @if($item['quantity'] > 0)
                                <span class="remove-btn" data-item-id="{{ $item['id'] }}">Remove</span>
                            @else
                                <span class="remove-btn" data-item-id="{{ $item['id'] }}">Remove</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Your cart is empty.</p>
        @endif

        @if($cart && $canCheckout) <!-- Only display if cart exists and canCheckout is true -->
        <div class="total">
            Total: ₱{{ number_format($totalPrice, 2) }}
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="back-to-shopping">
                    <a id="checkout-btn" href="{{ route('cart.checkout') }}" class="btn btn-success">Checkout</a>
                    <hr>
                    <a href="/motor" class="btn btn-secondary">Back to shopping</a>
                </div>
            </div>
        </div>
        @elseif($cart && !$canCheckout) <!-- Display a message if cart exists but cannot checkout -->
        <p class="out-of-stock">Cannot proceed to checkout. Some items are out of stock.</p>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="back-to-shopping">
                    <a href="/motor" class="btn btn-secondary">Back to shopping</a>
                </div>
            </div>
        </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function() {
            var stripe = Stripe('pk_test_51Og4l4HmrYAdyFeAFkl5FXT66xD9KIIRTWfSLYLOKqeYyUb7XwyLowbBR5Bo6BGZQrgk2ERqbZZDPoE0C0jYeoi800HmNA5K6V');

            $('.remove-btn').on('click', function() {
                var itemId = $(this).data('item-id');

                var confirmRemove = confirm('Are you sure you want to remove this item from your cart?');

                if (confirmRemove) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('cart.remove') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: itemId,
                        },
                        success: function(response) {
                            console.log(response);
                            alert('Item removed from cart successfully!');
                            location.reload();
                        },
                        error: function(error) {
                            console.error(error);
                            alert('Failed to remove item from cart. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

