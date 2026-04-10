<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['role']) || $_SESSION['role']!='tenant'){
header("Location: login.php");
exit();
}

$tenant_name=$_SESSION['name'];
$tenant_email=$_SESSION['email'];
$tenant_id=$_SESSION['user_id'];

/* UNREAD MESSAGE COUNT */

$stmt=$conn->prepare("
SELECT COUNT(*) as total
FROM messages
WHERE receiver_id=? AND seen=0
");

$stmt->bind_param("i",$tenant_id);
$stmt->execute();
$result=$stmt->get_result();
$msg_count=$result->fetch_assoc()['total'];

/* FETCH PROPERTIES */

$properties=$conn->query("SELECT * FROM properties");

/* FETCH REQUESTS */

$stmt=$conn->prepare("
SELECT * FROM tenant_requests 
WHERE tenant_email=? 
ORDER BY created_at DESC
");

$stmt->bind_param("s",$tenant_email);
$stmt->execute();
$requests=$stmt->get_result();

$total_properties=$properties->num_rows;
$total_requests=$requests->num_rows;

?>

<!DOCTYPE html>
<html>
<head>

<title>Tenant Dashboard</title>

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

/* Dashboard cards */

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
color:#111;
}

/* Property Slider */

.property-slider{
display:flex;
overflow-x:auto;
gap:20px;
padding-bottom:10px;
}

.property-slider::-webkit-scrollbar{
height:6px;
}

.property-slider::-webkit-scrollbar-thumb{
background:#ccc;
border-radius:10px;
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

/* Buttons */

.btn{
display:inline-block;
padding:8px 14px;
background:#10b981;
color:white;
border-radius:5px;
text-decoration:none;
margin-top:8px;
font-size:14px;
}

.btn:hover{
background:#059669;
}

.chatbtn{
background:#3b82f6;
}

.chatbtn:hover{
background:#2563eb;
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

<!-- Sidebar -->

<div class="sidebar">

<h2>PrimeDwell</h2>

<a href="#">Dashboard</a>

<a href="#properties">Browse Properties</a>

<a href="#requests">My Requests</a>

<a href="messages.php">
Messages (<?php echo $msg_count; ?>)
</a>

<a href="logout.php">Logout</a>

</div>

<!-- Main -->

<div class="main">

<div class="topbar">

<h2>Welcome <?php echo $tenant_name; ?></h2>

<a class="logout" href="logout.php">Logout</a>

</div>

<!-- Dashboard Cards -->

<div class="cards">

<div class="card">
<h3>Total Properties</h3>
<p><?php echo $total_properties; ?></p>
</div>

<div class="card">
<h3>Requests Sent</h3>
<p><?php echo $total_requests; ?></p>
</div>

<div class="card">
<h3>Unread Messages</h3>
<p><?php echo $msg_count; ?></p>
</div>

</div>

<!-- Properties -->

<h3 id="properties">Available Properties</h3>

<div class="property-slider">

<?php while($row=$properties->fetch_assoc()){ ?>

<div class="property-card">

<img src="uploads/<?php echo $row['image']; ?>">

<h4><?php echo $row['title']; ?></h4>

<p><b>Location:</b> <?php echo $row['location']; ?></p>

<p><b>BHK:</b> <?php echo $row['bhk']; ?></p>

<p><b>Rent:</b> ₹<?php echo $row['rent']; ?></p>

<a class="btn" href="send_request.php?property_id=<?php echo $row['id']; ?>&owner_id=<?php echo $row['owner_id']; ?>">
Send Request
</a>

<a class="btn chatbtn" href="chat.php?user=<?php echo $row['owner_id']; ?>">
Chat Owner
</a>

</div>

<?php } ?>

</div>

<!-- Requests -->

<h3 id="requests">Your Requests</h3>

<table>

<tr>
<th>Property</th>
<th>Message</th>
<th>Owner Reply</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php while($r=$requests->fetch_assoc()){ ?>

<tr>

<td><?php echo $r['property_id']; ?></td>
<td><?php echo $r['message']; ?></td>
<td><?php echo $r['owner_response']; ?></td>
<td><?php echo $r['status']; ?></td>
<td><?php echo $r['created_at']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>