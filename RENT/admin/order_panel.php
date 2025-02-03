<?php

include '../include/connect.php';

session_start();

if (isset($_POST['update_order'])) {
  $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
  $new_status = mysqli_real_escape_string($conn, $_POST['order_status']);

  $query = "UPDATE `orders` SET `payment_status` = '$new_status' WHERE `id` = '$order_id'";

  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script>alert('Order updated successfully!');
      window.location.href='order_panel.php';</script>";
  } else {
    echo "<script>alert('Failed to update order: " . mysqli_error($conn) . "');</script>";
  }
}

if (isset($_GET['delete_order'])) {
  $order_id = $_GET['delete_order'];
  $query = "DELETE FROM `orders` WHERE `id`='$order_id'";
  $result = mysqli_query($conn, $query);
  echo "<script>alert('Order deleted successfully!');</script>";
}

$query = "SELECT * FROM `orders`";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Panel</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <link rel="stylesheet" href="../css/admin_part.css">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      color: #444;
    }

    .order-panel {
      max-width: 1200px;
      margin: 30px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    thead tr {
      background-color: #444;
      color: #fff;
    }

    thead th {
      padding: 10px;
      text-align: left;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #f1f1f1;
    }

    tbody td {
      padding: 10px;
      text-align: left;
      vertical-align: middle;
    }

    td form,
    td a {
      display: inline-block;
      margin-right: 10px;
    }

    select {
      margin-top: 2rem;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    button {
      margin-top: 1rem;
      padding: 5px 10px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }

    button:hover {
      background-color: #0056b3;
    }

    a {
      color: #007BFF;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="order-panel">
    <h1>Order Panel</h1>
    <table border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>Order Id</th>
          <th>User Id</th>
          <th>Name</th>
          <th>Number</th>
          <th>Email</th>
          <th>Method</th>
          <th>Address</th>
          <th>Total Products</th>
          <th>Total Price</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><?= $row['user_id']; ?></td>
              <td><?= $row['name']; ?></td>
              <td><?= $row['number']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><?= $row['method']; ?></td>
              <td><?= $row['address']; ?></td>
              <td><?= $row['total_products']; ?></td>
              <td><?= $row['total_price']; ?></td>
              <td>
                <form action="" method="POST">
                  <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                  <select name="order_status">
                    <option value="Pending" <?= $row['payment_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Shipped" <?= $row['payment_status'] == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                    <option value="Delivered" <?= $row['payment_status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                    <option value="Cancelled" <?= $row['payment_status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                  </select>
                  <button type="submit" name="update_order">Update</button>
                </form>
              </td>
              <td>
                <a href="?delete_order=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="11">No orders found</td>
          </tr>
        <?php endif; ?>

    </table>
  </div>
</body>

</html>