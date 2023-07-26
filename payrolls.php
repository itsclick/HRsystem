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
                $pay_date = $_POST['pay_date'];
                $emp_id = $_POST['emp_id'];
                $basic_salary = $_POST['basic_salary'];
                $loan_id = $_POST['loan_id'];
				if($_POST['loan_id'] == 1 ){
					 $loan_balance = 0 ;
				} else
				{
				     $loan_balance = $_POST['loan_balance'];
				}
                $leave_paid = $_POST['leave_paid'];
                $overtime_paid = $_POST['overtime_paid'];
                $sales_commission = $_POST['sales_commission'];
                $perdiem = $_POST['perdiem'];
                $other_benefits = $_POST['other_benefits'];
                $ssnit = $_POST['ssnit'];
                $paye = $_POST['paye'];
                $loan_paid = $_POST['loan_paid'];
                $advance_taken = $_POST['advance_taken'];
                $unpaid_leave = $_POST['unpaid_leave'];
                $lateness = $_POST['lateness'];
                $welfare = $_POST['welfare'];
                $other_deductions = $_POST['other_deductions'];
			    // calculation
				$total_earnings = $basic_salary + $leave_paid + $overtime_paid + $sales_commission + $perdiem + $other_benefits ;				
				$total_deductions = $ssnit + $paye + $loan_paid + $advance_taken + $unpaid_leave + $lateness + $welfare + $other_deductions ;
				$net_salary = $total_earnings - $total_deductions ;

                 //inserting data
				 include ('conn.php');
				 
				 // Get Loan balance
		
				if($total_earnings < $total_deductions )
				{
				     echo  "<script>alert('Please the total earnings is less than the total deductions.Check all the deductions. ')</script>";
				} else if($loan_balance < $loan_paid)
				{ 
				     echo  "<script>alert('Please you cannot paid more than you owe. Check loan paid')</script>";
	
				} else
				{
								
				 $insert_payroll = " insert into payroll (pay_date,emp_id,basic_salary,loan_id,loan_balance,leave_paid,overtime_paid,sales_commission,perdiem,other_benefits,
				 ssnit,paye,loan_paid,advance_taken,unpaid_leave,lateness,welfare,other_deductions,total_earnings,total_deductions,net_salary)				 
                 values ('$pay_date','$emp_id','$basic_salary','$loan_id','$loan_balance','$leave_paid','$overtime_paid','$sales_commission','$perdiem','$other_benefits',
				 '$ssnit','$paye','$loan_paid','$advance_taken','$unpaid_leave','$lateness','$welfare','$other_deductions','$total_earnings','$total_deductions','$net_salary')";
                 
                 $result= mysqli_query($conn,$insert_payroll);

                   if($result)
				    {
					   $get_pay_id = mysqli_insert_id($conn);
                       echo  "<script>alert('insert is successfully completed')</script>";
                       echo "<script>window.open('payrolls','_self')</script>";
					   					
					       
					   // update employee salary 
                           	   			   
					       $query =  " select p.pay_date,p.emp_id,p.basic_salary,p.loan_id,p.loan_paid from payroll p
						                     JOIN employees e on p.emp_id= e.emp_id 
						                     JOIN loans l on p.loan_id= l.loan_id 
											 where p.emp_id ='".$_POST['emp_id']."' AND p.pay_date ='".$_POST['pay_date']."'";
						   	
	                       $result = mysqli_query($conn,$query);
	                       while($row=mysqli_fetch_array($result))
	                        {
								    $pay_date = $row[0];
								    $emp_id = $row[1];
                                    $basic_salary = $row[2];                 
								    $loan_id = $row[3];
								    $p_loan_paid = $row[4];
	                        
								   $update_emp_sal = "update employees set basic_salary = '$basic_salary' where emp_id =$emp_id  ";	 
								   $query = mysqli_query($conn,$update_emp_sal);

								   // update loans tables // setting default value to loan paid
								   
							    	$query =  " select l.loan_id,l.emp_id,l.loan_amount,l.loan_paid,l.loan_balance,p.emp_id,p.emp_id
			                                          from loans l Join payroll p on l.loan_id= p.loan_id 
											          where p.emp_id ='".$_POST['emp_id']."' AND p.pay_date ='".$_POST['pay_date']."'";

	                                $result = mysqli_query($conn,$query);
	                                while($row=mysqli_fetch_array($result))
	                                {
	                                 $loan_id = $row[0];	                                 
	                                 $l_emp_id = $row[1];
	                                 $loan_amount = $row[2];
		                             $loan_paid = $row[3];
	                                 $loan_balance = $row[4];
                                     $p_emp_id = $row[5]; 
                                   									 
									 
	                    	           if ($p_loan_paid == "" || $p_loan_paid == 0)
								        {
	                      	              $loan_paid = $row[3];
		                                  // Calculating loan balance
                                          $loan_balance = $loan_amount - $loan_paid ;
                                          $update_loan_bal = "update loans set loan_balance = '$loan_balance' where emp_id =$l_emp_id AND loan_id = $loan_id ";
		                                  $query = mysqli_query($conn,$update_loan_bal);		
		                                } else 
								        {
		                                  $loan_paid = $row[3] + $p_loan_paid ;
		                                  $loan_balance = $loan_amount - $loan_paid ;
                                          $update_loan_bal = "update loans set loan_paid ='$loan_paid',loan_balance = '$loan_balance' where emp_id =$l_emp_id  AND loan_id = $loan_id ";
	                                      $query = mysqli_query($conn,$update_loan_bal);
                                        }
							        } 
									
									// populate loan history 
						            $query_his =  " select sum(loan_amount),sum(loan_paid),sum(loan_balance) from loans where emp_id ='$emp_id'  ";

	                                $result_his = mysqli_query($conn,$query_his);
	                                while($row=mysqli_fetch_array($result_his))
	                                {
	                                 $loan_amount_his = $row[0];
		                             $loan_paid_his = $row[1];
	                                 $loan_balance_his = $row[2];
									 
									 
									 
									     $insert_loan_his = "insert into loan_history (pay_id,pay_date,emp_id,loan_id,loan_amount,loan_paid,loan_balance) 
		                                 values ('$get_pay_id','".$_POST['pay_date']."','".$_POST['emp_id']."','".$_POST['loan_id']."','$loan_amount_his','$loan_paid_his ','$loan_balance_his')  ";	 
								         $query = mysqli_query($conn,$insert_loan_his);
								       								
					                }
							}
					   
                    } else 
				    {		
	                    echo  "<script>alert('insert is not successfully completed')</script>";
				        echo "<script>window.open('payrolls','_self')</script>";		         
                    }
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
	    
