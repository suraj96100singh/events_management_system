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

?>
<!-- <link rel="stylesheet" href="main.css"> -->
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

var auth_token;
function dropdown_state() {
    $.ajax({
        type: 'GET',
        url: 'https://www.universal-tutorial.com/api/getaccesstoken',
        success: function (data) {
            auth_token = data.auth_token;
            get_state(data.auth_token);
        },
        headers: {
            "Accept": "application/json",
            "api-token": "D-FpCSCxWG7D2BjTHw7fu6AG4NJLVdTsPy-quvPKpXt-hfNo8xwOvacZauakrYwsGvY",
            "user-email": "monikabothra1996@gmail.com"
        }
    });
 

}
function get_data(){
    get_city(false);
}
dropdown_state();
function get_state(auth_token) {
    var country_name = "India";
    $.ajax({
        type: 'GET',
        url: 'https://www.universal-tutorial.com/api/states/' + country_name,
        success: function (data) {
            $("#state").empty();
            data.forEach(element => {
                $("#state").append('<option value="' + element.state_name + '">' + element.state_name + '</option>');
            });
        },
        headers: {
            "Authorization": "Bearer " + auth_token,
            "Accept": "application/json"
        }

    });
}

function get_city(city) {
    var state_name = $("#state").val();
    console.log(state_name);
    $.ajax({
        type: 'GET',
        url: 'https://www.universal-tutorial.com/api/cities/' + state_name,
        success: function (data) {
            $("#city").empty();
            var unique = [...new Set(data.map(item => item.city_name))];
            if (city) {
                unique.forEach(element => {
                    $("#city").append('<option value="' + element + '">' + element + '</option>').val(city);
                });
            }
            else {
                unique.forEach(element => {
                    $("#city").append('<option value="' + element + '">' + element + '</option>');
                });
            }

        },
        headers: {
            "Authorization": "Bearer " + auth_token,
            "Accept": "application/json"
        }
    });

}

</script>
<body>
    <form method="Post" action="gueststore.php" onsubmit="return validation()">
    <div class="container mt-2" style="border:1px solid">
    <div class="alert alert-primary text-center h4">
        Guest Registration
    </div>
    <div class="mb-3">
    <label for="gname">Guest Name</label>
    <input type="text" class="form-control" placeholder="Guest Name" name="gname" id="gname" required>
      </div>
      <div class="mb-3" >
    <label for="mob">Enter Mobile Number</label>
    <input type="number" class="form-control" placeholder="Enter Mobile Number" name="number"  id="mob" value="">
    </div>
      <div class="mb-3 form-control">
    <label for="state">State</label>
    <select id="state" name="state" onchange="get_data()">  
        </select>
        <label for="city">City</label>
        <select name="city" id="city">
        <option value="">Select</option>
        </select>
</div>
<div class="mb-3 form-control">
    <label for="guest">Guest Type</label>
    <select name="guesttype" id="guest">
        <option value="">--Select Any One--</option>
        <option value="ITO">ITO</option>
        <option value="Banker">Banker</option>
        <option value="Nanihal Family">Nanihal Family</option>
        <option value="Rathi Family">Rathi Family</option>
        <option value="Doctors">Doctors</option>
        <option value="Other Professional">Other Professional</option>
        <option value="Other Relation">Other Relation</option>
    </select>
</div>

<div class="mb-3">
    <label for="residence">Local Residence/Outsider</label>
    <textarea name="residence" id="residence" cols="10" rows="" class="form-control" placeholder="Enter Residence Address"></textarea>
</div>
<div class="mb-3 form-control">
    <label for="">Room Required</label><br>
  <input type="radio" name="roomreq" value="Yes" id="roomreq"><label for="roomreq">Yes</label><br>
  <input type="radio" name="roomreq" value="No" id="roomreq1" checked><label for="roomreq1">No</label>
    </div>
      <div class="mb-3 text-center mt-3">
      <button type="reset" class="btn btn-success">Reset</button>
      <button class="btn btn-success">Save</button>
      
      </div>
</form>
</body>
<?php
?>
</html>
<script>
    function validation(){
    var mob =document.getElementById("mob").value;
        if(mob.length >10 || mob.length <10){
        alert("Number should be 10 Digit");
        return false;
        }
        
    }

 </script>
<?php
}else{
    header('location:login.php');
}
?>
