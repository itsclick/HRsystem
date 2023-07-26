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
    <h4 class="text-center"><span style='font-weight:bolder; margin-left:0px;'><?php echo $emp_fullname; ?> Personal Details Report</span></h4>	</div> 
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
<div class="col-lg-12" style=" margin-top:-10px;">			
            <h3 class="panel-title"><span style="font-weight:bolder;"> Leave & Loan Status </span></h3> <hr>  
  <table width="100%" cellspacing="50" style=" margin-top:-30px;" >
  <tr>
    <td><span style="font-weight:bolder;"> Annual Leave :</span></td>
    <td><?php echo  $annual_leave  ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td ><span style="font-weight:bolder;"> Leave Days Taken :</span></td>
    <td><?php 
	// total_days
	include('conn.php');
	$emp_id=$_GET['emp_id']; 
    $count_days ="select sum(total_days) from leave_form 
	       where emp_id = $emp_id and leave_id = 1 and year(start_date) = year(now()) ";
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
	$leave_balance =  $annual_leave - $total_days  ;
	echo $leave_balance ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  
</table> 
</div> 
<div class="col-lg-12">			
        <!-- <h3 class="panel-title"><span style="font-weight:bolder;"> Leave Info </span></h3> <hr> -->  
  <table width="100%" cellspacing="50" style="margin-top:-30px;">
  <tr>
    <td><span style="font-weight:bolder;"> T.Loan AMT :</span></td>
    <td><?php 
	
       include('conn.php'); 
       $sum_loan_amount ="select sum(loan_amount) from loans
	       where emp_id = $emp_id  ";
        $run_sum_loan_amount = mysqli_query($conn, $sum_loan_amount);
	    while ($row = mysqli_fetch_array($run_sum_loan_amount))
		{
         $total_loan_amount =$row[0];	
	    
	     if($total_loan_amount != 0)
		{
		   $total_loan_amounts = $row[0];
           echo number_format($total_loan_amounts,2,'.',',')  ;	
	    } else {
		   $total_loan_amounts =0;	
           echo number_format($total_loan_amounts,2,'.',',')  ;
	    }
	    }
	
	?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td ><span style="font-weight:bolder;"> T.Loan Paid :</span></td>
    <td><?php 	
        include('conn.php'); 
    $sum_loan_paid ="select sum(loan_paid) from loans
	       where emp_id = $emp_id  ";
    $run_sum_loan_paid = mysqli_query($conn, $sum_loan_paid);
	while ($row = mysqli_fetch_array($run_sum_loan_paid))
	{	
       $total_loan_paid =$row[0];		
    
	    if($total_loan_paid != 0)
		{
		   $total_loan_paids = $total_loan_paid ;	
           echo number_format($total_loan_paids,2,'.',',')   ;	
	    }else {
		   $total_loan_paids =0;	
           echo number_format($total_loan_paids,2,'.',',')  ;
	    }
	}
    ?></td><hr width="1" size="500">		
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><span style="font-weight:bolder;"> T.Loan Balance  :</span></td>
    <td>
	<?php 
	    
	include('conn.php'); 
    $sum_loan_bal ="select sum(loan_balance) from loans  
	       where emp_id = $emp_id   ";
    $run_sum_loan_bal = mysqli_query($conn, $sum_loan_bal);
	while ($row = mysqli_fetch_array($run_sum_loan_bal))
	{
        $total_loan_balance =$row[0];		

	    if($total_loan_balance != 0)
		{
		   $total_loan_balances =$total_loan_balance ;	
           echo number_format($total_loan_balances,2,'.',',')   ;	
	    }else {
		   $total_loan_balances = 0 ;	
           echo number_format($total_loan_balances,2,'.',',')  ;
	    }
	}
	
	?>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  
</table> <hr/>
</div> 			
<div class="col-lg-12">			
            <h3 class="panel-title"><span style="font-weight:bolder;"> Personal Details </span></h3> <h3 class="panel-title" style="float:right; margin:-18px 120px 0px 0px ;"><span style="font-weight:bolder;"> Contact Details </span></h3>   <hr>  
  <table width="100%" cellspacing="50">
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Date Of Birth  :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo date("d-M-Y",strtotime($emp_dob)) ; ?></td>
    <td align="right"><span style="font-weight:bolder;"> Email Address :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_email ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;">   Gender  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_gender ; ?></td>
    <td align="right"><span style="font-weight:bolder;"> Mobile  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_mobile ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Maratial Status : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_maratial_status; ?> </td>
    <td align="right"><span style="font-weight:bolder;"> Address : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_present_address; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> <span style="font-weight:bolder;"> Nationality : </span> </td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_nationality ; ?></td>
    <td align="right"> <span style="font-weight:bolder;"> City : </span> </td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_city ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Tin Number  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_tin_number ; ?></td>
    <td align="right"><span style="font-weight:bolder;"> Country  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_country ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> SSNIT Number  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_ssnit_number ; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table> <hr>	
</div>
<div class="col-lg-12">			
            <h3 class="panel-title"> <span style="font-weight:bolder;"> Contact Person (Family Relation) </span></h3> <h3 class="panel-title" style="float:right; margin:-18px 120px 0px 0px ;"><span style="font-weight:bolder;"> Bank Details </span></h3>   <hr>  
  <table width="100%" cellspacing="50">
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Full Name  :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_contact_fullname ; ?></td>
    <td align="right"><span style="font-weight:bolder;"> Bank Name :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $bank_name ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> House Number : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_contact_housenumber ; ?></td>
    <td align="right"><span style="font-weight:bolder;"> Bank Branch  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $bank_branch ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;">  Contact Number : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_contact_mobile; ?> </td>
    <td align="right"><span style="font-weight:bolder;"> Account Name  : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $bank_account_name ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> <span style="font-weight:bolder;"> Occupation  : </span> </td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_contact_occupation ; ?></td>
    <td align="right"> <span style="font-weight:bolder;"> Account Numer  : </span> </td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $bank_account_no ; ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Relationship   : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo $emp_contact_relationshipToEmp ; ?></td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table> 
</div> 

		 
                
			
            
<?php
  }
  }
  ?>					       
	
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
