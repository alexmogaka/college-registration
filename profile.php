<?php
session_start();

if (empty($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION["admin_username"] ?? "admin";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Profile</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0}
header{background:#172b4d;color:white;padding:20px}
main{padding:20px;max-width:700px;margin:auto}
.card{background:white;padding:25px;border-radius:10px}
a{background:#007bff;color:white;padding:10px 14px;text-decoration:none;border-radius:5px}
</style>
</head>
<body>
<header><h1>Administrator Profile</h1></header>
<main>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<div class="card">
<h2>Admin Account</h2>
<p><strong>Username:</strong> <?= htmlspecialchars($username) ?></p>
<p><strong>Account type:</strong> Administrator</p>
<p>This page displays your current admin session details.</p>
</div>
</main>
</body>
</html>