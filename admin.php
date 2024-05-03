<!DOCTYPE html>
<html>
<head>
  <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    header {
        background-color: #295554;
        padding: 20px 0;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    nav ul li {
        display: inline;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
        padding: 14px 16px;
        display: inline-block;
    }

    nav ul li a:hover {
        background-color: #555;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        z-index: 1;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .dropdown-content a {
        color: #333;
        padding: 12px 16px;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
  </style>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="./admin.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Epilogue:wght@300;400;500;600&display=swap" />
</head>
<body>

<?php
  // You can include any PHP logic or variables here before echoing the HTML code
?>

<div class="desktop-2">
  <header>
    <nav>
      <ul>
        <li class="dropdown">
          <a href="#" class="dropbtn">Pet</a>
          <div class="dropdown-content">
            <a href="Addform.php">Add Pet</a>
            <a href="view_products2.php">Update Pet</a>
          </div>
        </li>
        <li class="dropdown">
          <a href="#" class="dropbtn">Product</a>
          <div class="dropdown-content">
            <a href="add_item.php">Add Product</a>
            <a href="view_products2.php">Edit Product</a>
          </div>
        </li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="Adminacc.php">Admin Account</a></li>
        <li><a href="Inquiries.php">Inquiries</a></li>
        <li style="float:right"><a href="index.html">Logout</a></li>
      </ul>
    </nav>
  </header>
  <nav class="frame-parent" id="sideNav">
    <div class="admin-wrapper">
      <div class="admin">Admin</div>
    </div>
    <div class="petopia-parent" id="logo">
      <div class="petopia">petopia</div>
      <div class="frame-child"></div>
      <div class="frame-item"></div>
      <div class="frame-inner"></div>
      <img class="vector-icon" alt="" src="./public/vector.svg" />
      <img class="vector-icon1" alt="" src="./public/vector.svg" />
      <img class="vector-icon2" alt="" src="./public/vector.svg" />
    </div>
  </nav>
</div>
</body>
</html>
