<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/style.css" />
    <title>Online Quiz System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* padding: 20px; */
            background: #e9ecef;
        }
        header {
            background: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        main {
            margin: 20px 0;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-outline-primary {
            background: white;
            color: #007bff;
            border: 1px solid #007bff;
        }

        .text-center {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Online Quiz System</h1>
    </header>

    <main class="container">
        <h1 class="display-4">Welcome to the Online Quiz System</h1>
        <p class="lead">Take a quiz to test your knowledge, and view your results.</p>
        <hr class="my-4">
        <p class="text-center">
            <a href="register.php" class="btn btn-primary">Register</a>
            <a href="login.php" class="btn btn-outline-primary">Login</a>
        </p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Quiz System Inc. All rights reserved.</p>
        <p><a href="admin/admin_login.php">Admin</a></p>
    </footer>
</body>
</html>

