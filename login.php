<?php
session_start();

?>

<?php
include "connect.php";
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="login.css">
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Mahesh Event .Com</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="pass" class="form-control" autocomplete="off">
                            </div>
							<div class="input-group mb-2">
                                    <label for="check">Show Password</label>&nbsp &nbsp<input type="checkbox" id="check" onclick="myfun()">
                                    
                                    
                                </div>
                            <div>
                                
                                <input type="submit" name="submit" class="btn btn-info btn-md mb-3" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="register.php" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
$message="";
if(count($_POST)>0) {
    $sql="select * from login";
    $rs=$con->query($sql);
    $data=$rs->fetch_all(1);
    foreach($data as $val){
    if(is_array($data)) {
    $_SESSION["id"] = $val['id'];
    $_SESSION["password"] = $val['passwords'];
    if(isset($_SESSION["password"])){
    if($val['username']==$_POST['username'] && $val['passwords']==$_POST['password']){
      header('location:dashboard.php');
  }else{
      ?>
     <script>
          alert("Wrong username and password");
          window.location.href="login.php";
      </script>
       <?php    
  }
} else {
     $message = "Invalid Username or Password!";
    }
}
}
}
?>
<script>
	function myfun(){
    var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  }
</script>
