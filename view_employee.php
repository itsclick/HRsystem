<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php

if(isset($_REQUEST['emp_id'])){
include('conn.php'); 
$emp_id=$_GET['emp_id'];  
$query =  "SELECT * from employees where emp_id =$emp_id ";		
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
$emp_code = $row['emp_code'];
$emp_joining_date = $row['emp_joining_date'];
$emp_fullname = $row['emp_fullname'];
$emp_dob = $row['emp_dob'];
$emp_gender = $row['emp_gender'];
$emp_maratial_status = $row['emp_maratial_status'];
$emp_mothers_mainden_name = $row['emp_mothers_mainden_name'];
$emp_nationality = $row['emp_nationality'];
$emp_tin_number = $row['emp_tin_number'];
$emp_ssnit_number = $row['emp_ssnit_number'];
$emp_present_address = $row['emp_present_address'];
$emp_city	 = $row['emp_city'];
$emp_country = $row['emp_country'];
$emp_mobile = $row['emp_mobile'];
$emp_email = $row['emp_email'];
$bank_name = $row['bank_name'];
$bank_branch = $row['bank_branch'];
$bank_account_name = $row['bank_account_name'];
$bank_account_no = $row['bank_account_no'];
$emp_contact_fullname = $row['emp_contact_fullname'];
$emp_contact_housenumber = $row['emp_contact_housenumber'];
$emp_contact_mobile = $row['emp_contact_mobile'];
$emp_contact_occupation = $row['emp_contact_occupation'];
$emp_contact_relationshipToEmp = $row['emp_contact_relationshipToEmp'];
$position_id = $row['position_id'];
$head_dep_id = $row['head_dep_id'];
$emp_photo = $row['emp_photo'];
$emp_resume = $row['emp_resume'];
$emp_offerLetter = $row['emp_offerLetter'];
$emp_joiningLetter = $row['emp_joiningLetter'];
$emp_contractPaper = $row['emp_contractPaper'];
$emp_idProff = $row['emp_idProff'];
$emp_otherDocument = $row['emp_otherDocument'];
$status = $row['status'];
$annual_leave = $row['annual_leave'];
$sick_leave = $row['sick_leave'];
// active 
 	if($row['status'] == 1) {
 		// activate member
 		$status = "<label class='label label-success'>Active</label>";
 	} else {
 		// deactivate member
 		$status = "<label class='label label-danger'>Inactive</label>";
 	}

// pos_name
$get_pos ="select e.position_id,p.position from employees e Join positions p  on e.position_id = p.position_id 
           where emp_id = '$emp_id' ";
    $run_pos = mysqli_query($conn, $get_pos);
    while ($row_pos = mysqli_fetch_array($run_pos)){
    $position_id =$row_pos[0];
    $pos_name =$row_pos[1];

}
// dep_name
$get_dep ="select e.head_dep_id,h.dep_id,h.HeadOfDepartment,d.dep_name from employees e             
		   join headOfDepartments h on e.head_dep_id=h.head_dep_id 
		   join departments d on h.dep_id=d.dep_id where emp_id=$emp_id";		
	$run_dep = mysqli_query($conn, $get_dep);
	while ($row_dep = mysqli_fetch_array($run_dep)){
	$head_dep_id=$row_dep[0];
	$dep_id =$row_dep[1];
	$HeadOfDepartment =$row_dep[2];
	$dep_name =$row_dep[3];
}
	
?>	
<html>
<head>
<title>Payroll Management System</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="assets/jqueryui/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">



<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.structure.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.theme.js"></script>
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
	    
<div class="container">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Employee </li>
		
		</ol>
      <form name="form1" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data"> 
	
        <div class="panel panel-default">
                    <div class="panel-heading well" class="">
                     <h3 class="panel-title"> <div ><i class=""></i>Employee Details <div style="float:right;" ><a href="#"><span  class ="label label-primary " style="margin:6px; padding:10px;"> <i title="PDF" class="fa fa-file-pdf-o"  style="font-size:18px"></i></span></a> <?php echo " <a  title ='Print'  href='emp_personal_report?emp_id=$emp_id' class='label label-primary' style='font-size:18px'><i class='glyphicon glyphicon-print'></i></a>" ?></div> </div> </h3>
                    </div>
                    <div class="panel-body">
			<div class="col-lg-12" style="margin-left:20px;" >
            <table width="100%"  align="center" cellspacing="20" >
                  <tr>
                    <td width="112">Photo :</td>
                    <td width="11">&nbsp;</td>
                    <td width="186" align="right"><span style="font-weight:bolder;"> Employee Name :</span></td>
                    <td width="7">&nbsp;</td>
                    <td width="407"> <?php echo $emp_fullname ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>				  
                  <tr>
                    <td width="112" rowspan="4">
                     <?php echo " <img src='./images/photo/$emp_photo' width='130' height='100' /> " ; ?></td>
                    <td>&nbsp;</td>
                    <td width="186" align="right"><span style="font-weight:bolder;">   Employee ID : </span></td>
                    <td width="7">&nbsp;</td>
                    <td width="407"><?php echo $emp_code ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="0.5%">&nbsp;</td>
                    <td width="186" align="right"><span style="font-weight:bolder;"> Department : </span></td>
                    <td width="7">&nbsp;</td>
                    <td width="407"><?php echo $dep_name." , ". $HeadOfDepartment  ; ?> </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="0.5%">&nbsp;</td>
                    <td width="186" align="right" > <span style="font-weight:bolder;"> Position : </span> </td>
                    <td width="7">&nbsp;</td>
                    <td width="407"><?php echo $pos_name ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>                 
                  <tr>
                    <td height="0.5%">&nbsp;</td>
                    <td width="186" align="right" ><span style="font-weight:bolder;"> Joining Date : </span></td>
                    <td width="7">&nbsp;</td>
                    <td width="407"><?php echo  date("d-M-Y",strtotime($emp_joining_date)) ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				</table> <hr>			   
			</div> 
			<div class="col-lg-12" > 
            <div class="col-lg-6" >
			     <div class="panel panel-default">
                    <div class="panel-heading">
                     <h3 class="panel-title">Personal Details</h3>
                    </div>
                    <div class="panel-body">
                <table width="100%"  align="center" cellspacing="30">
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Date Of Birth  :</span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"> <?php echo date("d-M-Y",strtotime($emp_dob)) ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;">   Gender  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_gender ; ?></td>
                    <td>&nbsp;</td>                    
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Maratial Status : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_maratial_status; ?> </td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right" > <span style="font-weight:bolder;"> Nationality : </span> </td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_nationality ; ?></td>
                    <td>&nbsp;</td>                  
                  </tr>  
                  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  				  
                  <tr>
                    <td width="200" align="right" ><span style="font-weight:bolder;"> Tin Number  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_tin_number ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
				  <tr >
                    <td width="200" align="right" ><span style="font-weight:bolder;"> SSNIT Number  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_ssnit_number ; ?></td>
                    <td>&nbsp;</td>                  
                  </tr>
				</table> <hr>	
                    </div>
                </div>
			</div>
            <div class="col-lg-6" >
			    <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Contact Details</h3>
                  </div>
                  <div class="panel-body">
                   <table width="100%"  align="center" cellspacing="30">
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Email Address :</span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"> <?php echo $emp_email ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Mobile  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_mobile ; ?></td>
                    <td>&nbsp;</td>                    
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Address : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_present_address; ?> </td>
                    <td>&nbsp;</td>                  
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right" > <span style="font-weight:bolder;"> City : </span> </td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_city ; ?></td>
                    <td>&nbsp;</td>                  
                  </tr> 
                  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  				  
                  <tr>
                    <td width="200" align="right" ><span style="font-weight:bolder;"> Country  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_country ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
				  <tr >
                    <td width="200" align="right" ><span style="font-weight:bolder;">  </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                   
                  </tr>
				</table> <hr>
                   </div>
                </div>
			</div>
			</div> 
			<div class="col-lg-12" > 
            <div class="col-lg-6" >
			     <div class="panel panel-default">
                    <div class="panel-heading">
                     <h3 class="panel-title">Contact Person (Family Relation) </h3>
                    </div>
                    <div class="panel-body">
                  <table width="100%"  align="center" cellspacing="30">
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Full Name :</span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"> <?php echo $emp_contact_fullname ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> House Number  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_contact_housenumber ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Contact Number : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_contact_mobile; ?> </td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right" > <span style="font-weight:bolder;"> Occupation : </span> </td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_contact_occupation ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right" ><span style="font-weight:bolder;"> Relationship  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $emp_contact_relationshipToEmp ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
				  <tr >
                    <td width="200" align="right" ><span style="font-weight:bolder;">  </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                   
                  </tr>
				</table> <hr>
                    </div>
                </div>
			</div>
            <div class="col-lg-6" >
			    <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Bank Info</h3>
                  </div>
                  <div class="panel-body">
                 <table width="100%"  align="center" cellspacing="30">
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Bank Name :</span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"> <?php echo $bank_name ; ?></td>
                    <td>&nbsp;</td>                    
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Bank Branch  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $bank_branch ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Account Name : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $bank_account_name; ?> </td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right" > <span style="font-weight:bolder;"> Account Numer : </span> </td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><?php echo $bank_account_no ; ?></td>
                    <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  				  
                  <tr>
                    <td width="200" align="right" ><span style="font-weight:bolder;"> </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                   
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
				  <tr >
                    <td width="200" align="right" ><span style="font-weight:bolder;">  </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                  
                  </tr>
				</table> <hr>
                   </div>
                </div>
			</div>
			</div> 
			<div class="col-lg-12" > 
            <div class="col-lg-6" >
			     <div class="panel panel-default">
                    <div class="panel-heading">
                     <h3 class="panel-title">Leave Info </h3>
                    </div>
                    <div class="panel-body">
                  <table width="100%"  align="center" cellspacing="30">
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Annual Leave Days :</span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"> <?php echo $annual_leave ; ?></td>
                    <td>&nbsp;</td>                    
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Leave Days Taken  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407">
					<?php 
	                     // total_days
	                     include('conn.php');
	                     $emp_id=$_GET['emp_id']; 
                         $count_days ="select sum(total_days) from leave_form 
	                     where emp_id = $emp_id and leave_id = 1 and year(start_date) = year(now()) ";
                         $run_count_days = mysqli_query($conn, $count_days);
                         while ($row = mysqli_fetch_array($run_count_days))
						 {
                            $total_days =$row[0];	
	                      if($total_days != 0)
		                   {
		                    $total_days =$row[0];	
                             echo $total_days ;	
	                       }else {
		                    $total_days =0;	
                             echo $total_days ;
	                       }
	                     }
                    ?>					
					</td>
                    <td>&nbsp;</td>                    
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right"><span style="font-weight:bolder;"> Leave Balance : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407">
					<?php 
	                 $leave_balance =  $annual_leave - $total_days  ;
                      echo $leave_balance ; 
					?></td>
                    <td>&nbsp;</td>                  
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
                    <td width="200" align="right" > <span style="font-weight:bolder;"> </span> </td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                   
                  </tr>  
                  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  				  
                  <tr>
                    <td width="200" align="right" ><span style="font-weight:bolder;"> </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                    
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
				  <tr >
                    <td width="200" align="right" ><span style="font-weight:bolder;">  </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"></td>
                    <td>&nbsp;</td>                  
                  </tr>
				</table> <hr>
                    </div>
                </div>
			</div>
            <div class="col-lg-6" >
			    <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Employee Documents</h3>
                  </div>
                  <div class="panel-body">
                    <table width="100%" id="employeeTable"  align="center" cellspacing="50" style="padding:0px">
                  <tr id="emp_resume" >
                    <td width="200" align="right"><span style="font-weight:bolder;"> Resume Letter :</span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><a href="images/photo/<?php echo $emp_resume ; ?>" target="_blank" ><?php echo $emp_resume ; ?></a></td>
                    <td>&nbsp;</td>                   
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr id="emp_offerLetter" >
                    <td width="200" align="right"><span style="font-weight:bolder;"> Offer Letter  : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><a href="images/photo/<?php echo $emp_offerLetter ; ?>" target="_blank" ><?php echo $emp_offerLetter ; ?></a></td>
                    <td>&nbsp;</td>					
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
				  <tr id="emp_joiningLetter" >
                    <td width="200" align="right" ><span style="font-weight:bolder;"> Joining Letter : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><a href="images/photo/<?php echo $emp_joiningLetter ; ?>" target="_blank" ><?php echo $emp_joiningLetter ; ?></a></td>
                    <td>&nbsp;</td>                  
                  </tr>
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr id="emp_contractPaper" >
                    <td width="200" align="right"><span style="font-weight:bolder;"> Contract Paper : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><a href="images/photo/<?php echo $emp_contractPaper ; ?>" target="_blank" ><?php echo $emp_contractPaper ; ?></a></td>
                    <td>&nbsp;</td>                   
                  </tr> 
				  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  
                  <tr id="emp_idProff" >
                    <td width="200" align="right" > <span style="font-weight:bolder;"> ID Card : </span> </td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><a href="images/photo/<?php echo $emp_idProff ; ?>" target="_blank" ><?php echo $emp_idProff ; ?></a></td>
                    <td>&nbsp;</td>                  
                  </tr> 
                  <tr>
				  <td>&nbsp;</td>                   
                  </tr>  				  
                  <tr id="emp_otherDocument" >
                    <td width="200" align="right" ><span style="font-weight:bolder;"> Other Document : </span></td>
                    <td width="17">&nbsp;</td>
                    <td width="407"><a href="images/photo/<?php echo $emp_otherDocument ; ?>" target="_blank" ><?php echo $emp_otherDocument ; ?></a></td>
                    <td>&nbsp;</td>                   
                  </tr>				  
				</table><hr>
                   </div>
                </div>
			</div>
			</div> 
		 </div> <!-- Pannel body ends here -->
        </div>  <!-- Pannel d ends here -->          
<?php
  }
  }
  ?>					       
		    </div> 
        </form>	      	
            
    </div> 
			
			
    	
		   
		  
    </div>
		
      