<div class="container">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Payroll </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Payroll </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			     <button class="btn btn-default"><a href="view_payrolls"><i class="glyphicon glyphicon-edit" ></i> Manage Payroll </a></button>
			 
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
            <div id="payroll_form" style="display:block;">			
			<div class="form-group">
	        	<label for="pay_date" class="col-sm-3 control-label">Pay Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  required  id="pay_date"  placeholder="Enter Pay Date" name="pay_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="basic_salary" class="col-sm-3 control-label">Basic Salary <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  required id="select_salary" placeholder="Enter Basic Salary" name="basic_salary" autocomplete="off" onfocusout="myFunction()" >				    
					</div>
	        </div> <!-- /form-group-->	
            <div class="form-group" style="display:none;">
	        	<label for="emp_ssnit_number" class="col-sm-3 control-label">SSNIT Number  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="emp_ssnit_number" placeholder="Enter emp_ssnit_number " name="emp_ssnit_number" autocomplete="off" onfocusout="myFunction()" >				    
					</div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="loan_id" class="col-sm-3 control-label">Outstanding Loans <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-5">
				      <select class="form-control" id="select_loan" name="loan_id"  >
					    <option value="1">~~ SELECT Outstanding loan ~~</option>
                       			  
				      </select>
					</div>			
                    <div class="col-sm-3">
				      <input type="text" class="form-control"  id="loan_balance" name="loan_balance" value "" placeholder="Enter loan balance " readonly  autocomplete="off" onfocusout="myFunction()" >				    
					</div>					
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="loan_paid" class="col-sm-3 control-label">Loan Paid  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  required id="loan_paid" placeholder="Enter Loan Paid " name="loan_paid" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="annual_leave" class="col-sm-3 control-label">Total Leaves Days <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-6">
				      <input type="number" class="form-control" required id="annual_leave_balance" readonly value= " " placeholder=" Annual Leave Balance  " name="annual_leave" autocomplete="off"  >
				    </div>
					<div class="col-sm-2" style="margin-top:5px;">
                    <input  type="checkbox" id="checkbox" onchange="Activate_ReadOnly()" name="checkbox" /> Activate					  
				    </div>
	        </div> <!-- /form-group-->			
			<div class="form-group">
	        	<label for="leave_paid" class="col-sm-3 control-label">Leave Paid </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="total_Annual_leave" placeholder="Enter Leave Paid" name="leave_paid" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_paid" class="col-sm-3 control-label">Overtime Paid  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="overtime_paid" placeholder="Enter Overtime Paid" name="overtime_paid" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="sales_commission" class="col-sm-3 control-label">Sales Commission </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="sales_commission" placeholder="Enter Sales Commission" name="sales_commission" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="perdiem" class="col-sm-3 control-label">Perdiem </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required  id="perdiem" placeholder="Enter Perdiem " name="perdiem" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="other_benefits" class="col-sm-3 control-label">Other Benefits  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required  id="other_benefits" placeholder="Enter Other Benefits " name="other_benefits" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="ssnit" class="col-sm-3 control-label">SSNIT @ 5.5%  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"   id="ssnit" placeholder="Enter SSNIT" readonly name="ssnit" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="paye" class="col-sm-3 control-label">PAYE  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  id="paye" readonly placeholder="Enter PAYE " name="paye" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="advance_taken" class="col-sm-3 control-label">Advance Taken </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required  id="advance_taken" placeholder="Enter Advance Taken " name="advance_taken" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="annual_leave" class="col-sm-3 control-label">Total Leaves Unpaid <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-6">
				      <input type="number" class="form-control" required id="monthly_leave_unpaid" readonly value= " " placeholder=" Monthly Unpaid Leave   " name="annual_leave" autocomplete="off"  >
				    </div>
					<div class="col-sm-2" style="margin-top:5px;">
                    <input  type="checkbox" id="checkbox2" onchange="Activate_ReadOnly()" name="checkbox" /> Activate					  
				    </div>
	        </div> <!-- /form-group-->				
			<div class="form-group">
	        	<label for="unpaid_leave" class="col-sm-3 control-label">Unpaid leave </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="total_unpaid_leave" placeholder="Enter Unpaid Leave " name="unpaid_leave" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="annual_leave" class="col-sm-3 control-label">Total Minutes <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-6">
				      <input type="number" class="form-control" required id="monthly_total_lateness" readonly value= " " placeholder=" Total Minutes Of Lateness   " name="annual_leave" autocomplete="off"  >
				    </div>
					<div class="col-sm-2" style="margin-top:5px;">
                    <input  type="checkbox" id="checkbox3" onchange="Activate_ReadOnly()" name="checkbox" /> Activate					  
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="lateness" class="col-sm-3 control-label">Lateness </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="lateness" placeholder="Enter Lateness  " name="lateness" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="welfare" class="col-sm-3 control-label">Welfare </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" required id="welfare" placeholder="Enter Welfare  " name="welfare" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="other_deductions" class="col-sm-3 control-label">other Deductions  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control"  required id="other_deductions" placeholder="Enter other Deductions  " name="other_deductions" autocomplete="off"  >
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
	if(document.getElementById("checkbox").checked == true)
	{ 
        if ($("#select_emp").val() !='')
		{		  	
		   $("#annual_leave_balance").attr('readonly', false) ;
           $("#total_Annual_leave").attr('readonly', true) ; 		   
        } else if ($("#select_emp").val() !='')
		{
		  $("#total_Annual_leave").attr('readonly', true) ; 		   
		} else 
		{
		   alert('Please select employee name first before you can activate. ');
           $("#annual_leave_balance").attr('readonly', true) ; 		   
           document.getElementById("checkbox").checked = false ;
        }		   
	} else 
	{
		   $("#annual_leave_balance").attr('readonly', true) ;         		   
	}			   
    
	// monthly_leave_unpaid
    if(document.getElementById("checkbox2").checked == true)
	{ 
        if ($("#select_emp").val() !='')
		{		  	
		   $("#monthly_leave_unpaid").attr('readonly', false) ;
           $("#total_unpaid_leave").attr('readonly', true) ; 		   
        } else if ($("#select_emp").val() !='')
		{
		  $("#total_unpaid_leave").attr('readonly', true) ; 		   
		} else 
		{
		   alert('Please select employee name first before you can activate. ');
           $("#monthly_leave_unpaid").attr('readonly', true) ; 		   
           document.getElementById("checkbox2").checked = false ;
        }		   
	} else 
	{
		   $("#monthly_leave_unpaid").attr('readonly', true) ;		   
	}			

    // monthly_lateness
    if(document.getElementById("checkbox3").checked == true)
	{ 
        if ($("#select_emp").val() !='')
		{		  	
		   $("#monthly_total_lateness").attr('readonly', false) ;
           $("#lateness").attr('readonly', true) ; 		   
        } else if ($("#select_emp").val() !='')
		{
		  $("#lateness").attr('readonly', true) ; 		   
		} else 
		{
		   alert('Please select employee name first before you can activate. ');
           $("#monthly_total_lateness").attr('readonly', true) ; 		   
           document.getElementById("checkbox3").checked = false ;
        }		   
	} else 
	{
		   $("#monthly_total_lateness").attr('readonly', true) ;		   
	}				
	
 }
 
