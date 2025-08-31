<?php
include 'config.php';

// Search query
$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Total entries
$total_sql = "SELECT COUNT(*) as total FROM members 
              WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
$total_result = $conn->query($total_sql);
$total_entries = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_entries / $limit);

// Fetch records
$sql = "SELECT * FROM members 
        WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' 
        LIMIT $start, $limit";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Members List - Library Management</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body { background: #f8f9fa; }
.navbar { box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
h2 { margin-bottom: 30px; }
.table-hover tbody tr:hover { background-color: #e9f5ff; transition: 0.2s; }
.card-table { border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
.search-form input { max-width: 350px; }
.pagination .page-item.active .page-link { background-color: #0d6efd; border-color: #0d6efd; }
.footer {
    background: #343a40; color: #fff; padding: 30px 20px; margin-top: 50px;
    text-align: center; border-radius: 12px 12px 0 0;
}
.footer .social-icons a { color: #fff; margin: 0 8px; font-size: 18px; transition: color 0.3s; }
.footer .social-icons a:hover { color: #0d6efd; }
.action-btns a { margin-right: 5px; transition: transform 0.2s; }
.action-btns a:hover { transform: scale(1.05); }
</style>
</head>
<body>

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


<!-- Members List -->
<div class="container mt-5">
    <h2 class="text-center">👥 Members List</h2>

    <!-- Search -->
    <form method="GET" class="d-flex mb-4 justify-content-center search-form">
        <input type="text" name="search" class="form-control me-2" placeholder="Search members..." value="<?= htmlspecialchars($search) ?>">
        <button class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
    </form>

    <div class="card card-table p-3">
    <table class="table table-hover align-middle mb-0 text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Type</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) { 
                while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['type']) ?></td>
                    <td class="action-btns">
                        <a href="update_member.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                        <a href="delete_member.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php } } else { ?>
                <tr><td colspan="6" class="text-center">No records found</td></tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

    <!-- Pagination -->
    <nav class="mt-4 d-flex justify-content-center">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<!-- Footer -->
<div class="footer">
    <p>Library Management System © <?= date("Y") ?> | Developed by Ifna Thasleem</p>
    <div class="social-icons mt-2">
        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white me-2"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
