<?php
include '../config.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$message = '';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$questionData = $result->fetch_assoc();
$stmt->close();

if (!$questionData) {
    die("Question not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $selected = $_POST['answer'];

    $options = [
        'opt1' => $opt1,
        'opt2' => $opt2,
        'opt3' => $opt3,
        'opt4' => $opt4
    ];

    $answer = $options[$selected];

    $stmt = $conn->prepare("UPDATE questions SET question=?, opt1=?, opt2=?, opt3=?, opt4=?, answer=? WHERE id=?");
    $stmt->bind_param("ssssssi", $question, $opt1, $opt2, $opt3, $opt4, $answer, $id);

    if ($stmt->execute()) {
        $message = "<p class='success'>✅ Question updated successfully.</p>";
        // Refresh question data
        $questionData = [
            'question' => $question,
            'opt1' => $opt1,
            'opt2' => $opt2,
            'opt3' => $opt3,
            'opt4' => $opt4,
            'answer' => $answer
        ];
    } else {
        $message = "<p class='error'>❌ Error: " . $conn->error . "</p>";
    }

    $stmt->close();
}

function getSelected($correctAnswer, $option, $value) {
    return ($correctAnswer === $value) ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
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
        }
        textarea, input[type="text"], select {
            width: 100%;
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
        <h2>Edit Question</h2>
        <?php if (!empty($message)) echo $message; ?>
        <form method="post">
            <div class="form-group">
                <textarea name="question" rows="3" required><?php echo htmlspecialchars($questionData['question']); ?></textarea>
            </div>
            <div class="form-group">
                <input type="text" name="opt1" value="<?php echo htmlspecialchars($questionData['opt1']); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="opt2" value="<?php echo htmlspecialchars($questionData['opt2']); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="opt3" value="<?php echo htmlspecialchars($questionData['opt3']); ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="opt4" value="<?php echo htmlspecialchars($questionData['opt4']); ?>" required>
            </div>
            <div class="form-group">
                <label for="answer">Correct Answer:</label>
                <select name="answer" id="answer" required>
                    <option value="">-- Select Correct Answer --</option>
                    <option value="opt1" <?= ($questionData['answer'] == $questionData['opt1']) ? 'selected' : '' ?>>Option 1</option>
                    <option value="opt2" <?= ($questionData['answer'] == $questionData['opt2']) ? 'selected' : '' ?>>Option 2</option>
                    <option value="opt3" <?= ($questionData['answer'] == $questionData['opt3']) ? 'selected' : '' ?>>Option 3</option>
                    <option value="opt4" <?= ($questionData['answer'] == $questionData['opt4']) ? 'selected' : '' ?>>Option 4</option>
                </select>
            </div>
            <button type="submit">Update Question</button>
        </form>
        <a href="view_questions.php">⬅ Back to Questions</a>
    </div>
</body>
</html>