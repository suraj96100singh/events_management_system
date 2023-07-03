<?php

session_start();
if(isset($_SESSION["password"])){

    include "header.php";
    include "connect.php";
?>
<link rel="stylesheet" href="main.css">
<script src="file.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

var auth_token;
function dropdown_state() {
    $.ajax({
        type: 'GET',
        url: 'https://www.universal-tutorial.com/api/getaccesstoken',
        success: function (data) {
            auth_token = data.auth_token;
            get_state(false);
        },
        headers: {
            "Accept": "application/json",
            "api-token": "D-FpCSCxWG7D2BjTHw7fu6AG4NJLVdTsPy-quvPKpXt-hfNo8xwOvacZauakrYwsGvY",
            "user-email": "monikabothra1996@gmail.com"
        }
    });
    // $("#state").change(function () {
        
    // })

}
function get_data(){
    get_city(false);
}
dropdown_state();
function get_state(state) {
    var country_name = "India";
    $.ajax({
        type: 'GET',
        url: 'https://www.universal-tutorial.com/api/states/' + country_name,
        success: function (data) {
            $("#state").empty();
 
            data.forEach(element => {
                if (state) {
                $("#state").append('<option value="' + element.state_name + '">' + element.state_name + '</option>').val(state);
                }else{
                $("#state").append('<option value="' + element.state_name + '">' + element.state_name + '</option>');

                }
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
            // $("#city_id").val('');
            $("#city").empty();
            var unique = [...new Set(data.map(item => item.city_name))];
            if (city) {
                // console.log("get_city fun",city);
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
<?php
$id=$_GET['id'];
// $con=new mysqli('localhost','root','','vehicleinfo');
$sql="select * from guest where id=$id";
$rs=$con->query($sql);
// var_dump($rs);
$val=$rs->fetch_assoc();

// echo ($info['files']);
// print_r($info);
$con->close();
?>

<body>
    <form method="Post" action="guestupdate.php?id=<?=$val['id'];?>" onsubmit="return validation()">
    <div class="container mt-2" style="border:1px solid">
    <div class="alert alert-primary text-center h4">
        Guest Update Form
    </div>
    <div class="mb-3">
    <label for="gname">Guest Name</label>
    <input type="text" class="form-control" placeholder="Guest Name" name="gname" id="gname" value="<?=$val['gname'];?>" required>
      </div>
      <div class="mb-3" >
    <label for="mob">Enter Mobile Number</label>
    <input type="number" class="form-control" placeholder="Enter Mobile Number" name="number"  id="mob" value="<?=$val['number'];?>">
    </div>
    <div class="mb-3 form-control">
    <label for="">State</label>
    <select id="state" name="state" onchange="get_data()" >
        </select>
        <label for="city">City</label>
        <select name="city" id="city">
        </select>
</div>
<div class="mb-3 form-control">
    <label for="guest">Guest Type</label>
    <select name="guesttype" id="guest" value="<?=$val['guesttype'];?>">
        <option value="ITO">ITO</option>
        <option value="Banker">Banker</option>
        <option value="Nanihal Family">Nanihal Family</option>
        <option value="Rathi Family">Rathi Family</option>
        <option value="Doctors">Doctors</option>
        <option value="Other Professional">Other Professional</option>
        <option value="Other Relation">Other Relation</option>
    </select>
</div>
<div class="mb-3 form-control">
    <label for="">Room Required</label><br>
    <?php
    if($val['roomreq']=='Yes')
    {
    ?>
  <input type="radio" name="roomreq" value="Yes" checked id="roomreq"><label for="roomreq">Yes</label><br>
  <input type="radio" name="roomreq" value="No" id="roomreq1"><label for="roomreq1">No</label>
  <?php
  }else{
    ?>
 <input type="radio" name="roomreq" value="Yes" id="roomreq"><label for="roomreq">Yes</label><br>
  <input type="radio" name="roomreq" value="No"  checked id="roomreq1"><label for="roomreq1">No</label>

  <?php

  }
  ?>
    </div>

      <button class="btn btn-success">Update</button>
      
      </div>
</form>

</body>

<script>
    var states="<?php echo $val['state']; ?>";
   get_state(states);

</script>
<?php
?>
</html>
<?php
}else{
    header('location:login.php');
}
?>