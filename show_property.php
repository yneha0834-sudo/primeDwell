<?php
session_start();

$conn = mysqli_connect("localhost","root","","primedwell");
if(!$conn){
die("Connection failed: ".mysqli_connect_error());
}

/* -------- SEND MESSAGE -------- */

if(isset($_POST['send_msg'])){

if(!isset($_SESSION['user_id'])){
echo "<script>alert('Please login to send message');window.location='login.php';</script>";
exit();
}

$sender = $_SESSION['user_id'];
$receiver = $_POST['receiver_id'];
$message = $_POST['message'];

$stmt=$conn->prepare("INSERT INTO messages(sender_id,receiver_id,message) VALUES(?,?,?)");
$stmt->bind_param("iis",$sender,$receiver,$message);
$stmt->execute();

echo "<script>alert('Message Sent');</script>";
}

/* -------- PROPERTY RATING -------- */

if(isset($_POST['rate_property'])){

if(!isset($_SESSION['user_id'])){
echo "<script>alert('Please login to rate property');window.location='login.php';</script>";
exit();
}

$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'];
$rating = $_POST['rating'];

$sql="INSERT INTO property_ratings(property_id,user_id,rating)
VALUES('$property_id','$user_id','$rating')";

mysqli_query($conn,$sql);

echo "<script>alert('Rating Submitted');</script>";
}

/* -------- SEARCH -------- */

$search="";
if(isset($_GET['location'])){
$search=mysqli_real_escape_string($conn,$_GET['location']);
}

$sql="SELECT * FROM properties WHERE 1";

if(!empty($search)){
$sql.=" AND (title LIKE '%$search%' 
OR location LIKE '%$search%' 
OR bhk LIKE '%$search%' 
OR rent LIKE '%$search%')";
}

$sql.=" ORDER BY id DESC";

$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>

<title>Available Properties</title>

<style>

body{
font-family:Arial;
margin:20px;
background:#f2f2f2;
}

h2{text-align:center;}

.property-container{
display:flex;
flex-wrap:wrap;
justify-content:center;
gap:20px;
}

.property-card{
background:#fff;
border-radius:10px;
box-shadow:0 2px 5px rgba(0,0,0,0.2);
width:300px;
padding:15px;
}

.property-card img{
width:100%;
height:200px;
object-fit:cover;
border-radius:10px;
}

.search-form{
text-align:center;
margin-bottom:30px;
}

.search-form input{
padding:8px;
width:300px;
border-radius:5px;
border:1px solid #ccc;
}

.search-form button{
padding:8px 15px;
background:#007bff;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

.contact-toggle-btn{
padding:8px;
border:none;
background:#007bff;
color:white;
border-radius:5px;
cursor:pointer;
margin-top:10px;
display:inline-block;
text-decoration:none;
}

.contact-form{
margin-top:10px;
display:flex;
flex-direction:column;
gap:8px;
border-top:1px solid #ccc;
padding-top:10px;
}

textarea{
padding:8px;
border-radius:5px;
border:1px solid #ccc;
}

.contact-btn{
padding:8px;
border:none;
background:#28a745;
color:white;
border-radius:5px;
cursor:pointer;
}

.rating-form{
margin-top:10px;
}

.rating-form select{
padding:5px;
border-radius:5px;
}

</style>

</head>

<body>

<h2>Available Properties</h2>

<div class="search-form">

<form method="GET">

<input type="text" name="location"
placeholder="Search location, rent, BHK..."
value="<?php echo htmlspecialchars($search); ?>">

<button type="submit">Search</button>

</form>

</div>

<div class="property-container">

<?php

if(mysqli_num_rows($result)>0){

while($row=mysqli_fetch_assoc($result)){

?>

<div class="property-card">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['title']; ?></h3>

<p><b>Location:</b> <?php echo $row['location']; ?></p>

<p><b>BHK:</b> <?php echo $row['bhk']; ?></p>

<p><b>Rent:</b> ₹<?php echo $row['rent']; ?></p>

<p><?php echo $row['description']; ?></p>

<?php

$pid=$row['id'];

$r=mysqli_query($conn,"SELECT AVG(rating) as avg_rating 
FROM property_ratings 
WHERE property_id='$pid'");

$rating=mysqli_fetch_assoc($r);

?>

<p>⭐ Rating: <?php echo round($rating['avg_rating'],1); ?>/5</p>

<?php if(isset($_SESSION['user_id'])){ ?>

<form method="POST" class="rating-form">

<input type="hidden" name="property_id"
value="<?php echo $row['id']; ?>">

<select name="rating" required>

<option value="">Rate Property</option>
<option value="1">⭐</option>
<option value="2">⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="5">⭐⭐⭐⭐⭐</option>

</select>

<button type="submit" name="rate_property">
Submit
</button>

</form>

<?php } else { ?>

<a href="login.php" class="contact-toggle-btn">
Login to Rate Property
</a>

<?php } ?>

<?php if(isset($_SESSION['user_id'])){ ?>

<button class="contact-toggle-btn"
onclick="toggleForm(<?php echo $row['id']; ?>)">
Contact Owner
</button>

<div id="contact-form-<?php echo $row['id']; ?>"
class="contact-form"
style="display:none;">

<form method="POST">

<input type="hidden"
name="receiver_id"
value="<?php echo $row['owner_id']; ?>">

<textarea name="message"
placeholder="Type your message..."
required></textarea>

<button type="submit"
name="send_msg"
class="contact-btn">
Send Message
</button>

</form>

</div>

<?php } else { ?>

<a href="login.php" class="contact-toggle-btn">
Login to Contact Owner
</a>

<?php } ?>

</div>

<?php

}

}else{

echo "<h3>No properties found</h3>";

}

?>

</div>

<script>

function toggleForm(id){

var formDiv=document.getElementById("contact-form-"+id);

if(formDiv.style.display==="none"){
formDiv.style.display="block";
}else{
formDiv.style.display="none";
}

}

</script>

</body>
</html>