// Calculating Annual leave paid
$(document).ready(function() {
	$('#annual_leave_balance').blur(function(){
		var annual_leave_balance = $(this).val(); 
        var select_salary = $('#select_salary').val();
		var total_Annual_leave = (select_salary / 26) * annual_leave_balance ;
		document.getElementById("total_Annual_leave").value = total_Annual_leave.toFixed(2) ;
	    $("#total_Annual_leave").attr('readonly', true) ; 	
	});
	
// Calculating monthly unpaid leave
	$('#monthly_leave_unpaid').blur(function(){
		var annual_leave_balance = $(this).val(); 
        var select_salary = $('#select_salary').val();
		var total_unpaid_leave = (select_salary / 26) * annual_leave_balance ;
		document.getElementById("total_unpaid_leave").value = total_unpaid_leave.toFixed(2) ;
	    $("#total_unpaid_leave").attr('readonly', true) ; 	
	});
	
// Calculating monthly lateness
	$('#monthly_total_lateness').blur(function(){
		var monthly_total_lateness = $(this).val(); 
        var select_salary = $('#select_salary').val();
		var total_lateness = (((select_salary / 26)/9)/60) * monthly_total_lateness ;
		document.getElementById("lateness").value = total_lateness.toFixed(2) ;
	    $("#lateness").attr('readonly', true) ; 	
	});
	
} );
 
