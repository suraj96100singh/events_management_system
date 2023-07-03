<?php
session_start();
if(isset($_SESSION["password"])){
?>



<?php include "header.php";?>

<div class="container-fluid mt-2" style="border:1px solid">
    <div class="alert alert-primary text-center h4">
        Third Day Reports 
        <div style="text-align:right">
        
    </div>
   
    </div>
    <div>
    <?php
    include "connect.php";
    $sql="select id,gname,number,roomreq,thrid_checkbox from invitation join guest on invitation.guest_id=guest.id;";
    $rs=$con->query($sql);
    $data=$rs->fetch_all(1);
    ?>
    <div>
    <div class="table-responsive" style="height:600px">

    <table class="table table-striped guest_table" id="guest_table">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Guest Name</th>
                <th>Mobile Number</th>
                <th>Room Required</th>
                <th>Hotel Name</th>
                <th>Rooom No</th>
                
            </tr>
        </thead>
        <tbody>

            <?php
            if($data){
                $index=0;
                foreach($data as $info){
                    if($info['thrid_checkbox']=='on'){

                    
                    ?>
                    <tr>
                        
                        <td><?=++$index?></td>
                        <td><?=($info['gname'])? $info['gname']:
                        'N/A'?></td>
                        <td><?=($info['number'])? $info['number']:
                        'N/A'?></td>
                        <td><?=($info['roomreq'])? $info['roomreq']:
                        'N/A'?></td>
                        <?php
                        $sqlh="select distinct(hname),room from hotel where alloted_id='$info[id]'";
                        $rsh=$con->query($sqlh);
                        $datah=$rsh->fetch_all(1);
                        $last_namess = array_column($datah, 'hname');
                        $valuess=implode(',',$last_namess);
                        
                        ?>
                        <td><?= $valuess?  $valuess:
                        'N/A'?></td>
                            <?php
                            $last_names = array_column($datah, 'room');
                            $values=implode(',',$last_names);
                             ?>
                            
                         <td><?=$values? $values:'N/A'?></td>
                              <?php
                   

                                ?>
                        
                    </tr>
                    <?php
                    }
                }
                ?>
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