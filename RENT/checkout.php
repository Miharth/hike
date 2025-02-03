<?php

include 'include/connect.php';
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

if (isset($_POST['order'])) {

  $name = isset($_POST['name']);
  $name = htmlspecialchars(trim($_POST['name']));
  $number = isset($_POST['number']);
  $number = htmlspecialchars(trim($_POST['number']));
  $email = isset($_POST['email']);
  $email = htmlspecialchars(trim($_POST['email']));
  $method = isset($_POST['method']);
  $method = htmlspecialchars(trim($_POST['method']));
  $address = isset($_POST['address']);
  $address = htmlspecialchars(trim($_POST['address']));
  $total_product = htmlspecialchars(trim($_POST['total_products']));
  $total_price = htmlspecialchars(trim($_POST['total_price']));

  $check_cart_query = "SELECT * FROM `cart` WHERE user_id='$user_id' ";
  $check_cart_result = mysqli_query($conn, $check_cart_query);

  if ($check_cart_result && $check_cart_result->num_rows > 0) {
    $insert_order_query = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_product', '$total_price')";
    $insert_order_result = mysqli_query($conn, $insert_order_query);

    $delete_cart_query = "DELETE FROM `cart` WHERE user_id='$user_id'";
    $delete_cart_result = mysqli_query($conn, $delete_cart_query);

    echo "<script type='text/javascript'>
                  alert('Order Placed.');
                  window.location.href='order.php';
                  </script>";
  } else {
    $message[] = 'Your cart is empty.';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <!-- <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/checkout.css">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Hike Gear Nepal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarNav">
        <ul class="navbar-nav nav ms-">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order.php">Orders</a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="shop.php">Blog</a> -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>


      <form class="d-flex" action="" method="post">
        <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search" aria-label="Search" maxlength="100" required>
        <button class="btn btn-outline-success btn-search" type="submit" name="search_btn">Search</button>
      </form>

      <section class="products">
        <div class="box-container">

        </div>
      </section>

      <div class="icon">
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <!-- <a href="wishlist.php"><i class="fa-solid fa-heart"></i></a> -->
        <a href="user_login.php"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </nav>

  <section class="checkout-orders">
    <form action="" method="post">
      <h3>Your Order</h3>

      <div class="display-order">
        <?php

        $grand_total = 0;
        $cart_items = [];

        $query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($fetch_cart = mysqli_fetch_assoc($result)) {

            $item_no[]=$fetch_cart['quantity'];
            $cart_items[] = $fetch_cart['name'] . '(' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
           $total_products= 0;
            foreach ($item_no as $x){
              $total_products += $x;
            }
            $grand_total += $fetch_cart['price'] * $fetch_cart['quantity'];
            var_dump($total_products);
            // die;
        ?>
            <p class="names"> <?= $fetch_cart['name']; ?> <span>(<?= 'Rs.' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
        <?php
          }
        } else {
          echo '<p class="empty">your cart is empty!</p>';
        }
        ?>

        <input type="hidden" name="total_products" value="<?= $total_products; ?>">
        <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
        <div class="wishlist-total">
          <p>Total: <span>Rs.<?= $grand_total; ?>/-</span></p>
        </div>
      </div>

      <h3>Enter The Details</h3>

      <div class="box-container">
        <div class="flex-box">
          <div class="inputBox">
            <span>Name :</span>
            <input type="text" name="name" placeholder="Your Name" class="box" maxlength="20" required>
          </div>

          <div class="inputBox">
            <span>Quantity:</span>
            <input type="number" name="number" placeholder=" number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
          </div>

          <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" placeholder="email@gmail.com" class="box" maxlength="50" required>
          </div>
        </div>
        
        <div class="flex">
          <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method" class="box" required>
              <option value="cash on delivery">Cash on Delivery</option>
              <option value="credit card">Credit Card</option>
            </select>
          </div>
          <div class="inputBox">
            <span>City :</span>
            <input type="text" name="address" placeholder="" class="box" maxlength="50" required>
          </div>

          <div class="inputBox">
            <span>Address :</span>
            <input type="text" name="address" placeholder="" class="box" maxlength="50" required>
          </div>
        </div>
      </div>

      <input type="submit" name="order" class="btns <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Rent The Product">

    </form>
  </section>

</body>

</html>