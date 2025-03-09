<?php

include '../include/connect.php';

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  $query = "INSERT INTO admins (name,email,password) VALUES ('$name','$email','$pass')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script type='text/javascript'>
    alert('Registration Successfull.');
    window.location.href='admin_login.php';
    </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('Registration UnSuccessfull.');
    window.location.href='admin_register.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

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
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background: linear-gradient(135deg, #6e7dff, #5a8eff); /* Gradient background */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
}

.form-box {
    background-color: #ffffff; /* White background for the form */
    border-radius: 15px; /* More pronounced rounded corners */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Stronger shadow */
    max-width: 400px; /* Max width for the form */
    width: 100%; /* Full width up to the max */
    padding: 30px; /* Padding inside the form */
    text-align: center; /* Center the text */
}

.heading h5 {
    color: #333; /* Darker text color */
    margin-bottom: 20px; /* Space below the heading */
    font-weight: 600; /* Slightly bolder font */
}

.input {
    display: flex;
    flex-direction: column; /* Stack inputs vertically */
}

.input input[type="text"],
.input input[type="email"],
.input input[type="password"] {
    padding: 15px; /* Increased padding for comfort */
    margin-bottom: 15px; /* Space between input fields */
    border: 2px solid #ddd; /* Light gray border */
    border-radius: 10px; /* Rounded corners */
    font-size: 16px; /* Font size */
    transition: border-color 0.3s, box-shadow 0.3s; /* Transition effects */
}

.input input[type="text"]:focus,
.input input[type="email"]:focus,
.input input[type="password"]:focus {
    border-color: #6e7dff; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(110, 125, 255, 0.5); /* Shadow on focus */
    outline: none; /* Remove default outline */
}

input[type="submit"] {
    background-color: #6e7dff; /* Button color */
    color: white; /* White text */
    border: none; /* Remove border */
    padding: 15px; /* Padding for the button */
    border-radius: 10px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s, transform 0.3s; /* Transition effects */
}

input[type="submit"]:hover {
    background-color: #5a8eff; /* Darker button color on hover */
    transform: translateY(-2px); /* Lift effect on hover */
}

/* Optional: Style for the register link */
.register {
    text-align: center; /* Center the register link */
    margin-top: 15px; /* Space above the register link */
}

.register a {
    color: #6e7dff; /* Link color */
    text-decoration: none; /* Remove underline */
}

.register a:hover {
    text-decoration: underline; /* Underline on hover */
}
  </style>
</head>

<body>

  <form action="" method="POST" class="form-box">
    <div class="containers">
      <div class="heading">
        <h5>Register Here</h5>
      </div>

      <div class="input">
        <input type="text" placeholder="Enter your name" id="name" name="name" required>
        <input type="email" placeholder="Enter your email" id="email" name="email" required> <br>
        <input type="password" placeholder="Enter your password" id="password" name="pass" required> <br>
        <a href="admin_dashboard.php"><input type="submit" value="Register" onclick="handleLogin()" name="register"></a>
        <p class="register"><a href="admin_login.php">Already have an account?<u> Login Here!</u></a></p>
      </div>
    </div>
  </form>

</body>

</html>