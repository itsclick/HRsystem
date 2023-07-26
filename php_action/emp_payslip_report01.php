<?php

if(isset($_REQUEST['emp_id'])){
include('conn.php'); 
$emp_id=$_GET['emp_id'];  
$query =  "SELECT p.pay_id,p.pay_date,p.emp_id,p.basic_salary,p.leave_paid,p.overtime_paid,p.sales_commission,
p.perdiem,p.other_benefits,p.ssnit,p.paye,p.loan_paid,p.advance_taken,p.unpaid_leave,p.lateness,p.welfare,
p.other_deductions,p.total_earnings,p.total_deductions,p.net_salary,e.emp_fullname,e.emp_code,e.bank_name,
e.bank_branch,e.bank_account_no,e.position_id,e.head_dep_id,e.emp_photo,e.annual_leave
from   payroll p 
join employees e
on e.emp_id = p.emp_id
where p.emp_id =$emp_id 
ORDER BY p.pay_date DESC
LIMIT 1 ";		
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
$pay_id = $row[0];
$pay_date = $row[1];
$pay_id = $row[2];
$basic_salary = $row[3];
$leave_paid = $row[4];
$overtime_paid = $row[5];
$sales_commission = $row[6];
$perdiem = $row[7];
$other_benefits = $row[8];	
$ssnit = $row[9]; 
$paye = $row[10]; 
$loan_paid = $row[11];
$advance_taken = $row[12];
$unpaid_leave = $row[13];
$lateness = $row[14];
$welfare = $row[15];
$other_deductions = $row[16];
$total_earnings = $row[17];
$total_deductions = $row[18];
$net_salary = $row[19];
//employee details starts here
$emp_fullname = $row[20];
$emp_code = $row[21];
$bank_name = $row[22];
$bank_branch = $row[23];
$bank_account_no = $row[24];
$position_id = $row[25];
$head_dep_id = $row[26];
$emp_photo = $row[27];
$annual_leave = $row[28];

// $total_earnings = $basic_salary + $leave_paid + $overtime_paid + $sales_commission + $perdiem + $other_benefits ;	
// $total_deductions = $ssnit + $paye + $loan_paid + $advance_taken + $unpaid_leave + $lateness + $welfare + $other_deductions ;
// $net_salary = $total_earnings - $total_deductions ;	

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
<title>KUO FIRE SAFETY</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- SystemTime -->
<script type="text/javascript" src="js/date_time.js"></script> 


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
  
  <!-- table formating-->
.center { text-align: center; }

table { border-collapse: collapse;
        width: 70%; 
        margin: auto;
}

th { padding: 0 5em 0 0.5em;
     background-color: #ffc;
     border-top: 1px solid #FB7A31;
     border-bottom: 1px solid #FB7A31;
 }

td { border-bottom: 1px solid #CCC; 
     padding: 0 5em 0 0.5em;
}

caption { font-size:  1.2em; font-weight: bold;}

#total { font-weight: bold; background-color: #CCC;}
 }
</style>

</head>
<body onLoad="date_time('date_time');">
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
    <div class="logo" style="margin-top:20px;"> <img src="logo/kuo_logo.png" width="130" height="110"/> </div>
	<div class="heading"><h4 class="text-center"> KUO FIRE SAFETY LIMITED </h4>
    <h5 class="text-center"> 368/2 Watson Ave. Adabraka </br> <h4 class="text-center"> Payslip -  <?php echo date("F , Y",strtotime($pay_date)) ; ?> </h4> </h5> 
    </div> 
	<h3 class="panel-title"><i><span style="font-weight:; float:right; margin-top:10px" id="date_times">Printed : <?php echo date("d M Y H:i:s") ; ?> </span></i></h3>
	</div></br> <hr>
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
                    <td width="186" align="right" > <span style="font-weight:bolder;"> Designation : </span> </td>
                    <td width="7">&nbsp;</td>
                    <td width="407"><?php echo $pos_name ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>                 
                  <tr>
                    <td height="0.5%">&nbsp;</td>
                    <td width="186" align="right" ><span style="font-weight:bolder;"> Bank Details : </span></td>
                    <td width="7">&nbsp;</td>
                    <td width="407"><?php echo $bank_account_no." , ". $bank_name." , ". $bank_branch."." ; ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				</table> <hr>			   
			</div> 
<div class="col-lg-12">			
        <!-- <h3 class="panel-title"><span style="font-weight:bolder;"> Leave Info </span></h3> <hr> -->  
  <table width="100%" cellspacing="50" style="margin-top:-25px;">
  <tr>
    <td><span style="font-weight:bolder;"> Annual Leave :</span></td>
    <td><?php echo  $annual_leave  ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td ><span style="font-weight:bolder;"> Leave Days Taken :</span></td>
    <td><?php 
	// pos_name
	include('conn.php');
	$emp_id=$_GET['emp_id']; 
    $count_days ="select sum(total_days) from leave_form 
	       where emp_id = $emp_id and  leave_id = 1  ";
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
    <td>
	<?php 
	$leave_balance =  $annual_leave - $total_days  ;
	echo $leave_balance ; 
	?>
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  
</table> <hr/>
</div> 			
<div class="col-lg-12">			
   <h3 class="panel-title"><span style="font-weight:bolder;"> Earnings </span></h3> <h3 class="panel-title" style="float:right; margin:-16px 120px 0px 0px ;"><span style="font-weight:bolder;"> Deductions </span></h3>   <hr>  
  <table width="100%" cellspacing="50" style="margin-top:-10px;">
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Basic Salary :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($basic_salary,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> SSNIT @ 5.5% :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($ssnit,2,'.',',')  ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;">Leave Paid : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($leave_paid ,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> PAYE : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($paye,2,'.',',')  ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Overtime Paid : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($overtime_paid,2,'.',',') ;  ?> </td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> Loan Paid : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($loan_paid,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"> <span style="font-weight:bolder;">Sales Commission :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($sales_commission,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"> <span style="font-weight:bolder;"> Advance Taken : </span> </td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($advance_taken,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Perdiem : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($perdiem,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> Unpaid Leave : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($unpaid_leave,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> Other Benefits : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($other_benefits,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> Lateness : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($lateness,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php  ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> Welfare : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($welfare,2,'.',',') ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr> 
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><span style="font-weight:bolder;"> </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php  ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> Other Deductions : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo number_format($other_deductions,2,'.',',') ; ?></td> 
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>	 
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr> 
  </table> <hr>
  <table width="100%" cellspacing="50"  style="margin-top:-10px;">
  <tr> 
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;">Total Earnings :</span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo "<span style='font-weight:bolder; background-color: #CCC;'>".number_format($total_earnings,2,'.',',') ."</span>" ;  ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> Total Deductions : </span></td> 
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo "<span style='font-weight:bolder; background-color: #CCC;'>".number_format($total_deductions,2,'.',',') ."</span>" ;  ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>  
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;" > Net Salary : </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo "<span style='font-weight:bolder; background-color: #CCC;'>GH¢".' '.number_format($net_salary,2,'.',',') ."</span>" ;  ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  </table>
  <table width="100%" cellspacing="50"  style="margin-top:-10px;">
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr> 
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"></span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php echo "<span style='font-weight:bolder;'>  </span>" ; ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td align="right"><span style="font-weight:bolder;">for KUO FIRE SAFETY LTD </span></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr> 
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr> 
  
  <tr>
	<td>&nbsp;</td>  
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;"> </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><?php ?></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td align="right"><span style="font-weight:bolder;" > </span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
	<td align="right">Authorised Signatory</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
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
