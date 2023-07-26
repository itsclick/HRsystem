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
				$pay_id = $_GET['pay_id'];                   
				//holding data from the user form				
                $pay_date = $_POST['pay_date'];
                $emp_id = $_POST['emp_id'];
                $basic_salary = $_POST['basic_salary'];
                $loan_id = $_POST['loan_id'];
				$loan_balance = $_POST['loan_balance'];
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

				
				 
				if($total_earnings < $total_deductions )
				{
				     echo  "<script>alert('Please the total earnings is less than the total deductions.Check all the deductions. ')</script>";
				} else if($loan_balance < $loan_paid)
				{
					  //inserting data
				    include ('conn.php');

				    $insert_payroll = " Update  payroll set pay_date='$pay_date',emp_id='$emp_id',basic_salary='$basic_salary',leave_paid='$leave_paid',
				     overtime_paid='$overtime_paid',sales_commission='$sales_commission',perdiem='$perdiem',other_benefits='$other_benefits',
				     ssnit='$ssnit',paye='$paye',advance_taken='$advance_taken',unpaid_leave='$unpaid_leave',lateness='$lateness',welfare='$welfare',
				     other_deductions='$other_deductions',total_earnings='$total_earnings',total_deductions='$total_deductions',net_salary='$net_salary' 
				     where pay_id =' $pay_id ' ";
                 
                     $result= mysqli_query($conn,$insert_payroll);

                     if($result)
				      {
                       echo  "<script>alert('Update is successfully completed')</script>";
                       echo "<script>window.open('view_payrolls','_self')</script>";
					  } else 
				      {		
	                    echo  "<script>alert('Update is not successfully completed')</script>";
				        echo "<script>window.open('view_payrolls','_self')</script>";		         
                      } 
					 
				} else
				{
                 //inserting data
				 include ('conn.php');

				 $insert_payroll = " Update  payroll set pay_date='$pay_date',emp_id='$emp_id',basic_salary='$basic_salary',loan_id='$loan_id',loan_balance='$loan_balance',leave_paid='$leave_paid',
				 overtime_paid='$overtime_paid',sales_commission='$sales_commission',perdiem='$perdiem',other_benefits='$other_benefits',
				 ssnit='$ssnit',paye='$paye',loan_paid='$loan_paid',advance_taken='$advance_taken',unpaid_leave='$unpaid_leave',lateness='$lateness',welfare='$welfare',
				 other_deductions='$other_deductions',total_earnings='$total_earnings',total_deductions='$total_deductions',net_salary='$net_salary' 
				 where pay_id =' $pay_id ' ";
                 
                 $result= mysqli_query($conn,$insert_payroll);

                   if($result)
				    {
                       echo  "<script>alert('Update is successfully completed')</script>";
                       echo "<script>window.open('view_payrolls','_self')</script>";
					   
					   // update employee salary 
                           	   			   
					       $query =  " select p.pay_date,p.emp_id,p.basic_salary,p.loan_id,p.loan_paid,p.pay_id from payroll p
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
	                                $pay_id =  $row[5];
									
								   $update_emp_sal = "update employees set basic_salary = '$basic_salary' where emp_id =$emp_id  ";	 
								   $query = mysqli_query($conn,$update_emp_sal);
								   
								   
								   // update loans tables								   
							    	$query =  " select l.loan_id,l.emp_id,l.loan_amount,l.loan_paid,l.loan_balance,p.emp_id,p.loan_paid,p.loan_balance
			                                          from loans l Join payroll p on l.loan_id= p.loan_id 
											          where p.emp_id ='".$_POST['emp_id']."' AND p.pay_date ='".$_POST['pay_date']."'";

	                                $result = mysqli_query($conn,$query);
	                                while($row=mysqli_fetch_array($result))
	                                {
	                                 $loan_id = $row[0];	                                 
	                                 $l_emp_id = $row[1];
	                                 $l_loan_amount = $row[2];
		                             $l_loan_paid = $row[3];
	                                 $l_loan_balance = $row[4];
                                     $p_emp_id = $row[5]; 
									 $p_loan_paid = $row[6];
                                   	 $p_loan_balance  = $row[7];							 
									 // setting default value to loan paid
									 $new_loan_paid = $_POST['loan_paid'];
									 
											// Calculating loan balance
                                         $new_loan_balance = $p_loan_balance - $new_loan_paid ;
										 $l_loan_paid = $l_loan_amount - $new_loan_balance ;
                                         $update_loan_bal = "update loans set loan_balance = '$new_loan_balance', loan_paid = '$l_loan_paid' where emp_id =$l_emp_id AND loan_id = $loan_id ";
		                                 $query = mysqli_query($conn,$update_loan_bal);			
							        }															   
							}
							
							// populate loan history 
						            $query_his =  " select sum(loan_amount),sum(loan_paid),sum(loan_balance) from loans where emp_id ='$emp_id' ";

	                                $result_his = mysqli_query($conn,$query_his);
	                                while($row=mysqli_fetch_array($result_his))
	                                {
	                                  $loan_amount_his = $row[0];
		                              $loan_paid_his = $row[1];
	                                  $loan_balance_his = $row[2];
																		  
									 
									     $insert_loan_his = "update loan_history Set loan_amount = '$loan_amount_his' ,loan_paid = '$loan_paid_his ' ,loan_balance = '$loan_balance_his' where pay_id ='$pay_id'  ";	 
								         $query = mysqli_query($conn,$insert_loan_his);

									}
					   
                    } else 
				    {		
	                    echo  "<script>alert('Update is not successfully completed')</script>";
				        echo "<script>window.open('view_payrolls','_self')</script>";		         
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
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Edit Payroll </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="pull pull-right" style="padding-bottom:20px; margin-right:15px;">
			  
			     <button class="btn btn-default"><a href="view_payrolls"><i class="glyphicon glyphicon-edit" ></i> Manage Payroll </a></button>
			 
		    </div> 
		    
			<div class="col-lg-12" >
                 <form name="form1" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
				 
		        <div id="container" >	
<?php 

if(isset($_REQUEST['pay_id']))				
			{
				include('conn.php');  
				$pay_id = $_GET['pay_id'];
				$query = "select p.pay_id,p.emp_id,p.pay_date,p.basic_salary,p.loan_id,p.leave_paid,p.overtime_paid,p.sales_commission,p.perdiem,p.other_benefits,p.ssnit,p.paye,p.loan_paid,
                                 p.advance_taken,p.unpaid_leave,p.lateness,p.welfare,other_deductions,e.emp_fullname,l.loan_balance,l.loan_date,p.loan_balance,l.loan_amount,l.loan_paid 
								 FROM payroll p 
                                 JOIN employees e on p.emp_id = e.emp_id  
                                 JOIN loans l on p.loan_id= l.loan_id 
                                 WHERE pay_id = $pay_id ";					   	
	            $result = mysqli_query($conn,$query);
	            while($row=mysqli_fetch_array($result))
	            {                  
				//holding data from the user form	
                $pay_id = $row[0];
                $emp_id = $row[1];				
                $pay_date = $row[2];                
                $basic_salary = $row[3];
                $loan_id = $row[4];
                $leave_paid = $row[5];
                $overtime_paid = $row[6];
                $sales_commission = $row[7];
                $perdiem = $row[8];
                $other_benefits = $row[9];
                $ssnit = $row[10];
                $paye = $row[11];
                $p_loan_paid = $row[12];
                $advance_taken = $row[13];
                $unpaid_leave = $row[14];
                $lateness = $row[15];
                $welfare = $row[16];
                $other_deductions = $row[17];
				$emp_fullname = $row[18];
				$loan_balance = $row[19];
				$loan_date = $row[20];
				$p_loan_balance = $row[21];
				$l_loan_amount = $row[22];
				$l_loan_paid = $row[23];
				
                if($row[21] =0 ){
				     $p_loan_balance = $p_loan_paid + $p_loan_balance ;
				} else {
			         $p_loan_balance = $p_loan_paid + $loan_balance ;
				}
				/*
			    if( $loan_balance > $l_loan_amount ){
				} else {
				$loan_balance = $p_loan_paid + $loan_balance ;
				$l_loan_paid = $l_loan_paid - $p_loan_paid ;
                
                $update_loan_bal = "update loans set loan_paid ='$l_loan_paid',loan_balance = '$loan_balance' where emp_id =$emp_id  AND loan_id = $loan_id ";
	            $query = mysqli_query($conn,$update_loan_bal);
                }
				*/
?>
		<div class="form-group">
	        	<label for="emp_id" class="col-sm-3 control-label">Employee Full Name <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">					 
				      <select class="form-control" id="select_emp" name="emp_id"  required >
					    <option value="<?php  echo $emp_id;?> "><?php  echo $row[18]; ?></option>	  
				      </select>
					</div>		 
	        </div> <!-- /form-group-->	
            <div id="payroll_form" style="display:block;">			
			<div class="form-group">
	        	<label for="pay_date" class="col-sm-3 control-label">Pay Date <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  required  id="pay_date"  value="<?php  echo $pay_date; ?> "  name="pay_date" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="basic_salary" class="col-sm-3 control-label">Basic Salary <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="select_salary" placeholder="Enter Basic Salary" value="<?php  echo $row[3]; ?> " name="basic_salary" autocomplete="off" onkeypress="isInputNumber(event)." >				    
					</div>
	        </div> <!-- /form-group-->	
            <div class="form-group" style="display:block;">
	        	<label for="emp_ssnit_number" class="col-sm-3 control-label">SSNIT Number  <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="emp_ssnit_number" placeholder="Enter emp_ssnit_number "  readonly  name="emp_ssnit_number" autocomplete="off"  >				    
					</div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="loan_id" class="col-sm-3 control-label">Outstanding Loans <span style="color:red;">* </span></label>
	        	<label class="col-sm-1 control-label">: </label>
				    <label class="col-sm-2 control-label">Current Balance : </label>
				    <div class="col-sm-2">
				      <select class="form-control" id="select_loan" name="loan_id" readonly >
					    <option value="<?php  echo $row[4];?> "><?php  echo $row[19];?></option>
                       			  
				      </select>
					  </div>
					<label class="col-sm-2 control-label">Previous Balance : </label>
					<div class="col-sm-2">
				      <input type="text" class="form-control"  id="loan_balance" name="loan_balance" value="<?php  echo $p_loan_balance ; ?> " readonly autocomplete="off" onkeypress="isInputNumber(event)" >				    				    </div> 
	                </div>
			</div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="loan_paid" class="col-sm-3 control-label">Loan Paid  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="loan_paid" placeholder="Enter Loan Paid " value="<?php  echo $row[12]; ?> "  name="loan_paid" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="annual_leave" class="col-sm-3 control-label">Total Leaves Paid <span style="color:red;">* </span></label>
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
				      <input type="text" class="form-control"  id="total_Annual_leave" placeholder="Enter Leave Paid" value="<?php  echo $row[5]; ?> " name="leave_paid" autocomplete="off"  onkeypress="isInputNumber(event)">
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="overtime_paid" class="col-sm-3 control-label">Overtime Paid  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="overtime_paid" placeholder="Enter Overtime Paid" value="<?php  echo $row[6]; ?> " name="overtime_paid" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="sales_commission" class="col-sm-3 control-label">Sales Commission </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="sales_commission" placeholder="Enter Sales Commission" value="<?php  echo $row[7]; ?> " name="sales_commission" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="perdiem" class="col-sm-3 control-label">Perdiem </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="perdiem" placeholder="Enter Perdiem " value="<?php  echo  $row[8]; ?> " name="perdiem" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="other_benefits" class="col-sm-3 control-label">Other Benefits  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="other_benefits" placeholder="Enter Other Benefits " value="<?php  echo $row[9]; ?> " name="other_benefits" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="ssnit" class="col-sm-3 control-label">SSNIT @ 5.5%  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="ssnit" placeholder="Enter SSNIT" value="<?php  echo  $row[10]; ?> " readonly name="ssnit" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="paye" class="col-sm-3 control-label">PAYE  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="paye" readonly placeholder="Enter PAYE " value="<?php  echo $row[11]; ?> "  name="paye" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="advance_taken" class="col-sm-3 control-label">Advance Taken </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="advance_taken" placeholder="Enter Advance Taken " value="<?php  echo $row[13]; ?> "  name="advance_taken" autocomplete="off" onkeypress="isInputNumber(event)" >
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
				      <input type="text" class="form-control"  id="total_unpaid_leave" placeholder="Enter Unpaid Leave " value="<?php  echo $row[14]; ?> "  name="unpaid_leave" autocomplete="off" onkeypress="isInputNumber(event)" >
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
				      <input type="text" class="form-control"  id="lateness" placeholder="Enter Lateness "  value="<?php  echo $row[15]; ?> "  name="lateness" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="welfare" class="col-sm-3 control-label">Welfare </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="welfare" placeholder="Enter Welfare "  value="<?php  echo $row[16]; ?> " name="welfare" autocomplete="off" onkeypress="isInputNumber(event)" >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="other_deductions" class="col-sm-3 control-label">other Deductions  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="other_deductions" placeholder="Enter other Deductions"  value="<?php  echo $row[17]; ?>" name="other_deductions" autocomplete="off" onkeypress="isInputNumber(event)" >
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
 
//Input Text Allow Only Numbers
 function isInputNumber(evt){
                
    var ch = String.fromCharCode(evt.which);
                
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }
                
    }
// GETTING DATEPICKER
$(document).ready(function() {
	$("#pay_date").datepicker({
	 dateFormat:"yy-mm-dd",
	 showOtherMonths: true , changeMonth: true});
} );

// GETTING SSNIT NUMBERS FROM EMPLOYEE TABLE
 $(document).ready(function() 
{       
         var emp_id = $('#select_emp').val();	

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

$(document).ready(function() 
{
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
