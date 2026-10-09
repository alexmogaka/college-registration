<?php
session_start();

if (empty($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

require_once "../config.php";

$totalResult = $conn->query("SELECT COUNT(*) AS total FROM students");
if (!$totalResult) {
    die("Could not generate report: " . $conn->error);
}
$totalStudents = $totalResult->fetch_assoc()["total"];

$courseResult = $conn->query(
    "SELECT course, COUNT(*) AS total
     FROM students GROUP BY course ORDER BY course"
);
if (!$courseResult) {
    die("Could not generate course report: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>College Reports</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0;color:#333}
header{background:#172b4d;color:white;padding:20px}
main{padding:20px;max-width:900px;margin:auto}
.card{background:white;padding:22px;margin:15px 0;border-radius:8px}
a{background:#007bff;color:white;padding:10px 14px;text-decoration:none;border-radius:5px}
table{width:100%;border-collapse:collapse;background:white}
th,td{padding:12px;border:1px solid #ddd;text-align:left}
th{background:#172b4d;color:white}
</style>
</head>
<body>
<header><h1>College Reports</h1></header>
<main>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<div class="card">
<h2>Total Registered Students</h2>
<p><strong><?= htmlspecialchars((string)$totalStudents) ?></strong></p>
</div>
<h2>Students by Course</h2>
<table>
<tr><th>Course</th><th>Number of Students</th></tr>
<?php while ($row = $courseResult->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($row["course"]) ?></td>
<td><?= htmlspecialchars((string)$row["total"]) ?></td>
</tr>
<?php endwhile; ?>
</table>
</main>
</body>
</html>