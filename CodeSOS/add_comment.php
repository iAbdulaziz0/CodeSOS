<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $problem_id = $_POST['problem_id'];
    $user_id = $_POST['user_id'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (problem_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $problem_id, $user_id, $comment);

    if ($stmt->execute()) {
        header("Location: problem_details.php?id=$problem_id");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
