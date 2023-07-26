<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php 
        if(isset($_POST['submit']))				
			{
				                   
				//holding data from the user form				
                $overtime_date = $_POST['overtime_date'];
                $emp_id = $_POST['emp_id'];
				$overtime_location = $_POST['overtime_location'];
                $basic_salary = $_POST['basic_salary'];
                $overtime_time = $_POST['overtime_time'];
                $overtime_type = $_POST['overtime_type'];
                $number_of_hrs_mns_hol = $_POST['number_of_hrs_mns_hol'];
                $number_of_hrs_mns = $_POST['number_of_hrs_mns'];
                $overtime_period = $_POST['overtime_period'];
                $overtime_paid = $_POST['overtime_paid'];

                 //inserting data
				 include ('conn.php');
				 
				 $insert_overtime = " insert into overtimes (overtime_date,emp_id,overtime_location,basic_salary,overtime_time,overtime_type,number_of_hrs_mns_hol,number_of_hrs_mns,
				 overtime_period,overtime_paid)				 
                 values ('$overtime_date','$emp_id','$overtime_location','$basic_salary','$overtime_time','$overtime_type','$number_of_hrs_mns_hol','$number_of_hrs_mns',
				 '$overtime_period','$overtime_paid')";
                 
                 $result= mysqli_query($conn,$insert_overtime);

                   if($result)
				    {
                       echo  "<script>alert('insert is successfully completed')</script>";
                       echo "<script>window.open('overtimes','_self')</script>"; 
                    } else 
				    {		
	                    echo  "<script>alert('insert is not successfully completed')</script>";
				        echo "<script>window.open('overtimes','_self')</script>";		         
                    }
            }	

    
?>

<html>
<head>
<title>My Training Program</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="assets/jqueryui/jquery-ui.css">


<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/buttons.dataTables.min.css">


<script type="text/javascript" src="datatable/js/jquery.min.js"></script>
<script type="text/javascript" src="datatable/js/jquery.dataTables.min.js"></script>   
<script type="text/javascript" src="datatable/js/jquery.tabledit.min.js"></script>
<script type="text/javascript" src="datatable/js/jszip.min.js"></script>
<script type="text/javascript" src="datatable/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="datatable/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="datatable/js/pdfmake.min.js"></script>
<script type="text/javascript" src="datatable/js/buttons.print.min.js"></script>

<script> 
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
				 <li id="manageOrder"><a href="acc_view_leaves"><i class="glyphicon  glyphicon-th-list "></i> View Leave </li> </a>
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
				 <li id="addOrder"><a href="acc_view_awards"><i class="glyphicon  glyphicon-th-list "></i> View Award </li> </a>
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
	    
<div class="container">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Overtime </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Overtime </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			     <button class="btn btn-default"><a href="acc_view_overtimes"><i class="glyphicon glyphicon-edit" ></i> Manage Overtime </a></button>
			 
		    </div> 
		    
			<div class="col-lg-12" >
                 <form name="form1" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
				 
		    <div id="container" >		
		    <div class="form-group">
	        	<label for="emp_id" class="col-sm-3 control-label">Employee Full Name <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">					 
				      <select class="form-control" id="select_emp" name="emp_id"  required >
					    <option value="">~~ SELECT Employee Full Name ~~</option>
                        <?php  echo load_employees(); ?>		  
				      </select>
					</div>									 
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_date" class="col-sm-3 control-label">Overtime Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"   id="overtime_date"  required placeholder="Enter Pay Date" name="overtime_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="overtime_location" class="col-sm-3 control-label">Place And Duty  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <textarea type="text" class="form-control"  id="overtime_location" required placeholder="Enter Place & Duty During Overtime " name="overtime_location" autocomplete="off"  ></textarea>
				    </div>
	        </div> <!-- /form-group-->						
			<div class="form-group">
	        	<label for="basic_salary" class="col-sm-3 control-label">Basic Salary <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="basic_salary" placeholder="Enter Basic Salary" name="basic_salary" autocomplete="off" >				    
					</div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_time" class="col-sm-3 control-label">Overtime Time <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="overtime_time" name="overtime_time" required >
				      	<option value="">~~ SELECT overtime time ~~</option>
				      	<option value="Hours">Hours</option>
                        <option value="Minutes">Minutes</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_type" class="col-sm-3 control-label">Overtime Type  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="overtime_type" name="overtime_type" required onchange="Activate_ReadOnly()" >
				      	<option value="">~~ SELECT Overtime Type ~~</option>
				      	<option value="Working Days">Working Days</option>
                        <option value="Holidays/WeekEnd">Holidays/WeekEnd</option>
						<option value="Both">Both</option>
				      </select>	
					</div>					
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="number_of_hrs_mns" class="col-sm-3 control-label">Number Of hrs/mns  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="number_of_hrs_mns" required placeholder="Enter number of hours or minutes for workingDays" name="number_of_hrs_mns" autocomplete="off" onfocusout="getOvertime_paid( )">				    
					</div>
	        </div> <!-- /form-group-->
            <div id="showHiddenField" class="form-group" >
	        	<label for="number_of_hrs_mns_hol" class="col-sm-3 control-label">Number Of hrs/mns <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="number_of_hrs_mns_hol" required placeholder="Enter number of hours or minutes for WeekEnd/holidays   " name="number_of_hrs_mns_hol" autocomplete="off" onfocusout="myFunction()">				    
					</div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="overtime_period" class="col-sm-3 control-label">Overtime Period  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="overtime_period" required placeholder="Enter Overtime Period" name="overtime_period" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->		
			<div class="form-group">
	        	<label for="overtime_paid" class="col-sm-3 control-label">Overtime Payable  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="overtime_paid" placeholder="Overtime payable" readonly name="overtime_paid" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="submit" class="col-sm-3 control-label"></label>
	        	<label class="col-sm-1 control-label"></label>
				    <div class="col-sm-8">
				    <button type="submit" name="submit" class="btn btn-success" style="width:300px; margin-left:430px;">Save</button>	  
				    </div>
	        </div> <!-- /form-group-->	   						
		        </div> 
				
             </form>
		   
                </div> 
			
			
    	
		   
		   </div>
		   </div>
		
      
    </div>
	
	
