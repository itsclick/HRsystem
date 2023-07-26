<?php 
session_start();

include ('conn.php');

if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 ?>
 <?php 
 $errors = array();
 
if(!isset($_GET['user_id']))
		{
		    $username = "";   
      		$password = "";
		    $user_role = "";  
		    
            if(isset($_POST['submit']))				
			{   
		        $username = $_POST['username'];
      		    $password =  $_POST['password'];
		        $user_role =  $_POST['user_role']; 

				if(empty($username) || empty($password) || empty($user_role)) 
                {
	             	if($username == "") {
			        $errors[] = " Username is required";
		            } 
		            if($password == "") 
				    {
			         $errors[] = " Password is required";
		            }
		            if($user_role == "") 
				    {
			         $errors[] = "User role is required";
	                }
				} else 
	            {
                  include ('conn.php');
				  
                    $user_pass = md5($password ) ;
 
                    $insert =  "insert into users (username,password,user_role) values ('$username','$user_pass','$user_role')";
                 
                    $result = mysqli_query($conn,$insert);

                    if($result)
				    {
                     $errors[] = " Insert is successfully complete ";
                    } else 
				    {		
	                 $errors[] =  " Insert is not successfully complete ";					 
	                }
				}
				
            }		
		} else 
		{
	        include ('conn.php');
			$i =0;
            $get_id=$_GET['user_id'];		
	        $query =  "select * from users where user_id='$get_id'";
	        $result = mysqli_query($conn,$query);
	        while($row=mysqli_fetch_array($result))
			{
               $user_id = $row['user_id'];
	           $username = $row['username'];
			   $password = $row['password'];
			   $user_role = $row['user_role'];
			   $i++;
		    }
		    if(isset($_POST['submit']))
			{
			   $get_id = $_GET['user_id'];
	           $username = $_POST['username'];
      		   $password =  $_POST['password'];
		       $user_role =  $_POST['user_role'];  

                $passWord = md5($password) ;			   
			   
			   $update = " update users set  username='$username',password='$passWord',user_role='$user_role' where user_id='$get_id'";
               $query = mysqli_query($conn,$update);
			   if($query) 
			    {
                    $errors[] = " Update is successfully complete ";
					
                } else 
				{		
             	    $errors[] =  " Update is not successfull ";	
				
	            }
				
			 
		    }    			
		}			 
		
?>
 
<html>
<head>
<title>Payroll Management System</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">

<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<script type="text/javascript" src="datatable/js/jquery.min.js"></script>
<script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>   
<script type="text/javascript" src="datatable/js/jquery.tabledit.min.js"></script>
<script type="text/javascript" src="datatable/js/jszip.min.js"></script>
<script type="text/javascript" src="datatable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="datatable/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="datatable/js/pdfmake.min.js"></script>
<script type="text/javascript" src="datatable/js/buttons.print.min.js"></script>

<script> 
 function confirmdelete() 
{
var agree=confirm("Are you sure you want to delete ?");
if (agree)
return true;
else
return false;
}
</script>


