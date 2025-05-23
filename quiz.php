<?php
include 'config.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all questions
$result = $conn->query("SELECT * FROM questions");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .question {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .question p {
            font-weight: bold;
        }
        label {
            display: block;
            margin: 5px 0;
            cursor: pointer;
        }
        button {
            display: block;
            padding: 12px 25px;
            font-size: 16px;
            margin: 30px auto 10px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0069d9;
        }
        a {
            text-align: center;
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Quiz</h2>
    <form method="post" action="submit.php">
        <?php
        $qno = 1;
        while ($row = $result->fetch_assoc()) {
            $qid = (int)$row['id'];
            echo "<div class='question'>";
            echo "<p>Q{$qno}: " . htmlspecialchars($row['question']) . "</p>";
            foreach (['opt1', 'opt2', 'opt3', 'opt4'] as $key) {
                $value = htmlspecialchars($row[$key]);
                $inputId = "q{$qid}_{$key}";
                echo "<label for='$inputId'><input type='radio' id='$inputId' name='answers[$qid]' value='$value' required> $value</label>";
            }
            echo "</div>";
            $qno++;
        }
        ?>
        <button type="submit">Submit Answers</button>
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
