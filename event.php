<?php
session_start();
?>
<?php
if(isset($_SESSION["password"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
<body>
    
<?php
include "header.php";
    include "connect.php";
    $sql="select * from booking where 1 order by booking_id desc";
    $rs=$con->query($sql);
    $data=$rs->fetch_all(1);
    $sqlevent="select * from events where 1 order by event_id desc";
    $rsevent=$con->query($sqlevent);
    $dataevent=$rsevent->fetch_all(1);
    ?>
    
    <div class="container-fluid">
        <h1 class="text-center my-5">Marriage Bookings</h1>
        
        <div class="card ">
            <div class="card-header border border-0">
                <div class="text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal">Add Event +</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingsModal">Add Bookings +</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-capitalize guest_table">
                        <thead class="table-primary">

                            <tr>
                                <th>S No.</th>
                                <th>Bookings Name</th>
                                <th>Booking Qty</th>
                                <th>Booking Type</th>
                                <th>Done</th>
                                <th>Done By</th>
                                <th>Main Person Name</th>
                                <th>Main Person Contact</th>
                                <th >Update</th>
                                <th >Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
            if($data){
                $index=1;
                foreach($data as $info){
                    ?>
                    
                            <tr>
                                <td><?=$index++;?></td>
                                <td><?=$info['booking_name'],"(",$info['event_name'],")";?>
                           
                            </td>
                                <td><?=$info['booking_qty'];?></td>
                                <td><?=$info['event_type'];?></td>
                                <form action="eventstore.php?id=<?=$info['booking_id'];?>" method="post" >
                                <td> <input class="form-check-input" type="checkbox" value="" id="check<?=$index?>" name="checkstatus" onclick="show_inputs(<?=$index?>)"></td>
                                <td><input class="form-control checked1" disabled type="text" value="<?=$info['done_by'];?>" id="doneby<?=$index?>" name="doneby"></td>
                                <td><input class="form-control checked1" disabled type="text" value="<?=$info['main_person'];?>" id="mainperson<?=$index?>" name="mainperson"></td>
                                <td><input class="form-control checked1" disabled type="text" value="<?=$info['main_person_contact'];?>" id="mainpersoncontact<?=$index?>" name="mainpersoncontact"></td>
                                <td><button class="btn btn-primary" name="statusupdatebtn">Update</button></td>
                                </form>
                                <td><button class="btn btn-danger" name="deletebtn" onclick="delme('eventstore.php?delete_id=<?=$info['booking_id'];?>')">Delete</button></td>
                            
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
   <div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px modal-dialog-scrollable">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h1 class="modal-title fs-5" >Add Events</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>        
            <!--begin::Modal body-->
            <div class="modal-body ">
                <!--begin:Form-->
                <form  method="post" action="eventstore.php">
                    <!--begin::Input group-->
                      <div class="row">
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Event Name:</span>
                              </label>
                              <input type="text" class="form-control" name="eventname" />
                          </div>
                          <div class="col-md-12">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Date & Time:</span>
                              </label>
                              <input type="datetime-local" class="form-control" name="eventdate" />
                          </div>
                      </div>
                      <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center mt-5">
                        <button type="submit" name="eventbtn" class="btn btn-primary btn-sm mx-1">Submit</button>
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
<!--end modal event-->

<!-- start Modal bookings-->
<div class="modal fade" id="bookingsModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px modal-dialog-scrollable">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header">
                <h1 class="modal-title fs-5" >Add Bookings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>        
            <!--begin::Modal body-->
            <div class="modal-body ">
                <!--begin:Form-->
                <form  method="post" action="eventstore.php">
                    <!--begin::Input group-->
                      <div class="row">
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Booking Name:</span>
                              </label>
                              <input type="text" class="form-control" name="bookingname" />
                          </div>
                          <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center fw-bold mb-1">
                                  <span class="">Booking Qty:</span>
                              </label>
                              <input type="text" class="form-control" name="bookingqty" />
                          </div>
                          <div class="col-md-12 mb-3">
                            <label class="d-flex align-items-center fw-bold mb-1">
                                <span class="">Event Name:</span>
                            </label>
                            <select class="form-select" name="event_name">
                                <option selected disabled>Select Event...</option>
                                <?php
    include "connect.php";
    $sql="select * from events where 1 order by event_id desc";
    $rs=$con->query($sql);
    $data=$rs->fetch_all(1);
    foreach($data as $val){
        ?>
    
    
    
                                <option value="<?=$val['event_name'];?>"><?=$val['event_name'];?></option>
    <?php
    }
    ?>
                              </select>                              
                            </div>
                            <div class="col-md-6">
                                <label class="d-flex align-items-center fw-bold mb-1">
                                    <span class="">Type:</span>
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="local" id="flexRadioDefault2" value="outsider">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                      Local
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="d-flex align-items-center fw-bold mb-1">
                                    <span class="text-white">:</span>
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="local" id="flexRadioDefault1" value="outsider">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      Outsider
                                    </label>
                                </div>
                            </div>
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

    
</script>

<?php
}else{
    header('location:login.php');
}
?>