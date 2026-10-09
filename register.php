
<?php
require_once "config.php";

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $course = trim($_POST["course"] ?? "");

    if (
        $full_name === "" ||
        $email === "" ||
        $username === "" ||
        $password === "" ||
        $course === ""
    ) {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (strlen($password) < 8) {
        $message = "Password must contain at least 8 characters.";
    } else {
        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $stmt = $conn->prepare(
            "INSERT INTO students
            (full_name, email, username, password, course)
            VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssss",
            $full_name,
            $email,
            $username,
            $hashed_password,
            $course
        );

        if ($stmt->execute()) {
            $message = "Registration successful! You can now log in.";
            $success = true;
        } else {
            if ($stmt->errno === 1062) {
                $message = "That email or username is already registered.";
            } else {
                $message = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #007bff, #8e44ad, #e91e63);
        }

        .container {
            width: 100%;
            max-width: 450px;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 16px;
        }

        button {
            margin-top: 22px;
            border: none;
            background: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .message {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 7px;
            background: #eee;
            overflow-wrap: anywhere;
        }

        .back {
            display: block;
            margin-top: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration</h1>

        <?php if ($message !== ""): ?>
            <div class="message">
                <?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?>
            </div>
        <?php endif; ?>

        <?php if (!$success): ?>
        <form method="POST" action="register.php">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name"
                   maxlength="100" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   maxlength="100" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="username"
                   maxlength="50" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   minlength="8" required>

            <label for="course">Select Course</label>
            <select id="course" name="course" required>
                <option value="">Choose a course</option>
                <option value="Computer Programming">Computer Programming</option>
                <option value="Web Development">Web Development</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Artificial Intelligence">Artificial Intelligence</option>
            </select>

            <button type="submit">Register Now</button>
        </form>
        <?php endif; ?>

        <a class="back" href="index.html">Back to Homepage</a>
    </div>
</body>
</html>
