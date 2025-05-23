<?php
include '../config.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $answer = $options[$selected];

    $stmt = $conn->prepare("INSERT INTO questions (question, opt1, opt2, opt3, opt4, answer) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $question, $opt1, $opt2, $opt3, $opt4, $answer);

    if ($stmt->execute()) {
        $message = "<p class='success'>✅ Question added successfully.</p>";
    } else {
        $message = "<p class='error'>❌ Error: " . $conn->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }
        .container {
            width: 400px;
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
        .form-group {
            margin-bottom: 20px;
            width: 100%;
            margin: 0 auto 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        textarea, input[type="text"], select {
            /* width: 100%; */
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background: #0069d9;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Question</h2>
        <?php if (!empty($message)) echo $message; ?>
        <form method="post">
            <div class="form-group">
                <textarea name="question" rows="3" placeholder="Enter your question" required></textarea>
            </div>
            <div class="form-group">
                <input type="text" name="opt1" placeholder="Option 1" required>
            </div>
            <div class="form-group">
                <input type="text" name="opt2" placeholder="Option 2" required>
            </div>
            <div class="form-group">
                <input type="text" name="opt3" placeholder="Option 3" required>
            </div>
            <div class="form-group">
                <input type="text" name="opt4" placeholder="Option 4" required>
            </div>
            <div class="form-group">
                <label for="answer">Correct Answer:</label>
                <select name="answer" id="answer" required class="form-control">
                    <option value="">-- Select Correct Answer --</option>
                    <option value="opt1">Option 1</option>
                    <option value="opt2">Option 2</option>
                    <option value="opt3">Option 3</option>
                    <option value="opt4">Option 4</option>
                </select>
            </div>
            <button type="submit">Add Question</button>
        </form>
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
</body>
</html>
