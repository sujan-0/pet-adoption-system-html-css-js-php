<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .order-details {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }

        .order-details h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .order-details p {
            margin: 5px 0;
        }

        .view-details-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <h2>Order Details</h2>

    <div class="order-details">
        <h3>Customer Information</h3>
        <p><strong>Name:</strong> <?php echo isset($_POST['customerName']) ? htmlspecialchars($_POST['customerName']) : ''; ?></p>
        <p><strong>Phone Number:</strong> <?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : ''; ?></p>
        <p><strong>Email:</strong> <?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?></p>

        <h3>Delivery Address</h3>
        <p><strong>Address:</strong> <?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></p>
        <p><strong>Postal Code:</strong> <?php echo isset($_POST['postalCode']) ? htmlspecialchars($_POST['postalCode']) : ''; ?></p>
        <p><strong>Address 2:</strong> <?php echo isset($_POST['address2']) ? htmlspecialchars($_POST['address2']) : ''; ?></p>

        <h3>Order Summary</h3>
        <p><strong>Product Name:</strong> <?php echo isset($_POST['productName']) ? htmlspecialchars($_POST['productName']) : ''; ?></p>
        <p><strong>Price:</strong> <?php echo isset($_POST['price']) ? '$' . htmlspecialchars($_POST['price']) : ''; ?></p>

        <h3>Payment Method</h3>
        <p><strong>Selected Payment Method:</strong> <?php echo isset($_POST['paymentMethod']) ? htmlspecialchars($_POST['paymentMethod']) : ''; ?></p>

        <h3>Promo Code</h3>
        <p><strong>Promo Code:</strong> <?php echo isset($_POST['promoCode']) ? htmlspecialchars($_POST['promoCode']) : ''; ?></p>

        <h3>Voucher</h3>
        <p><strong>Voucher:</strong> <?php echo isset($_POST['voucher']) ? htmlspecialchars($_POST['voucher']) : ''; ?></p>
    </div>

    <button class="view-details-btn" onclick="window.print()">Print Details</button>
</body>
</html>
