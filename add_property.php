<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "primedwell");

$owner_id = $_SESSION['user_id']; // login owner id

if(isset($_POST['submit'])){

$title = $_POST['title'];
$location = $_POST['location'];
$bhk = $_POST['bhk'];
$rent = $_POST['rent'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"uploads/".$image);

$sql="INSERT INTO properties (owner_id,title,location,bhk,rent,description,image)
VALUES ('$owner_id','$title','$location','$bhk','$rent','$description','$image')";

mysqli_query($conn,$sql);

echo "<script>alert('Property Added Successfully');</script>";

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Property</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
}

.container{
width:500px;
margin:50px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

input,textarea{
width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
}

button{
background:#4e73df;
color:white;
padding:10px;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2e59d9;
}

</style>

</head>

<body>

<div class="container">

<h2>Add Property</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" placeholder="Property Title" required>

<input type="text" name="location" placeholder="Location" required>

<input type="number" name="bhk" placeholder="BHK" required>

<input type="number" name="rent" placeholder="Rent" required>

<textarea name="description" placeholder="Description"></textarea>

<input type="file" name="image" required>

<button name="submit">Add Property</button>

</form>

</div>

</body>
</html>