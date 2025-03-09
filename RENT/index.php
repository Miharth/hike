<?php
include 'include/connect.php';

session_start();
if (isset($_POST['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


// Display login success message
if (isset($_SESSION['login_message'])) {
    echo "<script>alert('" . $_SESSION['login_message'] . "');</script>";
    unset($_SESSION['login_message']); // Clear the message after displaying it
}




// Display logout message
if (isset($_SESSION['logout_message'])) {
    echo "<script>alert('" . $_SESSION['logout_message'] . "');</script>";
    unset($_SESSION['logout_message']); // Clear the message after displaying it
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <!-- CSS FILE FOR INDEX PAGE  -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- <link rel="stylesheet" href="INDEX.css"> -->

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <!--Bootstrap Link-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .boxs {
            width: 50%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
            margin-left: 25%;
            padding: 15px;
            transition: 0.3s ease;
        }

        .boxs:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .boxs img {
            /* width: 100%; */
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #ff6600;
        }

        .qty {
            width: 50px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }

        .btns {
            width: 100%;
            padding: 10px;
            border: none;
            background: #28a745;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
            margin-top: 10px;
        }

        .btns:hover {
            background: #218838;
        }


        h1 {
            text-align: center;
        }


        /* side box */
    </style> -->

    <!-- TRY CSS -->

    <STYLE> 
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f8f9fa;
}

.navbar {
    margin-bottom: 20px;
}

.box-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 20px 0;
}

.boxs {
    width: 300px; /* Fixed width for better layout */
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin: 15px; /* Margin for spacing between boxes */
    padding: 15px;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}

.boxs:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px); /* Slight lift effect */
}

.boxs img {
    height: 200px;
    width: auto; /* Full width for better responsiveness */
    object-fit: cover;
    border-radius: 8px;
}

.name {
    font-size: 20px;
    font-weight: bold;
    margin: 10px 0;
    color: #333;
    text-align: center; /* Center the product name */
}

.flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.price {
    font-size: 18px;
    font-weight: bold;
    color:rgb(0, 0, 0);
}

.qty {
    width: 60px; /* Increased width for better usability */
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center;
    font-size: 16px;
}

.btns {
    width: 100%;
    padding: 10px;
    border: none;
    background: #28a745;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.3s ease;
    margin-top: 10px;
}

.btns:hover {
    background: #218838;
    transform: translateY(-2px); /* Slight lift effect on hover */
}

h1.heading {
    text-align: center;
    margin: 20px 0;
    color: #333; /* Darker color for better readability */
}

footer {
    background-color: #343a40;
    padding: 10px 0;
}

footer .text-center {
    color: #ffffff; /* White text for contrast */
}


.icon {
    display: flex;
    align-items: center; /* Center icons vertically */
}

.icon-link {
    text-decoration: none; /* Remove underline */
    color: #333; /* Dark gray color */
    margin: 0 15px; /* Space between icons */
    font-size: 18px; /* Icon size */
    display: flex; /* Use flex to align icon and text */
    align-items: center; /* Center text vertically with icon */
    transition: color 0.3s; /* Smooth color transition on hover */
}

.icon-link:hover {
    color: #28a745; /* Change color on hover */
}

.icon-link i {
    margin-right: 5px; /* Space between icon and text */
}


    </STYLE> 

         
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Hike Gear Nepal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>


            <form class="d-flex" action="search_page.php" method="post">
                <!-- <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search"
                    aria-label="Search" maxlength="100" required> -->
              
            </form>

            <!-- <div class="icon">
                <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="user_login.php"><i class="fa-solid fa-user"></i></a>
                <a href="user_logout.php"><i class="fa-solid fa-sign-out-alt"></i>Logout</a> 
            </div> -->

            <div class="icon">
                <a href="cart.php" class="icon-link"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="user_login.php" class="icon-link"><i class="fa-solid fa-user"></i></a>
                <a href="user_logout.php" class="icon-link"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
    
             </div>


        </div>
    </nav>

    <div class="home-bg">
        <section class="home">
            <div class="home-slider">
                <!-- <div class="swiper-wrapper"> -->
                <div class="slide">
                    <div class="image">
                        <img src="images/banner/pana2.jpg" alt=""
                            style="height: 50rem; object-fit: cover; width: 100%;">
                    </div>
                    <div class="content">
                        <!-- <span>HIKE GEAR NEPAL</span> -->

                    </div>
                </div>
            </div>
            <!-- </div> -->
            <div class="swiper-pagination"></div>
        </section>
    </div>

    <section class="category">
        <!-- <h1 class="heading"></h1>+ -->
        <div class="swiper category-slider">

            <div class="swiper-pagination"></div>
        </div>
    </section>

    <h1 class="heading"> products</h1>


    <!-- ANKIT  -->

    <div class="box-container">

<?php

$query = "SELECT * FROM products LIMIT 6";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($fetch_product = mysqli_fetch_assoc($result)) {
        ?>

        <div class="sidebar">
            <!-- Sidebar content here if needed -->
        </div>
        <div class="boxs">

            <form action="cart.php" method="post" class="slides">

                <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_product['id']); ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_product['name']); ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_product['price']); ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_product['image']); ?>">
                <input type="hidden" name="description" value="<?= htmlspecialchars($fetch_product['description']); ?>">

                <!-- Product image -->
                <img src="images/products/<?= htmlspecialchars($fetch_product['image']); ?>" alt="">

                <div class="name"><?= htmlspecialchars($fetch_product['name']); ?></div>

                <div class="flex">
                    <div class="price">
                        <span>Rs.</span><?= htmlspecialchars($fetch_product['price']); ?><span>/-</span>
                    </div>

                   QTY: <input type="number" name="qty" class="qty" min="1" max="99"
                           onkeypress="if(this.value.length==2) return false;" value="">
                </div>

                <!-- Display product description -->
                <h3>Description:</h3>
                <p><?= htmlspecialchars($fetch_product['description']); ?></p>

                <input type="submit" value="Rent" class="btns" name="add_to_cart">
            </form>

        </div>

        <?php
    }
} else {
    echo '<p class="empty">No Products Found.</p>';
}

?>
</div>


    <!-- ANKIT  -->

    <footer style="background-color:rgb(0, 0, 0); color: white; text-align: center; padding: 20px; margin-top: 20px;">
    <div>
        <h4>Hike Gear Nepal</h4>
        <p>Your trusted partner for all hiking adventures.</p>
    </div>
    <div>
        <a href="privacy_policy.php" style="color: white; text-decoration: none; margin: 0 15px;">Privacy Policy</a>
        <a href="terms_of_service.php" style="color: white; text-decoration: none; margin: 0 15px;">Terms of Service</a>
        <a href="contact.php" style="color: white; text-decoration: none; margin: 0 15px;">Contact Us</a>
    </div>
    <div style="margin-top: 10px;">
        <p>&copy; 2025 Hike Gear Nepal. All rights reserved.</p>
    </div>
</footer>


    
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