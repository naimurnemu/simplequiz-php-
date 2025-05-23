<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Quiz System</title>
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
        <h2>Register</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required class="form-control" />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required class="form-control" />
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>

