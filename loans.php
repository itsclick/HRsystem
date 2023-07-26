<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php 
if(!isset($_GET['loan_id']))
		{
		    
			
            if(isset($_POST['submit']))				
			{
				
                  include ('conn.php');
				
                $loan_date = $_POST['loan_date'];
				$emp_id = $_POST['emp_id'];
				$loan_amount = $_POST['loan_amount'];
               

                $insert =  "insert into loans (loan_date,emp_id,loan_amount) values ('$loan_date','$emp_id','$loan_amount')";
                 
                    $result = mysqli_query($conn,$insert);

                if($result)
				{
                  echo  "<script>alert('insert is successfully complete')</script>";
				  echo "<script>window.open('loans','_self')</script>";     
                 
                } else 
				{		
	              echo  "<script>alert('insert is not successfully complete')</script>";
				  echo "<script>window.open('loans','_self')</script>";

	            }
				
				
            }		
		} else 
		{
	        include ('conn.php');
			$i =0;
            $get_id=$_GET['loan_id'];		
	        $query =  "select l.loan_id , l.loan_date , l.emp_id , l.loan_amount , l.loan_paid , l.loan_balance , e.emp_fullname  
			            from loans l Join employees e on l.emp_id= e.emp_id ";						
	        $result = mysqli_query($conn,$query);
	        while($row=mysqli_fetch_array($result))
			{
               $loan_id = $row[0];
	           $loan_date = $row[1];
			   $emp_id = $row[2];
			   $loan_amount = $row[3];
			   $loan_paid = $row[4];
			   $loan_balance = $row[5];
               $emp_fullname = $row[6];
			   $i++;

		    }
		    
		    if(isset($_POST['submit']))
			{
			   $loan_id = $_GET['loan_id'];
			   
	           $loan_date = $_POST['loan_date'];
			   $emp_id = $_POST['emp_id'];
			   $loan_amount = $_POST['loan_amount'];
			   
			   $update = " update loans set  loan_date = '$loan_date',emp_id = '$emp_id', loan_amount = '$loan_amount' where loan_id='$loan_id'";
               $query = mysqli_query($conn,$update);
			   if($query) 
			    {
                    echo  "<script>alert('update is successfully complete')</script>";
					echo "<script>window.open('loans','_self')</script>";
					$dep_name = "";     
					
                } else 
				{		
             	    echo  "<script>alert('update is not successfull ')</script>";	
					echo "<script>window.open('loans','_self')</script>";
					$dep_name = "";
	            }
				
			 
		    }    			
		}			 
		
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

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.structure.js"></script>
<script type="text/javascript" src="assets/jqueryui/jquery-ui.theme.js"></script>
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
	    
