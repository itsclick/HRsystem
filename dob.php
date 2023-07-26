<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>Payroll Management System</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">

<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script> 

</head>
<body>
                <div class="container" style="width=70% ; height=50% ; margin-top: 10px; ">
				<div class="row">
				<div class="col-md-12">
				<?php
				include('conn.php'); 
                $current_month = date("F-Y");				
				$query =  "SELECT emp_photo,emp_fullname,emp_dob,NOW() from employees 
				          ORDER BY emp_dob DESC   ";		
                $result = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_array($result)){
                    $emp_photo = $row['emp_photo'];
					$emp_fullname = $row['emp_fullname'];
                    $emp_dob = $row['emp_dob'];  
					$date = date("d-M-",strtotime($emp_dob));
					$c_date = date("Y");
					
                 echo " <div class='col-md-12'> "; 
				 echo " <div class='col-md-3' style='margin-right:-220px;'> <img src='images/photo/$emp_photo' width='50' height='50' /> </div>  " ;
                 echo " <div class='col-md-6' style='margin-top:0px;'>". $row['emp_fullname']."<br/>". $date.$c_date ." </div>";			 
				 echo " <div class='col-md-3'></div> <hr/> <hr/>";
                 echo " </div> ";
			
				}
				?>
				</div>
				<div class="col-md-12">
				
				<select class="form-control" id="emp_maratial_status" name="emp_maratial_status"  >
				      	<option value="<?php  ?>">
						<?php 
                           
						echo year();	
						
						?>
						
						</option>
				      
				</select>


				</div>
				</div>
				</div>



</body>
</html>