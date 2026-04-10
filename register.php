<?php
include("db_connect.php");

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $conn->query("INSERT INTO users(name,email,password,role)
                  VALUES('$name','$email','$password','$role')");
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(120deg,#4e73df,#1cc88a);
    font-family:Arial;
}
.box{
    background:#fff;
    width:350px;
    padding:30px;
    border-radius:10px;
    box-shadow:0 15px 25px rgba(0,0,0,0.3);
}
.box h2{
    text-align:center;
    margin-bottom:20px;
}
.box input, .box select{
    width:100%;
    padding:10px;
    margin:10px 0;
}
.box button{
    width:100%;
    padding:10px;
    background:#1cc88a;
    border:none;
    color:white;
    font-size:16px;
    cursor:pointer;
    border-radius:5px;
}
.box button:hover{
    background:#17a673;
}
.box a{
    display:block;
    text-align:center;
    margin-top:10px;
    text-decoration:none;
    color:#555;
}
</style>

</head>
<body>

<div class="box">
<h2>Register</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="role" required>
        <option value="">Select Role</option>
        <option value="owner">Owner</option>
        <option value="tenant">Tenant</option>
    </select>

    <button name="register">Register</button>
</form>

<a href="login.php">Already have account? Login</a>
</div>

</body>
</html>
