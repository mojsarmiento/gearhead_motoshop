<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            padding-top: 50px;
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            border-color: #343a40;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center; /* Center align the table header */
        }

        .table tbody tr:hover {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 100px;
            max-height: 100px;
            border-radius: 5px;
        }

        .d-flex {
            display: flex !important; /* Use flexbox */
        }

        .justify-content-center {
            justify-content: center !important; /* Center justify content horizontally */
        }

        .align-items-center {
            align-items: center !important; /* Center align items vertically */
        }
    </style>
</head>

<body>
    <div class="container">
        @if(session('success'))
        <div id="successMessage" class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        <h1 class="text-center mb-4">Order Details</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Payment Method</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Order Date</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Product Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="text-center align-items-center">{{ $order->id }}</td>
                        <td class="text-center align-items-center">₱{{ number_format($order->total_amount, 2) }}</td>
                        <td class="text-center align-items-center">{{ $order->payment_method }}</td>
                        <td class="text-center align-items-center">{{ $order->status }}</td>
                        <td class="text-center align-items-center">{{ $order->created_at }}</td>
                        <td class="text-center align-items-center">
                            <ul class="list-unstyled">
                                @foreach(explode(',', $order->product_names) as $productName)
                                <li>{{ $productName }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center align-items-center">
                            <div class="d-flex justify-content-center flex-wrap">
                                @foreach(explode(',', $order->product_images) as $imagePath)
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Product Image" class="product-image me-2 mb-2">
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('orders.cancel', ['id' => $order->id]) }}" method="post" id="cancelForm{{ $order->id }}">
                                @csrf
                                <button type="button" class="btn btn-danger"
                                    @if($order->status == 'shipped' || $order->status == 'delivered' || $order->status == 'cancelled')
                                        disabled
                                    @endif
                                    onclick="cancelOrder({{ $order->id }})">Cancel Order
                                </button>
                            </form>

                            @if($order->status == 'cancelled')
                                <form action="{{ route('orders.destroy', ['id' => $order->id]) }}" method="post" id="removeForm{{ $order->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary mt-1">Remove</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('profile.show') }}" class="btn btn-primary">Back to Profile</a>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#successMessage").delay(2500).fadeOut(500);
        });

        function cancelOrder(orderId) {
            // Send an AJAX request to cancel the order
            $.ajax({
                url: '{{ route('orders.cancel', ['id' => ':orderId']) }}'.replace(':orderId', orderId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Add CSRF token to the request
                },
                success: function(response) {
                    // Handle success response
                    console.log('Order cancelled successfully:', response);
                    // Reload the page or update the UI as needed
                    location.reload(); // Reload the page to reflect the changes
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error cancelling order:', error);
                    // Display an error message or handle the error scenario
                }
            });
        }
    </script>
</body>

</html>
