 <?php 
if(!isset($_GET['head_dep_id']))
		{
		    $dep_name = "<option value=''>~~SELECT a department~~</option>";
            $HeadOfDepartment = "";
            if(isset($_POST['submit']))
			{
                include ('conn.php');
				 
                $number = count($_POST['HeadOfDepartment']);
                if($number > 0)
                {
                     for ($i=0; $i<$number; $i++) 
                        {
                           if(trim($_POST['HeadOfDepartment'][$i] !="")) 
                             {
                                 $insert =  "insert into headOfDepartments (dep_id,HeadOfDepartment) values ('" .mysqli_real_escape_string($conn,$_POST['dep_id']). "' , '" .mysqli_real_escape_string($conn,$_POST['HeadOfDepartment'][$i]). "')";
                                  mysqli_query($conn,$insert);
                             }

                        } 
 
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
			   $head_dep_id = $_GET['head_dep_id'];
	           $number = count($_POST['HeadOfDepartment']);
                if($number > 0)
                {
                     for ($i=0; $i<$number; $i++) 
                        {
                           if(trim($_POST['HeadOfDepartment'][$i] !="")) 
                             {
                                 $update =  "Update headOfDepartments SET dep_id = '" .mysqli_real_escape_string($conn,$_POST['dep_id']). "' , HeadOfDepartment = '" .mysqli_real_escape_string($conn,$_POST['HeadOfDepartment'][$i]). "' where head_dep_id='$head_dep_id  ";
                                  mysqli_query($conn,$update);
                             }

                        } 
 
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
 $(document).ready(function(e){
    //variables
    var html = '<p/><div> <input type="text"  id="childHeadOfDepartment" name="HeadOfDepartment[]" class="form-control" placeholder="Enter HeadOfDepartment" style="width:400px;">  <a href="#" id="remove"><span style="color:red;">X</span></a> </div>';
    
	var maxRows = 5;
	var x =1;
	
	//add rows to the form
    $("#add").click(function(e){
	    if(x <= maxRows){
         $("#container").append(html);
		 x++;
		 }
        });
    //Remove rows to the form
     $("#container").on('click','#remove',function(e){
      $(this).parent('div').remove();
      x--;
    });
	
	//Populate values from the first row
 });
 
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
				 <li id="navDashboard"><a href="hr/index"> <i class="glyphicon glyphicon-home"> </i> Dashboard </a> </li>  
				 
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
		
		  <li><a href="hr/index">Home</a> </li>
		  <li class="Active">Department </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-plus"></i> Add Department </div>
		   </div>
		   
		   <div class="panel-body">
		    <div class="col-lg-12" >
               <form name="form1" class="form-inline" role="form" method="post">		        
			    <div id="container">
				    <div class="form-group">
                       
                      <select class="form-control" id="dep_id" name="dep_id" style="width:400px;" >
				      	<option value="<?php echo $dep_id; ?>"><?php echo $dep_name; ?></option>
				      	<?php
                        include ('conn.php');
				        $get_dep ="select * from departments";
				        $run_dep = mysqli_query($conn, $get_dep);
				        while ($row_dep = mysqli_fetch_array($run_dep)){
				        $dep_id =$row_dep['dep_id'];
				        $dep_name =$row_dep['dep_name'];

                        echo "<option value='$dep_id'>$dep_name</option>";

                        }
		                ?>	
				      </select>
				    </div>  
                    <a href="departments" >    <i class="glyphicon glyphicon-plus "></i> Add Department</a>		
		            <p/>		       
                    <div class="form-group">
                       <input type="text" class="form-control" id="HeadOfDepartment" name="HeadOfDepartment[]" placeholder="Enter HeadOfDepartment" value="<?php echo $HeadOfDepartment; ?>" required style="width:400px;"/>
                    </div>         		
		    	      <a href="#" id="add">    <i class="glyphicon glyphicon-plus "></i> Add More</a>
			        <p/> 
		        </div> <br/>
                    <button type="submit" name="submit" class="btn btn-success" style="width:100px;">Save</button>		
              </form>
                	
                </form>
            </div> 		   
		   </div>
		   </div>
		<div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Manage Department </div>
		   </div>
		   
		   <div class="panel-body">
		       

	<table id="example" class="display nowrap" style="width:100%">
    
    <thead>
			   <tr>
			   <th>SN</th>
			   <th>Department Name</th>
			   <th>Head Of Department</th>
			   <th style="width:15%">Options</th>
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
	<td> <?php echo " <a  title ='HeadOfDepartment list'  href='headOfDepartment_list?dep_id=$dep_id' class='label label-info'><i class='glyphicon glyphicon-print'> Print</i></a>" ?> | <?php echo "<a href='HeadOfDepartments?head_dep_id=$head_dep_id' class='label label-primary'><i class='glyphicon glyphicon-edit'> Edit</i></a>" ?> | <?php echo "<a href='delete_HeadOfDepartments.php?head_dep_id=$head_dep_id' class='label label-danger'><i class='glyphicon glyphicon-trash'> Delete</i></a>" ?> </td>
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
</script>  
</body>
</html>
