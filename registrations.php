<?php
session_start();

if (empty($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

require_once "../config.php";
$result = $conn->query(
    "SELECT id, full_name, username, course, created_at
     FROM students ORDER BY created_at DESC"
);

if (!$result) {
    die("Could not load registrations: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registrations</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0}
header{background:#172b4d;color:white;padding:20px}
main{padding:20px}
a{background:#007bff;color:white;padding:10px 14px;text-decoration:none;border-radius:5px}
.table-wrap{overflow-x:auto;margin-top:20px;background:white}
table{width:100%;border-collapse:collapse}
th,td{padding:12px;border:1px solid #ddd;text-align:left}
th{background:#172b4d;color:white}
</style>
</head>
<body>
<header><h1>Student Registrations</h1></header>
<main>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<div class="table-wrap">
<table>
<tr><th>ID</th><th>Name</th><th>Username</th><th>Course</th><th>Date</th></tr>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars((string)$row["id"]) ?></td>
<td><?= htmlspecialchars($row["full_name"]) ?></td>
<td><?= htmlspecialchars($row["username"]) ?></td>
<td><?= htmlspecialchars($row["course"]) ?></td>
<td><?= htmlspecialchars($row["created_at"]) ?></td>
</tr>
<?php endwhile; ?>
</table>
</div>
</main>
</body>
</html>