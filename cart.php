<?php
session_start();

// Check if item_id is set in POST data
if (isset($_POST['item_id'])) {
    $itemId = $_POST['item_id'];

    // Check if the Add to Cart button is clicked
    if (isset($_POST['add_to_cart'])) {
        addToCart($itemId);
    }

    // Check if the Remove Quantity button is clicked
    if (isset($_POST['remove_quantity'])) {
        removeFromCart($itemId);
    }

    // Check if the Add Quantity button is clicked
    if (isset($_POST['add_quantity'])) {
        addToCart($itemId);
    }

    // Redirect back to the previous page after handling cart operations
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // Redirect to the home page or any other page if item_id is not set
    header('Location: index.php');
    exit;
}

// Function to add product to cart
function addToCart($productId, $quantity = 1) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'id' => $productId, // Add product ID for easier reference
            'quantity' => $quantity,
        ];
    }
}

// Function to remove product from cart
function removeFromCart($productId) {
    if (isset($_SESSION['cart'][$productId])) {
        if ($_SESSION['cart'][$productId]['quantity'] > 1) {
            $_SESSION['cart'][$productId]['quantity']--;
        } else {
            unset($_SESSION['cart'][$productId]);
        }
    }
}