<div class="container">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Loan </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Loan </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="col-lg-12" >
                 <form name="form1" class="form-horizontal" role="form" method="post">
		        <div id="container" >
				    <div class="form-group">
	        	    <label for="loan_date" class="col-sm-3 control-label">Loan Date <span style="color:red;">* </span></label>
	        	    <label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" required  id="loan_date"  placeholder="Enter Date Loan was taken" name="loan_date" autocomplete="off"  >
				    </div>
	                </div> <!-- /form-group-->
				    <div class="form-group">
	        	    <label for="emp_id" class="col-sm-3 control-label">Employee Full Name <span style="color:red;">* </span></label>
	        	    <label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="emp_id" name="emp_id" required>
					    <option value="0">~~ SELECT Employee Full Name ~~</option>
                        <?php
                        include ('conn.php');
				        $get_emp ="select * from employees ";
				        $run_emp = mysqli_query($conn, $get_emp);
				        while ($row_emp = mysqli_fetch_array($run_emp)){
						$emp_id=$row_emp['emp_id'];
				        $emp_fullname =$row_emp['emp_fullname'];						

                        echo "<option value='$emp_id'>$emp_fullname</option>";

                        }
		                ?>					  
				      </select>
					  </div>
					 
	                </div> <!-- /form-group-->	
                	<div class="form-group">
	        	        <label for="loan_amount" class="col-sm-3 control-label">Loan Amount <span style="color:red;">* </span></label>
	        	        <label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				        <input type="number" class="form-control" id="loan_amount" required   placeholder="Enter Loan Amount" name="loan_amount" autocomplete="off">  
				    </div>
	                </div> <!-- /form-group-->                  		
		            
				         <button type="submit" name="submit" class="form-control  btn btn-success" style="width:250px; margin-left:856px;" >Save</button>	
            
                    </div> 
                	
                </form>
            </div> 		   
		   </div>
		   </div>
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Manage Loan </div>
		   </div>
		   
		   <div class="panel-body">
	            <div class="pull pull-right" style="padding-bottom:20px;">
			  
			       <button class="btn btn-default"><a href="loan_list_report"><i class="glyphicon glyphicon-print " ></i> Print All </a></button>
			 
		        </div>  	       

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			    <th>SN</th>
			    <th>Date</th>
				<th>Employee Name </th>
			    <th>Loan Amount </th>
				<th>Loan Paid </th>
			    <th>Loan Balance </th>
			    <th style="width:15%">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
    include ('conn.php');  
	$query =  " select l.loan_id , l.loan_date , l.emp_id , l.loan_amount , l.loan_paid , l.loan_balance , e.emp_fullname  
			            from loans l Join employees e on l.emp_id= e.emp_id ";	
	$result = mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result))
	{
	    $loan_id = $row[0];
	    $loan_date = $row[1];
	    $emp_id = $row[2];
	    $loan_amount = $row[3];
		$loan_paid = $row[4];
	    $loan_balance = $row[5];
        $emp_fullname = $row[6];   
		// setting default value to loan paid
		if ($row[4] == ""){
		$loan_paid = 0 ;
		// Calculating loan balance
        $loan_balance = $loan_amount - $loan_paid ;
        $update_loan_bal = "update loans set loan_paid = $loan_paid, loan_balance = '$loan_balance' where loan_id =$loan_id  ";
		$query = mysqli_query($conn,$update_loan_bal);		
		} else {
		$loan_paid = $row['loan_paid'];
		$loan_balance = $loan_amount - $loan_paid ;
        $update_loan_bal = "update loans set loan_paid = $loan_paid, loan_balance = '$loan_balance' where loan_id =$loan_id  ";
		$query = mysqli_query($conn,$update_loan_bal);
		}
		
	
	?>
            <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
				<td><?php echo $emp_fullname ; ?></td>
				<td><?php echo $row[3]; ?></td>
                <td><?php echo $loan_paid ; ?></td>
				<td><?php echo $loan_balance ; ?></td>
	<td> <?php echo " <a  title ='Loan Report'  href='loan_report?emp_id=$emp_id' class='label label-info'><i class='glyphicon glyphicon-print'> Print</i></a>" ?> | <?php echo "<a href='edit_loan?loan_id=$loan_id' class='label label-primary'><i class='glyphicon glyphicon-edit'> Edit</i></a>" ?> | <?php echo "<a href='delete_loan?loan_id=$loan_id' class='label label-danger'><i class='glyphicon glyphicon-trash'> Delete</i></a>" ?></td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
                <th>SN</th>
			    <th>Date</th>
				<th>Employee Name </th>
			    <th>Loan Amount </th>
				<th>Loan Paid </th>
			    <th>Loan Balance </th>
			    <th style="width:15%">Options</th>
               </tr>
			
              </tfoot>
	
    </table>
	
	</div>
		   
		   

        </div>
      
    </div>
	
	
</div>
   
<script>
$(document).ready(function() {
	
    $('#example').DataTable( {
       
        
    } );
} );

$(document).ready(function() {
	
	$("#loan_date").datepicker({showOtherMonths: true , changeMonth: true});
   
} );


</script>  

</body>
</html>
