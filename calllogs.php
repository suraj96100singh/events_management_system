<?php
session_start();
?>
<?php
if(isset($_SESSION["password"])){
?>

<head>
   
<body>
    
<?php
include "header.php";
    include "connect.php";
    $sqljoin="select guest.gname,call_log.calldoneby,call_log.remarks,call_log.datecall,call_log.id from call_log join guest on guest.id=call_log.guest_call_id";
     $rsjoin=$con->query($sqljoin);
      $datajoin=$rsjoin->fetch_all(1);
    ?>
    
    <div class="container-fluid">
        <h1 class="text-center my-5">Call Logs Details</h1>
        
        <div class="card ">
            <div class="card-header border border-0">
                <div class="text-end">
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">Add Event +</button> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingsModal">Call Log +</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-capitalize guest_table">
                        <thead class="table-primary">

                            <tr>
                                 <th>S No.</th>
                                <th>GuestName</th>
                                <th>Correction</th>
                                <th>Call Done By</th>
                                <th>Remarks</th>
                                <th>Date</th>
                                <th >Update</th>
                                <th >Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
            if($datajoin){
                $index=1;
                foreach($datajoin as $infojoin){
                    ?>
                    
                    <tr>
                                <td><?=$index++;?></td>
                                <td><?=$infojoin['gname'];?></td>
                                <form action="calllogupdate.php?id=<?=$infojoin['id'];?>" method="post" >
                                <td> <input class="form-check-input" type="checkbox" value="" id="check<?=$index?>" name="checkstatus" onclick="show_inputs(<?=$index?>)"></td>
                                <td><input class="form-control checked1" disabled type="text" value="<?=$infojoin['calldoneby'];?>" id="doneby<?=$index?>" name="calldoneby"></td>
                                <td><input class="form-control checked1" disabled type="text" value="<?=$infojoin['remarks'];?>" id="mainperson<?=$index?>" name="remarks"></td>
                                <td><input class="form-control checked1" disabled type="datetime-local" value="<?=$infojoin['datecall'];?>" id="mainpersoncontact<?=$index?>" name="datecall"></td>
                                <td><button class="btn btn-primary" name="statusupdatebtn">Update</button></td>
                                </form>
                                <td><button class="btn btn-danger" name="deletebtn" onclick="delme('calllogupdate.php?delete_id=<?=$infojoin['id'];?>')">Delete</button></td>
                              
                            
                            </tr>
                           <?php
                }
            }
                           ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
        

    </div>
   <!-- start Modal event-->
   

<!-- start Modal bookings-->
<div class="modal fade" id="bookingsModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px modal-dialog-scrollable">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
           <div class="modal-header">
                <h1 class="modal-title fs-5" >Add Call Log</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>        
            <!--begin::Modal body-->
            <div class="modal-body ">
                <!--begin:Form-->
                <form  method="post" action="calllogsstore.php">
                    <!--begin::Input group-->
                      <div class="row">
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Guest Name:</span>
                              </label>

                                    <?php
                                    $sql="select * from guest where status='Active'";
                                    $rs=$con->query($sql);
                                    $data=$rs->fetch_all(1);
                                    ?>
                                    <select name="callgname" id="" class="form-control">
                                    <option selected disabled>Select Guest...</option>
                                        <?php
                                        foreach($data as $val){
                                        
                                    
                                            ?>
                                        <option value="<?=$val['id'];?>"><?=$val['gname'];?></option>
                                        
                                <?php
                                        }
                                        ?>
                                    </select>
                          </div>
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Call Done By:</span>
                              </label>
                              <input type="text" class="form-control" name="calldoneby" />
                          </div>
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Remarks:</span>
                              </label>
                              <input type="text" class="form-control" name="remarks" />
                          </div>
                            
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center fw-bold mb-1">
                                    <span class="">Date:</span>
                                </label>
                                <input type="datetime-local" class="form-control" name="datecall" />
                            </div>
                          
                      <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center mt-5">
                        <button type="submit" name="bookingbtn" class="btn btn-primary btn-sm mx-1">Submit</button>
                        <button type="button" data-bs-dismiss="modal" class="btn border border-dark btn-sm">Cancel</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end modal bookings-->
</body>
</html>

<script>

    function show_inputs(id){
        if ($("#check"+id).is(':checked')) {
                    $('#doneby'+id).prop('disabled', false);
                    $('#mainperson'+id).prop('disabled', false);
                    $('#mainpersoncontact'+id).prop('disabled', false);
                } else {
                    $('#doneby'+id).prop('disabled', true);
                    $('#mainperson'+id).prop('disabled', true);
                    $('#mainpersoncontact'+id).prop('disabled', true);
                }

    }
    

    function delme(path){
        if(confirm('Do You Really Want to Delete')){
        // console.log(path);
            location.href=path;
            
        }
    }

    //select 2 code goes here
   
    $(document).ready(function() {
                                    $('.rooms').select2({
                                        placeholder: "Select Here",
                                        dropdownParent: $("#bookingsModal")
                                    
                                    });
                                });



                     //end here 
</script>

<?php
}else{
    header('location:login.php');
}
?>