<?php
session_start();

if (empty($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>System Settings</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0;color:#333}
header{background:#172b4d;color:white;padding:20px}
main{padding:20px;max-width:800px;margin:auto}
.card{background:white;padding:22px;border-radius:10px}
a{background:#007bff;color:white;padding:10px 14px;text-decoration:none;border-radius:5px}
</style>
</head>
<body>
<header><h1>System Settings</h1></header>
<main>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<div class="card">
<h2>College Registration System</h2>
<p><strong>System:</strong> College Registration</p>
<p><strong>Environment:</strong> Local development with XAMPP</p>
<p><strong>Database:</strong> college_registration</p>
<p>These are informational settings. They do not change database configuration or admin credentials.</p>
</div>
</main>
</body>
</html>