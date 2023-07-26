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
                $emp_id = $_POST['emp_id'];
                $head_dep_id = $_POST['head_dep_id'];
				$start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $total_days = $_POST['total_days'];
                $resumption_date = $_POST['resumption_date'];
                $leave_id = $_POST['leave_id'];
                $reason_explanation = $_POST['reason_explanation'];
                $contact_number = $_POST['contact_number'];
                $Officer_taken_over = $_POST['Officer_taken_over'];
                 //inserting data
				 include ('conn.php');
				 
				 $insert_overtime = " insert into leave_form (emp_id,head_dep_id,start_date,end_date,total_days,resumption_date,leave_id,
				 reason_explanation,contact_number,Officer_taken_over)				 
                 values ('$emp_id','$head_dep_id','$start_date','$end_date','$total_days','$resumption_date','$leave_id',
				 '$reason_explanation','$contact_number','$Officer_taken_over')";
                 
                 $result= mysqli_query($conn,$insert_overtime);

                   if($result)
				    {
                       echo  "<script>alert('insert is successfully completed')</script>";
                       echo "<script>window.open('leaves','_self')</script>"; 
                    } else 
				    {		
	                    echo  "<script>alert('insert is not successfully completed')</script>";
				        echo "<script>window.open('leaves','_self')</script>";		         
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
		  <li class="Active">Leave </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Leave </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			     <button class="btn btn-default"><a href="view_leaves"><i class="glyphicon glyphicon-edit" ></i> Manage Leave </a></button>
			 
		    </div> 
		    
			<div class="col-lg-12" >
            
			<form name="form1"  id="update_form"  class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
		    <div class="form-group">
                    <div class="col-sm-4">					 
					</div>	        
				    <div class="col-sm-4">					 
				    <p id="message" class="label label-success"></p> 
					</div>									 
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="annual_leave" class="col-sm-3 control-label">Annual Leaves <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-2">
				      <input type="number" class="form-control" required id="annual_leave" readonly value= " " placeholder=" Annual Leave   " name="annual_leave" autocomplete="off"  >
				    </div>
					<div class="col-sm-2">
				      <input type="number" class="form-control" required id="sick_leave" readonly value= " " placeholder=" Sick Leave   " name="sick_leave" autocomplete="off"  >
				    </div>
					<div class="col-sm-2">
				      <select class="form-control" id="year" name="year" required  readonly >
					  <option value=""> Select Year </option>
				      	<?php
						    for ($i=2018 ; $i <= 3000 ; $i++ )
	                          {	
	                              echo "<option value='$i'>$i</option>" ;				
                              }                    
						?>
				      </select>
					</div>
					<div class="col-sm-2">
                    <input  type="checkbox" id="checkbox" onchange="Activate_ReadOnly()" name="checkbox" /> Activate					  
				    </div>
					<div class="col-sm-8">
				    <button type="submit" name="update" id="update" class="btn btn-success" style="width:138px; margin:15px 900px ;">Update</button>	  
				    </div>
	        </div> <!-- /form-group-->	<hr>	
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
	        	<label for="head_dep_id" class="col-sm-3 control-label">Head Of Department <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="select_headOfDepartment" name="head_dep_id" required >
					    <option value="">~~ SELECT HeadOfDepartment ~~</option>
				      </select>
					  </div>
					
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="start_date" class="col-sm-3 control-label">Start Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control"   id="start_date-" required placeholder="Enter Start Date" name="start_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="end_date" class="col-sm-3 control-label">End Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control"   id="end_date-" required placeholder="Enter End Date" name="end_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div id="showHiddenField" class="form-group" >
	        	<label for="total_days" class="col-sm-3 control-label">Total Days  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="total_days"  required placeholder="Enter total days   " name="total_days" autocomplete="off" onfocusout="myFunction()">				    
					</div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="resumption_date" class="col-sm-3 control-label">Resumption Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control"   id="resumption_date-" required placeholder="Enter Resumption Date " name="resumption_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="leave_id" class="col-sm-3 control-label">Type Of Leave  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="leave_id" name="leave_id" required >
					    <option value="0">~~ SELECT Type of leave ~~</option>
				      	<?php
                         include ('conn.php');
				        $get_leave ="select * from leave_types";
				        $run_leave = mysqli_query($conn, $get_leave);
				        while ($row = mysqli_fetch_array($run_leave)){
				        $leave_id =$row['leave_id'];
				        $leave_types =$row['leave_types'];

                         echo "<option value='$leave_id'>$leave_types</option>";
                        }
		                ?>
						
				      </select>
				    </div>
					
	        </div> <!-- /form-group-->	
			
			<div class="form-group">
	        	<label for="reason_explanation" class="col-sm-3 control-label">Reason Explaination  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <textarea type="text" class="form-control"  id="reason_explanation"  required placeholder="Enter Reason Explanation " name="reason_explanation" autocomplete="off"  ></textarea>
				    </div>
	        </div> <!-- /form-group-->									
            <div class="form-group">
	        	<label for="contact_number" class="col-sm-3 control-label"> Contact Number  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="emp_mobile" required placeholder="Enter Contact Number" name="contact_number" autocomplete="off" >				    
					</div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="Officer_taken_over" class="col-sm-3 control-label">Officer Taken Over  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="Officer_taken_over" required placeholder="Enter Officer Taken Over " name="Officer_taken_over" autocomplete="off" onfocusout="getOvertime_paid( )">				    
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
	if(document.getElementById("checkbox").checked == true){  
        if ($("#annual_leave").val() !='' && $("#sick_leave").val() !='' && $("#year").val() !=''){
		   $("#annual_leave").attr('readonly', false) ; 
           $("#sick_leave").attr('readonly', false) ; 
           $("#year").attr('readonly', false) ; 		   		   
		} else {
		   alert('Please select employee name first before you can activate. ');
		   $("#annual_leave").attr('readonly', true) ; 
           $("#sick_leave").attr('readonly', true) ; 
           $("#year").attr('readonly', true) ; 		   
           document.getElementById("checkbox").checked = false ;		
		}
	} else {
		   $("#annual_leave").attr('readonly', true) ;	
		   $("#sick_leave").attr('readonly', true) ; 
		   $("#year").attr('readonly', true) ; 
	}
 }	
 
 $(document).ready(function() 
{
   $('#update').click(function(event){
	   if(document.getElementById("checkbox").checked == false){   
        alert('Please check the activate box to activate before updating ');
	   } else {   
            $('#select_emp').val();	   
	        event.preventDefault();
		    $.ajax({
		     url:"update_annual_leave.php",	
			 method:"POST",
			 data:$('#update_form').serialize(),
			 dataType:"text",
			 success:function(strMessage)
			 {
				 
             $('#message').text(strMessage);
			 $("#message").fadeIn(2500).fadeOut(6000);
				 
			 }
		
		    });
		
       }
	   	  
    });
   
});
 
