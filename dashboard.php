
<?php
session_start();
if(isset($_SESSION["password"])){
?>
<body>
    <?php
	
	include "header.php";
	include "connect.php";
    $sqlguest="select * from guest where 1 order by id desc";
    $rsguest=$con->query($sqlguest);
    $dataguest=$rsguest->fetch_all(1);
        ?>
        <?php
    $sqlgueststatus="select count(status) from guest where status='Active'";
    $rsgueststatus=$con->query($sqlgueststatus);
    $datagueststatus=$rsgueststatus->fetch_all(1);
    ?>
    <?php
    $sqlgueststatus2="select count(status) from guest where status='Inactive'";
    $rsgueststatus2=$con->query($sqlgueststatus2);
    $datagueststatus2=$rsgueststatus2->fetch_all(1);
    ?>

        <?php
    $sqlhotel="select * from hotel where 1 order by hotel_id desc";
    $rshotel=$con->query($sqlhotel);
    $datahotel=$rshotel->fetch_all(1);
    ?>

	<div class="container-fluid mt-4">
		<div class="row">
			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card bg-primary text-white">
				  <div class="card-body">
				    <h5 class="card-title">Total Guest</h5>
				    <a class="card-text" href="guestindex.php" style="color:white"><?=count($dataguest);?></a>
				  </div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card bg-success text-white">
				  <div class="card-body">
				    <h5 class="card-title">Active Members</h5>
				    <a class="card-text" href="guestindex.php" style="color:white"><?=$datagueststatus[0]['count(status)']?></a>
				  </div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card bg-warning text-white">
				  <div class="card-body">
				    <h5 class="card-title">Inactive Members</h5>
				    <a class="card-text" href="guestindex.php" style="color:white"><?=$datagueststatus2[0]['count(status)']?></a>
				  </div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card bg-danger text-white">
				  <div class="card-body">
				    <h5 class="card-title">Total Rooms</h5>
				    <a class="card-text" href="hotelindex.php" style="color:white"><?=count($datahotel);?></a>
				  </div>
				</div>
			</div>
		</div>

</body>
		<?php
}else{
	header('location:logout.php');
}
		?>
		