</div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.structure.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.theme.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script>
function Activate_ReadOnly()
 {
	if($("#overtime_type").val() == "Working Days")
	{
		 $("#number_of_hrs_mns_hol").attr('readonly', true) ;	 
         $("#number_of_hrs_mns").attr('readonly', false) ;  
		 document.getElementById("number_of_hrs_mns_hol").value = "";		 
		 
    } else if($("#overtime_type").val() == "Holidays/WeekEnd") 
	{		
		 $("#number_of_hrs_mns").attr('readonly', true) ;
		 $("#number_of_hrs_mns_hol").attr('readonly', false) ;
         document.getElementById("number_of_hrs_mns").value = "";		 		 
	
    } else if($("#overtime_type").val() == "Both") {
		
		$("#number_of_hrs_mns").attr('readonly', false) ; 
		$("#number_of_hrs_mns_hol").attr('readonly', false) ;
		
	} else {
		
		alert("Kindly select type of overtime.");
		
	}
 }	
 
// datepicker code
$(document).ready(function() 
{	
$("#overtime_date").datepicker({
	dateFormat:"yy-mm-dd",
	showOtherMonths: true , changeMonth: true});

$("#overtime_period").datepicker({
	dateFormat:"yy-MM",
	showOtherMonths: true , changeMonth: true
	
	});

});
 
 // getting basic salary from emp table
$(document).ready(function() 
{
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_salary.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#basic_salary').val(data);

                  }
              });
		  
         
		}	else { 		     
		     alert("Please select employee");
		}
     });
 });

