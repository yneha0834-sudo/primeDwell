<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$sender=$_SESSION['user_id'];

if(!isset($_GET['user'])){
die("User not selected");
}

$receiver=$_GET['user'];

/* UPDATE USER LAST ACTIVE */

mysqli_query($conn,"
UPDATE users 
SET last_active = NOW() 
WHERE id = $sender
");

/* MARK MESSAGES AS SEEN */

$stmt=$conn->prepare("
UPDATE messages
SET seen=1
WHERE sender_id=? AND receiver_id=?
");

$stmt->bind_param("ii",$receiver,$sender);
$stmt->execute();

/* GET RECEIVER INFO */

$stmt=$conn->prepare("
SELECT name,profile_pic,last_active 
FROM users 
WHERE id=?
");

$stmt->bind_param("i",$receiver);
$stmt->execute();

$res=$stmt->get_result();
$user=$res->fetch_assoc();

$receiver_name=$user['name'];
$profile=$user['profile_pic'];

/* ONLINE / OFFLINE */

$last_active=strtotime($user['last_active']);

if(time()-$last_active<60){
$status="🟢 Online";
}else{
$status="⚫ Offline";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>PrimeDwell Chat</title>

<style>

body{
margin:0;
font-family:Arial;
background:#ece5dd;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

/* CHAT BOX */

.chat-box{
width:420px;
background:white;
border-radius:12px;
display:flex;
flex-direction:column;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
overflow:hidden;
}

/* HEADER */

.chat-header{
background:#075e54;
color:white;
padding:10px;
display:flex;
align-items:center;
gap:10px;
}

.avatar{
width:40px;
height:40px;
border-radius:50%;
object-fit:cover;
}

.status{
font-size:12px;
opacity:0.8;
}

/* MESSAGES */

.messages{
height:380px;
overflow-y:auto;
padding:15px;
background:#e5ddd5;
display:flex;
flex-direction:column;
gap:8px;
}

/* BUBBLES */

.msg{
max-width:55%;
padding:10px 14px;
border-radius:10px;
font-size:14px;
word-wrap:break-word;
}

.sender{
align-self:flex-end;
background:#dcf8c6;
}

.receiver{
align-self:flex-start;
background:white;
border:1px solid #ddd;
}

.time{
font-size:11px;
color:#555;
display:block;
margin-top:4px;
text-align:right;
}

/* INPUT */

.chat-input{
display:flex;
border-top:1px solid #ddd;
}

.chat-input input{
flex:1;
border:none;
padding:12px;
font-size:14px;
outline:none;
}

.chat-input button{
background:#075e54;
border:none;
color:white;
padding:12px 20px;
cursor:pointer;
}

#typing{
font-size:12px;
color:gray;
padding:5px 10px;
}

</style>
</head>

<body>

<div class="chat-box">

<div class="chat-header">

<img src="uploads/<?php echo $profile; ?>" class="avatar">

<div>
<div><?php echo $receiver_name; ?></div>
<div class="status"><?php echo $status; ?></div>
</div>

</div>

<div class="messages" id="messages"></div>

<div id="typing"></div>

<form id="chatForm" class="chat-input">

<input type="text"
name="message"
id="message"
placeholder="Type message..."
autocomplete="off">

<input type="hidden"
name="receiver"
value="<?php echo $receiver; ?>">

<button type="submit">Send</button>

</form>

</div>

<script>

const chat=document.getElementById("messages")

function isUserNearBottom(){

return chat.scrollHeight - chat.scrollTop <= chat.clientHeight + 50

}

function loadMessages(){

let shouldScroll=isUserNearBottom()

fetch("fetch_messages.php?user=<?php echo $receiver; ?>")
.then(res=>res.text())
.then(data=>{

chat.innerHTML=data

if(shouldScroll){

chat.scrollTo({
top:chat.scrollHeight,
behavior:"smooth"
})

}

})

}

loadMessages()

setInterval(loadMessages,2000)

/* SEND MESSAGE */

document.getElementById("chatForm").onsubmit=function(e){

e.preventDefault()

fetch("send_message.php",{
method:"POST",
body:new FormData(this)
})

document.getElementById("message").value=""

}

/* ENTER SEND */

document.getElementById("message")
.addEventListener("keypress",function(e){

if(e.key==="Enter"){
e.preventDefault()
document.getElementById("chatForm").submit()
}

})

/* TYPING */

let typingTimer

document.getElementById("message")
.addEventListener("input",function(){

document.getElementById("typing").innerText="Typing..."

clearTimeout(typingTimer)

typingTimer=setTimeout(()=>{
document.getElementById("typing").innerText=""
},1500)

})

</script>

</body>
</html>