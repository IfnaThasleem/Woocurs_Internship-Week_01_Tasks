<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $type = $_POST['type'];

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($type)) {
        die("All fields are required!");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        die("Phone must be 10 digits!");
    }

    $sql = "INSERT INTO members (name, email, phone, type) 
            VALUES ('$name', '$email', '$phone', '$type')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Member registered successfully!'); window.location.href='view_members.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
