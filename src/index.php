<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' => $password]);

    $user_id = $pdo->lastInsertId();

    if ($user_id == 1) {
        echo "Admin registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "New user registration successful! <a href='login.php'>Login here</a>";
    }
    sleep(1);

}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
form {
    background-color: #e7f4f9;
}

button {
    background-color: #007BFF;
}

button:hover {
    background-color: #0069D9;
}

    </style>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