// GETTING DATEPICKER
$(document).ready(function() {
	$("#pay_date").datepicker({
		 dateFormat:"yy-mm-dd",
		showOtherMonths: true , changeMonth: true});
} );

// GETTING LOAN BALANCE FROM LOANS TABLE
$(document).ready(function() {	
	$('#select_emp').change(function(){
		var emp_id = $(this).val();	
		$.ajax({
		     url:"fetch_loans.php",	
			 method:"POST",
			 data:{emp_id:emp_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#select_loan').html(data);				 
			 }
		
		});
		
	});


});

$(document).ready(function() {	
	$('#select_emp').change(function(){
		var emp_id = $(this).val();	
		 document.getElementById('loan_balance').value=0;	
	});

});		
// GETTING LOAN BALANCE FROM LOANS TABLE
$(document).ready(function() { 	
	$('#select_loan').change(function(){
		var loan_id = $(this).val();
     	if(loan_id !='')
		{	
		  $.ajax({
		     url:"fetch_loan_balance.php",	
			 method:"POST",
			 data:{loan_id:loan_id},
			 dataType:"text",
			 success:function(data)
			 {
				 $('#loan_balance').val(data);				 
			 }
		
		  });
		  
		} else 
		{
		   document.getElementById('loan_balance').value=0;	
		}		
	});
	
	
});


