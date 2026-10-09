<?php
session_start();

if (empty($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

$courses = [
    "Computer Programming",
    "Web Development",
    "Information Technology",
    "Artificial Intelligence"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Courses</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0;color:#333}
header{background:#172b4d;color:white;padding:20px}
main{padding:20px;max-width:900px;margin:auto}
.card{background:white;padding:20px;margin:12px 0;border-radius:8px;box-shadow:0 2px 8px #ddd}
a{background:#007bff;color:white;padding:10px 14px;text-decoration:none;border-radius:5px}
</style>
</head>
<body>
<header><h1>Available Courses</h1></header>
<main>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<?php foreach ($courses as $course): ?>
<div class="card">
<h3><?= htmlspecialchars($course) ?></h3>
<p>This course is available as an option on the registration form.</p>
</div>
<?php endforeach; ?>
</main>
</body>
</html>