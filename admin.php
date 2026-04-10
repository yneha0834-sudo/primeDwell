<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['role']) || $_SESSION['role']!='admin'){
header("Location: login.php");
exit();
}

/* AJAX RESOLVE */
if(isset($_POST['resolve_id'])){
$id = intval($_POST['resolve_id']);
$conn->query("UPDATE tenant_requests SET status='responded' WHERE id=$id");
echo "success";
exit();
}

/* DELETE USER */
if(isset($_GET['delete_user'])){
$id=$_GET['delete_user'];
$conn->query("DELETE FROM users WHERE id=$id");
header("Location: admin.php");
exit();
}

/* DELETE PROPERTY */
if(isset($_GET['delete_property'])){
$id=$_GET['delete_property'];
$conn->query("DELETE FROM properties WHERE id=$id");
header("Location: admin.php");
exit();
}

/* COUNTS */
$total_users = $conn->query("SELECT * FROM users")->num_rows;
$total_owners = $conn->query("SELECT * FROM users WHERE role='owner'")->num_rows;
$total_properties = $conn->query("SELECT * FROM properties")->num_rows;
$total_contacts = $conn->query("SELECT * FROM tenant_requests WHERE request_type='general'")->num_rows;

/* DATA */
$users = $conn->query("SELECT * FROM users");
$properties = $conn->query("SELECT * FROM properties");
$requests = $conn->query("SELECT * FROM tenant_requests WHERE request_type='general'");

/* OWNER SUMMARY */
$owner_properties = $conn->query("
SELECT users.name, COUNT(properties.id) as total_properties
FROM users
LEFT JOIN properties ON users.id = properties.owner_id
WHERE users.role='owner'
GROUP BY users.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body{margin:0;font-family:Arial;background:#f1f5f9;display:flex;}

.sidebar{
width:240px;background:#111827;color:white;height:100vh;padding:20px;position:fixed;
}
.sidebar a{
display:block;color:#d1d5db;padding:10px;text-decoration:none;border-radius:6px;
}
.sidebar a:hover{background:#374151;color:white;}

.main{margin-left:260px;padding:25px;width:100%;}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:20px;margin-bottom:25px;
}
.card{
background:white;padding:20px;border-radius:12px;
box-shadow:0 4px 12px rgba(0,0,0,0.1);
text-align:center;
}

table{
width:100%;border-collapse:collapse;background:white;
margin-bottom:30px;border-radius:10px;overflow:hidden;
}
th,td{padding:10px;border-bottom:1px solid #ddd;}
th{background:#2563eb;color:white;}

.btn{
padding:5px 10px;border-radius:5px;color:white;text-decoration:none;border:none;cursor:pointer;
}
.delete{background:red;}
.resolve{background:green;}
.view{background:#3b82f6;}

.badge{
padding:4px 8px;border-radius:6px;color:white;
}
.pending{background:orange;}
.done{background:green;}
</style>

</head>

<body>

<div class="sidebar">
<h2>PrimeDwell</h2>
<a href="#">Dashboard</a>
<a href="#owners">Owner Summary</a>
<a href="#users">Users</a>
<a href="#properties">Properties</a>
<a href="#contacts">Contacts</a>
<a href="logout.php">Logout</a>
</div>

<div class="main">

<h2>Admin Dashboard</h2>

<!-- CARDS -->
<div class="cards">
<div class="card"><h3>Users</h3><p><?php echo $total_users; ?></p></div>
<div class="card"><h3>Owners</h3><p><?php echo $total_owners; ?></p></div>
<div class="card"><h3>Properties</h3><p><?php echo $total_properties; ?></p></div>
<div class="card"><h3>Contacts</h3><p><?php echo $total_contacts; ?></p></div>
</div>

<!-- OWNER SUMMARY -->
<h3 id="owners">Owner Property Summary</h3>
<table>
<tr><th>Owner</th><th>Total Properties</th></tr>
<?php while($o=$owner_properties->fetch_assoc()){ ?>
<tr>
<td><?php echo $o['name']; ?></td>
<td><?php echo $o['total_properties']; ?></td>
</tr>
<?php } ?>
</table>

<!-- USERS -->
<h3 id="users">Users</h3>
<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
<?php while($u=$users->fetch_assoc()){ ?>
<tr>
<td><?php echo $u['id']; ?></td>
<td><?php echo $u['name']; ?></td>
<td><?php echo $u['email']; ?></td>
<td><?php echo $u['role']; ?></td>
<td>
<a class="btn delete" href="?delete_user=<?php echo $u['id']; ?>" onclick="return confirm('Delete user?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<!-- PROPERTIES -->
<h3 id="properties">Properties</h3>
<table>
<tr><th>ID</th><th>Image</th><th>Title</th><th>Location</th><th>Rent</th><th>Action</th></tr>
<?php while($p=$properties->fetch_assoc()){ ?>
<tr>
<td><?php echo $p['id']; ?></td>
<td>
<img src="/website/uploads/<?php echo $p['image']; ?>" width="80" style="border-radius:6px;">
</td>
<td><?php echo $p['title']; ?></td>
<td><?php echo $p['location']; ?></td>
<td>₹<?php echo $p['rent']; ?></td>
<td>
<a class="btn delete" href="?delete_property=<?php echo $p['id']; ?>" onclick="return confirm('Delete property?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<!-- CONTACT -->
<h3 id="contacts">Contact Requests</h3>
<table>
<tr>
<th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Status</th><th>Action</th>
</tr>

<?php while($r=$requests->fetch_assoc()){ ?>
<tr>

<td><?php echo $r['tenant_name']; ?></td>
<td><?php echo $r['tenant_email']; ?></td>
<td><?php echo $r['tenant_phone']; ?></td>

<td>
<?php echo substr($r['message'],0,25); ?>...
<button class="btn view" onclick="alert('<?php echo addslashes($r['message']); ?>')">View</button>
</td>

<td>
<span class="badge <?php echo ($r['status']=='responded')?'done':'pending'; ?>">
<?php echo $r['status']; ?>
</span>
</td>

<td>
<button class="btn resolve" onclick="resolveRequest(<?php echo $r['id']; ?>, this)">Resolve</button>
</td>

</tr>
<?php } ?>

</table>

</div>

<script>
function resolveRequest(id, btn){
fetch('admin.php', {
method: 'POST',
headers: {'Content-Type': 'application/x-www-form-urlencoded'},
body: 'resolve_id=' + id
})
.then(res => res.text())
.then(data => {
if(data.trim() == "success"){
btn.parentElement.previousElementSibling.innerHTML = "<span class='badge done'>responded</span>";
}
});
}
</script>

</body>
</html>