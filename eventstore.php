<?php
include "connect.php";
if(isset($_POST['eventbtn'])){
$sql="insert into events(event_name,event_date)values('$_POST[eventname]','$_POST[eventdate]')";
if($con->query($sql)){
 header('location:event.php');
}
$con->close();
}
if(isset($_POST['bookingbtn'])){
    $sql="insert into booking(booking_name,booking_qty,event_name,event_type)values('$_POST[bookingname]','$_POST[bookingqty]','$_POST[event_name]','$_POST[local]')";
    if($con->query($sql)){
     header('location:event.php');
    }
    $con->close();
    }
if(isset($_POST['statusupdatebtn'])){
 if(count($_POST)>1){
    $id=$_GET['id'];
    $sql="update booking set done_by='$_POST[doneby]',main_person='$_POST[mainperson]',main_person_contact='$_POST[mainpersoncontact]' where booking_id=$id";
    if($con->query($sql)){
        header('location:event.php');
       }
       $con->close();
       }else{
        header('location:event.php');
       }


 }
$delete=$_GET['delete_id'];

 if($delete){
    $sql="delete from booking where booking_id='$delete'";
if($con->query($sql)){
    header('location:event.php');
}


    }


?>