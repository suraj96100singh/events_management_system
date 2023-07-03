<?php

include "connect.php";
$id=$_GET['id'];
if(isset($_POST['checkstatus'])){
    $sql="update guest set checkin='$_POST[checkin]',checkout='$_POST[checkout]',remarks='$_POST[remarks]' where id='$id'";


    if($con->query($sql)){
        header('location:roomallotment2.php');

    }
}else{
    header('location:roomallotment2.php');
}



//     }
?>