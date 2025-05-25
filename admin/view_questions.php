<?php
include '../config.php';
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM questions WHERE id = $id");
    header("Location: view_questions.php");
    exit;
}

$questions = $conn->query("SELECT * FROM questions");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        a.delete, a.edit {
            margin-right: 10px;
            text-decoration: none;
        }
        a.delete {
            color: #dc3545;
        }
        a.edit {
            color: #28a745;
        }
        a:hover {
            text-decoration: underline;
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Questions</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $questions->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['question']); ?></td>
                <td><?php echo htmlspecialchars($row['answer']); ?></td>
                <td>
                    <a class="edit" href="edit_question.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="delete" href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a class="back" href="dashboard.php">← Back to Dashboard</a>
    </div>
</body>
</html>