<?php
include "connect.php";
$a=count($_POST['floreno']);
for($i=0;$i<$a;$i++){
    $flore= $_POST['floreno'][$i];
    $room= $_POST['roomno'][$i];
    $romcat= $_POST['roomcategory'][$i];
    $sql="insert into hotel(hname,flore,room,roomcat)values('$_POST[hname]','$flore','$room','$romcat')";
    $con->query($sql);
    
}

header('location:hotelindex.php');
?>