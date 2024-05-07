<?php
require 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (empty($title) || empty($content)) {
        echo json_encode(['status' => 'error', 'message' => 'Title and content are required.']);
        exit;
    }

        $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'content' => $content]);

    echo json_encode(['status' => 'success', 'message' => 'Post created successfully.']);
} else {
    
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>