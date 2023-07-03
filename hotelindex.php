<?php
session_start();
if(isset($_SESSION["password"])){
?>

<?php

        include "connect.php";
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php include "header.php";
?>
<div class="container-fluid mt-2">
    <div class="alert alert-primary text-center h4 border">
        List Of Registered Hotels
        <div style="text-align:right">
            <a href="hotelcreate2.php" class="btn btn-primary">Register Hotel</a>
    </div>
   
    </div>
    <div>
    <?php
    $sql="select * from hotel where 1 order by hotel_id desc";
    $rs=$con->query($sql);
    $data=$rs->fetch_all(1);
    ?>
    <div>
    <div class="table-responsive" style="height:600px">
    <table class="table table-striped guest_table">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Hotel Name</th>
                <th>Floor No</th>
                <th>Room No</th>
                <th>Room Category</th>
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
                        <td><?=($info['hname'])? $info['hname']:
                        'N/A'?></td>
                        <td><?=($info['flore'])? $info['flore']:
                        'N/A'?></td>
                        <td><?=($info['room'])? $info['room']:
                        'N/A'?></td>
                        <td><?=($info['roomcat'])? $info['roomcat']:
                        'N/A'?></td>
                       

                        <td><a href="hoteledit.php?id=<?=$info['hotel_id'];?>"  class="btn btn-success">Edit</a>
                        <a href=# onclick="delme('hoteldelete.php?id=<?=$info['hotel_id'];?>')" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    <?php
                }
                ?>
                <?php
            }else{
                ?>
                <tr>
                    <td colspan="4" class="text-danger text-center">Record Not Found</td>
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
