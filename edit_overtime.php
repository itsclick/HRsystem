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
			     $overtime_id = $_GET['overtime_id'];
				 $update_overtime = " Update overtimes  SET 
				 overtime_date = '$overtime_date',emp_id = '$emp_id',overtime_location ='$overtime_location',basic_salary = '$basic_salary',overtime_time = '$overtime_time',overtime_type = '$overtime_type' ,number_of_hrs_mns_hol = '$number_of_hrs_mns_hol' ,number_of_hrs_mns = '$number_of_hrs_mns', overtime_period = '$overtime_period' ,
				 overtime_paid = '$overtime_paid' where overtime_id = $overtime_id	";
                 
                 $result= mysqli_query($conn,$update_overtime);

                   if($result)
				    {
                       echo  "<script>alert('Update is successfully completed')</script>";
                       echo "<script>window.open('view_overtimes','_self')</script>"; 
                    } else 
				    {		
	                    echo  "<script>alert('Update is not successfully completed')</script>";
				        echo "<script>window.open('view_overtimes','_self')</script>";		         
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
<body onload="load_ReadOnly()">
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
	    
<div class="container">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Overtime </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Edit Overtime </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			     <button class="btn btn-default"><a href="view_overtimes"><i class="glyphicon glyphicon-edit" ></i> Manage Overtime </a></button>
			 
		    </div> 
		    
			<div class="col-lg-12" >
                 <form name="form1" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
				 
		        <div id="container" >	
<?php
if(isset($_REQUEST['overtime_id'])){	
include("conn.php");
$get_overtime_id = $_GET['overtime_id'];
$result = mysqli_query($conn,"select o.overtime_date,o.emp_id,e.emp_fullname,o.overtime_location,o.basic_salary,o.overtime_time,
                        o.overtime_type,o.number_of_hrs_mns_hol,o.number_of_hrs_mns,o.overtime_period,o.overtime_paid                  
						from overtimes o Join employees e on o.emp_id = e.emp_id where overtime_id = $get_overtime_id  ");
while($row=mysqli_fetch_array($result))
	{
		$overtime_date =$row[0];
		$emp_id =$row[1];
		$overtime_location =$row[3];
		$basic_salary =$row[4];
		$overtime_time =$row[5];
		$overtime_type =$row[6];
		$number_of_hrs_mns_hol =$row[7];
		$number_of_hrs_mns =$row[8];
		$overtime_period =$row[9];
		$overtime_paid =$row[10];
		$emp_fullname =$row[2];
	    	


?>
		<div class="form-group">
	        	<label for="emp_id" class="col-sm-3 control-label">Employee Full Name <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">					 
				      <select class="form-control" id="select_emp" name="emp_id"  required  onchange="getBasicSalary() " >
					    <option value="<?php  echo $emp_id ; ?>	"><?php  echo $emp_fullname; ?>	</option>	  
				      </select>
					</div>									 
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_date" class="col-sm-3 control-label">Overtime Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"   id="overtime_date" value ="<?php echo $overtime_date ; ?> " placeholder="Enter Pay Date" name="overtime_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="overtime_location" class="col-sm-3 control-label">Place And Duty  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <textarea type="text" class="form-control"  id="overtime_location" value="" placeholder="Enter Place & Duty During Overtime " name="overtime_location" autocomplete="off"  ><?php  echo $overtime_location ; ?></textarea>
				    </div>
	        </div> <!-- /form-group-->						
			<div class="form-group">
	        	<label for="basic_salary" class="col-sm-3 control-label">Basic Salary <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="basic_salary" value="<?php  echo $basic_salary ; ?>"  onkeypress="isInputNumber(event)" name="basic_salary" autocomplete="off" >				    
					</div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_time" class="col-sm-3 control-label">Overtime Time <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="overtime_time" name="overtime_time" required >
				      	<option value="<?php  echo $row[5]; ?>	"><?php  echo $overtime_time ; ?></option>
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
				      	<option value="<?php  echo $row[6]; ?>"><?php  echo $overtime_type ; ?></option>
				      	<option value="Working Days">Working Days</option>
                        <option value="Holidays/WeekEnd">Holidays/WeekEnd</option>
						<option value="Both">Both</option>
				      </select>	
					</div>			
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="number_of_hrs_mns" class="col-sm-3 control-label">WorkingDays hrs/mns  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="number_of_hrs_mns"  value="<?php  echo $number_of_hrs_mns ; ?>"  onkeypress="isInputNumber(event)" name="number_of_hrs_mns" autocomplete="off" onfocusout="getOvertime_paid( )">				    
					</div>
	        </div> <!-- /form-group-->			
            <div id="showHiddenField" class="form-group" >
	        	<label for="number_of_hrs_mns_hol" class="col-sm-3 control-label">Holidays/WeekEnd hrs/mns <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="number_of_hrs_mns_hol"  value="<?php  echo $number_of_hrs_mns_hol ; ?>"	 onkeypress="isInputNumber(event)" name="number_of_hrs_mns_hol" autocomplete="off" onfocusout="myFunction()">				    
					</div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="overtime_period" class="col-sm-3 control-label">Overtime Period  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="overtime_period" value="<?php  echo $overtime_period ; ?>	"   name="overtime_period" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->		
			<div class="form-group">
	        	<label for="overtime_paid" class="col-sm-3 control-label">Overtime Payable  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="overtime_paid"  value="<?php  echo $overtime_paid ; ?>	"  onkeypress="isInputNumber(event)" readonly name="overtime_paid" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="submit" class="col-sm-3 control-label"></label>
	        	<label class="col-sm-1 control-label"></label>
				    <div class="col-sm-8">
				    <button type="submit" name="submit" class="btn btn-success" style="width:300px; margin-left:430px;">Save</button>	  
				    </div>
	        </div> <!-- /form-group-->	
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
	
	
</div>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.structure.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.theme.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script>
 $(document).ready(function() 
{
	var e = document.getElementById("overtime_type") ;
	var overtime_type = e.options[e.selectedIndex].text;

	if(overtime_type == "Working Days")
	{
		$("#number_of_hrs_mns").attr('readonly', false) ;
		$("#number_of_hrs_mns_hol").attr('readonly', true) ;	           
		 document.getElementById("number_of_hrs_mns_hol").value = "";		 
		 
    } else if(overtime_type == "Holidays/WeekEnd") 
	{		
		 $("#number_of_hrs_mns").attr('readonly', true) ;
		 $("#number_of_hrs_mns_hol").attr('readonly', false) ;
         document.getElementById("number_of_hrs_mns").value = "";		 		 
	
    } else if(overtime_type == "Both") {
		
		$("#number_of_hrs_mns").attr('readonly', false) ; 
		$("#number_of_hrs_mns_hol").attr('readonly', false) ;
		
	} else {
		
		alert("Kindly select type of overtime.");
		
	}
	
}); 
// When is Both 
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
 

//Input Text Allow Only Numbers
 function isInputNumber(evt){
                
    var ch = String.fromCharCode(evt.which);
                
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }
                
    }
// datepicker code
$(document).ready(function() 
{	
$("#overtime_date").datepicker({
	dateFormat:"yy-mm-dd",
	showOtherMonths: true , changeMonth: true });

$("#overtime_period").datepicker({
	dateFormat:"yy MM ",
	showOtherMonths: true , changeMonth: true });
		
});

// calculating overtime
$(document).ready(function() 
{
   $('#number_of_hrs_mns').blur(function(){
	   var basicsalary = document.getElementById("basic_salary").value ;
	   var t = document.getElementById("overtime_time") ;
	   var overtime_time = t.options[t.selectedIndex].text;
	   var e = document.getElementById("overtime_type") ;
	   var overtime_type = e.options[e.selectedIndex].text;
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
	   var t = document.getElementById("overtime_time") ;
	   var overtime_time = t.options[t.selectedIndex].text; 
	   var e = document.getElementById("overtime_type") ;
	   var overtime_type = e.options[e.selectedIndex].text;
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
	   var t = document.getElementById("overtime_time") ;
	   var overtime_time = t.options[t.selectedIndex].text;
	   var e = document.getElementById("overtime_type") ;
	   var overtime_type = e.options[e.selectedIndex].text;
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
	
	$('#overtime_type').change(function(){
	   var basicsalary = document.getElementById("basic_salary").value ;
	   var t = document.getElementById("overtime_time") ;
	   var overtime_time = t.options[t.selectedIndex].text; 
	   var e = document.getElementById("overtime_type") ;
	   var overtime_type = e.options[e.selectedIndex].text;
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
