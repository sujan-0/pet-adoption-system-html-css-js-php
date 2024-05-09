<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./payment.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600;700&display=swap" />
    <title>Payment</title>
</head>
<body>
    <div class="order">
        <nav class="navbar-wrapper" id="navbar">
            <nav class="navbar" id="navbar">
                <a class="ellipse-parent">
                    <div class="ellipse-div"></div>
                    <img class="vector-icon5" alt="" src="./public/vector3.svg" />
                </a>
                <div class="home-parent">
                    <a class="home" href="index.html">Home</a>
                    <a class="home" href="/adopt">Adopt</a>
                    <a class="home" href="/get-involved">Get Involved</a>
                    <a class="home" href="/blog">Blog</a>
                    <a class="home" href="/about-us">About us</a>
                </div>
                <div class="rectangle-parent">
                    <input
                        class="rectangle-input"
                        value="e.g. bhotekukur"
                        placeholder="e.g. japanese spitz"
                        type="search"
                    />

                    <img
                        class="iconamoonsearch-thin"
                        alt=""
                        src="./public/iconamoonsearchthin.svg"
                    />
                </div>
                <button class="shelter-wrapper" id="shelter">
                    <div class="shelter">Shelter?</div>
                </button>
            </nav>
        </nav>
        <main class="frame-main" id="body">
            <div class="frame-parent3" id="deliveryDetails">
                <form class="name-parent" id="orderForm" action="orders.php" method="post">
                    <div class="name">Name</div>
                    <div class="phone-number">Phone Number</div>
                    <div class="email">Email</div>
                    <input
                        class="frame-child7"
                        name="customerName"
                        placeholder="Full name"
                        type="text"
                        required
                    />

                    <input
                        class="frame-child8"
                        name="phoneNumber"
                        placeholder="99-999-999-99"
                        type="tel"
                        required
                    />

                    <input
                        class="frame-child9"
                        name="email"
                        placeholder="yourmail@gmail.com"
                        type="email"
                        required
                    />
                    <input
                        type="hidden"
                        name="productName"
                        value="<?php echo isset($_GET['productName']) ? htmlspecialchars($_GET['productName']) : ''; ?>"
                    />
                    <input
                        type="hidden"
                        name="price"
                        value="<?php echo isset($_GET['price']) ? htmlspecialchars($_GET['price']) : ''; ?>"
                    />
                </form>
                <form class="address-parent" id="deliveryAddress">
                    <div class="name">Address</div>
                    <div class="phone-number">Postal Code</div>
                    <div class="email">Address 2</div>
                    <input
                        class="frame-child7"
                        name="address"
                        placeholder="kuleshwor, kathmandu"
                        type="text"
                    />

                    <input
                        class="frame-child8"
                        name="postalCode"
                        placeholder="e.g. 44600"
                        type="number"
                    />

                    <input
                        class="frame-child9"
                        name="address2"
                        placeholder="e.g. googlemaps.com"
                        type="text"
                    />
                </form>
                <div class="delivery-address">Delivery Address</div>
                <div class="personal-details">Personal details</div>
            </div>
            <div class="frame-parent4">
                <form class="payment-method-parent" id="description">
                    <div class="payment-method">Payment Method</div>
                    <div class="promo-code">Promo Code</div>
                    <div class="voucher">Voucher</div>
                    <select
                        class="select-payment-method-parent"
                        required="{true}"
                        id="paymentMethod"
                    >
                        <option value="1">Select Payment Method</option>
                        <option value="2">esewa</option>
                        <option value="3">Khalti</option>
                        <option value="4">Bank Transfer</option>
                    </select>
                    <button class="place-order-wrapper" type="submit" form="orderForm" name="placeOrder">
                       <div class="place-order">Place Order</div>
                    </button>
                    <input
                        class="frame-child13"
                        name="promoCode"
                        placeholder="if any..."
                        type="text"
                    />

                    <input
                        class="frame-child14"
                        name="voucher"
                        placeholder="No Applicable Voucher"
                        type="text"
                    />

                    <div class="order-summary-parent" id="orderSummary">       
                    <div class="total-payment">Total payment</div>
                    <div class="div3">
                <?php   
          
                $price = $_GET['price'] ?? '';
       
                echo "$" . htmlspecialchars($price);
                ?>
            </div>
                        <div class="all-taxes-included">All taxes included</div>
                    </div>
                    <img class="line-icon" alt="" src="./public/line-11.svg" />
                </form>
                <h1 class="payment">Payment</h1>
            </div>
            <div class="product-name-group" id="productId">
                <h1 class="product-name1">Product Name</h1>
                <?php
                // Retrieve the product name from the URL query parameter
                $productName = $_GET['productName'] ?? '';

                // Display the product name in the iframe
                echo "<iframe class='frame-iframe' id='petType' name>$productName</iframe>";
                echo "<div class='pet-type-'>$productName</div>";
                ?>
            </div>
        </main>
        <footer class="adopt-parent">
            <b class="adopt1">Adopt</b>
            <div class="petopia-pvt-ltd">Petopia pvt. ltd</div>
            <b class="shop">Shop</b>
            <b class="order-support">Order & Support</b>
            <b class="account">Account</b>
            <b class="info">Info</b>
            <b class="follow-along">Follow Along</b>
            <div class="dog">Dog</div>
            <div class="kathmandu-np">Kathmandu, NP</div>
            <div class="pupsicle">Pupsicle</div>
            <div class="support">Support</div>
            <div class="log-in">Log In</div>
            <div class="about">About</div>
            <div class="all">All</div>
            <div class="all1">All</div>
            <div class="faq">FAQ</div>
            <div class="shipping-returns">Shipping & Returns</div>
            <div class="create-an-account">Create an Account</div>
            <div class="store-locator">Store Locator</div>
            <div class="news">News</div>
            <img class="vector-icon6" alt="" src="./public/vector4.svg" />

            <img class="vector-icon7" alt="" src="./public/vector5.svg" />

            <img class="vector-icon8" alt="" src="./public/vector6.svg" />

            <div class="ellipse-group">
                <div class="frame-child15"></div>
                <div class="frame-child16"></div>
                <div class="frame-child17"></div>
                <img class="vector-icon9" alt="" src="./public/vector7.svg" />

                <img class="vector-icon10" alt="" src="./public/vector7.svg" />

                <img class="vector-icon11" alt="" src="./public/vector7.svg" />

                <div class="petopia1">petopia</div>
            </div>
        </footer>
        
    </div>
    <script>
    // Function to show a popup message
    function showMessage() {
        alert("Your order has been placed!");
    }

    // Add a click event listener to the "Place Order" button
    document.getElementById("placeOrder").addEventListener("click", showMessage);


</script>
</body>
</html>
