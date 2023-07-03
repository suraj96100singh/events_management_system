<?php
$id=$_GET['id'];
// print_r($_POST);
// exit;
include "connect.php";
$sql="update guest set gname='$_POST[gname]',number='$_POST[number]',state='$_POST[state]',city='$_POST[city]',guesttype='$_POST[guesttype]',residence='$_POST[residence]',roomreq='$_POST[roomreq]' where id=$id";
if($con->query($sql)){
header('Location:guestindex.php');
}else{
    echo "query failed";
}
$con->close();



?>