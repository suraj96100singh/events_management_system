
<?php
session_start();
if(isset($_SESSION["password"])){


$id=$_GET['id'];
include "connect.php";
$sql="delete from guest where id=$id";
if($con->query($sql)){
    header('location:guestindex.php');
}
$con->close();
}else{

        header('location:login.php');

}
?>
