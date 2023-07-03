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
    $sqljoin="select * from hotel join guest on guest.id=hotel.alloted_id";
     $rsjoin=$con->query($sqljoin);
      $datajoin=$rsjoin->fetch_all(1);
    ?>
    
    <div class="container-fluid">
        <h1 class="text-center my-5">Guest Room Allotment</h1>
        
        <div class="card ">
            <div class="card-header border border-0">
                <div class="text-end">
                    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">Add Event +</button> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingsModal">Allot Room +</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-capitalize guest_table">
                        <thead class="table-primary">

                            <tr>
                                 <th>S No.</th>
                                <th>GuestName</th>
                                <th>Hotel Name</th>
                                <th>Room No</th>
                                <th>Room Category</th>
                                <th>Correction</th>
                                <th>Check In Date</th>
                                <th>Check Out Date</th>
                                <th>Remarks</th>
                                <th >Update</th>
                                
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
                                <td><?=$infojoin['hotelname'];?></td>
                                <td><?=$infojoin['room'];?></td>
                               
                                <td><?=$infojoin['roomqulity'];?></td>

                                <form action="roomupdate.php?id=<?=$infojoin['id'];?>" method="post" >
                                <td> <input class="form-check-input" type="checkbox" value="" id="check<?=$index?>" name="checkstatus" onclick="show_inputs(<?=$index?>)"></td>
                                <td><input class="form-control checked1" disabled type="datetime-local" value="<?=$infojoin['checkin'];?>" id="doneby<?=$index?>" name="checkin"></td>
                                <td><input class="form-control checked1" disabled type="datetime-local" value="<?=$infojoin['checkout'];?>" id="mainperson<?=$index?>" name="checkout"></td>
                                <td><input class="form-control checked1" disabled type="text" value="<?=$infojoin['remarks'];?>" id="mainpersoncontact<?=$index?>" name="remarks"></td>

                                <td><button class="btn btn-primary" name="statusupdatebtn">Update</button></td>
                                </form>
                              
                            
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
                <h1 class="modal-title fs-5" >Allot Room</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>        
            <!--begin::Modal body-->
            <div class="modal-body ">
                <!--begin:Form-->
                <form  method="post" action="roomstore.php">
                    <!--begin::Input group-->
                      <div class="row">
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Guest Name:</span>
                              </label>

                                    <?php
                                    $sql="select * from guest where roomreq='Yes'";
                                    $rs=$con->query($sql);
                                    $data=$rs->fetch_all(1);
                                    ?>
                                    <select name="allotedgname" id="" class="form-control">
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
                                  <span class="">Room Qty:</span>
                              </label>
                              <input type="number" class="form-control" name="bookingqty" />
                          </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center fw-bold mb-1">
                                    <span class="">Hotel Name:</span>
                                </label>
                                <select class="form-select" name="hotelname">
                                    <option selected disabled>Select Hotel...</option>
                                    <?php
                                        // include "connect.php";
                                        $sqlhotel="select distinct(hname) from hotel";
                                        $rshotel=$con->query($sqlhotel);
                                        $datahotel=$rshotel->fetch_all(1);
                                        foreach($datahotel as $valhotel){
                                    ?>
                                    <option value="<?=$valhotel['hname'];?>"><?=$valhotel['hname'];?></option>
                                        <?php
                                        }
                                        ?>
                                </select>                              
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center fw-bold mb-1">
                                <span class="">Room Quality:</span>
                                </label>
                                <select   class="form-select" name="roomquality">
                                    <option selected disabled>Select Quality...</option>
                                    <?php
                                        // include "connect.php";
                                        $sqlhotelcat="select distinct(roomcat) from hotel";
                                        $rshotelcat=$con->query($sqlhotelcat);
                                        $datahotelcat=$rshotelcat->fetch_all(1);
                                        foreach($datahotelcat as $valhotelcat){
                                            ?>
                                    <option value="<?=$valhotelcat['roomcat'];?>"><?=$valhotelcat['roomcat'];?></option>
                                        <?php
                                        }
                                        ?>
                                </select>                              
                            </div>
                            <div class="col-md-12 mb-3">
                                  
                                    <label for="">Select Room</label>
                                    <select  multiple  name ="rooms[]" id="select-field" class="form-select rooms">
                                        
                                        <?php 
                                        include "connect.php";
                                         $sqlhotelroom="SELECT * from hotel where alloted_id IS null";
                                         $rshotelroom=$con->query($sqlhotelroom);
                                        //  print_r($con);
                                         $datahotelroom=$rshotelroom->fetch_all(1);
                                        
                                        foreach($datahotelroom as $hotelval){
                                            ?>
                                            <option value="<?=$hotelval['hotel_id']?>"><?=$hotelval['room']?></option>
                                           
                                        <?php
                                            }
                                            ?>
                                    </select>

                                
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="d-flex align-items-center fw-bold mb-1">
                                    <span class="">Check In Date:</span>
                                </label>
                                <input type="datetime-local" class="form-control" name="checkin" />
                            </div>
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">check Out Date:</span>
                              </label>
                              <input type="datetime-local" class="form-control" name="Checkout" />
                          </div>
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Remarks:</span>
                              </label>
                              <input type="text" class="form-control" name="remarks" />
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