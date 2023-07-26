<?php
 session_start();
 
 if(!isset($_SESSION['user_role'])){
	header('location: index');	 
 }
 include("functions.php"); 
?>
<?php 
if(!isset($_GET['position_id']))
		{
		    $position = "";           
            if(isset($_POST['submit']))				
			{
				$message="";
				if($_POST['position'] =="")
				{				
				  $message="Please find out these fields.";
				} else
				{
                  include ('conn.php');
				
                $position = $_POST['position'];
               

                $insert =  "insert into positions (position) values ('$position')";
                 
                    $result = mysqli_query($conn,$insert);

                if($result)
				{
                  echo  "<script>alert('insert is successfully complete')</script>";
				  echo "<script>window.open('positions','_self')</script>";
		          $position = "";
                 
                } else 
				{		
	              echo  "<script>alert('insert is not successfully complete')</script>";
				  echo "<script>window.open('positions','_self')</script>";
		          $position = "";
                 
	            }
				}
				
            }		
		} else 
		{
	        include ('conn.php');
			$i =0;
            $get_id=$_GET['position_id'];		
	        $query =  "select * from positions where position_id='$get_id'";
	        $result = mysqli_query($conn,$query);
	        while($row=mysqli_fetch_array($result))
			{
               $position_id = $row['position_id'];
	           $position = $row['position'];
			   $i++;
		    }
		    if(isset($_POST['submit']))
			{
			   $position_id = $_GET['position_id'];
	           $position = $_POST['position'];
			   
			   $update = " update positions set  position='$position' where position_id='$get_id'";
               $query = mysqli_query($conn,$update);
			   if($query) 
			    {
                    echo  "<script>alert('update is successfully complete')</script>";
					echo "<script>window.open('positions','_self')</script>";
					$position = "";     
					
                } else 
				{		
             	    echo  "<script>alert('update is not successfull ')</script>";	
					echo "<script>window.open('positions','_self')</script>";
					$position = "";
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
		  <li class="Active">Position</li>
		
		</ol>
		<div class="row" >
		<div class="col-lg-4">
          <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Position </div>
		   </div>
		   
		   <div class="panel-body">
                 <form name="form1" class="form-inline" role="form" method="post">		       
		        <div class="form-group">
                 <input type="text" class="form-control" id="position" name="position" placeholder="Enter Position" value="<?php echo $position ; ?>" required  style="width:400px;"/>
                </div>
				<div class="form-group">
				<button type="submit" name="submit" class="form-control  btn btn-success" style="width:100px; margin-top:15px;" >Save</button>	
                </div>	
                </form>	   
		   </div>
		   </div>
		</div>
		<div class="col-lg-8">
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Manage Position </div>
		   </div>
		   
		   <div class="panel-body">
		        <div class="pull pull-right" style="padding-bottom:20px;">
			  
			       <button class="btn btn-default"><a href="pos_list_report"><i class="glyphicon glyphicon-print " ></i> Print </a></button>
			 
		        </div>    

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			   <th>SN</th>
			   <th>Position </th>
			   <th style="width:15%">Options</th>
			   </tr>
			   </thead>
			   <tbody>
    <?php 
    include ('conn.php');  
    $i = 0;	
	$query =  "select * from positions ";
	$result = mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result)){
	$position_id = $row['position_id'];
	$position = $row['position'];
	$i++;
	?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['position']; ?></td>
				<td> <?php echo "<a href='positions?position_id=$position_id' class='label label-primary'><i class='glyphicon glyphicon-edit'> Edit</i></a>" ?> | <?php echo "<a  href='delete_position?position_id=$position_id' class='label label-danger'><i class='glyphicon glyphicon-trash'> Delete</i></a>" ?> </td>
            </tr>
    <?php
	}
	?>
        </tbody>
              <tfoot>
               <tr>
                <th>SN</th>
			   <th>Position </th>
			   <th style="width:15%">Options</th>
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
