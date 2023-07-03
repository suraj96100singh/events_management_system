
<?php
session_start();
if(isset($_SESSION["password"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<?php include "header.php";
include 'connect.php';
?>

<div class="container-fluid mt-2" style="border:1px solid">
    <div class="alert alert-primary text-center h4">
        List Of Registered User
        <div style="text-align:right">
            <a href="guestcreate.php" class="btn btn-primary">Register Guest</a>
    </div>
   
    </div>
    <div>
    <?php
    $sql="select * from guest where 1 order by id desc";
    $rs=$con->query($sql);
    $data=$rs->fetch_all(1);
    ?>
    <div>
    <div class="table-responsive" >

    <table class="table table-striped guest_table" style="table-layout: fixed">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Guest Name</th>
                <th>Mobile Number</th>
                <th>State</th>
                <th>City</th>
                <th>Guest Type</th>
                <th>Residence Address</th>
                <th>Room Alloted</th>
                <th>Current Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if($data){
                $index=0;
                foreach($data as $info){
                    ?>
                    <tr>
                        <td><?=++$index?></td>
                        <td><?=($info['gname'])? $info['gname']:
                        'N/A'?></td>
                        <td><?=($info['number'])? $info['number']:
                        'N/A'?></td>
                        <td><?=($info['state'])? $info['state']:
                        'N/A'?></td>
                        <td><?=($info['city'])? $info['city']:
                        'N/A'?></td>
                        <td><?=($info['guesttype'])? $info['guesttype']:
                        'N/A'?></td>
                        

                        <td><?=($info['residence'])? $info['residence']:
                        'N/A'?></td>
                        <td><?=($info['roomreq'])? $info['roomreq']:
                        'N/A'?></td>
                        <td><?php
                        if($info['status']=='Active'){
                            echo '<p><a href="gueststatus.php?id='.$info['id'].'&status=Inactive" class="btn btn-success">Active</a></p>';
                        }else{
                            echo '<p><a href="gueststatus.php?id='.$info['id'].'&status=Active" class="btn btn-danger">Inactive</a></p>';
                        }
                        ?>
                        </td>
                        <td><a href="guestedit.php?id=<?=$info['id'];?>" class="btn btn-primary">Edit</a>
                        <a href=# onclick="delme('guestdelete.php?id=<?=$info['id'];?>')" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                <?php
            }else{
                ?>
                <tr>
                    <td colspan="10" class="text-danger text-center">Record Not Found</td>
                </tr>
                <?php

            }
            ?> 
           
        </tbody>
        
    </table>
    </div>
    </div>
</div>
<?php

    ?>
<script>



    function delme(path){
        if(confirm('Do You Really Want to Delete')){
            location.href=path;
        }
    }
</script>
<?php
}else{
    header('location:login.php');
}

?>
</body>
</html>
