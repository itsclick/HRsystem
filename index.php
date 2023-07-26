<?php 
session_start();

include ('conn.php');

/*
if(isset($_SESSION['user_id'])) {
	header('location: http://localhost/my_payroll/fullcalendar/index');	
}
*/

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = $conn->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
			$mainResult = $conn->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];
				$username = $value['username'];
				$user_role = $value['user_role'];

				// set session
			    $_SESSION['user_id'] = $user_id;
				$_SESSION['username'] = $username;
				$_SESSION['user_role'] = $user_role;
				
                if($_SESSION['user_role'] =='admin'){
				  header('location: http://localhost/kuo_payroll/admin/index');	
				} else if ($_SESSION['user_role'] =='accounts'){
				  header('location: http://localhost/kuo_payroll/admin/index');	
				} else if ($_SESSION['user_role'] =='hr'){
				  header('location: http://localhost/kuo_payroll/admin/index');	
				}
					
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Username doesnot exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>
<!DOCTYPE html>
<html>
<head>

<title> Inventory Management System</title>
     <!--bootstrap -->
	 <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	 <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-theme.min.css">
	 
     <!--js links -->
     <script src="assets/bootstrap/js/jquery.min.js"></script>
	 <script src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">

    <div class="row" style="padding-top:150px; padding-bottom:150px;">
      <div class ="col-md-5 col-md-offset-4">
		<div class="panel panel-info">
		   <div class="panel-heading">		    
		    <h3 class="panel-title">Please Sign In </h3>
		   </div>		   
		   <div class="panel-body">
		       <div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
			    </div>

		     
			  <form class="form-horizontal" action="" method="POST" id="loginForm">
			    <fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>		
		      </form>
			  
		   </div>

        </div>
	  </div>
      
    </div>
	
</div>

</body>
</html>