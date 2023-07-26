<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php

if(isset($_POST['search'])){
include('conn.php'); 
//$emp_id=$_GET['emp_id'];  
$query =  "SELECT * from employees where emp_id = '".$_POST['emp_id']."' ";		
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
           where emp_id = '".$_POST['emp_id']."' ";
    $run_pos = mysqli_query($conn, $get_pos);
    while ($row_pos = mysqli_fetch_array($run_pos)){
    $position_id =$row_pos[0];
    $pos_name =$row_pos[1];

}
// dep_name
$get_dep ="select e.head_dep_id,h.dep_id,h.HeadOfDepartment,d.dep_name from employees e             
		   join headOfDepartments h on e.head_dep_id=h.head_dep_id 
		   join departments d on h.dep_id=d.dep_id where emp_id = '".$_POST['emp_id']."' ";		
	$run_dep = mysqli_query($conn, $get_dep);
	while ($row_dep = mysqli_fetch_array($run_dep)){
	$head_dep_id=$row_dep[0];
	$dep_id =$row_dep[1];
	$HeadOfDepartment =$row_dep[2];
	$dep_name =$row_dep[3];
}


include('conn.php');
	$query ="select emp_id,annual_leave,sick_leave,year from employee_annual_leaves             
                 where emp_id = '".$_POST['emp_id']."' and (year between year('".$_POST['startDate']."') and year('".$_POST['endDate']."')) ";			 
	$run = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($run))
	{
		
	   $p_emp_id=$row['emp_id'];
       $p_annual_leave =$row['annual_leave'];
	   $p_sick_leave =$row['sick_leave'];
	   $p_year =$row['year'];	
        /*
        if($row['annual_leave'] != 0 or $row['annual_leave'] != "" )
		{
		   $p_annual_leave = $row['annual_leave'];
           // echo $p_annual_leave ;	
	    }else {
		   $p_annual_leave =0;	
          // echo $p_annual_leave ;
	    }	   
	   */
    }
	
/*
$query ="select * from leave_form             
                 where emp_id = '".$_POST['emp_id']."' and year = year('".$_POST['startDate']."') ";		
	$run = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($run))
	{
	   $p_emp_id=$row['emp_id'];
       $p_annual_leave =$row['annual_leave'];
	   $p_sick_leave =$row['sick_leave'];
    }
	
*/	

?>	
<html>
<head>
<title>Payroll Management System</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>


<script type="text/javascript">
        function PrintWindow()
        {                    
           window.print();            
           CheckWindowState();
        }
       
        function CheckWindowState()
        {           
            if(document.readyState=="complete")
            {
                window.close(); 
            }
            else
            {           
                setTimeout("CheckWindowState()", 2000)
            }
        }    
        
       PrintWindow();
</script>
<style media="print">
 @page {
  size: auto;
  margin:5px;
  padding:5px;
 }
</style>

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
	    
 <div class="wrapper">
    <div>
    <div class="logo"> <img src="logo/kuo_logo.jpg" width="130" height="150"/> </div>
	<div class="heading"><h4 class="text-center"> KUO FIRE SAFETY LIMITED </h4>
    <h5 class="text-center"> 368/2 Watson Ave. Adabraka </h5>	
	<i><h4 class="text-center"><span style='font-weight:bolder; margin-left:0px;'> Report : <?php $sDate = $_POST['startDate'] ; $edate = $_POST['endDate'] ; echo date("d-M-Y",strtotime($sDate))." To ". date("d-M-Y",strtotime($edate)) ;  ?> </span></h4></i> </div>
    <h3 class="panel-title"><i><span style="font-weight:; float:right; margin-top:10px" id="date_times">Printed : <?php echo date("d M Y H:i:s") ; ?> </span></i></h3>	
	</div></br>  <hr>
            <div class="col-sm-12" >
             <table width="100%"  align="center" cellspacing="50" >
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
                    <td width="407"><?php echo date("d-M-Y",strtotime($emp_joining_date)) ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				</table> <hr>			   
			</div> 
