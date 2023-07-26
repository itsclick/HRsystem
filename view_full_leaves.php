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
<link rel="stylesheet" type="text/css" href="assets/jqueryui/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">




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
				 
				 <a href="#" class="drop-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
				 
				 <ul class="dropdown-menu">
				 <li id="addSetting"><a href="setting?comp_id=$comp_id"><i class="glyphicon glyphicon-wrench "></i> Setting </li> </a>
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
		  <li class="Active">Leave Form </li>
		
		</ol>
		<div class="panel panel-default">
		    <div class="panel-heading">
		    <div class="page-heading"><button id="display_span" ><i class="glyphicon glyphicon-plus"></i> Customize Report </button> </div>
		    </div>		   
		    <div class="panel-body" id="show_pannel" style="display:none;">
		      <div class="col-lg-12" >
                <form name="form1" class="form-inline" role="form" method="post" action="leaves_full_reports">
		          <div id="container" >		       
		            <div class="form-group">
                    <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Enter Start Date"  required  style="width:300px;"/>
                    </div>
					<div class="form-group">
                    <input type="text" class="form-control" id="endDate" name="endDate" placeholder="Enter End Date "  required  style="width:300px;"/>
                    </div>
				    <button type="submit" name="search" class="form-control  btn btn-success" style="width:100px;" > GO </button>	
            
		          </div> 
                	
                </form>
              </div> 		   
		    </div>
		</div>       
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-th-list"></i> Manage Leave </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px;">
			  
			     <button class="btn btn-default"><a href="leaves"><i class="glyphicon glyphicon-plus-sign" ></i> Add Leave </a></button>
			 
		    </div>   

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>						
					<th>SN</th>
                    <th>Employee Name</th>					
					<th>Head Of Department</th>
					<th>Start Date</th>
					<th>End Date </th>
					<th>Total Days </th>
					<th>Resumption Date</th>
					<th>Type Of Leave</th>
					<th>Reason Code </th>		
					<th style="width:15%;">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
	include('conn.php'); 
    $i = 0;	
	$result = mysqli_query($conn,"select l.leave_form_id,l.emp_id,e.emp_fullname,l.head_dep_id,h.HeadOfDepartment,d.dep_name,l.start_date,l.end_date,l.total_days,
	    l.resumption_date,l.leave_id,t.leave_types ,t.reason_id,r.reason_name,l.reason_explanation,l.contact_number,l.Officer_taken_over from leave_form l 
		Join employees e on l.emp_id = e.emp_id 
		Join headOfDepartments h on l.head_dep_id = h.head_dep_id 
		Join departments d on h.dep_id = d.dep_id 
		Join leave_types t on l.leave_id = t.leave_id 
		Join reason_codes r on t.reason_id = r.reason_id 
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
                <td><?php echo $i ; ?></td>	             
				<td><?php echo $emp_fullname ; ?></td>
                <td><?php echo $headOfDepartment ; ?></td>
                <td><?php echo date("d-M-Y",strtotime($start_date)) ; ?></td>
				<td><?php echo date("d-M-Y",strtotime($end_date)); ?></td>
                <td align="center"><?php echo $total_days ; ?></td>
				<td><?php echo date("d-M-Y",strtotime($resumption_date));  ?></td>				                
				<td><?php echo $leave_types ; ?></td>			
				<td><?php echo $reason_name ; ?></td>		
	<td> <?php echo " <a  title ='Print'  href='emp_leaves_report?emp_id=$emp_id' class='label label-info'><i class='glyphicon glyphicon-print'> Print</i></a>" ?> | <?php echo "<a href='edit_leave_form?leave_form_id=$leave_form_id' class='label label-primary'><i class='glyphicon glyphicon-edit'> Edit</i></a>" ?> | <?php echo "<a href='delete_leave_form?leave_form_id=$leave_form_id' class='label label-danger'><i class='glyphicon glyphicon-trash'> Delete</i></a>" ?> </td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>						
					<th>SN</th>
                    <th>Employee Name</th>					
					<th>Head Of Department</th>
					<th>Start Date</th>
					<th>End Date </th>
					<th>Total Days </th>
					<th>Resumption Date</th>
					<th>Type Of Leave</th>
					<th>Reason Code </th>	
					<th style="width:15%;">Options</th>
			   </tr>
			
              </tfoot>
	
    </table>
	
	</div>
		   
		   

        </div>
      
    </div>
	
	
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>



<script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>   


<script type="text/javascript" src="assets/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.structure.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.theme.js"></script>

   
<script>
$(document).ready(function() {
	$('#display_span').click(function(){		
       $('#show_pannel').toggle();
	});
	
});	

$(document).ready(function() {
    $('#example').DataTable( {} );
	$(document).tooltip();
} );

// GETTING DATEPICKER
$(document).ready(function() {
	$("#startDate").datepicker({
		dateFormat:"yy-mm-dd",
		showOtherMonths: true , changeMonth: true});
	$("#endDate").datepicker({
		dateFormat:"yy-mm-dd",
		showOtherMonths: true , changeMonth: true});
} );
</script>  
</body>
</html>
