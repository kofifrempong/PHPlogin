<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
    
        $stmt = $pdo->prepare("INSERT INTO user_activity (user_id, activity_type) VALUES (:user_id, 'login')");
        $stmt->execute(['user_id' => $user['id']]);
    
        echo '<script>
            alert("Success");
            window.location.href = "dashboard.php";
        </script>';
    } else {
        echo "Invalid credentials!";
    }
    
}
?>


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
    <h2>Login</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" autocomplete="on" required>
        <button type="submit">Login</button>
    </form>
</body>