<div class="col-lg-12">			
           <!-- <h3 class="panel-title"><span style="font-weight:bolder;"> Leave Info </span></h3> <hr>  -->
  <table width="100%" cellspacing="50" style="margin-top:-60px;">
  <tr>
    <td><span style="font-weight:bolder;"> Annual Leave :</span></td>
    <td><?php 	
	$today = date('d-M-Y');
	$current_year = date("Y",strtotime($today));
	$post_date = $_POST['startDate'] ;
	$post_year = date("Y",strtotime($post_date));
    if( $post_year == $current_year){	
	 echo $annual_leave  ;
	} else 
	{
     echo 
	 
	 $p_annual_leave  ;
	}
	?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td ><span style="font-weight:bolder;"> Leave Days Taken :</span></td>
    <td><?php 
	// total_days
	include('conn.php');
	// $emp_id=$_GET['emp_id']; 
    $count_days ="select sum(total_days) from leave_form 
	       where emp_id = '".$_POST['emp_id']."' and leave_id = 1  and (start_date between '".$_POST['startDate']."' and '".$_POST['endDate']."' )";
    $run_count_days = mysqli_query($conn, $count_days);
    while ($row = mysqli_fetch_array($run_count_days)){
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
    ?></td><hr width="1" size="500">		
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><span style="font-weight:bolder;"> Leave Balance :</span></td>
    <td><?php 
	$today = date('d-M-Y');
	$current_year = date("Y",strtotime($today));
	$post_date = $_POST['startDate'] ;
	$post_year = date("Y",strtotime($post_date));
    if( $post_year == $current_year){	
	 echo $leave_balance =  $annual_leave - $total_days  ;
	} else 
	{
     echo $leave_balance =  $p_annual_leave - $total_days  ;
	}
	?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td><span style="font-weight:bolder;"> Annual Sick Leave :</span></td>
    <td><?php echo  $sick_leave  ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td ><span style="font-weight:bolder;"> Sick Leave Days Taken :</span></td>
    <td><?php 
	// total_days
	include('conn.php');
	// $emp_id=$_GET['emp_id']; 
    $count_days ="select sum(total_days) from leave_form 
	       where emp_id = '".$_POST['emp_id']."' and  leave_id = 2  and (start_date between '".$_POST['startDate']."' and '".$_POST['endDate']."') ";
    $run_count_days = mysqli_query($conn, $count_days);
    while ($row = mysqli_fetch_array($run_count_days)){
    $total_sick_leave_days =$row[0];
        if($total_sick_leave_days != 0)
		{
		   $total_sick_leave_days =$row[0];	
           echo $total_sick_leave_days ;	
	    }else {
		   $total_sick_leave_days =0;	
           echo $total_sick_leave_days ;
	    }	
	}
    ?></td><hr width="1" size="500">		
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><span style="font-weight:bolder;"> Sick Leave Balance :</span></td>
    <td><?php 
	$sick_leave_balance =  $sick_leave - $total_sick_leave_days  ;
	echo $sick_leave_balance ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td><span style="font-weight:bolder;"> Personal Leave :</span></td>
    <td><?php 
	// total_days
	include('conn.php');
	// $emp_id=$_GET['emp_id']; 
    $count_days ="select sum(total_days) from leave_form 
	       where emp_id = '".$_POST['emp_id']."' and leave_id = 4  and (start_date between '".$_POST['startDate']."' and '".$_POST['endDate']."' ) ";
    $run_count_days = mysqli_query($conn, $count_days);
    while ($row = mysqli_fetch_array($run_count_days))
	{
      $total_personal_leave_days =$row[0];	
	  
	    if($total_personal_leave_days != 0)
		{
		   $total_personal_leave_days =$row[0];	
           echo $total_personal_leave_days ;	
	    }else {
		   $total_personal_leave_days =0;	
           echo $total_personal_leave_days ;
	    }
	}
	?>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td ><span style="font-weight:bolder;"> Emmergency Leave :</span></td>
    <td><?php 
	// total_days
	include('conn.php');
	// $emp_id=$_GET['emp_id']; 
    $count_days ="select sum(total_days) from leave_form 
	       where emp_id = '".$_POST['emp_id']."' and leave_id = 5  and (start_date between '".$_POST['startDate']."' and '".$_POST['endDate']."') ";
    $run_count_days = mysqli_query($conn, $count_days);
    while ($row = mysqli_fetch_array($run_count_days))
	{
      $total_emmergency_leave_days =$row[0];	
	  
	    if($total_emmergency_leave_days != 0)
		{
		   $total_emmergency_leave_days =$row[0];	
           echo $total_emmergency_leave_days ;	
	    }else {
		   $total_emmergency_leave_days =0;	
           echo $total_emmergency_leave_days ;
	    }
	
	 
	}
    ?></td><hr width="1" size="500">		
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><span style="font-weight:bolder;"> Total Unpaid Leave  :</span></td>
    <td><?php 
	$totel_unpaid_leaves =  $total_personal_leave_days + $total_emmergency_leave_days  ;
	echo $totel_unpaid_leaves ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  
</table> <hr/>
</div> 
<?php
  }
  }
  ?>			
