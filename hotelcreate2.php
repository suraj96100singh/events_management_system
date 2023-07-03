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
<script src="file.js"></script>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


</script>
<body>
    <form action="hotelstore.php" method='post'>
    <div class="container mt-2" style="border:1px solid">
    <div class="alert alert-primary text-center h4">
        Add Hotel

    </div>
   
    
    <div class="mb-3">
    <label for="honame">Hotel Name</label>
    <input type="text" class="form-control" placeholder="Hotel Name" name="hname" id="honame" required>
    
      </div>

<div class="row">
  <div class="customer_records" >

  FlOOR <input  type="text" name="floreno[]" >

  ROOM NO <input  type="number"  name="roomno[]" >
    ROOM CATEGORY <input  type="text"  name="roomcategory[]">

    <a class="extra-fields-customer btn btn-primary mb-3" href="#" onclick="add_inputs()">Add More</a>
  </div>

  <div class="customer_records_dynamic"></div>

</div>
<div class="text-center"> 
<button class="btn btn-success mb-3 mt-5"> Save</button>
</div>
</form>
</body>
<script>
    var count=0;
    function add_inputs(){
        count++;
        var html='';
        html='<div class="remove" id="'+count+'">\
FlOOR <input name="floreno[]" type="text">\
ROOM NO <input name="roomno[]" type="number">\
  ROOM CATEGORY <input name="roomcategory[]" type="text">\
<a href="#" class="remove-field btn-remove-customer btn btn-danger mb-3" onclick="remove_inputs('+count+')">Remove</a></div>';
$('.customer_records_dynamic').append(html);
    }

    function remove_inputs(id){
        $('#'+id).remove();
    }


</script>
<?php
?>
</html>
<?php
}else{
  header('location:login.php');
}


?>