<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php 
if(!isset($_GET['award_id']))
		{
			
		        $emp_id = "";
				$head_dep_id = "";
				$award_title = "";
				$gift_item = "";
				$award_amount = "";
				$month = "";
				$emp_fullname = "~~Select Employee Name~~";
				$dep_name = "";
				$HeadOfDepartment = "~~Select HeadOfDepartment~~";
				
			
            if(isset($_POST['submit']))				
			{
				
                  include ('conn.php');
				
                $emp_id = $_POST['emp_id'];
				$head_dep_id = $_POST['head_dep_id'];
				$award_title = $_POST['award_title'];
				$gift_item = $_POST['gift_item'];
				$award_amount = $_POST['award_amount'];
				$month = $_POST['month'];
				
               

                $insert =  "insert into awards (emp_id,head_dep_id,award_title,gift_item,award_amount,month) values ('$emp_id','$head_dep_id','$award_title','$gift_item','$award_amount','$month')";
                 
                    $result = mysqli_query($conn,$insert);

                if($result)
				{
                  echo  "<script>alert('insert is successfully complete')</script>";
				  echo "<script>window.open('awards','_self')</script>";     
                 
                } else 
				{		
	              echo  "<script>alert('insert is not successfully complete')</script>";
				  echo "<script>window.open('awards','_self')</script>";

	            }
				
				
            }		
		} else 
		{
	        include ('conn.php');
			$i =0;
            $get_id=$_GET['award_id'];		
	        $query =  "select a.award_id , a.award_title, a.gift_item , a.award_amount , a.month , e.emp_fullname ,h.HeadOfDepartment,d.dep_name , e.head_dep_id , a.emp_id
			            from awards a 
						Join employees e on a.emp_id= e.emp_id 
                        join headOfDepartments h on e.head_dep_id = h.head_dep_id 
                        join departments d on h.dep_id = d.dep_id 
                        WHERE a.award_id = $get_id ";						
	        $result = mysqli_query($conn,$query);
	        while($row=mysqli_fetch_array($result))
			{
                 $award_id = $row[0];
	             $award_title = $row[1];
	             $gift_item = $row[2];
	             $award_amount = $row[3];
		         $month = $row[4];
	             $emp_fullname = $row[5];
		         $HeadOfDepartment = $row[6];
		         $dep_name = $row[7];
		         $head_dep_id = $row[8];
		         $emp_id = $row[9];
		         $i++ ;

		    }
		    
		    if(isset($_POST['submit']))
			{
			   $award_id = $_GET['award_id'];
			   
	            $emp_id = $_POST['emp_id'];
				$head_dep_id = $_POST['head_dep_id'];
				$award_title = $_POST['award_title'];
				$gift_item = $_POST['gift_item'];
				$award_amount = $_POST['award_amount'];
				$month = $_POST['month'];
				
			   
			   $update = " update awards set  emp_id = '$emp_id',head_dep_id = '$head_dep_id', award_title = '$award_title' , gift_item = '$gift_item',award_amount = '$award_amount', month = '$month' where award_id = '$award_id'";
               $query = mysqli_query($conn,$update);
			   if($query) 
			    {
                    echo  "<script>alert('update is successfully complete')</script>";
					echo "<script>window.open('awards','_self')</script>";
					    
					
                } else 
				{		
             	    echo  "<script>alert('update is not successfull ')</script>";	
					echo "<script>window.open('awards','_self')</script>";
				
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
	    
<div class="container" style="width:90%">

    <div class="row">
	
	    <ol class="breadcrumb">
		
		  <li><a href="admin/index">Home</a> </li>
		  <li class="Active">Award </li>
		
		</ol>
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Manage Award </div>
		   </div>
		   
    <div class="panel-body">
		       

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			    <th>SN</th>
			    <th>Employee Name</th>
				<th>Head Of Department </th>
			    <th>Award Title </th>
				<th>Gift Item </th>
			    <th>Award Amount </th>
				<th>Month </th>
			    <th style="width:5%">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
    include ('conn.php'); 
    $i = 0 ;	
	$query =  " select a.award_id , a.award_title, a.gift_item , a.award_amount , a.month , e.emp_fullname ,h.HeadOfDepartment,d.dep_name , e.head_dep_id , a.emp_id
			            from awards a 
						Join employees e on a.emp_id= e.emp_id 
                        join headOfDepartments h on e.head_dep_id = h.head_dep_id 
                        join departments d on h.dep_id = d.dep_id 	";				
	$result = mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result))
	{
	    $award_id = $row[0];
	    $award_title = $row[1];
	    $gift_item = $row[2];
	    $award_amount = $row[3];
		$month = $row[4];
	    $emp_fullname = $row[5];
		$HeadOfDepartment = $row[6];
		$dep_name = $row[7];
		$head_dep_id = $row[8];
		$emp_id = $row[9];
		$i++ ;
		
	?>
            <tr>
                <td><?php echo $i ; ?></td>
                <td><?php echo $emp_fullname ; ?></td>
				<td><?php echo $dep_name.','.$HeadOfDepartment ; ?></td>
				<td><?php echo $award_title ; ?></td>
                <td><?php echo $gift_item  ; ?></td>
				<td align="center"><?php echo number_format($award_amount,2,'.',',') ; ?></td>
				<td><?php echo date("F-Y",strtotime($month)); ?></td>
	<td> <?php echo " <a  title ='Award Report'  href='award_report?emp_id=$emp_id' class='label label-info'><i class='glyphicon glyphicon-print'> Print</i></a>" ?></td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
                <th>SN</th>
			    <th>Employee Name</th>
				<th>Head Of Department </th>
			    <th>Award Title </th>
				<th>Gift Item </th>
			    <th>Award Amount </th>
				<th>Month </th>
			    <th style="width:5%">Options</th>
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
	
	$("#month").datepicker({
		dateFormat:"MM yy",
		showOtherMonths: true , changeMonth: true});
   
} );

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
