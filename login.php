<?php
session_start();


require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";


if(isset($_POST['submit'])){
	$username = sanitize(trim($_POST['username']));
	$password = sanitize(trim($_POST['password']));

	$sql_admin = "SELECT * from admin where username = '$username' and  password = '$password' ";
	$query = mysqli_query($conn, $sql_admin);
	
	if(mysqli_num_rows($query) > 0){

				while($row = mysqli_fetch_assoc($query)){
					$_SESSION['auth'] = true;
					$_SESSION['admin'] = $row['username'];
					}
					if ($_SESSION['auth'] === true) {
				header("Location: bookstable.php");
				exit();
					}
	}

		else{
			$sql_stud = "SELECT * from students where username='$username' and password = '$password'";
				$query = mysqli_query($conn, $sql_stud);
				$row = mysqli_fetch_assoc($query);
				if($row['username'] == $username && $row['password'] == $password){
					$_SESSION['student-username'] = $row['username'];
					$_SESSION['student-name'] = $row['name'];
					$_SESSION['student-matric'] = $row['matric_no'];
						header("Location:studentportal.php");
					}
					else {
						echo"<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'> Login Failed.  Please check your details.</strong>
				  </div>";
					}




			}


}


?>
<style>
body
{
background-color: #4158D0;
background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
}
</style>
<body>

	<div class="container" >
			
			<div class="jumbotron login" style="width:40%;background-color:white;margin:auto;margin-top:3%;margin-bottom:3%">
				<p class="text-center" style="text-align: center">User Login</p>
				<div class="row justify-content-center">
				<div class="col">
					<a href="#" class="thumbnail">
					<img src="images/login.jpg">
					</a>
				</div>
				<div class="col">
				<div class="container">
					<form class="form-horizontal" role="form" method="post" action="login.php" enctype="multipart/form-data">
						<div class="form-group">
							<div class="col-sm-12">
								<input type="text" class="form-control" name="username" placeholder="Enter your username" id="username" required>
							</div>
						</div>
						<div class="form-group">

						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="password" class="form-control" placeholder="Enter your password" name="password" id="password" required>
							</div>
						</div>

						<div class="form-group">
						<center><input type="submit" class="btn btn-primary col-lg-4" name="submit" value="Login" style="margin-left:30%"></center>
						</div>

						</div>
					</form>
				</div>
				</div>
				
				</div>
			
			</div>
		<div>
	</div>




<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"> </script>
	<?php if (isset($alert_user)) { ?>
	<script type="text/javascript">
		swal("Oops...", "You are not allowed to view this page directly...!", "error");
	</script>
	<?php } ?>

</body>
</html>
