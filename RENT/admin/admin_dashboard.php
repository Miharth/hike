<?php

include '../include/connect.php';

// session_start();

$admin_id = isset($_SESSION['admin_id']);

// if (!isset($admin_id)) {
//   header('location:admin_login.php');
//   exit();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

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

  <!-- css here  -->


<!-- 
  <style>
    /*admin dashboard*/

    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
    }

    .container {
      max-width: 100%;
      background-color: rgb(43, 41, 41);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .top-header-navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
    }

    .top-header-navbar a {
      text-decoration: none;
      color: white;
      font-weight: 600;
      font-size: 1.2rem;
    }

    .top-header-navbar a:hover {
      color: rgb(203, 228, 255);
    }

    .header a {
      padding: 20px;
    }

    .header i {
      color: white;
      font-weight: 600;
      font-size: 1.2rem;
    }

    .header i:hover {
      color: rgb(15, 75, 139);
      cursor: pointer;
    }

    h3 {
      font-size: 1.5rem;
      display: flex;
      width: 100%;
      justify-content: center;
      background-color: rgba(11, 24, 35, 0.58);
      padding: 0.8rem;
      color: rgba(247, 242, 242, 0.87);
      font-weight: 600;
    }

    .card {
      width: 300px;
      height: 260px;
      border-radius: 20px;
      background: #f5f5f5;
      position: relative;
      padding: 1.8rem;
      border: 2px solid #c3c6ce;
      transition: 0.5s ease-out;
      overflow: visible;
      cursor: pointer;
    }

    .card-details {
      color: black;
      height: 100%;
      gap: .5em;
      display: grid;
      place-content: center;
    }

    .card-button {
      transform: translate(-50%, 125%);
      width: 60%;
      border-radius: 1rem;
      border: none;
      background-color: #008bf8;
      color: #fff;
      font-size: 1rem;
      padding: .5rem 1rem;
      position: absolute;
      left: 50%;
      bottom: 0;
      opacity: 0;
      transition: 0.3s ease-out;
    }

    .text-body {
      color: rgb(134, 134, 134);
    }

    .heading {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 40px;
    }

    .text-title {
      font-size: 1.5em;
      font-weight: bold;
    }

    .card:hover {
      border-color: #008bf8;
      box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
    }

    .card:hover .card-button {
      transform: translate(-50%, 50%);
      opacity: 1;
    }

    .panel-icon {
      font-size: 100px;
      color: #007bff;
      text-align: center;
    }

    .text-title {
      text-align: center;
    }

    .card-button a {
      text-decoration: none;
      color: #fff;
    }
  </style>  -->




      <!-- MY CSS  -->
<!-- 
   <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
    }

    h3 {
      text-align: center;
      font-size: 2rem;
      color: #333;
      margin: 20px 0;
    }

    .heading {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin: 20px auto;
      max-width: 1200px;
    }

    .card1 {
      background-color: rgb(red, green, blue);
      height: 300PX;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(81, 108, 13, 0.1);
      width: 250px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      text-align: center;
    }

    .card-details {
      margin-bottom: 20px;
      text-align: center;
    }

    .text-title {
      font-size: 1.2rem;
      font-weight: bold;
      color: #555;
    }

    .card-button a {
      text-decoration: none;
      color: #fff;
      font-size: 0.9rem;
      font-weight: bold;
    }

    .card-button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .card-button:hover {
      background-color: #0056b3;
    }

    .card-button i {
      margin-left: 5px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .card {
        width: 100%;
        max-width: 300px;
      }
    }

    @media (max-width: 480px) {
      .text-title {
        font-size: 1rem;
      }

      .card-button {
        font-size: 0.8rem;
      }

      .top-header-navbar{
        background-color: RED;
        color: greenyellow;
      }


      .header{
       
      }

        /* headerrrrrrrrr */
        


    }
  </style>    -->



  <style>
 /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Layout */
body {
    display: flex;
    background-color: #f4f4f4;
    margin-right: 70px;
    margin-bottom: 70px;
}

/* Sidebar */
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #222;
    color: white;
    position: fixed;
    left: 0;
    top: 0;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 12px;
    margin: 5px 0;
    cursor: pointer;
    transition: 0.3s;
}

