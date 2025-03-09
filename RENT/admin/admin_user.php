<?php
include '../include/connect.php';
session_start();

// Check if admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//   echo "<script>alert('Access Denied! Please log in as admin.');</script>";
//   header('location: admin_login.php');
//   exit;
// }

if (isset($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);

  $delete_user_query = "DELETE FROM `users` WHERE id='$delete_id'";
  if (mysqli_query($conn, $delete_user_query)) {
    mysqli_query($conn, "DELETE FROM `orders` WHERE user_id='$delete_id'");
    mysqli_query($conn, "DELETE FROM `messages` WHERE user_id='$delete_id'");
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$delete_id'");

    echo "<script>alert('User and related data deleted successfully.');</script>";
  } else {
    echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
  }

  header('location: admin_user.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- <style> 
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

    .user-panel {
      text-align: center;
      padding: 20px;
    }

    .user-panel h1 {
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
    }

    .user-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .user-box {
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 20px;
      width: 300px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: left;
    }

    .user-box p {
      margin: 10px 0;
      font-size: 1rem;
    }

    .user-box span {
      color: #007bff;
    }

    .delete-btn,
    .update-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 1rem;
      color: #fff;
    }

    .delete-btn {
      background-color: #dc3545;
    }

    .delete-btn:hover {
      background-color: #c82333;
    }

    .update-btn {
      background-color: #007bff;
    }

    .update-btn:hover {
      background-color: #0056b3;
    }

    .empty {
      font-size: 1.2rem;
      color: #888;
    }
  </style>   -->

<!-- <style>
          body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f7f7f7; /* Light background for contrast */
}

.user-panel {
  text-align: center;
  padding: 60px 20px;
}

.user-panel h1 {
  font-size: 2.8rem;
  margin-bottom: 40px;
  color: #333;
  font-weight: 600;
}

.user-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 30px;
}

.user-box {
  background-color: #ffffff;
  padding: 25px;
  width: 100%;
  max-width: 600px;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
  transform: translateY(0);
}

.user-box:hover {
  transform: translateY(-10px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.user-box p {
  font-size: 1.1rem;
  margin: 12px 0;
  color: #555;
  line-height: 1.6;
}

.user-box span {
  font-weight: bold;
  color: #007bff;
}

.user-box a {
  display: inline-block;
  margin-top: 20px;
  padding: 12px 18px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 1.1rem;
  color: #fff;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.user-box .delete-btn {
  background-color: #ff4d4d;
}

.user-box .delete-btn:hover {
  background-color: #e63e3e;
  transform: scale(1.05);
}

.user-box .update-btn {
  background-color: #34b7f1;
}

.user-box .update-btn:hover {
  background-color: #1e8dcb;
  transform: scale(1.05);
}

.empty {
  font-size: 1.2rem;
  color: #888;
  text-align: center;
  margin-top: 30px;
}
 </style>  -->

 <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f4f7fa; /* Light background for contrast */
}

.user-panel {
    text-align: center;
    padding: 20px;
}

.user-panel h1 {
    color: #333; /* Darker color for the heading */
    margin-bottom: 30px; /* Space below heading */
}

.user-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center the user boxes */
    gap: 20px; /* Space between user boxes */
}

.user-box {
    background-color: #ffffff; /* White background for each user card */
    border-radius: 12px; /* Rounded corners */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
    padding: 20px; /* Padding inside user box */
    width: 280px; /* Fixed width for user box */
    transition: transform 0.2s; /* Smooth transform effect */
}

.user-box:hover {
    transform: translateY(-5px); /* Lift effect on hover */
}

.user-box p {
    margin: 10px 0; /* Space between paragraphs */
    color: #555; /* Soft text color */
}

.user-box span {
    font-weight: bold; /* Bold text for user info */
    color: #333; /* Darker color for emphasis */
}

.delete-btn,
.update-btn {
    display: inline-block; /* Display buttons inline */
    margin-top: 10px; /* Space above buttons */
    padding: 10px 15px; /* Padding inside buttons */
    border-radius: 5px; /* Rounded corners for buttons */
    text-decoration: none; /* Remove underline */
    color: white; /* White text color */
    transition: background-color 0.3s; /* Transition for hover effect */
}

.delete-btn {
    background-color: #e74c3c; /* Red color for delete button */
}

.delete-btn:hover {
    background-color: #c0392b; /* Darker red on hover */
}

.update-btn {
    background-color:rgb(80, 255, 64); /* Blue color for update button */
}

.update-btn:hover {
    background-color:rgb(83, 166, 45); /* Darker blue on hover */
}

.empty {
    color: #999; /* Gray color for no users found message */
    margin-top: 20px; /* Space above message */
}
 </style>

</head>

<body>
  <section class="user-panel">
    <h1>Users!</h1>
    <div class="user-container">
      <?php
      // Fetch all users
      $select_accounts_query = "SELECT * FROM `users`";
      $select_accounts_result = mysqli_query($conn, $select_accounts_query);

      if ($select_accounts_result && mysqli_num_rows($select_accounts_result) > 0) {
        while ($fetch_accounts = mysqli_fetch_assoc($select_accounts_result)) {
      ?>
          <div class="user-box">
            <p>User ID: <span><?= $fetch_accounts['id']; ?></span></p>
            <p>Username: <span><?= htmlspecialchars($fetch_accounts['name']); ?></span></p>
            <p>Email: <span><?= htmlspecialchars($fetch_accounts['email']); ?></span></p>
            <a href="admin_user.php?delete=<?= $fetch_accounts['id']; ?>"
              onclick="return confirm('Are you sure you want to delete this user?');"
              class="delete-btn">Delete</a>
            <!-- <a href="admin_update_user.php?update=<?= $fetch_accounts['id']; ?>"
              class="update-btn">Update</a> -->
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">No users found!</p>';
      }
      ?>
    </div>
  </section>
</body>

</html>