</div>
	
	
</div>
   
<script>

	
  /*
  
     $( "td:empty" )
  .text( "Was empty!" )
  .css( "background", "rgb(255,220,200)" );
  
	,
	    emp_offerLetter = document.getElementById("emp_offerLetter").value,
		emp_joiningLetter = document.getElementById("emp_joiningLetter").value,
		emp_contractPaper = document.getElementById("emp_contractPaper").value,
		emp_idProff = document.getElementById("emp_idProff").value,
		emp_otherDocument = document.getElementById("emp_otherDocument").value;
	
	if($( emp_resume == ""){
	  $("#emp_resume").css("display","none");
	else { 
	  $("#emp_resume").css("display","block");
	}
	
	
    if($("#emp_offerLetter").val() == ''){
	  $("#emp_offerLetter").css("display","none");	
	else {
	  $("#emp_offerLetter").css("display","block");	
	} 	
	if($("#emp_joiningLetter").val() == ''){
	  $("#emp_joiningLetter").css("display","none");
	} else {
	  $("#emp_joiningLetter").css("display","block");
	}		
	if($("#emp_contractPaper").val()= '' ){
	  $("#emp_contractPaper").css("display","none");
	} else {
	  $("#emp_contractPaper").css("display","block");
    }
	if($("#emp_idProff").val()= ''){
	  $("#emp_idProff").css("display","none");	
	} else {
	  $("#emp_idProff").css("display","block");	
	}
	
	
	
	if(emp_otherDocument == ''){
	  $("#emp_otherDocument").css("display","none");	
	} else {
	  $("#emp_otherDocument").css("display","block");
	}
	*/
	
} );
</script>  
</body>
</html>
