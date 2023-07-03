<?php
// print_r($_POST);
include "connect.php";
$id=$_POST['guest_id'];
// print_r($_POST);
// exit;

if(isset($_POST['invitationadd'])){
$sql="update guest set onlinestatus='$_POST[check]',updatebtn='$_POST[invitationadd]' where id=$id";
if($con->query($sql)){
    header('location:invite.php');
}
}
                                     

?>