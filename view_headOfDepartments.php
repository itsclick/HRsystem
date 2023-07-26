<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php 
if(!isset($_GET['head_dep_id']))
		{
		    $dep_name = "~~SELECT a department~~";
            $HeadOfDepartment = "";
            if(isset($_POST['submit']))
			{
                include ('conn.php');
				$dep_id = $_POST['dep_id'] ;
			    $HeadOfDepartment = $_POST['HeadOfDepartment'] ; 
                
                                 $insert =  "insert into headOfDepartments (dep_id,HeadOfDepartment) values ('$dep_id','$HeadOfDepartment ')";
                                 $result = mysqli_query($conn,$insert);
                             
                if($result)
				{
					         
 
                          echo  "<script>alert('insert is successfully complete')</script>";
	                      echo "<script>window.open('HeadOfDepartments','_self')</script>";
                } else 
                {		
                    echo  "<script>alert('insert is not successfully complete')</script>";
                    echo "<script>window.open('HeadOfDepartments','_self')</script>";
                }
			}	
		} else 
		{
	         include ('conn.php');
			 
                 $get_id=$_GET['head_dep_id'];		
	             $query =  "select h.dep_id,d.dep_name,h.HeadOfDepartment,h.head_dep_id from HeadOfDepartments h Join departments d on h.dep_id=d.dep_id 
				 where h.head_dep_id = $get_id";
	             $result = mysqli_query($conn,$query);
	             while($row=mysqli_fetch_array($result)){
	                 $dep_id = $row[0];
	                 $dep_name = $row[1];
                     $HeadOfDepartment = $row[2];
					 $head_dep_id = $row[3];
	                }
		    if(isset($_POST['submit']))
			{
				include('conn.php');
			   $head_dep_id = $_GET['head_dep_id'];
               $dep_id      = $_POST['dep_id'] ;
			   $HeadOfDepartment = $_POST['HeadOfDepartment'] ;
			   
                $dep_id = $_POST['dep_id'] ;
			    $HeadOfDepartment = $_POST['HeadOfDepartment'] ; 
                
                                 $update =  "Update  headOfDepartments  set dep_id = '$dep_id' ,HeadOfDepartment = '$HeadOfDepartment' where  head_dep_id = $get_id";
                                 $result = mysqli_query($conn,$update);
                         
                if($result)
				{
					
                           echo  "<script>alert('update is successfully complete')</script>";
					       echo "<script>window.open('HeadOfDepartments','_self')</script>";
                } else 
                {		
                    echo  "<script>alert('update is not successfully complete ')</script>";	
					echo "<script>window.open('HeadOfDepartments','_self')</script>";
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

</script>


</head>
<body>
<div class="container_fluid">
 <div class="row" >
     <nav class="navbar navbar-default">
        <div class="container" style="width:100%">
			
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
		  <li class="Active">Department </li>
		
		</ol>
		<div class="row" >
         <div class="col-lg-12">		 
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-th-list "></i> View Department </div>
		   </div>
		   
		   <div class="panel-body">
		        <div class="pull pull-right" style="padding-bottom:20px;">
			  
			       <button class="btn btn-default"><a href="headOfdep_list_report"><i class="glyphicon glyphicon-print " ></i> Print </a></button>
			 
		        </div>     

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			   <th>SN</th>
			   <th>Department Name</th>
			   <th>Head Of Department</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
    include ('conn.php');  
    $i = 0;	
	$query =  "select h.dep_id,d.dep_name,h.head_dep_id, h.HeadOfDepartment from HeadOfDepartments h Join departments d on h.dep_id=d.dep_id ";
	$result = mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result)){
	$dep_id = $row[0];
	$dep_name = $row[1];
	$head_dep_id = $row[2]; 
    $HeadOfDepartment = $row[3];
	$i++;
	?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $dep_name; ?></td>
				<td><?php echo $HeadOfDepartment; ?></td>
           </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
                <th>SN</th>
			   <th>Department Name</th>
			   <th>Head Of Department</th>
               </tr>
			
              </tfoot>
	
    </table>
	
	</div>
		   
		   

        </div>
     </div> 
	</div>  
   </div>
	
	
</div>
   
<script>
$(document).ready(function() {
    $('#example').DataTable( {
       
        
    } );
} );
</script>  
</body>
</html>
