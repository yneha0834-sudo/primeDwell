<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$user_id=$_SESSION['user_id'];

$sql="
SELECT 
u.id,
u.name,

(SELECT message 
FROM messages 
WHERE 
(sender_id=$user_id AND receiver_id=u.id)
OR
(sender_id=u.id AND receiver_id=$user_id)
ORDER BY created_at DESC
LIMIT 1) as last_message,

(SELECT COUNT(*) 
FROM messages 
WHERE sender_id=u.id 
AND receiver_id=$user_id 
AND seen=0) as unread

FROM users u

WHERE u.id IN(

SELECT sender_id FROM messages WHERE receiver_id=$user_id
UNION
SELECT receiver_id FROM messages WHERE sender_id=$user_id

)
AND u.id!=$user_id

ORDER BY unread DESC
";

$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>

<head>

<title>Messages</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.container{
width:650px;
margin:40px auto;
background:white;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.header{
padding:15px;
font-size:20px;
font-weight:bold;
border-bottom:1px solid #ddd;
}

.user{
display:flex;
justify-content:space-between;
padding:15px;
border-bottom:1px solid #eee;
cursor:pointer;
}

.user:hover{
background:#f1f1f1;
}

.name{
font-weight:bold;
}

.lastmsg{
color:#666;
font-size:14px;
}

.badge{
background:red;
color:white;
padding:3px 8px;
border-radius:20px;
font-size:12px;
}

a{
text-decoration:none;
color:black;
}

</style>

</head>

<body>

<div class="container">

<div class="header">Messages</div>

<?php 
if(mysqli_num_rows($result)==0){
echo "<p style='padding:20px;'>No conversations yet</p>";
}
?>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="user">

<div>

<a href="chat.php?user=<?php echo $row['id']; ?>">

<div class="name">
<?php echo $row['name']; ?>
</div>

<div class="lastmsg">
<?php echo $row['last_message']; ?>
</div>

</a>

</div>

<div>

<?php if($row['unread']>0){ ?>

<span class="badge">
<?php echo $row['unread']; ?>
</span>

<?php } ?>

</div>

</div>

<?php } ?>

</div>

</body>
</html>