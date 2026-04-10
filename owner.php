<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['role']) || $_SESSION['role']!='owner'){
header("Location: login.php");
exit();
}

$owner_id=$_SESSION['user_id'];
$owner_name=$_SESSION['name'];

/* UNREAD MESSAGES */

$stmt=$conn->prepare("
SELECT COUNT(*) as total
FROM messages
WHERE receiver_id=? AND seen=0
");

$stmt->bind_param("i",$owner_id);
$stmt->execute();
$result=$stmt->get_result();
$msg_count=$result->fetch_assoc()['total'];


/* OWNER REPLY */

if(isset($_POST['reply'])){

$request_id=$_POST['request_id'];
$response=$_POST['response'];

$stmt=$conn->prepare("
UPDATE tenant_requests 
SET owner_response=?, status='responded' 
WHERE id=?
");

$stmt->bind_param("si",$response,$request_id);
$stmt->execute();
}


/* FETCH TENANT REQUESTS */

$stmt=$conn->prepare("
SELECT tr.*, u.id as tenant_id
FROM tenant_requests tr
JOIN users u ON tr.tenant_email=u.email
WHERE tr.owner_id=?
ORDER BY tr.created_at DESC
");

$stmt->bind_param("i",$owner_id);
$stmt->execute();
$requests=$stmt->get_result();


/* FETCH PROPERTIES */

$stmt=$conn->prepare("
SELECT * FROM properties
WHERE owner_id=?
");

$stmt->bind_param("i",$owner_id);
$stmt->execute();
$properties=$stmt->get_result();

$total_properties=$properties->num_rows;
$total_requests=$requests->num_rows;

?>

<!DOCTYPE html>
<html>
<head>

<title>Owner Dashboard</title>

<style>

*{
box-sizing:border-box;
}

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
display:flex;
}

/* Sidebar */

.sidebar{
width:240px;
background:#1f2937;
height:100vh;
color:white;
padding:20px;
position:fixed;
}

.sidebar h2{
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:12px;
margin:8px 0;
border-radius:6px;
transition:0.3s;
}

.sidebar a:hover{
background:#374151;
}

/* Main */

.main{
margin-left:260px;
padding:30px;
width:100%;
}

/* Topbar */

.topbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.logout{
background:#ef4444;
color:white;
padding:8px 15px;
border-radius:6px;
text-decoration:none;
}

/* Cards */

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
text-align:center;
transition:0.2s;
}

.card:hover{
transform:translateY(-3px);
}

.card h3{
margin:0;
color:#555;
}

.card p{
font-size:26px;
font-weight:bold;
margin-top:10px;
}

/* Property Slider */

.property-slider{
display:flex;
overflow-x:auto;
gap:20px;
padding-bottom:10px;
}

.property-card{
min-width:260px;
background:white;
border-radius:10px;
padding:15px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
transition:0.2s;
}

.property-card:hover{
transform:scale(1.03);
}

.property-card img{
width:100%;
height:170px;
object-fit:cover;
border-radius:8px;
margin-bottom:10px;
}

/* Table */

table{
width:100%;
border-collapse:collapse;
margin-top:25px;
background:white;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
border-radius:10px;
overflow:hidden;
}

th,td{
padding:12px;
border-bottom:1px solid #ddd;
}

th{
background:#4e73df;
color:white;
text-align:left;
}

/* Buttons */

button{
padding:7px 12px;
background:#10b981;
border:none;
color:white;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#059669;
}

.chat-btn{
background:#3b82f6;
padding:7px 12px;
border-radius:5px;
color:white;
text-decoration:none;
}

.chat-btn:hover{
background:#2563eb;
}

/* Responsive */

@media(max-width:900px){

.sidebar{
display:none;
}

.main{
margin-left:0;
}

}

</style>

</head>

<body>

<div class="sidebar">

<h2>PrimeDwell</h2>

<a href="#">Dashboard</a>

<a href="add_property.php">Add Property</a>

<a href="#properties">My Properties</a>

<a href="#requests">Tenant Requests</a>

<a href="messages.php">
Messages (<?php echo $msg_count; ?>)
</a>

<a href="logout.php">Logout</a>

</div>


<div class="main">

<div class="topbar">

<h2>Welcome <?php echo $owner_name; ?></h2>

<a class="logout" href="logout.php">Logout</a>

</div>


<!-- Dashboard Cards -->

<div class="cards">

<div class="card">
<h3>Total Properties</h3>
<p><?php echo $total_properties; ?></p>
</div>

<div class="card">
<h3>Tenant Requests</h3>
<p><?php echo $total_requests; ?></p>
</div>

<div class="card">
<h3>Unread Messages</h3>
<p><?php echo $msg_count; ?></p>
</div>

</div>


<!-- Properties -->

<h3 id="properties">Your Properties</h3>

<div class="property-slider">

<?php while($p=$properties->fetch_assoc()){ ?>

<div class="property-card">

<img src="uploads/<?php echo $p['image']; ?>">

<h4><?php echo $p['title']; ?></h4>

<p><b>Location:</b> <?php echo $p['location']; ?></p>

<p><b>BHK:</b> <?php echo $p['bhk']; ?></p>

<p><b>Rent:</b> ₹<?php echo $p['rent']; ?></p>

</div>

<?php } ?>

</div>


<!-- Tenant Requests -->

<h3 id="requests">Tenant Requests</h3>

<table>

<tr>
<th>Property</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Message</th>
<th>Reply</th>
<th>Chat</th>
</tr>

<?php while($row=$requests->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['property_id']; ?></td>
<td><?php echo $row['tenant_name']; ?></td>
<td><?php echo $row['tenant_email']; ?></td>
<td><?php echo $row['tenant_phone']; ?></td>
<td><?php echo $row['message']; ?></td>

<td>

<?php if($row['status']=="pending"){ ?>

<form method="POST">

<input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">

<input type="text" name="response" required>

<button name="reply">Send</button>

</form>

<?php } else{

echo "<b>".$row['owner_response']."</b>";

} ?>

</td>

<td>

<a class="chat-btn" href="chat.php?user=<?php echo $row['tenant_id']; ?>">
Chat
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>