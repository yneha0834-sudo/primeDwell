<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['role']) || $_SESSION['role']!='tenant'){
header("Location: login.php");
exit();
}

$tenant_name=$_SESSION['name'];
$tenant_email=$_SESSION['email'];

$property_id=$_GET['property_id'];
$owner_id=$_GET['owner_id'];

if(isset($_POST['send'])){

$phone=$_POST['phone'];
$message=$_POST['message'];

$stmt=$conn->prepare("INSERT INTO tenant_requests
(owner_id,property_id,tenant_name,tenant_email,tenant_phone,message)
VALUES (?,?,?,?,?,?)");

$stmt->bind_param("iissss",$owner_id,$property_id,$tenant_name,$tenant_email,$phone,$message);

$stmt->execute();

echo "<script>alert('Request Sent Successfully'); window.location='tenant.php';</script>";

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Send Request</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
}

.container{
width:400px;
margin:80px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

input,textarea{
width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
}

button{
width:100%;
padding:12px;
background:#1cc88a;
border:none;
color:white;
border-radius:6px;
cursor:pointer;
}

button:hover{
background:#17a673;
}

</style>

</head>

<body>

<div class="container">

<h3>Send Request to Owner</h3>

<form method="POST">

<input type="text" name="phone" placeholder="Phone Number" required>

<textarea name="message" placeholder="Write message to owner" required></textarea>

<button name="send">Send Request</button>

</form>

</div>

</body>
</html>