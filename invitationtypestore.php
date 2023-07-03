
<?php

include "connect.php";

$sql="insert into invitation (guest_name,first_checkbox,second_checkbox,thrid_checkbox,member_count_first,member_count_second,member_count_third,guest_id)
values('$_POST[gname]','$_POST[check_first]','$_POST[check_second]','$_POST[check_third]','$_POST[first]','$_POST[second]','$_POST[third]','$_POST[guest_id]')";
if($con->query($sql)){
    header('location:invitationtypecreate.php');
}
?>
