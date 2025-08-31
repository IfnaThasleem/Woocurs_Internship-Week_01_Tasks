<?php
include 'config.php';

// Fetch total books
$book_result = $conn->query("SELECT COUNT(*) as total_books FROM books");
$total_books = $book_result->fetch_assoc()['total_books'] ?? 0;

// Fetch total members
$member_result = $conn->query("SELECT COUNT(*) as total_members FROM members");
$total_members = $member_result->fetch_assoc()['total_members'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Library Management System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.hero {
  background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
              url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f') no-repeat center center/cover;
  color: white; padding:120px 20px; border-radius:12px;
}
.card { border-radius:12px; box-shadow:0 4px 8px rgba(0,0,0,0.1); transition:transform 0.2s; }
.card:hover { transform: translateY(-5px); }
.cta { background:#343a40; color:white; padding:50px 20px; border-radius:12px; }
.cta .btn { transition: transform 0.2s; }
.cta .btn:hover { transform: scale(1.08); }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">📖 Library System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="book_form.php">Books</a></li>
        <li class="nav-item"><a class="nav-link" href="member_form.php">Members</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="container mt-4">
  <div class="hero text-center">
    <h1 class="display-4 fw-bold">Welcome to the Library Management System</h1>
    <p class="lead">Efficiently manage books, members, and borrowing records.</p>
    <a href="book_form.php" class="btn btn-primary btn-lg mt-3">➕ Add Book</a>
    <a href="member_form.php" class="btn btn-success btn-lg mt-3">➕ Add Member</a>
  </div>
</div>

<!-- Stats Section -->
<div class="container mt-5">
  <div class="row g-4 text-center">
    <div class="col-md-6">
      <div class="card p-4 shadow">
        <h2>📚 <?= $total_books ?></h2>
        <p>Total Books</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 shadow">
        <h2>👥 <?= $total_members ?></h2>
        <p>Total Members</p>
      </div>
    </div>
  </div>
</div>

<!-- Features Section -->
<div class="container mt-5">
  <h2 class="text-center mb-4">✨ Key Features</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h4>📚 Book Management</h4>
        <p>Add, update, delete, and search books in the library.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h4>👥 Member Management</h4>
        <p>Register, update, and track members efficiently.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 text-center">
        <h4>📖 Borrowing System</h4>
        <p>Track issued & returned books with due dates.</p>
      </div>
    </div>
  </div>
</div>

<!-- Call to Action -->
<div class="container mt-5">
  <div class="cta text-center">
    <h2>🚀 Ready to Manage Your Library?</h2>
    <p class="mb-4">Start adding books or registering members now.</p>
    <a href="book_form.php" class="btn btn-light btn-lg me-2">➕ Add Book</a>
    <a href="member_form.php" class="btn btn-success btn-lg me-2">➕ Add Member</a>
  </div>
</div>

<!-- Footer -->
<footer class="text-center mt-5 py-3 bg-dark text-white">
  Library Management System © <?= date("Y") ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