</head>
<body>
<div class="container_fluid">
 <div class="row">
     <nav class="navbar navbar-default">
        <div class="container-fluid">
			
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  </button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			   <ul class="nav navbar-nav" >
				<?php 
				if($_SESSION['user_role'] =='hr'){
				  echo '
				  <li id="navDashboard"><a href="admin/index"> <i class="glyphicon glyphicon-home"> </i> Dashboard </a> </li>  
				 
				 <li id="navDashboard"><a href="headOfDepartments"> <i class="glyphicon glyphicon-menu-hamburger"> </i> Department </a> </li> 

                 <li id="navDashboard"><a href="positions"> <i class="glyphicon glyphicon-menu-hamburger"> </i> Designation </a> </li> 				 

 				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Employee <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="employees"><i class="glyphicon glyphicon-plus "></i> Add Employee </li> </a>
				 <li id="manageOrder"><a href="view_employees"><i class="glyphicon glyphicon-edit "></i> Manage Employee </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Payroll <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="view_payroll"><i class="glyphicon glyphicon-th-list "></i> View Payroll </li> </a>
				 <li id="manageOrder"><a href="view_full_payroll"><i class="glyphicon glyphicon-th-list "></i> View Full Payroll </li> </a>
				 </ul>
				 </li>	
				  
                 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-calendar"></i> Leave <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="leaves"><i class="glyphicon glyphicon-plus "></i> Add Leave </li> </a>
				 <li id="manageOrder"><a href="view_leaves"><i class="glyphicon glyphicon-edit "></i> Manage Leave </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-time"></i> Overtime <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="overtimes"><i class="glyphicon glyphicon-plus "></i> Add Overtime </li> </a>
				 <li id="manageOrder"><a href="view_overtimes"><i class="glyphicon glyphicon-edit "></i> Manage Overtime </li> </a>
				 </ul>
				 </li>	
				 
				  <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-piggy-bank"></i> Loan <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="viw_loans"><i class="glyphicon glyphicon-menu-hamburger "></i> View Loan </li> </a>
				 </ul>
				 </li>
				   		 				 
				 <li class="dropdown">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon  glyphicon-certificate"></i> Awards <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="awards"><i class="glyphicon glyphicon-plus "></i> Add Award </li> </a>
				 </ul>
				 </li>
				 </ul>
				 <ul class="nav navbar-nav navbar-right">
				 <li class="dropdown menu">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addSetting"><a href="setting?comp_id=$comp_id"><i class="glyphicon glyphicon-wrench "></i> Setting </li> </a>
				 <li id="manageLogout"><a href="logout"><i class="glyphicon glyphicon-log-out "></i> Logout </li> </a>
				 </ul>
				 </li>			  
				  ' ;	
				} else if ($_SESSION['user_role'] =='accounts'){
				  echo ' 
				  
				  <li id="navDashboard"><a href="admin/index"> <i class="glyphicon glyphicon-home"> </i> Dashboard </a> </li>  
				 
				 <li id="navDashboard"><a href="view_headOfDepartments"> <i class="glyphicon glyphicon-menu-hamburger"> </i> Department </a> </li>  

 				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Employee <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="manageOrder"><a href="acc_view_employees"><i class="glyphicon glyphicon-th-list "></i> View Employee </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Payroll <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="payrolls"><i class="glyphicon glyphicon-plus "></i> Add Payroll </li> </a>
				 <li id="manageOrder"><a href="view_payrolls"><i class="glyphicon glyphicon-edit "></i> Manage Payroll </li> </a>
				 </ul>
				 </li>	
				  
                 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-calendar"></i> Leave <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="manageOrder"><a href="acc_view_leaves"><i class="glyphicon glyphicon-th-list "></i> View Leave </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-time"></i> Overtime <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="acc_overtimes"><i class="glyphicon glyphicon-plus "></i> Add Overtime </li> </a>
				 <li id="manageOrder"><a href="acc_view_overtimes"><i class="glyphicon glyphicon-edit "></i> Manage Overtime </li> </a>
				 </ul>
				 </li>	
				 
				  <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-piggy-bank"></i> Loan <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="loans"><i class="glyphicon glyphicon-plus "></i> Add Loan </li> </a>
				 </ul>
				 </li>
				   		 				 
				 <li class="dropdown">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon  glyphicon-certificate"></i> Awards <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="acc_view_awards"><i class="glyphicon glyphicon-th-list "></i> View Award </li> </a>
				 </ul>
				 </li>
				 </ul>
				 <ul class="nav navbar-nav navbar-right">
				 <li class="dropdown menu"> 
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addSetting"><a href="acc_setting?comp_id=$comp_id"><i class="glyphicon glyphicon-wrench "></i> Setting </li> </a>
				 <li id="manageLogout"><a href="logout"><i class="glyphicon glyphicon-log-out "></i> Logout </li> </a>
				 </ul>
				 </li>	 
				  
				  ';	
				} else if ($_SESSION['user_role'] =='admin'){
				  echo ' 
				 <li id="navDashboard"><a href="admin/index"> <i class="glyphicon glyphicon-home"> </i> Dashboard </a> </li>  
				 
				 <li id="navDashboard"><a href="headOfDepartments"> <i class="glyphicon glyphicon-menu-hamburger"> </i> Department </a> </li>  

 				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Employee <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="employees"><i class="glyphicon glyphicon-plus "></i> Add Employee </li> </a>
				 <li id="manageOrder"><a href="view_employees"><i class="glyphicon glyphicon-edit "></i> Manage Employee </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-menu-hamburger"></i> Payroll <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="payrolls"><i class="glyphicon glyphicon-plus "></i> Add Payroll </li> </a>
				 <li id="manageOrder"><a href="view_payrolls"><i class="glyphicon glyphicon-edit "></i> Manage Payroll </li> </a>
				 </ul>
				 </li>	
				  
                 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-calendar"></i> Leave <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="leaves"><i class="glyphicon glyphicon-plus "></i> Add Leave </li> </a>
				 <li id="manageOrder"><a href="view_leaves"><i class="glyphicon glyphicon-edit "></i> Manage Leave </li> </a>
				 </ul>
				 </li>	
				 
				 <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-time"></i> Overtime <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="overtimes"><i class="glyphicon glyphicon-plus "></i> Add Overtime </li> </a>
				 <li id="manageOrder"><a href="view_overtimes"><i class="glyphicon glyphicon-edit "></i> Manage Overtime </li> </a>
				 </ul>
				 </li>	
				 
				  <li class="dropdown">				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-piggy-bank"></i> Loan <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="loans"><i class="glyphicon glyphicon-plus "></i> Add Loan </li> </a>
				 </ul>
				 </li>
				   		 				 
				 <li class="dropdown">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon  glyphicon-certificate"></i> Awards <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addOrder"><a href="awards"><i class="glyphicon glyphicon-plus "></i> Add Award </li> </a>
				 </ul>
				 </li>
				 </ul>
				 <ul class="nav navbar-nav navbar-right">
				 <li class="dropdown menu">
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addSetting"><a href="setting?comp_id=$comp_id"><i class="glyphicon glyphicon-wrench "></i> Setting </li> </a>
				 <li id="manageLogout"><a href="logout"><i class="glyphicon glyphicon-log-out "></i> Logout </li> </a>
				 </ul>
				 </li>	  
				  
				  ' ;	
				}
				
				  
                 ?>				 
				 </ul>
		 
		    </div>
		</div>
		 
    </nav>
         

