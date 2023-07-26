<?php 
session_start();

include ('conn.php');

if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
$errors = array();

if($_POST) {		

	$current_pass = $_POST['current_pass'];
	$new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];
	
	if(empty($current_pass) || empty($new_pass) || empty($confirm_pass)) {
		if($current_pass == "") {
			$errors[] = "Current Password is required";
		} 

		if($new_pass == "") {
			$errors[] = "New Password is required";
		}
		if($confirm_pass == "") {
			$errors[] = "Confirm New password is required";
		}
	} else 
	{
		
		$user_role = $_SESSION['user_role'];
		
		$sql = "SELECT * FROM users WHERE user_role = '$user_role' ";
		$result = $conn->query($sql);

		if($result->num_rows == 1) 
		{
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM users WHERE user_role = '$user_role' AND password = '$current_pass' ";
			$mainResult = $conn->query($mainSql);

			if($new_pass!=$confirm_pass){
            $errors[] = 'New password do not match!' ;
             exit();
            } else 
			{

               $update_pass = "update users set password='$new_pass' where user_role='$user_role'";

               $run_update = mysqli_query($con, $update_pass);

               $errors[] = 'Your password was updated successfully!' ;
               echo "<script>window.open('inex','_self')</script>";
			
		    } 
	    } else 
		{			
			   $errors[] = "Username doesnot exists";				
		}
		// /else not empty username // password
	}
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
		    <h3 class="panel-title">Please Change Password </h3>
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
									<label for="username" class="col-sm-2 control-label">Current</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="current_pass" name="current_pass" placeholder="Enter Current Password" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">New</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="new_pass" placeholder="Enter New Password" autocomplete="off" />
									</div>
								</div>	
                                <div class="form-group">
									<label for="password" class="col-sm-2 control-label"> Confirm</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Confirm New Password" autocomplete="off" />
									</div>
								</div>									
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Change Password </button>
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