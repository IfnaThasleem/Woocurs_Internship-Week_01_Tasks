<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $year = $_POST['year'];

    // Basic validation
    if (empty($title) || empty($author) || empty($isbn) || empty($year)) {
        die("All required fields must be filled!");
    }

    $sql = "INSERT INTO books (title, author, isbn, category, year) 
            VALUES ('$title', '$author', '$isbn', '$category', '$year')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Book added successfully!'); window.location.href='view_books.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
