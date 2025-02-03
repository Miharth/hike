
<?php
include 'include/connect.php';

session_start();

// LOGIN LOGIC
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass']; // Retrieve and sanitize email
    $pass = htmlspecialchars(trim($_POST['pass'])); // Retrieve and sanitize password

    $query = "SELECT * FROM `users` WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header('Location: index.php');
        exit;
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}

// REGISTRATION LOGIC
if (isset($_POST['submits'])) {
    $name = $_POST['name'];
    $name = htmlspecialchars(trim($_POST['name']));   // Retrieve and sanitize name
    $email = $_POST['email'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Retrieve and sanitize email
    $pass = $_POST['pass'];
    $pass = htmlspecialchars(trim($_POST['pass']));
    $cpass = $_POST['cpass'];
    $cpass = htmlspecialchars(trim($_POST['cpass']));

    if ($pass != $cpass) {
        echo "<script>alert('Passwords do not match!');
        </script>";
    } else {
        // Check if email already exists
        $query = "SELECT * FROM `users` WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists.');</script>";
        } else {
            // Insert new user into the database
            $query = "INSERT INTO `users` (name, email, password) VALUES ('$name', '$email', '$pass')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registered successfully.');</script>";
                header('Location: user_login.php'); // Redirect to login page after registration
                exit;
            } else {
                echo "<script>alert('Error occurred while registering.');</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 800px;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .form-container {
            width: 50%;
            padding: 30px;
            transition: transform 0.5s ease-in-out;
        }

        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        .overlay-container {
            width: 50%;
            background: linear-gradient(to right, #007bff, #00d4ff);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .overlay-container h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .overlay-container p {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
            max-width: 300px;
        }

        .overlay-container button {
            background: white;
            color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .overlay-container button:hover {
            background: #f0f0f0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .form-container, .overlay-container {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="loginContainer">
        <!-- Login Form -->
        <div class="form-container">
            <h1>Login</h1>
            <form action="" method="post">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Password" required>
                <button type="submit" name="submit">Login</button>
            </form>
        </div>

        <!-- Overlay Section for Signup -->
        <div class="overlay-container">
            <h1>New Here?</h1>
            <p>Create an account to start your journey with us.</p>
            <button id="showSignup">Sign Up</button>
        </div>
    </div>

    <div class="container" id="signupContainer" style="display: none;">
        <!-- Signup Form -->
        <div class="form-container">
            <h1>Sign Up</h1>
            <form action="" method="post">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Password" required>
                <input type="password" name="cpass" placeholder="Confirm Password" required>
                <button type="submit" name="submits">Sign Up</button>
            </form>
        </div>

        <!-- Overlay Section for Login -->
        <div class="overlay-container">
            <h1>Welcome Back!</h1>
            <p>Log in to your account to reconnect with us.</p>
            <button id="showLogin">Login</button>
        </div>
    </div>

    <script>
        const loginContainer = document.getElementById('loginContainer');
        const signupContainer = document.getElementById('signupContainer');
        const showSignup = document.getElementById('showSignup');
        const showLogin = document.getElementById('showLogin');

        showSignup.addEventListener('click', () => {
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'flex';
        });

        showLogin.addEventListener('click', () => {
            signupContainer.style.display = 'none';
            loginContainer.style.display = 'flex';
        });
    </script>
</body>

</html>