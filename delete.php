<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['id'] ?? '';

    if (empty($id)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        exit;
    }

    
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    echo json_encode(['status' => 'success', 'message' => 'Post deleted successfully.']);
} else {
    
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
