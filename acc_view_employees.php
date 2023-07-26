<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
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
				 <li id="navDashboard"><a href="admin/index"> <i class="glyphicon glyphicon-home"> </i> Dashboard </a> </li>  
				 
				 <li id="navDashboard"><a href="view_headOfDepartments"> <i class="glyphicon glyphicon-th-list"> </i> Department </a> </li>  

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
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addSetting"><a href="acc_setting?comp_id=$comp_id"><i class="glyphicon glyphicon-wrench "></i> Setting </li> </a>
				 <li id="manageLogout"><a href="logout"><i class="glyphicon glyphicon-log-out "></i> Logout </li> </a>
				 </ul>
				 </li>	 
				 </ul>
		 
		    </div>
		</div>
		 
    </nav>
         

</div>
</div>
	    
<div class="container" style="width:90%">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Employee </li>
		
		</ol>
        
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-th-list"></i> Manage Employee </div>
		   </div>
		   
		   <div class="panel-body">

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			        <th style="width:10%;">Photo</th>							
					<th>Employee Name</th>	
					<th>Present Address</th>
					<th>City</th>
					<th>Telephone</th>
					<th>SSNIT Number</th>
					<th>Contact Per Fullname</th>
					<th>Contact Per Tel</th>
					<th>Status</th>																				
					<th style="width:5%;">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
	include('conn.php');   
	$query =  "SELECT * from employees order by status desc ";
		
	$result = mysqli_query($conn,$query);
	while($row = mysqli_fetch_array($result)){
	$emp_id = $row['emp_id'];
	$emp_photo = $row['emp_photo'];
	$emp_fullname = $row['emp_fullname'];
	$emp_ssnit_number = $row['emp_ssnit_number'];
	$emp_present_address = $row['emp_present_address'];
	$emp_city = $row['emp_city'];
	$emp_mobile = $row['emp_mobile'];
	$bank_account_no = $row['bank_account_no'];
	$emp_contact_fullname = $row['emp_contact_fullname'];
	$emp_contact_mobile = $row['emp_contact_mobile'];
	// active 
 	if($row['status'] == 1) {
 		// activate member
 		$activeEmployee = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$activeEmployee = "<label class='label label-danger'>Inactive</label>";
 	}

	?>
            <tr>   
                <td><?php echo " <img src='./images/photo/$emp_photo' width='50' height='30' /> " ; ?> </td>	             
				<td><?php echo $row['emp_fullname']; ?></td>
                <td><?php echo $row['emp_present_address']; ?></td>
                <td><?php echo $row['emp_city']; ?></td>
				<td><?php echo $row['emp_mobile'];?></td>
                <td><?php echo $row['emp_ssnit_number']; ?></td>
				<td><?php echo $row['emp_contact_fullname']; ?></td>				
                <td><?php echo $row['emp_contact_mobile'];?></td>		
				<td><?php echo $activeEmployee ; ?></td>
	<td><?php echo "<a  title ='View'  href='view_employee?emp_id=$emp_id' class='label label-info'><i class='glyphicon glyphicon-th-list'> View</i></a>" ?> | <?php echo " <a  title ='Prin'  href='emp_personal_report?emp_id=$emp_id' class='label label-info'><i class='glyphicon glyphicon-print'> Print</i></a>" ?> </td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
                <th style="width:10%;">Photo</th>							
					<th>Employee Name</th>	
					<th>Present Address</th>
					<th>City</th>
					<th>Telephone</th>
					<th>SSNIT Number</th>
					<th>Contact Per Fullname</th>
					<th>Contact Per Tel</th>
					<th>Status</th>																		
					<th style="width:5%;">Options</th>
               </tr>
			
              </tfoot>
	
    </table>
	
	</div>
		   
		   

        </div>
      
    </div>
	
	
</div>
   
<script>
$(document).ready(function() {
    $('#example').DataTable( {} );
	$(document).tooltip();
} );
</script>  
</body>
</html>
