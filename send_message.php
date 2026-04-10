<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])){
exit();
}

$sender=$_SESSION['user_id'];

if(!isset($_POST['receiver']) || !isset($_POST['message'])){
exit();
}

$receiver=intval($_POST['receiver']);
$message=trim($_POST['message']);

if($message!=""){

$stmt=$conn->prepare("
INSERT INTO messages(sender_id,receiver_id,message,seen,created_at)
VALUES(?,?,?,0,NOW())
");

$stmt->bind_param("iis",$sender,$receiver,$message);
$stmt->execute();

}
?><?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])){
exit();
}

$sender=$_SESSION['user_id'];

if(!isset($_POST['receiver']) || !isset($_POST['message'])){
exit();
}

$receiver=intval($_POST['receiver']);
$message=trim($_POST['message']);

if($message!=""){

$stmt=$conn->prepare("
INSERT INTO messages(sender_id,receiver_id,message,seen,created_at)
VALUES(?,?,?,0,NOW())
");

$stmt->bind_param("iis",$sender,$receiver,$message);
$stmt->execute();

}
?><?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])){
exit();
}

$sender=$_SESSION['user_id'];

if(!isset($_POST['receiver']) || !isset($_POST['message'])){
exit();
}

$receiver=intval($_POST['receiver']);
$message=trim($_POST['message']);

if($message!=""){

$stmt=$conn->prepare("
INSERT INTO messages(sender_id,receiver_id,message,seen,created_at)
VALUES(?,?,?,0,NOW())
");

$stmt->bind_param("iis",$sender,$receiver,$message);
$stmt->execute();

}
?>