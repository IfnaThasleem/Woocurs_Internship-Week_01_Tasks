<?php
include 'config.php';

$books = $conn->query("SELECT COUNT(*) as total_books FROM books")->fetch_assoc()['total_books'] ?? 0;
$members = $conn->query("SELECT COUNT(*) as total_members FROM members")->fetch_assoc()['total_members'] ?? 0;

echo json_encode(['books'=>$books,'members'=>$members]);
?>
