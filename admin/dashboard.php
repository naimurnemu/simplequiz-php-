<?php
session_start();
include '../config.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }
        .container {
            width: 500px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 15px 0;
        }
        a.button-link {
            display: block;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
            font-size: 16px;
        }
        a.button-link:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a class="button-link" href="add_question.php">➕ Add Question</a></li>
            <li><a class="button-link" href="view_questions.php">📄 View Questions</a></li>
            <li><a class="button-link" href="../index.php">🏠 Home</a></li>
            <li><a class="button-link" href="../logout.php">🚪 Logout</a></li>
        </ul>
    </div>
</body>
</html>
