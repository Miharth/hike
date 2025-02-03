<?php
include 'include/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['delete'])) {
  $cart_id = $_POST['cart_id'];
  $query = "DELETE FROM `cart` WHERE id = '$cart_id'";
  mysqli_query($conn, $query);
}

if (isset($_GET['delete_all']) && $user_id) {
  $query = "DELETE FROM `cart` WHERE user_id = '$user_id'";
  mysqli_query($conn, $query);
  header('location: cart.php');
  exit();
}

if (isset($_POST['update_qty'])) {
  $cart_id = $_POST['cart_id'];
  $qty = $_POST['qty'];
  $query = "UPDATE `cart` SET quantity = '$qty' WHERE id = '$cart_id'";
  mysqli_query($conn, $query);
}


if (isset($_POST['add_product'])) {
  $name = htmlspecialchars(trim($_POST['name'] ?? ''));
  $price = htmlspecialchars(trim($_POST['price'] ?? ''));
  $qty = htmlspecialchars(trim($_POST['qty'] ?? ''));

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/products/' . basename($image);

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
      echo "<script>alert('Invalid file format. Allowed formats: jpg, jpeg, png, gif');</script>";
      exit;
    }

    if ($image_size > 2 * 1024 * 1024) {
      echo "<script>alert('File size is too large. Maximum 2MB allowed.');</script>";
      exit;
    }

    // Move the uploaded file
    if (move_uploaded_file($image_tmp_name, $image_folder)) {
      $query = "INSERT INTO cart (name, price, qty, image) 
              VALUES ('$name', '$price', '$qty', '$image')";

      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully and saved in database.');</script>";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    } else {
      echo "<script>alert('Failed to move the uploaded file.');</script>";
    }
  } else {
    echo "<script>alert('Please upload an image.');</script>";
  }

  if (isset($_POST['add_product'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $price = htmlspecialchars(trim($_POST['price'] ?? ''));
    $qty = htmlspecialchars(trim($_POST['qty'] ?? ''));

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['image']['name'];
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'images/products/' . basename($image);

      $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
      $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Invalid file format. Allowed formats: jpg, jpeg, png, gif');</script>";
        exit;
      }

      if ($image_size > 2 * 1024 * 1024) {
        echo "<script>alert('File size is too large. Maximum 2MB allowed.');</script>";
        exit;
      }

      // Move the uploaded file
      if (move_uploaded_file($image_tmp_name, $image_folder)) {
        $query = "INSERT INTO products (name, price, qty, image) 
              VALUES ('$name', '$price', '$qty', '$image')";

        if (mysqli_query($conn, $query)) {
          echo "<script>alert('Product added successfully and saved in database.');</script>";
        } else {
          echo "Error: " . mysqli_error($conn);
        }
      } else {
        echo "<script>alert('Failed to move the uploaded file.');</script>";
      }
    } else {
      echo "<script>alert('Please upload an image.');</script>";
    }
  }
}

