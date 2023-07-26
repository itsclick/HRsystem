<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
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
    <h4 class="text-center"><span style='font-weight:bolder; margin-left:0px;'> List Of Employees Report</span></h4>	</div> 
	<h3 class="panel-title"><i><span style="font-weight:; float:right; margin-top:10px" id="date_times">Printed : <?php echo date("d M Y H:i:s") ; ?> </span></i></h3>	
	</div></br> <!-- <hr>-->
<div class="container-fluid">
<div class="row">	
<table class="display nowrap"  border= " 1px solid rgb(255,232,57)  " style=" margin:20px -50px 0px 20px; width: 900px; ">
    
    <thead align="center" >
			<tr>						
					<th><span style='margin:0px 10px auto; '>SN </span></th>
					<th><span style='margin:0px 10px auto;'>Full Name  </span></th>
					<th><span style='margin:0px 10px auto;'>Gender </span> </th>					
					<th><span style='margin:0px 10px auto;'>Nationality </span> </th>
                    <th><span style='margin:0px 10px auto;'>SSNIT No </span></th>
					<th><span style='margin:0px 10px auto;'>Mobile </span></th>
					<th><span style='margin:0px 10px auto;'>E-mail Address </span> </th>					
					<th><span style='margin:0px 10px auto;'>Cont. Per. Mobile </span></th>					

			</tr>
	</thead>
	<tbody>
 <?php
include('conn.php'); 
$i = 0; 
$query =  "SELECT * from employees ";		
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
$i++ ;

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
            ";
    $run_pos = mysqli_query($conn, $get_pos);
    while ($row_pos = mysqli_fetch_array($run_pos)){
    $position_id =$row_pos[0];
    $pos_name =$row_pos[1];

}
// dep_name
$get_dep ="select e.head_dep_id,h.dep_id,h.HeadOfDepartment,d.dep_name from employees e             
		   join headOfDepartments h on e.head_dep_id=h.head_dep_id 
		   join departments d on h.dep_id=d.dep_id ";		
	$run_dep = mysqli_query($conn, $get_dep);
	while ($row_dep = mysqli_fetch_array($run_dep)){
	$head_dep_id=$row_dep[0];
	$dep_id =$row_dep[1];
	$HeadOfDepartment =$row_dep[2];
	$dep_name =$row_dep[3];
}
	
?>	     
	        
            <tr width="100%">   
                <td align="center"><?php echo $i ; ?></td>	 			
                <td align=""><?php echo "<span style=' margin-left:5px;'>".$emp_fullname. "</span>" ;?></td>									
				<td align=""><?php echo "<span style=' margin-left:5px;'>". $emp_gender  . "</span>" ; ?></td>				                 
				<td align=""><?php echo "<span style=' margin-left:5px;'>". $emp_nationality   . "</span>" ; ?></td>					
                <td align="center"><?php echo $emp_ssnit_number ; ?></td>	 			
                <td align="center"><?php echo $emp_mobile ; ?></td>									
				<td align=""><?php echo "<span style=' margin-left:5px;'>". $emp_email  . "</span>" ; ?></td>				                 				
				<td align="center"><?php echo "<span style=' margin-left:5px;'>". $emp_contact_mobile . "</span><br/><br/>" ; ?></td>				
 				
           </tr> 
		  
 <?php
  }
  ?>	  	   
    </tbody>
</table>					      
 </div> 	    
 </div> 	    
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