// datepicker code
$(document).ready(function() 
{	
    $("#start_date").datepicker({showOtherMonths: true , changeMonth: true});

    $("#end_date").datepicker({showOtherMonths: true , changeMonth: true});
	
    $("#resumption_date").datepicker({showOtherMonths: true , changeMonth: true});

});
 
 // getting basic salary from emp table
$(document).ready(function() 
{
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_contact.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#emp_mobile').val(data);

                  }
              });
		  
         
		}	else { 		     
		     alert("Please select employee");
		}
     });
	 
	// getting annual leave from emp table
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_annual_leave.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#annual_leave').val(data);

                  }
              });
		  
         
		}	else { 		     
		     alert("Please select employee");
		}
    });
	
	// getting annual leave from emp table
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_sick_leave.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#sick_leave').val(data);

                  }
              });
		  
         
		}	else { 		     
		     alert("Please select employee");
		}
    });
	
/*	// getting year from emp table
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_year.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"text",
                  success:function(data)
                  {
                    $('#year').val(data);

                  }
              });
		  
         
		}	else { 		     
		     alert("Please select employee");
		}
    });
*/ 
   
 });
 
 // GETTING HEAD OF Department  FROM headOfDepartment TABLE
$(document).ready(function() {	
	$('#select_emp').change(function(){
		var emp_id = $(this).val();	
		$.ajax({
		     url:"fetch_headOfDep.php",	
			 method:"POST",
			 data:{emp_id:emp_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#select_headOfDepartment').html(data);				 
			 }
		
		});
		
	});

});
 
</script>   
</body>
</html>
