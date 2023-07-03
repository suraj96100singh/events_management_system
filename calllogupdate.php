<?php
include "connect.php";
$id=$_GET['id'];
if(isset($_POST['checkstatus'])){
    $sql="update call_log set calldoneby='$_POST[calldoneby]',remarks='$_POST[remarks]',datecall='$_POST[datecall]' where id='$id'";
    if($con->query($sql)){
        header('location:calllogs.php');

    }
}else{
    header('location:calllogs.php');
}

// print_r($_GET);
// exit;

if(isset($_GET['delete_id'])){
    $delete=$_GET['delete_id'];

   
       $sql="delete from call_log where id='$delete'";
   if($con->query($sql)){
          header('location:calllogs.php');
   }
}
   
       
?>