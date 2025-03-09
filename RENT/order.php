<?php

include 'include/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You are not logged in.');
    window.location.href='user_login.php';</script>";
    exit;
}
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM `orders` WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- CSS FOR ORDER PAGE  -->

    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <!--Bootstrap Link-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .empty {
            cursor: pointer;
        }

         /* General Reset */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    /* Navbar Styling */
    .navbar {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: bold;
        font-size: 1.5rem;
    }

    .nav-link.active {
        font-weight: bold;
        color: #198754 !important;
    }

    /* Orders Section */
    .orders {
        padding: 4rem 1rem;
        max-width: 1200px;
        margin: 5rem auto 0;
    }

    .orders .heading {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 2rem;
    }

    .box-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        padding: 0 1rem;
    }

    .box {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .box:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .box p {
        margin: 0.5rem 0;
        font-size: 1rem;
        color: #555;
    }

    .box p span {
        font-weight: bold;
        color: #333;
    }

    .box p span[style*="color: red"] {
        color: red !important;
    }

    .box p span[style*="color: green"] {
        color: green !important;
    }

    /* Responsive Form */
    .d-flex {
        gap: 0.5rem;
    }

    .search-input {
        max-width: 300px;
        border-radius: 20px;
    }

    .btn-search {
        border-radius: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }

        .btn-search {
            font-size: 0.9rem;
        }

        .box {
            padding: 1rem;
        }

        .box p {
            font-size: 0.9rem;
        }
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
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="order.php">Orders</a>
                    </li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>


            <form class="d-flex" action="search_page.php" method="post">
                <!-- <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search" aria-label="Search" maxlength="100" required> -->
                <!-- <button class="btn btn-outline-success btn-search" type="submit" name="search_btn">Search</button> -->
            </form>

            <!-- <div class="icon">
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="wishlist.php"><i class="fa-solid fa-heart"></i></a>
                <a href="user_login.php"><i class="fa-solid fa-user"></i></a>
            </div> -->
        </div>
    </nav>

    <section class="orders">
        <h1 class="heading">Placed Orders</h1>

        <div class="box-container">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="box">
                        <p>Name: <span><?= htmlspecialchars($row['name']); ?></span></p>
                        <p>Email: <span><?= htmlspecialchars($row['email']); ?></span></p>
                        <p>Number: <span><?= htmlspecialchars($row['number']); ?></span></p>
                        <p>Address: <span><?= htmlspecialchars($row['address']); ?></span></p>
                        <p>Payment Method: <span><?= htmlspecialchars($row['method']); ?></span></p>
                        <p>Total Orders: <span><?= htmlspecialchars($row['total_products']); ?></span></p>
                        <p>Total Price: <span><?= htmlspecialchars($row['total_price']); ?></span></p>
                        <p>Payment Status: <span style="color: <?= $row['payment_status'] === 'pending' ? 'red' : 'green'; ?>;">
                                <?= htmlspecialchars($row['payment_status']); ?></span></p>
                    </div>
            <?php
                }
            } else {
                echo "<script type='text/javascript'>
                alert('No orders placed.');
                window.location.href='index.php';
                </script>";
            }
            ?>
        </div>
    </section>


    <!-- <footer class="bg-secondary text-center text-white">

        <div class="container p-4 pb-0">

            <section class="mb-4">

                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>


                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
            </section>

        </div>

        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2025 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">Hike Gear Nepal</a>
        </div>

    </footer> -->


    <script src="js/script.js"></script>

    <script>
        var swiper = new Swiper(".home-slider", {
            loop: true,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

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