<?php

session_start();
if(isset($_SESSION["password"])){


if($_POST['callgname'] && $_POST['calldoneby']  && $_POST['datecall']){
include "connect.php";
$sql="insert into call_log(guest_call_id,calldoneby,remarks,datecall)values('$_POST[callgname]','$_POST[calldoneby]','$_POST[remarks]','$_POST[datecall]')";
if($con->query($sql)){
    header('location:calllogs.php');
}
}else{
    header('location:calllogs.php');
}
}else{
    header('location:login.php');
}
?>