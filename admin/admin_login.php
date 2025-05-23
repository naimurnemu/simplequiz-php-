<?php
session_start();
include '../config.php';

$admin_user = 'admin';
$admin_pass = 'admin123';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid admin credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        .container {
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required class="form-control" />

            <label>Password:</label>
            <input type="password" name="password" required class="form-control" />

            <button type="submit" class="btn">Login</button>
        </form>
        <p><a href="../index.php">Back to Home</a></p>
    </div>
</body>
</html>
