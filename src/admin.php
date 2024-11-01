<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) { 
    echo '<script>
    alert("Not an admin, redirecting to login page");
    window.location.href = "login.php";
    </script>';

 
    
 
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $_GET['delete']]);
    echo '<script>
    alert("Succesfully deleted user")</script>';
       
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
$activityStmt = $pdo->query("SELECT user_id, activity_type, timestamp FROM user_activity ORDER BY timestamp DESC");
$activities = $activityStmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <style>
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    background-color: #fdfdfd;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

th, td {
    padding: 12px 15px;
    text-align: left;
}

th {
    background-color: #34495e;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

a {
    color: #e74c3c;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #c0392b;
}

    </style>
</head>
<body>
    <h2>Admin Panel</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= htmlspecialchars($user['username']); ?></td>
                <td><?= htmlspecialchars($user['password']); ?></td>
                <td><a href="?delete=<?= $user['id']; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>User Activity Log</h3>
<table>
    <tr>
        <th>User ID</th>
        <th>Activity</th>
        <th>Timestamp</th>
    </tr>
    <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?= htmlspecialchars($activity['user_id']); ?></td>
            <td><?= htmlspecialchars($activity['activity_type']); ?></td>
            <td><?= htmlspecialchars($activity['timestamp']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
