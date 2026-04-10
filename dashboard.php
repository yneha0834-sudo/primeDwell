<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body{font-family:Arial, sans-serif; margin:0; padding:0; background:#f4f6f9;}
        .dashboard{max-width:600px; margin:50px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 5px 20px rgba(0,0,0,0.2);}
        h2{color:#007bff;}
        a{display:block; padding:12px; margin:10px 0; text-decoration:none; background:#4e73df; color:#fff; border-radius:6px; font-weight:bold; text-align:center;}
        a:hover{background:#2e59d9;}
        .logout{background:#e74a3b;}
        .logout:hover{background:#c0392b;}
    </style>
</head>
<body>
<div class="dashboard">
    <h2>Welcome Admin</h2>
    <a href='show_property.php'>View All Properties</a>
    <a href='services.php'>Manage Services</a>
    <a href='logout.php' class="logout">Logout</a>
</div>
</body>
</html>