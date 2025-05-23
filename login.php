<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: quiz.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Quiz System</title>
    <link rel="stylesheet" href="css/style.css" />
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
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" action="" class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required class="form-control" />
            
            <label>Password:</label>
            <input type="password" name="password" required class="form-control" />
            
            <button type="submit" class="btn">Login</button>
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
