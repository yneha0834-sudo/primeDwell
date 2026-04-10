<?php
session_start();
include("db_connect.php");

$error="";

if(isset($_POST['login'])){

$email=trim($_POST['email']);
$password=trim($_POST['password']);

if($email=="" || $password==""){
$error="Please fill all fields";
}
else{

$stmt=$conn->prepare("SELECT id,name,email,password,role FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows==1){

$row=$result->fetch_assoc();

/* PASSWORD CHECK */

if(password_verify($password,$row['password']) || $password==$row['password']){

$_SESSION['user_id']=$row['id'];
$_SESSION['name']=$row['name'];
$_SESSION['email']=$row['email'];
$_SESSION['role']=$row['role'];

/* ROLE REDIRECT */

if($row['role']=="admin"){

header("Location: admin.php");
exit();

}

elseif($row['role']=="owner"){

header("Location: owner.php");
exit();

}

elseif($row['role']=="tenant"){

header("Location: tenant.php");
exit();

}

else{

$error="Invalid role";

}

}
else{

$error="Invalid Password";

}

}
else{

$error="Email not found";

}

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>PrimeDwell Login</title>

<style>

*{
box-sizing:border-box;
}

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#4e73df,#1cc88a);
}

/* LOGIN BOX */

.login-box{
background:white;
width:360px;
padding:35px;
border-radius:12px;
box-shadow:0 15px 35px rgba(0,0,0,0.3);
animation:fadeIn 0.8s ease;
}

.login-box h2{
text-align:center;
margin-bottom:25px;
color:#333;
}

/* INPUT */

.login-box input{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:6px;
font-size:14px;
transition:0.2s;
}

.login-box input:focus{
border-color:#4e73df;
outline:none;
}

/* BUTTON */

.login-box button{
width:100%;
padding:12px;
background:#4e73df;
border:none;
color:white;
font-size:16px;
border-radius:6px;
cursor:pointer;
transition:0.3s;
}

.login-box button:hover{
background:#2e59d9;
}

/* ERROR */

.error{
color:red;
text-align:center;
margin-bottom:10px;
font-size:14px;
}

/* REGISTER LINK */

.register-link{
text-align:center;
margin-top:15px;
}

.register-link a{
text-decoration:none;
color:#4e73df;
font-weight:bold;
}

.register-link a:hover{
text-decoration:underline;
}

/* ANIMATION */

@keyframes fadeIn{
from{
opacity:0;
transform:translateY(-20px);
}
to{
opacity:1;
transform:translateY(0);
}
}

</style>

</head>

<body>

<div class="login-box">

<h2>PrimeDwell Login</h2>

<?php if($error!=""){ echo "<p class='error'>$error</p>"; } ?>

<form method="POST">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

<div class="register-link">
<p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</div>

</body>
</html>