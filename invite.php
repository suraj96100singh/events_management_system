<?php
session_start();
if(isset($_SESSION["password"])){
    include "header.php";
?>
 <?php

include "connect.php";
    $sqls="select * from guest where 1 order by id desc";
    $rss=$con->query($sqls);
    $datas=$rss->fetch_all(1);
?>


           
                <div class="container-fluid mt-2" style="border:1px solid">
                    <div class="alert alert-primary text-center h4">
                        Register Invitations
                    </div>
                    <div class="table-responsive" style="height:600px">

                    
                        <table class="table table-striped invitation_table" style="white-space:nowrap ">
                        <form action="invitestore.php" method="post">
                                <thead class="table-dark" >
                                    
                                    <tr>
                                        <th>S.No</th>
                                        <th>Guest Name</th>
                                        <th>WhatsApp</th>
                                        <th>Whatsapp&Personal Both</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                        $index=0;
                                        foreach($datas as $info){

                                                    // print_r($info[])

                                            if($info['status']=='Active'){
                                                $sql="SELECT onlinestatus,updatebtn from guest where id='$info[id]'";
                                                $result=$con->query($sql);
                                                $data=$result->fetch_all(1);
                                            //    print_r($data);
                                            //    exit;
                                                
                                            ?>
                                        <?php 
                                        if(count($data)>0 && $data[0]['updatebtn']==="1")
                                          {


                                          ?>
                                            <tr>
                                                <td><?=++$index?></td>
                                                <td><label for="" name="<?="guest".$index?>"><?=$info['gname'];?></label>
                                                <input type="hidden" name="gname" value="<?=$info['gname'];?>">
                                                <input type="hidden" name="guest_id" value="<?=$info['id'];?>">

                                                    </td>
                                                    
                                                    <?php 
                                        if($data[0]['onlinestatus']==="whatApp")
                                          {


                                          ?>
                                                    <td><input type="checkbox" disabled checked name="check" id="first<?=$index;?>"   ></td>
                                                
                                                <td><input type="checkbox" disabled  name="check" id="two<?=$index;?>"  disabled></td>
                                            
                                                <td><button class="btn btn-success" name="invitationadd"  disabled>Update</button></td>





                                            </tr>
                                            <?php }else{

                                          
                                        
                                            ?>

<td><input type="checkbox" disabled  name="check" id="first<?=$index;?>"  ></td>
                                                
                                                <td><input type="checkbox" disabled checked name="check" id="two<?=$index;?>"  disabled></td>
                                            
                                                <td><button class="btn btn-success" name="invitationadd"  disabled>Update</button></td>





                                            </tr> 

                                          <?php  } }
                                          else{
                                            ?>
                                          
                                        <form>
                                            <tr>
                                                <td><?=++$index?></td>
                                                <td><label for="" name="<?="guest".$index?>"><?=$info['gname'];?></label>
                                                <input type="hidden" name="gname" value="<?=$info['gname'];?>">
                                                <input type="hidden" name="guest_id" value="<?=$info['id'];?>">

                                                    </td>

                                                    <td><input type="checkbox" name="check" id="first<?=$index;?>"  class="both"  value="whatApp"></td>
                                                
                                                <td><input type="checkbox" name="check" id="two"  class="both" value="whatApp&personal" id="two<?=$index;?>" ></td>
                                            
                                                

                                                <td><button class="btn btn-success" name="invitationadd" value="1">Update</button></td>

                                            </tr>
                                            </form>

                                            <?php
                                          }
                                            }
                                        }
?>
                                        
                                
                                </tbody>
                                    </form>
                        </table> 
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
    


$(".both").change(function() {
    $(".both").prop('checked', false);
    $(this).prop('checked', true);
});
</script>



<?php
}else{
    header('location:login.php');
}
?>