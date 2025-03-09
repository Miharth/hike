
<!-- new -->

<?php
session_start();
$_SESSION['login_message'] = 'You are logged in successfully!'; // Set success message
header('Location: index.php');
        

$_SESSION['logout_message'] = 'You have been logged out successfully.'; // Set logout message

session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
header('Location: index.php'); // Redirect to home page

echo "<script type='text/javascript'>
alert('Logged Out Succesful.')
window.location.href='admin_login.php';
</script>";
exit();
?>