.sidebar ul li:hover {
    background-color: #444;
}

/* Content Area */
.content {
    /* margin-left: 250px; */
    /* padding: 20px; */
    /* width: 100%; */
}

/* Top Header Navbar */
.top-header-navbar {
    background-color: white;
    padding: 10px 20px;
    text-align: right;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: calc(100% - 250px);
    left: 250px;
    top: 0;
    z-index: 1000;
}

.top-header-navbar .header a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    font-size: 16px;
}

/* Dashboard Cards */
.heading {
    display: flex;
    justify-content: center;
    margin-top: 100px;
}

.card1, .card2, .card3, .card4 {
    width: 250px;
    height: 150px;
    margin: 15px;
    border-radius: 10px;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    transition: 0.3s;
}

.card1 { background-color: #ff4d4d; } /* Red */
.card2 { background-color: #4d94ff; } /* Blue */
.card3 { background-color: #4dff88; } /* Green */
.card4 { background-color: #a64dff; } /* Purple */

.card1:hover, .card2:hover, .card3:hover, .card4:hover {
    transform: translateY(-5px);
}

.text-title {
    font-size: 20px;
    font-weight: bold;
}

/* Buttons */
.card-button {
    margin-top: 10px;
    padding: 8px 16px;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    /* background-color: transparent; */
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.card-button1 {
    margin-top: 10px;
    padding: 8px 16px;
    border: none;
    background: rgba(255, 255, 255, 0.2);
    background-color: transparent;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.card-button1 a {
    text-decoration: none;
    color: white;
    font-weight: bold;
}

.card-button1 a {
    text-decoration: none;
    color: white;
    font-weight: bold;
}


.card-button a {
    text-decoration: none;
    color: white;
    font-weight: bold;
}

.card-button i {
    margin-left: 5px;
}

/* Responsive Design */
@media (max-width: 900px) {
    .sidebar {
        width: 200px;
    }

    .top-header-navbar {
        width: calc(100% - 200px);
        left: 200px;
    }

    .content {
        margin-left: 200px;
    }

    .heading {
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 600px) {
    .sidebar {
        width: 100px;
    }

    .top-header-navbar {
        width: calc(100% - 100px);
        left: 100px;
    }

    .content {
        margin-left: 100px;
    }

    .card1, .card2, .card3, .card4 {
        width: 100%;
    }
}



</style>
  </style>

   




</head>

<body>
  <!--Navbar Header-->

  <div class="container">
    <div class="top-header-navbar">
      <div class="header">
        <!-- <p>Hike gear Nepal</p> -->
        <a href="admin_logout.php" style="color:black";>Logout</a>
      </div>
    </div>
  </div>

  <!--Dashboard Cards-->
  <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <!-- <li>Home</li> -->
            <li><button class="card-button1"><a href="admin_user.php">User Details </a> </button></li>
             <li> <button class="card-button1"><a href="order_panel.php">Orders </a> </button> </li>
            <li>  <button class="card-button1"><a href="products.php">Add Products </a> </button></li>
            <li> <button class="card-button1"><a href="admin_account.php">Admin </a> </button></li>
         
        </ul>
    </div>

    <!-- <div class="content">
        <h1>Admin Dashboard</h1>
    </div> -->

    <div class="heading">
      <div class="card1">
        <div class="card-details">
          <!-- <div class="panel-icon">👤</div> -->
          <p class="text-title"> User Details</p>

        </div>
        <button class="card-button"><a href="admin_user.php">More </a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <?php

      $query = "SELECT * FROM `orders`";
      $result = mysqli_query($conn, $query);

      $number_of_orders = $result->num_rows;

      ?>
      <div class="card2">
        <div class="card-details">
     
          <p class="text-title">Orders</p>
        </div>
        <button class="card-button"><a href="order_panel.php">More </a> <i class="fa-solid fa-arrow-right"></i></button>

      </div>
    </div>

    <div class="heading">
      <div class="card3">
        <div class="card-details">
         
          <p class="text-title">Add Products</p>
        </div>
        <button class="card-button"><a href="products.php">More </a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <div class="card4">
        <div class="card-details">
          
          <p class="text-title">Admin </p>

        </div>
        <button class="card-button"><a href="admin_account.php">More </a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>



</body>

</html>