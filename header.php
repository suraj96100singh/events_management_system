<?php
// session_start();
if(isset($_SESSION["password"])){
?>
<!DOCTYPE html>
<html>
<head>

	<title>Marriage Event Dashboard</title>
	<link rel="stylesheet" href="main.css">
<!-- --------------------------------------------------------------------- -->
<!-- header cdn -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<!-- Custom CSS -->
  

	<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!--datatables cdn-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<!--select2 cdn-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="dashboard.php">Mahesh Event .Com</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="dashboard.php">Dashboard</a>
			</li>
	      <li class="nav-item">
	        <a class="nav-link" href="event.php">Events</a>
	      </li>
	      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" role="button" aria-expanded="true">
            Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="firstday_report.php">First Day Guest</a></li>
            <li><a class="dropdown-item" href="secondday_report.php">Second Day Guest</a></li>
            <li><a class="dropdown-item" href="thirdday_report.php">Third Day Guest</a></li>
           
          </ul>
        </li>
	      
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" role="button" aria-expanded="true">
            Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="guestcreate.php">Add Guest</a></li>
            <li><a class="dropdown-item" href="guestindex.php">Guest Database</a></li>
            <li><a class="dropdown-item" href="hotelcreate2.php">Add Hotel & Rooms</a></li>
            <li><a class="dropdown-item" href="hotelindex.php">Hotel Database</a></li>
            <li><a class="dropdown-item" href="invitationtypecreate.php">Enter Invitations Types</a></li>
            <li><a class="dropdown-item" href="event.php">Marriage Booking</a></li>
            <li><a class="dropdown-item" href="roomallotment2.php">Room Allotment</a></li>
            <li><a class="dropdown-item" href="invite.php">Invitaion</a></li>
            <li><a class="dropdown-item" href="calllogs.php">Call-Logs</a></li>
           
          </ul>
        </li>
	    </ul>
	   
	  </div>
	  <ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="logout.php">Logout</a>
			</li>
	</nav>
	<?php
}else{
	header('location:login.php');
}
	?>
	<script>
		$(document).ready(function () {
    $('.guest_table').DataTable(
        {
			dom: 'Bfrtip',
			buttons: [
        {
          extend: 'excel',
          exportOptions: {
            format: {
              body: function ( inner, rowidx, colidx, node ) {
                if ($(node).children("input").length > 0) {
                  return $(node).children("input").first().val();
                }
				else if($(node).children("button").length > 0) {
					return "";
				}
				
				
				else {
                  return inner;
                }
              }
            }
          }
        }
		,{
          extend: 'pdf',
          exportOptions: {
            format: {
              body: function ( inner, rowidx, colidx, node ) {
                if ($(node).children("input").length > 0) {
                  return $(node).children("input").first().val();
                } 
				else if($(node).children("button").length > 0) {
					return "";
				}
				
				else {
                  return inner;
                }
              }
            }
          }
        }

      ]
        }
    );
});
	</script>