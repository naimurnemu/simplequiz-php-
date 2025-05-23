<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $answers = $_POST['answers'];
    $score = 0;

    $total = count($answers);

    foreach ($answers as $qid => $user_answer) {
        $stmt = $conn->prepare("SELECT answer FROM questions WHERE id = ?");
        $stmt->bind_param("i", $qid);
        $stmt->execute();
        $stmt->bind_result($correct_answer);
        $stmt->fetch();
        if ($user_answer === $correct_answer) {
            $score++;
        }
        $stmt->close();
    }

    // Save result
    $stmt = $conn->prepare("INSERT INTO results (user_id, score, total) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $score, $total);
    $stmt->execute();
    $stmt->close();

    header("Location: result.php");
    exit;
}
?>
