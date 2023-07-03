<?php
include "connect.php";
$id=$_GET['id'];
$sql="delete from hotel where hotel_id=$id";
if($con->query($sql)){
    header('location:hotelindex.php');
}
$con->close();

?>