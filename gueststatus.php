<?php
include "connect.php";
$id=$_GET['id'];
$status=$_GET['status'];
$sql="update guest set status='$status' where id=$id";
if($con->query($sql)){
    header('location:guestindex.php');
}else{
    echo "query not run";
}

?>