
<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}

$student_id = (int) $_SESSION["student_id"];

$stmt = $conn->prepare(
    "SELECT full_name, email, username, course, created_at
     FROM students
     WHERE id = ?"
);

$stmt->bind_param("i", $student_id);
$stmt->execute();
$stmt->bind_result(
    $full_name,
    $email,
    $username,
    $course,
    $created_at
);

if (!$stmt->fetch()) {
    $stmt->close();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        header {
            background: linear-gradient(135deg, #007bff, #8e44ad);
            color: white;
            padding: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        header h2 {
            margin: 0;
        }

        .logout {
            background: #e91e63;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
        }

        main {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 25px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            color: #007bff;
            margin-top: 0;
        }

        .value {
            font-size: 18px;
            overflow-wrap: anywhere;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #666;
        }
    </style>
</head>
<body>

<header>
    <h2>College Student Portal</h2>
    <a class="logout" href="logout.php">Logout</a>
</header>

<main>
    <section class="welcome">
        <h1>
            Welcome,
            <?= htmlspecialchars($full_name, ENT_QUOTES, "UTF-8") ?>!
        </h1>
        <p>You are successfully logged in to your student dashboard.</p>
    </section>

    <section class="cards">
        <div class="card">
            <h3>Student Name</h3>
            <p class="value">
                <?= htmlspecialchars($full_name, ENT_QUOTES, "UTF-8") ?>
            </p>
        </div>

        <div class="card">
            <h3>Email Address</h3>
            <p class="value">
                <?= htmlspecialchars($email, ENT_QUOTES, "UTF-8") ?>
            </p>
        </div>

        <div class="card">
            <h3>Username</h3>
            <p class="value">
                <?= htmlspecialchars($username, ENT_QUOTES, "UTF-8") ?>
            </p>
        </div>

        <div class="card">
            <h3>Course</h3>
            <p class="value">
                <?= htmlspecialchars($course, ENT_QUOTES, "UTF-8") ?>
            </p>
        </div>

        <div class="card">
            <h3>Registration Date</h3>
            <p class="value">
                <?= htmlspecialchars($created_at, ENT_QUOTES, "UTF-8") ?>
            </p>
        </div>
    </section>
</main>

<footer>
    &copy; <?= date("Y") ?> College Registration Portal
</footer>

</body>
</html>