$(document).ready(function() 
{
   $('#number_of_hrs_mns').blur(function(){
	   var basicsalary = document.getElementById("basic_salary").value ;
	   var overtime_time = document.getElementById("overtime_time").value ; 
	   var overtime_type = document.getElementById("overtime_type").value ; 
       var number_of_hrs_mns = document.getElementById("number_of_hrs_mns").value ;	   
	   var number_of_hrs_mns_hol = document.getElementById("number_of_hrs_mns_hol").value ;  
	   var overtime = 0 ;
	   
	   if(overtime_time == "Hours" && overtime_type == "Working Days" ){
	         overtime = (basicsalary/26)/9 * number_of_hrs_mns * 1.5 ;
	    } else if(overtime_time == "Hours" && overtime_type == "Holidays/WeekEnd" ){
		     overtime = (basicsalary/26)/9 * number_of_hrs_mns_hol * 2 ; 
	    } else if(overtime_time == "Hours" && overtime_type == "Both" ){   
		     var overtime_mns = ((basicsalary/26)/9) * number_of_hrs_mns * 1.5 ;
		     var overtime_mns_hol  = ((basicsalary/26)/9) * number_of_hrs_mns_hol * 2 ;
			     overtime   = overtime_mns + overtime_mns_hol;	
		} else if(overtime_time == "Minutes" && overtime_type == "Working Days" ){
                 overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Holidays/WeekEnd" ){
			     overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Both" ){
			var overtime_mns = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		    var overtime_mns_hol   = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
			var overtime       = overtime_mns + overtime_mns_hol;
		} 
		
	    document.getElementById("overtime_paid").value = overtime.toFixed(2) ;  
	  
   });
   
   $('#select_emp').blur(function(){
	   	   var basicsalary = document.getElementById("basic_salary").value ;
	   var overtime_time = document.getElementById("overtime_time").value ; 
	   var overtime_type = document.getElementById("overtime_type").value ; 
       var number_of_hrs_mns = document.getElementById("number_of_hrs_mns").value ;	   
	   var number_of_hrs_mns_hol = document.getElementById("number_of_hrs_mns_hol").value ;  
	   var overtime = 0 ;
	   
	   if(overtime_time == "Hours" && overtime_type == "Working Days" ){
	         overtime = (basicsalary/26)/9 * number_of_hrs_mns * 1.5 ;
	    } else if(overtime_time == "Hours" && overtime_type == "Holidays/WeekEnd" ){
		     overtime = (basicsalary/26)/9 * number_of_hrs_mns_hol * 2 ; 
	    } else if(overtime_time == "Hours" && overtime_type == "Both" ){   
		     var overtime_mns = ((basicsalary/26)/9) * number_of_hrs_mns * 1.5 ;
		     var overtime_mns_hol  = ((basicsalary/26)/9) * number_of_hrs_mns_hol * 2 ;
			     overtime   = overtime_mns + overtime_mns_hol;	
		} else if(overtime_time == "Minutes" && overtime_type == "Working Days" ){
                 overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Holidays/WeekEnd" ){
			     overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Both" ){
			var overtime_mns = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		    var overtime_mns_hol   = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
			var overtime       = overtime_mns + overtime_mns_hol;
		} 
		
	    document.getElementById("overtime_paid").value = overtime.toFixed(2) ;  
    });
	
	$('#number_of_hrs_mns_hol').blur(function(){
	   	   var basicsalary = document.getElementById("basic_salary").value ;
	   var overtime_time = document.getElementById("overtime_time").value ; 
	   var overtime_type = document.getElementById("overtime_type").value ; 
       var number_of_hrs_mns = document.getElementById("number_of_hrs_mns").value ;	   
	   var number_of_hrs_mns_hol = document.getElementById("number_of_hrs_mns_hol").value ;  
	   var overtime = 0 ;
	   
	   if(overtime_time == "Hours" && overtime_type == "Working Days" ){
	         overtime = (basicsalary/26)/9 * number_of_hrs_mns * 1.5 ;
	    } else if(overtime_time == "Hours" && overtime_type == "Holidays/WeekEnd" ){
		     overtime = (basicsalary/26)/9 * number_of_hrs_mns_hol * 2 ; 
	    } else if(overtime_time == "Hours" && overtime_type == "Both" ){   
		     var overtime_mns = ((basicsalary/26)/9) * number_of_hrs_mns * 1.5 ;
		     var overtime_mns_hol  = ((basicsalary/26)/9) * number_of_hrs_mns_hol * 2 ;
			     overtime   = overtime_mns + overtime_mns_hol;	
		} else if(overtime_time == "Minutes" && overtime_type == "Working Days" ){
                 overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Holidays/WeekEnd" ){
			     overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Both" ){
			var overtime_mns = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		    var overtime_mns_hol   = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
			var overtime       = overtime_mns + overtime_mns_hol;
		} 
		
	    document.getElementById("overtime_paid").value = overtime.toFixed(2) ;  
    });
	
	$('#overtime_type').blur(function(){
	   	   var basicsalary = document.getElementById("basic_salary").value ;
	   var overtime_time = document.getElementById("overtime_time").value ; 
	   var overtime_type = document.getElementById("overtime_type").value ; 
       var number_of_hrs_mns = document.getElementById("number_of_hrs_mns").value ;	   
	   var number_of_hrs_mns_hol = document.getElementById("number_of_hrs_mns_hol").value ;  
	   var overtime = 0 ;
	   
	   if(overtime_time == "Hours" && overtime_type == "Working Days" ){
	         overtime = (basicsalary/26)/9 * number_of_hrs_mns * 1.5 ;
	    } else if(overtime_time == "Hours" && overtime_type == "Holidays/WeekEnd" ){
		     overtime = (basicsalary/26)/9 * number_of_hrs_mns_hol * 2 ; 
	    } else if(overtime_time == "Hours" && overtime_type == "Both" ){   
		     var overtime_mns = ((basicsalary/26)/9) * number_of_hrs_mns * 1.5 ;
		     var overtime_mns_hol  = ((basicsalary/26)/9) * number_of_hrs_mns_hol * 2 ;
			     overtime   = overtime_mns + overtime_mns_hol;	
		} else if(overtime_time == "Minutes" && overtime_type == "Working Days" ){
                 overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Holidays/WeekEnd" ){
			     overtime = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
		} else if (overtime_time == "Minutes" && overtime_type == "Both" ){
			var overtime_mns = (((basicsalary/26)/9)/60) * number_of_hrs_mns * 1.5 ;
		    var overtime_mns_hol   = (((basicsalary/26)/9)/60) * number_of_hrs_mns_hol * 2 ;
			var overtime       = overtime_mns + overtime_mns_hol;
		} 
		
	    document.getElementById("overtime_paid").value = overtime.toFixed(2) ;  
    });
	
 });
 
</script>   
</body>
</html>
