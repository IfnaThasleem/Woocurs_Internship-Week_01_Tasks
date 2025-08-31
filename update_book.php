<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $year = $_POST['year'];

    if (empty($title) || empty($author) || empty($isbn) || empty($category) || empty($year)) {
        die("All fields are required!");
    }

    $sql = "UPDATE books SET title='$title', author='$author', isbn='$isbn', category='$category', year='$year' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_books.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.html">📖 Library System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto" style="gap: 15px;">
        <li class="nav-item">
          <a class="nav-link active" href="index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="book_form.html">Add Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_books.php">Manage Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member_form.html">Add Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view_members.php">Manage Members</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
/* Add vertical lines between nav items */
.navbar-nav .nav-item + .nav-item {
  border-left: 1px solid rgba(255, 255, 255, 0.3);
  padding-left: 15px;
  margin-left: 15px;
}
</style>

<div class="container mt-5">
<div class="card p-4">
    <h2 class="mb-4 text-center">✏️ Update Book</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="<?= $row['title'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" value="<?= $row['author'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input type="text" name="isbn" value="<?= $row['isbn'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" value="<?= $row['category'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Year</label>
            <input type="number" name="year" value="<?= $row['year'] ?>" class="form-control">
            <div class="text-center">
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="view_books.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</div>
</body>
</html>
