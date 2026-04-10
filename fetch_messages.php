<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])){
exit();
}

$sender=$_SESSION['user_id'];
$receiver=$_GET['user'];

$stmt=$conn->prepare("
SELECT sender_id,message,created_at,seen
FROM messages
WHERE (sender_id=? AND receiver_id=?)
OR (sender_id=? AND receiver_id=?)
ORDER BY created_at ASC
");

$stmt->bind_param("iiii",$sender,$receiver,$receiver,$sender);
$stmt->execute();

$result=$stmt->get_result();

while($row=$result->fetch_assoc()){

$message=htmlspecialchars($row['message']);
$time=date("H:i",strtotime($row['created_at']));

if($row['sender_id']==$sender){

$seen=$row['seen'] ? "<span style='color:#4fc3f7'>✔✔</span>" : "✔";

echo "
<div class='msg sender'>
$message
<span class='time'>$time $seen</span>
</div>
";

}else{

echo "
<div class='msg receiver'>
$message
<span class='time'>$time</span>
</div>
";

}

}
?>