//GETTING BASIC SALARY FROM EMPLOYEE TABLE
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
                  datatype:"JSON",
                  success:function(data)
                  {
                   $('#select_salary').val(data);
                  }
              });
		}else{ 	
	         alert('please select employee');     
		}
     });
 });
 
 // GETTING SSNIT NUMBERS FROM EMPLOYEE TABLE
 $(document).ready(function() 
{
    $('#select_emp').change(function(){
		 var emp_id = $(this).val();	

        if(emp_id !='')
		{
		    $.ajax({
                  url:"fetch_ssnit_number.php",
                  method:"POST",
                  data:{emp_id:emp_id},
                  datatype:"JSON",
                  success:function(data)
                  {
                    $('#emp_ssnit_number').val(data);
                  }
            });
		}
     });
 });
 
 //CALCULATING SSNIT AND PAYE
$(document).ready(function() 
{
  $('#select_emp').blur(function()
	{
		var emp_id = $(this).val();
        var basicsalary = $('#select_salary').val();		 

   if(emp_id !='')
   {
        var emp_ssnit_number = $('#emp_ssnit_number').val();
        if(emp_ssnit_number =="N/A" || emp_ssnit_number ==""){
		  var ssnit = basicsalary * 0.00;
		} else {			
          var ssnit = basicsalary * 0.055;
		}
	    document.getElementById("ssnit").value = ssnit.toFixed(2) ;
	    //CALCULATIONS
	    nettaxable =0;
		nettaxable=basicsalary-ssnit;
		if(nettaxable<=216){
			paye= (nettaxable*0);
		 } else if ((nettaxable>=216) && (nettaxable<=331)){
			paye=((nettaxable-216)*0.05);
		 } else if((nettaxable>=331) && (nettaxable<=431)){
		    paye=(((nettaxable-331)*0.1)+3.5);
		 } else if((nettaxable>=431) && (nettaxable<=3241)) {
			paye=(((nettaxable-431)*0.175)+3.5+10);
		 } else if(nettaxable>3241) {
		    paye=(((nettaxable-3241)*0.25)+491.75+3.5+10);
		 }
		 netsalary=nettaxable-paye;
		 
        document.getElementById("paye").value = paye.toFixed(2) ;
    }else{ 	
	         //alert('please select employee');
	         document.getElementById("select_salary").value = "";
             document.getElementById("paye").value = "";	
			 document.getElementById("ssnit").value = "";
		     
		}
    });

// second 
$('#select_salary').blur(function()
	{
	
		var emp_id = $(this).val();
        var basicsalary = $('#select_salary').val();
        var emp_ssnit_number = $('#emp_ssnit_number').val();
        if(emp_ssnit_number =="N/A"){
		  var ssnit = basicsalary * 0.00;
		} else {			
              ssnit = basicsalary * 0.055;
		}
	    document.getElementById("ssnit").value = ssnit.toFixed(2) ;
	   //CALCULATIONS
	    nettaxable =0;
		nettaxable=basicsalary-ssnit;
		if(nettaxable<=216){
			paye= (nettaxable*0);
		 } else if ((nettaxable>=216) && (nettaxable<=331)){
			paye=((nettaxable-216)*0.05);
		 } else if((nettaxable>=331) && (nettaxable<=431)){
		    paye=(((nettaxable-331)*0.1)+3.5);
		 } else if((nettaxable>=431) && (nettaxable<=3241)) {
			paye=(((nettaxable-431)*0.175)+3.5+10);
		 } else if(nettaxable>3241) {
		    paye=(((nettaxable-3241)*0.25)+491.75+3.5+10);
		 }
		 netsalary=nettaxable-paye;
		 
        document.getElementById("paye").value = paye.toFixed(2) ;   
    });
 });
 
</script>   
</body>
</html>
