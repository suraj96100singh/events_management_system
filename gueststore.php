<?php

include "connect.php";
if(isset($_POST['status'])){
    $sql="insert into guest(gname,number,state,city,guesttype,status,residence,roomreq)values('$_POST[gname]','$_POST[number]','$_POST[state]','$_POST[city]','$_POST[guesttype]','$_POST[status]','$_POST[residence]','$_POST[roomreq]')";
    if($con->query($sql)){
        header('location:guestindex.php');
    }
    $con->close();
}else{
    $_POST['status']='Inactive';
    $s="select * from guest where number='$_POST[number]'";
    $rs=$con->query($s);
    $result=$rs->fetch_all();
    
    if(count($result)<=0){
        $sql="insert into guest(gname,number,state,city,guesttype,residence,roomreq)values('$_POST[gname]','$_POST[number]','$_POST[state]','$_POST[city]','$_POST[guesttype]','$_POST[residence]','$_POST[roomreq]')";
        if($con->query($sql)){
            header('location:guestindex.php');
        }
        $con->close();
    }else{
       ?>
     <script>
        alert("Duplicate Number Not Allowed");
        window.location.href="guestcreate.php";
     </script>
     <?php
    }
   
}


?>