if (isset($_POST['add_to_cart'])) {

  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];
  $image = $_POST['image'];

  $query = "SELECT * FROM `cart` WHERE user_id = '$user_id' AND pid = '$pid'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $query = "UPDATE `cart` SET quantity = quantity + $qty WHERE user_id = '$user_id' AND pid = '$pid'";
    mysqli_query($conn, $query);
  } else {
    $query = "INSERT INTO `cart` (user_id, pid, name, price, quantity,image) VALUES ('$user_id', '$pid', '$name', '$price', '$qty', '$image')";
    mysqli_query($conn, $query);
  }
  header('location: cart.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <link rel="stylesheet" href="css/style.css">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    /*Shopping Cart*/
/* General reset */
body, html {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Arial', sans-serif;
}

/* Navbar styles */
.navbar {
  background-color: #f8f9fa;
  border-bottom: 1px solid #ddd;
  padding: 0.5rem 1rem;
}

.navbar-brand {
  font-size: 1.5rem;
  font-weight: bold;
  color: #333;
  text-decoration: none;
}

.navbar-toggler {
  border: none;
}

.navbar-toggler-icon {
  background-color: #333;
  width: 24px;
  height: 3px;
  display: block;
  margin: 5px auto;
  border-radius: 2px;
}

.navbar-nav .nav-link {
  color: #555;
  font-size: 1rem;
  padding: 0.5rem 1rem;
  text-decoration: none;
  transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: #007bff;
  border-bottom: 2px solid #007bff;
}

.icon a {
  color: #555;
  font-size: 1.2rem;
  margin: 0 0.5rem;
  text-decoration: none;
}

.icon a:hover {
  color: #007bff;
}

/* Search form */
.search-input {
  border: 1px solid #ccc;
  border-radius: 20px;
  padding: 0.5rem 1rem;
}

.btn-search {
  border-radius: 20px;
  background-color: #28a745;
  color: #fff;
  padding: 0.5rem 1rem;
  border: none;
  transition: background-color 0.3s;
}

.btn-search:hover {
  background-color: #218838;
}

/* Shopping Cart styles */
.shopping-cart {
  margin-top: 5rem;
  padding: 2rem;
}

.heading {
  text-align: center;
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 2rem;
}

.box-container {
  /* display: grid; */
  flex-wrap: wrap;
  display: flex;
  /* grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); */
  gap: 1rem;
}

.box {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 1rem;
  text-align: center;
}

.box img {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
}

.box .name {
  font-size: 1.2rem;
  font-weight: bold;
  margin: 0.5rem 0;
}

.flex {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
}

.price {
  font-size: 1rem;
  color: #28a745;
}



.qty {
  width: 30px;
  padding: 0.25rem;
  text-align: center;
}

.sub-total {
  font-size: 0.9rem;
  margin: 0.5rem 0;
}

.delete-btn {
  background-color: #dc3545;
  color: white;
  padding: 0.5rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.delete-btn:hover {
  background-color: #c82333;
}

/* Cart total */
.cart-total {
  text-align: center;
  margin-top: 2rem;
}

.cart-total p {
  font-size: 1.5rem;
  font-weight: bold;
}

.option-btn,
.delete_btn,
.btns {
  display: inline-block;
  padding: 0.7rem 1.5rem;
  font-size: 1rem;
  border-radius: 20px;
  text-decoration: none;
  color: #fff;
  margin: 0.5rem;
  transition: background-color 0.3s ease;
}

.option-btn {
  background-color: #007bff;
}

.option-btn:hover {
  background-color: #0056b3;
}

.delete_btn {
  background-color: #dc3545;
}

.delete_btn:hover {
  background-color: #c82333;
}

.btns {
  background-color: #28a745;
}

.btns:hover {
  background-color: #218838;
}

.disabled {
  opacity: 0.6;
  pointer-events: none;
}

  </style>
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
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order.php">Orders</a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link active" href="shop.php">Blog</a> -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>


      <form class="d-flex" action="search_page.php" method="post">
        <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search" aria-label="Search" maxlength="100" required>
        <!-- <button class="btn btn-outline-success btn-search" type="submit" name="search_btn">Search</button> -->
      </form>

      <div class="icon">
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <!-- <a href="wishlist.php"><i class="fa-solid fa-heart"></i></a> -->
        <a href="user_login.php"><i class="fa-solid fa-user"></i></a>
      </div>

    </div>
  </nav>

  <section class="shopping-cart">
    <h1 class="heading">Cart</h1>
    <div class="box-container">
      <?php
      $grand_total = 0;

      isset($user_id);
      if ($user_id) {
        $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($fetch_cart = mysqli_fetch_assoc($result)) {
            $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total += $sub_total;
      ?>
            <form action="" method="post" class="box">
              <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

              <img src="images/products/<?= htmlspecialchars($fetch_cart['image']); ?>" name="image">
              <div class="name"><?= $fetch_cart['name']; ?></div>
              <div class="flex">
                <div class="price">Rs.<?= $fetch_cart['price']; ?>/-</div>
                <input type="number" class="qty" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>">
                <button type="submit" name="update_qty" class="fas fa-edit"></button>
              </div>
              <div class="sub-total">Sub-Total: Rs.<?= $sub_total; ?>/-</div>
              <input type="submit" name="delete" value="Delete" class="delete-btn">
            </form>

      <?php
          }
        } else {
          echo '<p class="empty"> Cart is empty.</p>';
        }
      } else {
        echo '<p class="empty">Please login to view your cart.</p>';
      }
      ?>
    </div>

    <div class="cart-total">
      <p>Total: Rs.<?= $grand_total; ?>.</p>
      <a href="index.php" class="option-btn">Continue </a>
      <a href="cart.php?delete_all" class="delete_btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Delete All</a>
      <a href="checkout.php" class="btns <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Rent The Product</a>
    </div>
  </section>
</body>

</html> 