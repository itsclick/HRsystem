<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<html>
<head>
<title>Payroll Management System </title>
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
		  <li class="Active">Payroll </li>
		
		</ol>
        <div class="panel panel-default">
		    <div class="panel-heading">
		      <div class="page-heading"><button id="display_span" ><i class="glyphicon glyphicon-plus"></i> Customize Report </button> </div>
		    </div>		   
		    <div class="panel-body" id="show_pannel" style="display:none;">
		      <div class="col-lg-12" >
                <form name="form1" class="form-inline" role="form" method="post" action="overtimes_reports">
		          <div id="container" >		       
		            <div class="form-group">
					<select class="form-control" id="select_emp" name="emp_id"  required >
					    <option value="">~~ SELECT Employee Full Name ~~</option>
                        <?php  echo load_employees(); ?>		  
				      </select>
                    <input type="date" class="form-control" id="startDate-" name="startDate" placeholder="Enter Start Date"  required  style="width:300px;"/>
                    </div>
					<div class="form-group">
                    <input type="date" class="form-control" id="endDate-" name="endDate" placeholder="Enter End Date "  required  style="width:300px;"/>
                    </div>
				    <button type="submit" name="search" class="form-control  btn btn-success" style="width:100px;" > GO </button>	
            
		          </div> 
                	
                </form>
              </div> 					  
		    </div>
		</div>       
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-th-list"></i> Manage Overtime </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px;">
			  
			     <button class="btn btn-default"><a href="acc_view_full_overtimes"><i class="glyphicon glyphicon-th-list " ></i> View Full Overtime </a></button>
			 
		    </div>   

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>						
					<th>SN</th>
                    <th>Date</th>					
					<th>Employee Name</th>
					<th>Duty & PLace</th>
					<th>Salary </th>
					<th>Time </th>
					<th>Type Of Overtime</th>
					<th>Periode</th>
					<th>Overtime Paid </th>					
					<th style="width:15%;">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
	include('conn.php'); 
    $i = 0;	
	$result = mysqli_query($conn,"select o.overtime_date,o.emp_id,e.emp_fullname,o.overtime_location,o.basic_salary,o.overtime_time,
                        o.overtime_type,o.number_of_hrs_mns_hol,o.number_of_hrs_mns,o.overtime_period,o.overtime_paid ,o.overtime_id                 
						from overtimes o Join employees e on o.emp_id = e.emp_id where year(o.overtime_date) = year(now()) ");
    while($row=mysqli_fetch_array($result))
	{
		$overtime_date =$row[0];
		$emp_id =$row['emp_id'];
		$overtime_location =$row[3];
		$basic_salary =$row[4];
		$overtime_time =$row[5];
		$overtime_type =$row[6];
		$number_of_hrs_mns_hol =$row[7];
		$number_of_hrs_mns =$row[8];
		$overtime_period =$row[9];
		$overtime_paid =$row[10];
		$emp_fullname =$row[2];
		$overtime_id = $row[11];
	    	
	    $i++ ;	
        
	?>
            <tr>   
                <td><?php echo $i ; ?></td>	             
				<td><?php echo date("d-M-Y",strtotime($overtime_date)) ; ?></td>
                <td><?php echo $emp_fullname ; ?></td>
                <td><?php echo $overtime_location ; ?></td>
				<td><?php echo number_format($basic_salary,2,'.',',') ; ?></td>
                <td><?php echo $overtime_time ; ?></td>
				<td><?php echo $overtime_type ; ?></td>				                
				<td><?php echo date("M-Y",strtotime($overtime_period)) ; ?></td>			
				<td><?php echo $overtime_paid ; ?></td>
	<td> <?php echo " <a  title ='Overtime list'  href='emp_overtimes_report?emp_id=$emp_id' class='label label-info'><i class='glyphicon glyphicon-print'> Print</i></a>" ?> | <?php echo "<a href='acc_edit_overtime?overtime_id=$overtime_id' class='label label-primary'><i class='glyphicon glyphicon-edit'> Edit</i></a>" ?> | <?php echo "<a href='acc_delete_overtime?overtime_id=$overtime_id' class='label label-danger'><i class='glyphicon glyphicon-trash'> Delete</i></a>" ?> </td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
                    <th>SN</th>
                    <th>Date</th>					
					<th>Employee Name</th>
					<th>Duty & PLace</th>
					<th>Salary </th>
					<th>Time </th>
					<th>Type Of Overtime</th>
					<th>Periode</th>
					<th>Overtime Paid </th>					
					<th style="width:15%;">Options</th>
               </tr>
			
              </tfoot>
	
    </table>
	
	</div>
		   
		   

        </div>
      
    </div>
	
	
</div>
   
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
</script>  
</body>
</html>
