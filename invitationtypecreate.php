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
            <title>Guest Details</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <?php
include "header.php";
        include "connect.php";
            $sql="select * from guest where 1 order by id desc";
            $rs=$con->query($sql);
            $data=$rs->fetch_all(1);
        ?>
        <!-- <link rel="stylesheet" href="main.css"> -->
        <script src="file.js"></script>
        </head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <body>
           
                <div class="container-fluid mt-2" style="border:1px solid">
                    <div class="alert alert-primary text-center h4">
                        Register Invitations
                    </div>
                    <div class="table-responsive" style="height:600px">

                    
                        <table class="table table-striped invitation_table guest_table" style="white-space:nowrap ">
                                <thead class="table-dark" style="position:sticky;z-index:1">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Guest Name</th>
                                        <th>First</th>
                                        <th>Second</th>
                                        <th>third</th>
                                        <th>Member Count</th>
                                        <th>Member Count</th>
                                        <th>Member Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        $index=0;
                                        foreach($data as $info){



                                            if($info['status']=='Active'){
                                                $sql="SELECT * from invitation where guest_id='$info[id]'";
                                                $result=$con->query($sql);
                                                $data=$result->fetch_all(1);
                                                // print_r($data[0]['member_count_second']);
                                            ?>
                                          
                                          <?php if(count($data)>0 && ($data[0]['member_count_second'] || $data[0]['member_count_first'] || $data[0]['member_count_third']))
                                          {


                                          ?>
                                              <tr>
                                                <td><?=++$index?></td>
                                            
                                                <td><label for="" name="<?="guest".$index?>"><?=$info['gname'];?></label>
                                                <input type="hidden" name="gname" value="<?=$info['gname'];?>">
                                                <input type="hidden" name="guest_id" value="<?=$info['id'];?>">

                                                    </td>

                                                    <td><input type="checkbox" disabled checked name="check_first" id="first<?=$index;?>"  class="main" onclick="show_input_first(<?=$index;?>)"></td>
                                                
                                                <td><input type="checkbox" disabled name="check_second" checked id="two"  class="main1"></td>
                                                <td><input type="checkbox" disabled checked  name="check_third" id="three<?=$index;?>"  class="main2" onclick="show_input_third(<?=$index;?>)"  disabled></td>
                                            
                                                <td><input type="text" class="show1" value="<?=$data[0]['member_count_first'];?>" name="first" id="show1<?=$index;?>" style="display:block ; width:100px"  disabled ></td>
                                                <td><input type="text" class="show2" value="<?=$data[0]['member_count_second'];?>" name="second"  style="width:100px" disabled></td>

                                                <td><input type="text" class="show3" value="<?=$data[0]['member_count_third'];?>" name="third"  style="display:block;width:90px" id="third<?=$index;?>"  disabled></td>
                                                <td><button class="btn btn-success" name="invitationadd" disabled>Add</button></td>

                                            </tr>

                                          <?php }
                                        else{
                                            ?>
                                            <form action="invitationtypestore.php" method='post'>
                                            <tr>
                                                <td><?=++$index?></td>
                                                <td><label for="" name="<?="guest".$index?>"><?=$info['gname'];?></label>
                                                <input type="hidden" name="gname" value="<?=$info['gname'];?>">
                                                <input type="hidden" name="guest_id" value="<?=$info['id'];?>">

                                                    </td>

                                                    <td><input type="checkbox" name="check_first" id="first<?=$index;?>"  class="main" onclick="show_input_first(<?=$index;?>)"></td>
                                                
                                                <td><input type="checkbox" name="check_second" checked id="two"  class="main1"></td>
                                                <td><input type="checkbox" name="check_third" id="three<?=$index;?>"  class="main2" onclick="show_input_third(<?=$index;?>)"></td>
                                            
                                                <td><input type="text" class="show1" value="" name="first" id="show1<?=$index;?>" style="display:none ; width:100px"  ></td>
                                                <td><input type="text" class="show2" name="second"  style="width:100px"></td>

                                                <td><input type="text" class="show3" name="third"  style="display:none;width:90px" id="third<?=$index;?>"></td>
                                                <td><button class="btn btn-success" name="invitationadd">Add</button></td>

                                            </tr>
                                            </form>

                                                        <?php }
                                                                                    }
                                                                                        }
                                                                                        ?>
                                
                                </tbody>
                        </table> 
                        </div>
                        <div class="text-center"> 
                            <button class="btn btn-success mb-3 mt-5"> Save</button>
                        </div>
                </div>

        </body>
        <?php
        ?>
</html>

<script>

                function show_input_first(id){


                    if($('#first'+id).is(":checked")){
            $('#show1'+id).css({
            'display':'block'
            });

                            } else {
            $('#show1'+id).css({
            'display':'none'
            });
            $('#show1'+id).val('');

                            }

                }
                function show_input_third(id){
                
                    if($('#three'+id).is(":checked")){
            $('#third'+id).css({
            'display':'block'
            });

                            } else {
            $('#third'+id).css({
            'display':'none'
            });
            $('#third'+id).val('');
                            }

                }
                $(document).ready(function () {
    $('.invitation_table').DataTable();
});
    
</script>
<?php
}else{
    header('location:login.php');
}
?>