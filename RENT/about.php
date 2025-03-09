<?php
include 'include/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - eHike</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h2 {
            color: #0056b3; /* A nice blue */
        }
        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 20px auto;
            border-radius: 8px; /* Rounded corners for images */
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2); /* Subtle shadow */
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .highlight {
            font-weight: bold;
            color: #007bff; /* Bootstrap primary blue */
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: small;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About Us - eHike</h1>

        <img src="placeholder-hiking.jpg" alt="Hikers enjoying a scenic view">
        <p>
            Welcome to eHike, your online companion for discovering and planning unforgettable hiking adventures. We are a team of passionate hikers and technology enthusiasts dedicated to making the outdoors more accessible to everyone.
        </p>

        <h2>Our Mission</h2>
        <p>
            Our mission is simple: to inspire and empower people to explore the natural world through hiking. We believe that spending time in nature has profound benefits for both physical and mental well-being. We strive to provide comprehensive resources, tools, and a vibrant community to help you plan your perfect hike, from local trails to epic multi-day expeditions.
        </p>

        <h2>What We Offer</h2>
        <ul>
            <li><span class="highlight">Trail Guides:</span> Detailed information on trails around the world, including maps, difficulty ratings, elevation profiles, and user reviews.</li>
            <li><span class="highlight">Trip Planning Tools:</span> Create personalized itineraries, track your progress, and share your adventures with friends.</li>
            <li><span class="highlight">Community Forum:</span> Connect with fellow hikers, share tips and experiences, and find hiking partners.</li>
            <li><span class="highlight">Safety Resources:</span> Essential information on hiking safety, gear recommendations, and emergency procedures.</li>
        </ul>

        <h2>Our Story</h2>
        <p>
            eHike was born from a shared love of the outdoors. Frustrated by the lack of a comprehensive online resource for hikers, we decided to create our own. We started small, with a simple website and a handful of local trail guides. Over time, thanks to the support of our growing community, we have expanded our reach to include trails all over the world.
        </p>
        <p>We are constantly working to improve eHike and add new features. We value your feedback and encourage you to get in touch with any suggestions or comments.</p>

        <h2>Contact Us</h2>
        <p>Email: info@ehike.com</p>
        <p>We are excited to have you join our hiking community!</p>
    </div>

    <footer>
        &copy; 2023 eHike. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
    </footer>

</body>
</html>