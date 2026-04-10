<?php
include("db_connect.php");

$id=$_GET['id'];

$conn->query("DELETE FROM properties WHERE id=$id");

header("Location: admin.php");
?>