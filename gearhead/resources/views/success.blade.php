<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: black;
        }

        p {
            margin-bottom: 20px;
            font-size: 18px;
            line-height: 1.6;
        }

        .back-to-shopping {
            margin-top: 30px;
        }

        .back-to-shopping a {
            text-decoration: none;
            background-color: #343a40;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-to-shopping a:hover {
            background-color: #343a40;
        }

        .view-order{
            margin-top: 20px;
        }

        .view-order a {
            text-decoration: none;
            background-color: #343a40;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: inline-block; /* Ensure links are displayed as blocks */
            margin-right: 10px; /* Add margin between links */
        }

        .back-to-shopping a:hover,
        .view-order a:hover {
            background-color: #343a40;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase.</p>
        <div class="back-to-shopping">
            <a href="/motor">Back to Shopping</a>
            <a href="{{ route('orders.index') }}" class="btn btn-primary">View Order</a>
        </div>
    </div>
</body>
</html>

