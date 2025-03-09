<?php

include 'include/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


if (isset($_POST['send'])) {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $number = isset($_POST['number']) ? htmlspecialchars(trim($_POST['number'])) : '';
    $msg = isset($_POST['msg']) ? htmlspecialchars(trim($_POST['msg'])) : '';

    $query = "SELECT * FROM `messages` WHERE name='$name' and email='$email' and number='$number' and messages='$msg'";
    $result = mysqli_query($conn, $query);

    if ($result && $result->num_rows > 0) {
        echo "Message already sent";
    } else {
        $query = "INSERT INTO `messages` (user_id, name, email, number, messages) VALUES ('$user_id','$name', '$email', '$number','$msg')";

        if (mysqli_query($conn, $query)) {
            echo "<script type='text/javascript'>
                  alert('Message Sent.');
                  
                  </script>";
        } else {
            echo "<script type='text/javascript'>
                  alert('Not Sent.');
                  
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

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
        body {
            font-family: sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        .logo {
            max-width: 200px; /* Adjust as needed */
            margin: 20px auto; /* Center the logo */
            display: block;
        }

        h1, h2 {
            margin-bottom: 10px;
        }

        h1 {
            font-size: 2em;
        }

        h2 {
            font-size: 1.5em;
        }

        .contact-info {
            margin: 20px auto;
            max-width: 300px;
            padding: 10px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            text-decoration: none;
            font-weight: bold;
            margin-right: 15px;
            transition: opacity 0.3s;
        }

        .social-links a.facebook {
            color: #1877F2;
        }

        .social-links a.instagram {
            color: #E1306C;
        }

        .social-links a.twitter {
            color: #000000;
        }

        .social-links a:hover {
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <img src="logo11.jpeg" alt="Your Logo" class="logo">

    <div class="contact-info">
        <h1>Contact Us</h1>
        <h2>+9779812345690</h2>
        <h2>+9779820304050</h2>
    </div>

    <div class="social-links">
        <h1>Follow Us</h1>
        <a href="https://www.facebook.com" class="facebook">Facebook</a>
        <a href="https://www.instagram.com" class="instagram">Instagram</a>
        <a href="https://www.twitter.com" class="twitter">Twitter</a>
    </div>

    <script src="js/script.js"></script>

    <script>
        // var swiper = new Swiper(".home-slider", {
        //     loop: true,
        //     spaceBetween: 20,
        //     pagination: {
        //         el: ".swiper-pagination",
        //         clickable: true,
        //     },
        // });

        var swiper = new Swiper(".category-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 2,
                },
                650: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
            },
        });

        var swiper = new Swiper(".products-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                550: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>