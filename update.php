<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (empty($id) || empty($title) || empty($content)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        exit;
    }


    $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id, 'title' => $title, 'content' => $content]);

    echo json_encode(['status' => 'success', 'message' => 'Post updated successfully.']);
} else {
    // If the request method is not POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
