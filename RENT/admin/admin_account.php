<?php

include '../include/connect.php';

session_start();
//$admin_id = isset($_SESSION['admin_id']);

if (isset($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);
  $query = "DELETE FROM admins WHERE id = '$delete_id'";
  $result = mysqli_query($conn, $query);

  if ($conn->query($query) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Record Deleted Successfully.');
    window.location.href='admin_account.php';
    </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('Error deleting record: $conn->error');
    window.location.href='admin_account.php';
    </script>";
  }

  header('location:admin_update.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Account</title>

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
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.accounts {
    width: 90%;
    max-width: 800px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.heading {
    text-align: center;
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.box {
    background: #e3e3e3;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    transition: transform 0.3s ease;
}

.box:hover {
    transform: translateY(-5px);
}

p {
    font-size: 16px;
    color: #555;
    margin: 10px 0;
}

span {
    font-weight: bold;
    color: #222;
}

.option-btns, .delete-btn, .option-btn {
    display: inline-block;
    padding: 10px 15px;
    margin: 5px;
    text-decoration: none;
    font-size: 14px;
    border-radius: 5px;
    transition: 0.3s;
}

.option-btns {
    background: #3498db;
    color: #fff;
}

.delete-btn {
    background:rgb(255, 25, 0);
    color: white;
}

.option-btn {
    background:rgb(8, 89, 240);
    color: white;
}

.option-btns:hover, .delete-btn:hover, .option-btn:hover {
    opacity: 0.8;
}




    </style>


</head>

<body>
  
  <section class="accounts">
    <h1 class="heading">Admin Account</h1>

    <div class="box-container">

      <div class="box">
        <!-- <h3>Admin Account</h3> -->
        <a href="admin_register.php" class="option-btns">Register Admin</a>
      </div>

      <?php

      $query = "SELECT * FROM `admins`";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($fetch_accounts = mysqli_fetch_assoc($result)) {
      ?>
          <div class="box">
            <p> Admin ID : <span><?= $fetch_accounts['id']; ?></span> </p>
            <p> Admin Name : <span><?= htmlspecialchars($fetch_accounts['name']); ?></span> </p>
            <p>Email: <span><?= htmlspecialchars($fetch_accounts['email']); ?></span></p>
            <div class="flex-btn">
              <a href="admin_account.php?delete=<?= $fetch_accounts['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this user?');"
                class="delete-btn">Delete</a>
              <!-- <a href="admin_update.php?update=<?= $fetch_accounts['id']; ?>"

                class="option-btn">Update</a>  -->
            </div>
          </div>
      <?php
        }
      } else {
        echo "<script type='text/javascript'>
    alert('No accounts found.');
    </script>";
      }
      ?>
    </div>
  </section>

</body>

</html>