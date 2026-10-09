<?php
session_start();

if (empty($_SESSION["admin_logged_in"])) {
    header("Location: login.php");
    exit;
}

require_once "../config.php";

$result = $conn->query(
    "SELECT id, full_name, email, username, course, created_at
     FROM students ORDER BY id DESC"
);

if (!$result) {
    die("Could not load students: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Students</title>
<style>
body{font-family:Arial;background:#f4f6f9;margin:0;color:#333}
header{background:#172b4d;color:white;padding:20px}
main{padding:20px;max-width:1100px;margin:auto}
a,button{background:#007bff;color:white;padding:10px 14px;border:0;border-radius:5px;text-decoration:none}
.table-wrap{overflow-x:auto;background:white;margin-top:20px}
table{width:100%;border-collapse:collapse}
th,td{padding:12px;border:1px solid #ddd;text-align:left}
th{background:#172b4d;color:white}
</style>
</head>
<body>
<header><h1>Manage Students</h1></header>
<main>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<h2>Registered Students</h2>
<div class="table-wrap">
<table>
<tr>
<th>ID</th><th>Full Name</th><th>Email</th>
<th>Username</th><th>Course</th><th>Date Registered</th>
</tr>
<?php while ($student = $result->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars((string)$student["id"]) ?></td>
<td><?= htmlspecialchars($student["full_name"]) ?></td>
<td><?= htmlspecialchars($student["email"]) ?></td>
<td><?= htmlspecialchars($student["username"]) ?></td>
<td><?= htmlspecialchars($student["course"]) ?></td>
<td><?= htmlspecialchars($student["created_at"]) ?></td>
</tr>
<?php endwhile; ?>
</table>
</div>
</main>
</body>
</html>