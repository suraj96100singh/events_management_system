<?php
include "connect.php";
$id=$_GET['id'];
$flore= $_POST['floreno'][0];
$room= $_POST['roomno'][0];
$romcat= $_POST['roomcategory'][0];

$sql="update hotel set hname='$_POST[hname]',flore='$flore',room='$room',roomcat='$romcat' where hotel_id=$id";


$con->query($sql);

$a=count($_POST['floreno']);
for($i=1;$i<$a;$i++){
    $flore= $_POST['floreno'][$i];
    $room= $_POST['roomno'][$i];
    $romcat= $_POST['roomcategory'][$i];
    $sql="insert into hotel(hname,flore,room,roomcat)values('$_POST[hname]','$flore','$room','$romcat')";
    $con->query($sql);
    
}

header('Location:hotelindex.php');


$con->close();
?>