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
				$comp_id = $_GET['comp_id'];                   
				//holding data from the user form				
                $comp_name = $_POST['comp_name'];
				$comp_logo = $_FILES['comp_logo']['name'];
                $comp_logo_tmp = $_FILES['comp_logo']['tmp_name'];
                $comp_email = $_POST['comp_email'];
                $comp_address = $_POST['comp_address'];
                $comp_city = $_POST['comp_city'];
                $comp_country = $_POST['comp_country'];
                $comp_tel = $_POST['comp_tel'];
                $comp_mobile = $_POST['comp_mobile'];
                $comp_office_line = $_POST['comp_office_line'];
                $comp_fax = $_POST['comp_fax'];
                $comp_website = $_POST['comp_website'];
                
                if(move_uploaded_file($comp_logo_tmp,'./images/photo/'.$comp_logo))
			    {
                 //inserting data
				 include ('conn.php');

				 $update_setting = " Update  company set comp_name='$comp_name',comp_logo='$comp_logo',comp_email='$comp_email',comp_address='$comp_address',
				 comp_city='$comp_city',comp_mobile='$comp_mobile',comp_tel='$comp_tel',comp_office_line='$comp_office_line',comp_fax='$comp_fax',comp_website='$comp_website'
				 where comp_id = 1 ";
                 
                 $result= mysqli_query($conn,$update_setting);

                   if($result)
				    {
                       echo  "<script>alert('Update is successfully completed')</script>";
                       echo "<script>window.open('setting?comp_id=$comp_id','_self')</script>"; 
                    } else 
				    {		
	                    echo  "<script>alert('Update is not successfully completed')</script>";
				        echo "<script>window.open('setting?comp_id=$comp_id','_self')</script>";		         
                    }
                } else {
					//inserting data
				 include ('conn.php');

				 $update_setting = " Update  company set comp_name='$comp_name',comp_email='$comp_email',comp_address='$comp_address',
				 comp_city='$comp_city',comp_mobile='$comp_mobile',comp_tel='$comp_tel',comp_office_line='$comp_office_line',comp_fax='$comp_fax',comp_website='$comp_website'
				 where comp_id =' $comp_id ' ";
                 
                 $result= mysqli_query($conn,$update_setting);

                   if($result)
				    {
                       echo  "<script>alert('Update is successfully completed')</script>";
                       echo "<script>window.open('setting?comp_id=$comp_id','_self')</script>"; 
                    } else 
				    {		
	                    echo  "<script>alert('Update is not successfully completed')</script>";
				        echo "<script>window.open('setting?comp_id=$comp_id','_self')</script>";		         
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
		  <li class="Active">Company </li>
		
		</ol>
        <div class="panel panel-default">
		   <div class="panel-heading">
		    
		    <div class="page-heading"><i class="glyphicon glyphicon-edit"></i> Edit Company </div>
		   </div>
		   
		   <div class="panel-body">

			<div class="col-lg-12" >
                 <form name="form1" id="update_form" class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
				 
		        <div id="container" >	
<?php 

if(isset($_REQUEST['comp_id']))				
			{
				include('conn.php');  
				$query = "select * from company  WHERE comp_id = 1 ";					   	
	            $result = mysqli_query($conn,$query);
	            while($row=mysqli_fetch_array($result))
	            {                  
				//holding data from the user form	
                $comp_id = $row[0];
                $comp_name = $row[1];				
                $comp_logo = $row[2];                
                $comp_email = $row[3];
                $comp_address = $row[4];
                $comp_city = $row[5];
                $comp_country = $row[6];
                $comp_tel = $row[7];
                $comp_mobile = $row[8];
                $comp_office_line = $row[9];
                $comp_fax = $row[10];
                $comp_website = $row[11];		
				
?>         
            <div class="form-group">
                    <div class="col-sm-4">					 
					</div>	        
				    <div class="col-sm-8">					 
				    <p id="message" class="label label-success"></p> 
					</div>									 
	        </div> <!-- /form-group-->	
		    <div class="form-group">
	        	<label for="comp_logo" class="col-sm-3 control-label">Photo </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				     <?php echo " <img src='./images/photo/$comp_logo' width='100' height='80' /> " ; ?>
				    </div>	
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="comp_logo" class="col-sm-3 control-label">Select Logo </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-4">
					    <!-- the avatar markup -->
						<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="comp_logo" name="comp_logo" class="file-loading" style="width:auto;"/>
					    </div> 
				    </div>
					<div class="col-sm-3"style="display:none;"  >  						
				          <button type="submit" name="upload" id="upload" class="btn btn-success" style="width:100px; margin-left:-80px;">Upload</button>	  
				    </div>
	        </div> <!-- /form-group-->	
            <div id="payroll_form" >			
			<div class="form-group">
	        	<label for="comp_name" class="col-sm-3 control-label">Company Name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"    id="comp_name"  value="<?php  echo $comp_name; ?> "  name="comp_name" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="comp_email" class="col-sm-3 control-label">Company E-mail</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_email" placeholder="Enter Basic Salary" value="<?php  echo $comp_email; ?> " name="comp_email" autocomplete="off" >				    
					</div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="comp_address" class="col-sm-3 control-label">Address  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <textarea type="text" class="form-control"  id="comp_address"  name="comp_address" autocomplete="off"  ><?php  echo $comp_address ; ?></textarea>
				    </div>
	        </div> <!-- /form-group-->		
			<div class="form-group">
	        	<label for="leave_paid" class="col-sm-3 control-label">City </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_city"  value="<?php  echo $comp_city; ?> " name="comp_city" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="comp_country" class="col-sm-3 control-label">Country  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_country"  value="<?php  echo $comp_country; ?> " name="comp_country" autocomplete="off" >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="comp_tel" class="col-sm-3 control-label">Telephone  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_tel" value="<?php  echo $comp_tel; ?> " name="comp_tel" autocomplete="off" >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="comp_mobile" class="col-sm-3 control-label">Mobile </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_mobile"  value="<?php  echo  $comp_mobile; ?> " name="comp_mobile" autocomplete="off" >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="comp_office_line" class="col-sm-3 control-label">Office Line  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_office_line"  value="<?php  echo $comp_office_line; ?> " name="comp_office_line" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->	
			<div class="form-group">
	        	<label for="comp_fax" class="col-sm-3 control-label">Fax </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_fax"  value="<?php  echo  $comp_fax; ?> " name="comp_fax" autocomplete="off"  >
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="comp_website" class="col-sm-3 control-label">Website  </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control"  id="comp_website"  value="<?php  echo $comp_website; ?> "  name="comp_website" autocomplete="off"  >
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
$(document).ready(function() 
{
   $('#upload').click(function(event){
	      
        var comp_logo = $('#comp_logo').val();
        if(comp_logo !=""){			
	        event.preventDefault();
		    $.ajax({
		     url:"upload_logo.php",	
			 method:"POST",
			 data:$('#update_form').serialize(),
			 dataType:"text",
			 success:function(strMessage)
			 {
				 
             $('#message').text(strMessage);
			 $("#message").fadeIn(2500).fadeOut(2600);
				 
			 }
		
		    });
		} else 
		{
			alert('Please select logo before uplaoding '); 
	    }
	   	  
    });
   
});
 
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
	 dateFormat:"d/m/yy",
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
