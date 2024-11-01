<?php
session_start();
if (!isset($_SESSION['user_id'])) {


    
    echo '<script>
    alert("Not logged in, redirecting to login page");
    window.location.href = "login.php";
    </script>';
   

}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
h2 {
    font-family: Arial, sans-serif;
    color: #2c3e50;
    text-align: center;
    margin-top: 40px;
    font-size: 28px;
}

p {
    text-align: center;
    margin-top: 20px;
}

a {
    text-decoration: none;
    color: #e74c3c;
    font-weight: bold;
}

a:hover {
    color: #c0392b;
}

    </style>
</head>
<body>
    <h2>Welcome to your dashboard!</h2>
    <p><a href="logout.php">Logout</a></p>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1): ?>
        <p><a href="admin.php">Go to Admin Panel</a></p>
    <?php endif; ?>
</body>
</html>
