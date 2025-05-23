<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT score, total, date FROM results WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($score, $total, $date);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 100px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 30px;
            color: #333;
        }
        p {
            font-size: 18px;
            margin-bottom: 15px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a:hover {
            background: #0056b3;
        }
        .score {
            font-size: 22px;
            font-weight: bold;
            color: #28a745;
        }
        .date {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Quiz Result</h2>
        <?php if (isset($score)): ?>
            <p class="score"><?php echo "Score: $score / $total"; ?></p>
            <p class="date"><?php echo "Date: " . date("F j, Y, g:i a", strtotime($date)); ?></p>
        <?php else: ?>
            <p>No result found.</p>
        <?php endif; ?>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>