</div>
</div>
	    
<div class="container" style="width:95%">


    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">User </li>
		
		</ol>
		<div class="row" >
	    <div class="col-lg-4">
          <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Create User </div>
		   </div>
<?php

?>		   
		   <div class="panel-body">
		   <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			       <button class="btn btn-default"><a href="users"><i class="glyphicon glyphicon-refresh " ></i> Refresh </a></button>
			 
		    </div>  
		    <div class="col-lg-12" >
			    <div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-success" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
			 </div>

		     
			  <form class="form-horizontal" action=" " method="POST" id="loginForm">
			    <fieldset>
							  <div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="current_pass" name="username" value ="<?php echo $username ; ?>" placeholder="Enter User name " autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password </label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" value ="<?php echo $password ; ?>" placeholder="Enter Password" autocomplete="off" />
									</div>
								</div>	
                                <div class="form-group">
									<label for="password" class="col-sm-2 control-label">Role </label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="confirm_pass" name="user_role" value ="<?php echo $user_role ; ?>" placeholder="Enter User Role " autocomplete="off" />
									</div>
								</div>									
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" name="submit" class="btn btn-success "> <i class="glyphicon glyphicon-log-in"></i> Save Data </button>
									</div>
								</div>
							</fieldset>		
		      </form>

            </div> 		   
		   </div>
		  </div>
	    </div>
		<div class="col-lg-8">
          <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Manage Users </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="col-lg-12" >
			     	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			   <th>SN</th>
			   <th>User Name </th>
			   <th>Password</th>
			   <th>User Role </th>
			   <th style="width:15%">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
    include ('conn.php');  
    $i = 0;	
	$query =  "select * from users ";
	$result = mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result)){
	$user_id = $row['user_id'];
	$username = $row['username'];
	$password = $row['password'];
	$user_role = $row['user_role'];
	$i++;
	?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $username ; ?></td>
				<td><?php echo $password ; ?></td>
				<td><?php echo $user_role ; ?></td>
				<td> <?php echo "<a href='users?user_id=$user_id' class='label label-primary'><i class='glyphicon glyphicon-edit'> Edit</i></a>" ?> | <?php echo "<a  href='delete_user?user_id=$user_id' class='label label-danger'><i class='glyphicon glyphicon-trash'> Delete</i></a>" ?> </td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
               <th>SN</th>
			   <th>User Name </th>
			   <th>Password</th>
			   <th>User Role </th>
			   <th style="width:15%">Options</th>
               </tr>
			
              </tfoot>
	
    </table>
 
			   
            </div> 		   
		   </div>
		  </div>
	    </div>
 
        </div>
	
	 </div>
</div>
   
<script>
$(document).ready(function() {
    $('#example').DataTable( {
       
        
    } );
} );
</script>  
</body>
</html>
