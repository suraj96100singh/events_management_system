<?php

include "connect.php";
$a=count($_POST['rooms']);
$b =$_POST['rooms'];


for($i=0;$i<$a;$i++){
    $sql="update hotel set alloted_id='$_POST[allotedgname]' WHERE hotel_id='$b[$i]'";
   
    if($con->query($sql)){
        // header('location:roomallotment.php');
    }
    

}

$a=$_POST['rooms'];

$b=implode(',',$a);

$sqls="update guest set room_qty ='$_POST[bookingqty]',hotelname ='$_POST[hotelname]',roomqulity ='$_POST[roomquality]',selectedRoomno ='$b',checkin ='$_POST[checkin]',checkout ='$_POST[Checkout]',remarks ='$_POST[remarks]' WHERE id='$_POST[allotedgname]'";

if($con->query($sqls)){
    header('location:roomallotment2.php');
}

?> 