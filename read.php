<?php
require 'db.php';


$sql = "SELECT * FROM posts ORDER BY publication_date DESC";
$stmt = $pdo->query($sql);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
echo json_encode($posts);
?>
