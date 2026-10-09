
<?php
session_start();
require_once "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $message = "Please enter your username and password.";
    } else {
        $stmt = $conn->prepare(
            "SELECT id, full_name, username, password
             FROM students
             WHERE username = ?"
        );

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result(
                $id,
                $full_name,
                $saved_username,
                $hashed_password
            );

            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_regenerate_id(true);

                $_SESSION["student_id"] = $id;
                $_SESSION["student_name"] = $full_name;
                $_SESSION["student_username"] = $saved_username;

                $stmt->close();

                header("Location: dashboard.php");
                exit;
            }
        }

        $stmt->close();
        $message = "Incorrect username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #007bff, #8e44ad, #e91e63);
        }

        .container {
            width: 100%;
            max-width: 420px;
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
            margin-top: 18px;
            font-weight: bold;
        }

        input, button {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 16px;
        }

        button {
            margin-top: 22px;
            color: white;
            background: #007bff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .message {
            padding: 12px;
            background: #f8d7da;
            border-radius: 7px;
            color: #721c24;
        }

        .links {
            margin-top: 20px;
            text-align: center;
            line-height: 2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Login</h1>

        <?php if ($message !== ""): ?>
            <p class="message">
                <?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"
                   maxlength="50" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   required>

            <button type="submit">Login</button>
        </form>

        <div class="links">
            <a href="register.php">Create an account</a><br>
            <a href="index.html">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
