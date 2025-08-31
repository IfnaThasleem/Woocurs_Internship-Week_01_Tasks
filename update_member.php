<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM members WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

    if (empty($name) || empty($email) || empty($phone) || empty($type)) {
        die("All fields are required!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    if (!is_numeric($phone) || strlen($phone) != 10) {
        die("Phone must be 10 digits!");
    }

    $sql = "UPDATE members SET name='$name', email='$email', phone='$phone', type='$type' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: view_members.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Member</title>
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
<h2 class="mb-4 text-center">✏️ Update Member</h2>
    <form method="POST">
        <div class="mb-3">
        <label class="form-label">Name</label>
            <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control">
        </div>
        <div class="mb-3">
        <label class="form-label">Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" class="form-control">
        </div>
        <div class="mb-3">
        <label class="form-label">Phone</label>
            <input type="text" name="phone" value="<?= $row['phone'] ?>" class="form-control">
        </div>
        <div class="mb-3">
        <label class="form-label">Type</label>
            <select name="type" class="form-control">
                <option value="Student" <?= ($row['type']=="Student") ? "selected" : "" ?>>Student</option>
                <option value="Teacher" <?= ($row['type']=="Teacher") ? "selected" : "" ?>>Teacher</option>
                <option value="Guest" <?= ($row['type']=="Guest") ? "selected" : "" ?>>Guest</option>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="view_members.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</div>
</body>
</html>