<table id="example" class="display nowrap" border=1;  style="width:100%; margin:0 auto;">
    
    <thead>
			   <tr style="padding:10px;">						
					<th align="center"><span style=' margin-left:5px;'>SN</span></th>
					<th align="center"><span style=' margin-left:5px;'>Start Date</span> </th>
					<th align="center"><span style=' margin-left:5px;'>End Date </span></th>					
					<th align="center"><span style=' margin-left:5px;'>Resume Date </span> </th>
					<th align="center"><span style=' margin-left:5px;'>Type Of Leave</span></th>
					<th align="center"><span style=' margin-left:5px;'>Reason Code </span></th>
					<th align="center"><span style=' margin-left:5px;'>No Of Days </span></th>					

			   </tr>
			   </thead>
			   <tbody>
    <?php 
	if(isset($_POST['search'])){
	include('conn.php'); 
	// $emp_id = $_GET['emp_id'];
    $i = 0;	
	$result = mysqli_query($conn,"select l.leave_form_id,l.emp_id,e.emp_fullname,l.head_dep_id,h.HeadOfDepartment,d.dep_name,l.start_date,l.end_date,l.total_days,
	    l.resumption_date,l.leave_id,t.leave_types ,t.reason_id,r.reason_name,l.reason_explanation,l.contact_number,l.Officer_taken_over from leave_form l 
		Join employees e on l.emp_id = e.emp_id 
		Join headOfDepartments h on l.head_dep_id = h.head_dep_id 
		Join departments d on h.dep_id = d.dep_id 
		Join leave_types t on l.leave_id = t.leave_id 
		Join reason_codes r on t.reason_id = r.reason_id 
		where l.emp_id = '".$_POST['emp_id']."' and (l.start_date between '".$_POST['startDate']."' and '".$_POST['endDate']."' )
        order by l.start_date
      	");
    while($row=mysqli_fetch_array($result))
	{
		$leave_form_id =$row[0];
		$emp_id =$row[1];
		$emp_fullname =$row[2];
		$headOfDepartment =$row[4];
		$dep_name =$row[5];
		$start_date =$row[6];
		$end_date =$row[7];
		$total_days =$row[8];
		$resumption_date =$row[9];
		$leave_types =$row[11];
		$reason_name =$row[13];
		$reason_explanation =$row[14];
		$contact_number = $row[15];
	    $Officer_taken_over = $row[16];	
	    $i++ ;	
        
	?>      
	        
            <tr>   
                <td align="center"><?php echo $i ; ?></td>	 			
                <td align="center"><?php echo date("d-M-Y",strtotime($start_date)) ; ?></td>									
				<td align="center"><?php echo date("d-M-Y",strtotime($end_date)) ;  ?></td>				
				<td align="center"><?php echo date("d-M-Y",strtotime($resumption_date)) ; ?></td>                  
				<td align="left"><?php echo "<span style=' margin-left:5px;'>".$leave_types ."</span>"; ?></td>					
				<td align="left"><?php echo "<span style=' margin-left:5px;'>".$reason_name."</span>" ; ?></td>
                <td align="center"><?php echo $total_days ; ?></td>				
           </tr>
    <?php
	}
	}
	?>
        </tbody>
             
	
    </table>

		 
                
			
            
					       
	
 </div> 	    
 
			
			
    	
		   

   
<script>
$(document).ready(function() {
	$("#emp_date").datepicker({showOtherMonths: true , changeMonth: true});
	$("#emp_dob").datepicker({showOtherMonths: true , changeMonth: true , changeYear: true});
	
    $(document).tooltip()
} );
</script>  
</body>
</html>
